<?php
/**
 * Created by PhpStorm.
 * User: compmaxxx
 * Date: 1/17/15
 * Time: 8:58 PM
 */

namespace app\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\Course;

class CourseRestController extends ActiveController{
    public $modelClass = 'app\models\Course';

    public function actionIndex(){
        return new ActiveDataProvider([
            'query' => Course::find()->where(['is_active' => Course::STATE_ACTIVE])->all(),
        ]);
    }

    public function actions()
    {
        $actions = parent::actions();

        // disable the "delete" and "create" actions
        unset($actions['delete'], $actions['create']);

        // customize the data provider preparation with the "prepareDataProvider()" method
//        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        // prepare and return a data provider for the "index" action
    }
}