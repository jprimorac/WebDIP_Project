<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 13.06.14.
 * Time: 21:37
 */

include_once './view/header.php';
include_once './controler/baza.class.php';

if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}

if ($_SESSION["TIP"] != 1) {
    header("Location: greske.php?id_greske=14");
    exit();
}

if (isset($_POST['kreiraj'])){

    $baza= new Baza();

    $parking = $_POST['parking'];

    $broj_mjesta=$_POST['broj'];
    $broj_mjesta = ($_POST['broj']=="" ? "NULL" : "'$broj_mjesta'");

    $opis = $_POST['opis'];
    $opis = ($_POST['opis']=="" ? "NULL" : "'$opis'");
    $cijena = $_POST['cijena'];
    $cijena = ($_POST['cijena']=="" ? "NULL" : "'$cijena'");
    $vrijeme = $_POST['vrijeme'];
    $vrijeme = ($_POST['vrijeme']=="" ? "NULL" : "'$vrijeme'");

    $upit = "insert into parking values(default, '$parking',$opis,$broj_mjesta,$cijena,$vrijeme);";
    $rezutlat = $baza->selectDB($upit);

    header("Location: administrator.php");
}
//
?>

<div class="container">
    <h1 class="page-header">Uredi parkiralište</h1>

    <div class="col-md-6" role="main">
        <div class="forma_okvir">
            <form role="form" class="form-horizontal" id="forma" name="froma"
                  action="<?PHP echo $_SERVER['PHP_SELF']?>"
                  method="POST">

                <div class="form-group has-success has-feedback">
                    <label for="parking">Parkiralište</label>
                    <input class="form-control" name="parking" id="parking">
                </div>

                <div class="form-group has-success has-feedback">
                    <label for="parking">Broj mjesta</label>
                    <input class="form-control" name="broj" id="broj">
                </div>

                <div class="form-group has-success has-feedback">
                    <label for="parking">Opis</label>
                    <textarea rows="10" cols="50" class="form-control" name="opis" id="opis"></textarea>
                </div>

                <div class="form-group has-success has-feedback">
                    <label for="cijena">Cijene</label>
                    <input class="form-control" name="cijena" id="cijena">
                </div>

                <div class="form-group has-success has-feedback">
                    <label for="vrijeme">Vrijeme naplate</label>
                    <input class="form-control" name="vrijeme" id="vrijeme">
                </div>

                <button type="submit" class="btn btn-primary" name="kreiraj" id="kreiraj">Kreiraj</button>
                <button type="reset" class="btn btn-warning">Resetiraj</button>
                <p id="greska_zadnja" style="color: red;"></p>
            </form>
        </div>
    </div>

</div>


<?php
include_once './view/footer.php';
?>