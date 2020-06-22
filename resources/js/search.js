$(document).ready(function() {
    // const Handlebars = require("handlebars");
    var source = $("#places-list-template").html();
    var template = Handlebars.compile(source);




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
                var html = template(context);
                $('#place').append(html);
                }
            },
        error : function () {
            alert("E' avvenuto un errore. ");
        }
    });




});
