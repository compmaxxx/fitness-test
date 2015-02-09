<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InfoUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Assessment';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assessment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Info User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->getTester()->one()->uniq_id.' '.$model->firstname.' '.$model->lastname), ['view', 'id' => $model->id]);
        },
    ]) ?>

</div>
