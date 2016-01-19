<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Order;
use app\models\City;
use app\models\Parents;
use app\models\RelOrderPeople;
use app\models\Kids;
use app\models\TypeTicket;
use app\models\PriceTicket;
use app\models\PriceTicket2;
use app\models\PriceTicket3;
use app\models\TimePriceTicket;
use app\models\TypeHours;
use app\models\DopPrice;
use app\models\TeamLeader;
use yii\filters\AccessControl;
use yii\helpers\Url;
use xj\qrcode\QRcode;
use xj\qrcode\actions\QRcodeAction;
use xj\qrcode\widgets\Text;
use xj\qrcode\widgets\Email;
use xj\qrcode\widgets\Card;
use kartik\mpdf\Pdf;
use yii\validators\EmailValidator;
use mPDF;
use domPDF;
use app\models\GeneralOptions;
use app\models\PriceSertificate;
use app\models\Programms;
use app\models\TypeDayProgramms;
use app\models\PriceProgramms;
use app\models\PriceAbonements;
use app\models\ChangePassword;
use app\models\RecoveryPassword;


class OnlinePayController extends \yii\web\Controller
{
 
	public $layout = "double_main"; 

    public function actions() {
        return [
            //deny widget set size & margin & ecLevel
            'qrcode' => [
                'class' => QRcodeAction::className(),
                'enableCache' => false,
                //
                'allowClientEclevel' => false,
                'ecLevel' => QRcode::QR_ECLEVEL_H,
                //
                'defaultSize' => 4,
                'allowClientSize' => false,
                //
                'defaultMargin' => 2,
                'allowClientMargin' => false,
            ],

            //allow widget set size & margin & ecLevel
            'qrcode' => [
                'class' => QRcodeAction::className(),
                //you can disable cache
                'enableCache' => true,
                //
                'allowClientEclevel' => true,
                'ecLevel' => QRcode::QR_ECLEVEL_H,
                //
                'defaultSize' => 4,
                'allowClientSize' => true,
                'maxSize' => 10,
                //
                'defaultMargin' => 2,
                'allowClientMargin' => true,
                'maxMargin' => 10,
                'outputDir' => '@webroot/upload/qrcode',

                //closure, you can ignore this selection.
                'onGetFilename' => function (QRcodeAction $data) {
                    /* @var $data QRcodeAction */
                    //dosomething
                    return sha1($data->text) . '.png';
                }
            ]
        ];
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => "",
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['auth', 'register', 'index', 'send', 'register-ok', 'confirm', 'change-password', 'recovery-password', 'tickets-admin', 'view-all-admin', 'report-order-list'], 
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }



	public function init()
	{
		$session = Yii::$app->session;
        
        if ($session->isActive)
            $session->open();

        if (isset($_REQUEST["type_ticket"]))
        {
            switch ($_REQUEST["type_ticket"]) 
            {
                case 1:
                    $res = 1;
                    break;
                case 2:
                    $res = 1;
                    break;
                case 3:
                    $res = 2;
                    break;
                case 4:
                    $res = 1;
                    break;
                case 5:
                    $res = 2;
                    break;
				case 6:
                    $res = 1;
                    break;
				case 7:
					$res = 1;
            }

            $session["type_user"] = $res;
            $session["type_ticket"] = $_REQUEST["type_ticket"];
        }

        if (isset($session["type_ticket"]))
        {
            switch ($session["type_ticket"]) 
            {
                case 1:
                    $r = "Индивидуальное посещение";
                    break;
                case 2:
                    $r = "Сертификаты";
                    break;
                case 3:
                    $r = "Школьное посещение";
                    break;
                case 4:
                    $r = "Заказать праздник или мероприятие";
                    break;
                case 5:
                    $r = "Корпоротивные клиенты";
                    break;
				case 6:
					$r = "Программы";
					break;
				case 7:
					$r = "Абонементы";
					break;
            }

            Yii::$app->view->params['type_ticket'] = $r;


        }
        

	}

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAuth()
    {
    	$model = new User();
        $post = Yii::$app->request->post("User");
        $session = Yii::$app->session;
        
        if (isset($post["username"]))
        {
            $username = $post["username"];
            $password = md5($post["password"]);

            $identity = User::findOne(['username' => $username]);
            
            if ($identity)
                if ($identity->password == $password)
                    Yii::$app->user->login($identity);

        }

        switch ($session["type_ticket"]) {
			case 2:
				$page = "sertificat";
				break;
            case 3:
                $page = "select-city-school";
                break;
			case 6:
                $page = "programms";
                break;
			case 7:
                $page = "enter-people-abonement";
                break;
            default:
                $page = "select-city";
                break;
        }
        
        if (Yii::$app->user->identity)
            return $this->redirect([$page, "type_ticket" => $session["type_ticket"]]);
        else
            return $this->render('auth', ['model' => $model]);
    }

    public function actionSelectCity()
    {
    	$model = new Order();
        $city = City::find()->All();
        $arrCity = array();
        $error = array();
        $msg = array();

        if (count($city))
        {
            foreach ($city as $val) 
                $arrCity[$val->id] = $val->name;
        }

        $post = Yii::$app->request->post(); 
		$session = Yii::$app->session;
		
        if (isset($post["Order"]))
        {
            $post = $post["Order"];
            foreach ($post as $key => $value) 
                    $model->$key = $value;

            if ($post["id_city"] == "")
                $error["id_city"] = 1;

            if ($post["date"] == "")
                $error["date"] = 1;

            if (isset($post["date"]))
            {
                if ( strtotime(date("d.m.Y 00:00:00", strtotime($post["date"]))) < strtotime(date("d.m.Y 00:00:00")) )
                    $error["date"] = 1;
            }

            if ($post["count_kids"] == "")
                $error["count_kids"] = 1;

            if (isset($post["count_hours"]))
            {   
                if ($post["count_hours"] == "")
                    $error["count_hours"] = 1;
            }
            else
                $error["count_hours"] = 1;

			if($post["count_kids"]=="" || $post["count_kids"]==0) {
				$error["count_adult"] = 1;
                $msg["count_adult"] = "Взрослые не могут посещать Мастерславать без детей!";
			}
            else if ($post["count_adult"] > ($post["count_kids"] * 2))
            {
                $error["count_adult"] = 1;
                $msg["count_adult"] = "На одного ребенка может быть не более двух взрослых!";
            }

            if (isset($post["date"]) and ($post["count_adult"] or $post["count_kids"]))
            {
                $model->type_ticket = $session["type_ticket"];
				if ($model->isSufficiency)
                {
                    $error["count_people"] = 1;
                    $msg["count_people"] = "Недостаточно мест";
                }
            } 

            if (count($error) == 0)
            {
                
                $model->date = strtotime($model->date);
                $model->type_ticket = $session["type_ticket"];
                $model->id_user = Yii::$app->user->id;
                $model->save();
                
                $model_id = $model->id; 

                $session["order_id"] = $model_id;
                return $this->redirect(['enter-people']);
            }

        }

        $options_tiket = GeneralOptions::findOne(["name" => "gen_options_tikets"]);
        $opt_val = $options_tiket->value;
        $TypeHours = TypeHours::find()->where(["options" => $opt_val])->all();
        foreach ($TypeHours as $val) 
            $type_hours[$val->id] = $val->value;


        return $this->render('select-city', ['model' => $model, 'city' => $arrCity, 'error' => $error, "type_hours" => $type_hours, "msg" => $msg]);
    }

    public function actionSelectCitySchool() 
    {
        $model = new Order();
        $city = City::find()->All();
        $arrCity = array();
        $error = array();
        $msg = array();

        if (count($city))
        {
            foreach ($city as $val) 
                $arrCity[$val->id] = $val->name;
        }

        $post = Yii::$app->request->post(); 

        if (isset($post["Order"]))
        {
            $post = $post["Order"];
            foreach ($post as $key => $value)
            { 
                $model->$key = $value;
                $msg[$key] = "";
            }

            if ($post["id_city"] == "")
                $error["id_city"] = 1;

            if ($post["date"] == "")
                $error["date"] = 1;

            if ($post["date"] != "")
            {
                $ned = date("N", strtotime($post["date"]));
                if (($ned == 6) or ($ned == 7))
                {
                    $error["date"] = 1;
                    $msg["date"] = "Школьное посещение возможно только в будни!";
                }
            }

            if ($post["count_kids"] < 6)
            {
                $error["count_kids"] = 1;
                $msg["count_kids"] = "Количество детей должно быть 6 или более!";
            } 

            if ($post["count_adult"] < 1)
            {
                $error["count_adult"] = 1;
                $msg["count_adult"] = "Количество взрослых должно быть 1 или более!";
            }

            if ($post["count_adult"] > $post["count_kids"])
            {
                $error["count_adult"] = 1;
                $msg["count_adult"] = "Количество взрослых не должно превышать количество детей!";
            }  

            if ($post["count_kids"] == "") {
				$error["count_kids"] = 1; 
			}
                

           
            if (isset($post["count_hours"]))
            {   
                if ($post["count_hours"] == "")
                    $error["count_hours"] = 1;
            }
            else {
				$error["count_hours"] = 1;
			}
                


            if (count($error) == 0)
            {
                $session = Yii::$app->session;
                $model->date = strtotime($model->date);
                $model->type_ticket = $session["type_ticket"];
				$model->id_user = Yii::$app->user->id;
                $model->save();
                
                $model_id = $model->id; 

                $session["order_id"] = $model_id;
                return $this->redirect(['enter-people-school']);
            }

        }

        $options_tiket = GeneralOptions::findOne(["name" => "gen_options_tikets"]);
        $opt_val = $options_tiket->value;
        $TypeHours = TypeHours::find()->where(["options" => $opt_val])->all();
        foreach ($TypeHours as $val) 
            $type_hours[$val->id] = $val->value;


        return $this->render('select-city-school', ['model' => $model, 'city' => $arrCity, 'error' => $error, "type_hours" => $type_hours, "msg" => $msg]);
    }

