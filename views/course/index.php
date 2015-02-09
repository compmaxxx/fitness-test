<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InfoUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Group Course';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-course-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    --><?php //echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->name), ['grid', 'name' => $model->name]);
        },
    ]) ?>

</div>
