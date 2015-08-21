<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "";
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
							<input type="checkbox" id="pitanie_<?=$i;?>" class="check"/><label for="pitanie_<?=$i;?>" class="lab_check">Питание</label>
							<input type="hidden" class="type" value="2">
							<input type="hidden" class="status" value="no">
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
							<input type="hidden" name="person[1][pitanie]"/>
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
								<input type="hidden" name="person[1][pitanie]"/>
								<input type="hidden" name="person[1][abonement]"/>
								<input type="hidden" name="person[1][podarok]"/>
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
					<input type="submit" value="Забронировать" class="std-button-big-grey"/>&nbsp;&nbsp;&nbsp;
					<input type="submit" value="Оплатить" class="std-button-big" name="pay" id="btn_click"/>
					<input type="hidden" name="sum_pay" id="sum_pay">
				</div>
				<div class="big-price">ОБЩАЯ СТОИМОСТЬ БИЛЕТОВ: <span id="total">0</span> руб</div>
			</div>
		</div>
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
		$('.datarozhdenia').mask('99.99.9999');

		$("#btn_click").click(function(){ 
			summ = $("#total").html();
			$("#sum_pay").val(summ);

			if ((kids_person_i*2) < adult_person_i)
			{
				alert("Ошибка! На одного ребенка может быть только 2 родителя!");
				return false;
			}
			else if ($(".status").is('[value = "no"]'))
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
			thiss = $(this);
			type_adult = "";
			gen_obg = $(obj).parent(".person_container");
			tp_person = $(gen_obg).attr("type-person");
			
			jsOld = getAge(datarozhdenia.val());

			today = new Date();
			dr = getDate(datarozhdenia.val());

			var error = false;

			if (tp_person == "adult")
			{	
				type_adult = $(gen_obg).attr("type-adult");

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
		
			phone = $(telefon).val();
			
			if (error == false)
			{
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
						'pitanie': pitanie, 
						'phone': phone
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
							
							if ((result.old <= 7) && (adult_person_i == 0))
							{
								alert("У ребенка младше 7 лет должен быть родитель!");

								$("#add_adult").click();
							}

							if (result.old <= 7)
							{
								$('[type-adult = "1"]:first').attr("type-adult", "2");
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
			$(this).parent("center").parent(".person-submitted").parent(".person_container").children(".person").children(".status").val("no");
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
			tp_adult = 1;
			
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
				html += '<input type="hidden" name="person['+adult_person_i+'][pitanie]"/>';
				html += '<input type="hidden" name="person['+adult_person_i+'][abonement]"/>';
				html += '<input type="hidden" name="person['+adult_person_i+'][podarok]"/>';
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
			html += '<input type="checkbox" id="pitanie_'+kids_person_i+'" class="check"/><label for="pitanie_'+kids_person_i+'" class="lab_check">Питание</label>';
			html += '<input type="hidden" class="type" value="2">';
			html += '<input type="hidden" class="status" value="no">';
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
			return false;
		});
		function add_adult(args) {
			//code
		}

		$(document).on("click", ".person_container .cl", function(){
			type_person = $(this).parents('.person_container').attr("type-person");

			i = $(this).parents('.person_container').attr("data-person");
			type_adult = 0; 
			if (type_person == "adult")
			{
				adult_person_i = adult_person_i - 1;
				type_adult = $(this).parents('.person_container').attr("type-adult");
			}
			else if (type_person == "kids")
			{
				if (old[i] <= 7)
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
			else if ((Object.keys(old).length > 0) && (type_person == "adult") && (Object.keys(old).length > adult_person_i) || (type_adult == 2))
			{	
				alert("Есть дети младше 7 лет!");
				adult_person_i = adult_person_i + 1; 
			}
			else
			{
				id_rel = $(this).parents('.person_container').children('.person').children(".id_rel").val();
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
			}
		});

		$(document).on("click", ".radio_hours", function(){
			if ($(".status").is('[value = "ok"]'))
			{
				alert("Ошибка! Имеются потвержденные посетители!");
				return false;
			}
			count_hours = $(this).val();
			$.ajax({
					url: "index.php?r=online-pay/edit-count-hours",
					data: 
					{
						'count_hours': count_hours,
					}
			});
		});

		$("#date_enter").focus(function(){
			gen_date = $(this).val();
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

						if (result.status == "ok")
						{
							var txt = "";
							var i = 0;
							$.each(result.result, function(key, val) {
			                   i++;

			                   txt += "<input type='radio' for='radio' id='radio" + key + "' name='Order[count_hours]' value='" + key + "' class='radio_hours'>";
			                   txt += "<label for='radio" + key + "' value='" + val + "'></label>"; 
			                });

			                $(".inp_radio").html(txt);
						}
					}
				});
			}
		});
	})

	function parseDate(value) 
	{
		// parse date 24.12.2009
		var tmp = value.split(".");
		return { day: tmp[0], month: tmp[1], year: tmp[2] };
	}

</script> 
