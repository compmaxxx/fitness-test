<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\assets\ResultMissingAsset;

ResultMissingAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $course->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="result-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--        --><?//= Html::a('Create Result', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?
        Modal::begin([
            'header' => '<h4>Results</h4>',
            'id'    => 'modal',
            'size'  => 'modal-lg'
        ]);
    ?>
        <div id="modalContent"></div>
    <?
        Modal::end();
    ?>

<!--    --><?php //Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'test_name',
                'value' => 'test_name'
            ],
//            'course_id',
//            [
//                'attribute' => 'course_id',
//                'value' => 'course.name'
//            ],
            [
                'attribute' => 'tag',
                'value' => 'tag'
            ],

            [
                'attribute' => '',
                'format'    => 'raw',
                'value' => function($model){
                    $course_id =  $model->getTester()->one()->getCourse()->one()->id;
                    $test_id = $model->getTest()->one()->id;
                    $tester_id = $model->getTester()->one()->id;
                    return Html::button('add',['value' => Url::to(['result-missing/create','course_id' => $course_id, 'test_id' => $test_id, 'tester_id' => $tester_id]), 'class' => 'btn btn-success add-result']);
                }
            ],
        ],
    ]); ?>
<!--    --><?php //Pjax::end(); ?>

</div>
