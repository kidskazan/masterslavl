<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'General Options';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="general-options-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create General Options', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'rus_name',
            'default_value',
            'value',
            'date1Text',
            'date2Text',
 
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
