<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CancionesBuscar */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Canciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="canciones-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if(Yii::$app->session->hasFlash('mensaje')): ?>
        <div class="alert alert-success" role="alert">
            <?= Yii::$app->session->getFlash('mensaje') ?>
        </div>
    <?php endif; ?>


    <!-- <a href="<?= Url::to(["canciones/create"]); ?>" class="btn btn-app btn-block"><i class="fa fa-plus"></i>Agregar Canciones</a> -->
<h3><?= $search ?></h3>
<?= LinkPager::widget([
    "pagination" => $pages,
]); ?>
    <?php $config=frontend\models\Configuracion::find()->where(["Id_Usuario"=>yii::$app->user->Id])->count(); ?>
    <?php if ($config>0): ?>
    <?php $vista=frontend\models\Configuracion::find()->where(["Id_Usuario"=>yii::$app->user->Id])->one()->Vista; ?>
        
    <?php if ($vista==1): ?>    
    <?= $mensaje; ?>
    <?=  $this->render("_cancionesrespardo",[
        "model"=>$model,
        "mensaje"=>$mensaje,
        "pages"=>$pages,
        "form"=>$form,
        "search"=>$search,
    ]); ?>
    <?php endif ?>

    <?php if ($vista==2): ?>    
    <?= $mensaje; ?>
    <?=  $this->render("_canciones",[
        "model"=>$model,
        "mensaje"=>$mensaje,
        "pages"=>$pages,
        "form"=>$form,
        "search"=>$search,
    ]); ?>
    <?php endif ?>
    <?php endif ?>

    <?php if ($config==0): ?>
        <?= $mensaje; ?>
        <?=  $this->render("_cancionesrespardo",[
            "model"=>$model,
            "mensaje"=>$mensaje,
            "pages"=>$pages,
            "form"=>$form,
            "search"=>$search,
        ]); ?>
    <?php endif ?>

</div>
<?php 
//    $this->registerJs("
 //   $(function() {
   //     Push.create('Bienvenido',{
     //       body:'Bienvenido a tarriword esperamos que disfrute su visita',
       //     icon:'/tarriword/yiiplus/backend/web/images/TarriworldG.png',
         //   timeout:5000,
           // onClick:function(){
             //   window.location='".Url::to(['site/index'])."'
               // this.close();
            //}
        //});
    //});

//        ");
?>
<?= LinkPager::widget([
    "pagination" => $pages,
]); ?>
