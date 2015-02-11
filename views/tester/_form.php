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

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'course_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(Course::find()->all(),'id','name') ,
        'options' => [
            'placeholder' => 'Select Course ...',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ])
    ?>

    <?= $form->field($model, 'tag')->textInput() ?>

    <?= $form->field($model, 'info_user_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(InfoUser::find()->all(),'id','uniq_id') ,
        'options' => [
            'placeholder' => 'Select Course ...',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ])->label('Uniq ID')
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
