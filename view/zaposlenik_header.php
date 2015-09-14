<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 03.06.14.
 * Time: 01:19
 */

$zapos_meni = "<a href = \"./zaposlenik.php\" class = \"navbar-brand\"><img src=\"./img/logo.png\" height=\"50\" width=\"50\">E-parking</a>

        <button class = \"navbar-toggle\" data-toggle = \"collapse\" data-target = \".navHeaderCollapse\">
                <span class = \"icon-bar\"></span>
                <span class = \"icon-bar\"></span>
                <span class = \"icon-bar\"></span>
            </button>

            <div class = \"collapse navbar-collapse navHeaderCollapse\">

            <ul class = \"nav navbar-nav navbar-right\">

                <li><a href = \"./zaposlenik.php\">Naslovna</a></li>


                <li class = \"dropdown\">

                    <a href = \"#\" class = \"dropdown-toggle\" data-toggle = \"dropdown\">Parkirališta<b class = \"caret\"></b></a>
                    <ul class = \"dropdown-menu\">
                        <li><a href = \"./popis_parkinga.php\">Popis parkirališta</a></li>
                        <li><a href = \"./uredi_parking.php\">Uredi parkiralište</a></a></li>

                    </ul>

                </li>

                <li class = \"dropdown\">

                    <a href = \"#\" class = \"dropdown-toggle\" data-toggle = \"dropdown\">Kazne<b class = \"caret\"></b></a>
                    <ul class = \"dropdown-menu\">
                        <li><a href = \"nova_kazna.php\">Nova kazna</a></li>
                        <li><a href = \"popis_kazni.php\">Popis kazni</a></li>
                    </ul>

                </li>


                <li class = \"dropdown\">

                    <a href = \"#\" class = \"dropdown-toggle\" data-toggle = \"dropdown\">Račun<b class = \"caret\"></b></a>
                    <ul class = \"dropdown-menu\">
                        <li><a href = \"postavke_racuna.php\">Postavke</a></li>
                        <li><a href = \"./controler/odjava.php\">Odjava</a></li>
                    </ul>

                </li>


            </ul>

        </div>";