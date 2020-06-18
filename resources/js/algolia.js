$( document ).ready(function() {
    var places = require('places.js');
    var placesAutocomplete = places({
        appId: 'pl0MC3PGQDCZ',
        apiKey: 'd2e56071abd2939d263fd7c896b7fadc',
        container: document.querySelector('#input-map')
    });
    var option = {
        // 'aroundRadius' : 20000,
        // 'aroundLatLngViaIP' : false,
        'type' : 'city'
    };
    placesAutocomplete = placesAutocomplete.configure(option);
    $('#input-map').change(function() {
        var posizione = $('#input-map').val();
        var mark = markers[0];
        var lat = mark._latlng.lat;
        var long = mark._latlng.lng;
        $('#lat').val(lat);
        $('#long').val(long);
      });
});
