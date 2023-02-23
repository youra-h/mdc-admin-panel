<?php
namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use app\helpers\JsonHelper;

/**
 * Site controller
 */
class TestController extends Controller
{
    public $layout = 'guest';
    
    public function actionIndex()
    {
        return $this->render('index');
    }
}
