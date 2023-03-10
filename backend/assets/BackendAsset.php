<?php

namespace app\assets;

use yii\web\AssetBundle;

class BackendAsset extends AssetBundle
{
    public $sourcePath = '@app/assets';
    public $css = [
        'css/backend.css',
        'css/helper-components.css',
    ];
    public $js = [
    	'js/backend.js'
    ];

    public $depends = [        
        'app\assets\MainAsset'        
    ];
}
