<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Canciones */

$this->title = 'Create Canciones';
$this->params['breadcrumbs'][] = ['label' => 'Canciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="canciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
