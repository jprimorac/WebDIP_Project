<?php
ob_start();
include_once './controler/baza.class.php';
include_once './controler/korisnik.class.php';
include_once './controler/dnevnik.php';


class Login
{
    const TIP ="TIP";
    const ID = "ID";
    const KORIME = "KORIME";
    const IME = "IME";
    const PREZIME = "PREZIME";
    const EMAIL = "EMAIL";
    const SESSION_NAME = "PzaWeb";




    public static function autentikacija($korIme, $lozinka)
    {
        $baza = new Baza();
        $korisnik = new Korisnik();

        $upit = "SELECT tip_korisnika, idkorisnik, korisnicko_ime,ime,prezime,email,lozinka,zakljucan FROM korisnik where korisnicko_ime = '$korIme' or email='$korIme'";

        $rezultat =  $baza->selectDB($upit);


        if($rezultat->num_rows==1){


            list($tip_korisnika,$id_korisnika,$korIme,$ime,$prezime,$email,$lozinka2,$zakljucan) = $rezultat->fetch_array();
            $korisnik->set_podaci($tip_korisnika,$id_korisnika,$korIme,$ime,$prezime,$email);
            if($zakljucan==1){
                Dnevnik::prijava($korIme,-1);
                return -1;
            }

            if($lozinka == $lozinka2)
            {
                self::kreirajSesiju($tip_korisnika,$id_korisnika,$korIme,$ime,$prezime,$email);
                $upit2 = "update korisnik set pokusaj = 0 where idkorisnik ='$id_korisnika'";
                $rezultat2 =  $baza->selectDB($upit2);
                Dnevnik::prijava($korIme,1);
                return $tip_korisnika;
            }
            if($lozinka != $lozinka2){
                Dnevnik::prijava($korIme,-1);
                $upit2 = "update korisnik set pokusaj = pokusaj+1 where idkorisnik = '$id_korisnika'";
                $rezultat2 =  $baza->selectDB($upit2);
                $upit3 = "select pokusaj from korisnik where idkorisnik = '$id_korisnika'";
                $rezultat3 =  $baza->selectDB($upit3);
                $broj = $rezultat3->fetch_array();
                $broj2 = $broj['pokusaj'];
                if($broj2 >=3){
                    $kljucaj= "update korisnik set zakljucan = 1 where idkorisnik ='$id_korisnika'";
                    $rezultat4 =  $baza->selectDB($kljucaj);
                }
                return 0;
            }
            else
                header("Location: greske.php?id=0");
        }
    }

    static function kreirajSesiju($tip_korisnika, $id_korisnika, $ime, $prezime, $email, $korIme)
    {
        //session_name(self::SESSION_NAME);

        if(session_id() == ""){
            session_start();
        }

        $_SESSION[self::TIP] = $tip_korisnika;
        $_SESSION[self::ID] = $id_korisnika;
        $_SESSION[self::IME] = $ime;
        $_SESSION[self::PREZIME] = $prezime;
        $_SESSION[self::EMAIL] = $email;
        $_SESSION[self::KORIME] = $korIme;
        $_SESSION["PzaWeb"]="PzaWeb";


    }

    static function brisiSesiju()
    {
        header("Location: prosla.php");
        session_name(self::SESSION_NAME);

        if(session_id() == ""){
            session_start();
        }
        if(session_unset()) header("Location: prosla.php");
        else header("Location: greska.php");
        if(session_destroy())header("Location: prosla.php");
        else header("Location: greska.php");
        return 1;

    }

    static function kreirajCookie($korIme)
    {


            setcookie("Projekt_071", "Projekt_071", time() + (86400 * 7));
            setcookie("Projekt_071_korisnik", $korIme,  time() +(86400 * 7));
            return 1;

    }
    /*
    static function dohvatiCoockie($korIme)
    {

        $korImeC=$_COOKIE['korIme']!='' ? $_COOKIE['korIme'] : '';
        $lozinkaC=$_COOKIE['lozinka']!='' ? $_COOKIE['lozinka'] : '';

        $polje = array(
                "korImeC" => $korImeC,
                "lozinkaC" => $lozinkaC
                );
        return $polje;
    }
    */
    static function brisiCookie()
    {
        setcookie("Zadaca_05", "Zadaca_05", time() - 60*60*2);
        setcookie("Zadaca_05_korisnik", "",  time() - 60*60*2);
        return 1;

    }

}

?>