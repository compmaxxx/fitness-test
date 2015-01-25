<?php

namespace app\controllers;

use app\models\TranslationForm;
use Yii;
use app\models\Translation;
use app\models\TranslationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;

/**
 * TranslationController implements the CRUD actions for Translation model.
 */
class TranslationController extends Controller
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
     * Lists all Translation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TranslationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Translation model.
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
     * Creates a new Translation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelTranslation = new Translation();
        $modelForm = [new TranslationForm()];

        $postData = Yii::$app->request->post();

        if($modelTranslation->load(Yii::$app->request->post())){
//            var_dump($postData);
//            exit(0);
//            var_dump($modelTranslation->estimate_id);
//            exit(0);
            $modelTranslationSave = [];
            foreach (Yii::$app->request->post('TranslationForm') as $i => $post) {
                $modelTranslationSave[$i] = new Translation();
                $modelForm[$i] = new TranslationForm();
            }
            if (Model::loadMultiple($modelForm, Yii::$app->request->post()) && Model::validateMultiple($modelForm)) {
                foreach ($modelForm as $i => $form) {
                    $modelTranslationSave[$i]->estimate_id = $modelTranslation->estimate_id;
                    $modelTranslationSave[$i]->value = $form->translate;
                    if($form->upper != ''){
                        $modelTranslationSave[$i]->condition_eval = 'result'.$form->lower.$form->lower_val.' && '.'result'.$form->upper.$form->upper_val;
                    }
                    else{
                        $modelTranslationSave[$i]->condition_eval = 'result'.$form->lower.$form->lower_val;
                    }

                    $modelTranslationSave[$i]->save();
                }

                return $this->redirect(['view', 'id' => $modelTranslation->id]);
            }
        }
        else {
            return $this->render('create', [
                'model' => $modelTranslation,
                'modelForm' => $modelForm,
            ]);
        }
    }

    /**
     * Updates an existing Translation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $estimate_id = $this->findModel($id)->estimate_id;
        $model = Translation::find()->where([
           'estimate_id' => $estimate_id
        ])->all();

        if (Model::loadMultiple($model,Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Translation model.
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
     * Finds the Translation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Translation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Translation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
