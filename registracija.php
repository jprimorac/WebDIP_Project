<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 27.05.14.
 * Time: 18:13
 */

require_once('./controler/recaptchalib.php');

include_once './view/header.php';

?>

<div class="container">
    <div >
    <h1>Registracija</h1>
</div>

    <div class="col-md-9" role="main">
        <div class="forma_okvir">
            <form role="form" name="registracija" id="registracija" accept-charset="utf-8"
                  action="controler/reg_backend.php"
                  method="POST">
                <div class="form-group has-success has-feedback">
                    <label for="korisnicko_ime">Korisničko ime*</label>
                    <input type="text" class="form-control" id="korisnicko_ime" name="korisnicko_ime" placeholder="Unesi korisničko ime">
                    <span  id="ime_ikona" class="glyphicon form-control-feedback"></span>
                    <div class="col-sm-12">
                        <span id="zauzeto_ime" style="color: red;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="lozinka1">Lozinka*</label>
                    <input type="password" class="form-control" id="lozinka1" name="lozinka1" placeholder="Unesi lozinka">

                    <div class="row">
                        <div class="col-sm-6">
                            <span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Barem 8 znakova duga<br>
                            <span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Jedno veliko slovo
                        </div>
                        <div class="col-sm-6">
                            <span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Jedno malo slovo<br>
                            <span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Jedan broj
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lozinka2">Ponovi lozinku*</label>
                    <input type="password" class="form-control" id="lozinka2" name="lozinka2" placeholder="Ponovi lozinku">
                    <div class="row">
                        <div class="col-sm-12">
                            <span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Lozinke se podudaraju
                        </div>
                    </div>
                </div>
                <div class="form-group has-success has-feedback">
                    <label for="email">Email*</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Unesi email">
                    <span class="glyphicon form-control-feedback" id="email_ikona"></span>
                    <div class="col-sm-12">
                        <span id="zauzeto_email" style="color: red;"></span>
                    </div>
                </div>
                <div class="form-group has-success has-feedback">
                    <label for="ime">Ime*</label>
                    <input type="text" class="form-control" id="ime" name="ime" placeholder="Unesi svoje ime">
                    <span class="glyphicon form-control-feedback"></span>
                </div>
                <div class="form-group has-success has-feedback">
                    <label for="prezime">Prezime*</label>
                    <input type="text" class="form-control" id="prezime" name="prezime" placeholder="Unesi prezime">
                </div>
                <div class="form-group">
                    <label for="adresa">Adresa*</label>
                    <input type="text" class="form-control" id="adresa" name="adresa" placeholder="Unesi korisničko ime">
                </div>
                <div class="form-group">
                    <label for="grad">Grad*</label>
                    <input type="text" class="form-control" id="grad" name="grad" placeholder="Unesi korisničko ime">
                </div>
                <div class="form-group">
                    <label for="telefon">Telefon</label>
                    <input type="text" class="form-control" id="telefon" name="telefon" placeholder="Unesi broj telefona">
                </div>
                <p><h3>Podaci o vozilu</h3></p>

                <div class="form-group">
                    <label for="oznake">Registracijske oznake</label>
                    <input type="text" class="form-control" id="oznake" name="oznake" placeholder="Unesi registracijske oznake">
                </div>
                <div class="form-group">
                    <label for="marka">Marka</label>
                    <input type="text" class="form-control" id="marka" name="marka" placeholder="Unesi marku vozila">
                </div>
                <div class="form-group">
                    <label for="model"">Model</label>
                    <input type="text" class="form-control" id="model" name="model" placeholder="Unesi model vozila">
                </div>

                <fieldset form="forma">
                    <?php
                    $publickey = "6LfPG_MSAAAAADPUT_R0F8ZJOv0wGag-nsfZ71kn";
                    echo recaptcha_get_html($publickey);
                    echo $captcha_greska;
                    ?>

                </fieldset>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="uvjeti" name="uvjeti"> Pročitao sam i prihvaćam uvjete upotrebe aplikacije (terms and conditions)
                    </label>
                </div>


                <button type="submit" name="register" id="register" class="btn btn-primary">Registriraj</button>
                <button type="reset" class="btn btn-warning">Resetiraj</button>
                <p id="greska_zadnja" style="color: red;"></p>
            </form>
        </div>
    </div>
</div>

<script src = "scripts/form_valid.js"></script>
<script src = "scripts/registracija.js"></script>
<script src = "scripts/prijava.js"></script>

<?php
include_once './view/footer.php';
?>

