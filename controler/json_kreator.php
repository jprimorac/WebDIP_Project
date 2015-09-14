<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 01.06.14.
 * Time: 01:25
 */
include_once "./baza.class.php";
include_once "./dohvati_vrijeme.php";


class json
{


    public static function reg_oznake()
    {

        $baza = new Baza();
        $upit = "select registracijske_oznake from vozilo;";
        $rezultat = $baza->selectDB($upit);
        $polje = array();
        while ($row = $rezultat->fetch_assoc()) {
            $polje[] = $row;

        }
        $reg_json = json_encode($polje);
        return $reg_json;
    }

    public static function Korisnik($korIme)
    {
        $baza = new Baza();
        $upit = "select korisnicko_ime from korisnik where korisnicko_ime='$korIme';";
        $rezultat = $baza->selectDB($upit);
        $polje = array();
        while ($row = $rezultat->fetch_assoc()) {
            $polje = "1";

        }
        if ($polje == "")
            $polje = "0";
        $korIme_json = json_encode(array('korisnik' => $polje));

        echo $korIme_json;
        exit();
    }

    public static function Email($email)
    {
        $baza = new Baza();
        $upit = "select email from korisnik where email='$email';";
        $rezultat = $baza->selectDB($upit);
        $polje = array();
        while ($row = $rezultat->fetch_assoc()) {
            $polje = 1;
        }
        $korEmail_json = json_encode(array('email' => $polje));

        echo $korEmail_json;
        return $korEmail_json;
    }

    public static function Parking()
    {
        $baza = new Baza();
        $upit = "select ime from parking;";
        $rezultat = $baza->selectDB($upit);
        $polje = array();
        while ($red = $rezultat->fetch_assoc()) {
            $polje[] = $red[ime];
        }
        $parking_json = json_encode($polje);

        echo $parking_json;
        return $parking_json;
    }

    public static function RegOznake($value)
    {

        $virtualno = virtualno_vrijeme();
        $sada = date("Y-m-d H:i:s", $virtualno);


        $baza = new Baza();
        $upit = "select distinct v.registracijske_oznake from vozilo as v, karta as k where k.vrijeme_isteka>'$sada' and k.vrijeme_kupnje<'$sada' and v.registracijske_oznake = k.vozilo and k.parking='$value';";
        $rezultat = $baza->selectDB($upit);
        $s_kartom = array();
        if($rezultat->num_rows!=0) $ima=1;
        while ($red = $rezultat->fetch_row()) {
            $s_kartom[] = "'" . $red[0] . "'";
        }
        if ($ima == 1) {
            $upit = "select registracijske_oznake from vozilo where (registracijske_oznake not in (" . implode(',', $s_kartom) . ")) order by registracijske_oznake;";
            $rezultat = $baza->selectDB($upit);

            $polje = array();
            while ($red = $rezultat->fetch_assoc()) {
                $polje[] = $red[registracijske_oznake];
            }
        }
        else {
            $upit = "select registracijske_oznake from vozilo order by registracijske_oznake;";
            $rezultat = $baza->selectDB($upit);

            $polje = array();
            while ($red = $rezultat->fetch_assoc()) {
                $polje[] = $red[registracijske_oznake];
            }
        }

        $reg_json = json_encode($polje);

        echo $reg_json;
        return $reg_json;
    }

    public static function BuduciZaposlenik()
    {
        $baza = new Baza();
        $upit = "select korisnicko_ime from korisnik where tip_korisnika=3 order by korisnicko_ime;";
        $rezultat = $baza->selectDB($upit);
        $polje = array();
        while ($red = $rezultat->fetch_assoc()) {
            $polje[] = $red[korisnicko_ime];
        }
        $reg_json = json_encode($polje);

        echo $reg_json;
        return $reg_json;
    }

    public static function Cijene()
    {
        $baza = new Baza();
        $upit = "select korisnicko_ime from korisnik where tip_korisnika=3 order by korisnicko_ime;";
        $rezultat = $baza->selectDB($upit);
        $polje = array();
        while ($red = $rezultat->fetch_assoc()) {
            $polje[] = $red[korisnicko_ime];
        }
        $reg_json = json_encode($polje);

        echo $reg_json;
        return $reg_json;
    }

    public static function Vrijeme()
    {
        $baza = new Baza();
        $upit = "select korisnicko_ime from korisnik where tip_korisnika=3 order by korisnicko_ime;";
        $rezultat = $baza->selectDB($upit);
        $polje = array();
        while ($red = $rezultat->fetch_assoc()) {
            $polje[] = $red[korisnicko_ime];
        }
        $reg_json = json_encode($polje);

        echo $reg_json;
        return $reg_json;
    }


}

$instanca = new json();

foreach ($_POST as $key => $value) {

    if ($key == "korisnik")
        $instanca->Korisnik($value);
    elseif ($key == "email")
        $instanca->Email($value);
    elseif ($key == "park")
        $instanca->Parking();
    elseif ($key == "reg")
        $instanca->RegOznake($value);
    elseif ($key == "bud_zap")
        $instanca->BuduciZaposlenik();
    elseif ($key == "cijena")
        $instanca->Cijene();

}
