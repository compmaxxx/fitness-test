<?php
/**
 * Created by PhpStorm.
 * User: compmaxxx
 * Date: 1/26/15
 * Time: 5:00 PM
 */
namespace app\controllers;

use app\models\Test;
use app\models\Tester;
use Yii;
use app\models\Result;
use yii\rest\Controller;

class ResultRestController extends Controller{
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

    public function actionCreate(){
        $result_req = Yii::$app->request->post();
        if(count($result_req)<=0){
            $result_req = json_decode(file_get_contents('php://input'),true);
        }
        $tester_tag = $result_req['tester_tag'];
        $course_id = $result_req['course_id'];
        $value = $result_req['value'];
        $test_id = $result_req['test_id'];

        $tester = Tester::find()->where(['course_id'=>$course_id, 'tag'=>$tester_tag])->one();
        if($tester == null){
            //create Tester
//            $tester = new Tester();
//            $tester->course_id = $course_id;
//            $tester->tag = $tester_tag;
//            $tester->save();
            throw new \yii\web\HttpException(406, 'Not Found Tester.');

        }
        $result = new Result();
        $result->tester_id = $tester->id;
        $result->value = $value;
        $result->test_id = $test_id;

        $result->save();

//        if(count($result->getFirstErrors()) >= 1){
//            return ['status'=>'error', 'desc'=>$result->getErrors()];
//        }


        return $result;
    }

    public function actionUpdate($id){
        $result = Result::findOne($id);
        if($result==null){
            throw new \yii\web\HttpException(406, 'Not Found Result.');
        }

        $result_req = Yii::$app->request->post();
        if(count($result_req)<=0){
            $result_req = json_decode(file_get_contents('php://input'),true);
        }

        $tester_tag = $result_req['tester_tag'];
        $value = $result_req['value'];
        $course_id = Tester::findOne($result->tester_id)->course_id;

        $tester = Tester::find()->where(['course_id'=>$course_id, 'tag'=>$tester_tag])->one();
        if($tester == null){
            //create Tester
            $tester = new Tester();
            $tester->course_id = $course_id;
            $tester->tag = $tester_tag;
            $tester->save();
        }

        $result->tester_id = $tester->id;
        $result->value = $value;

        $result->save();


        return $result;
    }

    public function actionDelete($id){
        $result = Result::findOne($id);
        $result->delete();
        return $result;
    }

    public function actionView($id){
        return Result::findOne($id);
    }

    public function actionIndex(){
        return Result::find()->all();
    }

    public function actionGetResult(){
        $result_req = Yii::$app->request->post();
        if(count($result_req)<=0){
            $result_req = json_decode(file_get_contents('php://input'),true);
        }
        $tester_tag = $result_req['tester_tag'];
        $course_id = $result_req['course_id'];
        $test_id = $result_req['test_id'];

        $tester = Tester::find()->where(['course_id'=>$course_id, 'tag'=>$tester_tag])->one();
        $result = Result::find()->where(['tester_id'=>$tester->id,'test_id'=>$test_id])->one();

        return $result;
    }
}