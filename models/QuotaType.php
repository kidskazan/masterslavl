<?php

namespace app\models;

use Yii;
use app\models\Order;
use app\models\RelOrderPeople;

/**
 * This is the model class for table "quota_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $individual
 * @property integer $abonement
 * @property integer $programm
 * @property integer $sertificate
 * @property integer $meropriyatie
 * @property integer $shool_vizit
 * @property integer $corpototive_vizit
 */
class QuotaType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quota_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'individual', 'abonement', 'programm', 'sertificate', 'meropriyatie', 'shool_vizit', 'corpototive_vizit'], 'required'],
            [['individual', 'abonement', 'programm', 'sertificate', 'meropriyatie', 'shool_vizit', 'corpototive_vizit'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'individual' => 'Индивидуальное посещение',
            'abonement' => 'Абонементы',
            'programm' => 'Программы',
            'sertificate' => 'Сертификаты',
            'meropriyatie' => 'Мероприятия',
            'shool_vizit' => 'Школьное посещение',
            'corpototive_vizit' => 'Корпоративное посещение',
        ];
    }

    public function getResudie($id_type, $date1, $date2)
    {
        $query = Order::find()->where(['type_ticket' => $id_type]);
        $query = $query->andWhere(['<=', 'date', $date1]);
        $query = $query->andWhere(['>=', 'date', $date2]);

        $orders = $query->all();

        foreach ($orders as $order)
            $id_order[] = $order->id;

        if (isset($id_order) and (count($id_order) > 0))
        {
            $RelOrderPeople = RelOrderPeople::find()->where(['id_order' => $id_order]);
            $r = $RelOrderPeople->count();
        }
        else
            $r = 0;

        switch ($id_type) {
            case 1:
                $r = $this->individual - $r;
                break;

            case 2:
                $r = $this->sertificate - $r;
                break;

            case 3:
                $r = $this->shool_vizit - $r;
                break;

            case 4:
                $r = $this->meropriyatie - $r;
                break;

            case 5:
                $r = $this->corpototive_vizit - $r;
                break;

            case 6:
                $r = $this->programm - $r;
                break;

            case 7:
                $r = $this->abonement - $r;
                break;
            
        }

        return $r;
    }
}
