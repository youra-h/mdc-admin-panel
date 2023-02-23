<?php

use app\models\I18nLocale;
use yh\mdc\ActiveForm;
use yh\mdc\components\Button;
use yh\mdc\components\Menu;
use yh\mdc\components\SnackBar;
use yh\mdc\components\Spinner;
use yh\mdc\components\base\Vars;
use yh\mdc\components\Typography;
use yh\mdc\components\TextField;
use yh\mdc\components\Grid;

$this->title = Yii::t(
    'backend/login',
    '{name-project} - вход в панель управления',
    ['name-project' => Yii::$app->name]
);
$this->params['wrapperAddCls'] = Grid::layout();

$titleCompany = str_replace(
    ['{year}', '{name}'],
    [Yii::$app->formatter->asDate('now', 'yyyy'), Yii::$app->name],
    Yii::$app->params['company-info']
);
    
$locale = substr(Yii::$app->language, 3, 2);

?>

<div class="<?=Grid::inner()?>">
    <div class="data-content <?=Grid::span(5)?> <?=Grid::spanTablet(12)?>">
        <div class="header">
            <span class="material-icons">admin_panel_settings</span>
            <span class="title <?=Typography::headline(5)?>">
                <?=Yii::t('backend/login', 'Панель управления')?>
            </span>
        </div>
        <div class="data-box">
            <?php $form = ActiveForm::begin([
                'id' => 'loginform'
            ]);?>

            <?=$form->field($model, 'username')->textInput([
                'tabIndex' => 1,
                'autocomplete' => 'username',
                'required' => true,
                'property' => [
                    'autoFocus' => true,
                    'label' => Yii::t('backend/login', 'Введите логин'),
                    'labelTemplate' => TextField::ALIGN_TOP,
                    'labelSize' => Vars::LARGE,
                    'textSize' => Vars::LARGE,
                    'helper' => Yii::t('backend/login', 'email | логин'),
                    'height' => Vars::LARGE
                ],
            ])?>

            <?=$form->field($model, 'password')->passwordInput([
                'tabIndex' => 2,
                'autocomplete' => 'current-password',
                'required' => true,
                'property' => [
                    'label' => Yii::t('backend/login', 'Введите пароль'),
                    'labelTemplate' => TextField::ALIGN_TOP,
                    'labelSize' => Vars::LARGE,
                    'textSize' => Vars::LARGE,
                    'icons' => [
                        ['icon' => 'visibility', 'role' => 'button', 'toggle' => 'visibility_off']
                    ],
                    'helper' => '',
                    'height' => Vars::LARGE                    
            ]])?>

            <?=$form->field($model, 'rememberMe')->checkbox([
                'tabIndex' => 3,
                'property' => [
                    'label' => Yii::t('backend/login', 'Запомнить меня'),
                    'value' => true
                ],
            ])?>

            <div class="mdc-form-field__i">
                <?=Button::one(
                Yii::t('backend/login', 'Войти'),
                        ['spinner' => Button::SP_AUTO],
                        ['tabIndex' => 4]
                    )
                    ->setOwner($form)
                    ->gray()
                    ->submit()?>
            </div>

            <?php ActiveForm::end();?>
        </div>
        <div class="footer">
            <?=Menu::one([
                'id' => 'locale-menu',
                'items' => I18nLocale::getList()
            ])
            ->render()?>
            <div class="<?=Typography::caption()?>">
                <?=Spinner::one(['size' => Spinner::SMALL], [
                        'style' => ['margin' => '-2px 0 0 -20px']
                    ])
                    ->setId('locale-spinner')
                    ->render()?>
                <a id="locale-link" href="#" class="locale-link"><?=$locale?></a>
                <span>
                    <?=$titleCompany?>
                </span>
            </div>
        </div>
        <?=SnackBar::one('')
            ->setProperty([
                'closeButton'=> Yii::t('backend', 'Закрыть'),
                'position' => SnackBar::POS_ABSOLUTE
            ])
            ->setId('app-snackbar')
            ->render()?>
    </div>

    <div class="picture-content <?=Grid::span(7)?>">
        <div class="box">
            <div class="box-relative">
                <div class="logo">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="178.000000pt" height="178.000000pt"
                        viewBox="0 0 178.000000 178.000000" preserveAspectRatio="xMidYMid meet">
                        <metadata>
                            Created by potrace 1.10, written by Peter Selinger 2001-2011
                        </metadata>
                        <g transform="translate(0.000000,178.000000) scale(0.050000,-0.050000)" fill="#ffffff"
                            stroke="none">
                            <path
                                d="M1611 3542 c-6 -11 19 -86 56 -168 l68 -149 -702 -1582 -703 -1583 -165 0 c-133 0 -165 -6 -165 -30 0 -26 210 -30 1770 -30 1538 0 1770 4 1770 29 0 23 -36 31 -165 35 l-165 6 -695 1560 c-382 858 -694 1572 -695 1587 0 14 28 90 62 167 44 100 55 147 40 162 -27 27 -25 28 -96 -113 l-59 -117 -54 122 c-53 118 -78 143 -102 104z m84 -1681 c-25 -39 -57 -93 -71 -121 -14 -27 -41 -70 -60 -95 l-35 -45 -152 155 -152 155 252 567 253 567 5 -556 c6 -548 5 -556 -40 -627z m375 607 l248 -558 -153 -155 -154 -155 -105 165 -105 165 -1 558 c0 307 5 554 11 548 6 -6 122 -262 259 -568z m-700 -808 c187 -188 166 -182 246 -70 66 94 103 114 105 55 0 -25 9 -19 30 20 44 80 80 68 162 -55 90 -136 65 -141 261 54 100 100 172 157 182 145 14 -15 382 -834 497 -1104 l28 -65 -360 0 -359 0 -39 89 c-131 295 -560 297 -703 2 l-44 -91 -357 0 -357 0 100 225 c55 124 173 389 262 590 89 201 168 365 175 365 6 0 84 -72 171 -160z m549 -819 c144 -74 170 -147 171 -481 l0 -290 -315 -6 -315 -5 0 292 c0 459 168 638 459 490z m-539 -531 l0 -250 -480 0 c-264 0 -480 7 -480 15 0 8 46 121 103 250 l103 235 377 0 377 0 0 -250z m1641 20 c54 -121 98 -231 98 -245 1 -19 -108 -25 -479 -25 l-480 0 0 250 0 251 381 -6 381 -5 99 -220z" />
                            <path
                                d="M716 348 c-60 -45 -90 -81 -83 -99 12 -31 25 -27 122 45 l65 48 89 -64 c99 -70 95 -71 241 51 99 84 35 114 -69 32 l-81 -64 -84 61 c-102 75 -86 76 -200 -10z" />
                            <path
                                d="M2368 397 c-14 -24 143 -176 182 -176 11 0 55 27 98 59 81 62 84 61 184 -14 54 -40 66 -43 87 -17 20 24 5 41 -87 102 l-110 74 -82 -65 -82 -65 -78 62 c-87 71 -92 72 -112 40z" />
                            <path
                                d="M2223 3326 c-152 -75 -212 -279 -129 -439 123 -238 480 -212 577 42 103 270 -186 526 -448 397z m290 -80 c64 -41 113 -159 101 -237 -50 -309 -494 -272 -494 41 0 186 232 302 393 196z" />
                        </g>
                    </svg>
                </div>
                <!--Waves Container-->
                <div class="waves-box">
                    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                        <defs>
                            <path id="gentle-wave"
                                d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                        </defs>
                        <g class="parallax">
                            <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                            <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                        </g>
                    </svg>
                </div>
                <!--Waves end-->
            </div>
        </div>
    </div>
</div>