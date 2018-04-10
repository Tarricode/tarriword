<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use \Zelenin\yii\SemanticUI\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model backend\models\Canciones */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="canciones-form">

    <?php $form = ActiveForm::begin([
     // "method" => "post",
     // "enableClientValidation" => true,
     "options" => ["enctype" => "multipart/form-data"],
     ]); ?>

    <?= $form->field($model, 'IdUsuario',[
        'inputOptions'=>[
            "hidden"=>"true",
            "value"=>Yii::$app->user->Id
        ],
    ])->textInput()->label(false) ?>

    <?= $form->field($model, 'Titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <!-- <?= $form->field($model, 'Letra')->textarea(['rows' => 6]) ?> -->
    
    <?= $form->field($model, 'Letra')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic',
    ]) ?>

    <?= $form->field($model, 'detalle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Fecha')->textInput(["value"=>date("Y-m-d")]) ?>

    <?= $form->field($model, 'Genero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Megusta')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
