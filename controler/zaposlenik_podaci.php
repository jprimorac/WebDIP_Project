<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 13.06.14.
 * Time: 22:34
 */
session_start();
include_once 'baza.class.php';
include_once 'dohvati_vrijeme.php';


class Zaposlenik{

    public static function  sveKazne(){
        $id=$_SESSION["ID"];
        $baza= new Baza();
        $upit = "select parking from korisnik where idkorisnik='$id';";
        $rezultat= $baza->selectDB($upit);
        $red= $rezultat->fetch_row();
        $id_parking=$red[0];

        $tablica = "<div class=\"container\"></div><table id=\"tablica\" class=\"table table-striped table-hover\"><caption><h2><strong>Sve upisane kazne</strong></h2></caption>";
        $tablica .= "<thead><tr><th>Vrijeme</th><th>Vozilo</th><th>Iznos</th><th>Detalji</th></tr></thead><tbody>";

        $upit = "select vrijeme,vozilo,iznos,idkazna from kazna where parking='$id_parking'; ";
        $rezultat= $baza->selectDB($upit);
        while($red= $rezultat->fetch_row()){
            $tablica.="<tr><td>$red[0]</td>";
            $tablica.="<td>$red[1]</td>";
            $tablica.="<td>$red[2]</td>";
            $tablica.="<td><a href=\"detalji_kazne.php?id=$red[3]\">Detalji</a></td></tr>";


        }
        $tablica.="</tbody></table>";
        echo $tablica;


    }

    public static function  danasnjeKazne(){
        $id=$_SESSION["ID"];
        $baza= new Baza();
        $upit = "select parking from korisnik where idkorisnik='$id';";
        $rezultat= $baza->selectDB($upit);
        $red= $rezultat->fetch_row();
        $id_parking=$red[0];

        $vrijeme= virtualno_vrijeme();
        $sada = date("Y-m-d ",$vrijeme);



        $tablica = "<div class=\"container\"></div><table class=\"table table-striped table-hover\"><caption><h2><strong>Današnje kazne</strong></h2></caption>";
        $tablica .= "<thead><tr><th>Vrijeme</th><th>Vozilo</th><th>Iznos</th></tr></thead><tbody>";

        $upit = "select vrijeme,vozilo,iznos,idkazna from kazna where parking='$id_parking' and DATE(vrijeme)='$sada';";
        $rezultat= $baza->selectDB($upit);
        while($red= $rezultat->fetch_row()){
            $tablica.="<tr><td>$red[0]</td>";
            $tablica.="<td>$red[1]</td>";
            $tablica.="<td>$red[2]</td>";
            $tablica.="<td><a href=\"detalji_kazne.php?id=$red[3]\">Detalji</a></td></tr>";


        }
        $tablica.="</tbody></table>";
        echo $tablica;



    }


    public static function  brojKazniDnevno(){
        $id=$_SESSION["ID"];
        $baza= new Baza();
        $upit = "select parking from korisnik where idkorisnik='$id';";
        $rezultat= $baza->selectDB($upit);
        $red= $rezultat->fetch_row();
        $id_parking=$red[0];

        $tablica = "<div class=\"container\"></div><table class=\"table table-striped table-hover\"><caption><h2><strong>Broj kazni dnevno</strong></h2></caption>";
        $tablica .= "<thead><tr><th>Datum</th><th>Broj kazni</th></tr></thead><tbody>";

        $upit = "select date(vrijeme), count(date(vrijeme))from kazna where parking='$id_parking' group by date(vrijeme)  limit 30;";
        $rezultat= $baza->selectDB($upit);
        while($red= $rezultat->fetch_row()){
            $tablica.="<tr><td>$red[0]</td>";
            $tablica.="<td>$red[1]</td></tr>";




        }
        $tablica.="</tbody></table>";
        echo $tablica;

    }
}