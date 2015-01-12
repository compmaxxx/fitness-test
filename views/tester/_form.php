<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tester */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tester-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uniq_id')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'nisitKU')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
