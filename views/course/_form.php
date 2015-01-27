<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\GroupCourse;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Course */
/* @var $form yii\widgets\ActiveForm */
?>

<?//= var_dump($model->estimate_id) ?>
<div class="course-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'estimate_id')->widget(Select2::className(), [
        'data' => $model->selectEstimates,
        'options' => [
            'placeholder' => 'Select Estimates ...',
            'multiple' => true,
        ],

    ]);
    ?>

    <?= $form->field($model, 'groupcourse_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(GroupCourse::find()->all(),'id','name'),
        'options' => ['placeholder' => 'Select a Group of course ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
