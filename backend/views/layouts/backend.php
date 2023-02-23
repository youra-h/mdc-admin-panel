<?php

use yii\helpers\Url;
use yh\mdc\components\Menu;
use app\assets\BackendAsset;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use yh\mdc\components\Drawer;
use yh\mdc\components\SnackBar;
use yh\mdc\components\LeftAppBar;
use yh\mdc\components\Typography;

$breadcrumbs = ArrayHelper::getValue($this->params, 'breadcrumbs', []);

//Регистрируем комплект ресурсов поставляемый с админкой
BackendAsset::register($this);

$user = Yii::$app->user->identity;

$drawer = Drawer::one([
    'header' => Yii::t('backend/drawer', 'Панель управления'),
    'headerIcon' => 'admin_panel_settings',
    'headerLink' => Url::to('/'),
    'items' => [
        [
            'header' => Yii::t('backend/drawer', 'Пользователи'),
            'items' => [
                [
                    'text' => Yii::t('backend/drawer', 'Список пользователей'),
                    'icon' => 'group',
                    'href' => '/user/list'
                ],
                [
                    'text' => Yii::t('backend/drawer', 'Правила доступа'),
                    'icon' => 'fact_check',
                    'href' => '/rbac/assignment'
                ],
            ]
        ],
        [
            'header' => Yii::t('backend/drawer', 'Справочники'),
            'items' => [
                [
                    'text' => Yii::t('backend/drawer', 'Список справочников'),
                    'icon' => 'featured_play_list',
                    'href' => '/ref/index'
                ],
            ]
        ],
        [
            'header' => Yii::t('backend/drawer', 'Настройки'),
            'items' => [
                [
                    'text' => Yii::t('backend/drawer', 'Настройки'),
                    'icon' => 'settings',
                    'href' => '/settings/index'
                ],
                [
                    'text' => Yii::t('backend/drawer', 'Обратная связь'),
                    'icon' => 'feedback',
                    'href' => '/feedback/index'
                ],
            ]
        ]
    ]
])
->setSelected('/'.Yii::$app->request->pathInfo, 'href')
->setId('app-drawer');

$leftAppBar = LeftAppBar::one([
    'items' => [        
        [
            'icon' => 'group',
        ],
        [
            'icon' => 'library_books'
        ],
        [
            'icon' => 'engineering'
        ]
    ]
])
->attachDrawer($drawer)
->setId('app-leftbar');

$avatar = $this->render('avatar');

$this->beginContent('@app/views/layouts/layout.php');

?>

<div class="left-bar">
    <?=$leftAppBar->render()?>
</div>
<div class="wrapper-content">
    <?=$drawer->render()?>
    <div class="mdc-drawer-app-content">
        <header class="mdc-top-app-bar" style="top: 0px;" id="app-topbar">
            <div class="mdc-top-app-bar__row">
                <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
                    <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button"
                        aria-label="<?=Yii::t('backend/drawer', 'Открыть панель меню')?>">
                        <i class="material-icons"
                            alt="<?=Yii::t('backend/drawer', 'Кнопка меню')?>">menu</i>
                    </button>
                </section>
                <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
                    <div class="action-item-user">
                        <span class="action-item-user__wrap" role="button" id="app-user">
                            <i class="material-icons icon">account_circle</i>
                            <div class="user">
                                <div
                                    class="name <?=Typography::subtitle(1)?>">
                                    <?=$user->username?>
                                </div>
                                <div
                                    class="role <?=Typography::caption()?>">
                                    Администратор
                                </div>
                            </div>
                        </span>
                        <div>
                            <?=Menu::one([
                                    'id' => 'app-user-menu',
                                    'items' => [
                                        [
                                            'text' => Yii::t('backend/main/user-menu', 'Настройки профиля'),
                                            // 'separator' => true
                                        ],
                                        [
                                            'text' => Yii::t('backend/main-user-menu', 'Выход'),
                                            'href' => Url::to('main/logout'),
                                            'options' => [
                                                'data' => ['method' => 'post']
                                            ]
                                        ],
                                    ]
                                ])
                                ->render()?>
                        </div>
                    </div>
                </section>
            </div>
        </header>
        <main class="main-content" id="main-content">
            <div class="mdc-top-app-bar--fixed-adjust"></div>
            <div class="panel-breadcrumb">
                <span class="title <?=Typography::headline(6)?>">
                    <?=$this->context->view->title?>
                </span>
                <?= Breadcrumbs::widget([
                    'links' => $breadcrumbs,
                    'options' => [
                        'class' => [
                            'breadcrumb',
                            Typography::caption()
                        ]
                    ]
                ]) ?>
            </div>
            <?=$content?>
            <?= SnackBar::one('')
                ->setProperty([
                    'closeButton'=> Yii::t('backend', 'Закрыть'),
                    'leading' => true,
                    'position' => SnackBar::POS_ABSOLUTE
                ])
                ->setId('app-snackbar')
                ->render()?>
        </main>
    </div>
</div>


<?php $this->endContent();
