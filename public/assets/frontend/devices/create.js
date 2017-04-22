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
/******/ 	return __webpack_require__(__webpack_require__.s = 17);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
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

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(4)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\app\\DeviceCategory.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(11)
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
  var id = "_v-34cae1f4/DeviceCategory.vue"
  if (!module.hot.data) {
    hotAPI.createRecord(id, module.exports)
  } else {
    hotAPI.update(id, module.exports, __vue_template__)
  }
})()}

/***/ },
/* 3 */
/***/ function(module, exports, __webpack_require__) {

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(5)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\partials\\DeviceVertical.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(12)
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
  var id = "_v-3363d3a1/DeviceVertical.vue"
  if (!module.hot.data) {
    hotAPI.createRecord(id, module.exports)
  } else {
    hotAPI.update(id, module.exports, __vue_template__)
  }
})()}

/***/ },
/* 4 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _textTable = __webpack_require__(16);

var _textTable2 = _interopRequireDefault(_textTable);

var _deviceCat = __webpack_require__(9);

var _deviceCat2 = _interopRequireDefault(_deviceCat);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    props: ['source_selected'],
    components: {
        textTable: _textTable2.default
    },
    data: function data() {
        return {
            list: _deviceCat2.default.default,
            selected_list: []
        };
    },
    watch: {
        'source_selected': function source_selected(_source_selected) {
            this.selected_list = _source_selected;
        }
    },
    methods: {
        updateCat: function updateCat(list) {
            this.selected_list = list;
            this.$emit('update-selected', this.selected_list);
        }
    }
};

/***/ },
/* 5 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _appSetting = __webpack_require__(8);

var _appSetting2 = _interopRequireDefault(_appSetting);

var _helpers = __webpack_require__(0);

var _helpers2 = _interopRequireDefault(_helpers);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

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

Vue.filter('currency', formatDollar);

var defaultPhotoPath = _appSetting2.default.defaultDevicePhotoPath;

exports.default = {
    props: {
        device: {
            type: Object,
            required: true
        },
        editable: {
            type: Boolean,
            required: false
        }
    },
    data: function data() {
        return { item: {}, allowEdit: false };
    },
    methods: {
        filePath: function filePath(obj) {
            return _helpers2.default.filePath(obj, defaultPhotoPath);
        }
    },
    beforeMount: function beforeMount() {
        this.item = this.device;
    }
};

/***/ },
/* 6 */
/***/ function(module, exports) {

"use strict";
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = {
    props: ['item', 'selected_list'],
    data: function data() {
        return { selected_items: [] };
    },
    computed: {
        isInSelectedList: function isInSelectedList() {
            return this.selected_items.indexOf(this.item) !== -1;
        }
    },
    watch: {
        selected_list: function selected_list() {
            this.selected_items = this.selected_list;
        }
    },
    methods: {
        toggleSelected: function toggleSelected() {
            var event = this.isInSelectedList ? 'remove-selected' : 'update-selected';
            this.$emit(event, this.item);
        }
    }
};

/***/ },
/* 7 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _text = __webpack_require__(15);

var _text2 = _interopRequireDefault(_text);

var _mixins = __webpack_require__(10);

var _mixins2 = _interopRequireDefault(_mixins);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    components: {
        oneText: _text2.default
    },
    mixins: [_mixins2.default]
};

/***/ },
/* 8 */
/***/ function(module, exports) {

module.exports = {
    defaultDevicePhotoPath: '/images/companyInfo/mainPhoto.jpg'
};

/***/ },
/* 9 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(exports, "default", function() { return items; });
var items = [{
    "id": 1,
    "rank": 1,
    "title": "\u51b7\u51cd\u51b7\u85cf",
    "description": "",
    "sn_prefix": null,
    "items": [{
        "id": 1,
        "group_id": 1,
        "rank": 1,
        "title": "\u5c55\u793a\u73bb\u7483\u51b0\u7bb1",
        "description": ""
    }, {
        "id": 2,
        "group_id": 1,
        "rank": 2,
        "title": "\u4e0a\u51cd\u4e0b\u85cf\u51b0\u7bb1",
        "description": ""
    }, { "id": 3, "group_id": 1, "rank": 3, "title": "\u5de5\u4f5c\u53f0\u51b0\u7bb1", "description": "" }, {
        "id": 4,
        "group_id": 1,
        "rank": 4,
        "title": "\u4e0a\u6380\/\u5c0d\u62c9\u51b0\u6ac3",
        "description": ""
    }, { "id": 5, "group_id": 1, "rank": 5, "title": "\u5927\u578b\u51cd\u5eab", "description": "" }, {
        "id": 6,
        "group_id": 1,
        "rank": 6,
        "title": "\u6025\u901f\u51b7\u51cd",
        "description": ""
    }, { "id": 7, "group_id": 1, "rank": 7, "title": "\u5176\u4ed6", "description": "" }]
}, {
    "id": 2,
    "rank": 2,
    "title": "\u70f9\u8abf\u8a2d\u5099",
    "description": "",
    "sn_prefix": null,
    "items": [{
        "id": 8,
        "group_id": 2,
        "rank": 1,
        "title": "\u74e6\u65af\u7210\u5177",
        "description": ""
    }, { "id": 9, "group_id": 2, "rank": 2, "title": "\u84b8\u716e\u4fdd\u6eab", "description": "" }, {
        "id": 10,
        "group_id": 2,
        "rank": 3,
        "title": "\u70d8\u70e4\u8a2d\u5099",
        "description": ""
    }, { "id": 11, "group_id": 2, "rank": 4, "title": "\u6cb9\u70b8\u8a2d\u5099", "description": "" }, {
        "id": 12,
        "group_id": 2,
        "rank": 5,
        "title": "\u714e\u7092\u8a2d\u5099",
        "description": ""
    }, { "id": 13, "group_id": 2, "rank": 6, "title": "\u5fae\u6ce2\u96fb\u78c1", "description": "" }, {
        "id": 14,
        "group_id": 2,
        "rank": 7,
        "title": "\u50b3\u7d71\u9ede\u5fc3",
        "description": ""
    }, { "id": 15, "group_id": 2, "rank": 8, "title": "\u5176\u4ed6", "description": "" }]
}, {
    "id": 3,
    "rank": 3,
    "title": "\u98df\u6750\u8655\u7406",
    "description": "",
    "sn_prefix": null,
    "items": [{
        "id": 16,
        "group_id": 3,
        "rank": 1,
        "title": "\u652a\u62cc\u8a2d\u5099",
        "description": ""
    }, { "id": 17, "group_id": 3, "rank": 2, "title": "\u8abf\u7406\u8a2d\u5099", "description": "" }, {
        "id": 18,
        "group_id": 3,
        "rank": 3,
        "title": "\u8089\u985e\u8655\u7406",
        "description": ""
    }, { "id": 19, "group_id": 3, "rank": 4, "title": "\u852c\u679c\u8655\u7406", "description": "" }, {
        "id": 20,
        "group_id": 3,
        "rank": 5,
        "title": "\u7d5e\u788e\u5207\u788e",
        "description": ""
    }, { "id": 21, "group_id": 3, "rank": 6, "title": "\u771f\u7a7a\u812b\u6c34", "description": "" }, {
        "id": 22,
        "group_id": 3,
        "rank": 7,
        "title": "\u5176\u4ed6",
        "description": ""
    }]
}, {
    "id": 4,
    "rank": 4,
    "title": "\u6ac3\u67b6\u6aaf\u5b50",
    "description": "",
    "sn_prefix": null,
    "items": [{
        "id": 23,
        "group_id": 4,
        "rank": 1,
        "title": "\u6ef7\u5473\u8eca\u53f0",
        "description": ""
    }, { "id": 24, "group_id": 4, "rank": 2, "title": "\u9eb5\u6aaf\u8eca\u53f0", "description": "" }, {
        "id": 25,
        "group_id": 4,
        "rank": 3,
        "title": "\u6cb9\u70b8\u8eca\u53f0",
        "description": ""
    }, { "id": 26, "group_id": 4, "rank": 4, "title": "\u529f\u80fd\u6027\u8eca\u53f0", "description": "" }, {
        "id": 27,
        "group_id": 4,
        "rank": 5,
        "title": "\u5c64\u67b6\u5de5\u4f5c\u81fa",
        "description": ""
    }, { "id": 28, "group_id": 4, "rank": 6, "title": "\u5de5\u4f5c\u6c34\u69fd", "description": "" }, {
        "id": 29,
        "group_id": 4,
        "rank": 7,
        "title": "\u5176\u4ed6",
        "description": ""
    }]
}, {
    "id": 5,
    "rank": 5,
    "title": "\u98f2\u6599\u51b0\u54c1",
    "description": "",
    "sn_prefix": null,
    "items": [{ "id": 30, "group_id": 5, "rank": 1, "title": "\u88fd\u51b0\u6a5f", "description": "" }, {
        "id": 31,
        "group_id": 5,
        "rank": 2,
        "title": "\u98f2\u54c1\u8a2d\u5099",
        "description": ""
    }, { "id": 32, "group_id": 5, "rank": 3, "title": "\u5496\u5561\u8a2d\u5099", "description": "" }, {
        "id": 33,
        "group_id": 5,
        "rank": 4,
        "title": "\u51b0\u54c1\u8a2d\u5099",
        "description": ""
    }, { "id": 34, "group_id": 5, "rank": 5, "title": "\u4fdd\u6eab\u8a2d\u5099", "description": "" }, {
        "id": 35,
        "group_id": 5,
        "rank": 6,
        "title": "\u98f2\u6c34\u8a2d\u5099",
        "description": ""
    }, { "id": 36, "group_id": 5, "rank": 7, "title": "\u5305\u88dd\u5c01\u53e3", "description": "" }, {
        "id": 37,
        "group_id": 5,
        "rank": 8,
        "title": "\u5176\u4ed6",
        "description": ""
    }]
}, {
    "id": 6,
    "rank": 6,
    "title": "\u70d8\u57f9\u8a2d\u5099",
    "description": "",
    "sn_prefix": null,
    "items": [{
        "id": 38,
        "group_id": 6,
        "rank": 1,
        "title": "\u7aaf\u70e4\u8a2d\u5099",
        "description": ""
    }, { "id": 39, "group_id": 6, "rank": 2, "title": "\u70d8\u70e4\u8a2d\u5099", "description": "" }, {
        "id": 40,
        "group_id": 6,
        "rank": 3,
        "title": "\u767c\u9175\u7bb1",
        "description": ""
    }, { "id": 41, "group_id": 6, "rank": 4, "title": "\u6574\u5f62\u6a5f", "description": "" }, {
        "id": 42,
        "group_id": 6,
        "rank": 5,
        "title": "\u70d8\u70e4\u6a21\u5177",
        "description": ""
    }, { "id": 43, "group_id": 6, "rank": 6, "title": "\u5c64\u67b6\u53f0\u8eca", "description": "" }, {
        "id": 44,
        "group_id": 6,
        "rank": 7,
        "title": "\u5176\u4ed6",
        "description": ""
    }]
}, {
    "id": 7,
    "rank": 7,
    "title": "\u5176\u4ed6\u8a2d\u5099",
    "description": "",
    "sn_prefix": null,
    "items": [{
        "id": 45,
        "group_id": 7,
        "rank": 1,
        "title": "\u6e05\u6f54\u8a2d\u5099",
        "description": ""
    }, { "id": 46, "group_id": 7, "rank": 2, "title": "\u6392\u7159\u6de8\u5316", "description": "" }, {
        "id": 47,
        "group_id": 7,
        "rank": 3,
        "title": "\u751f\u8ca1\u5668\u5177",
        "description": ""
    }, { "id": 48, "group_id": 7, "rank": 4, "title": "\u7897\u76e4\u9910\u5177", "description": "" }, {
        "id": 49,
        "group_id": 7,
        "rank": 5,
        "title": "\u96fb\u8166\u8a2d\u5099",
        "description": ""
    }, { "id": 50, "group_id": 7, "rank": 6, "title": "\u684c\u6905\u5bb6\u5177", "description": "" }, {
        "id": 51,
        "group_id": 7,
        "rank": 7,
        "title": "\u7a7a\u8abf\u51b7\u6c23",
        "description": ""
    }, { "id": 52, "group_id": 7, "rank": 8, "title": "\u884c\u52d5\u9910\u8eca", "description": "" }, {
        "id": 53,
        "group_id": 7,
        "rank": 9,
        "title": "\u5176\u4ed6",
        "description": ""
    }]
}, {
    "id": 8,
    "rank": 8,
    "title": "\u592e\u5eda\u8a2d\u5099",
    "description": "",
    "sn_prefix": null,
    "items": [{
        "id": 54,
        "group_id": 8,
        "rank": 1,
        "title": "\u51b7\u537b\u8a2d\u5099",
        "description": ""
    }, { "id": 55, "group_id": 8, "rank": 2, "title": "\u5206\u88dd\u8a2d\u5099", "description": "" }, {
        "id": 56,
        "group_id": 8,
        "rank": 3,
        "title": "\u5305\u88dd\u8a2d\u5099",
        "description": ""
    }, { "id": 57, "group_id": 8, "rank": 4, "title": "\u8abf\u7406\u8a2d\u5099", "description": "" }, {
        "id": 58,
        "group_id": 8,
        "rank": 5,
        "title": "\u84b8\u716e\u8a2d\u5099",
        "description": ""
    }, { "id": 59, "group_id": 8, "rank": 6, "title": "\u6bba\u83cc\u6d88\u6bd2", "description": "" }, {
        "id": 60,
        "group_id": 8,
        "rank": 7,
        "title": "\u5176\u4ed6",
        "description": ""
    }]
}];



/***/ },
/* 10 */
/***/ function(module, exports) {

module.exports = {
    props: {
        maxqty: {
            type: String,
            required: false
        },
        source: {
            type: Array,
            required: true
        },
        source_selected: {
            type: Array,
            required: false
        }
    },
    data: function data() {
        return {
            list: '',
            selected_list: [],
            maxSelectedQty: ''
        };
    },
    watch: {
        source_selected: function source_selected(e) {
            this.selected_list = e;
        }
    },
    methods: {
        notifyListChanged: function () {
            this.$emit('update-selected', this.selected_list);
        },
        updateSelected: function (item) {
            if (this.maxSelectedQty == 1) {
                this.selected_list.pop();
            }

            if (this.moreItemIsAllowed(this)) {
                this.selected_list.push(item);
            }
            this.notifyListChanged();
        },
        removeSelected: function (item) {
            var index = this.selected_list.indexOf(item);
            if (index != -1) {
                this.selected_list.splice(index, 1);
            }
            this.notifyListChanged();
        },
        moreItemIsAllowed: function (elem) {
            return elem.maxSelectedQty > elem.selected_list.length || elem.maxSelectedQty == 'unlimited';
        },
        syncUpSource: function syncUpSource() {
            var this$1 = this;

            //loop through the list
            //check to see if the item is in list
            //if yes, put the item in the selected list, and break
            if (this.source_selected) {
                var listLength = this.list.length;
                var sourceSelectedLength = this.source_selected.length;
                for (var i = 0; i < listLength; i++) {
                    var item = this$1.list[i];
                    for (var j = 0; j < sourceSelectedLength; j++) {
                        if (this$1.source_selected[j].title == item.title) {
                            this$1.selected_list.push(item);
                            break;
                        }
                    }
                }
            }
        }
    },
    beforeMount: function beforeMount() {
        this.maxSelectedQty = this.maxqty === undefined ? 1 : this.maxqty;
        this.list = this.source;
        this.syncUpSource();
    }
};

/***/ },
/* 11 */
/***/ function(module, exports) {

module.exports = "\n\n\n\n\n\n\n\n\n\n<div>\n    <text-table\n            :source=\"list\"\n            :source-selected=\"selected_list\"\n            max-qty=\"1\"\n            @update-selected=\"updateCat\">\n    </text-table>\n</div>\n";

/***/ },
/* 12 */
/***/ function(module, exports) {

module.exports = "\n<div class=\"thumbnail\" style=\"background: white\">\n    <a :href=\"'/devices/'+item.id\">\n        <img :src=\"filePath(item.coverphoto)\" alt=\"\"\n             style=\"height:120px\">\n    </a>\n\n    <div class=\"caption\">\n        <h4 class=\"text-danger\">{{ item.title }}</h4>\n        <h4>價格:<span class=\"text-warning\">{{ item.price|currency}}</span></h4>\n\n        <p class=\"text-primary\">瀏覽人次: &nbsp;{{ item.reads }}</p>\n\n        <p class=\"text-primary\">{{ item.created_date }}刊登\n            <a :href=\"'/devices/'+item.id\">\n                    <span class=\"pull-right text-danger\">查看&nbsp;\n                        <i class=\"fa fa-caret-right\" aria-hidden=\"true\"></i></span>\n            </a>\n            <a :href=\"'/devices/'+item.id+'/edit'\" v-if=\"this.editable\">\n                <span class=\"pull-right text-danger\">編輯&nbsp;\n                        <i class=\"fa fa-caret-right\" aria-hidden=\"true\"></i></span>\n            </a>\n        </p>\n    </div>\n</div>\n";

/***/ },
/* 13 */
/***/ function(module, exports) {

module.exports = "\n<span>\n    <span class=\"text-underline rwd-text-20\"\n          :class=\"{'text-danger':isInSelectedList}\"\n          @click=\"toggleSelected\"\n          style=\"margin-right:5px;\">\n        {{item.title}}\n    </span>\n</span>\n";

/***/ },
/* 14 */
/***/ function(module, exports) {

module.exports = "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n<table>\n    <thead>\n    <tr>\n        <th style=\"width: 20%\"></th>\n        <th style=\"width: 80%\"></th>\n    </tr>\n    </thead>\n    <tbody>\n    <tr v-for=\"row in list\">\n        <td class=\"text-center vertical-top rwd-text-20\">{{ row.title }}</td>\n        <td>\n            <one-text v-for=\"item in row.items\"\n                      :item=\"item\"\n                      :selected_list=\"selected_list\"\n                      @update-selected=\"updateSelected\"\n                      @remove-selected=\"removeSelected\"></one-text>\n        </td>\n    </tr>\n    </tbody>\n</table>\n";

/***/ },
/* 15 */
/***/ function(module, exports, __webpack_require__) {

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(6)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\selectors\\text.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(13)
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
  var id = "_v-e8d5df4c/text.vue"
  if (!module.hot.data) {
    hotAPI.createRecord(id, module.exports)
  } else {
    hotAPI.update(id, module.exports, __vue_template__)
  }
})()}

