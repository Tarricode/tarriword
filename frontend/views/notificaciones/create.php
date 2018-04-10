<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Notificaciones */

$this->title = 'Create Notificaciones';
$this->params['breadcrumbs'][] = ['label' => 'Notificaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notificaciones-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
