<?php

namespace app\assets\page;

use yii\web\AssetBundle;

class GuestAsset extends AssetBundle
{
    public $sourcePath = '@app/assets';
    public $css = [
        'css/guest.css',
    ];
    public $js = [
        'js/guest.js',
    ];

    public $depends = [
        'app\assets\MainAsset',
    ];
}
