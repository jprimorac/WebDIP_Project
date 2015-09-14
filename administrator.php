<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 01.06.14.
 * Time: 01:21
 */
include_once './view/header.php';
include_once './controler/admin_podaci.php';

if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}
if ($_SESSION["TIP"]!=1) {
    header("Location: greske.php?id_greske=13");
    exit();
}

?>


<div class="container">

    <div class="col-sm-6 col-md-3">
        <?php Admin::prijave_odjave(); ?>
    </div>

    <div class="col-sm-6 col-md-3">
        <?php Admin::prijavePoDanu(); ?>
    </div>

    <div class="col-sm-6 col-md-3">
        <h2><strong>Upravljanje vremenom sustava</strong></h2>

            <a href="controler/dohvati_vrijeme.php?akcija=dohvati" class=" btn btn-warning">Preuzmi vrijeme</a>


            <a href="controler/dohvati_vrijeme.php?akcija=sinkroniziraj" class=" btn btn-warning" >Uskladi vrijeme</a>



    <?PHP
    include_once './controler/dohvati_vrijeme.php';
    echo "Trenutno vrijeme: " . date("d.m.Y H:i", virtualno_vrijeme())."</br>";

    ?>

    </div>

    <div class="col-sm-6 col-md-3">
        <p>Pošaljite obavijest u obliku e-pošte svim korisnicima čija mjesečna karta istječe za manje od 3 dana.</p>
        <a href="./controler/notifikacija.php" class=" btn btn-warning"><span class="glyphicon glyphicon-envelope" ></span> Pošalji</a>
    </div>
    <button type="button" id="ispis" class="btn btn-warning pull-right printMe">
        <i class="glyphicon glyphicon-print"></i>  Ispis</button>


    <script src="scripts/print.js"></script>

</div>


<?php
include_once './view/footer.php';
?>