/***/ },
/* 16 */
/***/ function(module, exports, __webpack_require__) {

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(7)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\selectors\\textTable.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(14)
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
  var id = "_v-1c4b3a78/textTable.vue"
  if (!module.hot.data) {
    hotAPI.createRecord(id, module.exports)
  } else {
    hotAPI.update(id, module.exports, __vue_template__)
  }
})()}

/***/ },
/* 17 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__components_helpers_js__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__components_helpers_js__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__components_filters_currency_js__ = __webpack_require__(1);
/*app*/
Vue.component('deviceCategory', __webpack_require__(2));
Vue.component('deviceBlock', __webpack_require__(3));



/***Filter**********/

Vue.filter('currency', __WEBPACK_IMPORTED_MODULE_1__components_filters_currency_js__["a" /* default */]);

var defaultCat = [{ title: '選擇類別', id: 0 }];

var vm = new Vue({
    el: '#app',
    data: {
        selectedbrand: '',
        form_input: {
            title: '',
            brand: '',
            cat: defaultCat
        },
        viewControl: {
            see_cat_menu: false
        },
        userDevices: {}
    },
    methods: {
        updateCat: function (list) {
            this.form_input.cat = list;
        },
        storeItem: function () {
            //validate basic info
            if (this.form_input.cat[0].id == '' || this.form_input.cat[0].id == undefined)
                //if (helpers.isEmpty(this.form_input.cat[0].id))
                {
                    alert('請選擇類別');
                    $('#cat_id').focus();
                    return;
                }

            this.formSaved = true;
            document.querySelector('#inputForm').submit();
        }
    },
    watch: {
        'form_input.cat': function () {
            this.viewControl.see_cat_menu = false;
        }
    },
    mounted: function mounted() {
        var userDevices = $('#userDevices').val();
        if (userDevices) {
            this.userDevices = JSON.parse(userDevices);
        }
    }
});

/***/ }
/******/ ]);