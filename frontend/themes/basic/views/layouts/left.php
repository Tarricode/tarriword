<?php $usuario=$usuario->one(); ?>
<?php use yii\widgets\ActiveForm; ?>
<?php use yii\helpers\Url; ?>
<?php use yii\helpers\Html; ?>
<?php use common\models\FormSearch; ?>
<?php $form = new FormSearch; ?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $usuario->Foto==Null ? $directoryAsset.'/img/user2-160x160.jpg':yii::getAlias("@recursos").$usuario->Foto ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= $usuario->username; ?></p>
            </div>
        </div>

        <!-- search form -->

        <?php $f = ActiveForm::begin([
            "method" => "get",
            "action" => Url::toRoute("canciones/index"),
            "enableClientValidation" => true,
            "options"=>[
                "class"=>"sidebar-form"
            ],
        ]);
        ?>


    
            <?= $f->field($form, "q",["template"=>"
                <div class='input-group'>
                    {input}
                  <span class='input-group-btn'>
                    <button type='submit' name='search' id='search-btn' class='btn btn-flat'><i class='fa fa-search'></i>
                    </button>
                  {error}
                  </span>
                </div>
            "])->input(["class"=>"form-control","placeholder"=>"Search..."]) ?>

        <?php $f->end() ?>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Canciones', 'icon' => 'music', 'url' => "#",
                        'items' => [
                            ['label' => 'Publicas', 'icon' => 'music', 'url' => ['canciones/todas']],
                            ['label' => 'Mis Canciones', 'icon' => 'music', 'url' => ['canciones/index']],
                            ['label' => 'Mis Favoritas', 'icon' => 'thumbs-o-up', 'url' => ['site/likes']],
                        ],
                    ],
                    ['label' => 'Mis Amigos', 'icon' => 'thumbs-o-up', 'url' => ['amigos/index']],
                    ['label' => 'Panel de Control', 'icon' => 'th', 'url' => "#",
                    'items' => [
                            ['label' => 'Cuenta', 'icon' => 'user', 'url' => '#',
                                'items'=>[
                                    ['label' => 'Mi Perfil', 'icon' => 'thumbs-o-up', 'url' => ['site/intro']],
                                    ['label' => 'Cambio de contraseña', 'icon' => 'thumbs-o-up', 'url' => ['site/password']],
                                    ['label' => 'Eliminar Cuenta', 'icon' => 'thumbs-o-up', 'url' => ['site/eliminarcuenta',"id"=>yii::$app->user->Id]],
                                ]
                            ],
                            
                            ['label' => 'Configuracion', 'icon' => 'sliders', 'url' => '#',
                                'items'=>[
                                    ['label' => 'Vista Clasica', 'icon' => 'columns', 'url' => ['site/vistaclasica']],
                                    ['label' => 'Vista Tipo Lista', 'icon' => 'columns', 'url' => ['site/vistalista']],
                                    // ['label' => 'Cambio de contraseña', 'icon' => 'thumbs-o-up', 'url' => ['site/password']],
                                ]
                            ],

                            ['label' => 'Notificaciones', 'icon' => 'bell-o', 'url' => ['notificaciones/index']],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
