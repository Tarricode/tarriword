<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NotificacioneBuscador */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notificaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="notificaciones-index box box-primary">
    <div class="box-header with-border">
        <h3>Notificaciones</h3>
    </div>
    <div class="box-body table-responsive no-padding">
        <ul class="timeline">

            <!-- timeline time label -->
            <li class="time-label">
                <span class="bg-red">
                    10 Feb. 2014
                </span>
            </li>
            <!-- /.timeline-label -->

            <!-- timeline item -->
            <?php foreach ($model as $key): ?>
                
            <li>
                <!-- timeline icon -->
                <i class="fa fa-envelope bg-blue"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?= $key->Fecha_Creacion;?></span>

                    <h3 class="timeline-header"><a href="#"><?= backend\models\Canciones::find($key->Id_Item)->one()->Titulo?></a> ...</h3>

                    <div class="timeline-body">
                    <?= $key->Descripcion;?>
                    </div>

                    <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">...</a>
                    </div>
                </div>
            </li>
            <?php endforeach ?>
            <!-- END timeline item -->

            ...

        </ul>
    </div>
</div>
