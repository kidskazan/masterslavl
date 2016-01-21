<?php

namespace app\models;

use Yii;
use app\models\NewsUvedomlenie;
use app\models\News;
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
            [['birthday', 'status', 'date', 'isActive'], 'integer'],
            [['name', 'surname', 'father_name', 'phone', 'phone2', 'email', 'username', 'password'], 'string', 'max' => 255],
            [['qr', 'hash'], 'string', 'max' => 32]
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
			'hash' => 'Hash',
			'isActive' => 'isActive',
        ];
    }

    public function getNewsUvedomlenie()
    {
        return $this->hasMany(NewsUvedomlenie::className(), ['id_parents' => 'id']);
    }


    public function sendNews($name, $msg)
    {
        $news = new NewsUvedomlenie();
        $news->id_parents = $this->id;
        $news->name = $name;
        $news->text = $msg;
        $news->date = time();
        $news->status = 0;

        $news->save();
    }

    public function getLastNews()
    {
        $field = NewsUvedomlenie::find()->orderBy(["id" => SORT_DESC])->limit(1)->all();

        return $field[0]->id;
    }

    public function getCountNewNews()
    {
        $items = $this->hasMany(NewsUvedomlenie::className(), ['id_parents' => 'id']);
        $items = $items->where(['status' => 0]);

        return $items->count();
    }

    public function viewNews($id)
    {
        $news = NewsUvedomlenie::findOne($id);

        if ($news)
        {
            if ($news->status == 0)
            {
                $news->status = 1;
                $news->save();
            }

            return $news;   
        }

        return false;
    }

    public function getCountNews()
    {
        $items = $this->hasMany(NewsUvedomlenie::className(), ['id_parents' => 'id']);

        return $items->count();
    }

    public function getNews()
    {
        $items = News::find()->all();

        return $items;
    }
 

}
