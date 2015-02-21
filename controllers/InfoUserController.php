<?php

namespace app\controllers;

use app\models\Assessment;
use Yii;
use app\models\InfoUser;
use app\models\InfoUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InfoUserController implements the CRUD actions for InfoUser model.
 */
class InfoUserController extends Controller
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
     * Lists all InfoUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InfoUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InfoUser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model_info_user = $this->findModel($id);
        $assessments = [];
        /*[
                "course_id" => model1

        ]*/
        foreach ($model_info_user->getTesters()->all() as $tester) {
            $course = $tester->getCourse()->one();
            foreach ($course->getEstimates()->all() as $estimate) {
                $assessments[$course->id] = new Assessment();
                $max = new Assessment();
                $assessments[$course->id]->tester_id = $tester->id;
                $assessments[$course->id]->estimate_id = $estimate->id;
                $assessments[$course->id]->translate();
                $assessments[$course->id]->validate();

           }


        }


        return $this->render('view', [
            'model_info_user' => $model_info_user,
            'assessments'    => $assessments,
        ]);
    }

    /**
     * Creates a new InfoUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InfoUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing InfoUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing InfoUser model.
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
     * Finds the InfoUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InfoUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InfoUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
