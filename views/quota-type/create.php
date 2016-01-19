<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\QuotaType */

$this->title = 'Create Quota Type';
$this->params['breadcrumbs'][] = ['label' => 'Quota Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quota-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
