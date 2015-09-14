<?php

if (isset($_GET['id_greske'])) {
    echo "Dogodila se greska!!!<br />";
    switch ($_GET['id_greske']) {
        case 1: echo "Greska pri spajanju na bazu podataka";
            break;
        case 2: echo "Greska pri izvrsavanju upita";
            break;
        case 3: echo "Neusjesna registracija";
            break;
        case 4: echo "Neuspjesna aktivacija";
            break;
        case 5: echo "Greska pri unosu podataka. Molimo ispravno unesite podatke";
            break;
        case 6: echo "Greska pri provjeri captcha unosa";
            break;
        case 7: echo "Istekao vam je aktivacijski link";
            break;
        case 8: echo "Molimo unesite sve podatke.";
            break;
        case 9: echo "Neuspjesna registracija. Isteklo je vasih 24 sata nakon popunjanja obrasca za registraciju.";
            break;
        case 10: echo "Neispravni korisnički podaci pri prijavi.";
            break;
        case 11: echo "Nemoguce je kreirati kolacic (cookie)";
            break;
        case 12: echo "Niste prijavljeni.";
            break;
        case 13: echo "Niste prijavljeni kao administrator.";
            break;
        case 14: echo "Niste prijavljeni kao zaposlenik ili administrator.";
            break;
        case 15: echo "Neuspjesna promjena statusa korisnika.";
            break;
        case 16: echo "Niste prijavljeni kao vlasnik.";
            break;
        case 111: echo "Niste unijeli lozinku na način kako je savjetovano na formi za registraciju.";
            break;
        case 222: echo "Lozinke se ne podudaraju.";
            break;

        default: "Uzrok greske nepoznat!";
            break;
    }
} else {
    echo "Dogodila se nepoznata greska";
}

    //Ne znam je li trebalo obraditi greške na gore navedeni način il je trebalo preko hadlera koji je dolje naveden. 
    //Zadaca funkcionira s gore navedenim načinom i greške se prosljedjuju ovoj skripti zajedno s id-em greške.
    //Za greske pri unosu u formu, navedeni su id-evi, ali se ne prosljeđuju jer smatram da je loš UX ako korisnike vodimo s forme na drugu stranicu.
    //Linije koje bi ih trebale odvesti su zakomentirane u registracija.php skripti.

    echo "<a href=../pocetna.php>Vratite se na pocetnu stranicu i prijavite, pa pokusajte ponovo</a>";

    $razina = 1;
    

    set_error_handler('obradaPogresaka');
    
   function obradaPogresaka($errno, $errstr, $errfile, $errline, $errcontext) {
            echo "Desila se pogreška kod izvršavanja!<br>";
            echo "Datoteka: $errfile<br>";
            echo "Linija: $errline<br>";
            echo "Opis: $errstr<br>";
            echo "Kod: $errno<br>";
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] != "GET") {
            echo "Samo za GET metodu!";
            exit;
        }

        //echo "Postavljena razina: " . error_reporting() . "<br>";

        

?>