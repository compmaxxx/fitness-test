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

    public function behaviors(){
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => 86400,
            ],
        ];
        return $behaviors;
    }
    public function actionViewAll(){
        return Course::find()->where(['is_active' => Course::STATE_ACTIVE])->all();
    }

    public function actionView($id){
        return Course::findOne($id);
    }
}