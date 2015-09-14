<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 10.06.14.
 * Time: 21:47
 */
include_once './view/header.php';
include_once './controler/baza.class.php';
include_once './controler/dnevnik.php';

if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}
if ($_SESSION["TIP"]!=1) {
    header("Location: greske.php?id_greske=13");
    exit();
}

if (isset($_POST['zaposli'])){
    $baza = new Baza();
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $parking = $_POST['parking'];

    $upit = "select idparking from parking where ime='$parking';";
    $rezutlat = $baza->selectDB($upit);
    $red = $rezutlat->fetch_assoc();
    $idparking = $red['idparking'];

    $upit = "update korisnik set parking=$idparking,tip_korisnika=2 where korisnicko_ime='$korisnicko_ime';";
    $rezutlat = $baza->selectDB($upit);


    $rezutlat = $baza->selectDB($upit);

    header("Location: administrator.php");
}
?>

    <div class="container">
        <h1 class="page-header">Dodaj zaposlenika i dodjeli parkiralište</h1>

        <div class="col-md-9" role="main">
            <div class="forma_okvir">
                <form role="form" class="form-horizontal" enctype="multipart/form-data" id="forma" name="froma"
                      action="<?PHP echo $_SERVER['PHP_SELF'] ?>"
                      method="POST">
                    <div class="form-group">
                        <label for="korisnicko_ime">Korisnicko ime</label>
                        <select class="form-control" name="korisnicko_ime" id="korisnicko_ime">

                        </select>

                    </div>


                    <div class="form-group has-success has-feedback">
                        <label for="parking">Parkiralište</label>
                        <select class="form-control" name="parking" id="parking">

                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" name="zaposli" id="zaposli">Zaposli</button>
                    <button type="reset" class="btn btn-warning">Resetiraj</button>
                    <p id="greska_zadnja" style="color: red;"></p>
                </form>
            </div>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script async src="//code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
    <script src="scripts/dodaj_zaposlenika.js"></script>


<?php
include_once './view/footer.php';
?>