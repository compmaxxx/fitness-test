<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Tester;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\InfoUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="info-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tester_id')->widget(Select2::className(),[
        'data' => ArrayHelper::map(Tester::find()->all(),'id','uniq_id'),
        'options' => ['placeholder' => 'Select a Tester ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'sex')->dropDownList([ 'ชาย' => 'ชาย', 'หญิง' => 'หญิง', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
