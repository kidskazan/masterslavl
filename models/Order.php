<?php

namespace app\models;

use Yii;
use app\models\QuotaTimeTable;
use app\models\QuotaType;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $id_city
 * @property integer $date
 * @property integer $count_kids
 * @property integer $count_adult
 * @property integer $count_hours
 * @property integer $type_ticket
 * @property string $klass
 * @property integer $summ
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_city', 'date'], 'required'],
            [['id_city', 'date', 'count_kids', 'count_adult', 'count_hours', 'type_ticket', 'summ'], 'integer'],
            [['klass'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_city' => 'Id City',
            'date' => 'Date',
            'count_kids' => 'Count Kids',
            'count_adult' => 'Count Adult',
            'count_hours' => 'Count Hours',
            'type_ticket' => 'Type Ticket',
            'klass' => 'Klass',
            'summ' => 'Summ',
        ];
    }


    public function getIsSufficiency($people = false)
    {
        $count_people_now = $this->count_kids + $this->count_adult;
        
        $QuotaTimeTable = QuotaTimeTable::find()->where(['<=', 'start_date', $this->date]);
        $QuotaTimeTable = $QuotaTimeTable->andWhere(['>=', 'end_date', $this->date])->all();

        if (isset($QuotaTimeTable[0]))
        {
            $time_table = $QuotaTimeTable[0];
            $id_quota = $time_table->id_type;
        } 
        else
            $id_quota = 1;
		

        $QuotaType = QuotaType::findOne($id_quota);

        $date1 = strtotime(date("Y-m-d 00:00:00", strtotime($this->date)));
        $date2 = strtotime(date("Y-m-d 23:59:59", strtotime($this->date)));

        $count_people_order_resudie = $QuotaType->getResudie($this->type_ticket, $date1, $date2);
		
        if ($people == false)
        {
			echo "Count All=".$count_people_order_resudie;
			echo "Count Now=".$count_people_now;
            if ($count_people_now < $count_people_order_resudie)
                return false;
            else
                return true;
        }
        else
        {
            if ($count_people_order_resudie > 0)
                return true;
            else
                return false;
        }
    }
}
