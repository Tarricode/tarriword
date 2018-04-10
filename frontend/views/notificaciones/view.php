<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Notificaciones */

$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Notificaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notificaciones-view box box-primary">
    <div class="box-header">
        <?= Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'Id',
                'Tipo',
                'Descripcion',
                'Id_Usuario',
                'Id_Item',
                'Area',
                'Fecha_Creacion',
                'Fecha_De_Visto',
                'Visto',
            ],
        ]) ?>
    </div>
</div>
