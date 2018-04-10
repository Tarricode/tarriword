<?php 
use yii\helpers\Url;
?>
<hr>
<center><a data-tooltip="Subir fotos" href="<?= Url::to(["site/fotouplader"]); ?>">
	<button class="circular ui  icon button">
			<i class="icon upload"></i>
	
		</button>
	</a></center>	
<hr>

	<div class="ui four stackable cards">
	<?php foreach ($model as $key): ?>
	  <div class="card">
	    <div class="image">
		      <a href="<?= Url::to(["site/selectfoto","id"=>$key->Id]); ?>" class="ui left corner label">
					<i class="checkmark box icon"></i>
				</a> 

				<a href="<?= Url::to(["site/deletefoto","id"=>$key->Id]); ?>" data-confirm="Seguro que deseas eliminar esta foto?" class="ui right corner label">
					<i class="delete icon"></i>
				</a>  
				<img src="<?= yii::getAlias("@recursos");?><?= $key->Url; ?>">
	    </div>
	  </div>

    <div class="extra">

    </div>
		  
		  
	<?php endforeach ?>
		</div>
