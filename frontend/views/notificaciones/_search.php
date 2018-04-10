<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\NotificacioneBuscador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notificaciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Tipo') ?>

    <?= $form->field($model, 'Descripcion') ?>

    <?= $form->field($model, 'Id_Usuario') ?>

    <?= $form->field($model, 'Id_Item') ?>

    <?php // echo $form->field($model, 'Area') ?>

    <?php // echo $form->field($model, 'Fecha_Creacion') ?>

    <?php // echo $form->field($model, 'Fecha_De_Visto') ?>

    <?php // echo $form->field($model, 'Visto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
