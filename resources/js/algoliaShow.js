$( document ).ready(function() {
    var places = require('places.js');
    var placesAutocomplete = places({
        appId: 'pl0MC3PGQDCZ',
        apiKey: 'd2e56071abd2939d263fd7c896b7fadc',
        container: document.querySelector('#input-map')
    });

    var map = L.map('map-show', {
    scrollWheelZoom: true,
    zoomControl: true
  });



  var osmLayer = new L.TileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      minZoom: 1,
      maxZoom: 13,
      attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
    }
  );

  // var tessera = L.marker([45.505278, 12.351944]).addTo('mapid');
  var markers = [];
  var puntatori = [];


  var lat = $('#lat-show').val();
  var long = $('#long-show').val();
  console.log(lat);
  console.log(long);

  map.setView(new L.LatLng(lat, long), 10);
  map.addLayer(osmLayer);
  var posizione = L.marker([lat, long]).addTo(map);

  placesAutocomplete.on('suggestions', handleOnSuggestions);
  placesAutocomplete.on('cursorchanged', handleOnCursorchanged);
  placesAutocomplete.on('change', handleOnChange);
  placesAutocomplete.on('clear', handleOnClear);

  function handleOnSuggestions(e) {
    markers.forEach(removeMarker);
    markers = [];

    if (e.suggestions.length === 0) {
      map.setView(new L.LatLng(0, 0), 1);
      return;
    }

    e.suggestions.forEach(addMarker);
    findBestZoom();
  }

  function handleOnChange(e) {
    markers
      .forEach(function(marker, markerIndex) {
        if (markerIndex === e.suggestionIndex) {
          markers = [marker];
          marker.setOpacity(1);
          findBestZoom();
        } else {
          removeMarker(marker);
        }
      });
  }

  function handleOnClear() {
    map.setView(new L.LatLng(0, 0), 1);
    markers.forEach(removeMarker);
  }

  function handleOnCursorchanged(e) {
    markers
      .forEach(function(marker, markerIndex) {
        if (markerIndex === e.suggestionIndex) {
          marker.setOpacity(1);
          marker.setZIndexOffset(1000);
        } else {
          marker.setZIndexOffset(0);
          marker.setOpacity(0.5);
        }
      });
  }

  function addMarker(suggestion) {
    var marker = L.marker(suggestion.latlng, {opacity: .4});
    marker.addTo(map);
    markers.push(marker);
  }

  function removeMarker(marker) {
    map.removeLayer(marker);
  }

  function findBestZoom() {
    var featureGroup = L.featureGroup(markers);
    map.fitBounds(featureGroup.getBounds().pad(0.5), {animate: false});
  }

  $('#input-map').change(function() {
        var posizione = $('#input-map').val();
        var mark = markers[0];
        var lat = mark._latlng.lat;
        var long = mark._latlng.lng;
        $('#lat').val(lat);
        $('#long').val(long);
});


$('#input-map').on('keyup', function (event) {
    if (event.key == 'Enter') {
        var posizione = $('#input-map').val();
        var mark = markers[0];
        var lat = mark._latlng.lat;
        var long = mark._latlng.lng;
        $('#lat').val(lat);
        $('#long').val(long);
    }
});

    console.log($('#lat').val());
    console.log($('#long').val());

});
