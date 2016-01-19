<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Оформление билетов";
?>


<div style="height:10px;"></div>
<?php $form = ActiveForm::begin(['id' => 'enter_people_form']); ?>
		<div class="row" style="padding:0px 15px;">
			<b>Дата посещения: </b><input type="text" name="col-pos" class="std-input big datarozhdenia datetimepicker" id="date_enter" name="date_enter" value="<?=$date_enter;?>"/>&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<b> Время посещения: </b>
			<span style="position: absolute; margin-left: 10px;" class="inp_radio">
			<? $i = 1;?>
			<?foreach ($type_hours as $k => $v):?>
				<input type="radio" for="radio" id="radio<?=$k;?>" name="Order[count_hours]" value="<?=$k;?>" class="radio_hours" <?if ($k==$count_hours):?> checked="checked" <?endif;?>>
				<label for="radio<?=$k?>" value="<?=$v;?>"></label>
				<?$i++;?> 
            <?endforeach;?>
        	</span>
		</div>
		<div id="kids_map" style="width: 100%;">
			<h2 style="text-align: center; width: 100%;">Введите информацию о детях</h2>
			<div class="pull-right">
				<a id="add_kids" href="#">Добавить посетителя</a>
			</div>
			<div style="height:20px;"></div>
			<div class="row" id="kids_users"> 
				<?if ($count_kids == 0) $count_kids = 1;?>
				<?for ($i=1; $i <= $count_kids; $i++):?>
					<div class="col-xs-12 col-sm-60 col-md-3 col-lg-3 person_container" data-person="<?=$i;?>" type-person="kids">
						<div class="person">
							<div class="cl">&times;</div>
							<div class="t">Ребенок</div>
							<input placeholder="Фамилия" type="text" class="familia std-input-100">
							<input placeholder="Имя" type="text" class="imya std-input-100">
							<input placeholder="Отчество" type="text" class="otchestvo std-input-100">
							<input placeholder="Дата рождения" type="text" class="calendinput datarozhdenia std-input-100">
							<input placeholder="+7(___) ___-__-__" type="text" class="telefon std-input-100 phone" title="Текст ТекстТекстТекстТекстТекстТекст">
							<!--<input type="checkbox" id="pitanie_<?=$i;?>" class="check"/><label for="pitanie_<?=$i;?>" class="lab_check">Питание</label>-->
							<input type="hidden" class="type" value="2">
							<input type="hidden" class="status" value="no">
							<input type="hidden" class="secondstatus" value="kid-no">
							<input type="hidden" class="agestatus" value="no">
							<input type="hidden" class="id_rel" value="">
							<div style="height:33px;"></div>
							<center><button class="submitperson std-button-gold">Подтвердить</button></center>
						</div>
						<div class="person-submitted">
							<input type="hidden" name="person[1][familia]"/>
							<input type="hidden" name="person[1][imya]"/>
							<input type="hidden" name="person[1][otchestvo]"/>
							<input type="hidden" name="person[1][datarozhdenia]"/>
							<input type="hidden" name="person[1][telefon]"/>
							<!--<input type="hidden" name="person[1][pitanie]"/>-->
							<input type="hidden" name="person[1][abonement]"/>
							<input type="hidden" name="person[1][podarok]"/>
							<div class="cl">&times;</div>
							<div class="t">Ребенок</div>
							<div class="st"><img src="assets2/images/person-st.png"/></div>
							<div class="name"></div>
							<div class="price"><div class="sub">Сумма:</div><span class="int"></span> руб</div>
							<center><div class="edit">Редактировать</div></center>
						</div>
					</div>
				<?endfor;?>
			</div>
		</div>
		<hr style="border: 1px solid black;">
		<div id="adult_map" style="width: 100%; margin-bottom: 20px;">
			<h2 style="text-align: center; width: 100%;">Введите информацию о взрослых</h2>
			<div class="pull-right">
				<a id="add_adult" href="#">Добавить посетителя</a>
			</div>
			<div style="height:20px;"></div>
			<div class="row" id="adult_users">
				<?if ($count_adult >= 1):?>
					<?for ($i=1; $i <= $count_adult; $i++):?>
						<div class="col-xs-12 col-sm-60 col-md-3 col-lg-3 person_container" data-person="<?=$i;?>" type-person="adult" type-adult="1">
							<div class="person">
								<div class="cl">&times;</div>
								<div class="t">Взрослый</div>
								<input placeholder="Фамилия" type="text" class="familia std-input-100">
								<input placeholder="Имя" type="text" class="imya std-input-100">
								<input placeholder="Отчество" type="text" class="otchestvo std-input-100">
								<input placeholder="Дата рождения" type="text" class="calendinput datarozhdenia std-input-100">
								<input placeholder="+7(___) ___-__-__" type="text" class="telefon std-input-100 phone">
								<input type="hidden" class="type" value="1">
								<input type="hidden" class="status" value="no">
								<input type="hidden" class="secondstatus" value="parent-no">
								<input type="hidden" class="id_rel" value="">
								<div style="height:20px;"></div>
								<center><button class="submitperson std-button-gold">Подтвердить</button></center>
							</div>
							<div class="person-submitted">
								<input type="hidden" name="person[1][familia]"/>
								<input type="hidden" name="person[1][imya]"/>
								<input type="hidden" name="person[1][otchestvo]"/>
								<input type="hidden" name="person[1][datarozhdenia]"/>
								<input type="hidden" name="person[1][telefon]"/>
								<!--<input type="hidden" name="person[1][pitanie]"/>-->
								<input type="hidden" name="person[1][abonement]"/>
								<input type="hidden" name="person[1][podarok]"/>
								<input type="hidden" class="escortstatus" value="no">
								<div class="cl">&times;</div>
								<div class="t">Взрослый</div>
								<div class="st"><img src="assets2/images/person-st.png"/></div>
								<div class="name"></div>
								<div class="price"><div class="sub">Сумма:</div><span class="int"></span> руб</div>
								<center><div class="edit">Редактировать</div></center>
							</div>
						</div>
					<?endfor;?>
				<?endif;?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="pull-right">
					<!--- <input type="submit" value="Забронировать" class="std-button-big-grey" onclick="return false;"/> -->
					<input type="submit" value="Оплатить" class="std-button-big biggg" name="pay" id="btn_click"/>
					<input type="hidden" name="sum_pay" id="sum_pay">
				</div>
				<div class="big-price">ОБЩАЯ СТОИМОСТЬ БИЛЕТОВ: <span id="total">0</span> руб</div>
			</div>
			<br><br><br>
			<div class="agreement">Нажимая кнопку “ОПЛАТИТЬ”, Вы соглашаетесь<br>с договором <a href="#" onclick="showOferta()" target="_blank" class="">публичной оферты</a></div>
			<br><br>
			<div class="block_grey" style="height:auto; padding:30px;">
				<div class="img"><img src="assets2/images/visaandmaster.png"></div><div class="text2">На оформление платежа Сбербанком выделяется 20 минут, поэтому, пожалуйста, приготовьте Вашу пластиковую карту заранее.<br>Если Вам не хватит выделенного на оплату времени или в случае отказа в авторизации карты Вы сможете повторить процедуру оплаты.</div>
				<div class="text">
					В случае оплаты или бронирования заказа, проведение платежа по заказу производится непосредственно после его оформления. После завершения оформления заказа, Вы должны будете нажать на кнопку «Оплатить», при этом система переключит Вас на страницу авторизационного сервера, где Вам будет предложено ввести данные пластиковой карты, инициировать ее авторизацию, после система уведомит Вас о результатах авторизации. В случае подтверждения авторизации Ваш заказ будет автоматически выполнен в соответствии с заданными Вами условиями и внесенной информацией. В случае отказа в авторизации карты Вы сможете повторить процедуру оплаты.<br><br><br>

					Для оплаты или бронирования заказа Вы будете перенаправлены на платежный шлюз ОАО "Сбербанк России" для ввода реквизитов Вашей карты. Пожалуйста, приготовьте Вашу пластиковую карту заранее. Соединение с платежным шлюзом и передача информации осуществляется в защищенном режиме с использованием протокола шифрования SSL. В случае если Ваш банк поддерживает технологию безопасного проведения интернет-платежей Verified By Visa или MasterCard Secure Code для проведения платежа также может потребоваться ввод специального пароля. Способы и возможность получения паролей для совершения интернет-платежей Вы можете уточнить в банке, выпустившем карту.
				</div>
			</div>
		</div>
		<script>
		function showOferta() {
			console.log("oferta");
			event.preventDefault();
					$('#overlay').fadeIn(400,function(){$('#popup3').css('display', 'block').animate({opacity: 1, top: '50%'}, 200);
							});
			$('#popup3').css({'display':'block','position':'fixed'}).animate({opacity: 1, top: '50%'}, 200);
		}
		
		function closeOferta() {
			$('#popup3')
				.animate({opacity: 0, top: '45%'}, 200,
				function(){
					$(this).css('display', 'none');
					$('#overlay').fadeOut(400);
				}
			);
		}
		$(document).ready(function() {

            $('#close, #overlay').click( function(){
                $('#popup')
                        .animate({opacity: 0, top: '45%'}, 200,
                        function(){
                            $(this).css('display', 'none');
                            $('#overlay').fadeOut(400);
                        }
                );

				$('#popup3')
					.animate({opacity: 0, top: '45%'}, 200,
					function(){
						$(this).css('display', 'none');
						$('#overlay').fadeOut(400);
					}
				);
            });

        });
		</script>
		<div id="popup3" style="display:none;background:#f5f5f5;padding:10px; top:-100%;" >
			<span id="close"><img src="assets2/images/close.png" onclick="closeOferta()" width="14" height="14" alt=""/></span>
        	<div class="dogovor">
				<p style="text-align: center;" class="big"><b>Об оказании услуг по организации мероприятий по профессиональному ориентированию и просвещению детей на территории ЗАО &laquo;Мастерславль&raquo;, расположенного по адресу:</b> </p>
 
<p style="text-align: center;"> 123317, Москва, Пресненская набережная, д. 4, стр. 1</p>
 <blockquote><blockquote> 
    <p style="text-align: left;"></p>
   
    <p style="text-align: left;"> </p>
   
    <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><span style="font-size: 9pt; font-family: Arial,sans-serif; border: 1pt none windowtext; padding: 0cm;">г. Москва<span>                                                                                                                                            </span><span>                </span><span>                </span>06 июня 2014 г.</span></p>
   
    <p></p>
   </blockquote></blockquote> 
<p></p>
 
<p> </p>
 
