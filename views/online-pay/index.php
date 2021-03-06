<?php
/* @var $this yii\web\View */
$this->title = "Выберите тип посещения";
$this->params["type_ticket"] = "Мастерславль"
?>

	<link rel="stylesheet" href="js/sweetalert-master/dist/sweetalert2.css" />
	<link rel="stylesheet" href="js/sweetalert-master/themes/masterslavl/masterslavl2.css"> 
	<style type="text/css">
		  @font-face {
			font-family: 'Conv_PFDinTextCondPro-Medium';
			src: url('assets2/fonts/PFDinTextCondPro-Medium.eot');
			src: local('☺'), url('assets2/fonts/PFDinTextCondPro-Medium.woff') format('woff'), url('assets/fonts/PFDinTextCondPro-Medium.ttf') format('truetype'), url('assets/fonts/PFDinTextCondPro-Medium.svg') format('svg');
			font-weight: normal;
			font-style: normal;
		  }
		  @font-face {
			font-family: 'Conv_pfdintextcondpro-bold';
			src: url('assets2/fonts/pfdintextcondpro-bold.eot');
			src: local('☺'), url('assets2/fonts/pfdintextcondpro-bold.woff') format('woff'), url('assets/fonts/pfdintextcondpro-bold.ttf') format('truetype'), url('assets/fonts/pfdintextcondpro-bold.svg') format('svg');
			font-weight: normal;
			font-style: normal;
		  }
		  @font-face {
			font-family: 'Conv_PFDinTextCondPro-Light';
			src: url('assets2/fonts/PFDinTextCondPro-Light.eot');
			src: local('☺'), url('assets2/fonts/PFDinTextCondPro-Light.woff') format('woff'), url('assets/fonts/PFDinTextCondPro-Light.ttf') format('truetype'), url('assets/fonts/PFDinTextCondPro-Light.svg') format('svg');
			font-weight: normal;
			font-style: normal;
		  }
	</style>
	<script>
		var merTxt = 'Незабываемый праздник в Мастерславле по уникальному сценарию! \nЗаказать день рождения или мероприятие с индивидуальной программой можно по телефону города: +7 (495) 645-75-25';
		var corpTxt = 'Приобрести корпоративное посещение можно по телефону города: +7 (495) 645-75-25';
		var editText = 'Раздел в разработке. В данный момент вы можете приобрести билеты только на индивидуальные посещения.';
		var errorText = 'Приносим наши извинения. Проводятся технические работы!';
		function alert(txt)
		{
			return swal(txt);
		}	
		function viewAlert() {
			alert(merTxt);
		}
		function viewAlertCorp() {
			alert(corpTxt);
		}
		function viewAlertEdit() {
			alert(editText);
		}
		function viewAlertError() {
			alert(errorText);
		}
	</script>

   <div class="formwhile" style="margin-top: 25px;">
                                <div class="textvertical">ИНДИВИДУАЛЬНЫЕ</div> 
                                <a href="http://online.masterslavl.ru/web/index.php?r=online-pay/select-city&type_ticket=1"><div class="button">
                                    <div class="img"><img src="assets2/images/wrapper_line_2_button_img1.png" width="50"  alt=""/></div>
                                    <div class="text" >ИНДИВИДУАЛЬНОЕ ПОСЕЩЕНИЕ</div>
                                </div></a>
                                <a href="#"><div class="button">
                                    <div class="img"><img src="assets2/images/wrapper_line_2_button_img2.png" width="50"  alt=""/></div>
                                    <div class="text" onclick="viewAlertError()">АБОНЕМЕНТЫ</div>
                                </div></a>
                                <a href="#"><div class="button">
                                    <div class="img"><img src="assets2/images/wrapper_line_2_button_img3.png" width="50"  alt=""/></div>
                                    <div class="text" onclick="viewAlertError()">ПРОГРАММЫ</div>
                                </div></a>
                                <a href="http://online.masterslavl.ru/web/index.php?r=online-pay/sertificat&type_ticket=2"><div class="button">
                                    <div class="img"><img src="assets2/images/wrapper_line_2_button_img4.png" width="50"  alt=""/></div>
                                    <div class="text">СЕРТИФИКАТЫ</div>
                                </div></a>
                              </div>  
                              <div class="formimage">
                                <div class="center">
                                 <div class="textvertical">праздники</div>  
<!--                                 <input type="button" class="button" value="ЗАКАЗАТЬ МЕРОПРИЯТИЕ" onclick="document.location.href = 'index.php?r=online-pay/select-city&type_ticket=4'"/>-->
                                        <a href="#"><div class="button">
                                            <div class="img"><img src="assets2/images/wrapper_line_2_button_img7.png" width="50"  alt=""/></div>
                                            <div class="text mer_modal" onclick="viewAlert()">ЗАКАЗАТЬ МЕРОПРИЯТИЕ</div>
                                        </div></a>
                                </div>
                              </div>
                              <div class="formwhile">
                                <div class="textvertical2" >групповые</div>
                                </br></br>
                                <a href="#"><div class="button">
                                    <div class="img"><img src="assets2/images/wrapper_line_2_button_img5.png" width="50"  alt=""/></div>
                                    <div class="text" onclick="viewAlertError()">ШКОЛЬНЫЕ ПОСЕЩЕНИЯ</div>
                                </div></a>
                                <a href="#"><div class="button">
                                    <div class="img"><img src="assets2/images/wrapper_line_2_button_img6.png" width="50"  alt=""/></div>
                                    <div class="text" onclick="viewAlertCorp()">КОРПОРАТИВНЫЕ ПОСЕЩЕНИЯ</div>
                                </div></a>

                        </div>
