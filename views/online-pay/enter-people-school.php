<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "";
?>


<div style="height:10px;"></div>
<?php $form = ActiveForm::begin(['id' => 'enter_people_form']); ?>
		<div class="row" style="padding:0px 15px;">
			<b>Дата посещения: </b><input type="text" name="col-pos" class="std-input big datarozhdenia datetimepicker" name="date_enter" value="<?=$date_enter;?>"/>
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
							<div class="t">Ребенок <?=$i;?></div>
							<input placeholder="Фамилия" type="text" class="familia std-input-100">
							<input placeholder="Имя" type="text" class="imya std-input-100">
							<input placeholder="Отчество" type="text" class="otchestvo std-input-100">
							<input placeholder="Дата рождения" type="text" class="calendinput datarozhdenia std-input-100 datetimepicker">
							<input placeholder="+7(___) ___-__-__" type="text" class="telefon std-input-100 phone">
							<input type="checkbox" id="pitanie_<?=$i;?>" class="check"/><label for="pitanie_<?=$i;?>" class="lab_check">Питание</label>
							<input type="hidden" class="type" value="2">
							<input type="hidden" class="status" value="no">
							<div style="height:20px;"></div>
							<center><button class="submitperson std-button-gold">Подтвердить</button></center>
						</div>
						<div class="person-submitted">
							<input type="hidden" name="person[1][familia]"/>
							<input type="hidden" name="person[1][imya]"/>
							<input type="hidden" name="person[1][otchestvo]"/>
							<input type="hidden" name="person[1][datarozhdenia]"/>
							<input type="hidden" name="person[1][telefon]"/>
							<input type="hidden" name="person[1][pitanie]"/>
							<input type="hidden" name="person[1][abonement]"/>
							<input type="hidden" name="person[1][podarok]"/>
							<div class="cl">&times;</div>
							<div class="t">Посетитель 1</div>
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
						<div class="col-xs-12 col-sm-60 col-md-3 col-lg-3 person_container" data-person="<?=$i;?>" type-person="adult" type-adult="1" <?if ($i == 1) echo "pr = 1";?>>
							<div class="person">
								<div class="cl">&times;</div>
								<div class="t">Взрослый <?=$i;?></div>
								<input placeholder="Фамилия" type="text" class="familia std-input-100">
								<input placeholder="Имя" type="text" class="imya std-input-100">
								<input placeholder="Отчество" type="text" class="otchestvo std-input-100">
								<input placeholder="Дата рождения" type="text" class="calendinput datarozhdenia std-input-100 datetimepicker">
								<input placeholder="+7(___) ___-__-__" type="text" class="telefon std-input-100 phone">
								<input type="hidden" class="type" value="1">
								<input type="hidden" class="status" value="no">
								<div style="height:20px;"></div>
								<center><button class="submitperson std-button-gold">Подтвердить</button></center>
							</div>
							<div class="person-submitted">
								<input type="hidden" name="person[1][familia]"/>
								<input type="hidden" name="person[1][imya]"/>
								<input type="hidden" name="person[1][otchestvo]"/>
								<input type="hidden" name="person[1][datarozhdenia]"/>
								<input type="hidden" name="person[1][telefon]"/>
								<input type="hidden" name="person[1][pitanie]"/>
								<input type="hidden" name="person[1][abonement]"/>
								<input type="hidden" name="person[1][podarok]"/>
								<div class="cl">&times;</div>
								<div class="t">Посетитель 1</div>
								<div class="st"><img src="assets2/images/person-st.png"/></div>
								<div class="name"></div>
								<div class="price"><div class="sub">Сумма:</div><span class="int"></span> руб</div>
								<center style="color: red;" class="besplatno"></center>
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
					<input type="submit" value="Забронировать" class="std-button-big-grey"/>&nbsp;&nbsp;&nbsp;
					<input type="submit" value="Оплатить" class="std-button-big" name="pay" id="btn_click"/>
					<input type="hidden" name="sum_pay" id="sum_pay">
				</div>
				<div class="big-price">ОБЩАЯ СТОИМОСТЬ БИЛЕТОВ: <span id="total">0</span> руб</div>
			</div>
		</div>
<?php ActiveForm::end(); ?>

