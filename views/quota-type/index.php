<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quota Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quota-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Quota Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'individual',
            'abonement',
            'programm',
            'sertificate',
            'meropriyatie',
            'shool_vizit',
            'corpototive_vizit',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
