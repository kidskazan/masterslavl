<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TypeHours */

$this->title = 'Update Type Hours: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Type Hours', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="type-hours-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
