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
use app\models\Customs;
use app\models\Bankir;
use yii\filters\AccessControl;
use yii\helpers\Url;
use xj\qrcode\QRcode;
use xj\qrcode\actions\QRcodeAction;
use xj\qrcode\widgets\Text;
use xj\qrcode\widgets\Email;
use xj\qrcode\widgets\Card;
use kartik\mpdf\Pdf;
use yii\validators\EmailValidator;

require(__DIR__ . '/../vendor/api/error.php');

class ApiController extends \yii\web\Controller
{
	
	public $get;

	public function init()
	{
		$this->get= Yii::$app->request->get();
	}

	public function actionTest()
	{
		$r = $this->setError(101);
		echo json_encode($r);
	}

	//авторизация таможеника
	public function actionCustomAuth()
	{
		$customs = Customs::findOne(['login' => $this->get["login"], "password" => md5($this->get["password"])]);
		if (!$customs)
			$r = $this->setError(201);
		elseif ($customs->token != "")
			$r = $this->setError(208);
		else
		{
			$r["status"] = "ok";
			$token = md5($customs->login.time());
			$customs->token = $token;
			$customs->save();
			$r["token"] = $token;
		}

		return json_encode($r);
	}

	//выход таможеника
	public function actionCustomLogout()
	{
		$customs = Customs::findOne(['token' => $this->get["token"]]);

		if (!$customs)
			$r = $this->setError(205);
		else
		{
			$r["status"] = "ok";
			$customs->token = "";
			$customs->save();
		}

		return json_encode($r);
	}

	//ввод ребенка по qr
	public function actionEnterPeopleCity()
	{
		$customs = Customs::findOne(['token' => $this->get["token"]]);

		if (!$customs)
			$r = $this->setError(205);
		else
		{
			$RelOrderPeople = RelOrderPeople::findOne(["qr" => $this->get["qr"]]);
			if ($RelOrderPeople->status == 1)
				$r = $this->setError(500);
			else
			{
				$r["status"] = "ok";
				$RelOrderPeople->status = 1;
				$RelOrderPeople->save();
			}
		}

		return json_encode($r);
	}

	//авторизация банкира
	public function actionBankirAuth()
	{
		$bankir = Bankir::findOne(['login' => $this->get["login"], "password" => md5($this->get["password"])]);
		if (!$bankir)
			$r = $this->setError(201);
		elseif ($bankir->token != "")
			$r = $this->setError(208);
		else
		{
			$r["status"] = "ok";
			$token = md5($bankir->login.time());
			$bankir->token = $token;
			$bankir->save();
			$r["token"] = $token;
		}

		return json_encode($r);
	}

	//выход банкира
	public function actionBankirLogout()
	{
		$bankir = Bankir::findOne(['token' => $this->get["token"]]);

		if (!$bankir)
			$r = $this->setError(205);
		else
		{
			$r["status"] = "ok";
			$bankir->token = "";
			$bankir->save();
		}

		return json_encode($r);
	}

	//выдача денег ребенку
	public function actionEnterPeopleMoney()
	{
		$bankir = Bankir::findOne(['token' => $this->get["token"]]);

		if (!$bankir)
			$r = $this->setError(205);
		else
		{
			$RelOrderPeople = RelOrderPeople::findOne(["qr" => $this->get["qr"]]);
			if ($RelOrderPeople->status_money == 1)
				$r = $this->setError(500);
			else
			{
				$r["status"] = "ok";
				$RelOrderPeople->status_money = 1;
				$RelOrderPeople->save();
			}
		}

		return json_encode($r);
	}

	//информация по билету по токену и qr
	public function actionGetTicketInfo()
	{
		$type_user = $this->get["type_user"];

		if ($type_user == 1)
			$name_table = new Customs;
		elseif ($type_user == 2)
			$name_table = new Bankir;

		$controller = $name_table::findOne(["token" => $this->get["token"]]);
		
		if (!$controller)
			$r = $this->setError(205);
		else
		{
			$RelOrderPeople = RelOrderPeople::findOne(["qr" => $this->get["qr"]]);

			if (!$RelOrderPeople)
				$r = $this->setError(501);
			else
			{
				$r["status"] = "ok";

				if ($RelOrderPeople->type_people == 1)
				{
					$type_people = new Parents;
					$r["type_people"] = "Adult";
				}
				elseif ($RelOrderPeople->type_people == 2)
				{
					$type_people = new Kids;
					$r["type_people"] = "Kids";
				}

				$order = Order::findOne($RelOrderPeople->id_order);

				$people = $type_people::findOne($RelOrderPeople->id_people);

				$r["name"] = $people->name;
				$r["surname"] = $people->surname;
				$r["father_name"] = $people->father_name;
				$dt_txt = date("Y-m-d", $people->birthday);
				$datetime1 = date_create($dt_txt);
				$datetime2 = date_create();
				$interval = date_diff($datetime1, $datetime2);
				$r["birthday"] = $interval->format('%y')." лет (".date("d.m.Y", $people->birthday).")";
				$r["phone"] = $people->phone;
				$r["summ"] = $RelOrderPeople->summ/100;
				$r["pitanie"] = $RelOrderPeople->pitanie;
				$r["status_enter"] = $RelOrderPeople->status;
				$r["status_money"] = $RelOrderPeople->status_money;
				$r["count_hours"] = $order->count_hours;
				if ($RelOrderPeople->type_people == 2)
					$r["money"] = 50;
				$type_tiket = TypeTicket::findOne($RelOrderPeople->type_tiket);
				$r["type_tiket"] = $type_tiket->name;
				$d = $order->date;
				$date1 = date("d.m.Y", $d);
            	$date2 = date("d.m.Y", mktime(0,0,0,date("m", $d) + 6,date("d", $d),date("Y", $d)));
            	$r["date1"] = $date1;
            	$r["date2"] = $date2;
			}
		}

		return json_encode($r);
	} 



	function setError($number)
	{
		global $error;
		
		$r["status"] = "error";
		$r["error_code"] = $number;
		$r["error"] = $error[$number];
		
		return $r;
	}
 
}