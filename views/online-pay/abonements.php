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
                                            	<?php $form = ActiveForm::begin(['id' => 'sertificat_second', 'options'=>['class'=> 'block_grey']]); ?>
												<?= Html::activeHiddenInput($model, 'id_city', ['value' => '1']) ?>	
                                                	<h1>АБОНЕМЕНТ НА 2 ПОСЕЩЕНИЯ</h1>
													<span>О Боги, это самый лучший абонемент, который я когда-либо видел, спешите купить этот абонемент, он пригодится Вам в любую непогоду, несварение, плохое настроение - он исправит все недуги, ведь это - самый лучший абонемент на свете!!!</span>
                                                    <h2 onclick="alert('Hello')">КОЛ-ВО ДЕТЕЙ</h2>
                                                    <?= Html::activeTextInput($model, 'count_kids', ['class'=>'form-item req std-input halfsize', 'type'=>'number']) ?></br>
                                                    <input type="submit" value="Купить" class="std-button-big sert_btn"/>
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
		
		mResult = mKidsCount*1400 + mAdultsCount*700;
		
		$('.summ_sert').html('К ОПЛАТЕ: ' + mResult.toString() + ' руб.');
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
		
		mResult = mKidsCount*1400 + mAdultsCount*700;
		
		$('.summ_sert').html('К ОПЛАТЕ: ' + mResult.toString() + ' руб.');
	});
	

</script>

