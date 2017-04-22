/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 11);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
function activeText(value) {
    if (!value) {
        return '未開放查詢';
    }
    return '已開放';
}

/* harmony default export */ exports["a"] = activeText;

/***/ },
/* 1 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
Number.prototype.formatMoney = function (decPlaces, thouSeparator, decSeparator) {
    var n = this,
        decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
        decSeparator = decSeparator == undefined ? "." : decSeparator,
        thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
        sign = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
};

function formatDollar(num) {
    num = Number(num);
    return num.formatMoney(0, ',', 0);
}

/* harmony default export */ exports["a"] = formatDollar;

/***/ },
/* 2 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
function text(value) {
    if (!value) {
        return '未設定';
    }
    return value;
}

/* harmony default export */ exports["a"] = text;

/***/ },
/* 3 */
/***/ function(module, exports) {

module.exports = {
    isEmpty: function (item) {
        // null and undefined are "empty"
        if (item == null) return true;
        if (item == 'undefined') return true;

        //For Array
        // Assume if it has a length property with a non-zero value
        // that that property is correct.
        if (item.length > 0) return false;
        if (item.length === 0) return true;

        // If it isn't an object at this point
        // it is empty, but it can't be anything *but* empty
        // Is it empty?  Depends on your application.
        if (typeof item !== "object") return true;

        // Otherwise, does it have any properties of its own?
        // Note that this doesn't handle
        // toString and valueOf enumeration bugs in IE < 9
        for (var key in item) {
            if (hasOwnProperty.call(item, key)) return false;
        }
        return true;
    },
    getTempId: function () {
        var d = new Date();
        var n = d.getTime();
        return n;
    },
    /**
     *  an array containing one item will be returned if allowEmpty==false
     * return array
     * */
    objToArray: function (myObj, closure, allowEmpty) {
        if ( allowEmpty === void 0 ) allowEmpty = true;

        var y = [];

        if (!this.isEmpty(myObj)) {
            for (var key in myObj) {
                y.push(closure(key, myObj[key]));
            }
        }

        if (y.length == 0 && !allowEmpty) {
            y.push(closure('', ''));
        }

        return y;
    },
    ifDuplicateTitles: function (list) {
        var listTitles = list.map(function (item) {
            return item.title;
        });
        var uniqueTitles = listTitles.unique();
        return listTitles.length != uniqueTitles.length;
    },
    unsetValue: function (type) {
        if ( type === void 0 ) type = 'string';

        switch (type) {
            case 'string':
                return '';
            case 'array':
                return [];
            case 'number':
                return 0;
            default:
                return '';
        }
    },
    addressObjToText: function (addressObj) {
        if (this.isEmpty(addressObj)) {
            return '未輸入地址';
        }
        return addressObj.city.title + addressObj.area.zip + addressObj.area.title + addressObj.street;
    },
    filePath: function (obj, defaultPath) {
        if (!obj) {
            return defaultPath;
        }

        return obj.filepath;
    },
    emptyString: '',
    emptyArray: [],
    emptyObj: {}
};

Array.prototype.unique = function () {
    var this$1 = this;

    var arr = [];
    for (var i = 0; i < this.length; i++) {
        if (arr.indexOf(this$1[i]) == -1) {
            arr.push(this$1[i]);
        }
    }
    return arr;
};

/***/ },
/* 4 */
/***/ function(module, exports, __webpack_require__) {

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__webpack_require__(10)
__vue_script__ = __webpack_require__(5)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\vendors\\Carousel.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(8)
module.exports = __vue_script__ || {}
if (module.exports.__esModule) module.exports = module.exports.default
var __vue_options__ = typeof module.exports === "function" ? (module.exports.options || (module.exports.options = {})) : module.exports
if (__vue_template__) {
__vue_options__.template = __vue_template__
}
if (!__vue_options__.computed) __vue_options__.computed = {}
Object.keys(__vue_styles__).forEach(function (key) {
var module = __vue_styles__[key]
__vue_options__.computed[key] = function () { return module }
})
if (false) {(function () {  module.hot.accept()
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  var id = "_v-1b2bc996/Carousel.vue"
  if (!module.hot.data) {
    hotAPI.createRecord(id, module.exports)
  } else {
    hotAPI.update(id, module.exports, __vue_template__)
  }
})()}

/***/ },
/* 5 */
/***/ function(module, exports) {

"use strict";
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = {
    data: function data() {
        return {
            currentIndex: 0,
            count: this.items.length,
            autoPlayFlag: null
        };
    },

    computed: {
        ulStyle: function ulStyle() {
            return {
                width: this.count * 100 + '%',
                left: -100 * this.currentIndex + '%',
                transitionDuration: this.speed + 's'
            };
        }
    },
    props: {
        items: {
            type: Array,
            required: true
        },
        autoplay: {
            type: Boolean,
            required: false,
            default: false
        },
        speed: {
            type: Number,
            required: false,
            default: 1.5
        },
        showArrows: {
            type: Boolean,
            required: false,
            default: true
        },
        showDots: {
            type: Boolean,
            required: false,
            default: true
        },
        delay: {
            type: Number,
            required: false,
            default: 2
        }
    },
    methods: {
        turn: function turn(i) {
            var _i = this.currentIndex + i;
            if (_i < 0) {
                _i = _i + this.count;
            }
            if (_i >= this.count) {
                _i = _i - this.count;
            }
            this.currentIndex = _i;
        },
        goPlay: function goPlay() {
            var _this = this;

            if (this.autoplay) {
                this.autoPlayFlag = setInterval(function () {
                    _this.turn(1);
                }, this.delay * 1000);
            }
        },
        pausePlay: function pausePlay() {
            clearInterval(this.autoPlayFlag);
        },
        handleDotClick: function handleDotClick(i) {
            this.currentIndex = i;
        }
    },
    ready: function ready() {
        this.goPlay();
    }
};

/***/ },
/* 6 */
/***/ function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(7)();
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n* {\n    margin:0;\n    padding: 0\n}\n.m-carousel{\n    overflow: hidden;\n    width:100%;\n    position: relative;\n}\n.m-carousel .m-carousel-wrapper{\n    height: auto;\n    overflow: hidden;\n    position: relative;\n    left: 0;\n    -webkit-transition:left 1s;\n    transition: left 1s;\n}\n.m-carousel .m-carousel-item {\n    display: inline-block;\n    height: 100%;\n    text-align: center;\n}\n.m-carousel .m-carousel-item  > img {\n    display: inline-block;\n    height: auto;\n    max-width: 100%;\n}\n.m-carousel .m-carousel-arrow{\n    display: inline-block;\n    color: #2196F3;\n    position: absolute;\n    top: 50%;\n    margin-top: -20px;\n    z-index: 100;\n    padding: 20px;\n    cursor: pointer;\n    background-position: center;\n    background-repeat: no-repeat;\n}\n.m-carousel .m-carousel-arrow.carousel-arrow-right {\n    right: 0;\n    background-image: url(\"data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z'%20fill%3D'%232bb8aa'%2F%3E%3C%2Fsvg%3E\")\n}\n.m-carousel .m-carousel-arrow.carousel-arrow-left {\n    background-image: url(\"data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M0%2C22L22%2C0l2.1%2C2.1L4.2%2C22l19.9%2C19.9L22%2C44L0%2C22L0%2C22L0%2C22z'%20fill%3D'%232bb8aa'%2F%3E%3C%2Fsvg%3E\");\n    left: 0;\n}\n.m-carousel .dots-wrapper {\n    position: absolute;\n    width: 100%;\n    bottom: 0;\n    text-align:center;\n}\n.m-carousel .dots-wrapper .carousel-dot {\n    display: inline-block;\n    width: 8px;\n    height: 8px;\n    border: 1px solid #CCC;\n    margin: 6px;\n    cursor: pointer;\n    border-radius: 6px;\n}\n.m-carousel .dots-wrapper .carousel-dot:hover {\n    border:1px solid #2bb8aa;\n}\n.m-carousel .dots-wrapper .carousel-dot.carousel-dot-selected{\n    background: #2bb8aa;\n}\n", ""]);

// exports


/***/ },
/* 7 */
/***/ function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function() {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		var result = [];
		for(var i = 0; i < this.length; i++) {
			var item = this[i];
			if(item[2]) {
				result.push("@media " + item[2] + "{" + item[1] + "}");
			} else {
				result.push(item[1]);
			}
		}
		return result.join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};


