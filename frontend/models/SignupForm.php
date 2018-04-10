<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required','message' => 'Por favor escoge un nombre de usuario.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este nombre de usuario ya ha sido tomado.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required','message' => 'Por favor debe de colocar un correo electronico.'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255,'message' => 'Has exedido el numero de caracteres para el correo electronico debe de ser de 255'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este correo electronico ha sido tomada'],

            ['password', 'required','message' => 'Este campo es obligatorio.'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            "username"=>"Usuario",
            "email"=>"Correo electronico",
            "password"=>"Contraseña",
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
