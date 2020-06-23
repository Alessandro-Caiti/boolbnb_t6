$(document).ready(function() {
    console.log('collegato');
    $('#btn-filter').on('click', function() {
        var beds = $('#beds').val();
        var rooms = $('#rooms').val();
        var bathrooms = $('#bathrooms').val();
        var amenitiesfilter = amenityFilter();
        $.ajax({
            url : "http://127.0.0.1:8000/api/placesInRange",
            method :"GET",
            data : {
                lat: $('#places-lat').val(),
                long: $('#places-long').val()
            },
            success : function (data) {
                var risultati = data;
                var amenitiesInPlace = [];
                for (var i = 0; i < risultati.length; i++) {
                    var risultato = risultati[i];


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
                    console.log('i servizi sono: ' +amenitiesInPlace);

                    for (var x = 0; x < amenitiesfilter.length; x++) {
                        console.log('ameniti filter corrisponde: ' +amenitiesfilter[x]);
                        console.log('ameniti place corrisponde: ' + amenitiesInPlace );
                        var check = amenitiesInPlace.includes(amenitiesfilter[x]);
                        console.log(check);
                        if (check === false) {
                            $('#' + risultato.id).hide();
                        }
                    }

                    // for (var x = 0; x < amenities.length; x++) {
                    //     console.log('amenity filtro: ' + amenities[x]);
                    //     console.log(risultato.amenities);
                    //     console.log('amenity in appartamento: '+ amenitiesPlace);
                    //     var amenitiesPlace = 0;
                    //     var check = amenitiesPlace.includes(amenities[x]);
                    //     console.log('Questo è check: '+ check);
                    //     if (check == false) {
                    //         $('#' + risultato.id).hide();
                    //     }
                    // }

                    // var check = isTrue(risultato.amenities, amenities);
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
});
