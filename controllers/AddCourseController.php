<?php

namespace app\controllers;

use Yii;
use app\models\AddCourse;
use app\models\AddCourseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AddCourseController implements the CRUD actions for AddCourse model.
 */
class AddCourseController extends Controller
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
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all AddCourse models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AddCourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AddCourse model.
     * @param integer $course_id
     * @param integer $estimate_id
     * @return mixed
     */
    public function actionView($course_id, $estimate_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($course_id, $estimate_id),
        ]);
    }

    /**
     * Creates a new AddCourse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AddCourse();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'course_id' => $model->course_id, 'estimate_id' => $model->estimate_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AddCourse model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $course_id
     * @param integer $estimate_id
     * @return mixed
     */
    public function actionUpdate($course_id, $estimate_id)
    {
        $model = $this->findModel($course_id, $estimate_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'course_id' => $model->course_id, 'estimate_id' => $model->estimate_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AddCourse model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $course_id
     * @param integer $estimate_id
     * @return mixed
     */
    public function actionDelete($course_id, $estimate_id)
    {
        $this->findModel($course_id, $estimate_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AddCourse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $course_id
     * @param integer $estimate_id
     * @return AddCourse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($course_id, $estimate_id)
    {
        if (($model = AddCourse::findOne(['course_id' => $course_id, 'estimate_id' => $estimate_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