    public function actionRegister()
    {
  		$session = Yii::$app->session;

        if ($session["type_user"] == 1)
    	   $model = new User();
        elseif ($session["type_user"] == 2)
            $model = new TeamLeader();

        $post = Yii::$app->request->post();

        $error = array();
        if (isset($post["User"]) or (isset($post["TeamLeader"])))
        {
            $validator = new EmailValidator();
            if ($session["type_user"] == 1)
                $post = $post["User"];
            elseif ($session["type_user"] == 2)
                $post = $post["TeamLeader"];

            foreach ($post as $key => $value) 
                $model->$key = $value;
            

            if ($post["name"] == "")
                $error["name"] = 1;

            if ($post["surname"] == "")
                $error["surname"] = 1;

            if ($post["father_name"] == "")
                $error["father_name"] = 1;

            if ($post["email"] == "")
               $error["email"] = 1;

            if (!$validator->validate($post["email"]))
                 $error["email"] = 1;

            if ($post["password"] == "")
                $error["password"] = 1;

            if (isset($post["school"]))
                if ($post["school"] == "")
                    $error["school"] = 1;

            if ($session["type_user"] == 1)
                $res = User::findOne(['username' => $post["email"]]);
            elseif ($session["type_user"] == 2)
                $res = TeamLeader::findOne(['username' => $post["email"]]);
            
            if ($res)
                $error["email"] = 1;

            if (count($error) == 0)
            {	
				$mHash = md5(time().''.$model->email);
				$mPassword = $model->password;
				$model->password = md5($model->password);
                $model->username = $model->email;
				$model["hash"] = $mHash;
                $model->save();
				$this->SendVerificationMail($model->email, $mPassword, 'gg', $model->email, $mHash);
                
                return $this->redirect(['register-ok']);
            }
        }


        return $this->render("register", ['model' => $model, "error" => $error, "type_user" => $session["type_user"]]);
    }

    public function actionLogout()
    {
        return Yii::$app->user->logout();
    }

    public function actionEnterPeople()
    {
        $session = Yii::$app->session;
        $order = Order::findOne($session["order_id"]);


        if (!isset($order->count_adult))
            $count_adult = 0;
        else
            $count_adult = $order->count_adult;

        $count_kids = $order->count_kids;

        $parents = "";
        if ($count_adult >= 1)
            for($i = 1; $i <= $count_adult; $i++)
                $parents[$i] = new Parents();

        $kids = "";
        if ($count_kids >= 1)
            for($i = 1; $i <= $count_kids; $i++)
                $kids[$i] = new Kids();

        if (isset($order->date))
            $date_enter = date("d.m.Y", $order->date);

        if (isset($order->count_hours))
            $count_hours = $order->count_hours;

        $options_tiket = GeneralOptions::findOne(["name" => "gen_options_tikets"]);
        if (($order->date >= $options_tiket->date1) and ($order->date <= $options_tiket->date2))
            $opt_val = $options_tiket->value;
        else
            $opt_val = $options_tiket->default_value;
        
        $TypeHours = TypeHours::find()->where(["options" => $opt_val])->all();
        foreach ($TypeHours as $val) 
            $type_hours[$val->id] = $val->value;
        
        if (isset($_REQUEST["pay"]))
        {
			
			if ($ch = @curl_init()) 
              { 
                $url = Url::base("http")."/index.php?r=online-pay/finish&orderId=".$order->id;
                $id_order = $order->id;
                $amount = (int)$_REQUEST["sum_pay"] * 100;

                @curl_setopt($ch, CURLOPT_URL, 'https://securepayments.sberbank.ru/payment/rest/register.do?userName=masterslavl-api&password=shrjkisi&orderNumber='.$id_order.'&amount='.$amount.'&returnUrl='.$url); 
                @curl_setopt($ch, CURLOPT_HEADER, false); 
                @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                @curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
                @curl_setopt($ch, CURLOPT_USERAGENT, 'Masterslavl'); 
                $data = @curl_exec($ch); 
                $dt = json_decode($data);
				
                @curl_close($ch); 

                if (isset($dt->orderId))
                {
                    if (isset($_REQUEST["date_enter"])) 
                    { 
                        $order->date = strtotime($_REQUEST["date_enter"]);
                        $order->save();
                    }
                    $order->summ = $amount;
                    $order->bankOrderId = $dt->orderId;
                    $order->bankFormUrl = $dt->formUrl;
                    $order->save();

                    $this->redirect($dt->formUrl);
                }
                elseif ($order->bankFormUrl != "")
                {
                    $this->redirect($order->bankFormUrl);
                }


              } 
        }

        return $this->render("enter-people", ['count_kids' => $count_kids, 'count_adult' => $count_adult, "parents" => $parents, "kids" => $kids, 
            "date_enter" => $date_enter, "type_hours" => $type_hours, "count_hours" => $count_hours]);
    }

    public function actionEnterPeopleSchool()
    {
        $session = Yii::$app->session;
        $order = Order::findOne($session["order_id"]);


        if (!isset($order->count_adult))
            $count_adult = 0;
        else
            $count_adult = $order->count_adult;

        $count_kids = $order->count_kids;

        $parents = "";
        if ($count_adult >= 1)
            for($i = 1; $i <= $count_adult; $i++)
                $parents[$i] = new Parents();

        $kids = "";
        if ($count_kids >= 1)
            for($i = 1; $i <= $count_kids; $i++)
                $kids[$i] = new Kids();

        if (isset($order->date))
            $date_enter = date("d.m.Y", $order->date);

        if (isset($order->count_hours))
            $count_hours = $order->count_hours;

        $options_tiket = GeneralOptions::findOne(["name" => "gen_options_tikets"]);
        if (($order->date >= $options_tiket->date1) and ($order->date <= $options_tiket->date2))
            $opt_val = $options_tiket->value;
        else
            $opt_val = $options_tiket->default_value;
        
        $TypeHours = TypeHours::find()->where(["options" => $opt_val])->all();
        foreach ($TypeHours as $val) 
            $type_hours[$val->id] = $val->value;
        
        if (isset($_REQUEST["pay"]))
        {
            if ($ch = @curl_init()) 
              { 
                
                $url = Url::base("http")."/index.php?r=online-pay/finish&orderId=".$order->id;
                $id_order = $order->id;
                $amount = (int)$_REQUEST["sum_pay"] * 100;

                @curl_setopt($ch, CURLOPT_URL, 'https://3dsec.sberbank.ru/payment/rest/register.do?userName=masterslavl-api&password=masterslavl&orderNumber='.$id_order.'&amount='.$amount.'&returnUrl='.$url); 
                @curl_setopt($ch, CURLOPT_HEADER, false); 
                @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                @curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
                @curl_setopt($ch, CURLOPT_USERAGENT, 'Masterslavl'); 
                $data = @curl_exec($ch); 
                $dt = json_decode($data);
                @curl_close($ch); 

                if (isset($dt->orderId))
                {
                    if (isset($_REQUEST["date_enter"])) 
                    { 
                        $order->date = strtotime($_REQUEST["date_enter"]);
                        $order->save();
                    }
                    $order->summ = $amount;
                    $order->bankOrderId = $dt->orderId;
                    $order->bankFormUrl = $dt->formUrl;
                    $order->save();

                    $this->redirect($dt->formUrl);
                }
                elseif ($order->bankFormUrl != "")
                {
                    $this->redirect($order->bankFormUrl);
                }


              } 
        }

        return $this->render("enter-people-school", ['count_kids' => $count_kids, 'count_adult' => $count_adult, "parents" => $parents, "kids" => $kids, 
            "date_enter" => $date_enter, "type_hours" => $type_hours, "count_hours" => $count_hours]);
    }
	
	public function getAllDaysInAMonth($year, $month, $day = 'Monday', $daysError = 3) 
	{
		$dateString = 'first '.$day.' of '.$year.'-'.$month;

		if (!strtotime($dateString)) {
			throw new \Exception('"'.$dateString.'" is not a valid strtotime');
		}

		$startDay = new \DateTime($dateString);

		if ($startDay->format('j') > $daysError) {
			$startDay->modify('- 7 days');
		}

		$days = array();

		while ($startDay->format('Y-m') <= $year.'-'.str_pad($month, 2, 0, STR_PAD_LEFT)) {
			$days[] = clone($startDay);
			$startDay->modify('+ 7 days');
		}

		return $days;
	}

