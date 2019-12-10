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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 112);
/******/ })
/************************************************************************/
/******/ ({

/***/ 112:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(113);


/***/ }),

/***/ 113:
/***/ (function(module, exports) {

/******/(function (modules) {
    // webpackBootstrap
    /******/ // The module cache
    /******/var installedModules = {};
    /******/
    /******/ // The require function
    /******/function __webpack_require__(moduleId) {
        /******/
        /******/ // Check if module is in cache
        /******/if (installedModules[moduleId]) {
            /******/return installedModules[moduleId].exports;
            /******/
        }
        /******/ // Create a new module (and put it into the cache)
        /******/var module = installedModules[moduleId] = {
            /******/i: moduleId,
            /******/l: false,
            /******/exports: {}
            /******/ };
        /******/
        /******/ // Execute the module function
        /******/modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
        /******/
        /******/ // Flag the module as loaded
        /******/module.l = true;
        /******/
        /******/ // Return the exports of the module
        /******/return module.exports;
        /******/
    }
    /******/
    /******/
    /******/ // expose the modules object (__webpack_modules__)
    /******/__webpack_require__.m = modules;
    /******/
    /******/ // expose the module cache
    /******/__webpack_require__.c = installedModules;
    /******/
    /******/ // define getter function for harmony exports
    /******/__webpack_require__.d = function (exports, name, getter) {
        /******/if (!__webpack_require__.o(exports, name)) {
            /******/Object.defineProperty(exports, name, {
                /******/configurable: false,
                /******/enumerable: true,
                /******/get: getter
                /******/ });
            /******/
        }
        /******/
    };
    /******/
    /******/ // getDefaultExport function for compatibility with non-harmony modules
    /******/__webpack_require__.n = function (module) {
        /******/var getter = module && module.__esModule ?
        /******/function getDefault() {
            return module['default'];
        } :
        /******/function getModuleExports() {
            return module;
        };
        /******/__webpack_require__.d(getter, 'a', getter);
        /******/return getter;
        /******/
    };
    /******/
    /******/ // Object.prototype.hasOwnProperty.call
    /******/__webpack_require__.o = function (object, property) {
        return Object.prototype.hasOwnProperty.call(object, property);
    };
    /******/
    /******/ // __webpack_public_path__
    /******/__webpack_require__.p = "/";
    /******/
    /******/ // Load entry module and return exports
    /******/return __webpack_require__(__webpack_require__.s = 112);
    /******/
})(
/************************************************************************/
/******/{

    /***/112:
    /***/function _(module, exports, __webpack_require__) {

        module.exports = __webpack_require__(113);

        /***/
    },

    /***/113:
    /***/function _(module, exports) {

        var search_input = $('.search-input');
        var super_search = $('.super-search');
        var close_search = $('.close-search');
        var search_result = $('.search-result');
        var timeoutID = null;

        var Ripple = {
            searchFunction: function searchFunction(keyword) {
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function () {
                    super_search.removeClass('search-finished');
                    search_result.fadeOut();
                    $.ajax({
                        type: 'GET',
                        cache: false,
                        url: '/api/v1/search',
                        data: {
                            'q': keyword
                        },
                        success: function success(res) {
                            if (!res.error) {
                                var html = '<p class="search-result-title">Search from: </p>';
                                $.each(res.data.items, function (index, el) {
                                    html += '<p class="search-item">' + index + '</p>';
                                    html += el;
                                });
                                html += '<div class="clearfix"></div>';
                                search_result.html(html);
                                super_search.addClass('search-finished');
                            } else {
                                search_result.html(res.message);
                            }
                            search_result.fadeIn(500);
                        },
                        error: function error(res) {
                            search_result.html(res.responseText);
                            search_result.fadeIn(500);
                        }
                    });
                }, 500);
            },
            bindActionToElement: function bindActionToElement() {
                close_search.on('click', function (event) {
                    event.preventDefault();
                    if (close_search.hasClass('active')) {
                        super_search.removeClass('active');
                        search_result.hide();
                        close_search.removeClass('active');
                        $('body').removeClass('overflow');
                        $('.quick-search > .form-control').focus();
                    } else {
                        super_search.addClass('active');
                        if (search_input.val() != '') {
                            Ripple.searchFunction(search_input.val());
                        }
                        $('body').addClass('overflow');
                        close_search.addClass('active');
                    }
                });

                search_input.keyup(function (e) {
                    search_input.val(e.target.value);
                    Ripple.searchFunction(e.target.value);
                });
            }
        };

        $(document).ready(function () {
            Ripple.bindActionToElement();
        });

        /***/
    }

    /******/ });

/***/ })

/******/ });