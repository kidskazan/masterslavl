<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TypeDayProgramms */

$this->title = 'Create Type Day Programms';
$this->params['breadcrumbs'][] = ['label' => 'Type Day Programms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-day-programms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
