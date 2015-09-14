<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 28.05.14.
 * Time: 20:52
 */
include_once './view/header.php';
include_once './controler/baza.class.php';



$dataTables = "<script src=\"//cdn.datatables.net/1.10.0/js/jquery.dataTables.min.js\"></script>
<script src=\"//cdn.datatables.net/plug-ins/be7019ee387/integration/bootstrap/3/dataTables.bootstrap.js\"></script>";

$baza = new baza();

$upit = "select * from parking,tip_cijene,tip_vremena_naplate where parking.cijena = tip_cijene.idtip_cijene and parking.vrijeme_naplate=tip_vremena_naplate.idtip_vremena_naplate";
$rezultat = $baza->selectDB($upit);

if ($rezultat->num_rows > 0) {

    $tablica = "<div class=\"container\"><table id=\"tablica\" class=\"table table-striped table-hover\"><caption><h2><strong>Popis parkirališta</strong></h2></caption>";
    $tablica .= "<thead><tr><th>Ime</th><th>Opis</th><th>Broj mjesta</th><th>Početak</th><th>Kraj</th><th>Sat</th><th>Dan</th><th>Mjesec</th></tr></thead><tbody>";

    while ($red = $rezultat->fetch_array()) {
        $tablica .= "<tr>"
            . "<td>{$red['ime']}</td>"
            . "<td>{$red['opis']}</td>"
            . "<td>{$red['broj_mjesta']}</td>"
            . "<td>{$red['pocetak_dan']}</td>"
            . "<td>{$red['kraj_dan']}</td>"
            . "<td>{$red['sat']}</td>"
            . "<td>{$red['dan']}</td>"
            . "<td>{$red['mjesec']}</td>"
            . "</tr>";
    }

    $tablica .= "</tbody></table></div>   ";

}
echo $dataTables;
echo $tablica;


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