<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class ChangePassword extends Model
{
    public $password;
    public $repassword;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            ['password', 'password'],
            ['repassword', 'repassword']
        ];
    }
}
