<?php

namespace backend\models;

use yii\helpers\ArrayHelper;
use Yii;
 
class User extends \common\models\User
{
    // const SCENARIO_ADMIN_CREATE = 'adminCreate';
    // const SCENARIO_ADMIN_UPDATE = 'adminUpdate';
 
    // public $newPassword;
    // public $newPasswordRepeat;
 
    // public function rules()
    // {
    //     return ArrayHelper::merge(parent::rules(), [
    //         [['newPassword', 'newPasswordRepeat'], 'required', 'on' => self::SCENARIO_ADMIN_CREATE],
    //         ['newPassword', 'string', 'min' => 6],
    //         ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],
    //     ]);
    // }
 
    // public function scenarios()
    // {
    //     $scenarios = parent::scenarios();
    //     $scenarios[self::SCENARIO_ADMIN_CREATE] = ['username', 'email', 'status_ref_ident', 'last_name', 'first_name', 'mid_name', 'newPassword', 'newPasswordRepeat'];
    //     $scenarios[self::SCENARIO_ADMIN_UPDATE] = ['last_name', 'first_name', 'mid_name', 'status_ref_ident', 'newPassword', 'newPasswordRepeat'];
    //     return $scenarios;
    // }
 
    // public function attributeLabels()
    // {
    //     return ArrayHelper::merge(parent::attributeLabels(), [
    //         'role' => Yii::t('app', 'USER_ROLE'),
    //         'newPassword' => Yii::t('app', 'USER_NEW_PASSWORD'),
    //         'newPasswordRepeat' => Yii::t('app', 'USER_REPEAT_PASSWORD'),
    //     ]);
    // }
 
    // public function beforeSave($insert)
    // {
    //     if (parent::beforeSave($insert)) {
    //         if (!empty($this->newPassword)) {
    //             $this->setPassword($this->newPassword);
    //         }
    //         return true;
    //     }
    //     return false;
    // }
}
