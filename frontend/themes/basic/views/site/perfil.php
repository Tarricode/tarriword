<?php 
	use backend\models\Canciones;
	use yii\helpers\Url;
?>
<div class="ui one card">
	<div class="image">
		<img src="<?= yii::getAlias("@recursos");?><?= $perfil->Foto; ?>">
	</div>
	<div class="content">
		<a class="header">
			<?= $perfil->username; ?>
		</a>
		<div class="meta">
			<span class="date">Este Usuario tiene 
				<?= $countC=Canciones::find()->where(["IdUsuario"=>$perfil->Id])->count(); ?>
				Canciones Creadas de las cuales
				<?= $model2=Canciones::find()
                        ->where(["like", "IdUsuario", $perfil->Id])
                        ->andWhere(["like", "Permiso", "1"])->count(); 
            ?>
            Son Publicas
			</span>
		</div>
		<div class="description">
			
		</div>
	</div>
	<div class="extra content">
		<a href="<?= Url::to(["canciones/canciones","id"=>$perfil->Id]); ?>"><i class="music icon"></i>
			<?= $model2=Canciones::find()
                        ->where(["like", "IdUsuario", $perfil->Id])
                        ->andWhere(["like", "Permiso", "1"])->count(); 
            ?>
            Publicas
		</a>
	</div>
</div>