/***/ },
/* 8 */
/***/ function(module, exports) {

module.exports = "\n    <div class=\"m-carousel\">\n        <div class=\"m-carousel-wrapper\" :style=\"ulStyle\">\n            <div class=\"m-carousel-item\" :style=\"{width:100/count + '%'}\"\n                 v-for=\"item in items\">\n                <img :src=\"item.src\" :alt=\"item.alt\" />\n            </div>\n        </div>\n        <div v-if=\"showArrows\">\n            <div class=\"m-carousel-arrow carousel-arrow-left\" \t@click=\"turn(-1)\"></div>\n            <div class=\"m-carousel-arrow carousel-arrow-right\"\t@click=\"turn(1)\"></div>\n        </div>\n        <div v-if=\"showDots\">\n            <div class=\"dots-wrapper\">\n\t\t\t\t<span class=\"carousel-dot\" v-for=\"i in count\" :class=\"{'carousel-dot-selected':(currentIndex === i)}\"\n                      @click=\"handleDotClick(i)\">\n\t\t\t\t</span>\n            </div>\n        </div>\n    </div>\n";

/***/ },
/* 9 */
/***/ function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
var stylesInDom = {},
	memoize = function(fn) {
		var memo;
		return function () {
			if (typeof memo === "undefined") memo = fn.apply(this, arguments);
			return memo;
		};
	},
	isOldIE = memoize(function() {
		return /msie [6-9]\b/.test(window.navigator.userAgent.toLowerCase());
	}),
	getHeadElement = memoize(function () {
		return document.head || document.getElementsByTagName("head")[0];
	}),
	singletonElement = null,
	singletonCounter = 0,
	styleElementsInsertedAtTop = [];

