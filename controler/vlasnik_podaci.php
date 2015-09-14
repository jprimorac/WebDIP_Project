<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 04.06.14.
 * Time: 00:56
 */
session_start();
include_once './controler/baza.class.php';

class Vlasnik{

    public static function neplacene(){
        $baza3 = new Baza();
        $id = $_SESSION["ID"];
        $upit = "select k.vrijeme, p.ime,v.registracijske_oznake,k.iznos,k.idkazna from kazna as k,parking as p, vozilo as v where v.korisnik = $id and k.vozilo = v.registracijske_oznake and p.idparking=k.parking and k.placena=0";
        $rezultat = $baza3->selectDB($upit);

        $tablica = "<table class=\"table table-hover\">";
        $tablica .= "<thead><tr><th>Vrijeme</th><th>Iznos</th><th>Parking</th><th>Vozilo</th><th></th></tr></thead><tbody><tr>";
        while($red = $rezultat->fetch_row()){
            $tablica .="<td>$red[0]</td>";
            $tablica .="<td>$red[1]</td>";
            $tablica .="<td>$red[2]</td>";
            $tablica .="<td>$red[3]</td>";
            $tablica .="<td><a href=\"./controler/plati_kaznu.php?id=$red[4]\">Plati</a></td></tr>";
            $tablica .="<td><a href=\"./detalji_kazne.php?id=$red[4]\">Detalji</a></td></tr>";
        }
        $tablica.= "</tbody></table>";
        echo $tablica;
    }

    public static function vazece(){
        $baza3 = new Baza();
        $id = $_SESSION["ID"];
        $upit = "select t.naziv,k.vrijeme_kupnje,k.vrijeme_isteka,p.ime,v.registracijske_oznake,k.iznos from karta as k,parking as p, vozilo as v,tip_karte as t
        where v.korisnik = $id and  k.vozilo = v.registracijske_oznake and p.idparking=k.parking and t.idtip_karte = k.tip_karte and unix_timestamp(CURRENT_TIMESTAMP)< unix_timestamp(k.vrijeme_isteka)";
        $rezultat = $baza3->selectDB($upit);

        $tablica = "<table class=\"table table-hover\">";
        $tablica .= "<thead><tr><th>Tip</th><th>Kupnja</th><th>Vrijedi do</th><th>Parking</th><th>Vozilo</th><th>Iznos</th></tr></thead><tbody>";
        while($red = $rezultat->fetch_row()){
            $tablica .="<tr><td>$red[0]</td>";
            $tablica .="<td>$red[1]</td>";
            $tablica .="<td>$red[2]</td>";
            $tablica .="<td>$red[3]</td>";
            $tablica .="<td>$red[4]</td>";
            $tablica .="<td>$red[5]</td></tr>";
        }
        $tablica.= "</tbody></table>";
        echo $tablica;
    }

    public static function vozila(){
        $baza3 = new Baza();
        $id = $_SESSION["ID"];
        $upit = "select registracijske_oznake, marka,model from vozilo where korisnik = $id";
        $rezultat = $baza3->selectDB($upit);

        $tablica = "<table class=\"table table-hover\">";
        $tablica .= "<thead><tr><th>Registracija</th><th>Marka</th><th>Model</th></tr></thead><tbody><tr>";
        while($red = $rezultat->fetch_row()){
            $tablica .="<td>$red[0]</td>";
            $tablica .="<td>$red[1]</td>";
            $tablica .="<td>$red[2]</td>";
            }
        $tablica.= "</tbody></table>";
        echo $tablica;
    }

    public static function  sveKazne(){
        $id=$_SESSION["ID"];
        $baza= new Baza();
        $upit = "select registracijske_oznake from vozilo where korisnik='$id';";
        $rezultat= $baza->selectDB($upit);
        $red= $rezultat->fetch_row();
        $oznake=$red[0];

        $tablica = "<div class=\"container\"></div><table  id=\"tablica\" class=\"table table-striped table-hover\"><caption><h2><strong>Sve upisane kazne</strong></h2></caption>";
        $tablica .= "<thead><tr><th>Vrijeme</th><th>Parking</th><th>Iznos</th><th>Detalji</th></tr></thead><tbody>";

        $upit = "select k.vrijeme,p.ime,k.iznos,idkazna from kazna as k, parking as p where k.vozilo='$oznake' and k.parking=p.idparking; ";
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

    public static function  sveKarte(){
        $id=$_SESSION["ID"];
        $baza= new Baza();
        $upit = "select registracijske_oznake from vozilo where korisnik='$id';";
        $rezultat= $baza->selectDB($upit);
        $red= $rezultat->fetch_row();
        $oznake=$red[0];

        $tablica = "<div class=\"container\"></div><table id=\"tablica\" class=\"table table-striped table-hover\"><caption><h2><strong>Sve kupljene karte</strong></h2></caption>";
        $tablica .= "<thead><tr><th>Vrijeme kupnje</th><th>Vrijeme prodaje</th><th>Parking</th><th>Iznos</th></tr></thead><tbody>";

        $upit = "select k.vrijeme_kupnje,k.vrijeme_isteka,p.ime,k.iznos,id from karta as k, parking as p where k.vozilo='$oznake' and k.parking=p.idparking; ";
        $rezultat= $baza->selectDB($upit);
        while($red= $rezultat->fetch_row()){
            $tablica.="<tr><td>$red[0]</td>";
            $tablica.="<td>$red[1]</td>";
            $tablica.="<td>$red[2]</td>";
            $tablica.="<td>$red[3]</td>";
        }

        $tablica.="</tbody></table>";
        echo $tablica;
    }





}
