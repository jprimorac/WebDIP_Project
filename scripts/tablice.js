/**
 * Created by Prima on 31.05.14..
 */


    $(document).ready(function() {
        $(document).on('click','.select-table',function(){
            var naziv=$(this).data('tablica');
            $.ajax({
                type: "GET",
                url: "./controler/dohvati_tablicu.php",
                dataType: "html",   //expect html to be} returned
                data:{
                    tablica:naziv
                },
                success: function(response){
                    $("#responsecontainer").html(response);
                    console.log(naziv);
                }

            });
        });


    });

