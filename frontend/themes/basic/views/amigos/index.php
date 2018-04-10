<?php 
	use common\models\User;
	use yii\helpers\Url;
?>
<?php if (!isset($model)): ?>
	No se encontraron tus amigos
<?php endif ?>
<?php if (isset($model)): ?>
	

              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Mis Amigos</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger"><?= $modelo->count(); ?></span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <?php foreach ($model as $key): ?>
                    <li>
                      <img src="<?= common\models\User::findOne($key->Id_Amigo)->Foto==Null ? yii::getAlias("@recursosb").'/images/user.png':yii::getAlias("@recursos").common\models\User::findOne($key->Id_Amigo)->Foto ?>" alt="User Image">
                      <a class="users-list-name" href="<?= Url::to(["site/perfil","id"=>common\models\User::findOne($key->Id_Amigo)->id]);?>"><?= User::find()->where(["id"=>$key->Id_Amigo])->one()->username; ?></a>
                      <span class="users-list-date">Today</span>
                    </li>
                    <?php endforeach ?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">View All Users</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
<?php endif ?>
 