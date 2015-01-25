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

    <?= $form->field($model[0], 'estimate_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(Estimate::find()->all(),'id','name'),
        'options' => [
            'placeholder' => 'Select Estimates ...',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])?>
<!--    --><?//= $form->field($model, 'condition_eval')->textInput(['maxlength' => 50]) ?>
<!---->
<!--    --><?//= $form->field($model, 'value')->textInput(['maxlength' => 100]) ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-arrow-down"></i> Conditions</h4></div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'dynamicItems' => '#form-evaluates',
                'dynamicItem' => '.form-evaluates-item',
                'model' => $model[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'condition_eval',
                    'value',
                ],
                'options' => [
                    'min' => 1,
                    'limit' => 10, // the maximum times, an element can be cloned (default 999)
                ]
            ]); ?>

            <div id="form-evaluates">
                <?php foreach ($model as $i => $condition): ?>
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
                            <div class="col-md-9">
                                <div class="col-md-2">
                                    <?= $form->field($condition, "[{$i}]comparison1")->dropDownList(
                                        [
                                            '<',
                                            '<=',
                                            '==',
                                            '>',
                                            '>=',
                                            '!='
                                        ]
                                    ) ?>
                                </div>
                                <div class="col-md-offset-1 col-md-8">
                                    <?= $form->field($condition, "[{$i}]val1")->textInput() ?>
                                </div>

                                <div class="col-md-2">
                                    <?= $form->field($condition, "[{$i}]comparison2")->dropDownList(
                                        [
                                            '',
                                            '<',
                                            '<=',
                                            '==',
                                            '>',
                                            '>=',
                                            '!='
                                        ]
                                    ) ?>
                                </div>
                                <div class="col-md-offset-1 col-md-8">
                                    <?= $form->field($condition, "[{$i}]val2")->textInput() ?>
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
        <?= Html::submitButton($model[0]->isNewRecord ? 'Create' : 'Update', ['class' => $model[0]->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
