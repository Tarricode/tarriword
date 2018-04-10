<?php
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'TarriWorld';
?>
<div class="site-index">
    <div class="jumbotron">
      <!-- <img width="80%" src="<?= yii::getAlias("@recursos");?>/images/Tarriword.png" alt=""> -->
      <img width="80%" src="<?= yii::getAlias("@recursos");?>/images/TarriworldG.png" alt="">
<!-- <img src="<?= yii::getAlias("@recursos");?>/images/logo.jpg" alt=""> -->

        <p class="lead">
            El Mundo Creativo Espera Por Ti<br>
            <small>Imagina, Crea, Y Piensa en Grande.</small>
        </p>

        <p><a class="btn btn-lg btn-block btn-primary" href="<?= Url::to(["site/login"]);?>">Iniciar</a></p>
    </div>

   <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-lg-4">
            <img class="img-circle" src="<?= yii::getAlias("@recursos");?>/images/Tarriword.png" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
</div>
