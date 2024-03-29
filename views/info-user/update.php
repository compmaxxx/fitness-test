<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InfoUser */

$this->title = 'Update Info User: ' . ' ' . $model->uniq_id;
$this->params['breadcrumbs'][] = ['label' => 'Info Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uniq_id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="info-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
