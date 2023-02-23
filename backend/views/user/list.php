<?php

use yh\mdc\components\CollapseSearch;

$this->title = \Yii::t('backend/user', 'Список пользователей');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="mdc-layout-grid">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-9">
            <?=$this->render('data-table', [
                'dataProvider' => $dataProvider
            ])?>
        </div>
        <div class="mdc-layout-grid__cell--span-3">
            <?=CollapseSearch::one([
                'model' => $formSearchModel,
                'items' => [
                    [
                        'text' => 'Пользователь',
                        'selected' => true,
                        'content' => [
                            [
                                'class' => 'TextField',
                                'name' => 'username',
                                'property' => [
                                    'label' => Yii::t('backend/user', 'Пользователь'),
                                ]
                            ],
                            [
                                'class' => 'TextField',
                                'name' => 'email',
                                'property' => [
                                    'label' => Yii::t('backend/email', 'Email'),
                                ]
                            ],
                            [
                                'class' => 'Select',
                                'name' => 'status',
                                'property' => [
                                    'label' => Yii::t('backend/status', 'Статус'),
                                    'items' => [
                                        '0' => '',
                                        '1' => 'Активный',
                                        '2' => 'Отключен',
                                        '3'=>'Удален'
                                    ]
                                ]
                            ],
                            [
                                'class' => 'CheckBox',
                                'name' => 'active',
                                'property' => [
                                    'label' => Yii::t('backend/active', 'Активный'),
                                ]
                            ],
                            [
                                'class' => 'CheckBox',
                                'name' => 'passive',
                                'property' => [
                                    'label' => Yii::t('backend/passive', 'Пассивный пользователь'),
                                ]
                            ],
                        ]
                    ],
                    [
                        'text' => 'Группа',
                        'selected' => true,
                        'content' => [
                            'Равным образом рамки и место обучения кадров влечет за собой процесс внедрения и модернизации системы обучения кадров, соответствует насущным потребностям. Идейные соображения высшего порядка, а также дальнейшее развитие различных форм деятельности позволяет оценить значение новых предложений.',
                            'Разнообразный и богатый опыт консультация с широким активом обеспечивает широкому кругу. С другой стороны укрепление и развитие структуры обеспечивает участие в формировании систем массового участия. Равным образом рамки и место обучения кадров влечет за собой процесс внедрения и модернизации системы обучения кадров, соответствует насущным потребностям.'
                        ]
                    ],
                ]
            ])
            ->setId('filter')
            ->render()?>
        </div>
    </div>
</div>