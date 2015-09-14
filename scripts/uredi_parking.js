/**
 * Created by Prima on 10.06.14..
 */

$(document).ready(function () {
    cijenaAutocomplete();
    vrijemeAutocomplete();
});

function cijenaAutocomplete() {

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

function vrijemeAutocomplete() {

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

