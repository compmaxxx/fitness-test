<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $modelEstimate app\models\Estimate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estimate-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($modelEstimate, 'name')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($modelEstimate, 'description')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($modelEstimate, 'cal')->textInput(['maxlength' => 300]) ?>
<!--    --><?php
//        foreach($model->tests as $index => $test){
//            echo "<label>$index</label>";
//            echo '<div class="col-md-offset-1">';
//            echo $form->field($test, "[$index]name")->textInput(['maxlength' => 200]);
//            echo $form->field($test, "[$index]unit")->textInput(['maxlength' => 50]);
//            echo $form->field($test, "[$index]isTime")->checkbox();
//            echo '</div>';
//        }
//    ?>
<!--    code dynamic form-->
    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-apple"></i> Tests</h4></div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'dynamicItems' => '#form-tests',
                'dynamicItem' => '.form-tests-item',
                'model' => $modelTests[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'name',
                    'unit',
                    'isTime',
                ],
                'options' => [
                    'min' => 1,
                    'limit' => 10, // the maximum times, an element can be cloned (default 999)
                ]
            ]); ?>

            <div id="form-tests">
                <?php foreach ($modelTests as $i => $test): ?>
                    <div class="form-tests-item panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Test</h3>
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
                            <?= $form->field($test, "[{$i}]name")->textInput() ?>
                            <?= $form->field($test, "[{$i}]unit")->textInput() ?>
                            <?= $form->field($test, "[{$i}]isTime")->dropDownList(['0' => 'No','1'=>'Yes'])->label('Is Time?') ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <!--    end code dynamic form-->
    <div class="form-group">
        <?= Html::submitButton($modelEstimate->isNewRecord ? 'Create' : 'Update', ['class' => $modelEstimate->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
