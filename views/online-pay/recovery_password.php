<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
$this->title = "Сменить пароль";
?>


<div class="row">
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="formtable">
			<tr valign="middle" align="left" height="40">
			<td width="25%">
			</td>
			
				<td width="50%">
                	<?php $form = ActiveForm::begin(['id' => 'recovery-password', 'options'=>['class'=> 'block_grey']]); ?>
					
                    	<h1>Смена пароля</h1>
						<div class="s_about_p">Введите адрес Вашей электронной почты и мы вышлем Вам ссылку на форму восстановления пароля</div>
                        <h2>E-MAIL</h2>
                        <?= Html::activeTextInput($model, 'email', ['class'=>'form-item req std-input halfsize', 'type'=>'text']) ?>
						</br>
						</br>
                        <input type="submit" value="Отправить" class="std-button-big sert_btn" name="recovery"/>
						</br>
						
                    <?php ActiveForm::end(); ?>
					
                </td>
				
			<td width="25%">
			</td>
			</tr>
            
			
		</table>
	</div>
</div>