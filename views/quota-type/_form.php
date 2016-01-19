<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\QuotaType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quota-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'individual')->textInput() ?>

    <?= $form->field($model, 'abonement')->textInput() ?>

    <?= $form->field($model, 'programm')->textInput() ?>

    <?= $form->field($model, 'sertificate')->textInput() ?>

    <?= $form->field($model, 'meropriyatie')->textInput() ?>

    <?= $form->field($model, 'shool_vizit')->textInput() ?>

    <?= $form->field($model, 'corpototive_vizit')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
