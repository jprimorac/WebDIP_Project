<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 10.06.14.
 * Time: 23:19
 */

include_once './view/header.php';
include_once './controler/baza.class.php';

if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}
if ($_SESSION["TIP"] == 1 || $_SESSION["TIP"] == 3) {
    header("Location: greske.php?id_greske=14");
    exit();
}

$id = $_SESSION["ID"];


$baza= new Baza();

$upit = "select parking from korisnik where idkorisnik=$id;";
$rezutlat = $baza->selectDB($upit);
$red = $rezutlat->fetch_assoc();
$id_parking= $red['parking'];

$upit = "select * from parking where idparking = $id_parking;";
$rezutlat = $baza->selectDB($upit);
$red = $rezutlat->fetch_assoc();
$ime = $red['ime'];
$opis =$red['opis'];
$broj_mjesta = $red['broj_mjesta'];
$cijena= $red['cijena'];
$vrijeme= $red['vrijeme_naplate'];


$tablica = "<table class=\"table table-striped table-hover\"><caption><h2><strong> Šifre cijena </strong></h2></caption>";
$tablica .= "<thead><tr><th>ID</th><th>Sat</th><th>Dan</th><th>Mjesec</th></tr></thead><tbody>";

$upit = "select * from tip_cijene;";
$rezutlat = $baza->selectDB($upit);
    while($red=$rezutlat->fetch_row()){
        $tablica.="<tr>";
        $tablica.="<td>{$red[0]}</td>";
        $tablica.="<td>{$red[1]}</td>";
        $tablica.="<td>{$red[2]}</td>";
        $tablica.="<td>{$red[3]}</td></tr>";
    }
     $tablica.= "</tbody></table>";

$tablica2 = "<table class=\"table table-striped table-hover\"><caption><h2><strong> Šifre vremena naplate </strong></h2></caption>";
$tablica2 .= "<thead><tr><th>ID</th><th>Početak</th><th>Kraj</th></tr></thead><tbody>";

$upit = "select * from tip_vremena_naplate;";
$rezutlat = $baza->selectDB($upit);
while($red=$rezutlat->fetch_row()){
    $tablica2.="<tr>";
    $tablica2.="<td>{$red[0]}</td>";
    $tablica2.="<td>{$red[1]}</td>";
    $tablica2.="<td>{$red[2]}</td></tr>";
}
$tablica2.= "</tbody></table>";


if (isset($_POST['uredi'])){

    $parking = $_POST['parking'];
    $broj = $_POST['broj'];
    $opis = $_POST['opis'];
    $cijena = $_POST['cijena'];
    $vrijeme = $_POST['vrijeme'];

    //$upit = "update parking set broj_mjesta='$broj' where ime='$parking';";
    $upit = "update parking set broj_mjesta='$broj',opis='$opis',cijena='$cijena', vrijeme_naplate='$vrijeme' where ime='$parking';";
    $rezutlat = $baza->selectDB($upit);

    header("Location: zaposlenik.php");
}

?>

<div class="container">
    <h1 class="page-header">Uredi parkiralište</h1>

    <div class="col-md-6" role="main">
        <div class="forma_okvir">
            <form role="form" class="form-horizontal" id="forma" name="froma"
                  action="<?PHP echo $_SERVER['PHP_SELF'] ?>"
                  method="POST">

                <div class="form-group has-success has-feedback">
                    <label for="parking">Parkiralište</label>
                    <input class="form-control" name="parking" id="parking" value="<?php echo $ime ?>" readonly>
                </div>

                <div class="form-group has-success has-feedback">
                    <label for="parking">Broj mjesta</label>
                    <input class="form-control" name="broj" id="broj" value="<?php echo $broj_mjesta?>">
                </div>

                <div class="form-group has-success has-feedback">
                    <label for="parking">Opis</label>
                    <textarea rows="10" cols="50" class="form-control" name="opis" id="opis"><?php echo $opis ?></textarea>
                </div>

                <div class="form-group has-success has-feedback">
                    <label for="cijena">Cijene</label>
                    <input class="form-control" name="cijena" id="cijena" value="<?php echo $cijena ?>">
                </div>

                <div class="form-group has-success has-feedback">
                    <label for="vrijeme">Vrijeme naplate</label>
                    <input class="form-control" name="vrijeme" id="vrijeme" value="<?php echo $vrijeme ?>">
                </div>

                <button type="submit" class="btn btn-primary" name="uredi" id="uredi">Uredi</button>
                <button type="reset" class="btn btn-warning">Resetiraj</button>
                <p id="greska_zadnja" style="color: red;"></p>
            </form>
        </div>
    </div>
    <div class="col-md-5">

        <?php echo $tablica ?>
        <?php echo $tablica2 ?>

    </div>

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script async src="//code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script src="scripts/uredi_parking.js"></script>

<?php
include_once './view/footer.php';
?>