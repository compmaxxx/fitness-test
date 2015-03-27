<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Estimate;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model app\models\Translation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="translation-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'estimate_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(Estimate::find()->all(),'id','name'),
        'options' => [
            'placeholder' => 'Select Estimates ...',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
        'disabled' => !$model->isNewRecord,
    ])
    ?>
<!--    --><?//= $form->field($model, 'condition_eval')->textInput(['maxlength' => 50]) ?>
<!---->
<!--    --><?//= $form->field($model, 'value')->textInput(['maxlength' => 100]) ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-arrow-down"></i> Conditions</h4></div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'dynamicItems' => '#form-evaluates',
                'dynamicItem' => '.form-evaluates-item',
                'model' => $modelForm[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'lower',
                    'lower_val',
                    'value',
                    'upper',
                    'upper_val',
                    'gender'
                ],
                'options' => [
                    'min' => 1,
                    'limit' => 15, // the maximum times, an element can be cloned (default 999)
                ]
            ]); ?>

            <div id="form-evaluates">
                <?php foreach ($modelForm as $i => $condition): ?>
                    <div class="form-evaluates-item panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left"></h3>
                            <div class="pull-right">
                                <button type="button" class="clone btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="delete btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            //                             necessary for update action.
                            //                            if (! $test->isNewRecord) {
                            //                                echo Html::activeHiddenInput($test, "[{$i}]id");
                            //                            }
                            ?>
                            <div class="col-md-10">
                                <div class="col-md-2">
                                    <?= $form->field($condition, "[{$i}]lower")->dropDownList(
                                        [
                                            '>' => '>',
                                            '>=' => '>=',
                                            '<' => '<',
                                            '<=' => '<=',
                                            '==' => '==',
                                        ]
                                    ) ?>
                                </div>
                                <div class="col-md-offset-1 col-md-2">
                                    <?= $form->field($condition, "[{$i}]lower_val")->textInput([
                                        'placeholder' => 'Number ...'
                                    ]) ?>
                                </div>

                                <div class="col-md-offset-1 col-md-6">
                                    <?= $form->field($condition, "[{$i}]value")->textInput([
                                        'placeholder' => 'Type text ...'
                                    ]) ?>
                                </div>

                                <div class="col-md-2">
                                    <?= $form->field($condition, "[{$i}]upper")->dropDownList(
                                        [
                                            '' => '',
                                            '<' => '<',
                                            '<=' => '<=',
                                            '==' => '==',
                                        ]
                                    ) ?>
                                </div>
                                <div class="col-md-offset-1 col-md-2">
                                    <?= $form->field($condition, "[{$i}]upper_val")->textInput([
                                        'placeholder' => 'Number ...'
                                    ]) ?>
                                </div>

                                <div class="col-md-12">
                                <?= $form->field($condition, "[{$i}]gender")->dropDownList(['all' => 'ทั้งหมด','male'=>'ชาย','female'=>'หญิง'])->label('Use For') ?>
<!--                                --><?//= $form->field($condition, "[{$i}]gender")->textInput() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
