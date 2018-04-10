<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // '//cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.css',
        'css/site.css'
    ];
    public $js = [
        // '//cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.js',
        // 'bower\semantic\dist\semantic.js'
        '\js\main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
        'Zelenin\yii\SemanticUI\assets\SemanticUICSSAsset',
        'Zelenin\yii\SemanticUI\assets\SemanticUIJSAsset'
    ];
}