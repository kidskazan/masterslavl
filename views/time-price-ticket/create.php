<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TimePriceTicket */

$this->title = 'Create Time Price Ticket';
$this->params['breadcrumbs'][] = ['label' => 'Time Price Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="time-price-ticket-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