module.exports = function(list, options) {
	if(typeof DEBUG !== "undefined" && DEBUG) {
		if(typeof document !== "object") throw new Error("The style-loader cannot be used in a non-browser environment");
	}

	options = options || {};
	// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
	// tags it will allow on a page
	if (typeof options.singleton === "undefined") options.singleton = isOldIE();

	// By default, add <style> tags to the bottom of <head>.
	if (typeof options.insertAt === "undefined") options.insertAt = "bottom";

	var styles = listToStyles(list);
	addStylesToDom(styles, options);

	return function update(newList) {
		var mayRemove = [];
		for(var i = 0; i < styles.length; i++) {
			var item = styles[i];
			var domStyle = stylesInDom[item.id];
			domStyle.refs--;
			mayRemove.push(domStyle);
		}
		if(newList) {
			var newStyles = listToStyles(newList);
			addStylesToDom(newStyles, options);
		}
		for(var i = 0; i < mayRemove.length; i++) {
			var domStyle = mayRemove[i];
			if(domStyle.refs === 0) {
				for(var j = 0; j < domStyle.parts.length; j++)
					domStyle.parts[j]();
				delete stylesInDom[domStyle.id];
			}
		}
	};
}

function addStylesToDom(styles, options) {
	for(var i = 0; i < styles.length; i++) {
		var item = styles[i];
		var domStyle = stylesInDom[item.id];
		if(domStyle) {
			domStyle.refs++;
			for(var j = 0; j < domStyle.parts.length; j++) {
				domStyle.parts[j](item.parts[j]);
			}
			for(; j < item.parts.length; j++) {
				domStyle.parts.push(addStyle(item.parts[j], options));
			}
		} else {
			var parts = [];
			for(var j = 0; j < item.parts.length; j++) {
				parts.push(addStyle(item.parts[j], options));
			}
			stylesInDom[item.id] = {id: item.id, refs: 1, parts: parts};
		}
	}
}

