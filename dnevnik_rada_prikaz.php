<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 13.06.14.
 * Time: 22:24
 */

include_once './view/header.php';
include_once './controler/baza.class.php';

$baza = new baza();

$dataTables = "<script src=\"//cdn.datatables.net/1.10.0/js/jquery.dataTables.min.js\"></script>
<script src=\"//cdn.datatables.net/plug-ins/be7019ee387/integration/bootstrap/3/dataTables.bootstrap.js\"></script>";

$upit = "select d.id,d.vrijeme,d.uspjesno,d.korisnik_idkorisnik,t.naziv,d.upit from dnevnik_rada as d, tip_dogadjaja as t where t.idtip_dogadjaja=d.tip_dogadjaja order by id desc";
$rezultat = $baza->selectDB($upit);

$tablica = "<div class=\"container\"><table id=\"tablica\" class=\"table table-striped table-hover\"><caption><h2><strong>Dnevnik rada</strong></h2></caption>";
$tablica .= "<thead><tr><th>ID</th><th>Vrijeme</th><th>Usjpesno</th><th>ID korisnika</th><th>Tip događaja</th><th>Upit</th></tr></thead><tbody>";

while ($red = $rezultat->fetch_row()){
    $tablica.="<tr><td>$red[0]</td><td>$red[1]</td><td>$red[2]</td><td>$red[3]</td><td>$red[4]</td><td>$red[5]</td></tr>";
}
$tablica.="</tbody></table></div>";

echo $dataTables;

echo $tablica;



include_once './view/footer.php';
?>


<button type="button" id="ispis" class="btn btn-warning pull-right printMe">
    <i class="glyphicon glyphicon-print"></i>  Ispis</button>


<script src="scripts/print.js"></script>
<script>
    $("#tablica").dataTable();
</script>

<?php
include_once './view/footer.php';
?>