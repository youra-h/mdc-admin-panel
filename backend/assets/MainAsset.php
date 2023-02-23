<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class MainAsset extends AssetBundle
{
    public $sourcePath = '@app/assets';
    public $css = [
        'css/main.css',        
    ];
    public $js = [
        'js/main.js',                    
    ];
    public $depends = [
        'app\assets\AppAsset',              
        'app\assets\FontAsset',        
        'app\assets\FontMaterialIconsAsset',
        'yh\mdc\assets\YhAsset',      
    ];
}
