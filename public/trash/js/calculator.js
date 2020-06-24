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

/***/ "./resources/js/calculator.js":
/*!************************************!*\
  !*** ./resources/js/calculator.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

setInterval(keepTokenAlive, 1000 * 60 * 1); // every 15 mins

function keepTokenAlive() {
  $.ajax({
    url: '/refresh-csrf',
    method: 'post',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }).then(function (res) {
    $('meta[name="csrf-token"]').attr('content', res);
  });
}

calculation();

function calculation() {
  var aanschaf = parseFloat($("#aanschaf").val());
  var aanbetaling = parseFloat($("#aanbetaling").val());
  var slottermijn = parseFloat($("#slottermijn").val());
  var looptijd = parseFloat($("#looptijd").val().substr(0, 2));
  var obj = $('#object option:selected').val();

  if (!$("#aanbetaling").val()) {
    aanbetaling = 0;
  }

  if (!$("#slottermijn").val()) {
    slottermijn = 0;
  }

  var total = aanschaf - aanbetaling - slottermijn;

  if ((total || total === 0) && (obj || obj === 0) && (looptijd || looptijd === 0)) {
    $.ajax({
      url: "/api/calculator-rates-" + obj + "?aanschaf=" + aanschaf + "&aanbetaling=" + aanbetaling + "&slottermijn=" + slottermijn + "&looptijd=" + looptijd,
      type: 'GET',
      dataType: 'json',
      // added data type
      success: function success(res) {
        $(".leasePrice").html("&euro; " + res['leasePrice']);
      }
    });
  }
}

$('.form-control').on('change keyup paste', function () {
  calculation();
});
$(".moneyFormat").inputmask({
  radixPoint: ",",
  // mask: "99999999",
  clearMaskOnLostFocus: "false",
  autoUnmask: true,
  unmaskAsNumber: true,
  alias: "currency",
  // groupSeparator:".",
  // autoGroup:true,
  // digits:2,
  // integerDigits: 8,
  prefix: "\u20AC ",
  rightAlign: false,
  removeMaskOnSubmit: true,
  clearIncomplete: true
});
$('.scrollTo').click(function () {
  var sectionTo = $(this).attr('href');
  $('html, body').animate({
    scrollTop: $(sectionTo).offset().top
  }, 1500);
});

/***/ }),

/***/ 3:
/*!******************************************!*\
  !*** multi ./resources/js/calculator.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Projects\leaseofferte.dev\resources\js\calculator.js */"./resources/js/calculator.js");


/***/ })

/******/ });