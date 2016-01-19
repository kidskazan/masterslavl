<?


namespace app\controllers;

use Yii;
use app\models\PriceTicket;
use app\models\TypeTicket;
use app\models\TypeHours;
use app\models\Programms;
use app\models\DopPrice;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\PriceProgramms;
use app\models\TypeDayProgramms;
use app\models\PriceTicket2;
use app\models\PriceTicket3;


class PriceTicketController extends Controller
{
	public function actionIndex()
	{
		$TypeTicket = TypeTicket::find()->all();
		$model = new PriceTicket();
		$model2 = new PriceTicket2();
		$model3 = new PriceTicket3();

		$model_programms = new PriceProgramms();

		$dt = Yii::$app->getRequest()->post('PriceTicket'); 
		$dt2 = Yii::$app->getRequest()->post('PriceTicket2'); 
		$dt3 = Yii::$app->getRequest()->post('PriceTicket3'); 
		$dt_dop_price = Yii::$app->getRequest()->post("DopPrice"); 

		if ($dt["price"])
		{
			foreach ($dt["price"] as $type_day => $value)
			{
				foreach ($value as $type_ticket => $val) 
				{
					foreach ($val as $hours => $price) 
					{
							$res = PriceTicket::find()->where("type_day=$type_day AND type_ticket=$type_ticket AND hours=$hours")->all();
							if ($res)
							{
								$id = $res[0]->id;

								$record = PriceTicket::findOne($id);

								$record->price = $price;
								$record->update();
							}
							else
							{
								$record = new PriceTicket;

								$record->type_day = $type_day;
								$record->type_ticket = $type_ticket;
								$record->hours = $hours;
								$record->price = $price;

								$record->insert();
							}
					}
				}
			} 
		}

		if ($dt2["price"])
		{
			foreach ($dt2["price"] as $type_day => $value)
			{
				foreach ($value as $type_ticket => $val) 
				{
					foreach ($val as $hours => $price) 
					{
							$res = PriceTicket2::find()->where("type_day=$type_day AND type_ticket=$type_ticket AND hours=$hours")->all();
							if ($res)
							{
								$id = $res[0]->id;

								$record = PriceTicket2::findOne($id);

								$record->price = $price;
								$record->update();
							}
							else
							{
								$record = new PriceTicket2;

								$record->type_day = $type_day;
								$record->type_ticket = $type_ticket;
								$record->hours = $hours;
								$record->price = $price;

								$record->insert();
							}
					}
				}
			} 
		}
		
		if ($dt3["price"])
		{
			foreach ($dt3["price"] as $type_day => $value)
			{
				foreach ($value as $type_ticket => $val) 
				{
					foreach ($val as $hours => $price) 
					{
							$res = PriceTicket3::find()->where("type_day=$type_day AND type_ticket=$type_ticket AND hours=$hours")->all();
							if ($res)
							{
								$id = $res[0]->id;

								$record = PriceTicket3::findOne($id);

								$record->price = $price;
								$record->update();
							}
							else
							{
								$record = new PriceTicket3;

								$record->type_day = $type_day;
								$record->type_ticket = $type_ticket;
								$record->hours = $hours;
								$record->price = $price;

								$record->insert();
							}
					}
				}
			} 
		}
		
		
		$dt_programms = Yii::$app->getRequest()->post('PriceProgramms');
		if ($dt_programms["programms"])
		{
			foreach ($dt_programms["programms"] as $id_programm => $programm)
			{
				foreach ($programm as $id_type_day => $price)
				{
					$res = PriceProgramms::findOne(["id_programm" => $id_programm, "id_time" => $id_type_day]);
					
					if ($res)
					{
						$res->price = $price;
						$res->save();
					}
					else
					{
						$res = new PriceProgramms();
						$res->id_programm = $id_programm;
						$res->id_time = $id_type_day;
						$res->price = $price;
						
						$res->save();
					}
				}
			}
		}
		
		$data = PriceTicket::find()->all();
		$data2 = PriceTicket2::find()->all();
		$data3 = PriceTicket3::find()->all();

		foreach ($data as $key => $val) 
			$dt_val[$val["type_day"]][$val["type_ticket"]][$val["hours"]] = $val["price"];

		foreach ($data2 as $key => $val) 
			$dt_val2[$val["type_day"]][$val["type_ticket"]][$val["hours"]] = $val["price"];
			
		foreach ($data3 as $key => $val) 
			$dt_val3[$val["type_day"]][$val["type_ticket"]][$val["hours"]] = $val["price"];

		$TypeHours = TypeHours::find()->all();
		foreach ($TypeHours as $val) 
			$dt_type_hours[$val->id] = $val->value;

		$programms = Programms::find()->all();
		$programms_type_day = TypeDayProgramms::find()->all();
		
		$data_programms = PriceProgramms::find()->all();
		$dt_programms_val = "";
		foreach ($data_programms as $val)
			$dt_programms_val[$val["id_programm"]][$val["id_time"]] = $val["price"];

		$model_dop_price = new DopPrice;

		if (count($dt_dop_price) > 0)
		{
			foreach ($dt_dop_price as $key => $value) 
			{
				$res = DopPrice::find()->where(["name" => $key])->all();
				$res[0]->price = $value;
				$res[0]->update();
			}
		}

		$DopPrice = DopPrice::find()->all();

		return $this->render('index', ['TypeTicket' => $TypeTicket, 'model' => $model, 'model2' => $model2, 'model3' => $model3, 'dt' => $dt, 'dt2' => $dt2, 'dt3' => $dt3,
			'dt_val' => $dt_val, 'dt_val2' => $dt_val2, 'dt_val3' => $dt_val3,
			'dt_type_hours' => $dt_type_hours, 'DopPrice' => $DopPrice, 'model_dop_price' => $model_dop_price,
			'programms' => $programms, 'programms_type_day' => $programms_type_day, 'model_programms' => $model_programms, 
			'dt_val_programms' => $dt_programms_val]); 
	}
}