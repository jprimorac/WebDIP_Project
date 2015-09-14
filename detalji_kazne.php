<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 13.06.14.
 * Time: 11:38
 */
include_once './view/header.php';
include_once './controler/baza.class.php';

if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}

$idkazna=$_GET['id'];

$baza= new Baza();

$upit = "select * from kazna where idkazna='$idkazna';";
$rezutlat = $baza->selectDB($upit);
$red = $rezutlat->fetch_assoc();

$vrijeme = $red['vrijeme'];
$iznos = $red['iznos'];
$placena = $red['placena'];
$parking = $red['parking'];
$vozilo = $red['vozilo'];

$upit = "select ime from parking where idparking='$parking';";
$rezutlat = $baza->selectDB($upit);
$red = $rezutlat->fetch_assoc();
$ime_parkinga=$red['ime'];



$upit="select id from slike where kazna=$idkazna;";

$rezutlat = $baza->selectDB($upit);

/*
while($red = $rezutlat->fetch_row()){

    echo "<img src=controler/prikaz_slike.php?idslike=".$red[0]."/><br/>";

}
*/


?>
<div class="container">
    <h1 class="page-header">Detalji o kazni</h1>

    <div class="col-md-9" role="main">
        <div class="forma_okvir">
            <form role="form" class="form-horizontal" enctype="multipart/form-data" id="forma" name="froma"
                  action=""
                  method="POST">
                <div class="form-group">
                    <label for="oznake">Registracijske oznake</label>
                    <input type="text" class="form-control"  id="oznake" readonly value="<?php echo $vozilo ?>">
                </div>

                <div class="form-group">
                    <label for="oznake">Parking</label>
                    <input type="text" class="form-control"  id="parking" readonly value="<?php echo $ime_parkinga ?>">
                </div>

                <div class="form-group">
                    <label for="oznake">Vrijeme</label>
                    <input type="datetime" class="form-control"  id="vrijeme" readonly value="<?php echo $vrijeme ?>">
                </div>
                <div class="form-group">
                    <label for="oznake">Iznos</label>
                    <input type="text" class="form-control"  id="iznos" readonly value="<?php echo $iznos ?>">
                </div>

                <div class="form-group">
                    <p>Ukoliko pod "Plaćena" piše 1 - onda je plaćena, ukoliko piše 0 - onda nije.</p>
                    <label for="oznake">Plaćena</label>
                    <input type="text" class="form-control"  id="parking" readonly value="<?php echo $placena ?>">
                </div>

                <div class="form-group">
                    <label for="oznake">Slike</label>
                    <div id="links">

                <?php

                    $upit="select id from slike where kazna=$idkazna;";

                    $rezutlat = $baza->selectDB($upit);


                    while($red = $rezutlat->fetch_row()){

                     echo "<a href=controler/prikaz_slike.php?idslike=".$red[0]." data-gallery>";

                     echo "<img src=controler/prikaz_slike.php?idslike=".$red[0]." width=\"100\" height=\"100\" /></a>";

                    }
                    echo "</br>";
                ?>

                    </div>
                </div>

                <?php
                    if ($_SESSION["TIP"]==3 && $placena!=1) {
                echo "<a href=\"/controler/plati_kaznu.php?id=$idkazna\" class=\" btn btn-primary\">Plati</a>";

                 }
                ?>

                <a href="./index.php" class=" btn btn-warning">Natrag na naslovnu</a>

            </form>
        </div>
    </div>
</div>
<div id="blueimp-gallery" class="blueimp-gallery">

    <div class="slides"></div>

    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Prethodna
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Sljedeca
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="js/bootstrap-image-gallery.js"></script>