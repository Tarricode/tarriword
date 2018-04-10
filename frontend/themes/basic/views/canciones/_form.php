<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\models\Genero;
// use \Zelenin\yii\SemanticUI\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model backend\models\Canciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Datos Basicos
          </h3>
          <!-- tools box -->
          <div class="pull-right box-tools">
            <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                    title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
          <!-- /. tools -->
        </div>
        <div class="box-body">    
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
                ])->textInput()->label(false); ?>

                <?= $form->field($model, 'Titulo',['template'=>"
                  <div class='form-group'>
                      <label>{label}:</label>
                      <div class='input-group date'>
                          <div class='input-group-addon'>
                            <i class='fa fa-edit'></i>
                        </div>
                        {input}
                    </div>
                        {error}
                </div>
                "])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'file')->fileInput() ?>
                <div id="files" class="files"></div>
                <!-- <?= $form->field($model, 'Letra')->textarea(['rows' => 6]) ?> -->

                    <?= $form->field($model, 'detalle')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'Fecha')->textInput(["value"=>date("Y-m-d")]) ?>

                    <?php $genero = ArrayHelper::map(Genero::find()->all(), 'Id', 'Genero'); ?>
                    <?= $form->field($model, 'Genero')->dropDownList(
                      $genero,
                      [
                          'prompt'=>'Por favor elija una'
                      ]
                  );
                  ?>
                  <div class="ui accordion">
                    <div class="title"><i class="dropdown icon"></i> ¿No Aparece el genero que deseas? </div>
                    <div class="content">
                      <p class="transition hidden">
                        Si no aparace el genero que deseas colocarle a tu cancion puedes crear un nuevo genero en este campo
                    <?= $form->field($model, 'Genero2',[
                        "template"=>"

                    <div class='ui search'>
                      <div class='ui icon input'>
                        {input}
                        <i class='search icon'></i>
                      </div>
                      <div class='results'></div>
                    </div>
                        "
                      ])->textInput(["class"=>"prompt", "placeholder"=>"Nuevo genero"]) ?>                      
                        
                      </p>
                    </div>
                  </div>

                </div>
            </div>
        </div>

        <!-- Content Wrapper. Contains page content -->
         <div class="content">
           <!-- Content Header (Page header) -->
           <!-- Main content -->
               <div class="col-sm-12 col-md-8">
                 <div class="box box-info">
                   <div class="box-header">
                     <h3 class="box-title">Letra
                       <small>Escriba su letra Porfavor</small>
                     </h3>
                     <!-- tools box -->
                     <div class="pull-right box-tools">
                       <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                               title="Collapse">
                         <i class="fa fa-minus"></i></button>
                       <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                               title="Remove">
                         <i class="fa fa-times"></i></button>
                     </div>
                     <!-- /. tools -->
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body pad">
                    asd
                        <?= $form->field($model, 'Letra')->widget(CKEditor::className(), [
                            'options' => ['rows' => 6],
                            'preset' => 'basic',
                            ]) ?>
                   </div>
                 </div>
                 <!-- /.box -->
               </div>
               <!-- /.col-->
             </div>
             <div class="form-group">
                 <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i>Guardar Cancion' : '<i class="fa fa-edit"></i>Modificar Cancion', ['class' => $model->isNewRecord ? 'btn btn-app btn-block' : 'btn btn-app btn-block']) ?>
             </div>
                <?php ActiveForm::end(); ?>