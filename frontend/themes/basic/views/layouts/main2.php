<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
<!-- barra lateral -->
<div class="ui right demo vertical inverted sidebar labeled icon menu">
  <a href="<?= Url::to(["site/admin"]);?>" class="item">
    <i class="home icon"></i>
    Inicio
  </a>
  <a href="<?= Url::to(["canciones/todas"]);?>" class="item">
    <i class="music icon"></i>
    Canciones
  </a>
  <a href="<?= Url::to(["site/user"]);?>" class="item">
    <i class="users layout icon"></i>
    Usuarios
  </a>
  <a class="item">
    <i class="options icon"></i>
    Configuracion
  </a>
  <a href="<?= Url::to(["/site/logout"]);?>" data-method='post' class="item">
    <i class="close icon"></i>
    Cerrar
  </a>
</div>
    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => 'TarriWord',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
            'class' => 'botonera navbar-inverse navbar-fixed-top',
            ],
            ]);
        $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = ['label' => 'Admin', 'url' => ['/site/admin']];
            $menuItems[] = ['label' => 'Mis Canciones', 'url' => ['/canciones/index']];
            $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>
            <li><a href="#" class="j glyphicon glyphicon-th"></a></li>';
    }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
            ]);
        NavBar::end();
        ?>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
<!--                 <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li> -->
              </ol>
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <img class="first-slide" src="<?= yii::getAlias("@recursosb");?>/images/guitar-1180744_1920.jpg" alt="First slide">
                  <div class="container">
                    <div class="carousel-caption">
                      <h1>Eres Compositor</h1>
                      <p>Este sera tu lugar favorito.</p>
                      <p><a class="btn btn-lg btn-primary" href="<?= Url::to(["site/login"]);?>" role="button">Iniciar seccion</a></p>
                    </div>
                  </div>
                </div>
                
              </div>
              <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div><!-- /.carousel -->

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
