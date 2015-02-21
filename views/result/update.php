<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Result */

$title = $model->getTester()->one()->getCourse()->one()->name;
$title .= '::'.$model->getTest()->one()->name;
$title .= '::'.$model->getTester()->one()->tag;

$this->title = 'Update Result: ' . ' ' . $title;
$this->params['breadcrumbs'][] = ['label' => 'Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="result-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
