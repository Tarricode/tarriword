<?php
use yii\helpers\Html;
use common\models\User;
$usuario=User::find()->where(["id"=>Yii::$app->User->Id]);
/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('frontend\assets\AppAsset')) {
        frontend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
            <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset,
                "usuario"=>$usuario,
            ]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset,
                "usuario"=>$usuario,
            ]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset,
                "usuario"=>$usuario,
            ]
        ) ?>
<div class="flotante2">

    <div class="contenedor">
    <button class="botonF1">
      <span>+</span>
    </button>
    <button data-tooltip="Subir Canciones" data-position="left center" onclick="document.location = '<?= yii\helpers\Url::to(["canciones/create"]);?>'" class="btn2 botonF2">
      <span>
          <i class="fa  fa-music"></i>
      </span>
    </button>
    <button data-tooltip="Subir Fotos" data-position="left center" onclick="document.location = '<?= yii\helpers\Url::to(["site/fotouplader"]);?>'" class="btn2 botonF3">
      <span>
          <i class="fa fa-picture-o"></i>
      </span>
    </button>
     </div>

</div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
