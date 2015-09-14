<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 13.06.14.
 * Time: 22:47
 */

include_once './view/header.php';
include_once './controler/zaposlenik_podaci.php';
include_once './controler/vlasnik_podaci.php';

if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}

$dataTables = "<script src=\"//cdn.datatables.net/1.10.0/js/jquery.dataTables.min.js\"></script>
                <script src=\"//cdn.datatables.net/plug-ins/be7019ee387/integration/bootstrap/3/dataTables.bootstrap.js\"></script>";
echo $dataTables;

echo "<div class=\"container\">";


if ($_SESSION["TIP"]==2)
    Zaposlenik::sveKazne();
elseif($_SESSION["TIP"]==3)
    Vlasnik::sveKazne();

echo "<button type=\"button\" id=\"ispis\" class=\"btn btn-warning pull-right printMe\">
    <i class=\"glyphicon glyphicon-print\"></i>  Ispis</button></div>";


include_once './view/footer.php';




?>



<script src="scripts/print.js"></script>
<script>
    $("#tablica").dataTable();
</script>