function listToStyles(list) {
	var styles = [];
	var newStyles = {};
	for(var i = 0; i < list.length; i++) {
		var item = list[i];
		var id = item[0];
		var css = item[1];
		var media = item[2];
		var sourceMap = item[3];
		var part = {css: css, media: media, sourceMap: sourceMap};
		if(!newStyles[id])
			styles.push(newStyles[id] = {id: id, parts: [part]});
		else
			newStyles[id].parts.push(part);
	}
	return styles;
}

function insertStyleElement(options, styleElement) {
	var head = getHeadElement();
	var lastStyleElementInsertedAtTop = styleElementsInsertedAtTop[styleElementsInsertedAtTop.length - 1];
	if (options.insertAt === "top") {
		if(!lastStyleElementInsertedAtTop) {
			head.insertBefore(styleElement, head.firstChild);
		} else if(lastStyleElementInsertedAtTop.nextSibling) {
			head.insertBefore(styleElement, lastStyleElementInsertedAtTop.nextSibling);
		} else {
			head.appendChild(styleElement);
		}
		styleElementsInsertedAtTop.push(styleElement);
	} else if (options.insertAt === "bottom") {
		head.appendChild(styleElement);
	} else {
		throw new Error("Invalid value for parameter 'insertAt'. Must be 'top' or 'bottom'.");
	}
}

function removeStyleElement(styleElement) {
	styleElement.parentNode.removeChild(styleElement);
	var idx = styleElementsInsertedAtTop.indexOf(styleElement);
	if(idx >= 0) {
		styleElementsInsertedAtTop.splice(idx, 1);
	}
}

function createStyleElement(options) {
	var styleElement = document.createElement("style");
	styleElement.type = "text/css";
	insertStyleElement(options, styleElement);
	return styleElement;
}

function addStyle(obj, options) {
	var styleElement, update, remove;

	if (options.singleton) {
		var styleIndex = singletonCounter++;
		styleElement = singletonElement || (singletonElement = createStyleElement(options));
		update = applyToSingletonTag.bind(null, styleElement, styleIndex, false);
		remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true);
	} else {
		styleElement = createStyleElement(options);
		update = applyToTag.bind(null, styleElement);
		remove = function() {
			removeStyleElement(styleElement);
		};
	}

	update(obj);

	return function updateStyle(newObj) {
		if(newObj) {
			if(newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap)
				return;
			update(obj = newObj);
		} else {
			remove();
		}
	};
}

var replaceText = (function () {
	var textStore = [];

	return function (index, replacement) {
		textStore[index] = replacement;
		return textStore.filter(Boolean).join('\n');
	};
})();

function applyToSingletonTag(styleElement, index, remove, obj) {
	var css = remove ? "" : obj.css;

	if (styleElement.styleSheet) {
		styleElement.styleSheet.cssText = replaceText(index, css);
	} else {
		var cssNode = document.createTextNode(css);
		var childNodes = styleElement.childNodes;
		if (childNodes[index]) styleElement.removeChild(childNodes[index]);
		if (childNodes.length) {
			styleElement.insertBefore(cssNode, childNodes[index]);
		} else {
			styleElement.appendChild(cssNode);
		}
	}
}

function applyToTag(styleElement, obj) {
	var css = obj.css;
	var media = obj.media;
	var sourceMap = obj.sourceMap;

	if (media) {
		styleElement.setAttribute("media", media);
	}

	if (sourceMap) {
		// https://developer.chrome.com/devtools/docs/javascript-debugging
		// this makes source maps inside style tags work properly in Chrome
		css += '\n/*# sourceURL=' + sourceMap.sources[0] + ' */';
		// http://stackoverflow.com/a/26603875
		css += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + " */";
	}

	if (styleElement.styleSheet) {
		styleElement.styleSheet.cssText = css;
	} else {
		while(styleElement.firstChild) {
			styleElement.removeChild(styleElement.firstChild);
		}
		styleElement.appendChild(document.createTextNode(css));
	}
}


