<?php

namespace app\controllers;

use app\models\Course;
use app\models\Test;
use app\models\Tester;
use Yii;
use app\models\Result;
use app\models\ResultSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResultController implements the CRUD actions for Result model.
 */
class ResultController extends Controller
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
     * Lists all Result models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Result model.
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
     * Creates a new Result model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Result();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Result model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->course_id = Tester::findOne($model->tester_id)->course_id;
        $model->unit = $model->test_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Result model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionListTest(){

        if(isset($_POST['depdrop_parents'])){
            $parents = $_POST['depdrop_parents'];
            if($parents != null){
                $id = $parents[0];
                $course = Course::findOne($id);
                if($course == null){
                    throw new NotFoundHttpException('The requested page does not exist.');
                }

                $estimates = $course->getEstimates()->all();
                $tests = [];
                foreach ($estimates as $estimate) {
                    $estimate_tests = $estimate->getTests()->all();
                    foreach ($estimate_tests as $test) {
                        $test->name = $estimate->name.'-'.$test->name;
                    }

                    $tests = array_merge($estimate_tests,$tests);
                }

                echo Json::encode(['output'=>$tests, 'selected'=>'']);
            }

        }
        else{
            echo Json::encode(['output'=>'', 'selected'=>'']);
        }

    }

    public function actionListTester(){

        if(isset($_POST['depdrop_parents'])){
            $parents = $_POST['depdrop_parents'];
            if($parents != null){
                $id = $parents[0];
                $course = Course::findOne($id);
                if($course == null){
                    throw new NotFoundHttpException('The requested page does not exist.');
                }

                $testers = $course->getTesters()->all();
                $testers_arr = ArrayHelper::toArray($testers, [
                    Tester::className() => [
                        'id',
                        'name' => 'tag'
                    ]
                ]);

                echo Json::encode(['output'=>$testers_arr, 'selected'=>'']);
            }

        }
        else{
            echo Json::encode(['output'=>'', 'selected'=>'']);
        }

    }

    public function actionUnit(){

        if(isset($_POST['depdrop_parents'])){
            $parents = $_POST['depdrop_parents'];
            if($parents != null){
                $id = $parents[0];
                $test = Test::findOne($id);
                if($test == null){
                    throw new NotFoundHttpException('The requested page does not exist.');
                }

                $unit = $test->unit;


                echo Json::encode(['output'=>[['id'=>$test->id, 'name'=>$unit]], 'selected'=>$test->id]);
            }

        }
        else{
            echo Json::encode(['output'=>'', 'selected'=>'']);
        }

    }

    /**
     * Finds the Result model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Result the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Result::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
