<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "";
?>



<div class="row">
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="formtable">
			<tr valign="middle" align="left" height="40">
			<td width="25%">
			</td>
			
				<td width="50%">
                	<?php $form = ActiveForm::begin(['id' => 'abonement', 'options'=>['class'=> 'block_grey']]); ?>
					<?= Html::activeHiddenInput($model, 'id_city', ['value' => '1']) ?>	
                    	<h1>Абонемент на 5 посещений</h1>
						<div class="s_about_p">Абонемент дает право на пять 4-часовых посещений Мастерславля в будни и выходные дни (за исключением специальных городских мероприятий) в течение 6 месяцев со дня покупки. (7-14 лет)</div>
                        <h2 onclick="alert('Hello')">КОЛ-ВО ДЕТЕЙ</h2>
                        <?= Html::activeTextInput($model, 'count_kids', ['class'=>'form-item req std-input halfsize', 'type'=>'number']) ?>
						<br><br>
                        <input type="submit" value="Купить" class="std-button-big sert_btn" name="pay"/>
                    <?php ActiveForm::end(); ?>
                </td>
				
			<td width="25%">
			</td>
			</tr>
            
			
		</table>
	</div>
</div>

							
							

<script>
	function alert(txt)
	{
		return swal(txt);
	}
</script>