<div class="WordSection2"> 
  <p align="center" class="MsoNormal" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;"><b><span style="font-size: 8pt; font-family: Arial,sans-serif; border: 1pt none windowtext; padding: 0cm;">ПУБЛИЧНАЯ ОФЕРТА</span></b><b><span style="font-size: 8pt; font-family: Arial,sans-serif;"></span></b></p>
 
  <p align="center" class="MsoNormal" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;"><b><span style="font-size: 8pt; font-family: Arial,sans-serif; border: 1pt none windowtext; padding: 0cm;">об оказании услуг по организации мероприятий по</span></b><b><span style="font-size: 8pt; font-family: Arial,sans-serif;"> профессиональному ориентированию и просвещению детей </span></b><b><span style="font-size: 8pt; font-family: Arial,sans-serif; border: 1pt none windowtext; padding: 0cm;">на территории ЗАО &laquo;Мастерславль&raquo;, расположенного по адресу:</span></b><b><span style="font-size: 8pt; font-family: Arial,sans-serif;"> 
        <br />
       </span></b><span style="font-size: 8pt; font-family: Arial,sans-serif; color: rgb(34, 34, 34); background-image: none; background-attachment: scroll; background-color: white; background-position: 0% 0%; background-repeat: repeat repeat;">123317, Москва, Пресненская набережная, д. 4, стр. 1</span><b><span style="font-size: 8pt; font-family: Arial,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p class="MsoNormal" style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;"><span style="font-size: 8pt; font-family: Arial,sans-serif;"> </span></p>
 
  <p style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Закрытое акционерное общество &laquo;Мастерславль&raquo; (именуемое в дальнейшем Организатор) предлагает заключить настоящий договор на основании ст.ст. 435, 437 Гражданского Кодекса Российской Федерации физическим лицам (именуемым в дальнейшем Посетитель) на следующих условиях: </span></p>
 
  <p align="center" style="margin: 0cm 0cm 0.0001pt 14.2pt; text-align: center; text-indent: -14.2pt; line-height: normal;" class="ColorfulList-Accent11"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>1.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span></b><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Термины и определения</span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>1.1.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Акцепт Оферты </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&ndash; приобретение Билета (в том числе Электронного билета).<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.25pt; text-align: justify; text-indent: -21.25pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>1.2.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Билет </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&ndash; документ, приобретенный в кассах СДЦ или в терминалах оплаты билетов СДЦ, удостоверяющий право Посетителя на посещение Мероприятия, содержащий информацию о наименовании, дате, времени, месте проведения и Организаторе Мероприятия, стоимости услуги посещения Мероприятия, а также дополнительную информацию правового или технического характера.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>1.3.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Посетитель </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&ndash; физическое лицо, акцептирующее Оферту путем покупки Билета (Электронного билета).<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>1.4.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Интернет-сайт Организатора </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&ndash; сайт в сети Интернет, расположенный по адресу: </span><a href="http://www.masterslavl.ru" ><span lang="EN-US" style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">www</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">.</span><span lang="EN-US" style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">masterslavl</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">.</span><span lang="EN-US" style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">ru</span></a><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>1.5.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Мероприятие </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&ndash; мероприятие по профессиональному ориентированию и </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">просвещению детей, их адаптации к жизни в современном обществе, знакомству с традиционными ценностями российского общества, с культурой благотворительности, осознанием гражданской и социальной ответственности,</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> проводимое Организатором.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>1.6.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Организатор </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">&ndash; ЗАО &laquo;Мастерславль&raquo;, разместившее Оферту.</span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>1.7.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Оферта </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&ndash; настоящая публичная оферта об организации <span style="border: 1pt none windowtext; padding: 0cm;">мероприятий по</span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> профессиональному ориентированию и просвещению детей</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">, опубликованная на Интернет-сайте Организатора.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>1.8.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Правила посещения СДЦ </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&ndash; обязательные для исполнения Правила посещения Посетителем Мероприятий, опубликованные в электронном виде на Интернет-сайте Организатора и доступные для ознакомления на входе СДЦ.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>1.9.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">СДЦ </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&ndash; семейный досуговый центр &laquo;Мастерславль&raquo;, расположенный по адресу </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; color: rgb(34, 34, 34); background: white none repeat scroll 0% 0%;">г. Москва, Пресненская набережная, д. 4, стр. 1.</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>1.10.<span style="font: 7pt &quot;Times New Roman&quot;;">  </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Стороны </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&ndash; Организатор и Посетитель, именуемые совместно.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>1.11.<span style="font: 7pt &quot;Times New Roman&quot;;">  </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Электронный билет </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&ndash; электронный документ либо документ на бумажном носителе, приобретенный на Интернет-сайте Организатора, удостоверяющий право Посетителя на посещение Мероприятия, содержащий штрих-код, фамилию, имя и отчество Посетителя, информацию о наименовании, дате, времени, месте проведения и Организаторе Мероприятия, стоимости услуги посещения Мероприятия, а также дополнительную информацию правового или технического характера.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p align="center" style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: center; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>2.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span></b><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Предмет договора</span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>2.1.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Оферта регламентирует отношения Сторон, возникающие при приобретении Билета (Электронного билета) и посещении Мероприятия.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>2.2.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Факт приобретения Билета (Электронного билета) Посетителем, является безусловным и полным принятием условий Оферты и Правил посещения СДЦ. Посетитель, приобретший Билет (Электронный билет), считается заключившим договор с Организатором на оказание услуг по организации Мероприятия.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>2.3.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Частичный акцепт, а равно акцепт на иных условиях не допускается.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>2.4.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Оферта вступает в силу с даты ее размещения на Интернет-сайте Организатора, в зоне входа в СДЦ и действует бессрочно.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>2.5.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Организатор имеет право вносить изменения в Оферту, сделав их доступными на Интернет-сайте Организатора и в зоне входа в СДЦ. Данные изменения вступают в силу с момента их размещения на Интернет-сайте Организатора.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>2.6.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Организатор вправе расторгнуть настоящий договор в любое время без предварительного уведомления Посетителя в случае нарушения последним его условий и Правил посещения СДЦ.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><a name="_Ref384891973" ><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>2.7.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетитель при покупке Билета (Электронного билета) в соответствии с Федеральным законом от 27.07.2006 №152-ФЗ &laquo;О персональных данных&raquo; соглашается с обработкой Организатором своих персональных данных и данных о несовершеннолетнем посетителе, в пользу которого приобретается Билет (Электронный билет), а именно фамилии, имени, отчества, возраста, телефонного номера и адреса электронной почты, с целью исполнения Организатором настоящего договора.</span></a><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span>2.8.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетитель, покупающий Электронный билет, дающий свое согласие на получение на адрес электронной почты, указанный при регистрации на Интернет-сайте Организатора, новостей и иных сообщений о деятельности Организатора, вправе в любое время отказаться о получения этих сообщений, пройдя по ссылке &quot;отказаться от рассылки&quot;, содержащейся в каждом письме от Организатора</span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span>2.9.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Настоящий договор завершает свое действие по окончании Мероприятия в срок, указанный в Билете (Электронном билете).</span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>2.10.<span style="font: 7pt &quot;Times New Roman&quot;;">  </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Неявка Посетителя на Мероприятие, в указанное в Билете (Электронном билете) время и дату, не отменяет и не приостанавливает проведение Мероприятия и не предоставляет Посетителю права на посещение других Мероприятий или права на возврат денежных средств за Билет (Электронный Билет).<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"> </span></p>
 
  <p align="center" style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: center; text-indent: -14.2pt; line-height: normal;" class="ColorfulList-Accent11"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span></b><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Права и обязанности Сторон</span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.1.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span> </span>Организатор обязуется:<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.1.1.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Предоставлять Посетителю услуги по организации Мероприятия на условиях Оферты.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.1.2.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Информировать Посетителя о любых внесенных изменениях и дополнениях относительно Мероприятий путем размещения информации на Интернет-сайте Организатора.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.1.3.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Не разглашать персональные данные Посетителя и не предоставлять к ним доступ третьим лицам, за исключением случаев, предусмотренных действующим законодательством РФ.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.1.4.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Предоставить Посетителю возможность получения информации о Мероприятиях на Интернет-сайте Организатора.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.25pt; text-align: justify; text-indent: -21.25pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.2.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Организатор имеет право:<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.2.1.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">В одностороннем порядке изменять условия Оферты, путем размещения информации на Интернет-сайте Организатора и в кассе СДЦ.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.2.2.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Требовать от Посетителя и лиц, сопровождаемых Посетителем, соблюдения Правил посещения СДЦ.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.2.3.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">В любое время производить модификацию любого программного обеспечения системы СДЦ, в том числе Интернет-сайта Организатора, приостанавливать работу программных средств, обеспечивающих функционирование Интернет-сайта Организатора, при обнаружении существенных неисправностей, ошибок и сбоев, а также в целях проведения профилактических работ и предотвращения случаев несанкционированного доступа к Интернет-сайту Организатора.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.2.4.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Устанавливать и изменять тарифы на свои услуги в одностороннем порядке и в любое время.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.2.5.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Отказать Посетителю в продаже Билета (Электронного билета) в случае отказа сообщить о себе и (или) несовершеннолетнем посетителе, в пользу которого приобретается Билет (Электронный билет), персональные данные, указанные в п. </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">2.7</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> Оферты.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.2.6.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Отказать Посетителю, не достигшему семилетнего возраста, пришедшему без сопровождения </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">взрослого (для целей настоящего договора понимается лицо, достигшее 15 лет)</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> сопровождающего, в доступе на Мероприятие.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.2.7.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; color: black;">Организатор имеет право проводить фото и видео съемку на территории СДЦ и использовать полученные изображения в любых целях, не запрещенных законодательством РФ.</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.3.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетитель обязуется:<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.3.1.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">До момента акцепта Оферты ознакомиться с её условиями, Правилами посещения СДЦ и тарифами, указанными на Интернет-сайте СДЦ.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span>3.3.2.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Обеспечить несовершеннолетних в возрасте до 6 (шести) лет включительно, желающих посетить Мероприятие, взрослым сопровождающим.</span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.3.3.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Своевременно и в полном объеме оплачивать услуги по организации Мероприятия.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.3.4.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Нести ответственность за действия несовершеннолетних, в интересах которых он приобретает Билеты (Электронные билеты). <span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.3.5.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">При покупке Билета (Электронного билета) предоставить верную, точную и полную информацию о себе или о несовершеннолетнем, в пользу которого покупается Билет (Электронный билет). Посетитель признает, что он несет полную ответственность за данные, сообщаемые Организатору. Посетитель признает, что не имеет никаких претензий к Организатору за некорректно оформленный Электронный билет, в случае сообщения недостоверной информации.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.3.6.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Сообщить Организатору о наличии у себя и (или) несовершеннолетнего, в пользу которого приобретается Билет (Электронный билет) заболеваний (аллергических, желудочно-кишечных, опорно-двигательных и иных), обострение которых в процессе участия в Мероприятии может повлечь причинение вреда здоровью Посетителю и(или) несовершеннолетнему. Посетитель признает, что не имеет никаких претензий к Организатору за вред здоровью, причиненный в случае невыполнения данной обязанности.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.3.7.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Самостоятельно и за свой счет заблаговременно, до посещения СДЦ, осуществить распечатку Электронного билета или в целях распечатки такого билета предъявить в кассах или терминалах оплаты СДЦ код, предоставляемый при оплате Электронного билета. При осуществлении самостоятельной печати Электронного билета Посетитель должен убедиться в надлежащем качестве печати Электронного билета,<span>  </span>а именно в том, что в распечатанном Электронном билете содержатся и правильно отражены все данные, необходимые для идентификации Посетителя и<span>  </span>сопровождаемого им несовершеннолетнего или несовершеннолетнего посещающего мероприятие без сопровождения (ФИО, адрес, телефон), Мероприятия (дата, время), а также все прочие символы и знаки, содержащиеся в Электронном билете. В случае неисполнения или ненадлежащего исполнения обязанности, установленной настоящим пунктом, Посетитель в полной мере несет ответственность за подобные действия (бездействия), в том числе в случае отказа Организатором в проходе на Мероприятие. Организатор не несет ответственности за какие-либо убытки, возникающие у Посетителя, в случае нарушения условий настоящего пункта.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.4.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетитель имеет право:<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="1"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span>3.4.1.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетить Мероприятие на условиях настоящего договора.</span></p>
 
  <p align="center" style="margin: 0cm 0cm 0.0001pt 14.2pt; text-align: center; text-indent: -14.2pt; line-height: normal;" class="ColorfulList-Accent11"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>4.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span></b><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Ответственность Сторон</span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>4.1.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">В случае неисполнения или ненадлежащего исполнения своих обязательств, предусмотренных настоящим договором, Стороны несут ответственность в соответствии с действующим законодательством Российской Федерации и условиями настоящего договора.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>4.2.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Ответственность Организатора перед Посетителем в случае отмены, замены или переноса Мероприятия ограничивается стоимостью приобретенного Билета (Электронного билета).<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>4.3.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Организатор не несет ответственности за несоответствие Мероприятия ожиданиям Посетителя и/или его субъективной оценке. Советы и рекомендации, предоставляемые Посетителю, не могут рассматриваться как гарантии.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>4.4.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Организатор не несет ответственности за любые убытки и моральный вред, понесенные Посетителем в результате ошибочного понимания или непонимания им информации о порядке оформления/оплаты Билета (Электронного билета), а также получения и использования услуг по настоящему договору.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>4.5.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; color: black; background: white none repeat scroll 0% 0%;">Организатор не несет ответственности за вред, причиненный жизни и здоровью Посетителя </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">или несовершеннолетнего, в чью пользу Посетителем был приобретен Билет (Электронный билет)<span style="color: black; background: white none repeat scroll 0% 0%;"> в случае ненадлежащего исполнения им обязательств по настоящему договору, нарушения требований сотрудников Организатора, а также Правил посещения СДЦ.</span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>4.6.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Стороны освобождаются от ответственности за полное или частичное неисполнение своих обязательств по Оферте, если такое неисполнение явилось следствием обстоятельств непреодолимой силы, то есть чрезвычайных и непредотвратимых при данных условиях обстоятельств. К обстоятельствам непреодолимой силы, в частности, относятся: стихийные бедствия, военные действия, забастовки, действия и решения государственных органов власти (включая, но не ограничиваясь: запрет перевозок, валютные ограничения, запрет на проведение развлекательных мероприятий, объявление траура и т.п.), сбои, возникающие в телекоммуникационных и энергетических сетях.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>4.7.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Организатор не несет ответственности за работоспособность и (или) защищенность информационных каналов связи, используемых Посетителем для обращения к Интернет-сайту Организатора.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>4.8.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">В случае причинения вреда Посетителем или несовершеннолетним, в чью пользу Посетителем был приобретен Билет (Электронный билет), имуществу Исполнителя или оборудованию СДЦ Посетитель обязуется возместить его в полном объеме в течение 10 (Десяти) рабочих дней со дня предъявления соответствующего требования.</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></p>
 
  <p align="right" style="margin: 0cm 0cm 0.0001pt; text-align: right; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
 
  <p align="right" style="margin: 0cm 0cm 0.0001pt; text-align: right; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
 
  <p align="right" style="margin: 0cm 0cm 0.0001pt; text-align: right; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
 
  <p align="right" style="margin-bottom: 0.0001pt; text-align: right; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Приложение №1 к публичной оферте</span></b></p>
 
  <p align="right" style="margin-bottom: 0.0001pt; text-align: right; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">об оказании услуг по организации мероприятий </span></b></p>
 
  <p align="right" style="margin-bottom: 0.0001pt; text-align: right; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">по профессиональному ориентированию и просвещению детей</span></b></p>
 
  <p align="right" style="margin-bottom: 0.0001pt; text-align: right; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">на территории ЗАО &laquo;Мастерславль&raquo;, расположенного по адресу:</span></b></p>
 
  <p align="right" style="margin-bottom: 0.0001pt; text-align: right; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">123317, Москва, Пресненская набережная, д. 4, стр. 1</span></p>
 
  <p align="right" style="margin-bottom: 0.0001pt; text-align: right; line-height: normal;" class="MsoNormal"><i><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"> </span></i></p>
 
  <p align="right" style="margin-bottom: 0.0001pt; text-align: right; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"> </span></p>
 
  <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">ПРАВИЛА ПОСЕЩЕНИЯ</span></b></p>
 
  <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Семейного досугового центра &laquo;Мастерславль&raquo;</span></b></p>
 
  <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"> </span></b></p>
 
  <p style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Настоящие Правила обязательны к выполнению всеми лицами, находящимися на территории СДЦ &laquo;Мастерславль&raquo; (далее &ndash; Правила) и являются неотъемлемой частью Публичной Оферты об оказании услуг по организации мероприятий по профессиональному ориентированию и просвещению детей на территории ЗАО &laquo;Мастерславль&raquo;, расположенного по адресу: 123317, Москва, Пресненская набережная, д. 4, стр. 1, утвержденной Генеральным директором ЗАО &laquo;Мастерславль&raquo; Помочилиным М.В. 06 июня 2014 года.</span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 14.2pt; text-align: justify; text-indent: -14.2pt; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span>1.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span></b><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">При применении настоящих Правил используются следующие термины и определения:</span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span>1.1.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Администрация </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&ndash; должностные лица, осуществляющие оперативное управление деятельностью СДЦ.</span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>1.2.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Билет </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&ndash; документ, приобретенный в кассах СДЦ или в терминалах оплаты билетов СДЦ, удостоверяющий право Посетителя на посещение Мероприятия, содержащий информацию о наименовании, дате, времени, месте проведения и Организаторе Мероприятия, стоимости услуги посещения Мероприятия, а также дополнительную информацию правового или технического характера.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span>1.3.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Мастерская</span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> &ndash; как правило, отдельное помещение, используемое для знакомства Посетителей с той или иной конкретной профессией, и её более углубленного изучения в игровой форме.</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span>1.4.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Мастер-классы</span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> &ndash; второй тип занятий в СДЦ (кроме Базовых занятий), проходит по расписанию по определенной тематике.</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span>1.5.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Мероприятие </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&ndash; мероприятие по профессиональному ориентированию и </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">просвещению детей, их адаптации к жизни в современном обществе, знакомству с традиционными ценностями российского общества, с культурой благотворительности, осознанием гражданской и социальной ответственности,</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> проводимое Организатором.</span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span>1.6.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Организатор </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">&ndash; ЗАО &laquo;Мастерславль&raquo;.</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span>1.7.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Посетитель </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&ndash; физическое лицо, приобретшее Билет (Электронный билет) и (или) несовершеннолетний в пользу которого приобретен Билет (Электронный билет).</span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span>1.8.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">СДЦ </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&ndash; семейный досуговый центр &laquo;Мастерславль&raquo;, расположенный по адресу </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; color: rgb(34, 34, 34); background: white none repeat scroll 0% 0%;">г. Москва, Пресненская набережная, д. 4, стр. 1.</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span>1.9.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Электронный билет </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&ndash; электронный документ либо документ на бумажном носителе, приобретенный на Интернет-сайте Организатора, удостоверяющий право Посетителя на посещение Мероприятия, содержащий штрих-код, фамилию, имя и отчество Посетителя, информацию о наименовании, дате, времени, месте проведения и Организаторе Мероприятия, стоимости услуги посещения Мероприятия, а также дополнительную информацию правового или технического характера. </span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.25pt; text-align: justify; text-indent: -21.25pt; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span>2.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span></b><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Фактом приобретения билета (Электронного билета) Посетитель дает свое согласие на безусловное соблюдение настоящих правил. Настоящие правила посещения СДЦ обязательны для исполнения для всех Посетителей.</span></b></p>
 
  <p align="center" style="margin: 0cm 0cm 0.0001pt 35.7pt; text-align: center; text-indent: -17.85pt; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span></b><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Основные правила посещения:</span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.1.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Проход в помещение СДЦ осуществляется строго по Билетам (Электронным билетам);<b><span style="border: 1pt none windowtext; padding: 0cm;"></span></b></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.2.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетители до 4-х лет &ndash; допускаются в помещение СДЦ только в сопровождении взрослого (начиная с 15 лет) и при посещении СДЦ вторым ребенком 4-х лет и выше;</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.3.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; color: rgb(34, 34, 34); background: white none repeat scroll 0% 0%;">В Мастерские допускаются только Посетители, достигшие пятилетнего возраста. Посетители, достигшие четырехлетнего возраста, допускаются в Мастерские только с разрешения Администрации;</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.4.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетители от 5 до 6-ти летнего (до 6 лет включительно) возраста &ndash; допускаются в помещение СДЦ только в сопровождении взрослого (начиная с 15 лет). Лица, сопровождающие Посетителей, указанных в п.п. 3.2, 3.3 и 3.4. настоящих правил, вправе с согласия Администрации покинуть СДЦ до завершения Мероприятия только при наступлении обстоятельств, которые они не могли предвидеть при приобретении Билета (Электронного билета);</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.5.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетители от 7 до 14 лет (до 14 лет включительно) &ndash; допускаются в помещение СДЦ без сопровождения взрослого;</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.6.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетители от 15 лет и старше &ndash; могут находиться в городе только в качестве сопровождающих и в этой роли могут принимать участие только в работе мастерских для взрослых; 15 летние и старше являющиеся сопровождающими не могут покидать территорию СДЦ, если сопровождают детей с особенностями физического развития;</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.7.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Организованные школьные группы &ndash; допускаются в помещение СДЦ при сопровождении как минимум одного совершеннолетнего (старше 18 лет);</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.8.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Число сопровождающих лиц на одного ребенка не должно превышать 2х человек;</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.9.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Для детей с особенностями физического развития &ndash; количество детей на одного сопровождающего оговаривается отдельно с Администрацией;</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.10.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Во время нахождения в помещении СДЦ Посетители обязаны соблюдать и поддерживать общественный порядок, общепринятые нормы поведения и правила пожарной безопасности. В том случае если во время нахождения в помещении СДЦ поведение Посетителя создает неудобства для остальных Посетителей СДЦ, Администрация имеет право отказать такому Посетителю в оказании услуг и требовать от него незамедлительно покинуть помещение СДЦ;<b><span style="border: 1pt none windowtext; padding: 0cm;"></span></b></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.11.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Администрация убедительно просит Посетителей бережно относиться к имуществу СДЦ и других Посетителей. В случае порчи или хищения имущества СДЦ Администрация вправе требовать от Посетителей возмещения причиненного ущерба в рамках действующего законодательства Российской Федерации;<b><span style="border: 1pt none windowtext; padding: 0cm;"></span></b></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.12.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетители обязаны вести себя уважительно по отношению к другим Посетителям Мероприятия, обслуживающему персоналу и сотрудникам охраны;<b><span style="border: 1pt none windowtext; padding: 0cm;"></span></b></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.13.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетители обязаны не допускать действий, создающих опасность для окружающих;<b><span style="border: 1pt none windowtext; padding: 0cm;"></span></b></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.14.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетители обязаны выполнять законные распоряжения сотрудников Администрации, сотрудников охраны СДЦ и правоохранительных органов;<b><span style="border: 1pt none windowtext; padding: 0cm;"></span></b></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.15.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетителям рекомендуется незамедлительно сообщать сотрудникам СДЦ и сотрудникам охраны СДЦ обо всех случаях обнаружения подозрительных предметов, вещей, и обо всех случаях возникновения задымления или пожара;<b><span style="border: 1pt none windowtext; padding: 0cm;"></span></b></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.16.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">При получении информации об эвакуации Посетители обязаны действовать согласно указаниям сотрудников СДЦ, соблюдая спокойствие и не создавая паники;<b><span style="border: 1pt none windowtext; padding: 0cm;"></span></b></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.17.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Запрещается находиться в СДЦ с громоздкими предметами</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">, имеющими габаритные размеры по длине, ширине и высоте 30 х 30 х 60 см и более</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">, продуктами и в пачкающей одежде</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">;<b><span style="border: 1pt none windowtext; padding: 0cm;"></span></b></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.18.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетители обязаны сдать верхнюю одежду в гардероб СДЦ;</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.19.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Администрация не несет ответственность за ценные вещи, сданные в гардероб и забытые в помещениях СДЦ;</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.20.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Запрещается пронос в СДЦ любых видов оружия (огнестрельное, холодное, травматическое, газовое и т.п.), колющие и режущие предметы, боеприпасы, специальные средства самообороны (газовые баллончики, электрошоковые устройства, светозвуковые гранаты и т.п.), легковоспламеняющиеся, взрывчатые, ядовитые, пахучие и радиоактивные вещества, наркотические вещества; алкогольные и безалкогольные напитки и продукты питания купленные за пределами СДЦ, любые пиротехнические изделия (фальшфейеры, петарды, бенгальские свечи, хлопушки, салюты, сигнальные ракетницы, светошумовые спецсредства, дымовые шашки и прочее);<b><span style="border: 1pt none windowtext; padding: 0cm;"></span></b></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.21.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Сотрудники СДЦ и сотрудники охранного предприятия вправе запретить проход в СДЦ Посетителю, находящемуся в состоянии алкогольного, наркотического или токсического опьянения, а также в грязной и/или пачкающей одежде;<b><span style="border: 1pt none windowtext; padding: 0cm;"></span></b></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.22.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Запрещается осуществлять профессиональную фото и видеосъемку без письменного разрешения Администрации;</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.23.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Запрещается проход в СДЦ с любыми животными;<b><span style="border: 1pt none windowtext; padding: 0cm;"></span></b></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.24.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Некоторые из Мастерских предполагают наличие определенного уровня физической подготовки, Посетители должны сами в зависимости от состояния своего здоровья и здоровья своего ребенка определить степень риска при посещении каждой Мастерской;</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.25.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетители обязаны сообщить Администрации о наличии у себя и (или) несовершеннолетнего, в пользу которого приобретается Билет (Электронный билет) заболеваний (аллергических, желудочно-кишечных, опорно-двигательных и иных), обострение которых в процессе участия в Мероприятии может повлечь причинение вреда здоровью Посетителю или несовершеннолетнему;</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.26.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетители обязаны использовать предусмотренные в СДЦ элементы активной и пассивной безопасности;</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.27.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Для безопасности Посетителей некоторые из Мастерских имеют особые правила посещения и/или ограничения по возрасту ребенка, его росту и весу. Вход (выход) в любую Мастерскую производится только с разрешения персонала. Лица, сопровождающие несовершеннолетних детей, не имеют права входить в Мастерские, за исключением сопровождения ребенка с ограниченными возможностями или если это разрешено регламентом посещения мастерской, который доводится до сведения Посетителей информационными указателями, размещенными при входе в Мастерские и на карте города;</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.28.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Лица, сопровождающие Посетителей, при наличии очередей на посещении Мастерских, не вправе занимать в них места для Посетителей. В случае нарушения данного правила </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">сотрудники СДЦ и сотрудники охранного предприятия вправе </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">вывести нарушителя за территорию СДЦ;</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.29.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span> </span>Администрация не несет ответственности за несчастные случаи, возникшие вследствие нарушения Посетителями настоящих правил посещения;</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.30.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Администрация не несет ответственности за детей после окончания Мероприятия;</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.31.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">За нарушение Правил посещения, угрожающее нормам безопасности и нравственности, Администрация вправе вывести нарушителя за территорию СДЦ.</span><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 14.2pt; text-align: justify; text-indent: -14.2pt; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>4.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span></b><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Изменение Правил посещения Семейного досугового центра &laquo;Мастерславль&raquo;</span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>4.1.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Данные правила могут меняться Организатором в одностороннем порядке.</span></p>
 
  <p style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
 
  <p style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
 
  <p style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><i><span style="font-size: 7pt; font-family: &quot;Arial&quot;,sans-serif;">Приложение №3 от 1.10.2015 г.</span></i></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><i><span style="font-size: 7pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">к Публичной Оферте от 06 июня 2014 г. об оказании услуг по организации мероприятий </span></i></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><i><span style="font-size: 7pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">по профессиональному ориентированию и просвещению детей</span></i></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><i><span style="font-size: 7pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">на территории СДЦ &laquo;Мастерславль&raquo;, расположенного по адресу:</span></i></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><i><span style="font-size: 7pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">123317, Москва, Пресненская набережная, д. 4, стр. 1</span></i></p>
 
  <p align="right" style="margin-bottom: 0.0001pt; text-align: right; line-height: normal;" class="MsoNormal"><span style="font-size: 7pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"> </span></p>
 
  <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 7pt; font-family: &quot;Arial&quot;,sans-serif; text-transform: uppercase; border: 1pt none windowtext; padding: 0cm;"> </span></b></p>
 
  <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; text-transform: uppercase; border: 1pt none windowtext; padding: 0cm;">Расписание работы и стоимость БИЛЕТОВ </span></b></p>
 
  <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Семейный досуговый центр &laquo;Мастерславль&raquo;</span></b></p>
 
  <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"> </span></b></p>
 
  <p style="margin: 0cm 0cm 0.0001pt; text-align: justify; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Настоящие расписание работы и стоимость билетов действуют <b>с 1 октября 2015 года </b>для всех посетителей СДЦ &laquo;Мастерславль&raquo; и являются неотъемлемой частью Публичной Оферты об оказании услуг по организации мероприятий по профессиональному ориентированию и просвещению детей на территории СДЦ &laquo;Мастерславль&raquo;, расположенного по адресу: 123317, Москва, Пресненская набережная, д. 4, стр. 1.</span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 35.7pt; text-align: justify; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></b></p>
 
  <p style="margin-bottom: 6pt; text-align: justify; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Расписание работы:</span></b></p>
 
  <table cellspacing="0" cellpadding="0" border="1" style="margin-left: 5.4pt; border-collapse: collapse; border: medium none;" class="MsoTableGrid"> 
    <tbody> 
      <tr> <td width="169" valign="top" style="width: 126.7pt; border: 1pt solid black; padding: 0cm 5.4pt;"> 
          <p align="center" style="margin-bottom: 6pt; text-align: center; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
         </td> <td width="169" valign="top" style="width: 126.75pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none;"> 
          <p align="center" style="margin-bottom: 6pt; text-align: center; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Первый Сеанс</span></p>
         </td> <td width="169" valign="top" style="width: 126.75pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none;"> 
          <p align="center" style="margin-bottom: 6pt; text-align: center; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Второй Сеанс</span></p>
         </td> <td width="169" valign="top" style="width: 126.75pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none;"> 
          <p align="center" style="margin-bottom: 6pt; text-align: center; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Третий Сеанс</span></p>
         </td> </tr>
     
      <tr> <td width="169" valign="top" style="width: 126.7pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin-bottom: 6pt; text-align: center; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Ежедневно</span></p>
         
          <p align="center" style="margin-bottom: 6pt; text-align: center; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
         </td> <td width="169" valign="top" style="width: 126.75pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 6pt; text-align: center; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">10.00 - 1</span><span lang="EN-US" style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">4</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> .00</span></p>
         </td> <td width="169" valign="top" style="width: 126.75pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 6pt; text-align: center; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">15.00 - 19 .00</span><span lang="EN-US" style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"></span></p>
         </td> <td width="169" valign="top" style="width: 126.75pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 6pt; text-align: center; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">-</span></p>
         </td> </tr>
     </tbody>
   </table>
 
  <p style="margin-bottom: 6pt; text-align: justify; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
 
  <p style="margin-bottom: 6pt; text-align: justify; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Кассы СДЦ &quot;Мастерславль&quot; работают с 9.30 часов до 18.30 </span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 35.7pt; text-align: justify; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
 
  <p style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Стоимость билетов</span></b><i><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> кроме периода с 14 декабря 2015 года по 10 января 2016 года</span></i><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">:</span></b></p>
 
  <p style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></b></p>
 
  <table cellspacing="0" cellpadding="0" border="1" style="margin-left: 5.4pt; border-collapse: collapse; border: medium none;" class="MsoTableGrid"> 
    <tbody> 
      <tr> <td width="158" valign="top" style="width: 118.8pt; border: 1pt solid black; padding: 0cm 5.4pt;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">ТИП БИЛЕТА</span></b></p>
         </td> <td width="112" valign="top" style="width: 83.95pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">на 2 часа<sup>4</sup></span></b></p>
         
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(с 12 до 14 и с 17 до 19)</span></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">на 4 час</span></b></p>
         
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(в любое время с 10 до 19)</span></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&quot;Выгодный день&quot;</span></b></p>
         
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">2-й и 4-й понедельник месяца </span></p>
         
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(в любое время с 10 до 19)</span></p>
         </td> </tr>
     
      <tr> <td width="158" valign="top" style="width: 118.8pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Детский </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(5 - 14)</span></p>
         </td> <td width="112" valign="top" style="width: 83.95pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">1000</span></b></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">1100/1400<sup>1</sup></span></b></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">600</span></b></p>
         </td> </tr>
     
      <tr> <td width="158" valign="top" style="width: 118.8pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Детский льготный (5-14)<sup> 6</sup></span></b></p>
         </td> <td width="112" valign="top" style="width: 83.95pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></b></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">400</span></b></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">400</span></b></p>
         </td> </tr>
     
      <tr> <td width="158" valign="top" style="width: 118.8pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Взрослый </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(15 +)</span></p>
         </td> <td width="112" valign="top" style="width: 83.95pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">700/300<sup>2</sup></span></b></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">700/300<sup>2</sup></span></b></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">900/100<sup>2</sup></span></b></p>
         </td> </tr>
     
      <tr> <td width="158" valign="top" style="width: 118.8pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Младенческий </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(3 - 4)<b> </b></span></p>
         </td> <td width="112" valign="top" style="width: 83.95pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">400 <sup>3</sup></span></b></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">400 <sup>3</sup></span></b></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">400 <sup>3</sup></span></b></p>
         </td> </tr>
     
      <tr> <td width="158" valign="top" style="width: 118.8pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Школьные группы<sup>7</sup> <span> </span></span></b></p>
         </td> <td width="112" valign="top" style="width: 83.95pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">-</span></b></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">700</span></b></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">-</span></b></p>
         </td> </tr>
     </tbody>
   </table>
 
  <p style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></b></p>
 
  <p style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Абонемент &quot;5 посещений&quot; - 4900</span></b></p>
 
  <p style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></b></p>
 
  <p style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></b></p>
 
  <p style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Стоимость билетов </span></b><i><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">в период с 14 декабря 2015 года по 10 января 2016 года:</span></i></p>
 
  <p style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;" class="MsoNormal"><i><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></i></p>
 
  <table cellspacing="0" cellpadding="0" border="1" style="margin-left: 5.4pt; border-collapse: collapse; border: medium none;" class="MsoTableGrid"> 
    <tbody> 
      <tr> <td width="158" valign="top" style="width: 118.8pt; border: 1pt solid black; padding: 0cm 5.4pt;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">ТИП БИЛЕТА</span></b></p>
         </td> <td width="112" valign="top" style="width: 83.95pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Первый Сеанс <span> </span></span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(с 10 до 14)</span></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Второй Сеанс </span></b></p>
         
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&quot;Новогодняя программа&quot;</span></b></p>
         
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(с 15 до 19)</span></p>
         </td> </tr>
     
      <tr> <td width="158" valign="top" style="width: 118.8pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Детский </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(5 - 14)</span></p>
         </td> <td width="112" valign="top" style="width: 83.95pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">1100/1400<sup>1</sup></span></b></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">1700/2000<sup> 1,5</sup></span></b></p>
         </td> </tr>
     
      <tr> <td width="158" valign="top" style="width: 118.8pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Детский льготный (5-14)<sup> 6</sup></span></b></p>
         </td> <td width="112" valign="top" style="width: 83.95pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">400</span></b></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">1000 <sup>5</sup></span></b></p>
         </td> </tr>
     
      <tr> <td width="158" valign="top" style="width: 118.8pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Взрослый </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(15 +)</span></p>
         </td> <td width="112" valign="top" style="width: 83.95pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">700/300<sup>2</sup></span></b></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">700/300<sup>2</sup></span></b></p>
         </td> </tr>
     
      <tr> <td width="158" valign="top" style="width: 118.8pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Младенческий </span></b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(3 - 4)<b> </b></span></p>
         </td> <td width="112" valign="top" style="width: 83.95pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">400 <sup>3</sup></span></b></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">400 <sup>3</sup></span></b></p>
         </td> </tr>
     
      <tr> <td width="158" valign="top" style="width: 118.8pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Школьные группы<sup>7</sup> <span> </span></span></b></p>
         </td> <td width="112" valign="top" style="width: 83.95pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span lang="EN-US" style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">700</span></b></p>
         </td> <td width="135" valign="top" style="width: 101.4pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">1900<sup>5</sup></span></b></p>
         </td> </tr>
     </tbody>
   </table>
 
  <p style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;" class="MsoNormal"><b><span lang="EN-US" style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></b></p>
 
  <p style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;" class="MsoNormal"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></b></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><i><sup><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">1</span></sup></i><i><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Государственные выходные и праздничные дни, период с 26 декабря 2015 года по 10 января 2016 года.</span></i></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><b><sup><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">2 </span></sup></b><i><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Для одного взрослого, сопровождающего ребенка 5-6 лет. </span></i><i><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"></span></i></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><b><sup><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">3 </span></sup></b><i><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Младенческий билет дает право на посещение СДЦ без посещения мастерских. В мастерские дети допускаются с 5 лет.</span></i></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><i><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span> </span></span></i><b><sup><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">4</span></sup></b><i><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Тариф действует только в выходные дни, кроме периода с 14 декабря 2015 года по10 января 2016 года.</span></i></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><i><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span> </span></span></i><b><sup><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">5 </span></sup></b><i><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Тариф не включает стоимость новогоднего подарка 600 рублей, который приобретается по желанию. </span></i></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><b><sup><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">6 </span></sup></b><i><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Тариф действует только в будние дни для социальных категорий граждан. Лицо, сопровождающее ребенка, проходит бесплатно.</span></i></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><b><sup><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">7 </span></sup></b><i><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Тариф действует только в будние дни.</span></i></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><i><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></i></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Дети до 2-х лет (включительно) допускаются на территорию СДЦ бесплатно. </span></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Взрослый и младенческий билеты продаются только в дополнение к детскому билеты. </span></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
 
  <p style="margin-bottom: 0.0001pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">При посещении мастерских необходимо иметь при себе входной билет. </span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt; text-align: justify; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt; text-align: justify; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Все цены указаны с учетом НДС 18%.</span></p>
 
  <p class="ColorfulList-Accent11" style="margin: 0cm 0cm 0.0001pt; text-align: justify; line-height: normal;"> </p>
 
  <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormalCxSpFirst"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">ДОПОЛНЕНИЕ №1</span></b></p>
 
  <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormalCxSpMiddle"><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">к Публичной Оферте от 06 июня 2014 года (Оферта) об оказании услуг по организации мероприятий по</span></b><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> профессиональному ориентированию и просвещению </span></b><b><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">детейна территории ЗАО &laquo;Мастерславль&raquo;, расположенного по адресу:</span></b></p>
 
  <p align="center" style="margin-bottom: 0.0001pt; text-align: center; line-height: normal;" class="MsoNormalCxSpMiddle"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">123317, Москва, Пресненская набережная, д. 4, стр. 1<b> 
        <br />
       </b>г. Москва<span>                                                                                                                                                                            </span>26 октября 2015 г.</span></p>
 
  <p style="margin-bottom: 0.0001pt; text-align: justify; line-height: normal;" class="MsoNormalCxSpLast"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>1.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Факт приобретения Посетителем любого из Билетов (Электронных билетов) по программе &laquo;Продленка&raquo;, является безусловным и полным принятием условий настоящего дополнения №1 к Оферте (далее по тексту &laquo;Дополнение&raquo;), а также Оферты и Правил посещения СДЦ в части не противоречащей Дополнению.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>2.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Один Билет </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(Электронный билет)</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> по программе &laquo;</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Продленка</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">&raquo; дает право однократного посещения СДЦ с 9.30 до 19.30 в дату, указанную в Билете (Электронном Билете).</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Программа &laquo;</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Продленка<span style="border: 1pt none windowtext; padding: 0cm;">&raquo; включает в себя:</span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.1.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Для Посетителей по Билетам </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(Электронным билетам)<span style="border: 1pt none windowtext; padding: 0cm;"> &laquo;</span>Продленка <span style="border: 1pt none windowtext; padding: 0cm;">- свободный маршрут, без питания&raquo; (осуществляется без сопровождения сотрудниками СДЦ):</span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.1.1.<span style="font: 7pt &quot;Times New Roman&quot;;"> </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Свободное посещение любых Мастерских и Мероприятий;</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.2.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Для Посетителей по Билетам </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(Электронным билетам)<span style="border: 1pt none windowtext; padding: 0cm;"> &laquo;Продленка - свободный маршрут, с питанием&raquo; (осуществляется без сопровождения сотрудниками СДЦ):</span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.2.1.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Свободное посещение любых Мастерских и Мероприятий;</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.2.2.<span style="font: 7pt &quot;Times New Roman&quot;;"> </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Питание, которое осуществляется</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> согласно меню, </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">опубликованному в электронном виде на Интернет-сайте Организатора и доступному для ознакомления в кассовом холле СДЦ, по следующему расписанию: горячий обед (в 14.00), чай с печеньем (в 17.00).<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="MsoNormal"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.3.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Для Посетителей по Билетам </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(Электронным билетам) <span style="border: 1pt none windowtext; padding: 0cm;">&laquo;Продленка - тематический маршрут, без питания&raquo; (осуществляется при сопровождении сотрудниками СДЦ):</span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.3.1.<span style="font: 7pt &quot;Times New Roman&quot;;"> </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Свободное посещение любых Мастерских и Мероприятий;</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.3.2.<span style="font: 7pt &quot;Times New Roman&quot;;"> </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Посещение Мастерских и Мероприятий по тематическому маршруту, установленному Организатором;</span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.3.3.<span style="font: 7pt &quot;Times New Roman&quot;;"> </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Просмотр детских фильмов и мультипликационных фильмов;</span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.3.4.<span style="font: 7pt &quot;Times New Roman&quot;;"> </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Проведение детских игр и спортивных соревнований;</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.3.5.<span style="font: 7pt &quot;Times New Roman&quot;;"> </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Чтение детской литературы;</span><a name="_Ref389732288" ><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></a></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.4.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Для Посетителей по Билетам </span></span><span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(Электронным билетам) <span style="border: 1pt none windowtext; padding: 0cm;">&laquo;Продленка - тематический маршрут, с питанием&raquo; (осуществляется при сопровождении сотрудниками СДЦ):</span></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 35.45pt; text-align: justify; text-indent: -35.45pt; line-height: normal;" class="ColorfulList-Accent11"><span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.4.1.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Свободное посещение любых Мастерских и Мероприятий;</span></span><span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 35.45pt; text-align: justify; text-indent: -35.45pt; line-height: normal;" class="ColorfulList-Accent11"><span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.4.2.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Посещение Мастерских и Мероприятий по тематическому маршруту, установленному Организатором;</span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 35.45pt; text-align: justify; text-indent: -35.45pt; line-height: normal;" class="ColorfulList-Accent11"><span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.4.3.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Просмотр детских фильмов и мультипликационных фильмов;</span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 35.45pt; text-align: justify; text-indent: -35.45pt; line-height: normal;" class="ColorfulList-Accent11"><span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.4.4.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Проведение детских игр и спортивных соревнований;</span></span><span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 35.45pt; text-align: justify; text-indent: -35.45pt; line-height: normal;" class="ColorfulList-Accent11"><span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.4.5.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Чтение детской литературы;</span></span><span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;" class="ColorfulList-Accent11"><span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>3.4.6.<span style="font: 7pt &quot;Times New Roman&quot;;">    </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Питание, организованное с помощью партнеров Организатора в порядке, указанном в п. 3.2.2. Дополнения.</span></span></p>
 <span></span> 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>4.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Посетитель, купивший </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Билет </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(Электронный билет)<span style="border: 1pt none windowtext; padding: 0cm;"> &laquo;Продленка - свободный маршрут, с питанием&raquo; или &laquo;Продленка - тематический маршрут с питанием&raquo; обязан с</span>ообщить Организатору о наличии у несовершеннолетнего, в пользу которого приобретается Билет (Электронный билет), заболеваний (аллергических, желудочно-кишечных и иных), обострение которых может быть вызвано употреблением определенного вида продуктов. Посетитель признает, что не имеет никаких претензий к Организатору за вред здоровью, причиненный в случае невыполнения данной обязанности.<span style="border: 1pt none windowtext; padding: 0cm;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>5.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Посещение СДЦ по Билетам </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(Электронным билетам)<span style="border: 1pt none windowtext; padding: 0cm;"> &laquo;Продленка - тематический маршрут, без питания&raquo; и &laquo;Продленка-<span>  </span>тематический маршрут с питанием&raquo; возможно для Посетителей </span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">от 5 до 14 лет включительно.</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>6.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">Посещение СДЦ по Билетам </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">(Электронным билетам)<span style="border: 1pt none windowtext; padding: 0cm;"> &laquo;Продленка - свободный маршрут, без питания&raquo; и &laquo;Продленка- свободный маршрут, с питанием&raquo; возможно для Посетителей </span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">от 7 до 14 лет включительно.</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span>7.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Во время посещения СДЦ по программе &laquo;Продленка&raquo; Посетитель (</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">несовершеннолетний, в пользу которого приобретается Билет (Электронный билет)</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> находится в СДЦ без сопровождающих лиц. Под сопровождающими лицами в целях настоящего Дополнения №1 понимаются родители, иные родственники, законные представители.</span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; letter-spacing: -0.05pt;"><span>8.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Питание по билетам программы &laquo;Продленка&raquo; предоставляется кафе &quot;Дед Пихто&quot; <span style="letter-spacing: -0.05pt;">(ООО &quot;Макарий&raquo;, ИНН</span>/КПП 7710494773 / 771001001<span style="letter-spacing: -0.05pt;">ИНН 770365103489, адрес: </span>125047, г. Москва, ул. Лесная, д. 7).<span style="letter-spacing: -0.05pt;"></span></span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"><span>9.<span style="font: 7pt &quot;Times New Roman&quot;;">       </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Стоимость билетов:</span></p>
 
  <table cellspacing="0" cellpadding="0" border="1" style="margin-left: 21.3pt; border-collapse: collapse; border: medium none;" class="MsoTableGrid"> 
    <tbody> 
      <tr> <td width="232" valign="top" style="width: 173.65pt; border: 1pt solid black; padding: 0cm 5.4pt;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Продленка- Свободный маршрут</span></p>
         </td> <td width="232" valign="top" style="width: 173.65pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Без питания</span></p>
         </td> <td width="232" valign="top" style="width: 173.7pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">С питанием</span></p>
         </td> </tr>
     
      <tr> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">1 день</span></p>
         </td> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">1600</span></p>
         </td> <td width="232" valign="top" style="width: 173.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">2100</span></p>
         </td> </tr>
     
      <tr> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">3 дня</span></p>
         </td> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">4500</span></p>
         </td> <td width="232" valign="top" style="width: 173.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">6000</span></p>
         </td> </tr>
     
      <tr> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">5 дней</span></p>
         </td> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">7100</span></p>
         </td> <td width="232" valign="top" style="width: 173.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">9600</span></p>
         </td> </tr>
     
      <tr> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Плюс 1 день к абонементу 5 дней</span></p>
         </td> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">1300</span></p>
         </td> <td width="232" valign="top" style="width: 173.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">1800</span></p>
         </td> </tr>
     
      <tr style="height: 15.6pt;"> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt; border-style: none solid solid; height: 15.6pt;"> 
          <p align="center" style="margin: 24pt 0cm 0.0001pt; text-align: center; line-height: normal; page-break-after: avoid;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
         </td> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; height: 15.6pt;"> 
          <p align="center" style="margin: 24pt 0cm 0.0001pt; text-align: center; line-height: normal; page-break-after: avoid;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
         </td> <td width="232" valign="top" style="width: 173.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; height: 15.6pt;"> 
          <p align="center" style="margin: 24pt 0cm 0.0001pt; text-align: center; line-height: normal; page-break-after: avoid;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
         </td> </tr>
     
      <tr style="height: 11.4pt;"> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt; border-style: none solid solid; height: 11.4pt;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Продленка</span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">- Тематический маршрут</span></p>
         </td> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; height: 11.4pt;"> 
          <p style="margin: 24pt 0cm 0.0001pt; line-height: normal; page-break-after: avoid;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
         </td> <td width="232" valign="top" style="width: 173.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none; height: 11.4pt;"> 
          <p style="margin: 24pt 0cm 0.0001pt; line-height: normal; page-break-after: avoid;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
         </td> </tr>
     
      <tr> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">1 день</span></p>
         </td> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">1900</span></p>
         </td> <td width="232" valign="top" style="width: 173.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">2400</span></p>
         </td> </tr>
     
      <tr> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">3 дня</span></p>
         </td> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">5400</span></p>
         </td> <td width="232" valign="top" style="width: 173.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">6900</span></p>
         </td> </tr>
     
      <tr> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">5 дней</span></p>
         </td> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">8600</span></p>
         </td> <td width="232" valign="top" style="width: 173.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">11100</span></p>
         </td> </tr>
     
      <tr> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Плюс 1 день к абонементу 5 дней</span></p>
         </td> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">1600</span></p>
         </td> <td width="232" valign="top" style="width: 173.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">2100</span></p>
         </td> </tr>
     </tbody>
   </table>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;"> </span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>10.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">В период с 14 декабря 2015 года по 24 декабря 2015 года в связи с проведением Новогодней программы в стоимость билетов увеличивается на 600 рублей. </span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"> </span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"> </span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; text-indent: -21.3pt; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"><span>11.<span style="font: 7pt &quot;Times New Roman&quot;;">     </span></span></span><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;">В период с 25 декабря по 10 января 2016 года программа &quot;Продленка&quot; будет проводится в формате &quot;Зимний Лагерь&quot;</span></p>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"> </span></p>
 
  <table cellspacing="0" cellpadding="0" border="1" style="margin-left: 21.3pt; border-collapse: collapse; border: medium none;" class="MsoTableGrid"> 
    <tbody> 
      <tr> <td width="232" valign="top" style="width: 173.65pt; border: 1pt solid black; padding: 0cm 5.4pt;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Зимний Лагерь</span></p>
         </td> <td width="232" valign="top" style="width: 173.65pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Без питания</span></p>
         </td> <td width="232" valign="top" style="width: 173.7pt; border-width: 1pt 1pt 1pt medium; border-style: solid solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">С питанием</span></p>
         </td> </tr>
     
      <tr> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">1 день</span></p>
         </td> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">2500</span></p>
         </td> <td width="232" valign="top" style="width: 173.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">3000</span></p>
         </td> </tr>
     
      <tr> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">3 дня</span></p>
         </td> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">6900</span></p>
         </td> <td width="232" valign="top" style="width: 173.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">7400</span></p>
         </td> </tr>
     
      <tr> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">5 дней</span></p>
         </td> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">10500</span></p>
         </td> <td width="232" valign="top" style="width: 173.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">11000</span></p>
         </td> </tr>
     
      <tr> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt; border-style: none solid solid;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">Плюс 1 день к абонементу 5 дней</span></p>
         </td> <td width="232" valign="top" style="width: 173.65pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">2200</span></p>
         </td> <td width="232" valign="top" style="width: 173.7pt; border-width: medium 1pt 1pt medium; border-style: none solid solid none;"> 
          <p align="center" style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif;">2800</span></p>
         </td> </tr>
     </tbody>
   </table>
 
  <p style="margin: 0cm 0cm 0.0001pt 21.3pt; text-align: justify; line-height: normal;" class="ColorfulList-Accent11"><span style="font-size: 8pt; font-family: &quot;Arial&quot;,sans-serif; border: 1pt none windowtext; padding: 0cm;"> </span></p>
 <span style="font-size: 8pt; line-height: 115%; font-family: &quot;Arial&quot;,sans-serif;">В том случае, если по окончании программы &laquo;Продленка&raquo;, часы проведения которой указаны в п.2 настоящего Дополнения № 1, Посетитель (</span><span style="font-size: 8pt; line-height: 115%; font-family: &quot;Arial&quot;,sans-serif;">несовершеннолетний, в пользу которого приобретается Билет (Электронный билет) </span><span style="font-size: 8pt; line-height: 115%; font-family: &quot;Arial&quot;,sans-serif;">продолжает пребывать на территории СДЦ, дополнительно к стоимости билета по программе &laquo;Продленка&raquo; его пребывание оплачивается из расчета 1000 рублей в час. При этом каждый неполный час пребывания оплачивается как полный.</span><span style="font-size: 9pt; font-family: Arial,sans-serif;"></span><span style="font-size: 9pt; font-family: Arial,sans-serif; border: 1pt none windowtext; padding: 0cm;"></span> 
  <p class="MsoNormal" style="margin: 0cm 0cm 0.0001pt 1cm; text-align: justify; text-indent: -1cm; line-height: normal;"> </p>
 <span style="font-size: 10pt; line-height: 115%; font-family: Arial,sans-serif;"></span></div>
 
<p></p>
 <span style="font-size: 9pt; font-family: Arial,sans-serif;"><o:p></o:p></span> 
			</div>
</div>
	
	
	
<div id="overlay"></div>
<?php ActiveForm::end(); ?>

<script>
	function alert(txt)
	{
		return swal(txt);
	}

	function getAge(dateString) 
	{
      var day = parseInt(dateString.substring(0,2));
      var month = parseInt(dateString.substring(3,5));
      var year = parseInt(dateString.substring(6,10));

      var vtoday = $("#date_enter").val();
      var tmp = vtoday.split(".");

      var tday = tmp[0];
      var tmonth = tmp[1];
      var tyear = tmp[2];

      var today = new Date(tyear, tmonth, tday);
      var birthDate = new Date(year, month, day);
      var age = today.getFullYear() - birthDate.getFullYear();
      var m = today.getMonth() - birthDate.getMonth();
      if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
          age--;
      }

      console.log(age);
      return age;
	}

	function getDate(dateString)
	{
		var day = parseInt(dateString.substring(0,2));
	    var month = parseInt(dateString.substring(3,5));
	    var year = parseInt(dateString.substring(6,10));

	    var r = new Date(year, month, day);

	    return r;
	}

	$('.datetimepicker').datetimepicker({pickTime: false, language: 'ru',minDate: moment(), disabledDates:["02.11.2015","04.11.2015","05.12.2015","06.12.2015","07.12.2015","08.12.2015","09.12.2015","11.12.2015","12.12.2015","19.12.2015","20.12.2015","31.12.2015", "01.01.2016"]});
	adult_person_i = <?=$count_adult;?>;
	kids_person_i = <?=$count_kids;?>;
	minKidCount = 0;
	
	old = new Object();
	$(function () {
				$(".inp_radio").each(function(){
			console.log($(this).children().length);
			if ($(this).children('label').length < 3){
				$(this).children('label').addClass('ggggg');
			}
		});
		$('.phone').mask('+7(999) 999-99-99');
		$('.datarozhdenia').mask('99.99.9999');

		$("#btn_click").click(function(){ 
			summ = $("#total").html();
			$("#sum_pay").val(summ);

			if ((kids_person_i*2) < adult_person_i)
			{
				alert("На одного ребенка не может быть больше 2-х взрослых. Пожалуйста удалите взрослых посетителей.");
				return false;
			}
			else if ($(".status").is('[value = "no"]'))
			{
				alert("Пожалуйста, заполните и подтвердите всех посетителей.");
				return false;
			}
		});
		
		$(document).on("click", ".person_container .person .submitperson", function(){
			obj = $(this).parent("center").parent(".person");
			familia = $(obj).children(".familia"); 
			imya = $(obj).children(".imya");
			otchestvo = $(obj).children(".otchestvo");
			datarozhdenia = $(obj).children(".datarozhdenia");
			telefon = $(obj).children(".telefon");
			type = $(obj).children(".type").val();
			//pitanie = $(obj).children(".check").prop("checked");
			thiss = $(this);
			console.log("PrePressKidCount= "+minKidCount);
			type_adult = "";
			gen_obg = $(obj).parent(".person_container");
			tp_person = $(gen_obg).attr("type-person");
			id_rel = $(obj).children(".id_rel");
			jsOld =  getAge(datarozhdenia.val());
			console.log("вОЗРАСТ: "+jsOld);

			today = new Date();
			dr = getDate(datarozhdenia.val());
			
			

			var error = false;

			if (tp_person == "adult")
			{
				//type_adult = $(gen_obg).attr("type-adult");

				if (jsOld < 15)
				{
					$(datarozhdenia).css("border", "1px solid red");
					error = true;
					alert("Взрослый должен быть от 15 лет!");
				} 
				if($(".secondstatus").is('[value = "kid-no"]') ) {
					error = true;
					alert("Невозможно подтвердить взрослого, если есть неподтвержденные дети!");
				}
			}
			else if (today < dr)
			{
				$(datarozhdenia).css("border", "1px solid red");
				error = true;
				alert("Ребенок еще не родился!");
			}
			else if (tp_person == "kids")
			{
				if (jsOld >= 15)
				{
					$(datarozhdenia).css("border", "1px solid red");
					error = true;
					alert("Ребенок должен быть младше 15 лет!");
				}
			}
 
			if ($(familia).val() == "")
			{
				$(familia).css("border", "1px solid red");
				error = true;
			}
			else
			{
				surname = $(familia).val();
				$(familia).css("border", "");
			}

			if ($(imya).val() == "")
			{
				$(imya).css("border", "1px solid red");
				error = true;
			}
			else
			{
				name = $(imya).val();
				$(imya).css("border", "");
			}

			if ($(otchestvo).val() == "")
			{
				$(otchestvo).css("border", "1px solid red");
				error = true;
			}
			else
			{
				father_name = $(otchestvo).val();
				$(otchestvo).css("border", "");
			}

			if ($(datarozhdenia).val() == "")
			{
				$(datarozhdenia).css("border", "1px solid red");
				error = true;
			}
			else
			{
				date_birthday = $(datarozhdenia).val();
				$(datarozhdenia).css("border", "");
			}

			if (tp_person == "adult")
			{
				if ($(telefon).val() == "")
				{
					$(telefon).css("border", "1px solid red");
					error = true;
				}
				else
				{
					phone = $(telefon).val();
					$(telefon).css("border", "");
				}
			} 
			else
				phone = $(telefon).val();

			if ($(id_rel).val() == "")
				id_rel = "";
			else
				id_rel = $(id_rel).val();
			
			if (error == false)
			{
				console.log("Type= "+type);
				if(type == 1) {
					if(minKidCount > 0) {
						type_adult = 2;
						minKidCount = minKidCount - 1;
					} else {
						type_adult = 1;
						minKidCount = 0;
					}
				}
				
				console.log("PreAjaxMinKidCount= "+minKidCount);
				$(thiss).attr("disabled", "disabled");

				$.ajax({
					url: "index.php?r=online-pay/add-people",
					data: 
					{
						'name': name,
						'surname': surname,
						'father_name': father_name,
						'date_birthday': date_birthday,
						'type': type,
						'type_adult': type_adult,
						//'pitanie': pitanie, 
						'phone': phone,
						'id_rel': id_rel
					},
					success: function(data){
						result = jQuery.parseJSON(data);
						
						if (result.status == 'ok')
						{
							person_id = $(obj).parents('.person_container').attr('data-person');
							var peronType = $(obj).parents('.person_container').attr('type-person');
							d = "div[data-person='"+person_id+"'][type-person='"+tp_person+"']";
							$(d+" input[name='person["+person_id+"][familia]']").val($(d+" .person .familia").val());
							$(d+" input[name='person["+person_id+"][imya]']").val($(d+" .person .imya").val());
							$(d+" input[name='person["+person_id+"][otchestvo]']").val($(d+" .person .otchestvo").val());
							$(d+" input[name='person["+person_id+"][datarozhdenia]']").val($(d+" .person .datarozhdenia").val());
							$(d+" input[name='person["+person_id+"][telefon]']").val($(d+" .person .telefon").val());
							//$(d+" input[name='person["+person_id+"][pitanie]']").val($(d+" .person .pitanie").val());
							$(d+" input[name='person["+person_id+"][abonement]']").val($(d+" .person .abonement").val());
							$(d+" .person-submitted .name").html($(d+" .person .familia").val()+" "+$(d+" .person .imya").val()+" "+$(d+" .person .otchestvo").val());
							//$(d+" .person-submitted .pitanie").html($(d+" .person .pitanie").val());
							$(d+" .person-submitted .abonement").html($(d+" .person .abonement").val());
							$(d+" .person .id_rel").val(result.id_rel);
							ng = $('#ng_'+person_id).is(':checked');
							if (ng) $(d+" .person-submitted .ng").show(); else $(d+" .person-submitted .ng").hide();
							$(d+" input[name='person["+person_id+"][podarok]']").val(ng);
							 
							$(d+" .person-submitted .price .int").html(result.price);  
							total = parseInt($("#total").html());
							total = total + result.price;
							$("#total").html(total);
							 
							$(d+" .person").hide();
							$(d+" .person-submitted").show();
							
							if ((result.old < 7) && (adult_person_i == 0))
							{
								alert("У ребенка младше 7 лет должен быть родитель!");
								$("#add_adult").click();
							}

							if (result.old < 7)
							{
								$('[type-adult = "1"]:first').attr("type-adult", "2");
								old[result.id_rel] = result.old;
							} else {
								
								$('[type-adult = "2"]:first').attr("type-adult", "1");
								delete old[result.id_rel];
							}	

							$(d+" .person .status").val("ok");
							console.log("PersonType: "+peronType);
							if(peronType == "adult") {
								if(type_adult == 2) {
									$(d+" .person-submitted .escortstatus").val("ok");
								}
								$(d+" .person .secondstatus").val("parent-ok");
							} else {
								$(d+" .person .secondstatus").val("kid-ok");
								if(result.old < 7) {
									$(d+" .person .agestatus").val("ok");
									minKidCount++;
								}
							}
							console.log("MinKidCount= "+minKidCount);
							console.log("Count= " + $(".agestatus[value='ok']").length);
							console.log("CountA= " + $("[type-adult = '2']").length);
							

							return false; 
						}
						else if (result.status == "error")
						{
							alert(result.msg);
							return false;
						}

					}
				});
			} 
			return false;
		});
		$(document).on("click", ".person_container .person-submitted .edit", function(){
			obj = $(this).parent("center").parent(".person-submitted");
			mObj = $(this).parent("center").parent(".person-submitted").parent(".person_container").children(".person");
			btn = $(this).parent("center").parent(".person-submitted").parent(".person_container").children(".person").children("center").children(".submitperson");
			$(this).parent("center").parent(".person-submitted").parent(".person_container").children(".person").children(".status").val("no");
			
			$(btn).removeAttr('disabled');
			person_id = $(this).parents('.person_container').attr('data-person');
			tp_person = $(this).parents('.person_container').attr('type-person');
			d = "div[data-person='"+person_id+"'][type-person = '"+tp_person+"']";
			price = $(obj).children(".price").children(".int").html();
            console.log(price);
			if(tp_person == 'kids') {
				if ($(".secondstatus").is('[value = "parent-ok"]'))
				{
					alert("Чтобы редактировать ребенка, необходимо снять подтверждение со всех взрослых");
				} else {
					$(this).parent("center").parent(".person-submitted").parent(".person_container").children(".person").children(".secondstatus").val("kid-no");
					$(obj).children(".price").children(".int").html(0);
					total = parseInt($("#total").html());
					total -= price;
					$("#total").html(total);
					$(d+" .person-submitted").hide();
					$(d+" .person").show();
					var ageStatus =  $(mObj).children(".agestatus").val();
					console.log("AgeStatus= "+ageStatus);
					if(ageStatus == "ok") {
						minKidCount = minKidCount - 1;	
						console.log("mMinKidCount= "+minKidCount);
						$(this).parent("center").parent(".person-submitted").parent(".person_container").children(".person").children(".agestatus").val("no");
					}	
				}
			} else {
				var escortStatus =  $(obj).children(".escortstatus").val();
				console.log("EscortStatus= " + escortStatus);
				if(escortStatus == "ok") {
					minKidCount++;
					$(obj).children(".escortstatus").val("no");
				}
				$(this).parent("center").parent(".person-submitted").parent(".person_container").children(".person").children(".secondstatus").val("parent-no");
				$(obj).children(".price").children(".int").html(0);
				total = parseInt($("#total").html());
				total -= price;
				$("#total").html(total);
				$(d+" .person-submitted").hide();
				$(d+" .person").show();
			}
            
			
		});

		$("#add_adult").click(function(){
			adult_person_i = adult_person_i + 1;
			tp_adult = 1;
			console.log(old);
			if ((kids_person_i*2) >= adult_person_i)
			{
				html = "";
				html += '<div class="col-xs-12 col-sm-60 col-md-3 col-lg-3 person_container" data-person="'+adult_person_i+'" type-person="adult" type-adult="'+tp_adult+'">';
				html += '<div class="person">';
				html += '<div class="cl">&times;</div>';
				html += '<div class="t">Взрослый</div>';
				html += '<input placeholder="Фамилия" type="text" class="familia std-input-100">';
				html += '<input placeholder="Имя" type="text" class="imya std-input-100">';
				html += '<input placeholder="Отчество" type="text" class="otchestvo std-input-100">';
				html += '<input placeholder="Дата рождения" type="text" class="calendinput datarozhdenia std-input-100">';
				html += '<input placeholder="+7(___) ___-__-__" type="text" class="telefon std-input-100 phone">';
				html += '<input type="hidden" class="type" value="1">';
				html += '<input type="hidden" class="status" value="no">';
				html += '<input type="hidden" class="secondstatus" value="parent-no">';			
				html += '<input type="hidden" class="id_rel" value="">';
				html += '<div style="height:20px;"></div>';
				html += '<center><button class="submitperson std-button-gold">Подтвердить</button></center>';
				html += '</div>';
				html += '<div class="person-submitted">';
				html += '<input type="hidden" name="person['+adult_person_i+'][familia]"/>';
				html += '<input type="hidden" name="person['+adult_person_i+'][imya]"/>';
				html += '<input type="hidden" name="person['+adult_person_i+'][otchestvo]"/>';
				html += '<input type="hidden" name="person['+adult_person_i+'][datarozhdenia]"/>';
				html += '<input type="hidden" name="person['+adult_person_i+'][telefon]"/>';
				//html += '<input type="hidden" name="person['+adult_person_i+'][pitanie]"/>';
				html += '<input type="hidden" name="person['+adult_person_i+'][abonement]"/>';
				html += '<input type="hidden" name="person['+adult_person_i+'][podarok]"/>';
				html += '<input type="hidden" class="escortstatus" value="no">';
				html += '<div class="cl">&times;</div>'; 
				html += '<div class="t">Взрослый</div>'; 
				html += '<div class="st"><img src="assets2/images/person-st.png"/></div>';
				html += '<div class="name"></div>';
				html += '<div class="price"><div class="sub">Сумма:</div><span class="int"></span> руб</div>';
				html += '<center><div class="edit">Редактировать</div></center>';
				html += '</div>';
				html += '</div>';
				$("#adult_users").append(html);
				$('.phone').mask('+7(999) 999-99-99');
				$('.datarozhdenia').mask('99.99.9999');
			}
			else
			{
				alert("На ребенка возможно только 2 взрослых");
				adult_person_i = adult_person_i - 1;
			}
			return false;
		});
		$("#add_kids").click(function(){
			if ($(".secondstatus").is('[value = "parent-ok"]'))	{
				alert("Чтобы добавить ребенка, необходимо снять подтверждение со всех взрослых");
			} else {
				kids_person_i = kids_person_i + 1;
				html = "";
				html += '<div class="col-xs-12 col-sm-60 col-md-3 col-lg-3 person_container" data-person="'+kids_person_i+'" type-person="kids">';
				html += '<div class="person">';
				html += '<div class="cl">&times;</div>';
				html += '<div class="t">Ребенок</div>';
				html += '<input placeholder="Фамилия" type="text" class="familia std-input-100">';
				html += '<input placeholder="Имя" type="text" class="imya std-input-100">';
				html += '<input placeholder="Отчество" type="text" class="otchestvo std-input-100">';
				html += '<input placeholder="Дата рождения" type="text" class="calendinput datarozhdenia std-input-100">';
				html += '<input placeholder="+7(___) ___-__-__" type="text" class="telefon std-input-100 phone">';
				//html += '<input type="checkbox" id="pitanie_'+kids_person_i+'" class="check"/><label for="pitanie_'+kids_person_i+'" class="lab_check">Питание</label>';
				html += '<input type="hidden" class="type" value="2">';
				html += '<input type="hidden" class="status" value="no">';
				html += '<input type="hidden" class="secondstatus" value="kid-no">';
				html += '<input type="hidden" class="agestatus" value="no">';
				html += '<input type="hidden" class="id_rel" value="">';
				html += '<div style="height:33px;"></div>';
				html += '<center><button class="submitperson std-button-gold">Подтвердить</button></center>';
				html += '</div>';
				html += '<div class="person-submitted">';
				html += '<input type="hidden" name="person['+kids_person_i+'][familia]"/>';
				html += '<input type="hidden" name="person['+kids_person_i+'][imya]"/>';
				html += '<input type="hidden" name="person['+kids_person_i+'][otchestvo]"/>';
				html += '<input type="hidden" name="person['+kids_person_i+'][datarozhdenia]"/>';
				html += '<input type="hidden" name="person['+kids_person_i+'][telefon]"/>';
				html += '<input type="hidden" name="person['+kids_person_i+'][pitanie]"/>';
				html += '<input type="hidden" name="person['+kids_person_i+'][abonement]"/>';
				html += '<input type="hidden" name="person['+kids_person_i+'][podarok]"/>';
				html += '<div class="cl">&times;</div>';
				html += '<div class="t">Ребенок</div>';
				html += '<div class="st"><img src="assets2/images/person-st.png"/></div>';
				html += '<div class="name"></div>';
				html += '<div class="price"><div class="sub">Сумма:</div><span class="int"></span> руб</div>';
				html += '<center><div class="edit">Редактировать</div></center>';
				html += '</div>';
				html += '</div>';
				$("#kids_users").append(html);
				$('.phone').mask('+7(999) 999-99-99');
				$('.datarozhdenia').mask('99.99.9999');
			}
			return false;
		});
		function add_adult(args) {
			//code
		}

		$(document).on("click", ".person_container .cl", function(){
			type_person = $(this).parents('.person_container').attr("type-person");
			mObj = $(this).parents(".person_container").children(".person");
			var submitStatus = $(mObj).children(".status").val();
			i = $(this).parents('.person_container').attr("data-person");
			id_rel = $(this).parents('.person_container').children('.person').children(".id_rel").val();
			type_adult = 0; 
			if (type_person == "adult")
			{
				adult_person_i = adult_person_i - 1;
				type_adult = $(this).parents('.person_container').attr("type-adult");
			}
			else if (type_person == "kids")
			{
				if (old[i] < 7)
					delete old[i];

				kids_person_i = kids_person_i - 1; 
			}

			if (Object.keys(old).length == 0)
				type_adult = 1;
			
			if (kids_person_i == 0)
			{	
				alert("Должен быть хотя бы один ребенок");
				kids_person_i = 1;
			}
			else if (((Object.keys(old).length > 0) && (type_person == "adult") && (Object.keys(old).length > adult_person_i)) || (type_adult == 2))
			{	
				alert("Есть дети младше 7 лет!");
				adult_person_i = adult_person_i + 1; 
			} else if ($(".secondstatus").is('[value = "parent-ok"]') && submitStatus == "ok") {
				alert("Чтобы удалить посетителя, необходимо снять подтверждение со всех взрослых");
			}
			else
			{
				$.ajax({
					url: "index.php?r=online-pay/delete-people",
					data: 
					{
						'id_rel': id_rel
					}
				});
				$(this).parents('.person_container').remove();
				obj = $(this).parents(".person_container").children(".person-submitted");
				price = $(obj).children(".price").children(".int").html();
				total = parseInt($("#total").html());
				total -= price;
				$("#total").html(total);
				if(type_person == "adult") {
					var escortStatus =  $(obj).children(".escortstatus").val();
					if(escortStatus == "ok") {
						minKidCount++;
					}
				} else {
					personObj = $(this).parents(".person_container").children(".person");
					var ageStatus =  $(obj).children(".agestatus").val();
					if(ageStatus == "ok") {
						minKidCount = minKidCount - 1;
						console.log("minKidCount= " + minKidCount);
					}
				}
			}
		});

		
		
		

		$("#date_enter").focus(function(){
			gen_date = $(this).val();
		});
		
		$(document).ready(function() {
			/* 
			$('#go').click( function(event){
                event.preventDefault();
                $('#overlay').fadeIn(400,function(){$('#popup').css('display', 'block').animate({opacity: 1, top: '50%'}, 200);
                        });
                $($(this).data('subject')).click();
            }); */

            $('#close, #overlay').click( function(){
				$('#popup3')
					.animate({opacity: 0, top: '45%'}, 200,
					function(){
						$(this).css('display', 'none');
						$('#overlay').fadeOut(400);
					}
				);
            });
			
			
			date = $("#date_enter").val();
			now = new Date();
			dt_now = new Date(now.getFullYear(), now.getMonth(), now.getDate());

			d = parseDate(date).day;
			m = parseDate(date).month;
			Y = parseDate(date).year;

			dt_val = new Date(Y, m - 1, d);
	
			if (dt_now > dt_val)
			{
				$("#date_enter").val(gen_date);
				alert("Выбрана неправильная дата");
			}
			else
			{
				if ($(".status").is('[value = "ok"]'))
				{
					$("#date_enter").val(gen_date);
					alert("Ошибка! Имеются потвержденные посетители!");
					return false;
				}
				date = $("#date_enter").val();
				$.ajax({
						url: "index.php?r=online-pay/edit-date",
						data: 
						{
							'date': date,
						}
				});

				$(".inp_radio").html("");
				$.ajax({
					url: "index.php?r=online-pay/edit-date-select-city",
					data: 
					{
						'date': date
					}, 
					success: function(data){
						result = jQuery.parseJSON(data);
						console.log("RES-U= "+result.u);
						console.log("RES-Status= "+result.status);

						if (result.status == "ok")
						{
							if(result.u != "true") {
								var txt = "";
								var i = 0;
								$.each(result.result, function(key, val) {
								   i++;

								   txt += "<input type='radio' class='radio_class' for='radio' id='radio" + key + "' name='Order[count_hours]' value='" + key + "'>";
								   txt += "<label for='radio" + key + "' value='" + val + "'></label>"; 
								});

								$(".inp_radio").html(txt);
								if (i < 3){
									$("label").addClass('ggggg');
								}
							} else {
								var txt = "";
								var i = 0;
								$.each(result.result, function(key, val) {
								   i++;

								   txt = "<input type='radio' class='radio_class' for='radio' id='radio" + key + "' name='Order[count_hours]' value='" + key + "'>" 
											+ "<label for='radio" + key + "' value='" + val + "'></label>";
								});

								$(".inp_radio").html(txt);
								if (i < 3){
									$("label").addClass('ggggg');
								}
							}
						}
					}
				});
			}
			
		});

		$("#date_enter").change(function(){
			date = $(this).val();
			now = new Date();
			dt_now = new Date(now.getFullYear(), now.getMonth(), now.getDate());

			d = parseDate(date).day;
			m = parseDate(date).month;
			Y = parseDate(date).year;

			dt_val = new Date(Y, m - 1, d);
	
			if (dt_now > dt_val)
			{
				$(this).val(gen_date);
				alert("Выбрана неправильная дата");
			}
			else
			{
				if ($(".status").is('[value = "ok"]'))
				{
					$(this).val(gen_date);
					alert("Ошибка! Имеются потвержденные посетители!");
					return false;
				}
				date = $(this).val();
				$.ajax({
						url: "index.php?r=online-pay/edit-date",
						data: 
						{
							'date': date,
						}
				});

				$(".inp_radio").html("");
				$.ajax({
					url: "index.php?r=online-pay/edit-date-select-city",
					data: 
					{
						'date': date
					}, 
					success: function(data){
						result = jQuery.parseJSON(data);
						console.log("RES-U= "+result.u);
						console.log("RES-Status= "+result.status);

						if (result.status == "ok")
						{
							if(result.u != "true") {
								var txt = "";
								var i = 0;
								$.each(result.result, function(key, val) {
								   i++;

								   txt += "<input type='radio' class='radio_class' for='radio' id='radio" + key + "' name='Order[count_hours]' value='" + key + "'>";
								   txt += "<label for='radio" + key + "' value='" + val + "'></label>"; 
								});

								$(".inp_radio").html(txt);
								if (i < 3){
									$("label").addClass('ggggg');
								}
							} else {
								var txt = "";
								var i = 0;
								$.each(result.result, function(key, val) {
								   i++;

								   txt = "<input type='radio' class='radio_class' for='radio' id='radio" + key + "' name='Order[count_hours]' value='" + key + "'>" 
											+ "<label for='radio" + key + "' value='" + val + "'></label>";
								});

								$(".inp_radio").html(txt);
								if (i < 3){
									$("label").addClass('ggggg');
								}
							}
						}
					}
				});
			}
		});
		
		$(document).on("click", ".radio_class", function(){
			if ($(".status").is('[value = "ok"]'))
			{
				alert("Ошибка! Имеются потвержденные посетители!");
				return false;
			}
			count_hours = $(this).val();
			console.log("Count-Hours="+$(this).val());
			$.ajax({
					url: "index.php?r=online-pay/edit-count-hours",
					data: 
					{
						'count_hours': count_hours,
					}
			});
		});
	})

	function parseDate(value) 
	{
		// parse date 24.12.2009
		var tmp = value.split(".");
		return { day: tmp[0], month: tmp[1], year: tmp[2] };
	}

</script> 
