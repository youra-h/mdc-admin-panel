<?php

namespace app\helpers;

use Yii;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\base\Model;
 
class JsonHelper
{
	/**
    * Форматирует ответ
    * @param string,array $data
    * @param string,array $message
	* @param string $type = success or error
	*/
    public static function encode($data, $message, $type = 'success')
    {        
    	$result = array(
            'data' => $data,
            'message' => $message,
    		'status' => $type,    		
    	);

    	return Json::encode($result);
    }

    public static function decode($value)
    {
        return Json::decode($value);
    }

    public static function success($data = '', $message = '')
    {
    	return self::encode($data, $message, 'success');
    }

    public static function error($message)
    {
    	return self::encode(null, $message, 'error');
    }

    public static function modelError($model)
    {        
        $result = [];
        foreach ($model->getErrors() as $attribute => $errors) {
            $key = '';
            if (!empty($attribute)) {
                $key = Html::getInputId($model, $attribute); 
            }
            $result[$key] = $errors;
        }

    	return self::encode(null, $result, 'model-error');
    }
}