/***/ },
/* 10 */
/***/ function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(6);
if(typeof content === 'string') content = [[module.i, content, '']];
// add the styles to the DOM
var update = __webpack_require__(9)(content, {});
if(content.locals) module.exports = content.locals;
// Hot Module Replacement
if(false) {
	// When the styles change, update the <style> tags
	if(!content.locals) {
		module.hot.accept("!!./../../../../node_modules/css-loader/index.js!./../../../../node_modules/vue-loader/lib/style-rewriter.js!./../../../../node_modules/vue-loader/lib/selector.js?type=style&index=0!./Carousel.vue", function() {
			var newContent = require("!!./../../../../node_modules/css-loader/index.js!./../../../../node_modules/vue-loader/lib/style-rewriter.js!./../../../../node_modules/vue-loader/lib/selector.js?type=style&index=0!./Carousel.vue");
			if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
			update(newContent);
		});
	}
	// When the module is disposed, remove the <style> tags
	module.hot.dispose(function() { update(); });
}

/***/ },
/* 11 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__components_vendors_Carousel_vue__ = __webpack_require__(4);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__components_vendors_Carousel_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__components_vendors_Carousel_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__components_helpers_js__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__components_helpers_js___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__components_helpers_js__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__components_filters_currency_js__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__components_filters_activeText_js__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__components_filters_text_js__ = __webpack_require__(2);
/*** package*/



function specObj(key, description) {
    key = key == null ? '' : key;
    description = description == null ? '' : description;

    return {
        title: key,
        description: description
    };
}

/***Filter**********/

Vue.filter('currency', __WEBPACK_IMPORTED_MODULE_2__components_filters_currency_js__["a" /* default */]);


Vue.filter('activeText', __WEBPACK_IMPORTED_MODULE_3__components_filters_activeText_js__["a" /* default */]);


Vue.filter('text', __WEBPACK_IMPORTED_MODULE_4__components_filters_text_js__["a" /* default */]);

var userDefault;
userDefault = {
    name: '',
    email: ''
};

var defaultPhotoPath = '/assets/images/cover/coverPhoto.jpg';

