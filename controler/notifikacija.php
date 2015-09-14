<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 13.06.14.
 * Time: 19:20
 */
session_start();
include_once "baza.class.php";
$baza = new Baza();

if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}
if ($_SESSION["TIP"]!=1) {
    header("Location: greske.php?id_greske=13");
    exit();
}


$upit="select k.email from korisnik as k, karta as ka, vozilo as v where ka.tip_karte=3 and ka.vrijeme_isteka<now()+INTERVAL 3 DAY and ka.vrijeme_isteka >now() and ka.vozilo=v.registracijske_oznake and v.korisnik=k.idkorisnik;";
$rezultat=$baza->selectDB($upit);
while ($red=$rezultat->fetch_row()){
    $primatelj = $red[0];
    $naslov = "E-Parking, karta istice";
    $poruka = "Postovani, \n\n "
        . "Vasa mjesecna karta istice za manje od 3 dana. Molimo novu kupite na vrijeme da ne placate kazne.";

    mail($primatelj, $naslov, $poruka);

}

header("Location: ../administrator.php");
