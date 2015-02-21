<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tester */
$title = $model->getCourse()->one()->name.'-'.$model->tag;

$this->title = 'Update Tester: ' . ' ' .$title;
$this->params['breadcrumbs'][] = ['label' => 'Testers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tester-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
