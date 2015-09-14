/**
 * Created by Prima on 08.06.14..
 */
$(document).ready(function() {

    provjeriEmail();

});

function provjeriEmail() {


    $("#email").focusout(function(event) {
        var KorEmail = $("#email").val();

        console.log("Vrijednost korisnickog unosa: " + KorEmail);



            $.ajax({
                type: "POST",
                url: "./controler/json_kreator.php",
                datatype: "json",
                data: {'email': KorEmail},
                success: function(data) {

                    var data = $.parseJSON(data);
                    console.log(data);

                    var zauzeto = 0;

                    jQuery.each(data, function(i, val) {
                        if(val==1) zauzeto=1;
                        console.log(val)
                    });


                    if (zauzeto == 0) {

                        document.getElementById("zauzeto_email").innerHTML = "Ne postoji korisnik s unesenom e-mail adresom.";
                        $("#email").effect("highlight", {color: "#ffff99"}, 3000);
                        $("#email").focus();
                        $("#email_ikona").removeClass("glyphicon-ok");
                        $("#email_ikona").addClass("glyphicon-remove");
                        $("#email_ikona").css("color", "#FF0004");
                    }
                    else {
                        document.getElementById("zauzeto_email").innerHTML = "";
                        $("#email_ikona").addClass("glyphicon-ok");
                        $("#email_ikona").removeClass("glyphicon-remove");
                        $("#email_ikona").css("color", "#00A41E");
                    }


                },
                error: function(data) {
                    console.log("doslo je do pogreske");
                }

            });

    });
}
