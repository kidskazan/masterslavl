<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Создать аккаунт";
$this->params["type_ticket"] = "Мастерславль"
?>

<?php $form = ActiveForm::begin(['id' => 'register_form']); ?>
	<div class="row">
		<div class="col-xs-0 col-sm-1 col-md-1 col-lg-1"></div>
		<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="formtable">
				<tr valign="middle" align="left" height="60">
					<td width="50%" align="right">
						<b>ФАМИЛИЯ:</b>&nbsp;
					</td>
					<td>
						<?= Html::activeTextInput($model, 'surname', ['class'=>'form-item req std-input']) ?>
						<?if (isset($error["surname"])):?>
						<b style="color: red;">*</b>
						<?endif;?>
					</td>
				</tr>
				<tr valign="middle" align="left" height="60">
					<td align="right">
						<b>ИМЯ:</b>&nbsp;
					</td>
					<td>
						<?= Html::activeTextInput($model, 'name', ['class'=>'form-item req std-input']) ?>
						<?if (isset($error["name"])):?>
						<b style="color: red;">*</b>
						<?endif;?>
					</td>
				</tr>
				<tr valign="middle" align="left" height="60">
					<td align="right">
						<b>ОТЧЕСТВО</b>:&nbsp;
					</td>
					<td>
						<?= Html::activeTextInput($model, 'father_name', ['class'=>'form-item req std-input']) ?>
						<?if (isset($error["father_name"])):?>
						<b style="color: red;">*</b>
						<?endif;?>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="formtable">
				<tr valign="middle" align="left" height="60">
					<td width="50%" align="right">
						<b>E-MAIL</b>:&nbsp;
					</td>
					<td>
						<?= Html::activeTextInput($model, 'email', ['class'=>'form-item req std-input']) ?>
						<?if (isset($error["email"])):?>
						<b style="color: red;">Неверный E-mail или данный E-mail уже зарегистрирован</b>
						<?endif;?>
					</td>
				</tr>
				<tr valign="middle" align="left" height="60">
					<td align="right">
						<b>ТЕЛЕФОН</b>:&nbsp;
					</td>
					<td>
						<?= Html::activeTextInput($model, 'phone', ['class'=>'form-item req std-input phone', 'placeholder' => '+7(___) ___-__-__']) ?>
					</td>
				</tr>
				<?if ($type_user == 2):?>
					<tr valign="middle" align="left" height="60">
						<td align="right">
							<b>Школа, №</b>:&nbsp;
						</td>
						<td>
							<?= Html::activeTextInput($model, 'school', ['class'=>'form-item req std-input']) ?>
							<?if (isset($error["school"])):?>
							<b style="color: red;">*</b>
							<?endif;?>
						</td>
					</tr>
				<?endif;?>
				<tr valign="middle" align="left" height="60">
					<td align="right">
						<b>ПАРОЛЬ</b>:&nbsp;
					</td>
					<td>
						<?= Html::activePasswordInput($model, 'password', ['class'=>'form-item req std-input']) ?>
						<?if (isset($error["password"])):?>
						<b style="color: red;">*</b>
						<?endif;?>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-xs-0 col-sm-1 col-md-1 col-lg-1"></div>
	</div>
	<div style="height:20px;"></div>
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<div class="pull-right"><a href="index.php?r=online-pay/auth" class="gotologin">&larr; Войти в аккаунт</a></div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<input type="submit" value="Создать" class="std-button-big"/>
		</div>
	</div>
<?php ActiveForm::end(); ?>
<script>
	$(function(){
		$('.phone').mask('+7(999) 999-99-99');
	});
</script>


 