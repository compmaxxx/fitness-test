<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\Estimate;
use app\models\Result;


/* @var $this yii\web\View */
/* @var $model_info_user app\models\InfoUser */

$this->title = $model_info_user->uniq_id;
$this->params['breadcrumbs'][] = ['label' => 'Info Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model_info_user->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model_info_user->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

<!--    --><?//= print_r($assessments) ?>

    <?= DetailView::widget([
        'model' => $model_info_user,
        'attributes' => [
//            'id',
            'firstname',
            'lastname',
            'sex',
            'age',
            'uniq_id',
//            'nisit_ku',
        ],
    ]) ?>

<!--    --><?//= print_r($assessments)?>
        <?
        $estimates = ArrayHelper::map(Estimate::find()->all(),'id','name');
        $tests = ArrayHelper::map(\app\models\Test::find()->all(),'id','name');
        $dont_have = '<span style="color:red">ไม่มีค่า</span>'
        ?>
        <? foreach ($assessments as $index => $assessment) {
            echo '<h3>'.ArrayHelper::map(\app\models\Course::find()->all(),'id','name')[$index].'</h3>';
//            echo DetailView::widget([
//                'model' => $assessment,
//                'attributes' => [
//                    'result',
//                    'translation_result'
//                ]
//            ]);
            ?>
            <style>
                .cent th, .cent td {
                    text-align: center;
                }
            </style>
            <h5>ผลการทดสอบ</h5>
            <table border="2" class="cent" width="400px">
                <thead>
                    <tr>
                        <th>รายการ</th>
                        <th>ค่าการทดสอบ</th>
                    </tr>
                </thead>
                <?
                foreach ($assessment as $ass) {
                    $estimate_kk = Estimate::findOne($ass->estimate_id);
                    foreach ($estimate_kk->getTests()->all() as $test) {
                        $result= Result::find()->where([
                            'tester_id' => $ass->tester_id,
                            'test_id'   => $test->id,
                        ])->one();
                        ?>
                        <tr>
                            <td><?=$estimate_kk->name.'-'.$test->name?></td>
                            <td><?=$result==null? $dont_have:$result->value ?></td>
                        </tr>

                    <?
                    }
                }

                ?>
            </table>
            <h5>การคำนวณการประเมิน</h5>
            <table border="2" class="cent" width="400px">
                <thead>
                    <tr>
                        <th>รายการ</th>
                        <th>ผล</th>
                    </tr>
                </thead>
                <?
                foreach ($assessment as $ass) {
                    $estimate_kk = Estimate::findOne($ass->estimate_id);
                    ?>
                    <tr>
                        <td><?=$estimate_kk->name?></td>
                        <td><?=$ass->result==null? $dont_have:$ass->result ?></td>
                    </tr>
                <?
                }

                ?>
            </table>

            <h5>การประเมินผลการทดสอบ</h5>
            <table border="2" class="cent" width="400px">
                <thead>
                <tr>
                    <th>รายการ</th>
                    <th>ผล</th>
                </tr>
                </thead>
                <?
                foreach ($assessment as $ass) {
                    $estimate_kk = Estimate::findOne($ass->estimate_id);
                    ?>
                    <tr>
                        <td><?=$estimate_kk->name?></td>
                        <td><?=$ass->translation_result==null? $dont_have:$ass->translation_result ?></td>
                    </tr>
                <?
                }

                ?>
            </table>
        <?
        }
        ?>


</div>
