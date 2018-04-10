<?php 
    use yii\helpers\Html;
    use yii\helpers\Url;
    use common\models\User;
    use yii\widgets\LinkPager;
    use yii\widgets\ActiveForm;
?>
<div class="content-wrappe">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Mis Canciones</h3>
              <?php $f = ActiveForm::begin([
                  "method" => "get",
                  "action" => Url::toRoute("canciones/index"),
                  "enableClientValidation" => true,
              ]);
              ?>
              <?= $f->field($form, "q",["template"=>"
              <div class=\"box-tools pull-right\">
                <div class=\"has-feedback\">
                  {input}

                  <span class=\"glyphicon glyphicon-search form-control-feedback\"></span>
                </div>
              </div>  
              "])->input("search",["class"=>"form-control input-sm","placeholder"=>"Buscar cancion"]) ?>
              <?php $f->end() ?>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- sin controles -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  <?php if ($mensaje): ?>
                    
                  <?php foreach ($model as $key): ?>
                  <?php if ($key->Permiso==1): ?>
                  <tr>
                    <td><input type="checkbox"></td>
                    <!-- <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td> -->
                    <td class="mailbox-name"><a href="<?= Url::remember(["canciones/view","id"=>$key->Id]); ?>"><?= $key->Titulo; ?></a></td>
                    <td class="mailbox-subject"><b><?= $key->Titulo; ?></b> - <?= $key->Titulo; ?>
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date"><?= $key->Fecha; ?></td>
                  </tr>
                  <?php endif ?>
                  <?php endforeach ?>
                  <?php endif ?>

                  <?php if (!$mensaje): ?>
                    
                  <?php foreach ($model as $key): ?>
                  <tr>
                    <td><input type="checkbox"></td>
                    <!-- <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td> -->
                    <td class="mailbox-name"><a href="<?= Url::to(["canciones/view","id"=>$key->Id]); ?>"><?= $key->Titulo; ?></a></td>
                    <td class="mailbox-subject"><b><?= $key->Titulo; ?></b> - <?= $key->Titulo; ?>
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date"><?= $key->Fecha; ?></td>
                  </tr>
                  <?php endforeach ?>
                  <?php endif ?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>