<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class FormAsset extends AssetBundle
{
    public $sourcePath = '@app/assets';
    public $css = [
        'css/form.css',
    ];
    public $js = [
        'js/form-processing.js',
    ];
}
