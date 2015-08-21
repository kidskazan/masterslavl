<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "";
?>

<div style="height:10px;"></div>
<? /*
<?php $form = ActiveForm::begin(['id' => 'select_city__form']); ?>
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<table cellpadding="0" cellspacing="0" border="0" class="formtable" style="margin-left: calc(137%);">
				<tr valign="middle" align="right">
					<td width="50%" align="left">
						<b>ГОРОД:</b>&nbsp;
					</td>
				<tr/> 
				<tr valign="middle" align="right">
					<td style="margin-bottom: 20px; display: block;">
						<?= Html::activeDropDownList($model, 'id_city', $city, ['class'=>'form-item req std-input']) ?>
						<?if (isset($error["id_city"])):?>
						<b style="color: red;">*</b>
						<?endif;?>
					</td>
				</tr>
				<tr valign="middle" align="left"> 
					<td align="left">
						<b>ДАТА:</b>&nbsp;
					</td>
				<tr/>
				<tr valign="middle" align="left">
					<td style="margin-bottom: 20px; display: block;">
						
					</td>
				</tr>
				<tr valign="middle" align="left">
					<td align="left">
						<b>КОЛ-ВО ПОСЕТИТЕЛЕЙ ДЕТЕЙ:</b>&nbsp;
					</td>
				<tr/>
				<tr valign="middle" align="left">
					<td style="margin-bottom: 20px; display: block;">
						<?= Html::activeTextInput($model, 'count_kids', ['class'=>'form-item req std-input halfsize']) ?>
						<?if (isset($error["count_kids"])):?>
						<b style="color: red;">*</b>
						<?endif;?>
						<div class="subtext">
					</td>
				</tr>
				<tr valign="middle" align="left">
					<td align="left">
						<b>КОЛ-ВО ПОСЕТИТЕЛЕЙ ВЗРОСЛЫХ:</b>&nbsp;
					</td>
				<tr/>
				<tr valign="middle" align="left">
					<td style="margin-bottom: 20px; display: block;">
						<?= Html::activeTextInput($model, 'count_adult', ['class'=>'form-item req std-input halfsize']) ?>
						<?if (isset($error["count_adult"])):?>
						<b style="color: red;">* <?=$msg["count_adult"];?></b>
						<?endif;?>
					</td>
				</tr>
				<tr valign="middle" align="left">
					<td align="left">
						<b>ВРЕМЯ:</b>&nbsp;
					</td>
				<tr/>
				<tr valign="middle" align="right">
					<td style="margin-bottom: 20px; display: block;">
						<?= Html::activeDropDownList($model, 'count_hours', $type_hours, ['class'=>'form-item req std-input']) ?>
						<?if (isset($error["count_hours"])):?>
						<b style="color: red;">*</b>
						<?endif;?>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			
		</div>
	</div>
	<div style="height:40px;"></div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<center><input type="submit" value="Продолжить &rarr;" class="std-button-big"/></center>
		</div>
	</div>
<?php ActiveForm::end(); ?>
*/?>
<?php $form = ActiveForm::begin(['id' => 'select_city__form']); ?>
	<?= Html::activeHiddenInput($model, 'id_city', ['value' => '1']) ?>
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="formtable">
				<tr valign="middle" align="left" height="40">
					<td width="40%"></td>
					<td>
						<b>ДАТА:</b>	
					</td>
				</tr>
				<tr valign="middle" align="left" height="40">
                	<td></td>
					<td>
						<img src="assets2/images/calend-icon.png" class="calend-icon"/>
						<?= Html::activeTextInput($model, 'date', ['class'=>'form-item req std-input', 'id' => "datetimepicker1"]) ?>
						<?if (isset($error["date"])):?>
						<b style="color: red;">*</b>
						<?endif;?>
						<script type="text/javascript">
							$('#datetimepicker1').datetimepicker({pickTime: false, language: 'ru'});
						</script>
					</td>
				</tr>
				<tr valign="middle" align="left" height="40">
					<td align="right"></td>
					<td>
						<b>ВРЕМЯ ПОСЕЩЕНИЯ:</b> 
					</td>
				</tr>
				<tr valign="middle" align="left" height="40">
					<td align="right"></td>
					<td class="inp_radio">
					<? $i = 1; $txt = "";?>
					<?foreach ($type_hours as $k => $v):?>
						<? 
							if ($i != 1) $txt = "";
							if (count($type_hours) == $i) $txt = "";
						?>
						<input type="radio" for="radio<?=$txt;?>" id="radio<?=$k;?>" name="Order[count_hours]" value="<?=$k;?>"><label for="radio<?=$k?>" value="<?=$v;?>"></label>
						<?$i++;?> 
                    <?endforeach;?>
            		<?if (isset($error["count_hours"])):?>
					<b style="color: red;">*</b>
					<?endif;?>
					</td>
				</tr>
                <tr valign="middle" align="left">
					<td align="right"></td>
					<td>
						
					</td>
				</tr>
                <tr valign="middle" align="left"height="40">
					<td align="right"></td>
					<td>
						<b>КОЛ-ВО ПОСЕТИТЕЛЕЙ:</b>
					</td>
				</tr>
                <tr valign="middle" align="left">
					<td align="right"></td>
					<td>
						<div class="quantitytext">ДЕТЕЙ</div><div class="quantitytext"> ВЗРОСЛЫХ </div> 
					</td>
				</tr>
                <tr valign="middle" align="left">
					<td align="right"></td>
					<td>
						<?= Html::activeTextInput($model, 'count_kids', ['class'=>'form-item req std-input halfsize']) ?>
						<?if (isset($error["count_kids"])):?>
						<b style="color: red;">*</b>
						<?endif;?>
                        <?= Html::activeTextInput($model, 'count_adult', ['class'=>'form-item req std-input halfsize']) ?>
                        <?if (isset($error["count_adult"])):?>
						<b style="color: red;">* <?=$msg["count_adult"];?></b>
						<?endif;?>
					</td>
				</tr>
				<tr valign="middle" align="left">
					<td align="right"></td>
					<td>


					</td>
				</tr>
			</table>
		</div>
	</div>
	<div style="height:20px;"></div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<center><input type="submit" value="Продолжить &rarr;" class="std-button-big"/></center>
		</div>
	</div>
<?php ActiveForm::end(); ?>
<script>
	$(function(){
		$("#datetimepicker1").change(function(){
			date = $(this).val();
			$(".inp_radio").html("");
			$.ajax({
				url: "index.php?r=online-pay/edit-date-select-city",
				data: 
				{
					'date': date
				}, 
				success: function(data){
					result = jQuery.parseJSON(data);

					if (result.status == "ok")
					{
						var txt = "";
						var i = 0;
						$.each(result.result, function(key, val) {
		                   i++;

		                   txt += "<input type='radio' for='radio' id='radio" + key + "' name='Order[count_hours]' value='" + key + "'>";
		                   txt += "<label for='radio" + key + "' value='" + val + "'></label>"; 
		                });

		                $(".inp_radio").html(txt);
					}
				}
			});
		});
	});
</script>


 