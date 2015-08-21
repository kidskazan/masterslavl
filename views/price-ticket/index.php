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
 