<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 13.06.14.
 * Time: 10:55
 */
include_once './view/header.php';
include_once './controler/baza.class.php';

if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}

$id = $_SESSION["ID"];

$baza= new Baza();

$upit = "select * from korisnik where idkorisnik=$id;";
$rezutlat = $baza->selectDB($upit);
$red = $rezutlat->fetch_assoc();

$korisnicko_ime = $red['korisnicko_ime'];
$ime = $red['ime'];
$prezime = $red['prezime'];
$adresa = $red['adresa'];
$grad = $red['grad'];
$email = $red['email'];
$telefon = $red['telefon'];
$lozinka = $red['lozinka'];

if (isset($_POST['uredi'])){

    $korisnicko_ime = $_POST['korisnicko_ime'];
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $adresa = $_POST['adresa'];
    $grad = $_POST['grad'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $lozinka = $_POST['lozinka1'];



    $upit = "update korisnik set ime='$ime',prezime='$prezime',adresa='$adresa', grad='$grad',telefon='$telefon', lozinka='$lozinka' where idkorisnik='$id';";
    $rezutlat = $baza->selectDB($upit);


    header("Location: index.php");
}

?>

<div class="container">
    <h1 class="page-header">Uredi račun</h1>

    <div class="col-md-6" role="main">
        <div class="forma_okvir">
            <form role="form" class="form-horizontal" id="forma" name="froma"
                  action="<?PHP echo $_SERVER['PHP_SELF'] ?>"
                  method="POST">


                <div class="form-group has-success has-feedback">
                    <label for="korisnicko_ime">Korisničko ime</label>
                    <input type="text" class="form-control" id="korisnicko_ime" name="korisnicko_ime" placeholder="Unesi korisničko ime" value="<?php echo $korisnicko_ime ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="lozinka1">Lozinka</label>
                    <input type="password" class="form-control" id="lozinka1" name="lozinka1" placeholder="Unesi lozinka" value="<?php echo $lozinka ?>">

                    <div class="row">
                        <div class="col-sm-6">
                            <span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Barem 8 znakova duga<br>
                            <span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Jedno veliko slovo
                        </div>
                        <div class="col-sm-6">
                            <span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Jedno malo slovo<br>
                            <span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Jedan broj
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lozinka2">Ponovi lozinku</label>
                    <input type="password" class="form-control" id="lozinka2" name="lozinka2" placeholder="Ponovi lozinku" value="<?php echo $lozinka ?>">
                    <div class="row">
                        <div class="col-sm-12">
                            <span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Lozinke se podudaraju
                        </div>
                    </div>
                </div>
                <div class="form-group has-success has-feedback">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Unesi email" value="<?php echo $email ?>" readonly>
                </div>
                <div class="form-group has-success has-feedback">
                    <label for="ime">Ime</label>
                    <input type="text" class="form-control" id="ime" name="ime" placeholder="Unesi svoje ime" value="<?php echo $ime ?>">
                </div>
                <div class="form-group has-success has-feedback">
                    <label for="prezime">Prezime</label>
                    <input type="text" class="form-control" id="prezime" name="prezime" placeholder="Unesi prezime" value="<?php echo $prezime ?>">
                </div>
                <div class="form-group">
                    <label for="adresa">Adresa</label>
                    <input type="text" class="form-control" id="adresa" name="adresa" placeholder="Unesi korisničko ime" value="<?php echo $adresa ?>">
                </div>
                <div class="form-group">
                    <label for="grad">Grad</label>
                    <input type="text" class="form-control" id="grad" name="grad" placeholder="Unesi korisničko ime" value="<?php echo $grad ?>">
                </div>
                <div class="form-group">
                    <label for="telefon">Telefon</label>
                    <input type="text" class="form-control" id="telefon" name="telefon" placeholder="Unesi broj telefona" value="<?php echo $telefon ?>">
                </div>

                <button type="submit" class="btn btn-primary" name="uredi" id="uredi">Uredi</button>
                <button type="reset" class="btn btn-warning">Resetiraj</button>
                <p id="greska_zadnja" style="color: red;"></p>
            </form>
        </div>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script async src="//code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script src = "scripts/form_valid.js"></script>

<?php
include_once './view/footer.php';
?>