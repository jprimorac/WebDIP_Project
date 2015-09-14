<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 30.05.14.
 * Time: 17:46
 */
include_once "./baza.class.php";
include_once "./dnevnik.php";
$baza = new Baza();
$tablica = $_GET['tablica'];
$id = $_GET['id'];

$upit = "delete from $tablica where id = $id";


if($tablica == "korisnik")
    $upit = "delete from $tablica where idkorisnik = $id";
elseif($tablica == "kazna")
    $upit = "delete from $tablica where idkazna = $id";
elseif($tablica == "parking")
    $upit = "delete from $tablica where idparking = $id";
elseif($tablica == "slike")
    $upit = "delete from $tablica where id = $id";
elseif($tablica == "tip_cijene")
    $upit = "delete from $tablica where idtip_cijene = $id";
elseif($tablica == "tip_dogadjaja")
    $upit = "delete from $tablica where idtip_dogadjaja = $id";
elseif($tablica == "tip_karte")
    $upit = "delete from $tablica where idtip_karte = $id";
elseif($tablica == "tip_korisnika")
    $upit = "delete from $tablica where idtip_korisnika = $id";
elseif($tablica == "tip_vremena_naplate")
    $upit = "delete from $tablica where idtip_vremena_naplate = $id";
elseif($tablica == "vozilo")
    $upit = "delete from $tablica where registracijske_oznake = '$id'";

$rezultat = $baza->selectDB($upit);

$id=$_SESSION["ID"];
Dnevnik::delete($id,$upit,1);

header ("Location: ../tablice.php");
exit();
