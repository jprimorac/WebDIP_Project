<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 13.05.14.
 * Time: 19:47
 */
ob_start();
session_start();
include_once './dnevnik.php';
$id_kor=$_SESSION["ID"];

Dnevnik::odjava($id_kor);

if(session_id() == ""){
    session_start();
}
session_unset();

session_destroy();

//setcookie("Zadaca_05", "Zadaca_05", time() - 60*60*2);
//setcookie("Zadaca_05_korisnik", "",  time() - 60*60*2);

header("Location: ../index.php");

exit();

