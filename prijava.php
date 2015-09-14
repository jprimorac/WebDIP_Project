<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 30.05.14.
 * Time: 01:28
 */


include_once('./controler/baza.class.php');
include_once('./controler/login.class.php');

if(isset($_POST['prijava'])){
    $korIme = $_POST['korIme'];
    $lozinka = $_POST['lozinkaP'];


    $korisnik = Login::autentikacija($korIme,$lozinka);

        if($korisnik==1 || $korisnik==2|| $korisnik==3){
            if(isset($_POST['zapamti'])){
                Login::kreirajCookie($korIme);
            }
        }


        if ($korisnik==1) {
            header("Location: administrator.php");
        }
        elseif ($korisnik==2) {
            header("Location: zaposlenik.php");
        }
        elseif ($korisnik==3) {
            header("Location: vlasnik.php");
        }

        else if($korisnik==-1){
        //$greska = "Nepostoji korisnik ili neispravna lozinka";
        $greska="Vaš korisnički račun je zaključan. Kontaktirajte administratora!";
        }
        else if($korisnik==-0){
            //$greska = "Nepostoji korisnik ili neispravna lozinka";
            $greska="Unijeli ste neispravnu lozinku. Pokušajte ponovo";
        }
        else
             header("Location: greske.php");
}
?>


<div class = "modal fade" id = "contact" role = "dialog">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <form class = "form-horizontal" id="prijava" name="prijava" action="<?PHP echo $_SERVER['PHP_SELF'] ?>"
                  method="POST">
                <div class = "modal-header">
                    <h4>Prijava</h4>
                </div>
                <div class = "modal-body">

                    <div class="form-group">
                        <label for="korIme" class = "col-lg-3 control-label">Korisnicko ime</label>
                        <div class = "col-lg-9">
                            <input type="text" class="form-control" id="korIme" name="korIme" placeholder="Korisnicko ime" value="<? echo $_COOKIE['Projekt_071_korisnik'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lozinkaP" class = "col-lg-3 control-label">Lozinka</label>
                        <div class = "col-lg-9">
                            <input type="password" class="form-control" id="lozinkaP" name="lozinkaP" placeholder="Lozinka">
                            <p class="help-block" style="color: red;" id="poruka_greske"> <?php echo $greska ?> </p>
                        </div>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="zapamti" name="zapamti" value="true"> Zapamti me
                        </label>
                    </div>
                    <div>
                        <p><a href="zab_lozinka.php">Zaboravili ste lozinku?</a></p>
                    </div>
                </div>
                <div class = "modal-footer">
                    <a class = "btn btn-default" data-dismiss = "modal">Zatvori</a>
                    <button class = "btn btn-primary" type = "submit" name="prijava" id="prijava">Prijavi me</button>
                </div>
            </form>
        </div>
    </div>
</div>

