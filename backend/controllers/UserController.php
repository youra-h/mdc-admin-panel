<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\search\UserSearch;
use backend\models\forms\Form_UserSearch;

/**
 * Site controller
 */
class UserController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionList()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('data-table', ['dataProvider' => $dataProvider]);
        }

        $formSearchModel = new Form_UserSearch();

        return $this->render('list', [
            'searchModel' => $searchModel,
            'formSearchModel' => $formSearchModel,
            'dataProvider' => $dataProvider        
        ]);
    }
}
