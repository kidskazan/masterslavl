<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Вход в личный кабинет";
$this->params["type_ticket"] = "Мастерславль"
?>

<?php $form = ActiveForm::begin(['id' => 'auth_form']); ?>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="formtable">
				<tr valign="middle" align="left" height="60">
					<td width="50%" align="right">
						
					</td>
					<td style="text-align: center;">
						EMAIL ИЛИ ТЕЛЕФОН&nbsp;<br>
						<?= Html::activeTextInput($model, 'username', ['class'=>'form-item req std-input', 'tabindex' => '1']) ?>
					</td>
					<td width="50%" align="right" rowspan="3">
						<div class="alrtWin">
							<div class="arr"></div>
							<div class="arr2"></div>
							<div class="t">Внимание!</div>
							<div class="b">
								Для покупки индивидуального посещения Вам необходимо войти в свой аккаунт.
								Если у вас нет аккаунта - создайте, нажав на <a href="index.php?r=online-pay/register">"Создать личный кабинет"</a>
							</div>
						</div>
					</td>
				</tr>
				<tr valign="middle" align="left" height="60">
					<td align="right">
						
					</td>
					<td style="text-align: center;">
						ПАРОЛЬ&nbsp;<br>
						<?= Html::activePasswordInput($model, 'password', ['class'=>'form-item req std-input', 'tabindex' => '2']) ?>
					</td>
				</tr>
				<tr valign="middle" align="left" height="60">
					<td align="right">
						
					</td>
					<td>
						<center><input type="submit" value="Войти" class="std-button-big" tabindex="3"/></center>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<center><a href="index.php?r=online-pay/register" class="gotologin">Создать личный кабинет</a></center>  
		</div>
	</div>
<?php ActiveForm::end(); ?>



 