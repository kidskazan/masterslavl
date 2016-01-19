<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\QuotaType */

$this->title = 'Update Quota Type: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Quota Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="quota-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
