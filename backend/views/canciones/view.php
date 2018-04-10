<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Canciones */

$this->title = $model->Titulo;
$this->params['breadcrumbs'][] = ['label' => 'Canciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="canciones-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?php // Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?php /* Html::a('Delete', ['delete', 'id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
            ]) */?>
        </p>

        <div class="ui small  icon buttons flotante2">
          <button data-tooltip="Reproducir musica" id="boton" class="ui button">
            <i id="pause" class="play icon"></i>
        </button>
        

        <a href="<?= Url::to(["canciones/update","id"=>$model->Id]); ?>">
            <button data-tooltip="Editar Cancion" class="ui button"> <i class="edit icon"></i>
            </button>
        </a>

        <?=  Html::a('
            <button data-tooltip="Eliminar" data-position="top right" class="ui button">
                <i class="delete icon"></i>
            </button>
            ', ['delete', 'id' => $model->Id], [
            'data' => [
            'confirm' => 'Deseas eliminar esta cancion?',
            'method' => 'post',
            ],
            ]) ?>

      <!-- <button class="ui button"><i class="upload icon"></i></button>
      <button class="ui button"><i class="download icon"></i></button> -->
  </div>
  <?php if (file_exists(yii::getAlias("@frontend")."/web/images/mp3/".$model->Audio)): ?>
    <audio id="reproductor" class="flotante col-md-9" src="<?= yii::getAlias("@recursos");?>/images/mp3/<?= $model->Audio; ?>" controls type="audio/mp3"></audio>
  <?php endif ?>

  <?php if (file_exists(yii::getAlias("@backend")."/web/images/mp3/".$model->Audio)): ?>
      <audio id="reproductor" class="flotante col-md-9" src="<?= yii::getAlias("@recursosb");?>/images/mp3/<?= $model->Audio; ?>" controls type="audio/mp3"></audio>
  <?php endif ?>

    <div class="panel panel-default">
      <div class="panel-body">
        <div class="ui items">
      <div class="item">
        <div class="content">
          <!-- botones de favoritos -->
          <div class="extra content">
            <span class="left floated">
              <div class="ui labeled button" tabindex="0">
                <?php if (backend\models\Likes::find()->where(["Id_Caciones"=>$model->Id])->andWhere(["Id_Usuario"=>Yii::$app->user->Id])->count()>0): ?>
                  
                <div id="like" class="ui button i"><i class="heart icon"></i> Me gusta </div>
                <a class="ui basic label">
                  <?= backend\models\Likes::find()->where(["Id_Caciones"=>$model->Id])->count();?>
                </a>
                <?php endif ?>
                <?php if (backend\models\Likes::find()->where(["Id_Caciones"=>$model->Id])->andWhere(["Id_Usuario"=>Yii::$app->user->Id])->count()==0): ?>
                  
                <div class="ui button i"><i class="heart icon"></i> No Me Gusta </div>
                <a class="ui basic label">
                  <?= backend\models\Likes::find()->where(["Id_Caciones"=>$model->Id])->count();?>
                </a>
                <?php endif ?>
              </div>
            </span>

            <span class="right floated star"><i class="user icon"></i>Autor:
                <?php $autor=\common\models\User::find()
                ->where(["id"=>$model->IdUsuario])
                ->one();
                echo $autor->username;
                ?>
            </span>
        </div>
        <!-- finde  botones de favorito -->
        <a class="header">
          <?= $model->Titulo; ?>
      </a>
      <div class="text-center description">
        <p>
            <?= $model->Letra;?>
        </p>
    </div>
    <div class="extra"><i class="green check icon"></i>
      <?= $model->Megusta;?>
    </div>
</div>
</div>
</div>
<div class="id" style="display:none;">
  <?= $model->Id; ?>
</div>




<?php
$this->registerJs("
$(function(){

      $('.ui.button.i').on('click', function(){
        var urlp='".yii\helpers\Url::to(['canciones/megusta'])."';
        $.ajax({
            url: urlp,
           type: 'POST',
           data: {id: $('.id').text()},
           success: function (data) {
              if(data==true){
                $('#like').html('Megusta');
              }if(data==false){
                $('#like').html('No Megusta');
              }
           }

      });
      });

});
");
?>

      </div>
    </div>
    

</div>