    public function actionAddPeopleAbonement()
    {
        $session = Yii::$app->session;
        $name = $_REQUEST["name"];
        $surname = $_REQUEST["surname"];
        $father_name = $_REQUEST["father_name"];
        $date_birthday = strtotime($_REQUEST["date_birthday"]);
        $phone = $_REQUEST["phone"];

        $kids = Kids::find()->where("LOWER(`name`)='".mb_strtolower($name)."' AND LOWER(`surname`) = '".mb_strtolower($surname)."' AND 
                LOWER(`father_name`) = '".mb_strtolower($father_name)."' AND `birthday` = ".$date_birthday)->all();

        if (count($kids) != 0)
        {
            $id_people = $kids[0]->id;
        }
        else
        { 
            $kids = new Kids();
            $kids->name = $name;
            $kids->surname = $surname;
            $kids->father_name = $father_name;
            $kids->birthday = $date_birthday;
            $kids->phone = $phone;
            $kids->save();

            $id_people = $kids->id;
        }

        $price = PriceAbonements::findOne(1);
        $result["price"] = $price->price;

        if (isset($_REQUEST["pitanie"]))
            if ($_REQUEST["pitanie"] == "true")
            {
                $pitanie = DopPrice::find()->where(["name" => "pitanie"])->all();
                $result["price"] += $pitanie[0]->price;
            }


      
        if ($_REQUEST["id_rel"] == "")
            $RelOrderPeople = new RelOrderPeople();
        else
            $RelOrderPeople = RelOrderPeople::findOne($_REQUEST["id_rel"]);

        
        $result["id_people"] = $id_people;
        $RelOrderPeople->id_order = $session["order_id"];
        $RelOrderPeople->id_people = $id_people; 
        $RelOrderPeople->type_people = 2;
        $RelOrderPeople->id_ticket = 7;
       
        $RelOrderPeople->qr = md5(time().$id_people.$session["order_id"]);
        if (isset($_REQUEST["pitanie"]))
            if ($_REQUEST["pitanie"] == "true")
                $RelOrderPeople->pitanie = 1;
        $RelOrderPeople->summ = $result["price"] * 100;
        
        $RelOrderPeople->save();
        
        
        $result["id_rel"] = $RelOrderPeople->id;

        $result["status"] = 'ok';
        return json_encode($result);


    }
	
	public function actionAddTestPeople() {
		
		$people = new Parents();
		$people->name = "Чукаев";
		$people->surname = "Юрий";
		$people->father_name = "Сергеевич";
		$people->birthday = 123141412;
		$people->phone = "+7(927) 410-13-05";
		$people->email = "vanyamelikov@yandex.ru";
		$people->save();

		$id_people = $people["id"];
		var_dump($id_people);
		echo $id_people;
		
		// $people = Parents::findOne(['id' => 11206]);
		// var_dump($people);
	}

    public function actionAddPeople()
    {
        $session = Yii::$app->session;
        $name = $_REQUEST["name"];
        $surname = $_REQUEST["surname"];
        $father_name = $_REQUEST["father_name"];
        $date_birthday = strtotime($_REQUEST["date_birthday"]);
        $phone = $_REQUEST["phone"];
        
		$type_ticket = 0;
		$id_programm = 0;
		
        if ($_REQUEST["type_adult"] != "")
            $type_adult = $_REQUEST["type_adult"];

        $order_id = $session["order_id"];
        $order = Order::findOne($order_id);

        if (!$order->getIsSufficiency(true))
        {
            $result["status"] = "error";
            $result["msg"] = "Недостаточно мест";

            return json_encode($result);
        }

        $now_date = date("N", $order->date);

        if ($now_date <= 5)
            $type_day = 1;
        else
            $type_day = 2;
			
        if ((($order->count_hours == 11) or ($order->count_hours == 12)) and ($now_date == 1))
        {
            $now_day = date("d.m.Y", $order->date);
            
				
			$dateString = 'first Monday of '.date("Y", $order->date).'-'.date("m", $order->date);

			if (!strtotime($dateString)) {
				throw new \Exception('"'.$dateString.'" is not a valid strtotime');
			}

			$startDay = new \DateTime($dateString);

			//if ($startDay->format('j') > 2) {
			//	$startDay->modify('- 7 days');
			//}

			$mDays = array();

			while ($startDay->format('Y-m') <= date("Y", $order->date).'-'.str_pad(date("m", $order->date), 2, 0, STR_PAD_LEFT)) {
				$mDays[] = clone($startDay);
				$startDay->modify('+ 7 days');
			}
			
			if($now_day == $mDays[1]->format("d.m.Y")) {
				if(($order->count_hours == 11)) {
					$order->count_hours = 17;
				} else if(($order->count_hours == 12)) {
					$order->count_hours = 18;
				}
			}
			
			if($now_day == $mDays[3]->format("d.m.Y")) {
				if(($order->count_hours == 11)) {
					$order->count_hours = 17;
				} else if(($order->count_hours == 12)) {
					$order->count_hours = 18;
				}
			}
				
			
        }
		
		
        
        $old = $this->getyeardiff($date_birthday,$order_id);
	
		if ($order->type_ticket == 6)
		{
			$kids = Kids::find()->where("LOWER(`name`)='".mb_strtolower($name)."' AND LOWER(`surname`) = '".mb_strtolower($surname)."' AND 
					LOWER(`father_name`) = '".mb_strtolower($father_name)."' AND `birthday` = ".$date_birthday)->all();
			$type_people = 2;

			if (count($kids) != 0)
			{
				$id_people = $kids[0]->id;
			}
			else
			{ 
				$kids = new Kids();
				$kids->name = $name;
				$kids->surname = $surname;
				$kids->father_name = $father_name;
				$kids->birthday = $date_birthday;
				$kids->phone = $phone;
				$kids->save();

				$id_people = $kids->id;
			}
			$id_programm = $order->id_programm;
			$id_time = $order->count_hours;
			$price = PriceProgramms::findOne(["id_programm" => $id_programm, "id_time" => $id_time]);
			$result["price"] = $price->price;

			if (isset($_REQUEST["pitanie"]))
				if ($_REQUEST["pitanie"] == "true")
				{
					$type_day = TypeDayProgramms::findOne($id_time);
					
					$pitanie = DopPrice::find()->where(["name" => "pitanie"])->all();
					$result["price"] += $pitanie[0]->price * $type_day->value;
				}

			if ($old <= 7)
				$result["old"] = $old;
		}
		else
		{
		
			if($order->type_ticket == 3) {
				$TypeTicket = TypeTicket::find()->where("`id`=12")->all();
			} else {
				$TypeTicket = TypeTicket::find()->where("`age_min` <= '$old' AND `age_max` >= '$old'")->all();
			}
			
			
			$type_ticket = $TypeTicket[0]->id;

            $o_date = $order->date;
            $TimePriceTicket = TimePriceTicket::find()->where("`date1` <= '$o_date' AND `date2` >= '$o_date'")->all();
            if (count($TimePriceTicket) == 0)
                $classPriceTicket = PriceTicket::find();
            elseif ($TimePriceTicket[0]->type == 1)
                $classPriceTicket = PriceTicket::find();
            elseif ($TimePriceTicket[0]->type == 2)
                $classPriceTicket = PriceTicket2::find();
			elseif ($TimePriceTicket[0]->type == 3)
				$classPriceTicket = PriceTicket3::find();

			$type = $_REQUEST["type"];
			if ($type == 1)
			{
				$people = Parents::find()->where("LOWER(`name`)='".mb_strtolower($name)."' AND LOWER(`surname`) = '".mb_strtolower($surname)."' AND 
					LOWER(`father_name`) = '".mb_strtolower($father_name)."' AND `birthday` = ".$date_birthday)->all();
				$type_people = 1;
				if (count($people) != 0)
				{
					$id_people = $people[0]->id; 
				}
				else
				{
					$people = new Parents();
					$people->name = $name;
					$people->surname = $surname;
					$people->father_name = $father_name;
					$people->birthday = $date_birthday;
					$people->phone = $phone;
					$people->save();

					$id_people = $people->id;
				}
				//Перерасчет сопровождающий - гость
				if ($type_adult == 2)
					$type_adult = 11;
				else
					$type_adult = 10;

				$price = $classPriceTicket->where(["type_ticket" => $type_adult, "type_day" => $type_day, "hours" => $order->count_hours])->all();
				$result["price"] = $price[0]->price;

				if (isset($_REQUEST["besplatno"]))
					if ($_REQUEST["besplatno"] == "besplatno")
						 $result["price"] = 0;
			}
			elseif ($type == 2)
			{
				$kids = Kids::find()->where("LOWER(`name`)='".mb_strtolower($name)."' AND LOWER(`surname`) = '".mb_strtolower($surname)."' AND 
					LOWER(`father_name`) = '".mb_strtolower($father_name)."' AND `birthday` = ".$date_birthday)->all();
				$type_people = 2;

				if (count($kids) != 0)
				{
					$id_people = $kids[0]->id;
				}
				else
				{ 
					$kids = new Kids();
					$kids->name = $name;
					$kids->surname = $surname;
					$kids->father_name = $father_name;
					$kids->birthday = $date_birthday;
					$kids->phone = $phone;
					$kids->save();

					$id_people = $kids->id;
				}

				$price = $classPriceTicket->where(["type_ticket" => $type_ticket, "type_day" => $type_day, "hours" => $order->count_hours])->all();
				$result["price"] = $price[0]->price;

				if (isset($_REQUEST["pitanie"]))
					if ($_REQUEST["pitanie"] == "true")
					{
						$pitanie = DopPrice::find()->where(["name" => "pitanie"])->all();
						$result["price"] += $pitanie[0]->price;
					}

				if ($old <= 7)
					$result["old"] = $old;
			}

		}
		
        $RelOrderPeople = RelOrderPeople::find()->where(["id_order" => $session["order_id"], "id_people" => $id_people, "type_people" => $type_people])->all();

        if (count($RelOrderPeople) == 0)
        {
            if ($_REQUEST["id_rel"] == "") {
				$RelOrderPeople = new RelOrderPeople();
			}    
            else {
				$RelOrderPeople = RelOrderPeople::findOne($_REQUEST["id_rel"]);
			}
                
            $RelOrderPeople->id_order = $session["order_id"];
            $RelOrderPeople->id_people = $id_people;
            $RelOrderPeople->type_people = $type_people;
            $RelOrderPeople->type_tiket = $type_ticket;
			$RelOrderPeople->id_programm = $id_programm;
            $RelOrderPeople->qr = md5(time().$id_people.$session["order_id"]);
            if (isset($_REQUEST["pitanie"]))
                if ($_REQUEST["pitanie"] == "true")
                    $RelOrderPeople->pitanie = 1;
            $RelOrderPeople->summ = $result["price"] * 100;
            
            $RelOrderPeople->save();
        }
        $RelOrderPeople = RelOrderPeople::find()->where(["id_order" => $session["order_id"], "id_people" => $id_people, "type_people" => $type_people])->all();
		$result["id_rel"] = $RelOrderPeople[0]->id;

        $result["status"] = 'ok';
        return json_encode($result);
    }

	
	public function actionRegisterOk() {
		Yii::$app->view->params['type_ticket'] = "Регистрация аккаунта";
		return $this->render('register-ok');
	}
	
	public function actionReportOrderList() {
		$get = Yii::$app->request->get();
		
		if(isset($get["startDate"]) && isset($get["endDate"])) {
			$Orders = Order::find()->where(["sendMail" => '1'])
			->andWhere(['<=', 'date', $get["endDate"] ])
			->andWhere(['>=', 'date', $get["startDate"] ])
			->all();
			
			foreach($Orders as $val) {
				
				if ($ch = @curl_init()) 
				{ 

					$host = "https://securepayments.sberbank.ru";
					$password = "shrjkisi";

					@curl_setopt($ch, CURLOPT_URL, $host.'/payment/rest/getOrderStatus.do?userName=masterslavl-api&password='.$password.'&orderId='.$val["bankOrderId"]); 
					@curl_setopt($ch, CURLOPT_HEADER, false); 
					@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
					@curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
					@curl_setopt($ch, CURLOPT_USERAGENT, 'Masterslavl'); 
					$data = @curl_exec($ch); 
					$dt = json_decode($data);
					@curl_close($ch); 

					if ((isset($dt->OrderStatus)) and ($dt->OrderStatus != 2))
					{
						echo $val["id"]." \n";
					}
				}
			}
		}
	}
	
	public function actionReportTestTickets() {
		
		$get = Yii::$app->request->get();
		
		if(isset($get["orderId"]) && isset($get["count_adult"])) {
			
			$orderID = $get["orderId"];
			$countAdult = $get["count_adult"];
			$order = Order::findOne(['id' => $orderID]);
			if($order) {
				for($i = 0; $i < $countAdult; $i++) {
					$people = new Parents();
					$people->name = "БИЛЕТ";
					$people->surname = "НА ПРЕДЪЯВИТЕЛЯ";
					$people->father_name = "БИЛЕТ";
					$people->birthday = 532040400;
					$people->save();
					
					$id_people = $people->id;
					
					$RelOrderPeople = new RelOrderPeople();
					$RelOrderPeople->id_order = $orderID;
					$RelOrderPeople->id_people = $id_people;
					$RelOrderPeople->type_people = 1;
					$RelOrderPeople->type_tiket = 10;
					$RelOrderPeople->id_programm = 0;
					$RelOrderPeople->summ = 70000;
					$RelOrderPeople->qr = md5(time().$id_people.$orderID);
					$RelOrderPeople->save();
				}
				echo "good";
			} else {
				echo "No order!";
			}
			
		} else {
			echo "Ошибка";
		}
		
	}


    public function getyeardiff($bday, $mOrder_id)
    {
        $arr1 = getdate($bday);

        $session = Yii::$app->session;
        $order_id = $mOrder_id;
        $order = Order::findOne($order_id);

        $arr2 = getdate($order->date);

        if((int)date('md', $order->date) >= (int)date('md', $bday) ) 
        { 
            $t = 1;
        } else 
        {
            $t = 0;
        }

        return ($arr2['year'] - $arr1['year'] - 1) + $t;
    }

    public function actionFinish()
    {
        $get = Yii::$app->request->get();

        if (isset($get["orderId"]))
        {
            if ($ch = @curl_init()) 
            { 
                
				$id_order = $get["orderId"];
				$order = Order::findOne(["bankOrderId" => $id_order]);
				
				if ($order->type_ticket == 1)
				{
					$host = "https://securepayments.sberbank.ru";
					$password = "shrjkisi";
				}
				else if($order->type_ticket == 2) {
					$host = "https://securepayments.sberbank.ru";
					$password = "shrjkisi";
				}
				else
				{
					$host = "https://3dsec.sberbank.ru";
					$password = "masterslavl";
				}
                @curl_setopt($ch, CURLOPT_URL, $host.'/payment/rest/getOrderStatus.do?userName=masterslavl-api&password='.$password.'&orderId='.$id_order); 
                @curl_setopt($ch, CURLOPT_HEADER, false); 
                @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                @curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
                @curl_setopt($ch, CURLOPT_USERAGENT, 'Masterslavl'); 
                $data = @curl_exec($ch); 
                $dt = json_decode($data);
                @curl_close($ch); 

                if ((isset($dt->OrderStatus)) and ($dt->OrderStatus == 2))
                {
					$id_rel = array();
                    $kids = array();
                    $adults = array();

                    $orderId = $get["orderId"];

                    $order = Order::findOne(["bankOrderId" => $orderId]);
                    $orderId = $order->id;


                    if ($order->type_ticket == 2)
                    {
                        
                        $price_kids = PriceSertificate::findOne(["name" => "kids"]);
                        $price_adult = PriceSertificate::findOne(["name" => "adult"]);

                        
						if ($order->status_sertificate == 0)
						{
							for ($i = 0; $i < $order->count_kids; $i++)
							{
								$RelOrderPeople = new RelOrderPeople();
								$RelOrderPeople->id_order = $order->id;
								$RelOrderPeople->id_people = 687;
								$RelOrderPeople->type_people = 2;
								$RelOrderPeople->type_tiket = $order->type_ticket;
								$RelOrderPeople->qr = md5(time()."687".$order->id);
								
								$RelOrderPeople->summ = $price_kids->price * 100;
								
								$RelOrderPeople->save();
							}

							for ($i = 0; $i < $order->count_adult; $i++)
							{
								$RelOrderPeople = new RelOrderPeople();
								$RelOrderPeople->id_order = $order->id;
								$RelOrderPeople->id_people = 356;
								$RelOrderPeople->type_people = 1;
								$RelOrderPeople->type_tiket = $order->type_ticket;
								$RelOrderPeople->qr = md5(time()."356".$order->id);
								
								$RelOrderPeople->summ = $price_adult->price * 100;
								
								$RelOrderPeople->save();
							}
							
							$order->status_sertificate = 1;
							$order->save();
						}

                        $tikets_kids = RelOrderPeople::find()->where(["id_order" => $orderId, "type_people" => "2"])->all();
                        $tikets_adults = RelOrderPeople::find()->where(["id_order" => $orderId, "type_people" => "1"])->all();

						$r_kids = array();
						$r_adult = array();
						$order_kids = array();
						$order_adults = array();
						
                        $i = 1;
                        foreach ($tikets_kids as $val)
                        {
                            $id_people_kids = $val->id_people;
                            $order_kids[$i] = $val;
							$r_kids[$i] = Kids::findOne($id_people_kids);
                            $i++;
                        }
                        
                        $i = 1;
                        foreach ($tikets_adults as $val)
                        {
                            $id_people_adults = $val->id_people;
                            $order_adults[$i] = $val;
							$r_adult[$i] = Parents::findOne($id_people_adults);
                            $i++;
                        }

                        

                        if (count($r_adult) == 0) {
							$r_adult = false;
                            //$r_adult = Parents::findOne($id_people_adults);
						} 
                            
						$i = 1;
                        foreach ($order_kids as $val) 
                        {
                            $kids[$val->id]["name"] = $r_kids[$i]->name;
						    $kids[$val->id]["surname"] = $r_kids[$i]->surname;						
                            $kids[$val->id]["id"] = $r_kids[$i]->id;
                            $kids[$val->id]["id_rel"] = $val->id;
                            $kids[$val->id]["summ"] = $val->summ/100;
                            $id_rel[] = $val->id;
							$i++;
                        }
						//var_dump($r_adult);
                        
                        if ($r_adult != false) {
							$i = 1;
							foreach ($order_adults as $val) 
                            {
                                $adults[$val->id]["name"] = $r_adult[$i]->surname;
						        $adults[$val->id]["surname"] = $r_adult[$i]->name;							    
                                $adults[$val->id]["id"] = $r_adult[$i]->id;
                                $adults[$val->id]["id_rel"] = $val->id;
                                $adults[$val->id]["summ"] = $val->summ/100;
                                $id_rel[] = $val->id;
								$i++;
                            }
							
						}    

                    }
                    elseif ($order->type_ticket == 6)
					{
						$tikets_kids = RelOrderPeople::find()->where(["id_order" => $orderId, "type_people" => "2"])->all();
						foreach ($tikets_kids as $val)
                        {
                            $id_people_kids[] = $val->id_people;
                            $order_kids[$val->id_people] = $val;
                        }
						
						$r_kids = Kids::find()->where(["id" => $id_people_kids])->all();
						
						foreach ($r_kids as $val) 
                        {
                            $kids[$val->id]["name"] = $val->surname." ".$val->name;
                            $kids[$val->id]["id"] = $val->id;
                            $kids[$val->id]["id_rel"] = $order_kids[$val->id]["id"];
                            $kids[$val->id]["summ"] = $order_kids[$val->id]["summ"]/100;
                            $id_rel[] = $order_kids[$val->id]["id"];
                        }
					}
                    elseif ($order->id_ticket == 7)
                    {
                        $tikets_kids = RelOrderPeople::find()->where(["id_order" => $orderId, "type_people" => "2"])->all();

                        foreach ($tikets_kids as $val)
                        {
                            $id_people_kids[] = $val->id_people;
                            $order_kids[$val->id_people] = $val;
                        }


                        $r_kids = Kids::find()->where(["id" => $id_people_kids])->all();

                        foreach ($r_kids as $val) 
                        {
                            $kids[$val->id]["name"] = $val->name;
							$kids[$val->id]["surname"] = $val->surname;
                            $kids[$val->id]["id"] = $val->id;
                            $kids[$val->id]["id_rel"] = $order_kids[$val->id]["id"];
                            $kids[$val->id]["summ"] = $order_kids[$val->id]["summ"]/100;
                            $id_rel[] = $order_kids[$val->id]["id"];
                        }

                    }
					else
                    {

                        $tikets_kids = RelOrderPeople::find()->where(["id_order" => $orderId, "type_people" => "2"])->all();
                        $tikets_adults = RelOrderPeople::find()->where(["id_order" => $orderId, "type_people" => "1"])->all();

                        $id_people_kids = array();
						
                        foreach ($tikets_kids as $val)
                        {
                            $id_people_kids[] = $val->id_people;
                            $order_kids[$val->id_people] = $val;
                        }
             
                        foreach ($tikets_adults as $val)
                        {
                            $id_people_adults[] = $val->id_people;
                            $order_adults[$val->id_people] = $val;
                        }

                        $r_kids = Kids::find()->where(["id" => $id_people_kids])->all();

                        if (isset($id_people_adults))
                            $r_adult = Parents::find()->where(["id" => $id_people_adults])->all();
                        else 
                            $r_adult = false;

                        foreach ($r_kids as $val) 
                        {
                            $kids[$val->id]["name"] = $val->name;
						    $kids[$val->id]["surname"] = $val->surname;
                            $kids[$val->id]["id"] = $val->id;
                            $kids[$val->id]["id_rel"] = $order_kids[$val->id]["id"];
                            $kids[$val->id]["summ"] = $order_kids[$val->id]["summ"]/100;
                            $id_rel[] = $order_kids[$val->id]["id"];
                        }

                        if ($r_adult != false)
                            foreach ($r_adult as $val) 
                            {
                                $adults[$val->id]["name"] = $val->name;
						        $adults[$val->id]["surname"] = $val->surname;
                                $adults[$val->id]["id"] = $val->id;
                                $adults[$val->id]["id_rel"] = $order_adults[$val->id]["id"];
                                $adults[$val->id]["summ"] = $order_adults[$val->id]["summ"]/100;
                                $id_rel[] = $order_adults[$val->id]["id"];
                            } 
                    }

                    $txt = "";
					$pdf_array = array();
                    foreach ($id_rel as $val) 
                    {
                        $_GET["id"] = $val;
                        $txt .= $this->getTiketContent();
						$pdf_array[] = $this->getTiketContent();
                    }
                    $this->SendMail($pdf_array, $txt, $order->id);

                    
                    return $this->render('finish', ["kids" => $kids, "order" => $order, "adults" => $adults, "order_id" => $order->id]);
                }
            } 
        }

        return "Ошибка! Заказ не оплачен!";
        
    }

    public function actionSaveAll()
    {
        $get = Yii::$app->request->get();

        $order_id = $get["order_id"];

        $RelOrderPeople = RelOrderPeople::find()->where(["id_order" => $order_id])->all();
        $txt = "";
        foreach ($RelOrderPeople as $val) 
        {
            $_GET["id"] = $val["id"];
            $txt .= $this->getTiketContent();
        }

        $d= new mPDF('utf-8', 'A4', '8', '', 0, 0, 0, 0, 0, 0);
        $d->writeHTML($txt);
        $d->charset_in = 'utf-8';
        $d->Output('mpdf.pdf', 'D');
    }

    public function actionViewAll()
    {
        $get = Yii::$app->request->get();

        $order_id = $get["order_id"];

        $RelOrderPeople = RelOrderPeople::find()->where(["id_order" => $order_id])->all();
        $txt = "";
        foreach ($RelOrderPeople as $val) 
        {
            $_GET["id"] = $val["id"];
            $txt .= $this->getTiketContent();
        }

        $d= new mPDF('utf-8', 'A4', '8', '', 0, 0, 0, 0, 0, 0);
        $d->writeHTML($txt);
        $d->charset_in = 'utf-8';
        $d->Output('mpdf.pdf', 'I');
    }
	
	public function actionViewAllAdmin()
    {
        $get = Yii::$app->request->get();

        $order_id = $get["order_id"];

        $RelOrderPeople = RelOrderPeople::find()->where(["id_order" => $order_id])->all();
        $txt = "";
        foreach ($RelOrderPeople as $val) 
        {
            $txt .= $this->getTicketContentForAdmin($val["id"], 2, $order_id);
        }

        $d= new mPDF('utf-8', 'A4', '8', '', 0, 0, 0, 0, 0, 0);
        $d->writeHTML($txt);
        $d->charset_in = 'utf-8';
        $d->Output('mpdf.pdf', 'I');
    }

    public function actionTikets()
    {
        $myview = $this->getTiketContent();

        $d= new mPDF('utf-8', 'A4', '8', '', 0, 0, 0, 0, 0, 0);
        $d->writeHTML($myview);
        $d->charset_in = 'utf-8'; 

        $d->list_indent_first_level = 0; 
        $d->WriteHTML($html, 2); 
        $d->Output('mpdf.pdf', 'I');
    }
	
	public function actionTicketsAdmin() {
		$post = Yii::$app->request->get();
		$ticket_id = $post["ticket_id"];
		$myview = $this->getTicketContentForAdmin($ticket_id, 1, false);

        $d= new mPDF('utf-8', 'A4', '8', '', 0, 0, 0, 0, 0, 0);
        $d->writeHTML($myview);
        $d->charset_in = 'utf-8'; 

        $d->list_indent_first_level = 0; 
        $d->WriteHTML($html, 2); 
        $d->Output('mpdf.pdf', 'I');
	}
	
	
	public function getTicketContentForAdmin($mTicketID, $type, $order_id) {
		
		$post = Yii::$app->request->get();
		
		$secretKey = "cd15e42db588b521f92cd38873b2ba3a";
		
		$ticket_id = $mTicketID;
		if($type == 1) {
			$ownSecretKey = md5($secretKey.''.$ticket_id);
		} else {
			$ownSecretKey = md5($secretKey.''.$order_id);
		}
		
		
		$postSecretKey = $post["access_token"];
		
		if($postSecretKey == $ownSecretKey) {
			$RelOrderPeople = RelOrderPeople::findOne(["id" => $ticket_id]);
			if($RelOrderPeople) {
				
				$order = Order::findOne($RelOrderPeople->id_order);
				$type_ticket = $order->type_ticket;
				$mOrderID = $RelOrderPeople->id_order;
				
				if ($RelOrderPeople->type_people == 2)
					$people = Kids::findOne($RelOrderPeople->id_people);
				elseif ($RelOrderPeople->type_people == 1)
					$people = Parents::findOne($RelOrderPeople->id_people);

				$name = $people->name;
				$surname = $people->surname;
				$old = $this->getyeardiff($people->birthday,$mOrderID);
				if ($RelOrderPeople->type_tiket != 2)
				{
					if ($RelOrderPeople->type_tiket != 0)
					{
						$TypeTicket = TypeTicket::findOne($RelOrderPeople->type_tiket);
						$name_tiket = $TypeTicket->name;
						$tm_name = TypeHours::findOne($order->count_hours);
						$time = $tm_name->value;
					}
					elseif ($RelOrderPeople->id_programm != 0)
					{
						$programm = Programms::findOne($RelOrderPeople->id_programm);
						$name_tiket = $programm->name;
						
						$tm_name = TypeDayProgramms::findOne($order->count_hours);
						$time = $tm_name->name;
					}
				}
				else
				{
					$name_tiket = "";
					$time = "";
				}

				

				$date = date("d.m.Y", $order->date);
				$price = $RelOrderPeople->summ/100;
				$pitanie = $RelOrderPeople->pitanie;
				$qr = $RelOrderPeople->qr;

				$money = 0;
				if ($RelOrderPeople->type_people == "2")
					$money = 50;
				
				if ($RelOrderPeople->type_tiket == "1") 
					$money = 0;

				$d = $order->date;
				$date2 = date("d.m.Y", mktime(0,0,0,date("m", $d) + 6,date("d", $d),date("Y", $d)));
				
				$date1 = $date;
				
				if ($order->type_ticket == 2)
				{
					if ($RelOrderPeople->type_people == 1)
						$old = "Взрослый";
					else
						$old = "Детский";
					
					$name_tiket = "Подарочный сертификат";
					
					$time = "Активировать до:";
					
					$date = date("d.m.Y", mktime(0,0,0,date("m", $d),date("d", $d),date("Y", $d) + 1));
					
					$money = "0";
					
					$date2 = "";
					$date1 = "";
				}

				if ($order->id_ticket == 7)
				{
				   
					
					$name_tiket = "Абонемент на 5 пос.";
					
					$time = "Действителен до:";
					
					$date = date("d.m.Y", mktime(0,0,0,date("m", $d) + 6,date("d", $d),date("Y", $d)));
					
					$money = "5*50";
					
					$date2 = "";
					$date1 = "";

					$type_ticket = 7;
				}
				
				$myview = $this->renderPartial("test_t", ["name" => $name,"surname" => $surname, "old" => $old, "name_tiket" => $name_tiket, "time" => $time, "date" => $date, "price" => $price,
					"pitanie" => $pitanie, "qr" => $qr, "date2" => $date2, "money" => $money, 'type_ticket' => $type_ticket, 'date1' => $date1]);

				return $myview;
				
			} else {
				return "Нет билета с данным идентификатором!";
			}
			
			
		} else {
			return "Ошибка";
		}
		
	}

    public function getTiketContent()
    {
        $get = Yii::$app->request->get();

        $user = Yii::$app->user;
    
        if (isset($get["id"]))
        {
            $id = $get["id"];
            $RelOrderPeople = RelOrderPeople::findOne($id);
			
			$mOrderID = $RelOrderPeople->id_order;
            
            $order = Order::findOne($RelOrderPeople->id_order);
            $type_ticket = $order->type_ticket;
            if ($order->id_user != $user->id)
                exit;

            if ($ch = @curl_init()) 
            { 
                $id_order = $order->bankOrderId;
				$order = Order::findOne(["bankOrderId" => $id_order]);
				
				if ($order->type_ticket == 1)
				{
					$host = "https://securepayments.sberbank.ru";
					$password = "shrjkisi";
				} 
				else if($order->type_ticket == 2) {
					$host = "https://securepayments.sberbank.ru";
					$password = "shrjkisi";
				}
				else
				{
					$host = "https://3dsec.sberbank.ru";
					$password = "masterslavl";
				}

                @curl_setopt($ch, CURLOPT_URL, $host.'/payment/rest/getOrderStatus.do?userName=masterslavl-api&password='.$password.'&orderId='.$id_order); 
                @curl_setopt($ch, CURLOPT_HEADER, false); 
                @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                @curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
                @curl_setopt($ch, CURLOPT_USERAGENT, 'Masterslavl'); 
                $data = @curl_exec($ch); 
                $dt = json_decode($data);
                @curl_close($ch); 

                if ($dt->OrderStatus != 2)
                    return "Ошибка! Заказ не оплачен";
            }

            if ($RelOrderPeople->type_people == 2)
                $people = Kids::findOne($RelOrderPeople->id_people);
            elseif ($RelOrderPeople->type_people == 1)
                $people = Parents::findOne($RelOrderPeople->id_people);

            $name = $people->name;
            $surname = $people->surname;
            $old = $this->getyeardiff($people->birthday,$mOrderID);
            if ($RelOrderPeople->type_tiket != 2)
            {
                if ($RelOrderPeople->type_tiket != 0)
				{
					$TypeTicket = TypeTicket::findOne($RelOrderPeople->type_tiket);
					$name_tiket = $TypeTicket->name;
					$tm_name = TypeHours::findOne($order->count_hours);
					$time = $tm_name->value;
				}
				elseif ($RelOrderPeople->id_programm != 0)
				{
					$programm = Programms::findOne($RelOrderPeople->id_programm);
					$name_tiket = $programm->name;
					
					$tm_name = TypeDayProgramms::findOne($order->count_hours);
					$time = $tm_name->name;
				}
            }
            else
            {
                $name_tiket = "";
                $time = "";
            }

            

            $date = date("d.m.Y", $order->date);
            $price = $RelOrderPeople->summ/100;
            $pitanie = $RelOrderPeople->pitanie;
            $qr = $RelOrderPeople->qr;

            $money = 0;
            if ($RelOrderPeople->type_people == "2")
                $money = 50;
			
			if ($RelOrderPeople->type_tiket == "1") 
				$money = 0;

            $d = $order->date;
            $date2 = date("d.m.Y", mktime(0,0,0,date("m", $d) + 6,date("d", $d),date("Y", $d)));
			
			$date1 = $date;
			
			if ($order->type_ticket == 2)
			{
				if ($RelOrderPeople->type_people == 1)
					$old = "Взрослый";
				else
					$old = "Детский";
				
				$name_tiket = "Подарочный сертификат";
				
				$time = "Активировать до:";
				
				$date = date("d.m.Y", mktime(0,0,0,date("m", $d),date("d", $d),date("Y", $d) + 1));
				
				$money = "0";
				
				$date2 = "";
				$date1 = "";
			}

            if ($order->id_ticket == 7)
            {
               
                
                $name_tiket = "Абонемент на 5 пос.";
                
                $time = "Действителен до:";
                
                $date = date("d.m.Y", mktime(0,0,0,date("m", $d) + 6,date("d", $d),date("Y", $d)));
                
                $money = "5*50";
                
                $date2 = "";
                $date1 = "";

                $type_ticket = 7;
            }
			
		
        }
		
		

        $myview = $this->renderPartial("test_t", ["name" => $name,"surname" => $surname, "old" => $old, "name_tiket" => $name_tiket, "time" => $time, "date" => $date, "price" => $price,
            "pitanie" => $pitanie, "qr" => $qr, "date2" => $date2, "money" => $money, 'type_ticket' => $type_ticket, 'date1' => $date1]);

        return $myview;
    }
	
	function debug_to_console( $data ) {

		if ( is_array( $data ) )
			$output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
		else
			$output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

		echo $output;
	}

    public function SendMail($pdf_array, $content, $order_id)
    {
        $user = Yii::$app->user;
        $order = Order::findOne($order_id);
		
        
        if (!$order->sendMail)        
        {
			$mRelOrderPeople = RelOrderPeople::find()->where(["id_order" => $order_id])->all();
            $user = User::findOne($user->id);
            $email = $user->email;
            

            $d= new mPDF('utf-8', 'A4', '8', '', 0, 0, 0, 0, 0, 0);
            $d->writeHTML($content);
            $d->charset_in = 'utf-8'; 

            $d->list_indent_first_level = 0; 
            $d->WriteHTML($html, 2); 

            $content = $d->Output('Все_Билеты.pdf', 'F');

            $content = chunk_split(base64_encode($content));
			$new_content = array();
			$new_filename = array();
			$new_content[] = $content;
			$new_filename[] = 'Все_Билеты.pdf';
			
			/*$j = 0;
			foreach($mRelOrderPeople as $mRelOrderPeopleVal) {
				$d= new mPDF('utf-8', 'A4', '8', '', 0, 0, 0, 0, 0, 0);
				$mContent = $pdf_array[j];
				$d->writeHTML($mContent);
				$d->charset_in = 'utf-8'; 

				$d->list_indent_first_level = 0; 
				$d->WriteHTML($html, 2); 
				
				$new_content_val = "";
				$mFullName = "";
				
				if ($mRelOrderPeopleVal->type_people == 2) {
					$people = Kids::findOne($mRelOrderPeopleVal->id_people);
					$mFullName = $people->surname.'_'.$people->name.'_'.$people->father_name.'.pdf';
				} elseif ($mRelOrderPeopleVal->type_people == 1) {
					$people = Parents::findOne($mRelOrderPeopleVal->id_people);
					$mFullName = $people->surname.'_'.$people->name.'_'.$people->father_name.'.pdf';
				}
				
				
				
				$mFullName = 'Билет_'.$j.'.pdf';
				$new_filename[] = $mFullName;
				$new_content_val = $d->Output($mFullName, 'F');
				$new_content[] = chunk_split(base64_encode($new_content_val));
				$j++;
			}*/
			$i = 0;
			foreach($pdf_array as $pdf_content) 
			{
				$d= new mPDF('utf-8', 'A4', '8', '', 0, 0, 0, 0, 0, 0);
				$d->writeHTML($pdf_content);
				$d->charset_in = 'utf-8'; 

				$d->list_indent_first_level = 0; 
				$d->WriteHTML($html, 2); 
					
				$new_content_val = $d->Output('tiket'.$i.'.pdf', 'F');
				$new_filename[] = 'tiket'.$i.'.pdf';

				$new_content[] = chunk_split(base64_encode($new_content_val));
				$i++;
			}
           
            $mailto = $email;
            $from_name = 'Билеты Мастерславль';
            $from_mail = 'admin@57minutes.ru';
            $replyto = $email;
            $uid = md5(uniqid(time())); 
            $subject = 'Билеты Мастерславль';
            $message = 'Билеты Мастерславль';
            $filename = 'tikets.pdf';
            $message = 'Детский город Мастерславль рад приветствовать Вас! 

Данное письмо является подтверждением Вашего путешествия в детский город мастеров. 
Распечатанные билеты необходимо предъявить при входе в Мастерславль. Ждем Вас по адресу: Пресненская набережная, д. 4, стр. 1, станция метро "Выставочная”.
Как найти Мастерславль, Вы можете ознакомиться по ссылке - http://www.masterslavl.ru/news/kak-nayti-masterslavl/

При отправке электронного билета на печать необходимо соблюдать следующее требование: не менять настройки печати (качество печати, масштаб страницы и размер изображения), предустановленные по умолчанию. В противном случае билет будет считаться недействительным.

Спасибо, что Вы с нами!

Управа г. Мастерславля';

            $header = "From: ".$from_name." <".$from_mail.">\r\n";
            $header .= "Reply-To: ".$replyto."\r\n";
            $header .= "MIME-Version: 1.0\r\n"; 
            $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
            $header .= "This is a multi-part message in MIME format.\r\n";
            $header .= "--".$uid."\r\n";
            $header .= "Content-type:text/plain; charset=utf-8\r\n";
            $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            $header .= $message."\r\n\r\n";
            $header .= "--".$uid."\r\n";
			$k = 0;
			foreach($new_content as $new_content_element) {
				$header .= "Content-Type: application/pdf; name=\"".$new_filename[k]."\"\r\n";
				$header .= "Content-Transfer-Encoding: base64\r\n";
				$header .= "Content-Disposition: attachment; filename=\"".$new_filename[k]."\"\r\n\r\n";
				$header .= $new_content_element."\r\n\r\n";
				$k++;
			}
            
            $header .= "--".$uid."--"; 
            $is_sent = @mail($mailto, $subject, "", $header);
			$mMessage = Yii::$app->mailer->compose();
			$mMessage->setFrom(array('ticket@online.masterslavl.ru' => 'Город Мастерславль'))
					 ->setTo($email)
					 ->setSubject($subject)
					 ->setTextBody($message);
			
			foreach($new_filename as $new_filename_element) {
				$mMessage->attach($new_filename_element, ['fileName' => $new_filename_element, 'contentType' => 'application/pdf']);
			}
			$mMessage->send();
			$order->sendMail = 1;
            $order->save();
        }
    }

    public function actionDeletePeople()
    {
        if (isset($_REQUEST["id_rel"]))
        {
            $id_rel = (int)$_REQUEST["id_rel"];
            $RelOrderPeople = RelOrderPeople::findOne($id_rel);
            $RelOrderPeople->delete();
        }
    }


    public function actionReport() 
    {
        $get = Yii::$app->request->get();

        $user = Yii::$app->user;
    
        if (isset($get["id"]))
        {
            $id = $get["id"];
            $RelOrderPeople = RelOrderPeople::findOne($id);
            $mOrderID = $RelOrderPeople->id_order;
            $order = Order::findOne($RelOrderPeople->id_order);

            if ($order->id_user != $user->id)
                exit;

            if ($RelOrderPeople->type_people == 2)
                $people = Kids::findOne($RelOrderPeople->id_people);
            elseif ($RelOrderPeople->type_people == 1)
                $people = Parents::findOne($RelOrderPeople->id_people);

            $name = $people->surname." ".$people->name;
            $old = $this->getyeardiff($people->birthday,$mOrderID);
            $TypeTicket = TypeTicket::findOne($RelOrderPeople->type_tiket);
            $name_tiket = $TypeTicket->name;

            $time = $order->count_hours;
            $date = date("d.m.Y", $order->date);
            $price = $RelOrderPeople->summ/100;
            $pitanie = $RelOrderPeople->pitanie;
            $qr = $RelOrderPeople->qr;

            $money = 0;
            if ($RelOrderPeople->type_people == "2")
                $money = 50;

            $d = $order->date;
            $date2 = date("d.m.Y", mktime(0,0,0,date("m", $d) + 6,date("d", $d),date("Y", $d)));
        }

        $myview = $this->renderPartial("test_t", ["name" => $name, "old" => $old, "name_tiket" => $name_tiket, "time" => $time, "date" => $date, "price" => $price,
            "pitanie" => $pitanie, "qr" => $qr, "date2" => $date2, "money" => $money]);
        $d= new mPDF('utf-8', 'A4', '8', '', 0, 0, 0, 0, 0, 0);
        $d->writeHTML($myview);
        $d->charset_in = 'utf-8'; 

        $d->list_indent_first_level = 0; 
        $d->WriteHTML($html, 2); 
        $d->Output('mpdf.pdf', 'I');

        $d->output();
    }

    public function actionEditCountHours()
    {
        if (isset($_REQUEST["count_hours"]))
        {
            $session = Yii::$app->session;
            $order_id = $session["order_id"];
            $order = Order::findOne($order_id);

            $order->count_hours = $_REQUEST["count_hours"];
            $order->save();
        }
    }

    public function actionEditDate()
    {
        if (isset($_REQUEST["date"]))
        {
            $session = Yii::$app->session;
            $order_id = $session["order_id"];
            $order = Order::findOne($order_id);

            $order->date = strtotime($_REQUEST["date"]);
            $order->save();
        }
    }

    public function actionEditDateSelectCity()
    {
        if (isset($_REQUEST["date"]))
        {
			$blockFT = "false";
            $gen_options_tikets = GeneralOptions::findOne(["name" => "gen_options_tikets"]);
            $date = strtotime($_REQUEST["date"]);

            if (($date >= $gen_options_tikets->date1) and ($date <= $gen_options_tikets->date2))
                $options = $gen_options_tikets->value;
            else
                $options = $gen_options_tikets->default_value;

            $TypeHours = TypeHours::find()->where(["options" => $options])->all();
            foreach ($TypeHours as $val) 
                $type_hours[$val->id] = $val->value;
			
			$nDate = $_REQUEST["date"];
			
			$nowDate =  date('d.m.Y');
			
			$nowTimeH = date('H');
			$nowTimeI = date('I');
			$u = "false";

			if($nDate == $nowDate) {
				if($nowTimeH > 13)	
				{
					$u = "true";
				} else if($nowTimeH == 13) {
					if($nowTimeI > 30) {
						$u = "true";
					}
				}
			}

			$result["u"] = $u;
			$result["nowDate"] = $nowDate;
            $result["status"] = "ok";
            $result["result"] = $type_hours;
        }

        return json_encode($result);
    }
	
	public function actionProgramms() {
		
		$model = new Order();
		$post = Yii::$app->getRequest()->post();
		
		if (isset($post["Order"]))
		{
			$new_order = $post["Order"];
			
			$error = array();
			
			if ($new_order["date"] == "")
				$error["date"] = 1;
				
			if ($new_order["count_kids"] == "")
				$new_order["count_kids"] = 1;
				
			if (count($error) == 0)
			{
				$session = Yii::$app->session;
				$model->id_city = $new_order["id_city"];
                $model->date = strtotime($new_order["date"]);
                $model->type_ticket = $session["type_ticket"];
				$model->count_kids = $new_order["count_kids"];
                $model->id_user = Yii::$app->user->id;
				$model->count_hours = $new_order["count_hours"];
				$model->id_programm = $new_order["id_programm"];
                $model->save();
                
                $model_id = $model->id; 

                $session["order_id"] = $model_id;
                return $this->redirect(['enter-people-programms']);
			}
			
		}
		
		$programms = Programms::find()->all();
		
		$type_day = TypeDayProgramms::find()->all();
		
		$i = 0;
		foreach($type_day as $val)
		{
			$dt_type_day[$val->id] = $val->name;
		}
		return $this->render('programms',['programms' => $programms, "model" => $model, "dt_type_day" => $dt_type_day]);
	}
	
	public function actionEnterPeopleProgramms()
    {
        $session = Yii::$app->session;
        $order = Order::findOne($session["order_id"]);


        if (!isset($order->count_adult))
            $count_adult = 0;
        else
            $count_adult = $order->count_adult;

        $count_kids = $order->count_kids;

        $parents = "";
        if ($count_adult >= 1)
            for($i = 1; $i <= $count_adult; $i++)
                $parents[$i] = new Parents();

        $kids = "";
        if ($count_kids >= 1)
            for($i = 1; $i <= $count_kids; $i++)
                $kids[$i] = new Kids();

        if (isset($order->date))
            $date_enter = date("d.m.Y", $order->date);

        if (isset($order->count_hours))
            $count_hours = $order->count_hours;
        
        $TypeHours = TypeDayProgramms::find()->all();
        foreach ($TypeHours as $val) 
            $type_hours[$val->id] = $val->name;
        
        if (isset($_REQUEST["pay"]))
        {
            if ($ch = @curl_init()) 
              { 
                
                $url = Url::base("http")."/index.php?r=online-pay/finish&orderId=".$order->id;
                $id_order = $order->id;
                $amount = (int)$_REQUEST["sum_pay"] * 100;

                @curl_setopt($ch, CURLOPT_URL, 'https://3dsec.sberbank.ru/payment/rest/register.do?userName=masterslavl-api&password=masterslavl&orderNumber='.$id_order.'&amount='.$amount.'&returnUrl='.$url); 
                @curl_setopt($ch, CURLOPT_HEADER, false); 
                @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                @curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
                @curl_setopt($ch, CURLOPT_USERAGENT, 'Masterslavl'); 
                $data = @curl_exec($ch); 
                $dt = json_decode($data);
                @curl_close($ch); 

                if (isset($dt->orderId))
                {
                    if (isset($_REQUEST["date_enter"])) 
                    { 
                        $order->date = strtotime($_REQUEST["date_enter"]);
                        $order->save();
                    }
                    $order->summ = $amount;
                    $order->bankOrderId = $dt->orderId;
                    $order->bankFormUrl = $dt->formUrl;
                    $order->save();

                    $this->redirect($dt->formUrl);
                }
                elseif ($order->bankFormUrl != "")
                {
                    $this->redirect($order->bankFormUrl);
                }


              } 
        }

        return $this->render("enter-people-programms", ['count_kids' => $count_kids, 'count_adult' => $count_adult, "parents" => $parents, "kids" => $kids, 
            "date_enter" => $date_enter, "type_hours" => $type_hours, "count_hours" => $count_hours]);
    }
	
	public function actionEnterPeopleAbonement()
    {
        $session = Yii::$app->session;
		$id_order = $session["order_id"];
		$order = Order::findOne($id_order);
        $city = City::find()->All();
        $arrCity = array();
        $error = array();
        $msg = array();

        $count_kids = $order->count_kids;


        $kids = "";
        if ($count_kids >= 1)
            for($i = 1; $i <= $count_kids; $i++)
                $kids[$i] = new Kids();

        
        $date_enter = $order->date;
        
        if (isset($_REQUEST["pay"]))
        {
           if ($ch = @curl_init()) 
                      { 
                        
                       $url = Url::base("http")."/index.php?r=online-pay/finish&orderId=".$order->id;
                        $id_order = $order->id;
                        $amount = (int)$_REQUEST["sum_pay"] * 100;

                        @curl_setopt($ch, CURLOPT_URL, 'https://3dsec.sberbank.ru/payment/rest/register.do?userName=masterslavl-api&password=masterslavl&orderNumber='.$id_order.'&amount='.$amount.'&returnUrl='.$url); 
                        @curl_setopt($ch, CURLOPT_HEADER, false); 
                        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        @curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
                        @curl_setopt($ch, CURLOPT_USERAGENT, 'Masterslavl'); 
                        $data = @curl_exec($ch); 
                        $dt = json_decode($data);
                        @curl_close($ch); 

                        if (isset($dt->orderId))
                        {
                            if (isset($_REQUEST["date_enter"])) 
                            { 
                                $order->date = strtotime($_REQUEST["date_enter"]);
                                $order->save();
                            }
                            $order->summ = $amount;
                            $order->bankOrderId = $dt->orderId;
                            $order->bankFormUrl = $dt->formUrl;
                            $order->save();

                            $this->redirect($dt->formUrl);
                        }
                        elseif ($order->bankFormUrl != "")
                        {
                            $this->redirect($order->bankFormUrl);
                        }


                      } 
        }

        return $this->render("enter-people-abonement", ['count_kids' => $count_kids, 'date_enter' => $date_enter]);
    }
	
	public function actionSertificat() {
	
		$model = new Order();
        $city = City::find()->All();
        $arrCity = array();
        $error = array();
        $msg = array();

        $price_kids = PriceSertificate::findOne(["name" => "kids"]);
        $price_adult = PriceSertificate::findOne(["name" => "adult"]);

        if (count($city))
        {
            foreach ($city as $val) 
                $arrCity[$val->id] = $val->name;
        }

        $post = Yii::$app->request->post(); 

        if (isset($post["Order"]))
        {
            $post = $post["Order"];
            foreach ($post as $key => $value) 
                    $model->$key = $value;

            if ($post["id_city"] == "")
                $error["id_city"] = 1;

            if ($post["count_kids"] == "")
                $error["count_kids"] = 1;
				
			if ($post["count_adult"] == "")
                $error["count_adult"] = 1;

            if (count($error) == 0)
            {
                $session = Yii::$app->session;
                
                $model->date = time();
                $model->type_ticket = $_REQUEST["type_ticket"];
                $model->id_user = Yii::$app->user->id;
                $model->save();
                
                $model_id = $model->id; 
              
                $session["order_id"] = $model_id;
                $order = Order::findOne($model_id);
                if (isset($_REQUEST["pay"]))
                {
                    if ($ch = @curl_init()) 
					{ 
						$url = Url::base("http")."/index.php?r=online-pay/finish&orderId=".$order->id;
						$id_order = $order->id;
						$amount = (int)$_REQUEST["Order"]["summ"] * 100;

						@curl_setopt($ch, CURLOPT_URL, 'https://securepayments.sberbank.ru/payment/rest/register.do?userName=masterslavl-api&password=shrjkisi&orderNumber='.$id_order.'&amount='.$amount.'&returnUrl='.$url); 
						@curl_setopt($ch, CURLOPT_HEADER, false); 
						@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						@curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
						@curl_setopt($ch, CURLOPT_USERAGENT, 'Masterslavl'); 
						$data = @curl_exec($ch); 
						$dt = json_decode($data);
						
						@curl_close($ch); 

						if (isset($dt->orderId))
						{
							if (isset($_REQUEST["date_enter"])) 
							{ 
								$order->date = strtotime($_REQUEST["date_enter"]);
								$order->save();
							}
							$order->summ = $amount;
							$order->bankOrderId = $dt->orderId;
							$order->bankFormUrl = $dt->formUrl;
							$order->save();

							$this->redirect($dt->formUrl);
						}
						elseif ($order->bankFormUrl != "")
						{
							$this->redirect($order->bankFormUrl);
						}


					} 
                }
                
            }

        }

        $options_tiket = GeneralOptions::findOne(["name" => "gen_options_tikets"]);
        $opt_val = $options_tiket->value;
        $TypeHours = TypeHours::find()->where(["options" => $opt_val])->all();
        foreach ($TypeHours as $val) 
            $type_hours[$val->id] = $val->value;
			
			
		return $this->render('sertificat',['model' => $model, 'p_kids' => $price_kids, 'p_adult' => $price_adult]);
	}
	
	public function actionAbonement() 
	{
		$model = new Order;
		
		$post = Yii::$app->request->post(); 
		
		$session = Yii::$app->session;
		$session["id_ticket"] = 7;
		
        if (isset($post["Order"]))
        {
            $post = $post["Order"];
            foreach ($post as $key => $value) 
                $model->$key = $value;
				
			$model->id_ticket = $session["id_ticket"];
			$model->date = time();
            $model->id_user = Yii::$app->user->id;
			$model->save();
			
			$session["order_id"] = $model->id;
			
			$this->redirect(['enter-people-abonement']);
		}
		
		return $this->render('abonement',['model' => $model]);
	}
	
	public function SendVerificationMail($login, $password, $verificationCode, $mEmail, $mHash)
    {
			$user = Yii::$app->user;
            $mailto = $mEmail;
            $from_name = 'Личный Кабинет г.Мастерславль';
            $from_mail = 'admin@57minutes.ru';
            $replyto = $mEmail;
            $uid = md5(uniqid(time())); 
            $subject = 'Подтверждение регистрации в г.Мастерславль';
            $message = 'Здравствуйте! 
			
Спасибо за регистрацию на сайте покупки билетов детского города мастеров "Мастерславля"!

Ниже мы прислали доступы к Вашему личному кабинету.
Ваш логин: '.$login.'
Ваш пароль: '.$password.'

Приятной покупки и ждем Вас в нашем городе!

Управа г.Мастерславля

P.S. В случае, если вы получили это письмо по ошибке, не отвечайте на него.
Ссылка: http://online.masterslavl.ru/web/index.php?r=online-pay/confirm&hash='.$mHash.' на подтверждение.';

            $header = "From: ".$from_name." <".$from_mail.">\r\n";
            $header .= "Reply-To: ".$replyto."\r\n";
            $header .= "MIME-Version: 1.0\r\n"; 
            $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
            $header .= "This is a multi-part message in MIME format.\r\n";
            $header .= "--".$uid."\r\n";
            $header .= "Content-type:text/plain; charset=utf-8\r\n";
            $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            $header .= $message."\r\n\r\n";
            $header .= "--".$uid."\r\n";
            
            $header .= "--".$uid."--"; 
            $is_sent = @mail($mailto, $subject, "", $header);
			$mMessage = Yii::$app->mailer->compose();
			$mMessage->setFrom(array('ticket@online.masterslavl.ru' => 'Город Мастерславль'))
					 ->setTo($mEmail)
					 ->setSubject($subject)
					 ->setTextBody($message);
			$mMessage->send();
        
    }
	
	public function SendRecoveryEmail($mEmail, $mHash)
    {
			$user = Yii::$app->user;
            $mailto = $mEmail;
            $from_name = 'Личный Кабинет г.Мастерславль';
            $from_mail = 'admin@57minutes.ru';
            $replyto = $mEmail;
            $uid = md5(uniqid(time())); 
            $subject = 'Восстановление пароля в г.Мастерславль';
            $message = 'Здравствуйте! 
			
Спасибо за регистрацию на сайте покупки билетов детского города мастеров "Мастерславля"!

Ниже мы прислали доступы к Вашему личному кабинету.

Приятной покупки и ждем Вас в нашем городе!

Управа г.Мастерславля

P.S. В случае, если вы получили это письмо по ошибке, не отвечайте на него.
Ссылка: http://online.masterslavl.ru/web/index.php?r=online-pay/change-password&hash='.$mHash.' на подтверждение.';

            $header = "From: ".$from_name." <".$from_mail.">\r\n";
            $header .= "Reply-To: ".$replyto."\r\n";
            $header .= "MIME-Version: 1.0\r\n"; 
            $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
            $header .= "This is a multi-part message in MIME format.\r\n";
            $header .= "--".$uid."\r\n";
            $header .= "Content-type:text/plain; charset=utf-8\r\n";
            $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            $header .= $message."\r\n\r\n";
            $header .= "--".$uid."\r\n";
            
            $header .= "--".$uid."--"; 
            $is_sent = @mail($mailto, $subject, "", $header);
			$mMessage = Yii::$app->mailer->compose();
			$mMessage->setFrom(array('ticket@online.masterslavl.ru' => 'Город Мастерславль'))
					 ->setTo($mEmail)
					 ->setSubject($subject)
					 ->setTextBody($message);
			$mMessage->send();
        
    }

	public function actionConfirm() 
	{
		$get = Yii::$app->request->get();
		
		$model = new User();
        $session = Yii::$app->session;
        
        if (isset($get["hash"]))
        {
            $mHash = $get["hash"];
            $identity = User::findOne(['hash' => $mHash]);
            
            if ($identity) {
				if($identity["isActive"]) {
					echo "Ваш e-mail уже подтвержден";
				} else {
					$identity["isActive"] = true;
					$identity->save();
					return $this->redirect(['auth']);
				}
			} else {
				echo "Неверный код подтверждения";
			}  
        } else {
			echo "Неверный код подтверждения";
		}
	}
	
	public function actionChangePassword() {
		
		$post = Yii::$app->request->post();
		$model = new ChangePassword();
		$error = array();
        $msg = array();
		
		if (isset($post["ChangePassword"]))
        {
            $post = $post["ChangePassword"];
			$get = Yii::$app->request->get();
			$user = Parents::findOne(['hash' => $get["hash"]]);
			
            foreach ($post as $key => $value) 
                $model->$key = $value;

            if ($post["password"] == "") {
				$error["password"] = 1;
				echo "pass";
			}
            
            if ($post["repassword"] == "") {
				$error["repassword"] = 1;
				echo "repass";
			}
			
			if($post["password"] != $post["repassword"]) {
				$error["isequal"] = 1;
				echo "isequal";
			}	
			
			if(!$user) {
				$error["nouser"] = 1;
				echo "nouser";	
			}
				
			
			if(count($error) == 0) {
				$user->password = md5($post["password"]);
                $user->save();
				return $this->redirect(['auth']);
			}
		}

		return $this->render('change_password', ['model' => $model]);
	}
	
	public function actionRecoveryPassword() {
		$model = new RecoveryPassword();
		$post = Yii::$app->request->post();
		$validator = new EmailValidator();
		$error = array();
        $msg = array();
		
		if (isset($post["RecoveryPassword"]))
        {
			$post = $post["RecoveryPassword"];
			
			foreach ($post as $key => $value) {
				 $model->$key = $value;
			}
			
			$user = Parents::findOne(['email' => $post["email"]]);
			
			if ($post["email"] == "")
                $error["email"] = 1;
			
			if (!$validator->validate($post["email"]))
                $error["format"] = 1;	
			
			if(count($user) == 0)
				$error["nouser"] = 1;		
			
			if(count($error) == 0) {
				$mHash = md5($user["hash"]);
				$user["hash"] = $mHash;
				$user->save();
				$this->SendRecoveryEmail($post["email"], $mHash);
				echo "Ссылка успешно отправлена";
			}
			
			
            
		}
		
		return $this->render('recovery_password', ['model' => $model]);
	}

    public function actionOrders()
    {
        $orders = Order::find()->where(["id_user" => Yii::$app->user->id])->all();
        Yii::$app->view->params['type_ticket'] = "Заказы";

        return $this->render('orders',['orders' => $orders]);
    }

}   
