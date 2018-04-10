<?php
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'TarriWorld';
?>
<div class="site-index">
    <div class="jumbotron">
      <!-- <img width="80%" src="<?= yii::getAlias("@recursos");?>/images/Tarriword.png" alt=""> -->
      <img id="image" style="opacity: 0;" width="110%" src="<?= yii::getAlias("@recursosb");?>/images/TarriworldG.png" alt="">
<!-- <img src="<?= yii::getAlias("@recursos");?>/images/logo.jpg" alt=""> -->

        <p class="lead">
            El Mundo Creativo Espera Por Ti<br>
            <small>Imagina, Crea, Y Piensa en Grande.</small>
        </p>

        <p><a class="btn btn-lg btn-block btn-primary" href="<?= Url::to(["site/login"]);?>">Iniciar</a></p>
        <p><a class="btn btn-lg btn-block btn-primary" href="<?= Url::to(["site/signup"]);?>">Registrar</a></p>
    </div>
    <hr>
    <center>
      <h2>En nombre de TARRIWORD , les damos la más sincera bienvenida a nuestra página web, en la que, esperamos, encontrarán toda la información que necesiten acerca de nosotros</h2>
    </center>
<hr>
<br>
<br>
<br>
   <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-lg-4">
            <img class="" src="<?= yii::getAlias("@recursosb");?>/images/TarriworldP.png" alt="Generic placeholder image" width="150" height="140">
            <h2>Mision</h2>
            <p>Nuestra misión es impulsar a nuestros compositores a un nivel donde puedan dar a conocer su talento natural en el área de la música logrando expandir sus habilidades.</p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Vision</h2>
            <p>Expandirnos como una compañía respetada y eficaz donde podamos generar seguridad, confiabilidad y el más alto nivel de satisfacción para nuestros clientes.</p>
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
