/**
 * Created by Prima on 10.06.14..
 */

$(document).ready(function () {
    korImeAutocomplete();
    parkingAutocomplete();
});

function korImeAutocomplete() {

    var korisnicko_ime =$("#korisnicko_ime");

    $.ajax({
        type: "POST",
        url: "./controler/json_kreator.php",
        dataType: "json",
        data: {'bud_zap': 'bud_zap'},
        success: function (data) {
            $.each(data, function (key, val) {
                korisnicko_ime.append($("<option />").val(val).text(val));
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