<?php 
use backend\models\Canciones;
use common\models\User;
use yii\helpers\Url;
?>
<div class="col-sm-4 col-md-3 col-lg-3">
	<!-- Tejetas de perfil -->
	<div class="ui card">
		<div class="image">
			<img src="<?= yii::getAlias("@recursos");?><?= $usuario->Foto; ?>">
		</div>
		<div class="content">
			<a class="header">
				<?= $usuario->username;?>
			</a>
			<div class="meta">
				<span class="date">
					<?= $usuario->email;?>
				</span>
			</div>
			<div class="description">
				<a href="<?= Url::to(["canciones/create"]); ?>">
					<button data-tooltip="Subir Canciones" data-position="top left" class="circular ui icon button">
						<i class="icon upload"></i>

					</button>
				</a>
				<a href="<?= Url::to(["site/fotos"]); ?>">
					<button data-tooltip="Seleccionar Foto De Perfil" data-position="top left" class="circular ui icon button">
						<i class="icon picture"></i>

					</button>
				</a>
			</div>
		</div>
		<div class="extra content">
			<a href="<?= Url::to(["canciones/index"]); ?>" data-tooltip="Mis Canciones"><i class="music icon"></i>
				<?= $countC=Canciones::find()->where(["IdUsuario"=>Yii::$app->user->Id])->count(); ?>
			</a>
			<a href="<?= Url::to(["canciones/favoritas"]); ?>" data-tooltip="Mis Favoritos"><i class="glyphicon glyphicon-thumbs-up"></i>
				<?= backend\models\Likes::find()->where(["Id_Usuario"=>Yii::$app->user->Id])->count(); ?>
			</a>
		</div>
	</div>

	<!-- Tejetas de perfil -->
	<div class="ui card">
		<div class="content">
			
		</div>
	</div>

</div>
<!-- actividades -->
<div class="col-sm-8 col-md-9 col-lg-9">
	<div class="panel panel-default">
		<div class="panel-body">
			<!-- cuerpo del panel principal -->
			<div class="ui four statistics">
				<!-- Total de canciones creadas -->
				<div class="statistic">
					<div class="value" data-tooltip="" data-position="bottom center"><i class="music icon"></i>
						<?= Canciones::find()->count(); ?>
					</div>
					<div class="label">Canciones Registradas </div>
				</div>
				<!-- Total de usuarios Registrados -->
				<div class="statistic">
					<div class="value" data-tooltip="" data-position="bottom center"><i class="users icon"></i>
						<?= User::find()->count(); ?>
					</div>
					<div class="label">Usuarios Registradas </div>
				</div>
				<!-- Total de usuarios Inactivos -->
				<div class="statistic">
					<div class="value" data-tooltip="" data-position="bottom center"><i class="users icon"></i>
						<?= User::find()->where(["status"=>"0"])->count(); ?>
					</div>
					<div class="label">Usuarios Inactivos</div>
				</div>
								<!-- Total de usuarios Inactivos -->
				<div class="statistic">
					<div class="value" data-tooltip="" data-position="bottom center"><i class="line chart icon"></i>
						<?= User::find()->where(["status"=>"0"])->count(); ?>
					</div>
					<div class="label">Visitas</div>
				</div>
			</div>
			<div class="ui horizontal divider header"><i class="newspaper icon"></i>Ultimas 3 Canciones Creadas</div>
			<!-- buscamos todas las canciones registradas -->
			<?php $ultimasC=Canciones::find()
			->orderBy('Fecha DESC')
			->limit(3)
			->all(); ?>
			<div style="padding-left:4%;" class="ui three column grid">
				<div class="row">
					<?php foreach ($ultimasC as $key): ?>
						<!-- buscamos los usuarios de cada cancion -->
						<?php $usuarios=User::find()
						->where(["id"=>$key->IdUsuario])
						->One();
						?>
						<div class="column">
							<div class="ui card">
								<div class="content">
									<div class="header">
										<?= $key->Titulo; ?>
									</div>
									<div class="meta">
										<span class="right floated time">
											<?= $key->Fecha; ?>
										</span>
										<span class="category">
											<?= $key->Genero; ?>
										</span>
									</div>
									<div class="description">
										<p>
											<?= $key->detalle; ?>
										</p>
									</div>
								</div>
								<div class="extra content">
									<div class="right floated author">
										<img class="ui avatar image" src="<?= yii::getAlias("@recursos");?><?= $usuarios->Foto; ?>">
										<?= $usuarios->username ?>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
					<a href="<?= Url::to(["canciones/todas"]); ?>">
						<div class="ui right floated primary button">Mostrar Todas las Canciones<i class="right chevron icon"></i>
						</div>
					</a>
			</div>
			 <div class="ui horizontal divider header"><i class="users icon"></i>Nuevos Usuarios Registrados</div>
			<?php $u=User::find()
			->limit(4)
			->all();
			?>
				<div class="ui four column grid">
			<?php foreach ($u as $key): ?>
				  <div class="column">
				  	
				  	    <div class="ui fluid card">
				  	      <div class="image">
				  	        <img src="<?= yii::getAlias("@recursos"); ?><?= $key->Foto;?>">
				  	      </div>
				  	      <div class="content">
				  	        <a class="header">
					  			<?= $key->username; ?>
				  	        </a>
				  	      </div>
				  	    </div>
				  	</div>
				  	
			<?php endforeach ?>
				  </div>
				<a href="<?= Url::to(["site/user"]); ?>">
					<div class="ui right floated primary button">Mostrar Todos los Usuarios<i class="right chevron icon"></i>
					</div>
				</a>
				</div>
		</div>

	</div>
</div>
</div>
