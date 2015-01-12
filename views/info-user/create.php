<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InfoUser */

$this->title = 'Create Info User';
$this->params['breadcrumbs'][] = ['label' => 'Info Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
