<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $modelEstimate app\models\Estimate */

$this->title = 'Create Estimate';
$this->params['breadcrumbs'][] = ['label' => 'Estimates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estimate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelEstimate' => $modelEstimate,
        'modelTests' => $modelTests,
    ]) ?>

</div>
