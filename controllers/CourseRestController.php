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

class CourseRestController extends Controller{

    public function behaviors(){
        $behaviors = parent::behaviors();
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
        $courses = Course::find()->where(['is_active' => Course::STATE_ACTIVE])->select('id,name,location')->all();
        return $courses;
    }

    public function actionView($id){
        $estimates = Course::findOne($id)->getEstimates()->all();
        $tests = [];
        foreach ($estimates as $estimate) {
            $estimate_tests = $estimate->getTests()->select('id,name,unit')->all();
            foreach ($estimate_tests as $test) {
                $test->name = $estimate->name.'-'.$test->name;
            }

            $tests = array_merge($estimate_tests,$tests);
        }
        return $tests;

    }
}