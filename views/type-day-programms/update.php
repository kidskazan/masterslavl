<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TypeDayProgramms */

$this->title = 'Update Type Day Programms: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Type Day Programms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="type-day-programms-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
