/**
 * Created by Prima on 09.06.14..
 */
$(document).ready(function () {
    registracijaAutocomplete();
    parkingAutocomplete();
});


function registracijaAutocomplete() {

    var oznake = $("#oznake");
    var parking = document.getElementById("zap_parking").innerHTML;

 console.log(parking);

    $.ajax({
        type: "POST",
        url: "./controler/json_kreator.php",
        dataType: "json",
        data: {'reg': parking},
        success: function (data) {
            $.each(data, function (key, val) {
                oznake.append($("<option />").val(val).text(val));
            });
            console.log("dohvaćen je popis parkiralista");


        },
        error: function (data) {
            console.log("greška u dohvaćanju podataka");
        }
    });
}


function parkingAutocomplete() {
    //var parkiralista = new Array();
    var parking =$("#parking");

    $.ajax({
        type: "POST",
        url: "./controler/json_kreator.php",
        dataType: "json",
        data: {'park': 'park'},
        success: function (data) {
            $.each(data, function (key, val) {
                parking.append($("<option />").val(val).text(val));
            });
            console.log("dohvaćen je popis parkiralista");

            //$("#parking").autocomplete({source: parkiralista});

        },
        error: function (data) {
            console.log("greška u dohvaćanju podataka");
        }
    });
}

function triSlike(){
    if (document.getElementById("slika1").value == "" ||
        document.getElementById("slika2").value == "" ||
        document.getElementById("slika3").value == ""
        ){
        document.getElementById("greska_zadnja").innerHTML = "Nisu odabrane prve tri slike, učitajte bar njih.";
        return false;
    }
    else
    {
        document.getElementById("greska_zadnja").innerHTML = "";
        return true;
    }
}

function addListeners() {


    document.getElementById("prijavi").addEventListener("click", function (evt) {
        if (!triSlike())
            evt.preventDefault();
    }, false);
}

window.onload = addListeners;

/*
 function registracijaAutocomplete() {
 var registracije = new Array();

 $.ajax({
 type: "POST",
 url: "./controler/json_kreator.php",
 dataType: "json",
 data: {'reg': 'reg'},
 success: function(data) {
 $.each(data, function(key, val) {
 registracije.push(val);
 });
 console.log("dohvaćen je popis parkiralista");

 $("#registracijske_oznake").autocomplete({source: parkiralista});

 },
 error: function(data) {
 console.log("greška u dohvaćanju podataka");
 }
 });
 }

 */
