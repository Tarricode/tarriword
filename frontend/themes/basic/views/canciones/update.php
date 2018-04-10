<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Canciones */

$this->title =$model->Titulo;
$this->params['breadcrumbs'][] = ['label' => 'Canciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Titulo, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="canciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(Yii::$app->session->hasFlash('mensaje')): ?>
        <div class="alert alert-success" role="alert">
            <?= Yii::$app->session->getFlash('mensaje') ?>
        </div>
    <?php endif; ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
