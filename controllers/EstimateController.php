<?php

namespace app\controllers;

use yii\base\Model;
use app\models\Test;
use Yii;
use app\models\Estimate;
use app\models\EstimateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EstimateController implements the CRUD actions for Estimate model.
 */
class EstimateController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Estimate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EstimateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Estimate model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Estimate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelEstimate = new Estimate();
        $modelTests = [new Test];


        if ($modelEstimate->load(Yii::$app->request->post())) {
            foreach(Yii::$app->request->post('Test') as $i => $post){
                $modelTests[$i] = new Test();
            }

            if(Model::loadMultiple($modelTests, Yii::$app->request->post()) && Model::validateMultiple($modelTests)){
                $modelEstimate->save();
                foreach($modelTests as $i => $test){

                    $test->estimate_id = $modelEstimate->id;
                    $test->save(false);
                }
            }

            return $this->redirect(['view', 'id' => $modelEstimate->id]);
        } else {
            return $this->render('create', [
                'modelEstimate' => $modelEstimate,
                'modelTests' => $modelTests,
            ]);
        }
    }

    /**
     * Updates an existing Estimate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelEstimate = $this->findModel($id);
        $modelTests = $modelEstimate->getTests()->all();
        if($modelTests == null){
            $modelTests = [new Test()];
        }
//        var_dump(Yii::$app->request->post());
//        exit(0);

        if ($modelEstimate->load(Yii::$app->request->post()) && $modelEstimate->validate()) {
//            /*Delete all test before update*/
//            foreach($modelTests as $i => $test){
//                $modelTests[$i]->delete();
//            }
//            var_dump($modelTests);
//            exit(0);
            $tests = [];

            foreach(Yii::$app->request->post('Test') as $i => $post){
                if(isset($modelTests[$i])){
                    $tests[$i] = $modelTests[$i];
                }
                else{
                    $tests[$i] = new Test();
                }

            }

            if(Model::loadMultiple($tests, Yii::$app->request->post()) && Model::validateMultiple($tests)){
                $modelEstimate->save();
                foreach($tests as $i => $test){

                    $test->estimate_id = $modelEstimate->id;
                    $test->save(false);
                }
            }

            return $this->redirect(['view', 'id' => $modelEstimate->id]);
        } else {
            return $this->render('update', [
                'modelEstimate' => $modelEstimate,
                'modelTests' => $modelTests,
            ]);
        }
    }

    /**
     * Deletes an existing Estimate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Estimate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Estimate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Estimate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
