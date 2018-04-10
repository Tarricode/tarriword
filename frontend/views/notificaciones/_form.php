<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Notificaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notificaciones-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'Tipo')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'Descripcion')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'Id_Usuario')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'Id_Item')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'Area')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'Fecha_Creacion')->textInput() ?>

        <?= $form->field($model, 'Fecha_De_Visto')->textInput() ?>

        <?= $form->field($model, 'Visto')->textInput() ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
