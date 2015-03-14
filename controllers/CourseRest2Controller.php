<?php
/**
 * Created by PhpStorm.
 * User: compmaxxx
 * Date: 3/9/15
 * Time: 12:33 AM
 */

namespace app\controllers;


use app\models\Course;
use yii\rest\Controller;

class CourseRest2Controller extends Controller{

    public function actionViewAll(){
        return Course::find()->where(['is_active' => Course::STATE_ACTIVE])->all();
    }
    public function actionView($id){
        return Course::findOne($id);
    }
}