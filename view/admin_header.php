<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 03.06.14.
 * Time: 01:19
 */
$admin_meni = "<a href = \"./admin.php\" class = \"navbar-brand\"><img src=\"./img/logo.png\" height=\"50\" width=\"50\">E-parking</a>

            <button class = \"navbar-toggle\" data-toggle = \"collapse\" data-target = \".navHeaderCollapse\">
                <span class = \"icon-bar\"></span>
                <span class = \"icon-bar\"></span>
                <span class = \"icon-bar\"></span>
            </button>

            <div class = \"collapse navbar-collapse navHeaderCollapse\">


            <ul class = \"nav navbar-nav navbar-right\">

                <li><a href = \"./administrator.php\">Naslovna</a></li>
                <li><a href = \"./tablice.php\">CRUD Tablice</a></li>

                <li class = \"dropdown\">

                    <a href = \"#\" class = \"dropdown-toggle\" data-toggle = \"dropdown\">Parkirališta<b class = \"caret\"></b></a>
                    <ul class = \"dropdown-menu\">
                        <li><a href = \"./popis_parkinga.php\">Popis parkirališta</a></li>
                        <li><a href = \"./kreiraj_parkiraliste.php\">Kreiraj novo parkiralište</a></li>
                        <li><a href = \"./zap_po_parking.php\">Zaposlenici na parkiralištu</a></li>

                    </ul>

                </li>

                <li class = \"dropdown\">

                    <a href = \"#\" class = \"dropdown-toggle\" data-toggle = \"dropdown\">Korisnici<b class = \"caret\"></b></a>
                    <ul class = \"dropdown-menu\">
                        <li><a href = \"otkljucaj_korisnike.php\">Popis korisnika</a></li>
                        <li><a href = \"dodaj_zaposlenika.php\">Dodaj zaposlenika</a></li>
                        <li><a href = \"./privatno/korisnici.php\">Popis korisnika (privatno)</a></li>
                        <li><a href = \"svima_mail.php\">Mail svim korisnicima</a></li>
                    </ul>

                </li>

                <li><a href = \"./dnevnik_rada_prikaz.php\">Dnevnik rada</a></li>

                <li class = \"dropdown\">

                    <a href = \"#\" class = \"dropdown-toggle\" data-toggle = \"dropdown\">Račun<b class = \"caret\"></b></a>
                    <ul class = \"dropdown-menu\">
                        <li><a href = \"postavke_racuna.php\">Postavke</a></li>
                        <li><a href = \"./controler/odjava.php\">Odjava</a></li>
                    </ul>

                </li>


            </ul></div>";