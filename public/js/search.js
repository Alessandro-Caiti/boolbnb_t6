/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/search.js":
/*!********************************!*\
  !*** ./resources/js/search.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $('#btn-filter').on('click', function () {
    var beds = parseInt($('#beds').val());

    if (Number.isNaN(beds)) {
      beds = 1;
    }

    var rooms = parseInt($('#rooms').val());

    if (Number.isNaN(rooms)) {
      rooms = 1;
    }

    var bathrooms = parseInt($('#bathrooms').val());

    if (Number.isNaN(bathrooms)) {
      bathrooms = 1;
    }

    var km = parseInt($('#km').val());

    if (Number.isNaN(km)) {
      km = 20;
    }

    var amenitiesfilter = [];
    amenitiesfilter = amenityFilter();
    $.ajax({
      url: "http://127.0.0.1:8000/api/placesInRange",
      method: "GET",
      data: {
        lat: $('#places-lat').val(),
        "long": $('#places-long').val()
      },
      success: function success(data) {
        var risultati = data;

        for (var i = 0; i < risultati.length; i++) {
          var amenitiesInPlace = [];
          var risultato = risultati[i];

          if (risultato.distance > km) {
            $('#' + risultato.id).hide();
          }

          if (risultato.info.beds < beds) {
            $('#' + risultato.id).hide();
          }

          if (risultato.info.rooms < rooms) {
            $('#' + risultato.id).hide();
          }

          if (risultato.info.bathrooms < bathrooms) {
            $('#' + risultato.id).hide();
          }

          $('#' + risultato.id).find('.amenities').each(function () {
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
      error: function error() {
        alert("E' avvenuto un errore. ");
      }
    });

    function amenityFilter() {
      // Funzione che crea un array filters inserendo i valori delle checkbox che sono stati cliccati dall'utente
      var filters = [];
      $('.check-amenity').each(function () {
        if ($(this).prop('checked') == true) {
          filters.push(parseInt($(this).val()));
        }
      });
      return filters;
    }

    ;
  });
  $('#btn-clear').on('click', function () {
    $('#beds').val('');
    $('#rooms').val('');
    $('#bathrooms').val('');
    $('#km').val('');
    $('.places').show();
    $('.check-amenity').each(function () {
      $(this).prop('checked', false);
    });
  });
});

/***/ }),

/***/ 3:
/*!**************************************!*\
  !*** multi ./resources/js/search.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\MAMP\htdocs\PHP\boolbnb_t6\resources\js\search.js */"./resources/js/search.js");


/***/ })

/******/ });