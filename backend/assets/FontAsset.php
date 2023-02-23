<?php

namespace app\assets;

use yii\web\AssetBundle;

class FontAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/external/nunito';
    // public $sourcePath = '@app/assets/external/roboto';

    public $css = [
        'css/fonts-nunito.css',
        // 'css/fonts-roboto.css',
    ];

    public $depends = [
    ];
}
