<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 30.05.14.
 * Time: 00:45
 */

require_once('./recaptchalib.php');
include_once './baza.class.php';
include_once './dohvati_vrijeme.php';
include_once './dnevnik.php';

header('Content-type: text/plain; charset=utf-8');

$baza = new Baza();
$greske = "";
if (isset($_POST['register'])) {

    //$privatekey = '6LfPG_MSAAAAAKeA4Dv-3Z-Whup6rPkjQ9zL9Oku';
    $recaptcha = recaptcha_check_answer('6LfPG_MSAAAAAKeA4Dv-3Z-Whup6rPkjQ9zL9Oku', $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

    if (!$recaptcha->is_valid) {
        $captcha_greska = "RECAPTCHA nije uspjeĹˇno unesena";
        header("Location: greske.php?id_greske=6");
        exit();
    }

    $korisnicko_ime = $_POST['korisnicko_ime'];
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $lozinka = $_POST['lozinka1'];
    $lozinka2 = $_POST['lozinka2'];
    $slika = $_FILES['slika'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $adresa = $_POST['adresa'];
    $grad = $_POST['grad'];

    $oznake = $_POST['oznake'];
    $marka = $_POST['marka'];
    $model = $_POST['model'];

    $kod = substr(md5(rand()), 0, 20);

    $upit = "SELECT * FROM korisnik where email='$email'";

    $rezultat = $baza->selectDB($upit);

    if ($korisnicko_ime === "" || $ime === "" || $prezime === "" || $lozinka === "" || $email === "" || $adresa === "" || $grad === "") {
        $greska_polja = "Nisu unesena sva polja";
        header("Location: greske.php?id_greske=8");
    } elseif (($ime{0} !== strtoupper($ime{0})) || ($prezime{0} !== strtoupper($prezime{0}))) {
        $greske = true;
        $greska_slova = "Prvo slovo imena i prezimena mora biti veliko.";
        header("Location: greske.php?id_greske=71");
    } elseif ((substr($ime, 1) !== strtolower(substr($ime, 1))) || (substr($prezime, 1) !== strtolower(substr($prezime, 1)))) {
        $greske = true;
        $greska_slova = "Samo mala slova osim prvog.";
        header("Location: greske.php?id_greske=72");
    }
    if ((!preg_match("/^[A-Za-zčČćĆžŽđĐšŠ]+$/", $ime)) || (!preg_match("/^[A-Za-zčČćĆžŽđĐšŠ]+$/", $prezime))) {
        $greska = true;
        $greska_slova = "Koristite samo slova u imenu i prezimenu";
        header("Location: greske.php?id_greske=73");
    } elseif ($rezultat->num_rows != 0) {
        $email_greska.="Email adresa je zauzeta!<br/>";
        header("Location: greske.php?id_greske=5");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_greska .= "Krivo strukturirana email adresa.<br />";
        header("Location: greske.php?id_greske=5");
    } elseif (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $lozinka)) {
        $lozinka_greska .= "Krivo strukturirana lozinka. <br />";
        header("Location: greske.php?id_greske=111");
    } elseif ($lozinka !== $lozinka2) {
        $lozinka_greska .= "Lozinke se ne podudaraju. <br />";
        header("Location: greske.php?id_greske=222");
    } elseif (empty($greske) && empty($captcha_greska)) {
        $vrijeme= virtualno_vrijeme();
        $sada = date("Y-m-d H:i:s",$vrijeme);

        $upit = "insert into korisnik(korisnicko_ime,ime,prezime,adresa,grad,email,telefon,"
            . "lozinka,zakljucan,tip_korisnika,zadnja_prijava) VALUES('$korisnicko_ime','$ime',"
            . "'$prezime','$adresa','$grad','$email','$telefon','$lozinka',"
            . "'1','3','$sada');";
        if ($baza->selectDB($upit)) {

            Dnevnik::registracija($korisnicko_ime,1);
            if($oznake!=""){
                $upit = "select idkorisnik from korisnik";
                $rezultat = $baza->selectDB($upit);
                while ($red =$rezultat->fetch_row()){
                    $id_kor = $red[0];
                }
             $upit = "insert into vozilo values('$oznake','$marka','$model','$id_kor');";
             $rezultat = $baza->selectDB($upit);
            }


            $kod = substr(md5(rand()), 0, 20);
            $upit2 = "insert into kod values(default,'$email','$kod');";
            $rezultat2 = $baza->selectDB($upit2);
            $primatelj = $email;
            $naslov = "Aktivacija korisnickog racuna";
            $poruka = "Postovani, \n\n "
                . "kreirali ste krisnički račun s sljedećim podacima: \n\n"
                . "Korisnicko ime: $korisnicko_ime\n"
                . "Lozinka: $lozinka\n\n"
                . "Da bi se kreirao Vas korisnicki racun, molimo vas da ga "
                . "aktivirate na navedenom linku.\n"
                . "http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_071/controler/aktivacija.php?kod=$kod";
            mail($primatelj, $naslov, $poruka);
            header("Location: ../aktivacija_poruka.php");
        } else {
            header("Location: greske.php?id_greske=2");
            ;
        }
    }
}

echo "registracija";