/***vue begin************** *****/
var vm = new Vue({
    el: '#app',
    components: {
        Carousel: __WEBPACK_IMPORTED_MODULE_0__components_vendors_Carousel_vue___default.a
    },
    data: {
        user: {},
        item: { title: 'DeviceTitle', dimension: { width: '', depth: '', height: '' }, cat: { title: '' } },
        itemAddress: '',
        photos: [],
        pics: [],
        discussions: '',
        newDiscussionContent: '',
        newDialogueContent: '',
        activePhoto: {},
        dir: '\\assets\\images\\cover\\',
        discussionPrefix: 'discussion-'
    },
    computed: {
        chosenPhoto: function () {
            return this.dir + this.activePhoto;
        },
        isLegalUser: function () {
            return !__WEBPACK_IMPORTED_MODULE_1__components_helpers_js___default.a.isEmpty(this.user);
        }
    },
    methods: {
        toggleItemActive: function () {
            var url = '/ajax/frontend/devices/toggleActive/' + this.item.id;
            var data = {
                active: this.item.active
            };
            var callback = function (data, status) {
                this.item = data;
            }.bind(this);

            $.post(url, data, callback);
        },
        updateActivePhoto: function (photo) {
            this.activePhoto = photo;
        },
        raiseDiscussion: function () {
            var content = $('#discussion-content').val();

            if (content != '') {
                var url = '/ajax/frontend/devices/raiseDiscussion/' + this.item.id;
                var data = {
                    content: content
                };
                var callback = function (data, status) {
                    this.newDiscussionContent = '';
                    this.discussions.unshift(data);
                }.bind(this);

                $.post(url, data, callback);
            }
        },
        ceaseDiscussion: function (discussion) {
            if (confirm('確定要刪除留言?')) {
                var url = '/ajax/frontend/devices/ceaseDiscussion/' + discussion.id;
                var data = {};
                var callback = function (data, status) {
                    var index = this.discussions.indexOf(discussion);
                    if (index != -1) {
                        this.discussions.splice(index, 1);
                    }
                }.bind(this);

                $.post(url, data, callback);
            }
        },
        joinDiscussion: function (discussionId) {
            var dialogueContentId = '#discussion-' + discussionId;
            var content = $(dialogueContentId).val();

            if (content != '') {
                var url = '/ajax/frontend/devices/joinDiscussion/' + discussionId;
                var data = {
                    content: content
                };
                var doWhenSuccess = function (data, status) {
                    var this$1 = this;

                    //empty the dialogue input
                    $(dialogueContentId).val('');

                    //find out the designated discussion
                    //push dialogue into discussion.dialogues
                    var arrayLength = this.discussions.length;
                    for (var i = 0; i < arrayLength; i++) {
                        if (this$1.discussions[i].id == discussionId) {
                            this$1.discussions[i].dialogues.push(data);
                        }
                    }
                }.bind(this);

                $.post(url, data, doWhenSuccess);
            }
        },
        leaveDiscussion: function (dialogue) {
            if (confirm('確定要刪除留言?')) {
                var url = '/ajax/frontend/devices/leaveDiscussion/' + dialogue.id;
                var data = {};
                var callback = function (data, status) {
                    var this$1 = this;

                    var arrayLength = this.discussions.length;
                    for (var i = 0; i < arrayLength; i++) {
                        //get the designated discussion
                        if (this$1.discussions[i].id == dialogue.discussion_id) {
                            //remove the dialogues from the array
                            var index = this$1.discussions[i].dialogues.indexOf(dialogue);
                            if (index != -1) {
                                this$1.discussions[i].dialogues.splice(index, 1);
                            }
                        }
                    }
                }.bind(this);

                $.post(url, data, callback);
            }
        },
        toggleLike: function () {
            var url = '/ajax/frontend/devices/toggleLike/' + this.item.id;
            var data = {};
            var callback = function (data, status) {
                this.item = data;
            }.bind(this);

            $.post(url, data, callback);
        },
        sendMailToSeller: function () {
            $('#emailModal').modal('hide');
            var data = $('#emailModalForm').serialize();
            var url = '/ajax/frontend/sendSellerMail/' + this.item.id;
            var doWhenSuccess = function (data, status) {
                alert('郵件已成功寄出');
            };

            $.post(url, data, doWhenSuccess).fail(function () {
                alert('郵件寄出失敗\n建議您可以直接用電話或利用其他訊息與賣家聯絡');
            });
        },
        filePath: function filePath(obj) {
            if (!obj) {
                return defaultPhotoPath;
            }
            return obj.filepath;
        }
    },
    beforeMount: function beforeMount() {
        initUser(this);
        this.item = JSON.parse($('#itemInfo').val());
        this.discussions = JSON.parse($('#deviceDiscussion').val());
        //this.itemAddress = helpers.addressObjToText(this.item.address);
        //initActivePhotos(this);
        //initPics(this);
    }
});

function initPics(vm) {
    var photos = vm.item.photos;
    var length = photos.length;
    var picArray = [];
    for (var i = 0; i < length; i++) {
        picArray.push({ src: photos[i].filepath, alt: '' });
    }
    vm.pics = picArray;
}

function initUser(vm) {
    var userInfo = $('#userInfo').val();
    vm.user = userInfo != '' ? vm.user = JSON.parse(userInfo) : userDefault;
}

function initActivePhotos(vm) {
    vm.activePhoto = vm.item.photos[0];
}

$(document).ready(function () {
    $('#emailModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var recipient = button.data('whatever'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('.modal-title').text('寄送郵件給賣家');
        $('#sender-name').val(vm.user.name);
        $('#sender-email').val(vm.user.email);
    });
});
/***vue end************** *****/

/***/ }
/******/ ]);