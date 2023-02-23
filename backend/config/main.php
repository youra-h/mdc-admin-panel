<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

$components = require __DIR__ . '/components.php';

return [
    'id' => 'app',
    'name' => 'GipsyCode',  
    'language'=>'ru-RU',
    'sourceLanguage'=>'ru-RU',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],    
    'layout' => '@app/views/layouts/backend',
    'modules' => [],
    //Настройка установлена по умолчанию в конфигурации Yii defaultRoute = site
    'defaultRoute' => 'main',
    'components' => $components,
    'params' => $params,    
    'on beforeRequest' => function ($event) {
        Yii::$app->language = Yii::$app->session->get('locale', 'ru-RU');
    },
];
