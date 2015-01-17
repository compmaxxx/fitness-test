<?php
/**
 * Created by PhpStorm.
 * User: compmaxxx
 * Date: 1/17/15
 * Time: 8:58 PM
 */

namespace app\controllers;

use yii\rest\ActiveController;

class CourseRestController extends ActiveController{
    public $modelClass = 'app\models\Course';
}