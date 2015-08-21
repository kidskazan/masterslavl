<?


namespace app\controllers;

use Yii;
use app\models\PriceTicket;
use app\models\TypeTicket;
use app\models\TypeHours;
use app\models\DopPrice;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class PriceTicketController extends Controller
{
	public function actionIndex()
	{
		$TypeTicket = TypeTicket::find()->all();
		$model = new PriceTicket();

		$dt = Yii::$app->getRequest()->post('PriceTicket'); 
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

		$data = PriceTicket::find()->all();

		foreach ($data as $key => $val) 
			$dt_val[$val["type_day"]][$val["type_ticket"]][$val["hours"]] = $val["price"];

		$TypeHours = TypeHours::find()->all();
		foreach ($TypeHours as $val) 
			$dt_type_hours[$val->id] = $val->value;

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

		return $this->render('index', ['TypeTicket' => $TypeTicket, 'model' => $model, 'dt' => $dt, 'dt_val' => $dt_val, 
			'dt_type_hours' => $dt_type_hours, 'DopPrice' => $DopPrice, 'model_dop_price' => $model_dop_price]); 
	}
}