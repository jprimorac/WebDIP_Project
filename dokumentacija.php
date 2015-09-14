<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 14.06.14.
 * Time: 02:00
 */
include_once './view/header.php';
?>

<div class="container">
    <div class="well">
        <h2>Opis Projektnog zadatka</h2>

        <pre>
Kratak opis projekta:
    Sustav služi za organizaciju, evidenciju i naplatu parkinga na organiziranom parkingu (npr. podzemna
    garaža).
Uloge:
    - Neregistrirani korisnik
    - Vlasnik vozila (registrirani korisnik)
    - Zaposlenik parkirališta (Moderator)
    - Administrator
Detaljne upute:
    Administrator
       - Kreira parkirališta i svakom parkiralištu dodjeljuje zaposlenike.
       - Administrator vidi statistiku korištenja sustava, pogrešnih/ispravnih prijava, po korisnicima i vremenskom periodu (od - do).
       - Da bi se postalo zaposlenikom parkirališta administrator mora korisniku dodijeliti tu ulogu.
       - Administrator vidi dali ima karata koje ističu za 3 dana i može okinuti slanje e-maila korisnicima sa obavijesti da im ističe mjesečna karta.
    Zaposlenik
       - Svako parkiralište opisuje sa opisnim podacima (ime parkirališta, broj parkirnih mjesta,
         vrijeme naplate, cijene parkiranja (jedan sat, cjelodnevna karta, mjesečna karta)).
       - Na njemu dodijeljenom parkiralištu evidentira automobile koji nemaju važeću kartu za
         parkiranje (provjerom registracijske tablice u slučaju vozila sa plaćenom mjesečnom
         parkirnom kartom) te ispostavlja kaznu za parkiranje.
       - Opis kazne sadrži registraciju vozila u prekršaju, datumom evidencije. Podaci o veličini kazne
         se popunjavaju automatski nakon unosa vremena evidentiranog prekršaja. Iznos kazne se
         obračunava od punog tekućeg sata do kraja naplate parkinga na dan evidentiranja.
       - Obavezno mora dokumentirati kaznu galerijom slika automobila u prekršaju (min 3 slike).
       - Zaposlenik vidi statistiku parkiranja po kategorijama parkiralište, zaposlenik parkirališta te
         vlasnik vozila. I svi pregledi se baziraju na vremenskom periodu (od - do).
    Vlasnik
        - Prilikom registracije na sustav se unose podaci o vlasniku vozila (ime, prezime) te podaci o
        automobilu (marka automobila, registracijska oznaka).
        - Ima mogućnost plaćanja dnevne parkirne karte na odabranom parkiralištu na odabrani dan
          te plaćanja mjesečne parkirne karte na odabranom parkiralištu od odabranog datuma.
        - Ima uvid u sve neplaćene kazne za registriranu registraciju, koje može platiti putem sustava. I
          može vidjeti popis svih plaćenih parkirnih kazni i popis svih važećih dnevnih/mjesečnih
          karata.
    Neregistrirani korisnik
      – može vidjeti popis parkirališta i njihovih opisnih podataka.
        </pre>
    </div>
    <div class="well">
        <h2>Opis projektnog rješenja</h2>
        <pre>
            Projektno rješenje ima sve osnovne elemente koji su navedeni osnovnom opisu projektnog zadatka osim
            statistike zaposlenika po zaposleniku, parkiralištu i vlasniku. Što je ova statistika trebala predstavaljat
            nije bilo jasno autoru. Umjesto te statistike, korisniku tipa zaposlenik prikazana je statistika
            prijavljenih kazni za trenutni datum i broj kazni po datumima.
            Dodatno je u riješenje implementirano uređjivanje postavki korisničkog računa poput lozinke ili adrese
            od strane svakog korisnika za svoj račun.
        </pre>
    </div>
    <div class="well">
        <h2>Organizacija programskog koda</h2>
        <pre>
            Rješenje je organizirano na sljedeći način:
            - U <span style="color:blue;">GLAVNOM </span>direktoriju aplikacije nalaze se sve php-datoteke koje se prikazuju korisniku na zaslonu.
              Pošto sve one uključuju istu datoteku za prikaz navigacijskog menija, nisu stavljene
              u zasebne direktorije različite hijerahijske pozicije.
            - U poddirektoriju <span style="color:blue;">CONTROLER</span> nalaze se php datoteke koje bi trebale predstavljati backend dio aplikacije.
              One vrše provjeru podataka, unose i dohvaćanja iz baze za neke od datoteka u glavnom direktoriju.
              Ali neke od datoteka u glavnom direktoriju komunikaciju s bazom i unos izvršavaju same unutar sebe
             pa su istovremeno i front-end i backend ($_SERVER['PHP_SELF'])
            - U poddirektoriju <span style="color:blue;">CSS</span> nalaze se datoteke CSS stilskih uputa. Većina njih su dio Bootstrap paketa,
              a datoteka custom.css sadrži izmjenjene elemente od strane autora.
            - U poddirektoriju <span style="color:blue;">FONTS </span>fontovi koji su potrebni Bootstrap paketu.
            - U poddirektoriju <span style="color:blue;">IMG</span> su slike koje se prikazuju unutar stranica.
            - direktoriji <span style="color:blue;">JS</span> sadrži JavaScript datoteke potrebne za prikaz Bootstrap dizajna.
            - Unutar <span style="color:blue;">JSON </span> direktorija je json objekt s popisom gradova u RH.
            - Poddirektorij <span style="color:blue;">PRIVATNO</span> sadrži sktriptu korisnici.php koja prikazuje sve korisnike registrirane u sustavu.
              Ta skripta je zaštićena .htaccess autentikacijom.
            - Unutar <span style="color:blue;">SCRIPTS </span> direktorija su sve JavaScript datoteke koje je kreirao sam autor aplikacije i najčešće nose
              isti naziv kao php datoteke u kojima se pozivaju i koriste.
            - Unutar <span style="color:blue;">VIEW</span> direktorija su php datoteke koje se koriste za prikaz header (navigacisjki meni) i footer
              elemenata svih stranica. Ovisno o tipu korisnika prikazuju se različiti gumbovi za pristup drugim
              skriptama.
        </pre>
    </div>
    <div class="well">
        <h2>ERA model</h2>

        <p> Na slici je prikazan ERA model projektnog rješenja.</p>
        <img src="img/slika_era.png" alt="slika era modela"/>

    </div>
    <div class="well">
        <h2>Navigacijski dijagram i opis skripti</h2>

        <p>Na slici je prikazan navigacisjski dijagram projektnog rješenja.</p>
        <img src="img/nav_diagram.png" alt="navigacijski dijagram"/>
    </div>
    <div class="well">
        <h2>Korištene tehnologije i alati</h2>

         <pre>
            Rješenje je ostvareno korištenjem sljedećih tehnologija i jezika:
                - HTML 5 / CSS3
                - JavaScript
                - JQuery
                - Bootstrap
                - DataTables
                - PHP
                - MySQL
                - JSON
                - AJAX
                - XML
        </pre>
    </div>
    <div class="well">
        <h2>Vanjski (tuđi) moduli/biblioteke</h2>
        <pre>
            Pri izradi projektnog rješenja korištene su sljedeće vanjske biblioteke:
            - Bootstrap za uređivanje dizajna sučelja
            - Recaptcha za izbjegavanje automatizirane registacije
            - Blueimp gallery biblioteka za prikaz galerije slika kod detalja kazne

        </pre>
    </div>
    <div class="well">
        <h2>Neodrađeni dijelovi</h2>
        <pre>
            Pri izradi projektnog rješenja nisu implementirani sljedeći elementi:
            - Smarty predlošsi
            - Odabir perioda od-do
            - Grafovi za prikaz statistike
            - Generiranje PDF dokumenata
        </pre>
    </div>
    <div class="well">
        <h2>Problemi/greške u radu</h2>

        <pre>
            - Prilikom neuspješne prijave, gresku ne ispiše odmah već pri pokušaju iduće prijave, zbog primjene modal elementa.
            - Prilikom greške upita nad bazom ne dobije se fina poruka greške, već generirana na engleskom.
        </pre>
    </div>
</div>
<script src="scripts/prijava.js"></script>
<?php
include_once './view/footer.php';
?>
