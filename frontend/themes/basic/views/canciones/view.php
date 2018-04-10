<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use frontend\models\Genero;

/* @var $this yii\web\View */
/* @var $model backend\models\Canciones */

$this->title = $model->Titulo;
$this->params['breadcrumbs'][] = ['label' => 'Canciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<hr>
<?php if(Yii::$app->session->hasFlash('mensaje')): ?>
    <div class="alert alert-success" role="alert">
        <?= Yii::$app->session->getFlash('mensaje') ?>
    </div>
<?php endif; ?>
            <div class="box box-primary">

              <!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="mailbox-read-info">
                  <h3><?= $model->Titulo?></h3>
                    <div class="user-block">
                      <img class="img-circle" src="<?= common\models\User::findOne($model->IdUsuario)->Foto==Null ? yii::getAlias("@recursosb").'/images/user.png':yii::getAlias("@recursos").common\models\User::findOne($model->IdUsuario)->Foto ?>" alt="User Image">
                      <span class="username"><a href="<?= Url::to(["site/perfil","id"=>common\models\User::findOne($model->IdUsuario)->id]);?>"><?= common\models\User::findOne($model->IdUsuario)->username;?></a></span>
                      <span class="description">Genero De La Cancion: <?= Genero::find()->where(["Id"=>$model->Genero])->one()->Genero;?></span>
                      <span class="description">Fecha de creacion: <?= $model->Fecha;?></span>
                      <span class="description">Likes: <?= backend\models\Likes::find()->where(["Id_Caciones"=>$model->Id])->count();?></span>
                    </div>
                </div>

                <div id="menu" class="mailbox-controls with-border text-center">
                    
                  <?= $model->IdUsuario==yii::$app->user->Id ? $model->Permiso==1 ? Html::a('
                  <button data-tooltip="Publico" data-position="top right" class="btn btn-default btn-sm">
                      <i class="fa fa-group"></i>
                  </button>
                  ', ['publicar', 'id' => $model->Id]) : Html::a('
                  <button data-tooltip="Privado" data-position="top right" class="btn btn-default btn-sm">
                      <i class="fa fa-user"></i>
                  </button>
                  ', ['publicar', 'id' => $model->Id]) :"" ?>

                  <div class="btn-group">
                   <?php if (backend\models\Likes::find()->where(["Id_Caciones"=>$model->Id])->andWhere(["Id_Usuario"=>Yii::$app->user->Id])->count()>0): ?>
                     
                   <div id="like" class="btn btn-default btn-sm"><i class="heart icon"></i> Me gusta </div>

                   <?php endif ?>
                   <?php if (backend\models\Likes::find()->where(["Id_Caciones"=>$model->Id])->andWhere(["Id_Usuario"=>Yii::$app->user->Id])->count()==0): ?>
                     
                   <div id="like" class="btn btn-default btn-sm"><i class="heart icon"></i> No Me Gusta </div>
                   <?php endif ?>
                        

                        <button data-tooltip="Repruducir Cancion" data-position="top right" class="btn btn-default btn-sm" onclick="document.getElementById('reproductor').play();">
                          <i class="fa fa-play"></i>
                        </button>
                        <button data-tooltip="Pausar Cancion" data-position="top right" class="btn btn-default btn-sm" onclick="document.getElementById('reproductor').pause();">
                          <i class="fa fa-pause"></i>
                        </button>
                        <button data-tooltip="Subir volumen" data-position="top right" class="btn btn-default btn-sm" onclick="document.getElementById('reproductor').volume += 0.1;">
                          <i class="fa  fa-volume-up"></i>
                        </button>
                        <button data-tooltip="Bajar volumen" data-position="top right" class="btn btn-default btn-sm" onclick="document.getElementById('reproductor').volume -= 0.1;">
                            <i class="fa  fa-volume-down"></i>
                        </button>

                        <?= $model->IdUsuario==Yii::$app->user->Id ? Html::a('
                        <button data-tooltip="Editar Cancion" data-position="top right" class="btn btn-default btn-sm">
                            <i class="fa fa-edit"></i>
                        </button>
                        ', ['update', 'id' => $model->Id]):"" ?>

                      <?= $model->IdUsuario==Yii::$app->user->Id ? Html::a('
                          <button data-tooltip="Eliminar Cancion" data-position="top right" class="btn btn-default btn-sm">
                              <i class="fa fa-trash-o"></i>
                          </button>
                          ', ['delete', 'id' => $model->Id], [
                          'data' => [
                          'confirm' => 'Deseas eliminar esta cancion?',
                          'method' => 'post',
                          ],
                          ]) :""?>
                  </div>
                  <!-- /.btn-group -->
<!-- vista de pdf -->
<!--                   <?= \yii2assets\pdfjs\PdfJs::widget([
                    'url'=> Url::base().'/downloads/manualStart_up.pdf'
                  ]); ?> -->

                  <button type="button" onclick="imp('<?= $model->Titulo;?>','<?= yii::getAlias("@recursos");?>/images/logo2.jpg','<?= common\models\User::findOne($model->IdUsuario)->username;?>','<?= Genero::find()->where(["Id"=>$model->Genero])->one()->Genero;?>','<?= Yii::getAlias('@locahost').Url::to(["canciones/view","id"=>$model->Id]); ?>')" class="btn btn-default btn-sm" data-tooltip="Imprimir Cancion" data-position="top right" title="Print">
                    <i class="fa fa-print"></i></button>
                                        
                    <button type="button" onclick="update_qrcode('<?= Yii::getAlias('@locahost').Url::to(["canciones/view","id"=>$model->Id]); ?>')" class="btn btn-default btn-sm" data-tooltip="Generar Qr" data-position="top right" title="Qr">
                      <i class="fa fa-code"></i></button>
                      
                      <div id="qr"></div>
                </div>
                <!-- /.mailbox-controls -->
                <div class="mailbox-read-message">
                  <p class="text-justify">
                  <?= $model->Letra;?>
                  </p>
                </div>
                <div id="testdiv" style="display:none">
                    <?= $model->Letra;?>
                </div>
                <!-- /.mailbox-read-message -->
              </div>
              <!-- /.box-body -->
            </div>
          <!-- /.col -->
<?php if (file_exists(yii::getAlias("@frontend")."/web/images/mp3/".$model->Audio)): ?>
  <audio id="reproductor" class="flotante col-md-9" src="<?= yii::getAlias("@recursos");?>/images/mp3/<?= $model->Audio; ?>" controls type="audio/mp3"></audio>
<?php endif ?>

<?php if (file_exists(yii::getAlias("@backend")."/web/images/mp3/".$model->Audio)): ?>
    <audio id="reproductor" class="flotante col-md-9" src="<?= yii::getAlias("@recursosb");?>/images/mp3/<?= $model->Audio; ?>" controls type="audio/mp3"></audio>
<?php endif ?>

<div class="id" style="display:none;">
  <?= $model->Id; ?>
</div>
  <?php
  $this->registerJs("
  $(function(){

        $('#like').on('click', function(){
          var urlp='".yii\helpers\Url::to(['canciones/megusta'])."';
          
          var ID=$('.id').text();
          
          var sendInfo = {
            id:ID,
          };

          $.ajax({
              type: 'POST',
              url: urlp,
              dataType:'json',
              data: sendInfo,
              beforeSend: function() {
                  // setting a timeout
                  $('#like').html('loading');
              },
              success: function(data) {
                  if(data==1){
                    $('#like').html('Me gusta');
                  }
                  if(data==0){
                    $('#like').html('No me gusta');
                  }
              },
              dataType: 'html'
          });

        //   $.ajax({
        //       url: urlp,
        //      type: 'POST',
        //      data: {id: $('.id').text()},
        //      success: function (data) {
        //         if(data==true){
        //           $('.btn.btn-default.btn-sm').html('Megusta');
        //         }if(data==false){
        //           $('.btn.btn-default.btn-sm').html('No Megusta');
        //         }
        //      }
        // });
        });

  });
  ");
  ?>