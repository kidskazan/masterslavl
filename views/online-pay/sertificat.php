<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Сертификаты";
?>



<div class="row">
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="formtable">
			<tr valign="middle" align="left" height="40">
			<td width="25%">
			</td>
			
				<td width="50%">
                	<?php $form = ActiveForm::begin(['id' => 'sertificat_second', 'options'=>['class'=> 'block_grey']]); ?>
					<?= Html::activeHiddenInput($model, 'id_city', ['value' => '1']) ?>	
					<?= Html::activeHiddenInput($model, 'summ', ['value' => '0', 'id' => 'summ']) ?>	
                    	<h1>ПОДАРОЧНЫЙ СЕРТИФИКАТ</h1>
						<div class="s_about_p">Подарочный сертификат дает право на одно 4-часовое посещение Мастерславля в будний или выходной день (за исключением специальных городских мероприятий). Перед посещением сертификат необходимо обменять в кассе Мастерславля на билет.<br><br>Срок действия сертификата – 12 месяцев со дня покупки.</div>
                        <h2>КОЛ-ВО ДЕТЕЙ</h2>
                        <?= Html::activeTextInput($model, 'count_kids', ['class'=>'form-item req std-input halfsize', 'type'=>'number', 'value'=>0, 'min'=>0, 'max'=>100]) ?>
						<h2>КОЛ-ВО ВЗРОСЛЫХ</h2>
                        <?= Html::activeTextInput($model, 'count_adult', ['class'=>'form-item req std-input halfsize', 'type'=>'number', 'value'=>0, 'min'=>0, 'max'=>100]) ?>
						<div class="summ_sert">К ОПЛАТЕ: 0 руб.</div></br>
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
	
	$('#order-count_kids').keyup(function() {
		var mKidsCount = 0;
		var mAdultsCount = 0;
		var result = 0;
		if($(this).val() == "") {
			mKidsCount = 0;
		} else {
			mKidsCount = parseInt($(this).val());
		}
		
		if($('#order-count_adult').val() == "") {
			mAdultsCount = 0;
		} else {
			mAdultsCount = parseInt($('#order-count_adult').val());
		}
		
		var price_kids = <?=$p_kids->price;?>;
		var price_adult = <?=$p_adult->price;?>;
		mResult = mKidsCount*price_kids + mAdultsCount*price_adult;
		
		$('.summ_sert').html('К ОПЛАТЕ: ' + mResult.toString() + ' руб.');
		$("#summ").val(mResult);
	});
	
	$('#order-count_adult').keyup(function() {
		var mKidsCount = 0;
		var mAdultsCount = 0;
		var result = 0;
		if($('#order-count_kids').val() == "") {
			mKidsCount = 0;
		} else {
			mKidsCount = parseInt($('#order-count_kids').val());
		}
		
		if($('#order-count_adult').val() == "") {
			mAdultsCount = 0;
		} else {
			mAdultsCount = parseInt($('#order-count_adult').val());
		}
		
		var price_kids = <?=$p_kids->price;?>;
		var price_adult = <?=$p_adult->price;?>;
		mResult = mKidsCount*price_kids + mAdultsCount*price_adult;
		
		$('.summ_sert').html('К ОПЛАТЕ: ' + mResult.toString() + ' руб.');
		$("#summ").val(mResult);
	});
	

</script>

