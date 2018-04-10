<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>

<center><img width="50%" src="<?= yii::getAlias("@recursos");?>/images/TarriworldG.png" alt=""></center>
<br>
<br>
<br>
<div class="site-login">

    <div  class="panel panel-default col-md-4 col-md-offset-4">
   <div class="panel-body">
    <?= Html::a("
        <span class=\"glyphicon glyphicon-chevron-left\" aria-hidden=\"true\"></span>
    ",["site/index"]);?>
    <div class="ui horizontal divider header"><i class="user icon"></i>Iniciar Seccion</div>

     <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

     <?= $form->field($model, 'username',[
        'inputOptions' => [
            'placeholder' => $model->getAttributeLabel('Usuario'),
            'autofocus' => true
        ],
                    // 'inputTemplate' => '<div class="input-group"><span class="input-group-addon">@</span>{input}</div>',

        ])->textInput()->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput(["placeholder"=>"Password",'autofocus' => true])->label(false) ?>

        <?= $form->field($model, 'rememberMe')->checkbox()->label("Recordarme la cuenta") ?>

        <div class="form-group">
            <?= Html::submitButton('Iniciar', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
            <?= Html::a('Reiniciar', ['site/request-password-reset']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

</div>
