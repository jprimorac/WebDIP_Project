<?php

include_once('baza.class.php');
include_once('dnevnik.php');



$baza = new baza();

if (isset($_GET['kod'])) {
    $kod = $_GET['kod'];

    $upit = "SELECT email FROM kod WHERE kljuc='$kod';";
    $rezultat = $baza->selectDB($upit);
    $red = mysqli_fetch_array($rezultat);
    $email= $red['email'];

    $upit = "SELECT zadnja_prijava,idkorisnik FROM korisnik WHERE email='$email';";
    $rezultat = $baza->selectDB($upit);
    $red = mysqli_fetch_array($rezultat);
    $vrijeme_prijave= strtotime($red['zadnja_prijava']);
    $id_kor= $red['idkorisnik'];
    $dan_prije= strtotime('-1 day');

    if ( $vrijeme_prijave > $dan_prije) {

        $upit = "UPDATE korisnik SET zakljucan = 0 WHERE email='{$email}';";

        $rezultat = $baza->selectDB($upit);
        
        if ($rezultat) {
            $id=$_SESSION["ID"];
            Dnevnik::update($id_kor,$upit,1);

            header("Location: ../pocetna.php");
        } else {
            header("Location: ../greske.php?id_greske=2");
        }
    } else {
        header("Location: ../greske.php?id_greske=9");
    }
} else {
    header("Location: ../registracija.php");
}
?>
