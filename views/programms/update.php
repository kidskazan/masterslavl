<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Programms */

$this->title = 'Update Programms: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Programms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="programms-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
