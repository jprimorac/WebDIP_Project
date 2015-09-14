<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 01.06.14.
 * Time: 01:21
 */
include_once './view/header.php';
include_once './controler/zaposlenik_podaci.php';

?>

<div class="container">

    <div class="col-sm-6 col-md-4">
        <?php Zaposlenik::danasnjeKazne(); ?>
    </div>

    <div class="col-sm-6 col-md-4">
        <?php Zaposlenik::brojKazniDnevno(); ?>
    </div>

    <div class="col-sm-6 col-md-4">
        <h2><strong>Dodaj kaznu</strong></h2>
        <p>Pritiskom na gumb "Dodaj" dodajte novu kaznu za vozilo na vama dodjeljenom parkiralištu. Ukoliko tog vozila nema u padajućem izborniku, vozilo ima važeću kartu.</p>
        <a href="nova_kazna.php" class ="btn-warning btn">Dodaj</a>
    </div>

<?php
include_once './view/footer.php';
?>
