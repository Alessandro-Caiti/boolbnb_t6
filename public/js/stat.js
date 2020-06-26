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
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/stat.js":
/*!******************************!*\
  !*** ./resources/js/stat.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  console.log('collegato');
  var idPlace = $('#place-id').val();
  var mesi = moment.months();
  $.ajax({
    url: "http://127.0.0.1:8000/api/getData?id=" + idPlace,
    method: "GET",
    success: function success(data) {
      var risultati = data;
      var dataMonths = costruttoreDatiMesi(risultati); // var visualTotali = dataMonths.reduce(myFunc);

      myGraph(mesi, dataMonths);

      function costruttoreDatiMesi(array) {
        var rawObj = {};
        var datoCompleto = [];

        for (var x = 0; x < 12; x++) {
          if (rawObj[x] === undefined) {
            rawObj[x] = 0;
          }
        }

        for (var i = 0; i < array.length; i++) {
          var visita = array[i];
          var giorno = visita.created_at;
          var mese = moment(giorno, "DD-MM-YYYY").clone().month();
          rawObj[mese] += 1;
        }

        for (var key in rawObj) {
          datoCompleto.push(rawObj[key]);
        }

        return datoCompleto;
      }

      ;

      function myGraph(mesi, views) {
        var ctx = $('#myChart');
        var chart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: mesi,
            datasets: [{
              label: 'Visite mensili',
              backgroundColor: 'lightblue',
              borderColor: 'blue',
              lineTension: 0.5,
              data: views
            }]
          }
        });
      }

      function myFunc(total, num) {
        return total + num;
      }
    },
    error: function error() {
      alert("E' avvenuto un errore. ");
    }
  });
});

/***/ }),

/***/ 6:
/*!************************************!*\
  !*** multi ./resources/js/stat.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\MAMP\htdocs\PHP\boolbnb_t6\resources\js\stat.js */"./resources/js/stat.js");


/***/ })

/******/ });