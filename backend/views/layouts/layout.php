<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\ArrayHelper;
use app\components\MaterialComponents\LineProgress;

AppAsset::register($this);

$wrapperAddCls = ArrayHelper::getValue($this->params, 'wrapperAddCls', '');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
    <link rel="manifest" href="/icon/site.webmanifest">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?>
    </title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrapper <?=$wrapperAddCls?>">
        <?= $content ?>        
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
