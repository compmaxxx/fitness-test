<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InfoUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assessment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tester_id')->textInput() ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'sex')->dropDownList([ 'ชาย' => 'ชาย', 'หญิง' => 'หญิง', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
