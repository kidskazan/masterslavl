<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "";
?>

<div style="height:10px;"></div>
<?php $form = ActiveForm::begin(['id' => 'select_city__form']); ?>
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="formtable">
				<tr valign="middle" align="left" height="60">
					<td width="50%" align="right">
						<b>ГОРОД:</b>&nbsp;
					</td>
					<td>
						<?= Html::activeDropDownList($model, 'id_city', $city, ['class'=>'form-item req std-input']) ?>
						<?if (isset($error["id_city"])):?>
						<b style="color: red;">*</b>
						<?endif;?>
					</td>
				</tr>
				<tr valign="middle" align="left" height="60">
					<td align="right">
						<b>ДАТА:</b>&nbsp;
					</td>
					<td>
						<img src="assets2/images/calend-icon.png" class="calend-icon"/>
						<?= Html::activeTextInput($model, 'date', ['class'=>'form-item req std-input', 'id' => "datetimepicker1"]) ?>
						<?if (isset($error["date"])):?>
						<b style="color: red;">* <?=$msg["date"];?></b>
						<?endif;?>
						<script type="text/javascript">
							$('#datetimepicker1').datetimepicker({pickTime: false, language: 'ru'});
						</script>
					</td>
				</tr>
				<tr valign="middle" align="left" height="60">
					<td align="right">
						<b>КОЛ-ВО ПОСЕТИТЕЛЕЙ ДЕТЕЙ:</b>&nbsp;
					</td>
					<td>
						<?= Html::activeTextInput($model, 'count_kids', ['class'=>'form-item req std-input halfsize']) ?>
						<?if (isset($error["count_kids"])):?>
						<b style="color: red;">* <?=$msg["count_kids"];?></b>
						<?endif;?>
					</td>
				</tr>
				<tr valign="middle" align="left" height="60">
					<td align="right">
						<b>КОЛ-ВО ПОСЕТИТЕЛЕЙ ВЗРОСЛЫХ:</b>&nbsp;
					</td>
					<td>
						<?= Html::activeTextInput($model, 'count_adult', ['class'=>'form-item req std-input halfsize']) ?>
						<?if (isset($error["count_adult"])):?>
						<b style="color: red;">* <?=$msg["count_adult"];?></b>
						<?endif;?>
					</td>
				</tr>
				<tr valign="middle" align="left" height="60">
					<td align="right">
						<b>ВРЕМЯ:</b>&nbsp;
					</td>
					<td>
						<?= Html::activeDropDownList($model, 'count_hours', $type_hours, ['class'=>'form-item req std-input']) ?>
						<?if (isset($error["count_hours"])):?>
						<b style="color: red;">*</b>
						<?endif;?>
					</td>
				</tr>
				<tr valign="middle" align="left" height="60">
					<td align="right">
						<b>КЛАСС:</b>&nbsp;
					</td>
					<td>
						<?= Html::activeTextInput($model, 'klass', ['class'=>'form-item req std-input halfsize']) ?>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			 
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<img src="assets2/images/masterslavl.png"/>
		</div>
	</div>
	<div style="height:40px;"></div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<center><input type="submit" value="Продолжить &rarr;" class="std-button-big"/></center>
		</div>
	</div>
<?php ActiveForm::end(); ?>


 