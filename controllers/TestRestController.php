<?php
/**
 * Created by PhpStorm.
 * User: compmaxxx
 * Date: 3/21/15
 * Time: 5:46 PM
 */

namespace app\controllers;


use app\models\Test;
use yii\rest\Controller;

class TestRestController extends Controller {
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

    public function actionIndex(){
        return Test::find()->all();
    }

    public function actionView($id){
        return Test::findOne($id);
    }
    public function actionByCourse($id){
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