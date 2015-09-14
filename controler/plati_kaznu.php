<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 13.06.14.
 * Time: 23:16
 */

session_start();
if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}
if ($_SESSION["TIP"]!=3) {
    header("Location: greske.php?id_greske=13");
    exit();
}


include_once 'baza.class.php';
include_once 'dnevnik.php';
$idkazna=$_GET['id'];

$baza= new Baza();
$upit="update kazna set placena=1 where idkazna='$idkazna'";
if ($rezulat= $baza->selectDB($upit)){
    $id=$_SESSION["ID"];
    Dnevnik::update($id,$upit,1);
    header("Location: ../vlasnik.php");
}

?>