<script>
	function getAge(dateString) 
	{
      var day = parseInt(dateString.substring(0,2));
      var month = parseInt(dateString.substring(3,5));
      var year = parseInt(dateString.substring(6,10));

      var today = new Date();
      var birthDate = new Date(year, month, day);
      var age = today.getFullYear() - birthDate.getFullYear();
      var m = today.getMonth() - birthDate.getMonth();
      if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
          age--;
      }
      return age+1;
	}

	function getDate(dateString)
	{
		var day = parseInt(dateString.substring(0,2));
	    var month = parseInt(dateString.substring(3,5));
	    var year = parseInt(dateString.substring(6,10));

	    var r = new Date(year, month, day);

	    return r;
	}

	$('.datetimepicker').datetimepicker({pickTime: false, language: 'ru'});
	adult_person_i = <?=$count_adult;?>;
	kids_person_i = <?=$count_kids;?>;
	old = new Object();
	$(function () {
		$('.phone').mask('+7(999) 999-99-99');

		$("#btn_click").click(function(){
			summ = $("#total").html();
			$("#sum_pay").val(summ);
			if ($(".status").is('[value = "no"]'))
			{
				alert("Ошибка! Заполните пожлуйста всех посетителей!");
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
			pitanie = $(obj).children(".check").prop("checked");

			type_adult = "";
			gen_obg = $(obj).parent(".person_container");
			tp_person = $(gen_obg).attr("type-person");
			
			jsOld = getAge(datarozhdenia.val());

			today = new Date();
			dr = getDate(datarozhdenia.val());

			var error = false;
			pr = "false";
			if (tp_person == "adult")
			{	
				type_adult = $(gen_obg).attr("type-adult");
				if ($(gen_obg).attr("pr") == "1")
				{
					pr = "true";
					$(gen_obg).children(".person-submitted").children(".besplatno").html("Бесплатно");
				}

				if (jsOld < 15)
				{
					$(datarozhdenia).css("border", "1px solid red");
					error = true;
					alert("Взрослый должен быть от 15 лет!");
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

			if (error == false)
			{
				$(this).attr("disabled", "disabled");
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
						'pitanie': pitanie,
						'besplatno': pr
					},
					success: function(data){
						result = jQuery.parseJSON(data);
						if (result.status == 'ok')
						{
							person_id = $(obj).parents('.person_container').attr('data-person');
							d = "div[data-person='"+person_id+"'][type-person='"+tp_person+"']";
							$(d+" input[name='person["+person_id+"][familia]']").val($(d+" .person .familia").val());
							$(d+" input[name='person["+person_id+"][imya]']").val($(d+" .person .imya").val());
							$(d+" input[name='person["+person_id+"][otchestvo]']").val($(d+" .person .otchestvo").val());
							$(d+" input[name='person["+person_id+"][datarozhdenia]']").val($(d+" .person .datarozhdenia").val());
							$(d+" input[name='person["+person_id+"][telefon]']").val($(d+" .person .telefon").val());
							$(d+" input[name='person["+person_id+"][pitanie]']").val($(d+" .person .pitanie").val());
							$(d+" input[name='person["+person_id+"][abonement]']").val($(d+" .person .abonement").val());
							$(d+" .person-submitted .name").html($(d+" .person .familia").val()+" "+$(d+" .person .imya").val()+" "+$(d+" .person .otchestvo").val());
							$(d+" .person-submitted .pitanie").html($(d+" .person .pitanie").val());
							$(d+" .person-submitted .abonement").html($(d+" .person .abonement").val());
							ng = $('#ng_'+person_id).is(':checked');
							if (ng) $(d+" .person-submitted .ng").show(); else $(d+" .person-submitted .ng").hide();
							$(d+" input[name='person["+person_id+"][podarok]']").val(ng);
							 
							$(d+" .person-submitted .price .int").html(result.price);  
							total = parseInt($("#total").html());
							total = total + result.price;
							$("#total").html(total);
							 
							$(d+" .person").hide();
							$(d+" .person-submitted").show();
							
							if ((result.old <= 7) && (adult_person_i == 0))
							{
								alert("У ребенка младше 7 лет должен быть родитель!");
								$("#add_adult").click();
							}

							if (result.old <= 7)
							{
								$('[type-adult = "1"]:first').attr("type-adult", 2);
								old[kids_person_i] = result.old;
							}
							else
								delete old[kids_person_i];

							$(d+" .person .status").val("ok")

							return false; 
						}

					}
				});
			} 
			return false;
		});
		$(document).on("click", ".person_container .person-submitted .edit", function(){
			obj = $(this).parent("center").parent(".person-submitted");
			btn = $(this).parent("center").parent(".person-submitted").parent(".person_container").children(".person").children("center").children(".submitperson");
			$(btn).removeAttr('disabled');
			person_id = $(this).parents('.person_container').attr('data-person');
			tp_person = $(this).parents('.person_container').attr('type-person');
			d = "div[data-person='"+person_id+"'][type-person = '"+tp_person+"']";
			price = $(obj).children(".price").children(".int").html();
			$(obj).children(".price").children(".int").html(0);
			total = parseInt($("#total").html());
			total -= price;
			$("#total").html(total);
			$(d+" .person-submitted").hide();
			$(d+" .person").show();
			
		});
		$("#add_adult").click(function(){
			adult_person_i = adult_person_i + 1;
			if ((kids_person_i) >= adult_person_i)
			{
				html = "";
				html += '<div class="col-xs-12 col-sm-60 col-md-3 col-lg-3 person_container" data-person="'+adult_person_i+'" type-person="adult" type-adult="1">';
				html += '<div class="person">';
				html += '<div class="cl">&times;</div>';
				html += '<div class="t">Взрослый '+adult_person_i+'</div>';
				html += '<input placeholder="Фамилия" type="text" class="familia std-input-100">';
				html += '<input placeholder="Имя" type="text" class="imya std-input-100">';
				html += '<input placeholder="Отчество" type="text" class="otchestvo std-input-100">';
				html += '<input placeholder="Дата рождения" type="text" class="calendinput datarozhdenia std-input-100 datetimepicker">';
				html += '<input placeholder="+7(___) ___-__-__" type="text" class="telefon std-input-100 phone">';
				html += '<input type="hidden" class="type" value="1">';
				html += '<input type="hidden" class="status" value="no">';
				html += '<div style="height:20px;"></div>';
				html += '<center><button class="submitperson std-button-gold">Подтвердить</button></center>';
				html += '</div>';
				html += '<div class="person-submitted">';
				html += '<input type="hidden" name="person['+adult_person_i+'][familia]"/>';
				html += '<input type="hidden" name="person['+adult_person_i+'][imya]"/>';
				html += '<input type="hidden" name="person['+adult_person_i+'][otchestvo]"/>';
				html += '<input type="hidden" name="person['+adult_person_i+'][datarozhdenia]"/>';
				html += '<input type="hidden" name="person['+adult_person_i+'][telefon]"/>';
				html += '<input type="hidden" name="person['+adult_person_i+'][pitanie]"/>';
				html += '<input type="hidden" name="person['+adult_person_i+'][abonement]"/>';
				html += '<input type="hidden" name="person['+adult_person_i+'][podarok]"/>';
				html += '<div class="cl">&times;</div>';
				html += '<div class="t">Посетитель '+adult_person_i+'</div>';
				html += '<div class="st"><img src="assets2/images/person-st.png"/></div>';
				html += '<div class="name"></div>';
				html += '<div class="price"><div class="sub">Сумма:</div><span class="int"></span> руб</div>';
				html += '<center><div class="edit">Редактировать</div></center>';
				html += '</div>';
				html += '</div>';
				$("#adult_users").append(html);
				$('.datetimepicker').datetimepicker({pickTime: false, language: 'ru'});
			}
			else
			{
				alert("На ребенка возможно только 1 взрослый");
				adult_person_i = adult_person_i - 1;
			}
			return false;
		});
		$("#add_kids").click(function(){
			kids_person_i = kids_person_i + 1;
			html = "";
			html += '<div class="col-xs-12 col-sm-60 col-md-3 col-lg-3 person_container" data-person="'+kids_person_i+'" type-person="kids">';
			html += '<div class="person">';
			html += '<div class="cl">&times;</div>';
			html += '<div class="t">Ребенок '+kids_person_i+'</div>';
			html += '<input placeholder="Фамилия" type="text" class="familia std-input-100">';
			html += '<input placeholder="Имя" type="text" class="imya std-input-100">';
			html += '<input placeholder="Отчество" type="text" class="otchestvo std-input-100">';
			html += '<input placeholder="Дата рождения" type="text" class="calendinput datarozhdenia std-input-100 datetimepicker">';
			html += '<input placeholder="+7(___) ___-__-__" type="text" class="telefon std-input-100 phone">';
			html += '<input type="checkbox" id="pitanie_'+kids_person_i+'" class="check"/><label for="pitanie_'+kids_person_i+'" class="lab_check">Питание</label>';
			html += '<input type="hidden" class="type" value="2">';
			html += '<input type="hidden" class="status" value="no">';
			html += '<div style="height:20px;"></div>';
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
			html += '<div class="t">Посетитель '+kids_person_i+'</div>';
			html += '<div class="st"><img src="assets2/images/person-st.png"/></div>';
			html += '<div class="name"></div>';
			html += '<div class="price"><div class="sub">Сумма:</div><span class="int"></span> руб</div>';
			html += '<center><div class="edit">Редактировать</div></center>';
			html += '</div>';
			html += '</div>';
			$("#kids_users").append(html);
			$('.datetimepicker').datetimepicker({pickTime: false, language: 'ru'});
			return false;
		});
		function add_adult(args) {
			//code
		}

		$(document).on("click", ".person_container .cl", function(){
			type_person = $(this).parents('.person_container').attr("type-person");
			i = $(this).parents('.person_container').attr("data-person");

			if (type_person == "adult")
				adult_person_i = adult_person_i - 1;
			else if (type_person == "kids")
			{
				if (old[i] <= 7)
					delete old[i];

				kids_person_i = kids_person_i - 1; 
			}
			
			if (kids_person_i == 5)
			{	
				alert("Должно быть минимум 6 детей");
				kids_person_i = 6;
			}
			else if (adult_person_i == 0)
			{	
				alert("Должен быть минимум 1 взрослый");
				adult_person_i = 1;
			}
			else if ((Object.keys(old).length > 0) && (type_person == "adult") && (Object.keys(old).length > adult_person_i))
			{
				alert("Есть дети младше 7 лет!");
				adult_person_i = adult_person_i + 1; 
			}
			else
			{
				$(this).parents('.person_container').remove();
				obj = $(this).parents(".person_container").children(".person-submitted");
				price = $(obj).children(".price").children(".int").html();
				total = parseInt($("#total").html());
				total -= price;
				$("#total").html(total);
			}
		});
	})
</script> 
