<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use app\models\Course;
use yii\helpers\Url;
use app\models\Test;
use app\models\Tester;

/* @var $this yii\web\View */
/* @var $model app\models\Result */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs('
    $(document).ready(function(){
        $("#missing-form").submit(function() {
        $(".missing-group").removeClass("has-error");      //remove error class
        $(".help-block").html("");                      //remove existing error messages

        var form_data = $("#missing-form").serialize();
        var action_url = $("#missing-form").attr("action");

        $.ajax({
            method: "POST",
            url: action_url,
            data: form_data
        })
        .done(function( data ) {
            console.log(data);
            if(data.success == true)    {       //data saved successfully
                location.reload();
            }   else    {       //validation errors occurred
                   $.each(data.error, function(ind, vl) {      //show errors to user
                    $(".field-result-"+ind).addClass("has-error");
                    $(".field-result-"+ind).find(".help-block").html(vl[0]);
                });
            }

        });
        return false;
    });
    });', \yii\web\View::POS_READY, 'my-ajax-form-submit');


?>
<div class="result-form">

    <?php $form = ActiveForm::begin([
        'id' => 'missing-form',
        'enableClientValidation' => false,
    ]); ?>
    
    <?= $form->field($model, 'course_id')->widget(Select2::className(),[
        'data' => ArrayHelper::map(Course::find()->where('is_active = :active OR id = :id',[':active'=>Course::STATE_ACTIVE, ':id'=>$model->course_id])->all(),'id','name'),
        'options' => ['placeholder' => 'Select a Course ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>

    <?
    $tests = Test::find()/*->where(['id'=>$model->test_id])*/->all();
    foreach ($tests as $test) {
        $estimate_name = $test->getEstimate()->one()->name;
        $test->name = $estimate_name.' - '.$test->name;
    }

    ?>

    <?= $form->field($model, 'test_id')->widget(DepDrop::className(),[
        'data' => ArrayHelper::map($tests,'id','name'),
        'type' => DepDrop::TYPE_SELECT2,
        'options' => ['placeholder' => 'Select a Test ...'],
        'select2Options'=>[
            'pluginOptions' => ['allowClear'=>true]
        ],
        'pluginOptions' => [
            'depends'   => [Html::getInputId($model,'course_id')],
            'url'       => Url::to(['result-missing/list-test']),
            'loadingText' => 'Loading Test ...',

        ]

    ]) ?>

    <?= $form->field($model, 'tester_id')->widget(DepDrop::className(),[
        'data' => ArrayHelper::map(Tester::find()->where(['course_id'=>$model->course_id])->all(),'id','tag'),
        'type' => DepDrop::TYPE_SELECT2,
        'options' => ['placeholder' => 'Select a Tester ...'],
        'select2Options' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'pluginOptions' => [
            'depends'   => [Html::getInputId($model,'course_id')],
            'url'       => Url::to(['result-missing/list-tester']),
            'loadingText' => 'Loading Tester ...',

        ]
    ])
    ?>
    <div style="height: 110px">
    <?= $form->field($model, 'value', ['options' => ['class' => 'form-group col-md-8']])->textInput() ?>
    <?= $form->field($model, 'unit', ['options' => ['class' => 'form-group col-md-4']])->widget(DepDrop::className(),[
        'data' => ArrayHelper::map(Test::find()->where(['id'=>$model->test_id])->all(),'id','unit'),
        'type' => DepDrop::TYPE_SELECT2,
        'options' => ['placeholder' => 'Unit ...'],
        'select2Options' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'pluginOptions' => [
            'depends'   => [Html::getInputId($model,'test_id')],
            'url'       => Url::to(['result-missing/unit']),
            'loadingText' => 'Loading Unit ...',
            'initialize' => !$model->isNewRecord
        ],

    ])?>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
