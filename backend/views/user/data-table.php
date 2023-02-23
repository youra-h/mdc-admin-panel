<?php

use yh\mdc\components\DataTable;

echo DataTable::one([
        'isAjaxRequest' => Yii::$app->request->isAjax    
    ])
    ->setId('user-list')
    ->setGridView([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => '\yh\mdc\widget\grid\SerialColumn',
            ],
            [
                'class' => '\yh\mdc\widget\grid\CheckboxColumn',
            ],
            [
                'attribute' => 'id',                
            ],
            'email:email',
        ],
    ])->render();
