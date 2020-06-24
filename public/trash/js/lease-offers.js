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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/lease-offers.js":
/*!**************************************!*\
  !*** ./resources/js/lease-offers.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  function priceRange(value) {
    var val = value.split(",");
    var minPrice = val[0];
    var maxPrice = val[1];
    $("#maxPrice").html(maxPrice);
    $("#minPrice").html(minPrice);
  }

  priceRange($('#priceRange').val());
  $('#priceRange').bind('change', function () {
    priceRange($('#priceRange').val());
  });
  var timer;

  function intervalTimer() {
    if (timer) clearInterval(timer);
    timer = setInterval(function () {
      clearInterval(timer);
      submitForm();
    }, 1500);
  }

  function submitForm() {
    $("#filterForm").submit();
  }

  $('#datetimepicker1').change(function () {
    intervalTimer();
  });
  $('#filterForm').change(function () {
    intervalTimer();
  });
  var allRadios = document.getElementById('fuel');
  var booRadio;
  var x = 0;

  for (x = 0; x < allRadios.length; x++) {
    allRadios[x].onclick = function () {
      if (booRadio == this) {
        this.checked = false;
        booRadio = null;
      } else {
        booRadio = this;
      }
    };
  } // store filter for each group


  var buttonFilters = {};
  var buttonFilter; // quick search regex

  var qsRegex; // init Isotope

  var $grid = $('.grid').isotope({
    itemSelector: '.grid-item',
    layoutMode: 'fitRows',
    animationOptions: {
      duration: 750,
      easing: 'easein',
      queue: true
    },
    getSortData: {
      name: '.name',
      symbol: '.symbol',
      number: '.number parseInt',
      category: '[data-category]',
      weight: function weight(itemElem) {
        var weight = $(itemElem).find('.weight').text();
        return parseFloat(weight.replace(/[\(\)]/g, ''));
      }
    },
    filter: function filter() {
      var $this = $(this);
      var searchResult = qsRegex ? $this.text().match(qsRegex) : true;
      var buttonResult = buttonFilter ? $this.is(buttonFilter) : true;
      return searchResult && buttonResult;
    }
  }); // bind filter on radio button click

  $('#filters').on('click', 'input', function () {
    // get filter value from input value
    var $this = $(this);
    var $buttonGroup = $this.parents('.button-group');
    var filterGroup = $buttonGroup.attr('data-filter-group'); // set filter for group

    buttonFilters[filterGroup] = this.value; // combine filters

    buttonFilter = concatValues(buttonFilters); // Isotope arrange

    $grid.isotope();
  }); // change is-checked class on buttons

  $('.button-group').each(function (i, buttonGroup) {
    var $buttonGroup = $(buttonGroup);
    $buttonGroup.on('click', 'button', function () {
      $buttonGroup.find('.is-checked').removeClass('is-checked');
      $(this).addClass('is-checked');
    });
  }); // debounce so filtering doesn't happen every millisecond

  function debounce(fn, threshold) {
    var timeout;
    threshold = threshold || 100;
    return function debounced() {
      clearTimeout(timeout);
      var args = arguments;

      var _this = this;

      function delayed() {
        fn.apply(_this, args);
      }

      timeout = setTimeout(delayed, threshold);
    };
  } // flatten object by concatting values


  function concatValues(obj) {
    var value = '';

    for (var prop in obj) {
      value += obj[prop];
    }

    return value;
  }

  if ($('.checkboxes li').length) {
    var boxes = $('.checkboxes li');
    boxes.each(function () {
      var box = $(this);
      box.on('click', function () {
        if (box.hasClass('active')) {
          box.find('i').removeClass('fa-square');
          box.find('i').addClass('fa-square-o');
          box.toggleClass('active');
        } else {
          box.find('i').removeClass('fa-square-o');
          box.find('i').addClass('fa-square');
          box.toggleClass('active');
        } // box.toggleClass('active');

      });
    });

    if ($('.show_more').length) {
      $('.show_more').on('click', function (e) {
        var checkboxes = $('.checkboxes#' + this.getAttribute('data-id'));
        var checkboxesActive = $('.checkboxes.active#' + this.getAttribute('data-id'));
        var contentName = $(this);

        if (checkboxesActive.length >= 1) {
          contentName.html('<b><span>+</span> laat meer zien</b>');
        } else {
          contentName.html('<b><span>-</span> laat minder zien</b>');
        }

        checkboxes.toggleClass('active');
      });
    }
  }

  ;
});

/***/ }),

/***/ 4:
/*!********************************************!*\
  !*** multi ./resources/js/lease-offers.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Projects\leaseofferte.dev\resources\js\lease-offers.js */"./resources/js/lease-offers.js");


/***/ })

/******/ });