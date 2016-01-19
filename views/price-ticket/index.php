<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;


$this->title = 'Price Tickets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-ticket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'notes'])?>
    	<?php $form = ActiveForm::begin(); ?>
    		<h3>Тип 1</h3>
            <table class="table" style="width: 100%;">
    			<tr>
    				<td><b>Часы</b></td>
    				<?foreach($dt_type_hours as $i):?> 
    					<td><b><?=$i;?></b></td>
    				<?endforeach;?>
    			</tr>
    			<tr>
    				<td colspan="<?=count($dt_type_hours) + 1;?>"><b>Будни</b></td>
    			</tr>
    			<?foreach ($TypeTicket as $key => $val):?>
    				<tr>
    					<td><?=$val->name;?></td>
    					<?foreach($dt_type_hours as $i => $v2):?> 
    						<?
    							if (isset($dt_val[1][$val->id][$i]))
    								$vv = $dt_val[1][$val->id][$i];
    							else
    								$vv = 0;
    						?>
    						<td><?=HTML::activeTextInput($model, "price[1][$val->id][$i]", ['style' => 'width: 100%;', 'value' => $vv]);?></td>
    					<?endforeach;?>
    					<?
							if (isset($dt_val[1][$val->id][10]))
								$vv = $dt_val[1][$val->id][10];
							else
								$vv = 0;
						?>
    				</tr>
    			<?endforeach;?>
                <tr>
                    <td colspan="<?=count($dt_type_hours) + 1;?>"><b>Выходные</b></td>
                </tr>
                <?foreach ($TypeTicket as $key => $val):?>
                    <tr>
                        <td><?=$val->name;?></td>
                        <?foreach($dt_type_hours as $i => $v2):?> 
                            <?
                                if (isset($dt_val[2][$val->id][$i]))
                                    $vv = $dt_val[2][$val->id][$i];
                                else
                                    $vv = 0;
                            ?>
                            <td><?=HTML::activeTextInput($model, "price[2][$val->id][$i]", ['style' => 'width: 100%;', 'value' => $vv]);?></td>
                        <?endforeach;?>
                        <?
                            if (isset($dt_val[2][$val->id][10]))
                                $vv = $dt_val[2][$val->id][10];
                            else
                                $vv = 0;
                        ?>
                    </tr>
                <?endforeach;?>
    		</table>
            <h3>Тип 2</h3>
            <table class="table" style="width: 100%;">
                <tr>
                    <td><b>Часы</b></td>
                    <?foreach($dt_type_hours as $i):?> 
                        <td><b><?=$i;?></b></td>
                    <?endforeach;?>
                </tr>
                <tr>
                    <td colspan="<?=count($dt_type_hours) + 1;?>"><b>Будни</b></td>
                </tr>
                <?foreach ($TypeTicket as $key => $val):?>
                    <tr>
                        <td><?=$val->name;?></td>
                        <?foreach($dt_type_hours as $i => $v2):?> 
                            <?
                                if (isset($dt_val2[1][$val->id][$i]))
                                    $vv = $dt_val2[1][$val->id][$i];
                                else
                                    $vv = 0;
                            ?>
                            <td><?=HTML::activeTextInput($model2, "price[1][$val->id][$i]", ['style' => 'width: 100%;', 'value' => $vv]);?></td>
                        <?endforeach;?>
                        <?
                            if (isset($dt_val2[1][$val->id][10]))
                                $vv = $dt_val2[1][$val->id][10];
                            else
                                $vv = 0;
                        ?>
                    </tr>
                <?endforeach;?>
                <tr>
                    <td colspan="<?=count($dt_type_hours) + 1;?>"><b>Выходные</b></td>
                </tr>
                <?foreach ($TypeTicket as $key => $val):?>
                    <tr>
                        <td><?=$val->name;?></td>
                        <?foreach($dt_type_hours as $i => $v2):?> 
                            <?
                                if (isset($dt_val2[2][$val->id][$i]))
                                    $vv = $dt_val2[2][$val->id][$i];
                                else
                                    $vv = 0;
                            ?>
                            <td><?=HTML::activeTextInput($model2, "price[2][$val->id][$i]", ['style' => 'width: 100%;', 'value' => $vv]);?></td>
                        <?endforeach;?>
                        <?
                            if (isset($dt_val[2][$val->id][10]))
                                $vv = $dt_val[2][$val->id][10];
                            else
                                $vv = 0;
                        ?>
                    </tr>
                <?endforeach;?>
            </table>
            <hr>
			
			<h3>Тип 3</h3>
            <table class="table" style="width: 100%;">
                <tr>
                    <td><b>Часы</b></td>
                    <?foreach($dt_type_hours as $i):?> 
                        <td><b><?=$i;?></b></td>
                    <?endforeach;?>
                </tr>
                <tr>
                    <td colspan="<?=count($dt_type_hours) + 1;?>"><b>Будни</b></td>
                </tr>
                <?foreach ($TypeTicket as $key => $val):?>
                    <tr>
                        <td><?=$val->name;?></td>
                        <?foreach($dt_type_hours as $i => $v2):?> 
                            <?
                                if (isset($dt_val3[1][$val->id][$i]))
                                    $vv = $dt_val3[1][$val->id][$i];
                                else
                                    $vv = 0;
                            ?>
                            <td><?=HTML::activeTextInput($model3, "price[1][$val->id][$i]", ['style' => 'width: 100%;', 'value' => $vv]);?></td>
                        <?endforeach;?>
                        <?
                            if (isset($dt_val3[1][$val->id][10]))
                                $vv = $dt_val3[1][$val->id][10];
                            else
                                $vv = 0;
                        ?>
                    </tr>
                <?endforeach;?>
                <tr>
                    <td colspan="<?=count($dt_type_hours) + 1;?>"><b>Выходные</b></td>
                </tr>
                <?foreach ($TypeTicket as $key => $val):?>
                    <tr>
                        <td><?=$val->name;?></td>
                        <?foreach($dt_type_hours as $i => $v2):?> 
                            <?
                                if (isset($dt_val3[2][$val->id][$i]))
                                    $vv = $dt_val3[2][$val->id][$i];
                                else
                                    $vv = 0;
                            ?>
                            <td><?=HTML::activeTextInput($model3, "price[2][$val->id][$i]", ['style' => 'width: 100%;', 'value' => $vv]);?></td>
                        <?endforeach;?>
                        <?
                            if (isset($dt_val[2][$val->id][10]))
                                $vv = $dt_val[2][$val->id][10];
                            else
                                $vv = 0;
                        ?>
                    </tr>
                <?endforeach;?>
            </table>
            <hr>
			
			
            <h3>Прайс программы:</h3>
                <table class="table" style="width: 100%;">
                    <tr>
                        <td><b>Дни/Программы</b></td>
                        <?foreach($programms_type_day as $val):?> 
                            <td><b><?=$val->name;?></b></td>
                        <?endforeach;?>
                    </tr>
                    <?foreach($programms as $programm):?>
                        <tr>
                            <td><b><?=$programm->name;?></b></td>
							<?foreach($programms_type_day as $type_day):?>
								<?
									if (isset($dt_val_programms[$programm->id][$type_day->id]))
										$vv = $dt_val_programms[$programm->id][$type_day->id];
									else
										$vv = 0;
								?>
								<td><?=HTML::activeTextInput($model_programms, "programms[$programm->id][$type_day->id]", ['style' => 'width: 100%;', 'value' => $vv]);?></td>
							<?endforeach;?>
                        </tr>
                    <?endforeach;?>
                </table>
            <hr>
            <h3>Доп. прайс:</h3>
            <table class="table" style="width: 30%;">
                <?foreach ($DopPrice as $val):?>
                    <tr>
                        <td><b><?=$val->rus_name;?></b></td>
                        <td><?=HTML::activeTextInput($model_dop_price, $val->name, ['style' => 'width: 100%;', 'value' => $val->price]);?></td>
                    </tr>
                <?endforeach?>
            </table>
    		 <div class="form-btn">
                <div class="field"><?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary']) ?></div>
            </div>
    	<?php ActiveForm::end(); ?>
    <?php Pjax::end()?>
</div> 
 