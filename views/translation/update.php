<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Translation */

$this->title = 'Update Translation: ' . ' ' . $model->getEstimate()->one()->name;
$this->params['breadcrumbs'][] = ['label' => 'Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getEstimate()->one()->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="translation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelForm' => $modelForm,
    ]) ?>

</div>
