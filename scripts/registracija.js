/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {


    gradAutocomplete();
    provjeriKorisnika();
    provjeriEmail();
    punaPolja();
    provjeriLozinku();


});

function gradAutocomplete() {
    var gradovi = new Array();

    $.ajax({
        type: "POST",
        url: "./json/gradovi.json",
        dataType: "json",
        success: function (data) {
            $.each(data, function (key, val) {
                gradovi.push(val);
            });
            console.log("dohvaćen je popis gradova");

            $("#grad").autocomplete({source: gradovi});

        },
        error: function (data) {
            console.log("greška u dohvaćanju podataka");
        }
    });
}

function provjeriLozinku() {
    if (document.getElementById("lozinka1").value == document.getElementById("lozinka2").value) {

        return true;
    }
    else{

        return false;
    }
}



function provjeriKorisnika() {
    //$("#korisnicko_ime").focusout(function (event) {

        var korIme = $("#korisnicko_ime").val();


        $.ajax({
            type: "POST",
            url: "./controler/json_kreator.php",
            datatype: "json",
            data: {'korisnik': korIme},
            success: function (data) {

                var data = $.parseJSON(data);
                console.log(data);

                var zauzeto = 0;

                jQuery.each(data, function (i, val) {
                    if (val == 1) zauzeto = 1;
                });


                if (zauzeto == 1) {

                    document.getElementById("zauzeto_ime").innerHTML = "Zauzeto korisničko ime";
                    $("#korisnicko_ime").effect("highlight", {color: "#ffff99"}, 3000);
                    $("#korisnicko_ime").focus();
                    $("#ime_ikona").removeClass("glyphicon-ok");
                    $("#ime_ikona").addClass("glyphicon-remove");
                    $("#ime_ikona").css("color", "#FF0004");
                    mozeK=0;
                    return true;
                }
                else {
                    document.getElementById("zauzeto_ime").innerHTML = "";
                    $("#ime_ikona").addClass("glyphicon-ok");
                    $("#ime_ikona").removeClass("glyphicon-remove");
                    $("#ime_ikona").css("color", "#00A41E");
                    mozeK=1;
                    return zauzeto;
                }


            },
            error: function (data) {
                console.log("doslo je do pogreske");
            }

        });

    //});
}


function provjeriEmail() {

    //var pattern = "^[a-z0-9.]+@foi.hr$";
        var pattern = "[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}";
   // $("#email").focusout(function (event) {
        var KorEmail = $("#email").val();

        console.log("Vrijednost korisnickog unosa: " + KorEmail);

        if (!KorEmail.match(pattern)) {
            $("#zauzeto_email").html("Email nije pravilno strukuriran!");
            $("#email").effect("highlight", {color: "#ffff99"}, 3000);
            $("#email").focus();
            $("#email_ikona").removeClass("glyphicon-ok");
            $("#email_ikona").addClass("glyphicon-remove");
            $("#email_ikona").css("color", "#FF0004");
            console.log("ne pase pattern");
            mozeM=0;
            return false;


        }
        else {
            $.ajax({
                type: "POST",
                url: "./controler/json_kreator.php",
                datatype: "json",
                data: {'email': KorEmail},
                success: function (data) {

                    var data = $.parseJSON(data);
                    console.log(data);

                    var zauzeto = 0;

                    jQuery.each(data, function (i, val) {
                        if (val == 1) zauzeto = 1;
                        console.log(val)
                    });


                    if (zauzeto == 1) {

                        document.getElementById("zauzeto_email").innerHTML = "Zauzeta email adresa";
                        $("#email").effect("highlight", {color: "#ffff99"}, 3000);
                        $("#email").focus();
                        $("#email_ikona").removeClass("glyphicon-ok");
                        $("#email_ikona").addClass("glyphicon-remove");
                        $("#email_ikona").css("color", "#FF0004");
                        mozeM=0;
                        return zauzeto;
                    }
                    else {
                        document.getElementById("zauzeto_email").innerHTML = "";
                        $("#email_ikona").addClass("glyphicon-ok");
                        $("#email_ikona").removeClass("glyphicon-remove");
                        $("#email_ikona").css("color", "#00A41E");
                        mozeM=1;
                        return zauzeto;
                    }


                },
                error: function (data) {
                    console.log("doslo je do pogreske");
                }

            });
        }
    //});
}

function punaPolja() {
    if (document.getElementById("korisnicko_ime").value == "" ||
        document.getElementById("lozinka1").value == "" ||
        document.getElementById("lozinka2").value == "" ||
        document.getElementById("email").value == "" ||
        document.getElementById("ime").value == "" ||
        document.getElementById("prezime").value == "" ||
        document.getElementById("adresa").value == "" ||
        document.getElementById("grad").value == ""

        ) {
        console.log("nisu puni");
        document.getElementById("greska_zadnja").innerHTML = "Nisu popunjena sva obavezna polja";
        return false;
    }
    else{
        document.getElementById("greska_zadnja").innerHTML = "";
    console.log("Puni");
    return true;
	}
}


function stranicenje() {
    $("#korisnici").dataTable({
        "bSort": true,
        "bPagation": true,
        "bFilter": true
    });
}

function addListeners() {


    var inputi = document.getElementsByTagName("input");
    for (var i = 0; i < inputi.length; i++) {
        inputi[i].addEventListener("blur", punaPolja, false);

    }

    document.getElementById("korisnicko_ime").addEventListener("blur", provjeriKorisnika, false);
    document.getElementById("email").addEventListener("blur", provjeriEmail, false);
    //document.getElementsByTagName('input').addEventListener("blur", punaPolja, false);


    document.getElementById("register").addEventListener("click", function (evt) {
        provjeriKorisnika()
        provjeriEmail()

        if (mozeK==0 || mozeM==0||!punaPolja()|| !provjeriLozinku()){
            evt.preventDefault();
            }
    }, false);
}

window.onload = addListeners;



