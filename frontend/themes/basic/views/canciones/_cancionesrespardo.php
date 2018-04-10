<?php 
    use common\models\User;
    use yii\helpers\Url;
?>
<div class="ui four cards">
    <?php foreach ($model as $key): ?>
        <!-- buscamod informcaion de ususario dependiendo de cada cancion -->
        <?php
            $usuario=User::find()
                ->where(["id"=>$key->IdUsuario])
                ->one();
        ?>
        <?php if ($key->Permiso==1): ?>

        <div class="card">
            <div class="content">
                <a href="<?= Url::to(["site/perfil","id"=>$usuario->id]); ?>" class="ui mini right floated basic image label"><img src="<?= yii::getAlias("@recursos");?><?= $usuario->Foto; ?>">
                    <?= $usuario->username;?>
                </a>
                
                <!-- <img class="ui right floated mini ui image" src="https://www.socialtools.me/blog/wp-content/uploads/2016/04/foto-de-perfil.jpg"> -->
                <?php if ($key->Fecha==date("Y-m-d")): ?>
                    
                <a class="ui mini right floated blue tag label">Nuevo</a>
                <?php endif ?>
                
                <div class="header">
                    <?= $key->Titulo; ?>
                </div>

                <div class="meta">
                    <?= $key->Genero; ?>
                </div>
                <div class="description">
                    <?= $key->detalle; ?>
                </div>
            </div>
            <div class="extra content">
                <div class="ui tree buttons">
                    <a href="<?= Url::to(["canciones/view","id"=>$key->Id]); ?>" class="ui basic blue button">Ver</a>
                    <a href="<?= Url::to(["canciones/update","id"=>$key->Id]); ?>" class="ui basic green button">Editar</a>
                    <a href="<?= Url::to(["canciones/delete"]); ?>" class="ui basic red button">Eliminar</a>
                </div>
            </div>
        </div>
        <?php endif ?>
    <?php endforeach ?>
</div>