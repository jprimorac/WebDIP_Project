<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 31.05.14.
 * Time: 16:34
 */

include_once './baza.class.php';
$baza = new Baza();

$ime = $_GET['tablica'];

$upit = "select * from $ime";

$rezultat = $baza->selectDB($upit);

//$broj_atributa = mysql_num_fields($rezultat);
$broj_atributa = 0;

$header_upit = "show columns from $ime";
$headeri = $baza->selectDB($header_upit);

$tablica = "<table class=\"table table-striped table-hover\"><caption><h2><strong> <? echo $ime ?> </strong></h2></caption>";
$tablica .= "<thead><tr>";

$dodaj = "<div class = \"modal fade\" id = \"dodaj\" role = \"dialog\"><div class = \"modal-dialog\">
        <div class = \"modal-content\">
            <form class = \"form-horizontal\" id=\"dodaj_forma\" name=\"dodaj_forma\" action=\"controler/dodaj_zapis.php\"
                  method=\"POST\">
                <div class = \"modal-header\">
                    <h4>Dodaj zapis</h4>
                </div>
                <div class = \"modal-body\">";



if ($headeri->num_rows > 0) {

    while ($atribut = $headeri -> fetch_assoc()) {

        $tablica .= "<th>";
        $tablica .=$atribut[Field];
        $tablica .= "</th>";

        $dodaj.= "<div class=\"form-group\">
                        <label for=".$atribut[Field] . " class = \"col-lg-3 control-label\">".$atribut[Field]."</label><div class = \"col-lg-9\">";

        $dodaj.="<input type=\"text\" class =\"form-control\" id=\"".$atribut[Field]."\" name=\"".$atribut[Field]."\"></div></div>";

        $broj_atributa ++;


    }
}

if ($rezultat->num_rows > 0) {

    /*
    for($i = 0; $i < $broj_atributa; $i++){

       $tablica .= <th> <? echo  mysql_field_name($rezultat, $i) ?> </th>
     }
    */

    $tablica .= "</tr></thead><tbody>";

    while ($red = $rezultat->fetch_array()) {
        $tablica .= "<tr>";
        for($j = 0; $j < $broj_atributa; $j++){

            $tablica .= "<td>{$red[$j]}</td>";

        }
        $tablica .= "<td><a href=\"./uredjivanje.php?tablica=$ime&id=$red[0]\">Uredi</a></td>";
        $tablica .= "<td><a href=\"./controler/brisanje.php?tablica=$ime&id=$red[0]\">Obrisi</a></td>";
        $tablica .= "</tr>";
    }

    $tablica .= "</tbody></table>   ";

}

echo $tablica;
$dodaj_button = "<button class=\"btn btn-warning\" href=\"#dodaj\" data-toggle=\"modal\">Dodaj novi zapis</button>";
echo $dodaj_button;



for($j = 0; $j < $broj_atributa; $j++){

    }


$dodaj .=  "<input name=\"tablica\" value=\"".$ime."\" type=\"hidden\">";
$dodaj .= "<input name=\"broj\" value=\"".$broj_atributa."\" type=\"hidden\">";

$dodaj .= "</div><div class = \"modal-footer\">
    <a class = \"btn btn-default\" data-dismiss = \"modal\">Zatvori</a>
    <button class = \"btn btn-primary\" type = \"submit\" name=\"dodavanje\" id=\"dodavanje\">Dodaj</button>
</div></form></div></div>";

echo $dodaj;
$skripta = "<script src = \"./js/bootstrap.js\"></script>";
echo $scripta;
?>

