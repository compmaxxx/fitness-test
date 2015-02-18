<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use app\models\Test;
use app\models\Tester;
use app\models\Course;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Result */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="result-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'course_id')->widget(Select2::className(),[
        'name' => 'course',
        'data' => ArrayHelper::map(Course::find()->where($model->isNewRecord? ['is_active' => Course::STATE_ACTIVE]:[])->all(),'id','name'),
        'options' => ['placeholder' => 'Select a Course ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>

    <?= $form->field($model, 'test_id')->widget(DepDrop::className(),[
        'type' => DepDrop::TYPE_SELECT2,
        'options' => ['placeholder' => 'Select a Test ...'],
        'select2Options'=>[
            'pluginOptions' => ['allowClear'=>true]
        ],
        'pluginOptions' => [
            'depends'   => [Html::getInputId($model,'course_id')],
            'url'       => Url::to(['result/list-course']),
            'loadingText' => 'Loading Test ...',
        ]

    ]) ?>

    <?= $form->field($model, 'tester_id')->widget(DepDrop::className(),[
        'type' => DepDrop::TYPE_SELECT2,
        'options' => ['placeholder' => 'Select a Tester ...'],
        'select2Options' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'pluginOptions' => [
            'depends'   => [Html::getInputId($model,'course_id')],
            'url'       => Url::to(['result/list-tester']),
            'loadingText' => 'Loading Tester ...',
        ]
    ])->label('Tag Number') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
