<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tester */
$info_user = $model->getInfoUser()->one();
$title = $model->getCourse()->one()->name;
if($info_user!=null){
    $title .= '::'.$info_user->uniq_id;
}
$this->title = 'Update Tester: ' . ' ' .$title;
$this->params['breadcrumbs'][] = ['label' => 'Testers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tester-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
