<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Test;
use app\models\Tester;

/* @var $this yii\web\View */
/* @var $model app\models\Result */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="result-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'test_id')->widget(Select2::className(),[
        'data' => ArrayHelper::map(Test::find()->all(),'id','name'),
        'options' => ['placeholder' => 'Select a Test ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'tester_id')->widget(Select2::className(),[
        'data' => ArrayHelper::map(Tester::find()->all(),'id','tag'),
        'options' => ['placeholder' => 'Select a Tester ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Tag Number') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
