<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@web/themes/basic';
    // public $baseUrl = '@web';
    public $baseUrl = '@web/themes/basic';
    public $css = [
        // '//cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.css',
        'css/site.css',
        'css/animate.css'
    ];
    public $js = [
        // '//cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.js',
        // 'bower\semantic\dist\semantic.js'
        '//unpkg.com/jspdf@latest/dist/jspdf.min.js',
        // 'js\jspdf.debug.js',
        'js\html2canvas.min.js',
        'js\push.min.js',
        'js\qrcode.js',
        'js\jquery.waypoints.js',
        'js/js/vendor/jquery.ui.widget.js',
        '//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js',
        '//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js',
        'js/js/jquery.iframe-transport.js',
        'js/js/jquery.fileupload.js',
        'js/js/jquery.fileupload-process.js',
        'js/js/jquery.fileupload-image.js',
        'js/js/jquery.fileupload-audio.js',
        'js/js/jquery.fileupload-video.js',
        'js/js/jquery.fileupload-validate.js',
        'js\main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
        'Zelenin\yii\SemanticUI\assets\SemanticUICSSAsset',
        'Zelenin\yii\SemanticUI\assets\SemanticUIJSAsset'
    ];
}