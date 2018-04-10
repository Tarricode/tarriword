<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<?= $msg ?>
<?php if ($msg!==null): ?>
	<hr>
	<center>
	<div class="card">
		<div class="image">  
				<img src="<?= yii::getAlias("@recursos");?><?= $foto; ?>">
		</div>
		<div class="extra">

		</div>
	</div>
	<a data-tooltip="Ir a mis fotos" href="<?= Url::to(["site/fotos"]); ?>">
		<button class="circular ui  icon button">
				<i class="icon picture"></i>
		
			</button>
		</a></center>	
	<hr>
<?php endif ?>
<h3>Subir archivos</h3>

<?php $form = ActiveForm::begin([
     "method" => "post",
     "enableClientValidation" => true,
     "options" => ["enctype" => "multipart/form-data"],
     ]);
?>

<?= $form->field($model, "file[]")->fileInput(['multiple' => true]) ?>

<?= Html::submitButton("Subir", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>