<?php
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $content string */
$usuario=$usuario->one();
?>
<header class="main-header">

    <?= Html::a('<span class="logo-mini">TW</span><span class="logo-lg">' . Yii::$app->name . '</span>', ["canciones/index"], ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-success">
                            <?php if (frontend\models\Notificaciones::find()->where(["Id_Usuario"=>yii::$app->user->Id,"Visto"=>"0"])->count()>0): ?>
                                <?= frontend\models\Notificaciones::find()->where(["Id_Usuario"=>yii::$app->user->Id,"Visto"=>"0"])->count() ?>
                            <?php endif ?>
                            <?php if (frontend\models\Notificaciones::find()->where(["Id_Usuario"=>yii::$app->user->Id,"Visto"=>"0"])->count()==0): ?>
                                0
                            <?php endif ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Notificaciones</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <!-- por terminar -->
                                <?php foreach (frontend\models\Notificaciones::find()->where(["Id_Usuario"=>yii::$app->user->Id,"visto"=>"0"])->all() as $key): ?>
                                <li>
                                    <a href="<?= yii\helpers\Url::to(["notificaciones/view","id"=>$key->Id]);?>">
                                        <i class="fa  fa-thumbs-o-up text-aqua"></i> <?= $key->Descripcion;?>
                                    </a>
                                </li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                        <li class="footer"><a href="<?= yii\helpers\Url::to(["notificaciones/index"]);?>">Ver todas</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $usuario->Foto==Null ? $directoryAsset.'/img/user2-160x160.jpg':yii::getAlias("@recursos").$usuario->Foto ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">
                            <?= $usuario->username; ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $usuario->Foto==Null ? $directoryAsset.'/img/user2-160x160.jpg':yii::getAlias("@recursos").$usuario->Foto ?>" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?= $usuario->username; ?>
                                <small>
                                <?= $usuario->email; ?>
                                </small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Perfil</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="<?= yii\helpers\Url::to(["site/fotos"]);?>">Mis Fotos</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Mis Amigos</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= yii\helpers\Url::to(["site/intro"]);?>" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Cerrar',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
                </li>
            </ul>
        </div>
    </nav>
</header>
