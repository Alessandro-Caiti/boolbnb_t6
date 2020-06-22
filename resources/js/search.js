$(document).ready(function() {

    $('#btn-filter').on('click', function() {
        var beds = $('#beds').val();
        var rooms = $('#rooms').val();
        var bathrooms = $('#bathrooms').val();

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
                    var risultato = risultati[i];
                    console.log(risultato);
                    var context = {
                        summary: risultato.summary,
                        address: risultato.address,
                        price: risultato.price,
                        path: risultato.path
                        }
                    }
                },
            error : function () {
                alert("E' avvenuto un errore. ");
            }
        });
    });
});
