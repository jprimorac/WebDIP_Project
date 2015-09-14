<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 27.05.14.
 * Time: 18:13
 */
include_once './view/header.php';
include_once './controler/baza.class.php';
include_once './controler/dohvati_vrijeme.php';
include_once './controler/dnevnik.php';

if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}
if ($_SESSION["TIP"] == 3) {
    header("Location: greske.php?id_greske=14");
    exit();
}

$baza = new Baza();
$oznake = $_POST['oznake'];
$id = $_SESSION["ID"];
$upit = "select parking from korisnik where idkorisnik=$id;";
$rezutlat = $baza->selectDB($upit);
$red = $rezutlat->fetch_assoc();
$id_parking= $red['parking'];

echo "<p id=\"zap_parking\" hidden>$id_parking</p>";

if (isset($_POST['prijavi'])){



    $upit = "select t.kraj_dan from tip_vremena_naplate as t, parking as p where p.vrijeme_naplate=t.idtip_vremena_naplate and p.idparking=$id_parking;";
    $rezutlat = $baza->selectDB($upit);
    $red = $rezutlat->fetch_assoc();
    $kraj_vremena = $red['kraj_dan'];
    $vrijeme1= strtotime($kraj_vremena);
    $vrijeme2= strtotime("now");
    $razlika = date("H", $vrijeme1-$vrijeme2);

    $upit = "select t.sat from tip_cijene as t, parking as p where t.idtip_cijene= p.cijena and p.idparking=$id_parking;";
    $rezutlat = $baza->selectDB($upit);
    $red = $rezutlat->fetch_assoc();
    $cijena = $red['sat'];
    $iznos = $cijena*$razlika;

    $virtualno = virtualno_vrijeme();
    $sada = $sada = date("Y-m-d H:i:s",$virtualno);

    $upit = "insert into kazna values (default,'$sada',$iznos,0,$id_parking,'$oznake');";
    $rezutlat = $baza->selectDB($upit);
    $id=$_SESSION["ID"];
    Dnevnik::insert($id,$upit,0);



    $upit="select idkazna from kazna";
    $rezutlat = $baza->selectDB($upit);
    while($red = $rezutlat->fetch_assoc())
        $idkazne=$red['idkazna'];



    if(count($_FILES) > 0) {
        if(is_uploaded_file($_FILES['slika1']['tmp_name'])) {

            $imgData =addslashes(file_get_contents($_FILES['slika1']['tmp_name']));
            $imageProperties = getimageSize($_FILES['slika1']['tmp_name']);
            $upit = "INSERT INTO slike(kazna, vrsta,datoteka)
            VALUES($idkazne,'{$imageProperties['mime']}', '{$imgData}')";
            $rezutlat = $baza->selectDB($upit);

        }
        if(is_uploaded_file($_FILES['slika2']['tmp_name'])) {

            $imgData =addslashes(file_get_contents($_FILES['slika2']['tmp_name']));
            $imageProperties = getimageSize($_FILES['slika2']['tmp_name']);
            $upit = "INSERT INTO slike(kazna, vrsta,datoteka)
            VALUES($idkazne,'{$imageProperties['mime']}', '{$imgData}')";
            $rezutlat = $baza->selectDB($upit);
        }
        if(is_uploaded_file($_FILES['slika3']['tmp_name'])) {

            $imgData =addslashes(file_get_contents($_FILES['slika3']['tmp_name']));
            $imageProperties = getimageSize($_FILES['slika3']['tmp_name']);
            $upit = "INSERT INTO slike( kazna,vrsta,datoteka)
            VALUES($idkazne,'{$imageProperties['mime']}', '{$imgData}')";
            $rezutlat = $baza->selectDB($upit);
        }
        if(is_uploaded_file($_FILES['slika4']['tmp_name'])) {

            $imgData =addslashes(file_get_contents($_FILES['slika4']['tmp_name']));
            $imageProperties = getimageSize($_FILES['slika4']['tmp_name']);
            $upit = "INSERT INTO slike( kazna,vrsta,datoteka)
            VALUES($idkazne,'{$imageProperties['mime']}', '{$imgData}')";
            $rezutlat = $baza->selectDB($upit);
        }
        if(is_uploaded_file($_FILES['slika5']['tmp_name'])) {

            $imgData =addslashes(file_get_contents($_FILES['slika5']['tmp_name']));
            $imageProperties = getimageSize($_FILES['slika5']['tmp_name']);
            $upit = "INSERT INTO slike(kazna, vrsta,datoteka)
            VALUES($idkazne,'{$imageProperties['mime']}', '{$imgData}')";
            $rezutlat = $baza->selectDB($upit);
        }
    }
    header("Location: zaposlenik.php");

}





?>

<div class="container">
    <h1 class="page-header">Nova kazna</h1>

    <div class="col-md-9" role="main">
        <div class="forma_okvir">
            <form role="form" class="form-horizontal" enctype="multipart/form-data" id="forma" name="froma"
                  action="<?PHP echo $_SERVER['PHP_SELF'] ?>"
                  method="POST">
                <div class="form-group">
                    <label for="oznake">Registracijske oznake</label>
                    <select class="form-control" name="oznake" id="oznake">

                    </select>

                </div>

                <div class="form-group">
                    <label for="slika1">Slika 1</label>
                    <input type="file" id="slika1" name ="slika1">

                </div>
                <div class="form-group">
                    <label for="slika2">Slika 2</label>
                    <input type="file" id="slika2" name ="slika2">
                </div>
                <div class="form-group">
                    <label for="slika3">Slika 3</label>
                    <input type="file" id="slika3" name ="slika3">
                </div>
                <div class="form-group">
                    <label for="slika4">Slika 4</label>
                    <input type="file" id="slika4" name ="slika4">

                </div>
                <div class="form-group">
                    <label for="slika5">Slika 5</label>
                    <input type="file" id="slika5" name ="slika5">
                </div>


                <button type="submit" class="btn btn-primary" name="prijavi" id="prijavi">Prijavi</button>
                <button type="reset" class="btn btn-warning">Resetiraj</button>
                <p id="greska_zadnja" style="color: red;"></p>
            </form>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script async src="//code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script src="scripts/nova_kazna.js"></script>


<?php
include_once './view/footer.php';
?>
