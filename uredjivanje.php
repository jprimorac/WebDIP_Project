<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 31.05.14.
 * Time: 20:47
 */

include_once './controler/baza.class.php';
$baza = new Baza();
include_once "./view/header.php";

if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}
if ($_SESSION["TIP"]!=1) {
    header("Location: greske.php?id_greske=13");
    exit();
}

$tablica= $_GET['tablica'];
$id = $_GET['id'];



/*ob_start();
session_start();

if (!isset($_COOKIE["Zadaca_05_korisnik"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}

if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}
*/

if (isset($_POST['promjena'])){

    $tablica2 = $_POST['tablica'];
    $id2 = $_POST['oznaka'];
    $broj = $_POST['broj'];
    $upit2 = "update $tablica2 set ";

    $imena = array();


    foreach ( $_POST as $key => $value )
    {
        array_push($imena,$key);

    }


    for($k=0 ;$k<$broj;$k++){
        $param = $imena[$k];
        $upit2 .= "$param = '$_POST[$param]',";

    }


    $upit2=substr($upit2,0,-1);

    if($tablica2 == "korisnik")
        $upit2 .= " where idkorisnik = $id2";
    elseif($tablica2 == "kazna")
        $upit2 .= " where idkazna = $id2";
    elseif($tablica2 == "parking")
        $upit2 .= " where idparking = $id2";
    elseif($tablica2 == "slike")
        $upit2 .= " where id = $id2";
    elseif($tablica2 == "tip_cijene")
        $upit2 .= " where idtip_cijene = $id2";
    elseif($tablica2 == "tip_dogadjaja")
        $upit2 .= " where idtip_dogadjaja = $id2";
    elseif($tablica2 == "tip_karte")
        $upit2 .= " where idtip_karte = $id2";
    elseif($tablica2 == "tip_korisnika")
        $upit2 .= " where idtip_korisnika = $id2";
    elseif($tablica2 == "tip_vremena_naplate")
        $upit2 .= " where idtip_vremena_naplate = $id2";
    elseif($tablica2 == "vozilo")
        $upit2 .= " where registracijske_oznake = $id2";
    else
        $upit2 .=" where id = $id2";

    $baza->selectDB($upit2);

    header("Location: tablice.php");
    exit();
}

$header_upit = "show columns from $tablica";
$headeri = $baza->selectDB($header_upit);

$upit = "select * from $tablica where id = $id";

if($tablica == "korisnik")
    $upit = "select * from $tablica where idkorisnik = $id";
elseif($tablica == "kazna")
    $upit = "select * from $tablica where idkazna = $id";
elseif($tablica == "parking")
    $upit = "select * from $tablica where idparking = $id";
elseif($tablica == "slike")
    $upit = "select * from $tablica where id = $id";
elseif($tablica == "tip_cijene")
    $upit = "select * from $tablica where idtip_cijene = $id";
elseif($tablica == "tip_dogadjaja")
    $upit = "select * from $tablica where idtip_dogadjaja = $id";
elseif($tablica == "tip_karte")
    $upit = "select * from $tablica where idtip_karte = $id";
elseif($tablica == "tip_korisnika")
    $upit = "select * from $tablica where idtip_korisnika = $id";
elseif($tablica == "tip_vremena_naplate")
    $upit = "select * from $tablica where idtip_vremena_naplate = $id";
elseif($tablica == "vozilo")
    $upit = "select * from $tablica where registracijske_oznake = $id";

$rezultatUpit = $baza->selectDB($upit);


/*
$forma = "<div class=\"container\"><div >
    <h1>Registracija</h1>
    </div>

    <div class=\"col-md-9\" role=\"main\">
        <div class=\"forma_okvir\">
            <form role=\"form\" name=\"registracija\" id=\"registracija\"
                  action=\"proba.php\"
                  method=\"POST\">";

*/

$forma = "<div class=\"container\"><div >
    <h1>Registracija</h1>
    </div>

    <div class=\"col-md-9\" role=\"main\">
        <div class=\"forma_okvir\">
            <form role=\"form\" name=\"promjena\" id=\"promjena\"
                  action=\"".$_SERVER['PHP_SELF']."\"
                  method=\"POST\">";



if ($headeri->num_rows > 0) {

    if($rezultatUpit->num_rows == 1){

    $red = $rezultatUpit->fetch_row();
    $polje=0;

        while ($atribut = $headeri -> fetch_assoc()){

        $forma.= "<div class=\"form-group\">
                        <label for=".$atribut[Field] . " class = \"col-lg-3 control-label\">".$atribut[Field]."</label><div class = \"col-lg-9\">";

        $forma.="<input type=\"text\" class =\"form-control\" id=\"".$atribut[Field]."\" name=\"".$atribut[Field]."\" value=\"".$red[$polje]."\"></div></div>";
        $polje++;

        }
    }

}

$forma.= "<input name=\"tablica\" value=\"".$tablica."\" type=\"hidden\">";
$forma.= "<input name=\"oznaka\" value=\"".$id."\" type=\"hidden\">";
$forma.= "<input name=\"broj\" value=\"".$polje."\" type=\"hidden\">";

$forma .="<button type=\"submit\" name=\"promjena\" id=\"promjena\" class=\"btn btn-primary\">Promjeni</button>
                <button type=\"reset\" class=\"btn btn-warning\">Resetiraj</button>
            </form>
        </div>
    </div>
</div>";

echo $forma;

$idkor =$_GET['id'];




include_once "./view/footer.php";
?>
