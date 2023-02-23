<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\helpers\HtmlHelper;
use app\assets\page\GuestAsset;

GuestAsset::register($this);

$user = Yii::$app->user->identity;

$this->beginContent('@app/views/layouts/layout.php');

?>

<?=$content?>

<?php $this->endContent(); ?>
