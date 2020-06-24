$(document).ready(function() {

    $('#btn-filter').on('click', function() {
        console.log('click collegato');
        var beds = $('#beds').val();
        var rooms = $('#rooms').val();
        var bathrooms = $('#bathrooms').val();
        var km = $('#km').val();
        var amenitiesfilter = [];
        amenitiesfilter= amenityFilter();
        console.log('servizi filtrati '+ amenitiesfilter);
        $.ajax({
            url : "http://127.0.0.1:8000/api/placesInRange",
            method :"GET",
            data : {
                lat: $('#places-lat').val(),
                long: $('#places-long').val()
            },
            success : function (data) {
                var risultati = data;
                for (var i = 0; i < risultati.length; i++) {
                    var amenitiesInPlace = [];
                    var risultato = risultati[i];
                    if (risultato.distance > km) {
                        $('#' + risultato.id).hide();
                    }
                    if (risultato.info.beds < beds ) {
                        $('#' + risultato.id).hide();
                        }
                    if (risultato.info.rooms < rooms ) {
                        $('#' + risultato.id).hide();
                        }
                    if (risultato.info.bathrooms < bathrooms ) {
                        $('#' + risultato.id).hide();
                        }
                    $('#' + risultato.id).find('.amenities').each(function(){
                        var amenity = parseInt($(this).data('amenities'));
                        amenitiesInPlace.push(amenity);
                        });

                        console.log('servizi in casa: ' + amenitiesInPlace);
                    for (var x = 0; x < amenitiesfilter.length; x++) {
                        var check = amenitiesInPlace.includes(amenitiesfilter[x]);
                        if (check === false) {
                            $('#' + risultato.id).hide();
                            }
                        }
                    }
                },
            error : function () {
                alert("E' avvenuto un errore. ");
            }
        });



    function amenityFilter() { // Funzione che crea un array filters inserendo i valori delle checkbox che sono stati cliccati dall'utente
       var filters = [];
       $('.check-amenity').each(function(){
           if ($(this).prop('checked') == true) {
               filters.push(parseInt($(this).val()));
           }
       });
       return filters;
   };
    });


    $('#btn-clear').on('click' , function() {
        $('#beds').val('');
        $('#rooms').val('');
        $('#bathrooms').val('');
        $('#km').val('');
        $('.places').show();
        $('.check-amenity').each(function(){
            $(this).prop('checked',false);
        });
    });
});
