<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 30.05.14.
 * Time: 16:24
 */

include_once './view/header.php';

if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}
if ($_SESSION["TIP"]!=1) {
    header("Location: greske.php?id_greske=13");
    exit();
}

?>

    <div class ="container">
        <button data-tablica="dnevnik_rada" class="select-table btn btn-default">Dnevnik rada</button>
        <button  data-tablica="karta" class="select-table btn btn-default">Karta</button>
        <button data-tablica="kazna" class="select-table btn btn-default">Kazna</button>
        <button data-tablica="korisnik" class="select-table btn btn-default">Korisnik</button>
        <button data-tablica="parking" class="select-table btn btn-default">Parking</button>
        <button data-tablica="slike" class="select-table btn btn-default">Slike</button>
        <button data-tablica="tip_cijene" class="select-table btn btn-default">Tip cijene</button>
        <button data-tablica="tip_dogadjaja" class="select-table btn btn-default">Tip događaja</button>
        <button data-tablica="tip_karte" class="select-table btn btn-default">Tip karte</button>
        <button data-tablica="tip_korisnika" class="select-table btn btn-default">Tip korisnika</button>
        <button data-tablica="tip_vremena_naplate" class="select-table btn btn-default">Tip vremena naplate</button>
        <button data-tablica="vozilo" class="select-table btn btn-default">Vozilo</button>

    </div>
<div class ="container" id="responsecontainer">



</div >

<script src = "scripts/tablice.js"></script>
<script src="//cdn.datatables.net/plug-ins/be7019ee387/integration/bootstrap/3/dataTables.bootstrap.js"></script>

<?php
include_once './view/footer.php';
?>