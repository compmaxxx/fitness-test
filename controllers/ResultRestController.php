<?php
/**
 * Created by PhpStorm.
 * User: compmaxxx
 * Date: 1/26/15
 * Time: 5:00 PM
 */
namespace app\controllers;

use yii\rest\ActiveController;

class ResultRestController extends ActiveController{
    public $modelClass = 'app\models\Result';

    public function actions()
    {
        $actions = parent::actions();

        // disable the "delete" and "create" actions
//        unset($actions['delete'], $actions['create']);

        // customize the data provider preparation with the "prepareDataProvider()" method
//        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        // prepare and return a data provider for the "index" action
    }
}