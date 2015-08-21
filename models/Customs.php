<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customs".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $father_name
 * @property integer $birthday
 * @property string $qr
 * @property integer $date
 * @property integer $likes
 * @property integer $dislikes
 * @property string $description
 * @property string $login
 * @property string $password
 * @property string $token
 * @property string $reg_id
 * @property integer $id_city
 */
class Customs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['birthday', 'date', 'likes', 'dislikes', 'id_city'], 'integer'],
            [['description'], 'string'],
            [['name', 'surname', 'father_name', 'login', 'reg_id'], 'string', 'max' => 255],
            [['qr', 'password', 'token'], 'string', 'max' => 32]
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
            'date' => 'Date',
            'likes' => 'Likes',
            'dislikes' => 'Dislikes',
            'description' => 'Description',
            'login' => 'Login',
            'password' => 'Password',
            'token' => 'Token',
            'reg_id' => 'Reg ID',
            'id_city' => 'Id City',
        ];
    }
}
