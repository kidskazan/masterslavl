<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\QuotaTimeTable */

$this->title = 'Create Quota Time Table';
$this->params['breadcrumbs'][] = ['label' => 'Quota Time Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quota-time-table-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
