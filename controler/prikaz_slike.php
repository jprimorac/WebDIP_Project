<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 13.06.14.
 * Time: 12:41
 */
ob_start();
session_start();
include_once 'baza.class.php';


if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}


if(isset($_GET['idslike'])) {
    $baza = new Baza();
    $id= $_GET['idslike'];
    $upit = "SELECT vrsta,datoteka FROM slike WHERE id='$id';";
    $rezutlat = $baza->selectDB($upit);
    $red = $rezutlat->fetch_assoc();
    header("Content-type: " . $red['vrsta']);
    echo $red['datoteka'];
}
?>