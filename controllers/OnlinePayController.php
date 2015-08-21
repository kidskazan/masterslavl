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
                        'actions' => ['auth', 'register', 'index'], 
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
                    $r = "Подарочные сертификаты";
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
        
        if (Yii::$app->user->identity)
            return $this->redirect(['index']);
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
                if ( strtotime(date("d.m.Y 00:00:00", strtotime($post["date"]))) < strtotime(date("d.m.Y 00:00:00")) )
                    $error["date"] = 1;

            if ($post["count_kids"] == "")
                $error["count_kids"] = 1;

            if (isset($post["count_hours"]))
            {   
                if ($post["count_hours"] == "")
                    $error["count_hours"] = 1;
            }
            else
                $error["count_hours"] = 1;

            if ($post["count_adult"] > ($post["count_kids"] * 2))
            {
                $error["count_adult"] = 1;
                $msg["count_adult"] = "На одного ребенка может быть не более двух взрослых!";
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

            if ($post["count_kids"] == "")
                $error["count_kids"] = 1; 

            if ($post["count_hours"] == "")
                $error["count_hours"] = 1;

            if (count($error) == 0)
            {
                $session = Yii::$app->session;
                $model->date = strtotime($model->date);
                $model->type_ticket = $session["type_ticket"];
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
                $model->password = md5($model->password);
                $model->username = $model->email;
                $model->save();
                return $this->redirect(['auth']);
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

        return $this->render("enter-people", ['count_kids' => $count_kids, 'count_adult' => $count_adult, "parents" => $parents, "kids" => $kids, 
            "date_enter" => $date_enter, "type_hours" => $type_hours, "count_hours" => $count_hours]);
    }

    public function actionEnterPeopleSchool()
    {
        $session = Yii::$app->session;
        $order = Order::findOne($session["order_id"]);

        if (isset($session["orderId"]))
        {
            $this->redirect($session["formUrl"]);
        }

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
        
        if (isset($_REQUEST["pay"]))
        {
            if ($ch = @curl_init()) 
            { 
                $url = 'http://57minutes.ru/index.php?r=online-pay/finish&orderId=1';
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
                    $session["bank_order_id"] = $dt->orderId;
                    $session["bank_form_url"] = $dt->formUrl;
                    $order->date = strtotime($_REQUEST["date_enter"]);

                    $this->redirect($dt->formUrl);
                }

            } 
        }

        return $this->render("enter-people-school", ['count_kids' => $count_kids, 'count_adult' => $count_adult, "parents" => $parents, "kids" => $kids, "date_enter" => $date_enter]);
    }

    public function actionAddPeople()
    {
        $session = Yii::$app->session;
        $name = $_REQUEST["name"];
        $surname = $_REQUEST["surname"];
        $father_name = $_REQUEST["father_name"];
        $date_birthday = strtotime($_REQUEST["date_birthday"]);
        $phone = $_REQUEST["phone"];
        

        if ($_REQUEST["type_adult"] != "")
            $type_adult = $_REQUEST["type_adult"];

        $order_id = $session["order_id"];
        $order = Order::findOne($order_id);

        $now_date = date("N", $order->date);

        if ($now_date <= 5)
            $type_day = 1;
        else
            $type_day = 2;

        if ((($order->count_hours == 11) or ($order->count_hours == 12)) and ($now_date == 1))
        {
            $now_day = date("d", $order->date);
            $day = $now_day/7;

            if (($day >= 1) and ($day < 2))
                $order->count_hours = 13;

            if (($day >= 3) and ($day < 4))
                $order->count_hours = 13;
        }

        
        $old = $this->getyeardiff($date_birthday);

        $TypeTicket = TypeTicket::find()->where("`age_min` <= '$old' AND `age_max` >= '$old'")->all();
        
        $type_ticket = $TypeTicket[0]->id;

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
            
            if ($type_adult == 2)
                $type_adult = 11;
            else
                $type_adult = 10;

            $price = PriceTicket::find()->where(["type_ticket" => $type_adult, "type_day" => $type_day, "hours" => $order->count_hours])->all();
            $result["price"] = $price[0]->price;

            if (isset($_REQUEST["besplatno"]))
                if ($_REQUEST["besplatno"] == "true")
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

            $price = PriceTicket::find()->where(["type_ticket" => $type_ticket, "type_day" => $type_day, "hours" => $order->count_hours])->all();
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


        $RelOrderPeople = RelOrderPeople::find()->where(["id_order" => $session["order_id"], "id_people" => $id_people, "type_people" => $type_people])->all();

        if (count($RelOrderPeople) == 0)
        {
            $RelOrderPeople = new RelOrderPeople();
            $RelOrderPeople->id_order = $session["order_id"];
            $RelOrderPeople->id_people = $id_people;
            $RelOrderPeople->type_people = $type_people;
            $RelOrderPeople->type_tiket = $type_ticket;
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



    public function getyeardiff($bday)
    {
        $today = time();
        $arr1 = getdate($bday);
        $arr2 = getdate($today);

        if((int)date('md', $today) >= (int)date('md', $bday) ) 
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

                @curl_setopt($ch, CURLOPT_URL, 'https://3dsec.sberbank.ru/payment/rest/getOrderStatus.do?userName=masterslavl-api&password=masterslavl&orderId='.$id_order); 
                @curl_setopt($ch, CURLOPT_HEADER, false); 
                @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                @curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
                @curl_setopt($ch, CURLOPT_USERAGENT, 'Masterslavl'); 
                $data = @curl_exec($ch); 
                $dt = json_decode($data);
                @curl_close($ch); 

                if ($dt->OrderStatus == 2)
                {
                    $kids = array();
                    $adults = array();

                    $orderId = $get["orderId"];

                    $order = Order::findOne(["bankOrderId" => $orderId]);
                    $orderId = $order->id;
                    $tikets_kids = RelOrderPeople::find()->where(["id_order" => $orderId, "type_people" => "2"])->all();
                    $tikets_adults = RelOrderPeople::find()->where(["id_order" => $orderId, "type_people" => "1"])->all();

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
                        $kids[$val->id]["name"] = $val->surname." ".$val->name;
                        $kids[$val->id]["id"] = $val->id;
                        $kids[$val->id]["id_rel"] = $order_kids[$val->id]["id"];
                        $kids[$val->id]["summ"] = $order_kids[$val->id]["summ"]/100;
                        $id_rel[] = $order_kids[$val->id]["id"];
                    }

                    if ($r_adult != false)
                        foreach ($r_adult as $val) 
                        {
                            $adults[$val->id]["name"] = $val->surname." ".$val->name;
                            $adults[$val->id]["id"] = $val->id;
                            $adults[$val->id]["id_rel"] = $order_adults[$val->id]["id"];
                            $adults[$val->id]["summ"] = $order_adults[$val->id]["summ"]/100;
                            $id_rel[] = $order_adults[$val->id]["id"];
                        } 

                    $txt = "";
                    foreach ($id_rel as $val) 
                    {
                        $_GET["id"] = $val;
                        $txt .= $this->getTiketContent();
                    }
                    $this->SendMail($txt, $order->id);

                    
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

    public function getTiketContent()
    {
        $get = Yii::$app->request->get();

        $user = Yii::$app->user;
    
        if (isset($get["id"]))
        {
            $id = $get["id"];
            $RelOrderPeople = RelOrderPeople::findOne($id);
            
            $order = Order::findOne($RelOrderPeople->id_order);

            if ($order->id_user != $user->id)
                exit;

            if ($ch = @curl_init()) 
            { 
                $id_order = $order->bankOrderId;

                @curl_setopt($ch, CURLOPT_URL, 'https://3dsec.sberbank.ru/payment/rest/getOrderStatus.do?userName=masterslavl-api&password=masterslavl&orderId='.$id_order); 
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
            $old = $this->getyeardiff($people->birthday);
            $TypeTicket = TypeTicket::findOne($RelOrderPeople->type_tiket);
            $name_tiket = $TypeTicket->name;

            $tm_name = TypeHours::findOne($order->count_hours);
            $time = $tm_name->value;
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

        $myview = $this->renderPartial("test_t", ["name" => $name,"surname" => $surname, "old" => $old, "name_tiket" => $name_tiket, "time" => $time, "date" => $date, "price" => $price,
            "pitanie" => $pitanie, "qr" => $qr, "date2" => $date2, "money" => $money]);

        return $myview;
    }

    public function SendMail($content, $order_id)
    {
        $user = Yii::$app->user;
        $order = Order::findOne($order_id);
        
        if (!$order->sendMail)        
        {
            $user = User::findOne($user->id);
            $email = $user->email;
            $order->sendMail = 1;
            $order->save();

            $d= new mPDF('utf-8', 'A4', '8', '', 0, 0, 0, 0, 0, 0);
            $d->writeHTML($content);
            $d->charset_in = 'utf-8'; 

            $d->list_indent_first_level = 0; 
            $d->WriteHTML($html, 2); 

            $content = $d->Output('tikets.pdf', 'S');

            $content = chunk_split(base64_encode($content));
           
            $mailto = $email;
            $from_name = 'Билеты Мастерславль';
            $from_mail = 'admin@57minutes.ru';
            $replyto = $email;
            $uid = md5(uniqid(time())); 
            $subject = 'Билеты Мастерславль';
            $message = 'Билеты Мастерславль';
            $filename = 'tikets.pdf';

            $header = "From: ".$from_name." <".$from_mail.">\r\n";
            $header .= "Reply-To: ".$replyto."\r\n";
            $header .= "MIME-Version: 1.0\r\n"; 
            $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
            $header .= "This is a multi-part message in MIME format.\r\n";
            $header .= "--".$uid."\r\n";
            $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
            $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            $header .= $message."\r\n\r\n";
            $header .= "--".$uid."\r\n";
            $header .= "Content-Type: application/pdf; name=\"".$filename."\"\r\n";
            $header .= "Content-Transfer-Encoding: base64\r\n";
            $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
            $header .= $content."\r\n\r\n";
            $header .= "--".$uid."--"; 
            $is_sent = @mail($mailto, $subject, "", $header);
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
            
            $order = Order::findOne($RelOrderPeople->id_order);

            if ($order->id_user != $user->id)
                exit;

            if ($RelOrderPeople->type_people == 2)
                $people = Kids::findOne($RelOrderPeople->id_people);
            elseif ($RelOrderPeople->type_people == 1)
                $people = Parents::findOne($RelOrderPeople->id_people);

            $name = $people->surname." ".$people->name;
            $old = $this->getyeardiff($people->birthday);
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
            $gen_options_tikets = GeneralOptions::findOne(["name" => "gen_options_tikets"]);
            $date = strtotime($_REQUEST["date"]);

            if (($date >= $gen_options_tikets->date1) and ($date <= $gen_options_tikets->date2))
                $options = $gen_options_tikets->value;
            else
                $options = $gen_options_tikets->default_value;

            $TypeHours = TypeHours::find()->where(["options" => $options])->all();
            foreach ($TypeHours as $val) 
                $type_hours[$val->id] = $val->value;

            $result["status"] = "ok";
            $result["result"] = $type_hours;
        }

        return json_encode($result);
    }
}   
