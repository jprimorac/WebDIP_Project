<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 13.06.14.
 * Time: 23:54
 */

session_start();
include_once 'baza.class.php';
include_once 'dnevnik.php';

if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}
if ($_SESSION["TIP"]!=1) {
    header("Location: greske.php?id_greske=13");
    exit();
}

$id=$_GET['id'];
$tip=$_GET['tip'];

if($tip==0){
    $baza=new Baza();
    $upit="update korisnik set zakljucan=1 where idkorisnik='$id'";
    $rezultat=$baza->selectDB($upit);
    $id=$_SESSION["ID"];
    Dnevnik::update($id,$upit,1);
    header("Location: ../otkljucaj_korisnike.php");
}
elseif($tip==1){
    $baza=new Baza();
    $upit="update korisnik set zakljucan=0 where idkorisnik='$id'";
    $rezultat=$baza->selectDB($upit);
    $id=$_SESSION["ID"];
    Dnevnik::update($id,$upit,1);
    header("Location: ../otkljucaj_korisnike.php");
}

?>
