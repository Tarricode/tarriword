<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Notificaciones */

$this->title = 'Update Notificaciones: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Notificaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notificaciones-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
