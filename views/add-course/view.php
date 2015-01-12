<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AddCourse */

$this->title = $model->course_id;
$this->params['breadcrumbs'][] = ['label' => 'Add Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="add-course-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'course_id' => $model->course_id, 'estimate_id' => $model->estimate_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'course_id' => $model->course_id, 'estimate_id' => $model->estimate_id], [
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
            'course_id',
            'estimate_id',
        ],
    ]) ?>

</div>
