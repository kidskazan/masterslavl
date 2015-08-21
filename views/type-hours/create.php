<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TypeHours */

$this->title = 'Create Type Hours';
$this->params['breadcrumbs'][] = ['label' => 'Type Hours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-hours-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
