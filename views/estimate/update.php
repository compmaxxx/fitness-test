<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelEstimate app\models\Estimate */

$this->title = 'Update Estimate: ' . ' ' . $modelEstimate->name;
$this->params['breadcrumbs'][] = ['label' => 'Estimates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelEstimate->name, 'url' => ['view', 'id' => $modelEstimate->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estimate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelEstimate' => $modelEstimate,
        'modelTests' => $modelTests,
    ]) ?>

</div>
