<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 11.06.14.
 * Time: 01:34
 */
include_once './view/header.php';
include_once './controler/baza.class.php';
include_once './controler/dnevnik.php';


if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}
if ($_SESSION["TIP"] != 3) {
    header("Location: greske.php?id_greske=16");
    exit();
}

if (isset($_POST['kupi'])){
    $baza = new Baza();
    $parking = $_POST['parking'];
    $tip_karte = $_POST['tip_karte'];
    $datum = $_POST['datum'];

    $upit = "select idparking,cijena from parking where ime='$parking';";
    $rezutlat = $baza->selectDB($upit);
    $red = $rezutlat->fetch_assoc();
    $idparking = $red['idparking'];
    $tip_cijene= $red['cijena'];

    $id = $_SESSION["ID"];
    $upit="select registracijske_oznake from vozilo where korisnik='$id';";
    $rezutlat = $baza->selectDB($upit);
    $red = $rezutlat->fetch_row();
    $oznake = $red[0];

    if($tip_karte == 2){
        $upit = "select dan from tip_cijene where idtip_cijene='$tip_cijene';";
        $rezutlat = $baza->selectDB($upit);
        $red = $rezutlat->fetch_assoc();
        $iznos = $red['dan'];
        $upit="insert into karta values (default,'$datum'+INTERVAL 1 DAY,'$datum',2,'$oznake','$idparking','$iznos');";
        $rezutlat = $baza->selectDB($upit);
        $id=$_SESSION["ID"];
        Dnevnik::insert($id,$upit,0);


        header("Location: dnevna.php");
    }

    elseif($tip_karte == 3){
        $upit = "select mjesec from tip_cijene where idtip_cijene='$tip_cijene';";
        $rezutlat = $baza->selectDB($upit);
        $red = $rezutlat->fetch_assoc();
        $iznos = $red['mjesec'];
        $upit="insert into karta values (default,'$datum'+INTERVAL 30 DAY,'$datum',3,'$oznake','$idparking','$iznos');";
        $rezutlat = $baza->selectDB($upit);
        $id=$_SESSION["ID"];
        Dnevnik::insert($id,$upit,0);


        header("Location: mjesecna.php");
    }

    //<?PHP echo $_SERVER['PHP_SELF']

header("Location: vlasnik.php");
}

?>

<div class="container">
    <h1 class="page-header">Nova karta</h1>

    <div class="col-md-9" role="main">
        <div class="forma_okvir">
            <form role="form" class="form-horizontal" id="forma" name="froma"
                  action="<?PHP echo $_SERVER['PHP_SELF']?>"
                  method="POST">

                <div class="form-group has-success has-feedback">
                    <label for="parking">Parkiralište</label>
                    <select class="form-control" name="parking" id="parking">

                    </select>
                </div>
                <p>Ukoliko ne promjenite odabir, odabrana je dnevna karta</p>

                <div class="form-group has-success has-feedback">
                    <label for="tip_karte">Tip karte</label>
                    <select class="form-control" name="tip_karte" id="tip_karte">
                        <option value="2" selected>Dnevna</option>
                        <option value="3">Mjesečna</option>
                    </select>
                </div>

                <div class="form-group has-success has-feedback">
                    <p>Za mjesečnu datum označava početak važenja.<br>Za dnevnu datum označava dan za koji vrijedi.<br>Datum je formata: godina-mjesec-dan.</p>
                    <label for="datum">Datum</label>
                    <input type="date" class="form-control" name="datum" id="datum">
                </div>

                <button type="submit" class="btn btn-primary" name="kupi" id="kupi">Kupi</button>
                <button type="reset" class="btn btn-warning">Resetiraj</button>
                <p id="greska_zadnja" style="color: red;"></p>
            </form>
        </div>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script src="scripts/nova_karta.js"></script>


<?php
include_once './view/footer.php';
?>
