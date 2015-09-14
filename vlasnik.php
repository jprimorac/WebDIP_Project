<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 30.05.14.
 * Time: 01:50
 */
include_once './view/header.php';
include_once './controler/vlasnik_podaci.php';

if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}
if ($_SESSION["TIP"]==2) {
    header("Location: greske.php?id_greske=13");
    exit();
}
?>
<div class="container">
    <div class="row" style="display:flex;">

        <div class="col-sm-8 col-md-4">

                <div class="caption">
                    <h3>Neplaćene kazne</h3>
                    <? Vlasnik::neplacene(); ?>
                </div>

        </div>


        <div class="col-sm-10 col-md-5">



                    <h3>Važeće karte</h3>
                    <? Vlasnik::vazece(); ?>


        </div>


        <div class="col-sm4 col-md-3"  >
            <div class="caption">
                    <h3>Vozila</h3>
                    <? Vlasnik::vozila(); ?>
                </div>

            </div>

        </div>

    </div>

</div>

<?php
include_once './view/footer.php';
?>