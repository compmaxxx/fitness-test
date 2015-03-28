<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Course;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\InfoUser;

/* @var $this yii\web\View */
/* @var $model app\models\Tester */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tester-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'course_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(Course::find()->where($model->isNewRecord? ['is_active' => Course::STATE_ACTIVE]:[])->all(),'id','name') ,
        'options' => [
            'placeholder' => 'Select Course ...',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ])
    ?>
    <?=$form->field($model,'info_user_id')->textInput()->label('Student ID')?>
<!--    --><?//= $form->field($model, 'info_user_id')->widget(Select2::className(), [
//        'data' => ArrayHelper::map(InfoUser::find()->all(),'id','uniq_id') ,
//        'options' => [
//            'placeholder' => 'Select Course ...',
//        ],
//        'pluginOptions' => [
//            'allowClear' => true
//        ],
//
//    ])
//    ?>

    <?= $form->field($model, 'tag')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
