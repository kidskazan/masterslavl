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
use app\models\Stations;
use app\models\Mentor;
use app\models\SessStation;
use app\models\Scenario;
use app\models\SessKids;
use app\models\CommentKids;

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
			$order = Order::findOne(["id" => $RelOrderPeople->id_order]);
			$mDate = date("d-m-Y", $order->date);
			$currentDate = date("d-m-Y", time());
			
			$mCountHour = $order->count_hours;
			
			$mCurrentCountHour = 0;
			$mCurrentTimeHour = date("H", $order->date);
			$mCurrentTimeMinutes = date("i", $order->date);
			
			if($mCurrentTimeHour > 13) {
				if($mCurrentTimeMinutes >= 30) {
					$mCurrentCountHour = 12;
				} else {
					$mCurrentCountHour = 11;
				}
			} else {
				$mCurrentCountHour = 11;
			}
			
			if ($currentDate != $mDate) {
				$r = $this->setError(504);
			}
			//else if ($mCurrentCountHour != $mCountHour) {
				//$r = $this->setError(505);
			//}
			else if ($RelOrderPeople->status == 1) {
				$r = $this->setError(500);
			}
			else if ($RelOrderPeople->status == 2) {
				$r = $this->setError(502);
			}
			else
			{
				$r["status"] = "ok";
				$RelOrderPeople->status = 1;
				$RelOrderPeople->save();
			}
		}

		return json_encode($r);
	}
	
	//Осуществление возврата денежных средств
	public function actionRefundMoney() {
		$customs = Customs::findOne(['token' => $this->get["token"]]);
		
		if (!$customs)
			$r = $this->setError(205);
		else
		{
			$RelOrderPeople = RelOrderPeople::findOne(["qr" => $this->get["qr"]]);
			$order = Order::findOne(["id" => $RelOrderPeople->id_order]);
			if ($RelOrderPeople->status == 1)
				$r = $this->setError(500);
			if ($RelOrderPeople->status == 2)
				$r = $this->setError(502);
			else
			{
				if ($ch = @curl_init()) 
				{
					$id_order = $order->id;
					$amount = $RelOrderPeople->summ;
					$bankOrderId = $order->bankOrderId;
					
					$mUrl = 'https://securepayments.sberbank.ru/payment/rest/refund.do?userName=masterslavl-api&password=shrjkisi&orderId='.$bankOrderId.'&amount='.$amount;

					@curl_setopt($ch, CURLOPT_URL, $mUrl); 
					@curl_setopt($ch, CURLOPT_HEADER, false); 
					@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					@curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
					@curl_setopt($ch, CURLOPT_USERAGENT, 'Masterslavl'); 
					$data = @curl_exec($ch); 
					$dt = json_decode($data);
					
					@curl_close($ch); 

					$bankErrorCode = $dt->errorCode;
					
					if($bankErrorCode == 0) {
						$r["status"] = "ok";
						$RelOrderPeople->status = 2;
						$RelOrderPeople->save();
					} else {
						$r = $this->setError(503);
					}


				} 
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
			if ($RelOrderPeople->status_money == 1) {
				$r = $this->setError(500);
			}
			else if ($RelOrderPeople->status == 2) {
				$r = $this->setError(502);
			}
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
				if ($RelOrderPeople->type_people == 2) {
					$r["money"] = 50;
				} else {
					$r["money"] = 0;
				}
					
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
	
	
	public function actionSearchKids() {
		$searchText = $this->get["text"];
		if(isset($searchText)) {
			$kids = Kids::find()->where("LOWER(`name`) LIKE '".mb_strtolower($searchText)."%' OR LOWER(`surname`) LIKE '".mb_strtolower($searchText)."%' OR 
					LOWER(`father_name`) LIKE '".mb_strtolower($searchText)."%' ")->asArray()->all();
			
			
			echo json_encode($kids);
		}
	}
	
	//Привязка устройства к конкретной станции
	//Входные параметры: $id - станции
	//Ответ status: ok, hash: md5(time+id)
	//Ошибки: 101, 102
	function actionSetStation() {
		
		$station = Stations::findOne(['id' => $this->get["id"]]);
		
		if(count($station) == 0) {
			$r = $this->setError(101);
		} else {
			if($station->hash) {
				$r = $this->setError(102);
			} else {
				$r["status"] = "ok";
				$mHash = md5($station->id.''.time());
				$station->hash = $mHash;
				$station->save();
				$r["hash"] = $mHash;
			}
		}
			
		return json_encode($r);
		
	}

	
	//Получить список станций в конкретном городе
	//Входные параметры: $id-city
	//Ответ status:ok stations:[id, name]
	//Ошибки: 103
	function actionGetStations() {
		
		$id_city = $this->get["id_city"];
		
		$city = City::findOne(['id' => $id_city]);
		
		if(count($city) == 0) {
			$r = $this->setError(150);
		} else {
			$stations = Stations::find()->where("id_city='".$id_city."' ")->asArray()->all();
			$r["status"] = "ok";
			$r["stations"] = $stations;
		}
		
		return json_encode($r);
		
	}
	
	
	//Авторизация наставника
	//Входные параметры: $login, $password, $hash
	//Ответ status: ok, token: md5($login+time())
	//Ошибки: 201, 202, 101
	function actionMentorAuth() {
		
		$mentor = Mentor::findOne(['login' => $this->get["login"], "password" => md5($this->get["password"])]);
		
		if (!$mentor)
			$r = $this->setError(201);
		elseif ($mentor->token != "")
			$r = $this->setError(202);
		else
		{
			$station = Stations::findOne(['hash' => $this->get["hash"]]);
			if(count($station) == 0) {
				$r = $this->setError(101);
			} else {
				$r["status"] = "ok";
				$token = md5($mentor->login.time());
				$mentor->token = $token;
				$mentor->save();
				
				$sess_station = new SessStation;
				
				$sess_station->id_station = $station->id;
				$sess_station->id_mentor = $mentor->id;
				$sess_station->input = time();
				$sess_station->token = $token;
				$sess_station->save();
				
				$r["token"] = $token;
			}
		}

		return json_encode($r);
	}
	
	//Получить список сценариев
	//Входные параметры: $hash, $token
	//Ответ status: ok, scenario:[$id, $name]
	//Ошибки: 205, 101
	function actionGetScenarioList() {
		
		$station = Stations::findOne(['hash' => $this->get["hash"]]);
		$mentor = Mentor::findOne(['token' => $this->get["token"]]);
		
		if(!$station) {
			$r = $this->setError(101);
		} else if(!$mentor) {
			$r = $this->setError(205);
		} else {
			$scenario = Scenario::find()->where("id_station='".$station->id."' ")->asArray()->all();
			
			$r["status"] = "ok";
			$r["scenario"] = $scenario;
		}
		
		return json_encode($r);
		
	}
	
	
	//Впустить ребенка на станцию
	//Входные параметры: $token, $hash, $qr,
	function actionEnterKidStation() {
		
		$mentor = Mentor::findOne(['token' => $this->get["token"]]);
		$station = Stations::findOne(['hash' => $this->get["hash"]]);
		
		if(!$mentor) {
			$r = $this->setError(205);
		} elseif(!$station) {
			$r = $this->setError(101);
		} else {
			$kids = Kids::findOne(['qr' => $this->get["qr"]]);
			if(!$kids) {
				$RelOrderPeople = RelOrderPeople::findOne(["qr" => $this->get["qr"]]);
				if(!$RelOrderPeople) {
					$r = $this->setError(301);
				} else {
					$type_people = $RelOrderPeople->type_people;
					if($type_people == 2) {
						$kids = Kids::findOne(['id' => $RelOrderPeople->id_people]);
						if($kids) {
							$kids->id_station = $station->id;
							$kids->money = $kids->money - $station->price;
							$kids->save();
						} else {
							$r = $this->setError(301);
						}
					} else if($type_people == 1) {
						$r = $this->setError(301);
					}
				}
			} else {
				$kids->id_station = $station->id;
				$kids->money = $kids->money - $station->price;
				$kids->save();
			}
		}
		
		return json_encode($r);
		
	}
	
	//Выпустить ребнка со станции
	//Входные параметры: $token, $hash, $qr
	function actionExitKidStation() {
		
		$mentor = Mentor::findOne(['token' => $this->get["token"]]);
		$station = Stations::findOne(['hash' => $this->get["hash"]]);
		
		if(!$mentor) {
			$r = $this->setError(205);
		} elseif(!$station) {
			$r = $this->setError(101);
		} else {
			$kids = Kids::findOne(['qr' => $this->get["qr"]]);
			if(!$kids) {
				$RelOrderPeople = RelOrderPeople::findOne(["qr" => $this->get["qr"]]);
				if(!$RelOrderPeople) {
					$r = $this->setError(301);
				} else {
					$type_people = $RelOrderPeople->type_people;
					if($type_people == 2) {
						$kids = Kids::findOne(["id" => $RelOrderPeople->id_people]);
						if($kids) {
							$kids->money = $kids->money + $station->price;
							$kids->id_station = 0;
							$kids->save();
						} else {
							$r = $this->setError(301);
						}
					} elseif($type_people == 1) {
						$r = $this->setError(301);
					} else {
						$r = $this->setError(301);
					}
				}
			} else {
				$kids->money = $kids->money + $station->price;
				$kids->id_station = 0;
				$kids->save();
			}
		}
		
		return json_encode($r);
		
	}
	
	//Закончить занятие
	//Входные параметры: $token, $hash
	function actionEndLesson() {
		
		$mentor = Mentor::findOne(['token' => $this->get["token"]]);
		$station = Stations::findOne(['hash' => $this->get["hash"]]);
		
	}
	
	//Оставить комментарий
	//Входные параметры: $token, $hash, $qr, $text
	function actionSetComment() {
		
		$mentor = Mentor::findOne(['token' => $this->get["token"]]);
		$station = Stations::findOne(['hash' => $this->get["hash"]]);
		$kids = Kids::findOne(['qr' => $this->get["qr"]]);
		
		if(!$mentor) {
			$r = $this->setError(205);
		} elseif(!$station) {
			$r = $this->setError(101);
		} elseif(!$kids) {
			$r = $this->setError(301);
		} else {
			$r["status"] = "ok";
			$comment_kids = new CommentKids;
			$comment_kids->id_kids = $kids->id;
			$comment_kids->id_mentor = $mentor->id;
			$comment_kids->id_station = $station->id;
			$comment_kids->date = time();
			$comment_kids->text = $this->get["text"];
			$comment_kids->save();
		}
		//$comment_kids = new CommentKids;
		return json_encode($r);
	}
	
	function actionDeleteComment() {
		
	}
	
	function actionGetKidsParents() {
		
		$mentor = Mentor::findOne(['token' => $this->get["token"]]);
		$kids = Kids::findOne(['qr' => $this->get["qr"]]);
		
		$parents = array();
		$r = array();
		
		if(!$mentor) {
			$r = $this->setError(205);
		} else {
			if(!$kids) {
				$kidRelOrderPeople = RelOrderPeople::findOne(["qr" => $this->get["qr"]]);
				if($kidRelOrderPeople) {
					$type_people = $kidRelOrderPeople->type_people;
					if($type_people == 2) {
						$kids = Kids::findOne(["id" => $kidRelOrderPeople->id_people]);
						$RelOrderPeople = RelOrderPeople::find()->where("id_people='".$kids->id."' AND type_people=2 ")->asArray()->all();
						if($RelOrderPeople) {
							foreach($RelOrderPeople as $val) {
								$mIDOrder = $val["id_order"];
								$mRelOrderPeople = RelOrderPeople::find()->where("id_order='".$mIDOrder."' AND type_people=1 ")->asArray()->all();
								if($mRelOrderPeople) {
									$i = 0;
									foreach($mRelOrderPeople as $relVal) {
										$mIDParent = $relVal["id_people"];
										$mParent = Parents::findOne(['id' => $mIDParent]);
										if($mParent) {
											$parents[$i]["name"] = $mParent->name;
											$parents[$i]["surname"] = $mParent->surname;
											$parents[$i]["father_name"] = $mParent->father_name;
											$parents[$i]["phone_number"] = $mParent->phone;
											$parents[$i]["email"] = $mParent->email;
										}
										$i++;
									}
								}
							}
						}
						if($parents) {
							$r["status"] = "ok";
							$r["parent_list"] = $parents;
						} else {
							$r = $this->setError(205);
						}
					} elseif($type_people == 1) {
						$r = $this->setError(301);
					} else {
						$r = $this->setError(301);
					}
				} else {
					$r = $this->setError(301);
				}
			} else {
				$RelOrderPeople = RelOrderPeople::find()->where("id_people='".$kids->id."' AND type_people=2 ")->asArray()->all();
				if($RelOrderPeople) {
					foreach($RelOrderPeople as $val) {
						$mIDOrder = $val["id_order"];
						$mRelOrderPeople = RelOrderPeople::find()->where("id_order='".$mIDOrder."' AND type_people=1 ")->asArray()->all();
						if($mRelOrderPeople) {
							$i = 0;
							foreach($mRelOrderPeople as $relVal) {
								$mIDParent = $relVal["id_people"];
								$mParent = Parents::findOne(['id' => $mIDParent]);
								if($mParent) {
									$parents[$i]["name"] = $mParent->name;
									$parents[$i]["surname"] = $mParent->surname;
									$parents[$i]["father_name"] = $mParent->father_name;
									$parents[$i]["phone_number"] = $mParent->phone;
									$parents[$i]["email"] = $mParent->email;
								}
								$i++;
							}
						}
					}
				}
				if($parents) {
					$r["status"] = "ok";
					$r["parent_list"] = $parents;
				} else {
					$r = $this->setError(205);
				}
			}
			
		}
		
		return json_encode($r);
		
	}
	
	function actionGetKidInfo() {
		
	}
	
	
	/********************************************************КАССОВЫЕ АПИ МЕТОДЫ**********************************************************************/
	
	//Get All Offers
	function actionGetAllOffers() {
		
		$outputOffers = array();
		
		$order = Order::find()->limit(40)->offset(5000)->all();
		
		if($order) {
			
			foreach($order as $val) {
				
				$outputOfferElement = array();
				
				$date = $val["date"];
				$id = $val["id"];
				$status = $val["sendMail"];
				$type_ticket = $val["type_ticket"];
				$orderType = "Онлайн";
				$summ = $val["summ"];
				$refundSumm = 0;
				$id_user = $val["id_user"];
				
				$surname = "";
				$name = "";
				$father_name = "";
				
				$fullName = "";
				
				$parents = Parents::findOne(["id" => $id_user]);
				
				if($parents) {
					$name = $parents->name;
					$surname = $parents->surname;
					$father_name = $parents->father_name;
					$fullName = $surname.' '.$name.' '.$father_name;
				}
				
				
				$outputOfferElement["id"] = $id;
				$outputOfferElement["date"] = $date;
				$outputOfferElement["status"] = $status;
				$outputOfferElement["type_ticket"] = $type_ticket;
				$outputOfferElement["orderType"] = $orderType;
				$outputOfferElement["summ"] = $summ;
				$outputOfferElement["refundSumm"] = $refundSumm;
				$outputOfferElement["fullName"] = $fullName;
				$outputOffers[] = $outputOfferElement;
				
			}
			
			$r["status"] = "ok";
			$r["offers"] = $outputOffers;
			
		} else {
			$r = $this->setError(101);
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