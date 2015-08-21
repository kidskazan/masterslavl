<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parents".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $father_name
 * @property integer $birthday
 * @property string $qr
 * @property integer $status
 * @property integer $date
 * @property string $phone
 * @property string $phone2
 * @property string $email
 * @property string $username
 * @property string $password
 */
class Parents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'father_name'], 'required'],
            [['birthday', 'status', 'date'], 'integer'],
            [['name', 'surname', 'father_name', 'phone', 'phone2', 'email', 'username', 'password'], 'string', 'max' => 255],
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
            'status' => 'Status',
            'date' => 'Date',
            'phone' => 'Phone',
            'phone2' => 'Phone2',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
        ];
    }
}
