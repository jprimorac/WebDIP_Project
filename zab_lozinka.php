<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 08.06.14.
 * Time: 22:22
 */
include_once './view/header.php';
include_once './controler/baza.class.php';


if(isset($_POST['posalji'])){
    $baza = new Baza();

    $email = $_POST['email'];
    $duljina =8;
    $slova = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $broj = mb_strlen($slova);

    for ($i = 0, $lozinka = ''; $i < $duljina; $i++) {
        $index = rand(0, $broj - 1);
        $lozinka .= mb_substr($slova, $index, 1);
    }

    $upit = "update korisnik set lozinka='$lozinka' where email='$email'";
    $rezultat = $baza->selectDB($upit);

    $primatelj = $email;
    $naslov = "Nova lozinka";
    $poruka = "Postovani, Vasa nova lozinka za E-Parking glasi: $lozinka";
    mail($primatelj, $naslov, $poruka);

    header("Location: pocetna.php");
}


?>

<div class="container">
    <form class = "form-horizontal" id="zab_lozinka" name="zab_lozinka" action="<?PHP echo $_SERVER['PHP_SELF'] ?>"
          method="POST">
        <div class="form-group">
            <label for="email" class = " control-label">Unesite e-mail s kojim ste kreirali korisnički račun i poslati ćemo vam novu lozinku</label>
            <div class = "col-lg-9">
                <input type="text" class="form-control" id="email" name="email" placeholder="Vaša e-mail adresa">
            </div>
        </div>
        <div>
            <button class = "btn btn-primary" type = "submit" name="posalji" id="posalji">Pošalji</button>
        </div>
        <div class="col-sm-12">
            <span id="zauzeto_email" style="color: red;"></span>
        </div>
    </form>
</div>

<script src = "scripts/zab_lozinka.js"></script>