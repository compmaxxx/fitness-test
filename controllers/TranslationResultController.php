<?php
/**
 * Created by PhpStorm.
 * User: compmaxxx
 * Date: 2/9/15
 * Time: 1:10 AM
 */

namespace app\controllers;

use app\models\TranslationResult;
use yii\web\Controller;

class TranslationResultController extends Controller{

    public function actionIndex(){
        $model = new TranslationResult();
        $model->tester_id = 1;
        $model->course_id = 1;
        $model->estimate_id = 1;
        $model->translate();
        return $this->render('index',[
            'model' => $model,
        ]);
    }

}