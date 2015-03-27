<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Course */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<!--        --><?//= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::a('Delete', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ]) ?>
        <?= Html::a('Create Tag', ['/tester/create', 'course_id' => $model->id], ['class' => 'btn btn-success','target'=>'_blank']);
        ?>
    </p>

    <?
        $estimates = \app\models\Estimate::find()->join('INNER JOIN','add_course','estimate.id = add_course.estimate_id')->where(['course_id' => $model->id])->all();

        $estimates_name = join(', ',ArrayHelper::getColumn($estimates,'name'));

    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Group Course',
                'value' => $model->getGroupcourse()->one()->name,
            ],
            'name',
            'location',
            [
                'label' => 'Estimates',
                'value' => $estimates_name
            ],
            'create_date',
            'is_active',
        ],
    ]) ?>

</div>
