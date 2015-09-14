<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 03.06.14.
 * Time: 01:19
 */
$id = $_SESSION["ID"];

$vlasnik_meni = "<a href = \"./vlasnik.php\" class = \"navbar-brand\"><img src=\"./img/logo.png\" height=\"50\" width=\"50\">E-parking</a>


            <button class = \"navbar-toggle\" data-toggle = \"collapse\" data-target = \".navHeaderCollapse\">
                <span class = \"icon-bar\"></span>
                <span class = \"icon-bar\"></span>
                <span class = \"icon-bar\"></span>
            </button>

            <div class = \"collapse navbar-collapse navHeaderCollapse\">

            <ul class = \"nav navbar-nav navbar-right\">

                <li><a href = \"./vlasnik.php\">Naslovna</a></li>

                <li><a href = \"./popis_parkinga.php\">Popis parkirališta</a></li>

                <li><a href = \"./popis_kazni.php\">Sve kazne</a></li>

                <li class = \"dropdown\">

                    <a href = \"#\" class = \"dropdown-toggle\" data-toggle = \"dropdown\">Karte<b class = \"caret\"></b></a>
                    <ul class = \"dropdown-menu\">
                        <li><a href = \"./nova_karta.php\">Kupi kartu</a></li>
                        <li><a href = \"./popis_karti.php\">Sve karte (povijest)</a></li>
                    </ul>

                </li>

                <li class = \"dropdown\">

                    <a href = \"#\" class = \"dropdown-toggle\" data-toggle = \"dropdown\">Račun<b class = \"caret\"></b></a>
                    <ul class = \"dropdown-menu\">
                        <li><a href = \"./postavke_racuna.php\">Postavke</a></li>
                        <li><a href = \"./controler/odjava.php\">Odjava</a></li>
                    </ul>

                </li>


            </ul>

        </div>";