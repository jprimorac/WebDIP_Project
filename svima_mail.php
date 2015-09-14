<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 08.06.14.
 * Time: 23:18
 */
include_once './view/header.php';

include_once './controler/baza.class.php';

if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}
if ($_SESSION["TIP"]!=1) {
    header("Location: greske.php?id_greske=13");
    exit();
}

if(isset($_POST['posalji'])){
    $baza = new Baza();


    $upit = "select email from korisnik";
    $rezultat = $baza->selectDB($upit);

    while($red = $rezultat->fetch_row()){

        $email = $red[0];
        $primatelj = $email;
        $naslov = $_POST['naslov'];
        $poruka = $_POST['sadrzaj'];
        mail($primatelj, $naslov, $poruka);
    }

    header("Location: administrator.php");
}

?>
<div class="container">
    <form class = "form-horizontal" id="svima_mail" name="svima_mail" action="<?PHP echo $_SERVER['PHP_SELF'] ?>"
          method="POST">

            <h4>Pošaljite mail svim korisnicima sustava</h4>



            <div class="form-group">
                <label for="naslov" class = "col-lg-1 control-label">Naslov</label>
                <div class = "col-lg-9">
                    <input type="text" class="form-control" id="naslov" name="naslov" placeholder="Naslov poruke">
                </div>
            </div>
            <div class="form-group">
                <label for="sadrzaj" class = "col-lg-1 control-label">Sadržaj</label>
                <div class = "col-lg-9">
                    <textarea  form="svima_mail" class="form-control" name="sadrzaj" id="sadrzaj" cols="50" rows="10" maxlength="1000" placeholder="Maksimalno 1 000 znakova."></textarea>
                </div>
            </div>


            <button class = "btn btn-primary" type = "submit" name="posalji" id="posalji">Posalji</button>

    </form>
</div>

<?php
include_once './view/footer.php';
?>