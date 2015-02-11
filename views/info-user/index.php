<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InfoUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Info Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Info User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'firstname',
            'lastname',
            'sex',
            'age',
            'uniq_id',
            'nisit_ku',
            // 'uniq_id',
            // 'nisit_ku',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
