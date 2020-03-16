<?php

namespace app\models;

use app\models\Token;
use app\models\User;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{


    private $_user;

    public $name;
    public $hash_pass;

   
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'hash_pass'], 'required'],
            // password is validated by validatePassword()
            ['hash_pass', 'validatePassword'],
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
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->hash_pass)) {
                $this->addError($attribute, 'Неправильный пользователь или пароль.');
            }
        }
    }

    /**
     * @return Token|null
     */
    public function auth()
    {
        if ($this->validate()) {
            $token = new Token();
            $token->user_id = $this->getUser()->id;
            $token->generateToken(time() + 3600 * 24);
            return $token->save() ? $token : null;
        } else {
            return null;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->name);
        }

        return $this->_user;
    }
}
