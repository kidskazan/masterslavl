<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\Object;
use yii\base\Component;



class generalState extends Model
{
    public $id_city = 1;


    public function getWorkTime()
    {
        $items = WorkTime::find()->all();

        return $items;
    }

    public function getCountKidsCity()
    {
        $city = City::findOne($this->id_city);

        return $city->count_kids;
    }

    public function getStationCountKids()
    {
        $stations = Stations::find()->where(['id_city' => $this->id_city])->all();

        $result = 0;

        foreach ($stations as $stat) 
            $result += $stat->countKidsNow;

        return $result;
    }

    public function getStreetCountKids()
    {
        return $this->countKidsCity - $this->stationCountKids;
    }
}
