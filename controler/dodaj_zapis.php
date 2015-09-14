<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 31.05.14.
 * Time: 23:55
 */
include_once "baza.class.php";
include_once "dnevnik.php";
$baza = new Baza();


$tablica2 = $_POST['tablica'];
$broj = $_POST['broj'];
$upit2 = "insert into $tablica2 values (";

$imena = array();


foreach ( $_POST as $key => $value )
{
    array_push($imena,$key);

}

for($k=0 ;$k<$broj;$k++){
    $param = $imena[$k];
    $upit2 .= "'$_POST[$param]',";
}

$upit2=substr($upit2,0,-1);
$upit2.=");";


$baza->selectDB($upit2);

$id=$_SESSION["ID"];
Dnevnik::insert($id,$upit,1);

header("Location: ../tablice.php");
exit();