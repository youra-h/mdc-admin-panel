<?php
namespace backend\models\forms;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class Form_UserSearch extends Model
{
    public $username;
    public $email;
    public $status;
    public $active = false;
    public $passive = false;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'status', 'active', 'passive'], 'safe'],            
            [['active', 'passive'], 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'email' => 'Пароль',
            'active' => 'Запомнить меня',
        ];
    }
}
