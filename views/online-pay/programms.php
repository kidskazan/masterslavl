<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Программы";
?>

		
<div class="row">
		<?$ii = 1;?>
		<?foreach ($programms as $programm):?>
			<?php $form = ActiveForm::begin(['id' => 'programms'.$ii]); ?>
				<?= Html::activeHiddenInput($model, 'id_city', ['value' => '1']) ?>	
				<?
					$date1 = date("d.m.Y", $programm->start_date);
					$date2 = date("d.m.Y", $programm->end_date);
				?>
				<?= Html::activeHiddenInput($model, 'id_programm', ['value' => $programm->id]) ?>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<table cellpadding="0" cellspacing="0" border="0" width="100%" class="programtable">
						<tr valign="middle" align="left">
							<td width="50%" class="as">
								<div class="date"><?=$date1;?> - <?=$date2;?></div>
								
								<img src="<?=$programm->photo?>" width="100%"  alt=""/>
								
							</td>
							<td>
								<div class="textsmile">
									<?=$programm->description;?>
								</div>
								<table width="400px" class="pr_buy_table">
									<tr>
										<td width="200px">Дата</td>
										<td width="100px">Продолжительность</td>
										<td width="20px"><div>Детей</div></td>
									</tr>
									<tr>
										<td>
											<img src="assets2/images/calend-icon.png" class="calend-icon"/>
											<?= Html::activeTextInput($model, 'date', ['class'=>'form-item req std-input', 'id' => "datetimepicker$ii"]) ?>
											<script type="text/javascript">
													$(function () {
														var eDate = '30.09.2015';
														$('#datetimepicker<?=$ii;?>').datetimepicker({pickTime: false, language: 'ru', minDate: moment(), maxDate: eDate});
													});
													</script></td>
										<td>
											<?= Html::activeDropDownList($model, 'count_hours', $dt_type_day)?>
										</td>
										<td><?= Html::activeTextInput($model, 'count_kids', ['class'=>'form-item req std-input halfsize']) ?></td>
									</tr>
									<tr>
										<td colspan="3"><input type="submit"  value="Продолжить" class="std-button-big pr_btn"/></td>
									</tr>
								</table>
							</td>
						</tr>  									
					</table>
				</div>
				<?$ii++;?>
			<?php ActiveForm::end(); ?>
		<?endforeach;?>

</div>                        
						

				
