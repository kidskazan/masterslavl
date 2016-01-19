<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PriceAbonements */

$this->title = 'Update Price Abonements: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Price Abonements', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="price-abonements-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
