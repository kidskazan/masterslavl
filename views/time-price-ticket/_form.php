<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TimePriceTicket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="time-price-ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'startDateText')->textInput() ?>

    <?= $form->field($model, 'endDateText')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
