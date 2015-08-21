<?
    use xj\qrcode\QRcode;
    use xj\qrcode\widgets\Text;
    use xj\qrcode\widgets\Email;
    use xj\qrcode\widgets\Card;
?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>Билет</title>
<link href="tikets/css/style.css" rel="stylesheet" type="text/css">

</head>
<style>
        @font-face {
        font-family: 'epson1';
        src: url('tikets/fonts/epson1.eot');
        src: local('☺'), url('tikets/fonts/epson1.woff') format('woff'), url('tikets/fonts/epson1.ttf') format('truetype'), url('tikets/fonts/epson1.svg') format('svg');
        font-weight: normal;
        font-style: normal;
    }
    @font-face {
        font-family:ArialBold;
        src:url(tikets/fonts/ArialBold.ttf);
    }
    @font-face {
        font-family:Arial;
        src:url(tikets/fonts/Arial.ttf);
    }
</style>
<body>
	<div id="wrapper_line_1">
		<div class="center">
            <div class="text">ЭЛЕКТРОННЫЙ БИЛЕТ</div>
       	</div>
	</div>
    
    <div id="wrapper_line_2">
		<div class="center">
            <div class="left">
           	  <div class="logotext">
                	<div class="logo"><img src="tikets/img/wraper_line_2_logo.png" height="100" alt=""/></div>
                    <div class="text">ПРОЕЗДНОЙ ДОКУМЕНТ</div>
                    <label name="poizd" class="poizd"></label>
              </div>
              
              <table class="table1">
              		<tr >
                    	<td rowspan="2" class="cell1"><label name="name" class="textcell1"><?=$name;?></label><div>имя </br>фамилия </div> </td>
                        <td class="cell2"><label name="old" class="textcell2"><?=$old;?> ЛЕТ</label>возвраст</td>
                    </tr>                   
                    <tr>
                    	<td class="cell3"><label name="status" class="textcell3"><?=$name_tiket;?></label>статус</td>
                        
                    </tr>    	
                    <tr>
                    	<td class="cell4"><div class="text"><label name="time" class="textcell4"><?=$time;?> час.</label>время</div></td>
                        <td class="cell5"><div class="text"><label name="data" class="textcell5"><?=$date;?></label>дата</div></td>
                    </tr>
             </table>
             <table class="table2">
                    <tr">
                    	<td rowspan="4" class="cell6">
                            <div class="qrcode" id="qrcode">
                                <?
                                    echo Text::widget([
                                            'outputDir' => '@webroot/tikets/qrcode',
                                            'outputDirWeb' => '@web/tikets/qrcode',
                                            'ecLevel' => QRcode::QR_ECLEVEL_L,
                                            'text' => $qr,
                                            'size' => 4,
                                        ]);
                                ?>
                            </div>
                        </td>
                        <td class="cell7">А</td>
                        <td class="cell8"><label name="to" class="textcell8">МОСКВА-СИТИ</label>станция отправления</td>
                        <td class="cell9" rowspan="2"><label name="money" class="textcell9"><?=$price;?> р.</label>цена</td>
                    </tr>
                    <tr>
                    	<td class="cell10">Б</td>
						<td class="cell11"><label name="do" class="textcell11">ст. МАСТЕРСЛАВЛЬ</label>пункт назначения</td>
                    </tr>
                    <tr>
                    	<td colspan="3" class="cell12">&nbsp;</td>
                    </tr>
                    <tr>
                    	<td colspan="3" class="cell13"><label name="about" class="textcell14"></label><label name="about" class="textcell13"><?if ($pitanie == 1):?>Питание<?endif;?></label>доп.</br>отметки</td>
                    </tr>
              </table>
            </div>
            <div class="backgroundright">
            
            </div>
            <div class="right">
                <table>
                    <tr>
                        <td>&nbsp;
                        	                      
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	<div class="text">
                            	БАНКОВСКИЙ ЧЕК    
                            </div>                    
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="img">
                                <img src="tikets/img/wraper_line_2_firm.png" width="80" height="75" alt=""/>
                            </div>
                            <div class="namebank">
                            	<div class="name">Банк Города <textred>Мастерславля</textred></div>
                                <div class="street">Центральная пл. д. 2</div>  
                            </div>                   
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <div class="marka">
                           <label name="marka" class="markatext"><?=$money;?></label>
                   		   	<img src="tikets/img/wraper_line_2_marka.png" width="162" height="118" alt=""/> </div>                    
                      </td>
                    </tr>
                    <tr>
                        <td>
                           <div class="srok">
                           		<div class="left">Срок погашения</div>
                                <div class="right">с &nbsp; &nbsp; &nbsp;<img src="tikets/img/strelka.png" height="10" alt=""/>
                             <label name="date1" class="data"><?=$date;?></label></br></br>по &nbsp; &nbsp;<img src="tikets/img/strelka.png" height="10" alt=""/><label name="date2" class="data"><?=$date2;?></label></div>
                           </div>                    
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <div class="logo">
                   		   		<img src="tikets/img/henderson.jpg" height="40" alt=""/> 
                           </div>                    
                        </td>
                    </tr>
                </table>
            </div>
            
   	    </div>
	</div>
    
    <div id="wrapper_line_3">
		<div class="center">
            <div class="text">
                Билет действует только в распечатаном виде. Пожалуйста, покажите его при входе в "Мастерславль". Подробнее информацию вы можете получить по тел.: +7 (495) 788-58-35 и на сайте: www.masterslavl.ru. Ознакомтесь с правилами посещения.
            </div>
    	</div>
	</div>
    
    <div id="wrapper_line_4">
		<div class="center">
        	<div class="left">
            <div class="text">
            	Ради своей безопасности, здоровья, комфорта и приятного времяпрепровождения все Посетители детского города мастеров "Мастерславль" должны соблюдать Правила посещения (Публичная оферта) и всегда следовать указаниям персонала "Мастерславля".
            </div>
            <div class="text">
           		В "Мастерславле" запрещается находиться с громоздкими предметами, продуктами и в пачкающей одежде. Камера хранения и Гардероб располагаются на Вокзале.
            </div>
            <div class="text">
            	Запрещается проносить в "Мастерславль" оружие, огнеопасные и взрывоопасные материалы, колющие, режущие предметы, которые могут быть использованы для нанесения увечий.
            </div>
            <div class="text">
            	Запрещается проносить в "Мастерславль" и употреблять на территории "Мастерславля" спиртное, табак, наркотики.
            </div>
            <div class="text">
            	Запрещается любая форма проявления жестокости, насилия, агрессии
            </div>
            <div class="text">
            	Запрещается портить имущество Города, сорить в мастерских и на улицах.
            </div>
            <div class="text">
            	Запрещается осуществлять профессиональную фото- и видеосъемку без писменного разрешения Администрации.
            </div>
            </div>
            <div class="right">
            <div class="text">
            	Некоторые из наших мастерских предпологают наличие определенного уровня физической подготовки. Вы должны сами в зависимости от состояния своего здоровья своего ребенка определить степень риска при посещении каждой мастерской. Вы обязаны использовать предусмотренные в "Мастерславле" элементы активной и пасивной безопасности
            </div>
            
            <div class="text">Ради Вашей безопасности некоторые из наших мастерских имеют особые правила посещения и/или ограничения по возрасту ребенка, его росту и весу. Вход в любую мастерскую производится только с разрешения персонала.</div>
            
            <div class="text">Администрация не несет ответствености за несчастные случаи, возникшие вследствие нарушения посетителями Правил посещения.</div>
            
            <div class="text">За нарушения Правил посещения, угрожающие нормам безопасности и нравствености, Администрация вправе вывести нарушителя за територию "Мастерславля"</div>
            
            <div class="text">Оплата Билета означает принятие (акцепт) Правил посещения. С текстом Публичной оферты можно ознакомиться в кассовом зале и на сайте.</div>
            </div>
    		
            
            
    	</div>
	</div>
    
    <div id="wrapper_line_5">
		<div class="center">
    		<div class="text">
               Пресненская наб., д. 4, стр. 1.</br>
               Город мастеров "Мастерславль" находится в торговой галерее между станцией метро "Выставочная" и мостом Багратион в "Москва-Сити".
            </div>
    	</div>
	</div>
    
    <div id="wrapper_line_6">
		<div class="center">
        	<div class="left">
            	<h2>На метро</h2>
            		<div class="text">
                    	Станция "Выставочная" - выход из последнего вагона (о направлению из центра) к мосту Багратион. Станция "Деловой центр" - выход через станцыю "Выставочная" к мосту Багратион.
                    </div>
            	<h2>На машине</h2>
            	<div class="text">
                	Оставить автомобиль можно на подземной стоянке ТЦ "Афимолл" (въезд с Пресненской набережной по указателям). Из "Амфимолла" следует по указателям пройти ко вхожу на ст. м. "Выставочная" и, не заходя за турникеты, по галерее "Метро" (бесплатно) пройти к противоположному выходу со станции (к мосту Багратион.)
                </div>
            	<h2>На транспорте</h2>
            	<div class="text">
                	На наземном транспорте: автобус 12 - остановка "Деловой центр" далее пешком к мосту Багратион
                </div>
                </br>
                <div class="text">
                	Автобусы 840, 818, 205, 157, 116, 91; тролейбусы 39, 7, 2, 4; маршрутки 454, 474М, 10М, 506М, 753М, б/н (Киевская - МЭСИ), 560М - остановка "Ул. Дунаевского" (по Кутузовскому проспекту), далее - пешком через мост Багратион.
                </div>
            </div>
        	
    		<div class="img"><img src="tikets/img/wraper_line_6_img.png" width="525" alt=""/></div>
   	  </div>
	</div>
</body>
</html>
