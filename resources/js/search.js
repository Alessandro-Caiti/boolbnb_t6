$(document).ready(function() {

    $('#btn-filter').on('click', function() {
        var beds = parseInt($('#beds').val());
        if(Number.isNaN(beds)) {
            beds= 1;
        }
        var rooms = parseInt($('#rooms').val());
        if(Number.isNaN(rooms)) {
            rooms= 1;
        }
        var bathrooms = parseInt($('#bathrooms').val());
        if(Number.isNaN(bathrooms)) {
            bathrooms= 1;
        }
        var km = parseInt($('#km').val());
        if(Number.isNaN(km)) {
            km= 20;
        }
        var amenitiesfilter = [];
        amenitiesfilter= amenityFilter();
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
                        console.log(amenitiesfilter);
                        if (amenitiesfilter.length > 0) {
                            for (var x = 0; x < amenitiesfilter.length; x++) {
                                var check = amenitiesInPlace.includes(amenitiesfilter[x]);
                                console.log(risultato.id + ' ' + check);
                                if (check == false) {
                                    $('#' + risultato.id).hide();
                                    console.log(risultato.id + ' nascosto');
                                }
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
