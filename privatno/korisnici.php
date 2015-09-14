<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 07.06.14.
 * Time: 20:23
 */

include_once "../controler/baza.class.php";


$baza = new Baza();

$upit = "select korisnicko_ime, prezime, ime, email, lozinka from korisnik";
$rezultat = $baza->selectDB($upit);

$tablica = "<table class=\"table table-striped table-hover\"><caption><h2><strong> Korisnici </strong></h2></caption>";
$tablica .= "<thead><tr>";
$tablica .= "<th>Korisnicko_ime</th><th>Prezime</th><th>Ime</th><th>Email</th><th>Lozinka</th>";
$tablica .= "</tr></thead><tbody>";

while ($red = $rezultat->fetch_assoc()) {
    $tablica .= "<tr>";

    $tablica .= "<td>{$red['korisnicko_ime']}</td>";
    $tablica .= "<td>{$red['prezime']}</td>";
    $tablica .= "<td>{$red['ime']}</td>";
    $tablica .= "<td>{$red['email']}</td>";
    $tablica .= "<td>{$red['lozinka']}</td>";

    $tablica .= "</tr>";
}

$tablica .= "</tbody></table>";

?>
<!DOCTYPE html>
<html>
<head>
    <title>E-parking</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href = "../css/bootstrap.min.css" rel = "stylesheet">
    <link href = "../css/custom.css" rel = "stylesheet">
    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
</head>
<body>
<div class="container">
<?echo $tablica?>
</div>
</body>