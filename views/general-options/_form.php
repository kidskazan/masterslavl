<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GeneralOptions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="general-options-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rus_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'default_value')->textInput() ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'date1Text')->textInput() ?>

    <?= $form->field($model, 'date2Text')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
