<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="ui four column grid">
<?php foreach ($model as $key): ?>
  <div class="column">
    <div class="ui fluid card">
      <div class="image">
        <img src="<?= yii::getAlias("@recursos");?><?= $key->Foto;?>">
      </div>
      <div class="content">
        <a href="<?= Url::to(["site/perfil","id"=>$key->id]);?>" class="header"><?= $key->username; ?></a>
      </div>
    </div>
  </div>
<?php endforeach ?>
</div>