<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Мои заказы";
?>

		
			<div class="order-link2">
					<div style="width:210px">Тип билета</div>
					<div style="width:130px">Дата покупки</div>
					<div style="width:120px">Номер заказа</div>
					<div style="width:100px">Сумма</div>
					<div style="width:120px">Статус</div>									
				</div>
<?foreach ($orders as $order):?>
				<div class="order-link" url-link="/index.php?r=online-pay/finish&orderId=<?=$order->bankOrderId;?>">
					<div style="width:210px">Индивидуальное посещение</div>
					<div style="width:130px">20.10.2015</div>
					<div style="width:120px"><?=$order->id;?></div>
					<div style="width:100px"><?=$order->summ/100;?> руб.</div>
					<div style="width:120px">Не оплачен</div>									
				</div>
<?endforeach;?>


<script>
$('.order-link').click( function() {
    window.location = $(this).attr('url-link');
}).hover( function() {
    $(this).toggleClass('hover');
});
</script>