<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AddCourse */

$this->title = 'Update Add Course: ' . ' ' . $model->course_id;
$this->params['breadcrumbs'][] = ['label' => 'Add Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->course_id, 'url' => ['view', 'course_id' => $model->course_id, 'estimate_id' => $model->estimate_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="add-course-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
