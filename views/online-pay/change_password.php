<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Сменить пароль";
?>



<div class="row">
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="formtable">
			<tr valign="middle" align="left" height="40">
			<td width="25%">
			</td>
			
				<td width="50%">
                	<?php $form = ActiveForm::begin(['id' => 'change-password', 'options'=>['class'=> 'block_grey']]); ?>
					
                    	<h1>Смена пароля</h1>
						<div class="s_about_p">Введите новый пароль и повторите его</div>
                        <h2>НОВЫЙ ПАРОЛЬ</h2>
                        <?= Html::activeTextInput($model, 'password', ['class'=>'form-item req std-input halfsize', 'type'=>'password']) ?>
						<h2>ПОВТОРИТЕ ПАРОЛЬ</h2>
                        <?= Html::activeTextInput($model, 'repassword', ['class'=>'form-item req std-input halfsize', 'type'=>'password']) ?>
						</br>
						</br>
                        <input type="submit" value="Сменить" class="std-button-big sert_btn" name="change"/>
                    <?php ActiveForm::end(); ?>
                </td>
				
			<td width="25%">
			</td>
			</tr>
            
			
		</table>
	</div>
</div>