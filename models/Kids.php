<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kids".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $father_name
 * @property integer $birthday
 * @property string $qr
 * @property integer $id_rank
 * @property integer $money
 * @property integer $id_station
 * @property integer $id_city
 * @property integer $date
 */
class Kids extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kids';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'father_name'], 'required'],
            [['birthday', 'id_rank', 'money', 'id_station', 'id_city', 'date'], 'integer'],
            [['name', 'surname', 'father_name'], 'string', 'max' => 255],
            [['qr'], 'string', 'max' => 32]
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
            'surname' => 'Surname',
            'father_name' => 'Father Name',
            'birthday' => 'Birthday',
            'qr' => 'Qr',
            'id_rank' => 'Id Rank',
            'money' => 'Money',
            'id_station' => 'Id Station',
            'id_city' => 'Id City',
            'date' => 'Date',
        ];
    }
}
