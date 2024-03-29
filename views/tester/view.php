<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tester */

$this->title = $model->getCourse()->one()->name.'-'.$model->tag;
$this->params['breadcrumbs'][] = ['label' => 'Testers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tester-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'course.name',
            'tag',
            'infoUser.uniq_id',
        ],
    ]) ?>


</div>
