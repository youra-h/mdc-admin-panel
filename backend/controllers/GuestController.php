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
class GuestController extends Controller
{
    public $layout = 'guest';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'locale', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['login', 'logout', 'index', 'error'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLoginValidate()
    {
        $model = new LoginForm();
        $request = Yii::$app->getRequest();

        if ($request->isPost && $model->load($request->post()) && $model->login()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        return \app\components\ActiveForm\ActiveForm::validate($model);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        function validate($model)
        {
            return $model->load(Yii::$app->request->post()) && $model->login();
        }

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }        

        $model = new LoginForm();
        
        //Validate ajax Login form
        if (Yii::$app->request->isAjax) {
            if (validate($model)) {
                // return $this->goBack();
                return JsonHelper::success(['url' => Yii::$app->getUser()->getReturnUrl()]);
            } else {                
                return JsonHelper::modelError($model);
            }
        }

        //Render Login form
        if (validate($model)) {
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLocale()
    {
        if (Yii::$app->request->isAjax) {
            $locale = Yii::$app->request->post('locale');
            Yii::$app->session->set('locale', $locale);
            return JsonHelper::success();    
        }
        
        return JsonHelper::error('not valid data');
    }
}
