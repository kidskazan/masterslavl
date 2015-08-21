<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Type Tickets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-ticket-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Type Ticket', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'age_min',
            'age_max',
            'name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
