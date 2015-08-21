<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "";
$i = 0;?>

<div style="height:10px;"></div>
<div class="buttons">
<a href="index.php?r=online-pay/save-all&order_id=<?=$order_id;?>" class="download">СКАЧАТЬ ВСЕ БИЛЕТЫ</a>
<a href="index.php?r=online-pay/view-all&order_id=<?=$order_id;?>" class="print">НАПЕЧАТАТЬ ВСЕ БИЛЕТЫ</a>
</div>
<div class="tickets">
    <div class="text">
        БИЛЕТЫ ДЛЯ ДЕТЕЙ
    </div>
    <div class="forms">
            <?foreach ($kids as $val):?>
                <?if ($i == 2) $i = 0;?>
                <?if ($i == 0): ?>
                    <div class="twoforms">
                <?endif;?>
                <div class="form">
                    <div class="money" >
                        <?=$val["summ"];?> РУБ
                    </div> 
                    <div class="name">
                        <?=$val["name"];?>
                    </div>
                    <div class="datatext">
                        Дата посещения:
                    </div>
                    <div class="data">
                        <?=date("d.m.Y", $order->date);?>
                    </div>
                 
                    <a href="/index.php?r=online-pay/tikets&id=<?=$val['id_rel'];?>">
                        <div class="download">
                        открыть билет </div>
                    </a>
                </div>
                <?$i++;?>
                <?if ($i == 2): ?>
                    </div>
                <?endif;?>
            <?endforeach;?>
    </div>
 </div>
 <?if (count($adults) > 0):?>
     <div class="tickets">
        <div class="text">
            БИЛЕТЫ ДЛЯ ВЗРОСЛЫХ
        </div>
        <div class="forms">
                <?$i = 0;?>
                <?foreach ($adults as $val):?>
                    <?if ($i == 2) $i = 0;?>
                    <?if ($i == 0): ?>
                        <div class="twoforms">
                    <?endif;?>
                    <div class="form">
                        <div class="money" >
                            <?=$val["summ"];?> РУБ
                        </div> 
                        <div class="name">
                             <?=$val["name"];?>
                        </div>
                        <div class="datatext">
                            Дата посещения:
                        </div>
                        <div class="data">
                            <?=date("d.m.Y", $order->date);?>
                        </div>
                     
                        <a href="/index.php?r=online-pay/tikets&id=<?=$val['id_rel'];?>">
                            <div class="download">
                            открыть билет </div>
                        </a>
                    </div>
                    <?$i++;?>
                    <?if ($i == 2): ?>
                        </div>
                    <?endif;?>
                <?endforeach;?>
        </div>
     </div>  
 <?endif;?> 