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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<center>
    <a href="<?= Url::to(["canciones/create"]); ?>" class="btn btn-primary">Agregar Canciones</a>
</center>

<?php $f = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("canciones/index"),
    "enableClientValidation" => true,
]);
?>

<div class="form-group">
    <?= $f->field($form, "q")->input("search") ?>
</div>

<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>

<?php $f->end() ?>

<h3><?= $search ?></h3>


    <hr>
    <?= $mensaje; ?>
    <?=  $this->render("_canciones",[
        "model"=>$model,
    ]); ?>

</div>

<?= LinkPager::widget([
    "pagination" => $pages,
]); ?>
