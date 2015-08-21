<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GeneralOptions */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'General Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="general-options-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'rus_name',
            'default_value',
            'value',
            'date1Text',
            'date2Text',
        ],
    ]) ?>

</div>
