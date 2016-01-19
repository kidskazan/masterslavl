<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PriceAbonements */

$this->title = 'Create Price Abonements';
$this->params['breadcrumbs'][] = ['label' => 'Price Abonements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-abonements-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
