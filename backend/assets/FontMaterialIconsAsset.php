<?php

namespace app\assets;

use yii\web\AssetBundle;

class FontMaterialIconsAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/external/material-icons';

    public $css = [
        // 'css/fonts-materialicons.css',
        'css/fonts-materialicons-outlined.css',
    ];

    public $depends = [
    ];
}
