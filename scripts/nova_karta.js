/**
 * Created by Prima on 11.06.14..
 */

$(document).ready(function () {
    parkingAutocomplete();

});

$(document).ready(function() {
    if (navigator.userAgent.toLowerCase().indexOf('firefox') != -1) {
    var format = {
        dateFormat:"yy-m-d"
    };
$( "#datum" ).datepicker(format);}
});

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