<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 27.05.14.
 * Time: 18:11
 */
include_once './view/header.php';
?>
    <div class="container">

        <div class="jumbotron">
            <h1>Dobrodošli na E-parking</h1>
            <p>Web mjesto najboljih parkirnih mjesta u gradu i okolici</p>
            <p><a href="registracija.php"class="btn btn-primary btn-lg">Registriraj se</a></p>
        </div>
    </div>
    <div class="container">
        <div class="row">

            <div class=" col-md-4">
                <div class="thumbnail">
                    <a href="popis_parkinga.php"></a><img src="img/samples/prazan.jpg" height="200" width="300" alt="slika popis parkirališta"></a>
                    <div class="caption">
                        <h3>Popis parkirališta</h3>
                        <p class="text-justify">Pogledajte popis svih parkirališta dostupnih preko ovog sustava.</p>
                        <p ><a href="popis_parkinga.php" class="btn btn-info" role="button">Više</a>
                    </div>
                </div>
            </div>


            <div class=" col-md-4">
                <div class="thumbnail">
                    <img src="img/samples/kupi.jpg" height="200" width="300" alt="Slika primjera karte">
                    <div class="caption">
                        <h3>Kupite karte</h3>
                        <p class="text-justify">Pomoću ovog sustava možete brzo i jednostavno kupovati dnevne ili mjesečne karte za pojedina parkirališta. Sve što trebate učiniti je obaviti registraciju.</p>

                    </div>
                </div>
            </div>


            <div class=" col-md-4">
                <div class="thumbnail">
                    <img src="img/samples/kazna.jpg" height="200" width="300" alt="Slika primjera karte">
                    <div class="caption">
                        <h3>Platite kazne</h3>
                        <p class="text-justify">Zahvaljujući evidenciji svih kazni na našim parkiralištima, pomoću ovog sustava možete jednostavno plaćati svoje kazne. Možete provjeriti sve neplaćene kazne, izvšiti uplatu i provjeriti statistiku vlastitih kazni. Da bi ste izbjegli kazne, na vrijeme kupite karte pomoću našeg sustava.</p>

                    </div>
                </div>
            </div>
        </div>

    </div>

<script src = "scripts/prijava.js"></script>
<?php
include_once './view/footer.php';
?>
