<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class ChangePassForm extends Model
{

    public $password;
    public $repassword;

    /**
     * Setting table name
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['password', 'repassword'], 'required'],

            [['password'], 'string', 'min' => 5],
            // password is validated by validatePassword()
            ['repassword', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->password !== $this->repassword) {
                $this->addError($attribute, 'Password and Re-password must be match.');
            }
        }
    }

}
