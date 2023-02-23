<?php

namespace app\assets\page;

use yii\web\AssetBundle;

class UserListAsset extends AssetBundle
{
    public $sourcePath = '@app/assets';
    public $css = [
    ];
    public $js = [
    ];

    public $depends = [
        'app\assets\MainAsset'
    ];
}
