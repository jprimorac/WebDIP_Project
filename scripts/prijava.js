/**
 * Created by Prima on 08.06.14..
 */

$(document).ready(function() {

    samoPostojeciKorIme();


});

function samoPostojeciKorIme() {
    $("#korIme").focusout(function(event) {

        var korIme = $("#korIme").val();


        $.ajax({
            type: "POST",
            url: "./controler/json_kreator.php",
            datatype: "json",
            data: {'korisnik': korIme},
            success: function(data) {

                var data = $.parseJSON(data);
                console.log(data);

                var zauzeto = 0;

                jQuery.each(data, function(i, val) {
                    if(val==1) zauzeto=1;
                });


                if (zauzeto == 0) {

                    document.getElementById("poruka_greske").innerHTML = "Ne postoji korisnik s navedenim korisničkim imenom";
                    $("#korIme").effect("highlight", {color: "#ffff99"}, 3000);
                    $("#korIme").focus();

                }
                else {
                    document.getElementById("poruka_greske").innerHTML = "";

                }


            },
            error: function(data) {
                console.log("doslo je do pogreske");
            }

        });

    });
}



