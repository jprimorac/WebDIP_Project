<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 13.06.14.
 * Time: 20:59
 */
session_start();
include_once './controler/baza.class.php';

class Admin{

    public static function prijave_odjave(){
        $baza=new Baza();
        $upit="select count(CASE WHEN tip_dogadjaja = 2 THEN 1 END) as prijave, count(CASE WHEN tip_dogadjaja = 2 and uspjesno=1 THEN 1 END ) as uspjesne, count(CASE WHEN tip_dogadjaja = 2 and uspjesno=-1 THEN 1 END ) as uspjesne from dnevnik_rada;";
        $rezultat = $baza->selectDB($upit);
        $red = $rezultat->fetch_row();
        $prijave=$red[0];
        $uspjesne=$red[1];
        $neuspjesne=$red[2];

        $tablica = "<table class=\"table table-striped table-hover\"><caption><h2><strong>Statistika prijava</strong></h2></caption>";
        $tablica .= "<thead><tr><th>Sve prijave</th><th>Uspješne</th><th>Neuspješne</th></tr></thead><tbody><tr><td>$prijave</td><td>$uspjesne</td><td>$neuspjesne</td></tr></tbody></table>";

        echo $tablica;
    }

    public static function  prijavePoDanu(){

        $tablica = "<table class=\"table table-striped table-hover\"><caption><h2><strong>Broj različitih korisnika</strong></h2></caption>";
        $tablica .= "<thead><tr><th>Datum</th><th>Broj korisnika</th></tr></thead><tbody>";

        $baza=new Baza();
        $upit="SELECT DATE( vrijeme ) Datum, count( DISTINCT korisnik_idkorisnik ) korisnici FROM dnevnik_rada GROUP BY DATE( vrijeme );";
        $rezultat = $baza->selectDB($upit);
        while($red = $rezultat->fetch_row()){
            $datum=$red[0];
            $broj=$red[1];
            $tablica.="<tr><td>$red[0]</td><td>$red[1]</td></tr>";

        }
        $tablica.="</tbody></table>";
        echo $tablica;


    }

    public static function  zakljucani(){

        $tablica = "<table class=\"table table-striped table-hover\"><caption><h2><strong>Zakljucani korisnici</strong></h2></caption>";
        $tablica .= "<thead><tr><th>Korisnicko ime</th><th>Ime</th><th>Prezime</th><th>Email</th><th>Tip korisnika</th></tr></thead><tbody>";

        $baza=new Baza();
        $upit="select korisnicko_ime,ime,prezime,email,tip_korisnika,idkorisnik from korisnik where zakljucan = 1 order by korisnicko_ime";
        $rezultat = $baza->selectDB($upit);
        while($red = $rezultat->fetch_row()){
            $tablica.="<tr><td>$red[0]</td><td>$red[1]</td><td>$red[2]</td><td>$red[3]</td><td>$red[4]</td>";
            $tablica.="<td><a href=\"controler/otkljucaj_zakljucaj.php?id=$red[5]&tip=1\">Zakljucaj</a></td></tr>";
        }
        $tablica.="</tbody></table>";
        echo $tablica;


    }

    public static function  otkljucani(){

        $tablica = "<table class=\"table table-striped table-hover\"><caption><h2><strong>Otkljucani korisnici</strong></h2></caption>";
        $tablica .= "<thead><tr><th>Korisnicko ime</th><th>Ime</th><th>Prezime</th><th>Email</th><th>Tip korisnika</th></tr></thead><tbody>";

        $baza=new Baza();
        $upit="select korisnicko_ime,ime,prezime,email,tip_korisnika,idkorisnik from korisnik where zakljucan = 0 order by korisnicko_ime";
        $rezultat = $baza->selectDB($upit);
        while($red = $rezultat->fetch_row()){
            $tablica.="<tr><td>$red[0]</td><td>$red[1]</td><td>$red[2]</td><td>$red[3]</td><td>$red[4]</td>";
            $tablica.="<td><a href=\"controler/otkljucaj_zakljucaj.php?id=$red[5]&tip=0\">Zakljucaj</a></td></tr>";
        }
        $tablica.="</tbody></table>";
        echo $tablica;


    }

}