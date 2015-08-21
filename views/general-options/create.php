<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GeneralOptions */

$this->title = 'Create General Options';
$this->params['breadcrumbs'][] = ['label' => 'General Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="general-options-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
