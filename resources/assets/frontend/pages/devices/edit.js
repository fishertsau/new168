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
/******/ 	return __webpack_require__(__webpack_require__.s = 43);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
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
/* 1 */
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
/* 2 */
/***/ function(module, exports, __webpack_require__) {

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(8)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\app\\AddressInput.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(25)
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
  var id = "_v-4869b494/AddressInput.vue"
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
__vue_script__ = __webpack_require__(9)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\app\\DeviceCategory.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(26)
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
/* 4 */
/***/ function(module, exports, __webpack_require__) {

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(10)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\app\\OccasionListButtons.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(27)
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
  var id = "_v-aaf27568/OccasionListButtons.vue"
  if (!module.hot.data) {
    hotAPI.createRecord(id, module.exports)
  } else {
    hotAPI.update(id, module.exports, __vue_template__)
  }
})()}

/***/ },
/* 5 */
/***/ function(module, exports, __webpack_require__) {

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(11)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\app\\PhotoInput.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(28)
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
  var id = "_v-74b6f990/PhotoInput.vue"
  if (!module.hot.data) {
    hotAPI.createRecord(id, module.exports)
  } else {
    hotAPI.update(id, module.exports, __vue_template__)
  }
})()}

/***/ },
/* 6 */
/***/ function(module, exports, __webpack_require__) {

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(13)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\app\\refSpecs\\refSpecs.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(30)
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
  var id = "_v-28a05dcc/refSpecs.vue"
  if (!module.hot.data) {
    hotAPI.createRecord(id, module.exports)
  } else {
    hotAPI.update(id, module.exports, __vue_template__)
  }
})()}

/***/ },
/* 7 */
/***/ function(module, exports, __webpack_require__) {

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(19)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\frontend\\pages\\devices\\BrandSelection.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(36)
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
  var id = "_v-3c02eaa5/BrandSelection.vue"
  if (!module.hot.data) {
    hotAPI.createRecord(id, module.exports)
  } else {
    hotAPI.update(id, module.exports, __vue_template__)
  }
})()}

/***/ },
/* 8 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _cities = __webpack_require__(21);

var _cities2 = _interopRequireDefault(_cities);

var _areas = __webpack_require__(20);

var _areas2 = _interopRequireDefault(_areas);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var area_list = _areas2.default.default;

exports.default = {
    props: ['city', 'zip', 'street'],
    data: function data() {
        return {
            cities: _cities2.default.default,
            source: { city: '', zip: '', street: '' },
            selection: { city: '', area: '', street: '' }
        };
    },
    computed: {
        area_selection_options: function area_selection_options() {
            return isEmpty(this.selection.city) ? '' : area_list[this.selection.city.id];
        }
    },
    methods: {
        refresh_area: function refresh_area() {
            this.selection.area = '';
        },
        unset_street: function unset_street() {
            this.selection.street = '';
            document.querySelector('#vue_input_street').focus();
        }
    },
    beforeMount: function beforeMount() {
        bootstrap(this);
    }
};


function isEmpty(source) {
    return undefined == source || '' == source;
}

function bootstrap(vm) {
    storeSource(vm);
    syncUpSelectionWithSource(vm);
}

function has(item) {
    return !isEmpty(item);
}

function storeSource(vm) {
    vm.source.city = vm.city;
    vm.source.zip = vm.zip;
    vm.source.street = vm.street;
}

function syncUpSelectionWithSource(vm) {
    if (has(vm.source.city)) {
        var cityList = cityObjList();
        vm.selection.city = findByKeyForProperty(vm.source.city, cityList, 'id');
    }

    if (has(vm.source.zip)) {
        vm.selection.area = findByKeyForProperty(vm.source.zip, area_list[vm.selection.city.id], 'zip');
    }

    if (has(vm.source.street)) {
        vm.selection.street = vm.source.street;
    }
}

function cityObjList() {
    var myArray = [];

    var myObj = _cities2.default.default;
    for (var key in myObj) {
        if (key != 'unique') {
            var innerObj = myObj[key].items;
            for (var innerKey in innerObj) {
                if (innerKey != 'unique') {
                    myArray.push(innerObj[innerKey]);
                }
            }
        }
    }
    return myArray;
}

function findByKeyForProperty(key, List, property) {
    var target = List[0];
    for (var i = 0; i < List.length; i++) {
        if (key == List[i][property]) {
            target = List[i];
        }
    }

    return target;
}

/***/ },
/* 9 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _textTable = __webpack_require__(42);

var _textTable2 = _interopRequireDefault(_textTable);

var _deviceCat = __webpack_require__(22);

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
/* 10 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _buttons = __webpack_require__(40);

var _buttons2 = _interopRequireDefault(_buttons);

var _occasions = __webpack_require__(23);

var _occasions2 = _interopRequireDefault(_occasions);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    props: ['source_selected'],
    components: { btnSelector: _buttons2.default },
    data: function data() {
        return {
            list: _occasions2.default.default,
            selected: [],
            sync: false
        };
    },
    watch: {
        'source_selected': function source_selected(list) {
            this.selected = list;
            if (!this.sync) {
                this.sync = true;
                syncUpOriginalOccasions(this);
            }
        }
    },
    methods: {
        updateSelected: function updateSelected(list) {
            this.selected = list;
            this.$emit('update-selected', this.selected);
        }
    },
    beforeMount: function beforeMount() {
        syncUpOriginalOccasions(this);
    }
};


function syncUpOriginalOccasions(component) {
    if (component.source_selected != undefined) {
        var newSelectedList = [];
        for (var i = 0; i < component.source_selected.length; i++) {
            var selectedTitle = component.source_selected[i].title;
            for (var j = 0; j < component.list.length; j++) {
                var itemTitle = component.list[j].title;
                if (selectedTitle == itemTitle) {
                    newSelectedList.push(component.list[j]);
                    break;
                }
            }
        }
        component.updateSelected(newSelectedList);
    }
}

/***/ },
/* 11 */
/***/ function(module, exports) {

"use strict";
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = {
    props: {
        model: {
            type: String,
            required: true
        },
        id: {
            required: true
        },
        filepath: {
            type: String,
            required: false
        },
        field: {
            type: String,
            required: false
        }
    },
    data: function data() {
        return {
            photo: {
                model: '',
                id: '',
                field: '',
                filepath: ''
            },
            photoDir: '\\images\\companyInfo\\',
            fileLoading: false,
            imgSize: {
                height: 0,
                width: 0
            },
            imgId: ''
        };
    },
    methods: {
        handleImgLoad: function handleImgLoad() {
            adjustImgSize(this);
        },
        handleFileChanged: function handleFileChanged(e) {
            e.preventDefault();
            var files = e.target.files;

            if (files.length > 0) {
                doFileUpload(this, files);
            }
        },
        handlePhotoDelete: function handlePhotoDelete() {
            if (confirm('確定刪除圖片?')) {
                doPhotoDelete(this);
            }
        }
    },
    computed: {
        photoPath: function photoPath() {
            return this.photo.filepath == '' ? this.photoDir + 'mainPhoto.jpg' : this.photo.filepath;
        },
        hasPhoto: function hasPhoto() {
            return !this.photo.filepath == '';
        }
    },
    mounted: function mounted() {

        this.photo.model = this.model;
        this.photo.id = this.id;
        this.photo.field = this.field;
        this.photo.filepath = this.filepath ? this.filepath : '';
        this.imgId = 'img-' + new Date().getTime();
    }
};


function generateFormData() {
    var data = new FormData();
    data.append('_token', $('meta[name="csrf-token"]').attr('content'));
    return data;
}

function adjustImgSize(component) {
    var imgEl = $('#' + component.imgId);
    component.imgSize.height = imgEl.height();
    component.imgSize.width = imgEl.width();
}

function doFileUpload(component, files) {
    component.fileLoading = true;
    var data = generateFormData();
    data.append('photofile', files[0]);

    var successCallback = function (response) {
        component.photo.filepath = response.body.filepath;
        component.fileLoading = false;
    }.bind(this);

    var errorCallback = function (response) {
        component.fileLoading = false;
        alert(response);
    }.bind(this);

    var url = '/photo/store/' + component.photo.model + '/' + component.photo.id + '/' + component.photo.field;

    component.$http.post(url, data).then(successCallback, errorCallback);
}

function doPhotoDelete(component) {
    var data = generateFormData();

    var successCallback = function (response) {
        component.photo.filepath = '';
    }.bind(this);

    var errorCallback = function (response) {
        alert(response);
    }.bind(this);

    var url = '/photo/delete/' + component.photo.filepath;

    component.$http.post(url, data).then(successCallback, errorCallback);
}

/***/ },
/* 12 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _specOption = __webpack_require__(38);

var _specOption2 = _interopRequireDefault(_specOption);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    props: ['spec'],
    data: function data() {
        return { title: '', descriptionPrefix: '', id: '', unit: '' };
    },
    components: {
        specOption: _specOption2.default
    },
    methods: {
        validateInput: function validateInput() {
            if (this.descriptionPrefix == '') {
                alert('請輸入規格說明');
                return false;
            }

            return true;
        },
        unset_option: function unset_option() {
            this.descriptionPrefix = '';
        },
        addSpec: function addSpec() {
            if (!this.validateInput()) {
                return;
            }
            var speObj = {
                title: this.title,
                description: this.fullDescription,
                id: this.id
            };
            this.$emit('add-spec', speObj);
        },
        updateDescriptionPrefix: function updateDescriptionPrefix(option) {
            this.descriptionPrefix = option;
        },
        initData: function initData() {
            this.title = this.spec.title;
            this.unit = this.spec.unit;
            this.id = this.title + new Date().getTime();
            this.descriptionPrefix = '';
        }
    },
    computed: {
        fullDescription: function fullDescription() {
            var unit = this.spec.unit == '無單位' ? '' : this.spec.unit;
            return this.descriptionPrefix + unit;
        },
        hasUnit: function hasUnit() {
            return this.unit != '無單位';
        }
    },
    watch: {
        spec: function spec() {
            this.initData();
        }
    },
    mounted: function mounted() {
        this.initData();
    }
};

/***/ },
/* 13 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _oneRefSpec = __webpack_require__(37);

var _oneRefSpec2 = _interopRequireDefault(_oneRefSpec);

var _refSpec = __webpack_require__(24);

var _refSpec2 = _interopRequireDefault(_refSpec);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    data: function data() {
        return {
            refSpec: _refSpec2.default.default,
            selected_device: ''
        };
    },
    components: {
        oneSpec: _oneRefSpec2.default
    },
    methods: {
        addSpec: function addSpec(obj) {
            this.$emit('add-spec', obj);
        }
    }
};

/***/ },
/* 14 */
/***/ function(module, exports) {

"use strict";
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = {
    props: ['option', 'id'],
    data: function data() {
        return { optionValue: '', idValue: '' };
    },
    methods: {
        set_option: function set_option() {
            this.$emit('update-option', this.optionValue);
        },
        initData: function initData() {
            this.optionValue = this.option;
            this.idValue = this.id;
        }
    },
    watch: {
        'option': function option() {
            this.initData();
        }
    },
    mounted: function mounted() {
        this.initData();
    }
};

/***/ },
/* 15 */
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
            var index = this.selected_items.indexOf(this.item);
            return index != -1;
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
    },
    mounted: function mounted() {
        this.selected_items = this.selected_list;
    }
};

/***/ },
/* 16 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _button = __webpack_require__(39);

var _button2 = _interopRequireDefault(_button);

var _mixins = __webpack_require__(0);

var _mixins2 = _interopRequireDefault(_mixins);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    components: {
        oneButton: _button2.default
    },
    mixins: [_mixins2.default]
};

/***/ },
/* 17 */
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
/* 18 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _text = __webpack_require__(41);

var _text2 = _interopRequireDefault(_text);

var _mixins = __webpack_require__(0);

var _mixins2 = _interopRequireDefault(_mixins);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    components: {
        oneText: _text2.default
    },
    mixins: [_mixins2.default]
};

/***/ },
/* 19 */
/***/ function(module, exports) {

"use strict";
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = {
    props: ['sourcebrand'],
    data: function data() {
        return {
            formInput: { brand: '' },
            selectedBrand: ''
        };
    },
    watch: {
        'selectedBrand': function selectedBrand(brand) {
            this.formInput.brand = brand;
        }
    },
    methods: {
        unsetBrand: function unsetBrand() {
            this.formInput.brand = '';
            document.querySelector('#brand').focus();
            this.selectedBrand = '';
        }
    },
    beforeMount: function beforeMount() {
        if (this.sourcebrand) {
            this.formInput.brand = this.sourcebrand;
        }
    }
};

/***/ },
/* 20 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(exports, "default", function() { return area_list; });
var area_list = [];
area_list[1] = [{ "title": "\u4e2d\u6b63\u5340", "zip": "100" }, {
    "title": "\u5927\u540c\u5340",
    "zip": "103"
}, { "title": "\u4e2d\u5c71\u5340", "zip": "104" }, {
    "title": "\u677e\u5c71\u5340",
    "zip": "105"
}, { "title": "\u5927\u5b89\u5340", "zip": "106" }, {
    "title": "\u842c\u83ef\u5340",
    "zip": "108"
}, { "title": "\u4fe1\u7fa9\u5340", "zip": "110" }, {
    "title": "\u58eb\u6797\u5340",
    "zip": "111"
}, { "title": "\u5317\u6295\u5340", "zip": "112" }, {
    "title": "\u5167\u6e56\u5340",
    "zip": "114"
}, { "title": "\u5357\u6e2f\u5340", "zip": "115" }, { "title": "\u6587\u5c71\u5340", "zip": "116" }];

area_list[2] = [{ "title": "\u842c\u91cc\u5340", "zip": "207" }, {
    "title": "\u91d1\u5c71\u5340",
    "zip": "208"
}, { "title": "\u677f\u6a4b\u5340", "zip": "220" }, {
    "title": "\u6c50\u6b62\u5340",
    "zip": "221"
}, { "title": "\u6df1\u5751\u5340", "zip": "222" }, {
    "title": "\u77f3\u7887\u5340",
    "zip": "223"
}, { "title": "\u745e\u82b3\u5340", "zip": "224" }, {
    "title": "\u5e73\u6eaa\u5340",
    "zip": "226"
}, { "title": "\u96d9\u6eaa\u5340", "zip": "227" }, {
    "title": "\u8ca2\u5bee\u5340",
    "zip": "228"
}, { "title": "\u65b0\u5e97\u5340", "zip": "231" }, {
    "title": "\u576a\u6797\u5340",
    "zip": "232"
}, { "title": "\u70cf\u4f86\u5340", "zip": "233" }, {
    "title": "\u6c38\u548c\u5340",
    "zip": "234"
}, { "title": "\u4e2d\u548c\u5340", "zip": "235" }, {
    "title": "\u571f\u57ce\u5340",
    "zip": "236"
}, { "title": "\u4e09\u5cfd\u5340", "zip": "237" }, {
    "title": "\u6a39\u6797\u5340",
    "zip": "238"
}, { "title": "\u9daf\u6b4c\u5340", "zip": "239" }, {
    "title": "\u4e09\u91cd\u5340",
    "zip": "241"
}, { "title": "\u65b0\u838a\u5340", "zip": "242" }, {
    "title": "\u6cf0\u5c71\u5340",
    "zip": "243"
}, { "title": "\u6797\u53e3\u5340", "zip": "244" }, {
    "title": "\u8606\u6d32\u5340",
    "zip": "247"
}, { "title": "\u4e94\u80a1\u5340", "zip": "248" }, {
    "title": "\u516b\u91cc\u5340",
    "zip": "249"
}, { "title": "\u6de1\u6c34\u5340", "zip": "251" }, {
    "title": "\u4e09\u829d\u5340",
    "zip": "252"
}, { "title": "\u77f3\u9580\u5340", "zip": "253" }];

area_list[3] = [{ "title": "\u4ec1\u611b\u5340", "zip": "200" }, {
    "title": "\u4fe1\u7fa9\u5340",
    "zip": "201"
}, { "title": "\u4e2d\u6b63\u5340", "zip": "202" }, {
    "title": "\u4e2d\u5c71\u5340",
    "zip": "203"
}, { "title": "\u5b89\u6a02\u5340", "zip": "204" }, {
    "title": "\u6696\u6696\u5340",
    "zip": "205"
}, { "title": "\u4e03\u5835\u5340", "zip": "206" }];
area_list[4] = [{ "title": "\u5b9c\u862d\u5e02", "zip": "260" }, {
    "title": "\u982d\u57ce\u93ae",
    "zip": "261"
}, { "title": "\u7901\u6eaa\u9109", "zip": "262" }, {
    "title": "\u58ef\u570d\u9109",
    "zip": "263"
}, { "title": "\u54e1\u5c71\u9109", "zip": "264" }, {
    "title": "\u7f85\u6771\u93ae",
    "zip": "265"
}, { "title": "\u4e09\u661f\u9109", "zip": "266" }, {
    "title": "\u5927\u540c\u9109",
    "zip": "267"
}, { "title": "\u4e94\u7d50\u9109", "zip": "268" }, {
    "title": "\u51ac\u5c71\u9109",
    "zip": "269"
}, { "title": "\u8607\u6fb3\u93ae", "zip": "270" }, { "title": "\u5357\u6fb3\u9109", "zip": "272" }];
area_list[5] = [{ "title": "\u5317\u5340", "zip": "300" }, {
    "title": "\u6771\u5340",
    "zip": "300"
}, { "title": "\u9999\u5c71\u5340", "zip": "300" }];
area_list[6] = [{ "title": "\u7af9\u5317\u5e02", "zip": "302" }, {
    "title": "\u6e56\u53e3\u9109",
    "zip": "303"
}, { "title": "\u65b0\u8c50\u9109", "zip": "304" }, {
    "title": "\u65b0\u57d4\u9109",
    "zip": "305"
}, { "title": "\u95dc\u897f\u93ae", "zip": "306" }, {
    "title": "\u828e\u6797\u9109",
    "zip": "307"
}, { "title": "\u5bf6\u5c71\u9109", "zip": "308" }, {
    "title": "\u7af9\u6771\u93ae",
    "zip": "310"
}, { "title": "\u4e94\u5cf0\u9109", "zip": "311" }, {
    "title": "\u6a6b\u5c71\u9109",
    "zip": "312"
}, { "title": "\u5c16\u77f3\u9109", "zip": "313" }, {
    "title": "\u5317\u57d4\u9109",
    "zip": "314"
}, { "title": "\u5ce8\u7709\u9109", "zip": "315" }];
area_list[7] = [{ "title": "\u4e2d\u58e2\u5e02", "zip": "320" }, {
    "title": "\u5e73\u93ae\u5e02",
    "zip": "324"
}, { "title": "\u9f8d\u6f6d\u9109", "zip": "325" }, {
    "title": "\u694a\u6885\u93ae",
    "zip": "326"
}, { "title": "\u65b0\u5c4b\u9109", "zip": "327" }, {
    "title": "\u89c0\u97f3\u9109",
    "zip": "328"
}, { "title": "\u6843\u5712\u5e02", "zip": "330" }, {
    "title": "\u9f9c\u5c71\u9109",
    "zip": "333"
}, { "title": "\u516b\u5fb7\u5e02", "zip": "334" }, {
    "title": "\u5927\u6eaa\u93ae",
    "zip": "335"
}, { "title": "\u5fa9\u8208\u9109", "zip": "336" }, {
    "title": "\u5927\u5712\u9109",
    "zip": "337"
}, { "title": "\u8606\u7af9\u9109", "zip": "338" }];
area_list[8] = [{ "title": "\u7af9\u5357\u93ae", "zip": "350" }, {
    "title": "\u982d\u4efd\u93ae",
    "zip": "351"
}, { "title": "\u4e09\u7063\u9109", "zip": "352" }, {
    "title": "\u5357\u5e84\u9109",
    "zip": "353"
}, { "title": "\u7345\u6f6d\u9109", "zip": "354" }, {
    "title": "\u5f8c\u9f8d\u93ae",
    "zip": "356"
}, { "title": "\u901a\u9704\u93ae", "zip": "357" }, {
    "title": "\u82d1\u88e1\u93ae",
    "zip": "358"
}, { "title": "\u82d7\u6817\u5e02", "zip": "360" }, {
    "title": "\u9020\u6a4b\u9109",
    "zip": "361"
}, { "title": "\u982d\u5c4b\u9109", "zip": "362" }, {
    "title": "\u516c\u9928\u9109",
    "zip": "363"
}, { "title": "\u5927\u6e56\u9109", "zip": "364" }, {
    "title": "\u6cf0\u5b89\u9109",
    "zip": "365"
}, { "title": "\u9285\u947c\u9109", "zip": "366" }, {
    "title": "\u4e09\u7fa9\u9109",
    "zip": "367"
}, { "title": "\u897f\u6e56\u9109", "zip": "368" }, { "title": "\u5353\u862d\u93ae", "zip": "369" }];
area_list[9] = [{ "title": "\u4e2d\u5340", "zip": "400" }, {
    "title": "\u6771\u5340",
    "zip": "401"
}, { "title": "\u5357\u5340", "zip": "402" }, { "title": "\u897f\u5340", "zip": "403" }, {
    "title": "\u5317\u5340",
    "zip": "404"
}, { "title": "\u5317\u5c6f\u5340", "zip": "406" }, {
    "title": "\u897f\u5c6f\u5340",
    "zip": "407"
}, { "title": "\u5357\u5c6f\u5340", "zip": "408" }, {
    "title": "\u592a\u5e73\u5340",
    "zip": "411"
}, { "title": "\u5927\u91cc\u5340", "zip": "412" }, {
    "title": "\u9727\u5cf0\u5340",
    "zip": "413"
}, { "title": "\u70cf\u65e5\u5340", "zip": "414" }, {
    "title": "\u8c50\u539f\u5340",
    "zip": "420"
}, { "title": "\u540e\u91cc\u5340", "zip": "421" }, {
    "title": "\u77f3\u5ca1\u5340",
    "zip": "422"
}, { "title": "\u6771\u52e2\u5340", "zip": "423" }, {
    "title": "\u548c\u5e73\u5340",
    "zip": "424"
}, { "title": "\u65b0\u793e\u5340", "zip": "426" }, {
    "title": "\u6f6d\u5b50\u5340",
    "zip": "427"
}, { "title": "\u5927\u96c5\u5340", "zip": "428" }, {
    "title": "\u795e\u5ca1\u5340",
    "zip": "429"
}, { "title": "\u5927\u809a\u5340", "zip": "432" }, {
    "title": "\u6c99\u9e7f\u5340",
    "zip": "433"
}, { "title": "\u9f8d\u4e95\u5340", "zip": "434" }, {
    "title": "\u68a7\u68f2\u5340",
    "zip": "435"
}, { "title": "\u6e05\u6c34\u5340", "zip": "436" }, {
    "title": "\u5927\u7532\u5340",
    "zip": "437"
}, { "title": "\u5916\u57d4\u5340", "zip": "438" }, { "title": "\u5927\u5b89\u5340", "zip": "439" }];
area_list[10] = [{ "title": "\u5f70\u5316\u5e02", "zip": "500" }, {
    "title": "\u82ac\u5712\u9109",
    "zip": "502"
}, { "title": "\u82b1\u58c7\u9109", "zip": "503" }, {
    "title": "\u79c0\u6c34\u9109",
    "zip": "504"
}, { "title": "\u9e7f\u6e2f\u93ae", "zip": "505" }, {
    "title": "\u798f\u8208\u9109",
    "zip": "506"
}, { "title": "\u7dda\u897f\u9109", "zip": "507" }, {
    "title": "\u548c\u7f8e\u93ae",
    "zip": "508"
}, { "title": "\u4f38\u6e2f\u9109", "zip": "509" }, {
    "title": "\u54e1\u6797\u93ae",
    "zip": "510"
}, { "title": "\u793e\u982d\u9109", "zip": "511" }, {
    "title": "\u6c38\u9756\u9109",
    "zip": "512"
}, { "title": "\u57d4\u5fc3\u9109", "zip": "513" }, {
    "title": "\u6eaa\u6e56\u93ae",
    "zip": "514"
}, { "title": "\u5927\u6751\u9109", "zip": "515" }, {
    "title": "\u57d4\u9e7d\u9109",
    "zip": "516"
}, { "title": "\u7530\u4e2d\u93ae", "zip": "520" }, {
    "title": "\u5317\u6597\u93ae",
    "zip": "521"
}, { "title": "\u7530\u5c3e\u9109", "zip": "522" }, {
    "title": "\u57e4\u982d\u9109",
    "zip": "523"
}, { "title": "\u6eaa\u5dde\u9109", "zip": "524" }, {
    "title": "\u7af9\u5858\u9109",
    "zip": "525"
}, { "title": "\u4e8c\u6797\u93ae", "zip": "526" }, {
    "title": "\u5927\u57ce\u9109",
    "zip": "527"
}, { "title": "\u82b3\u82d1\u9109", "zip": "528" }, { "title": "\u4e8c\u6c34\u9109", "zip": "530" }];
area_list[11] = [{ "title": "\u5357\u6295\u5e02", "zip": "540" }, {
    "title": "\u4e2d\u5bee\u9109",
    "zip": "541"
}, { "title": "\u8349\u5c6f\u93ae", "zip": "542" }, {
    "title": "\u570b\u59d3\u9109",
    "zip": "544"
}, { "title": "\u57d4\u91cc\u93ae", "zip": "545" }, {
    "title": "\u4ec1\u611b\u9109",
    "zip": "546"
}, { "title": "\u540d\u9593\u9109", "zip": "551" }, {
    "title": "\u96c6\u96c6\u93ae",
    "zip": "552"
}, { "title": "\u6c34\u91cc\u9109", "zip": "553" }, {
    "title": "\u9b5a\u6c60\u9109",
    "zip": "555"
}, { "title": "\u4fe1\u7fa9\u9109", "zip": "556" }, {
    "title": "\u7af9\u5c71\u93ae",
    "zip": "557"
}, { "title": "\u9e7f\u8c37\u9109", "zip": "558" }];
area_list[12] = [{ "title": "\u897f\u5340", "zip": "600" }, { "title": "\u6771\u5340", "zip": "600" }];
area_list[13] = [{ "title": "\u756a\u8def\u9109", "zip": "602" }, {
    "title": "\u6885\u5c71\u9109",
    "zip": "603"
}, { "title": "\u7af9\u5d0e\u9109", "zip": "604" }, {
    "title": "\u963f\u91cc\u5c71\u9109",
    "zip": "605"
}, { "title": "\u4e2d\u57d4\u9109", "zip": "606" }, {
    "title": "\u5927\u57d4\u9109",
    "zip": "607"
}, { "title": "\u6c34\u4e0a\u9109", "zip": "608" }, {
    "title": "\u9e7f\u8349\u9109",
    "zip": "611"
}, { "title": "\u592a\u4fdd\u5e02", "zip": "612" }, {
    "title": "\u6734\u5b50\u5e02",
    "zip": "613"
}, { "title": "\u6771\u77f3\u9109", "zip": "614" }, {
    "title": "\u516d\u8173\u9109",
    "zip": "615"
}, { "title": "\u65b0\u6e2f\u9109", "zip": "616" }, {
    "title": "\u6c11\u96c4\u9109",
    "zip": "621"
}, { "title": "\u5927\u6797\u93ae", "zip": "622" }, {
    "title": "\u6eaa\u53e3\u9109",
    "zip": "623"
}, { "title": "\u7fa9\u7af9\u9109", "zip": "624" }, { "title": "\u5e03\u888b\u93ae", "zip": "625" }];
area_list[14] = [{ "title": "\u6597\u5357\u93ae", "zip": "630" }, {
    "title": "\u5927\u57e4\u9109",
    "zip": "631"
}, { "title": "\u864e\u5c3e\u93ae", "zip": "632" }, {
    "title": "\u571f\u5eab\u93ae",
    "zip": "633"
}, { "title": "\u8912\u5fe0\u9109", "zip": "634" }, {
    "title": "\u6771\u52e2\u9109",
    "zip": "635"
}, { "title": "\u53f0\u897f\u9109", "zip": "636" }, {
    "title": "\u5d19\u80cc\u9109",
    "zip": "637"
}, { "title": "\u9ea5\u5bee\u9109", "zip": "638" }, {
    "title": "\u6597\u516d\u5e02",
    "zip": "640"
}, { "title": "\u6797\u5167\u9109", "zip": "643" }, {
    "title": "\u53e4\u5751\u9109",
    "zip": "646"
}, { "title": "\u83bf\u6850\u9109", "zip": "647" }, {
    "title": "\u897f\u87ba\u93ae",
    "zip": "648"
}, { "title": "\u4e8c\u5d19\u9109", "zip": "649" }, {
    "title": "\u5317\u6e2f\u93ae",
    "zip": "651"
}, { "title": "\u6c34\u6797\u9109", "zip": "652" }, {
    "title": "\u53e3\u6e56\u9109",
    "zip": "653"
}, { "title": "\u56db\u6e56\u9109", "zip": "654" }, { "title": "\u5143\u9577\u9109", "zip": "655" }];
area_list[15] = [{ "title": "\u4e2d\u897f\u5340", "zip": "700" }, {
    "title": "\u6771\u5340",
    "zip": "701"
}, { "title": "\u5357\u5340", "zip": "702" }, { "title": "\u5317\u5340", "zip": "704" }, {
    "title": "\u5b89\u5e73\u5340",
    "zip": "708"
}, { "title": "\u5b89\u5357\u5340", "zip": "709" }, {
    "title": "\u6c38\u5eb7\u5340",
    "zip": "710"
}, { "title": "\u6b78\u4ec1\u5340", "zip": "711" }, {
    "title": "\u65b0\u5316\u5340",
    "zip": "712"
}, { "title": "\u5de6\u93ae\u5340", "zip": "713" }, {
    "title": "\u7389\u4e95\u5340",
    "zip": "714"
}, { "title": "\u6960\u897f\u5340", "zip": "715" }, {
    "title": "\u5357\u5316\u5340",
    "zip": "716"
}, { "title": "\u4ec1\u5fb7\u5340", "zip": "717" }, {
    "title": "\u95dc\u5edf\u5340",
    "zip": "718"
}, { "title": "\u9f8d\u5d0e\u5340", "zip": "719" }, {
    "title": "\u5b98\u7530\u5340",
    "zip": "720"
}, { "title": "\u9ebb\u8c46\u5340", "zip": "721" }, {
    "title": "\u4f73\u91cc\u5340",
    "zip": "722"
}, { "title": "\u897f\u6e2f\u5340", "zip": "723" }, {
    "title": "\u4e03\u80a1\u5340",
    "zip": "724"
}, { "title": "\u5c07\u8ecd\u5340", "zip": "725" }, {
    "title": "\u5b78\u7532\u5340",
    "zip": "726"
}, { "title": "\u5317\u9580\u5340", "zip": "727" }, {
    "title": "\u65b0\u71df\u5340",
    "zip": "730"
}, { "title": "\u5f8c\u58c1\u5340", "zip": "731" }, {
    "title": "\u767d\u6cb3\u5340",
    "zip": "732"
}, { "title": "\u6771\u5c71\u5340", "zip": "733" }, {
    "title": "\u516d\u7532\u5340",
    "zip": "734"
}, { "title": "\u4e0b\u71df\u5340", "zip": "735" }, {
    "title": "\u67f3\u71df\u5340",
    "zip": "736"
}, { "title": "\u9e7d\u6c34\u5340", "zip": "737" }, {
    "title": "\u5584\u5316\u5340",
    "zip": "741"
}, { "title": "\u5927\u5167\u5340", "zip": "742" }, {
    "title": "\u5c71\u4e0a\u5340",
    "zip": "743"
}, { "title": "\u65b0\u5e02\u5340", "zip": "744" }, { "title": "\u5b89\u5b9a\u5340", "zip": "745" }];
area_list[16] = [{ "title": "\u65b0\u8208\u5340", "zip": "800" }, {
    "title": "\u524d\u91d1\u5340",
    "zip": "801"
}, { "title": "\u82d3\u96c5\u5340", "zip": "802" }, {
    "title": "\u9e7d\u57d5\u5340",
    "zip": "803"
}, { "title": "\u9f13\u5c71\u5340", "zip": "804" }, {
    "title": "\u65d7\u6d25\u5340",
    "zip": "805"
}, { "title": "\u524d\u93ae\u5340", "zip": "806" }, {
    "title": "\u4e09\u6c11\u5340",
    "zip": "807"
}, { "title": "\u6960\u6893\u5340", "zip": "811" }, {
    "title": "\u5c0f\u6e2f\u5340",
    "zip": "812"
}, { "title": "\u5de6\u71df\u5340", "zip": "813" }, {
    "title": "\u4ec1\u6b66\u5340",
    "zip": "814"
}, { "title": "\u5927\u793e\u5340", "zip": "815" }, {
    "title": "\u5ca1\u5c71\u5340",
    "zip": "820"
}, { "title": "\u8def\u7af9\u5340", "zip": "821" }, {
    "title": "\u963f\u84ee\u5340",
    "zip": "822"
}, { "title": "\u7530\u5bee\u5340", "zip": "823" }, {
    "title": "\u71d5\u5de2\u5340",
    "zip": "824"
}, { "title": "\u6a4b\u982d\u5340", "zip": "825" }, {
    "title": "\u6893\u5b98\u5340",
    "zip": "826"
}, { "title": "\u5f4c\u9640\u5340", "zip": "827" }, {
    "title": "\u6c38\u5b89\u5340",
    "zip": "828"
}, { "title": "\u6e56\u5167\u5340", "zip": "829" }, {
    "title": "\u9cf3\u5c71\u5340",
    "zip": "830"
}, { "title": "\u5927\u5bee\u5340", "zip": "831" }, {
    "title": "\u6797\u5712\u5340",
    "zip": "832"
}, { "title": "\u9ce5\u677e\u5340", "zip": "833" }, {
    "title": "\u5927\u6a39\u5340",
    "zip": "840"
}, { "title": "\u65d7\u5c71\u5340", "zip": "842" }, {
    "title": "\u7f8e\u6fc3\u5340",
    "zip": "843"
}, { "title": "\u516d\u9f9c\u5340", "zip": "844" }, {
    "title": "\u5167\u9580\u5340",
    "zip": "845"
}, { "title": "\u6749\u6797\u5340", "zip": "846" }, {
    "title": "\u7532\u4ed9\u5340",
    "zip": "847"
}, { "title": "\u6843\u6e90", "zip": "848" }, {
    "title": "\u90a3\u746a\u590f\u5340",
    "zip": "849"
}, { "title": "\u8302\u6797\u5340", "zip": "851" }, { "title": "\u8304\u8423\u5340", "zip": "852" }];
area_list[17] = [{ "title": "\u99ac\u516c\u5e02", "zip": "880" }, {
    "title": "\u897f\u5dbc\u9109",
    "zip": "881"
}, { "title": "\u671b\u5b89\u9109", "zip": "882" }, {
    "title": "\u4e03\u7f8e\u9109",
    "zip": "883"
}, { "title": "\u767d\u6c99\u9109", "zip": "884" }, { "title": "\u6e56\u897f\u9109", "zip": "885" }];
area_list[18] = [{ "title": "\u5c4f\u6771\u5e02", "zip": "900" }, {
    "title": "\u4e09\u5730\u9580",
    "zip": "901"
}, { "title": "\u9727\u81fa\u9109", "zip": "902" }, {
    "title": "\u746a\u5bb6\u9109",
    "zip": "903"
}, { "title": "\u4e5d\u5982\u9109", "zip": "904" }, {
    "title": "\u91cc\u6e2f\u9109",
    "zip": "905"
}, { "title": "\u9ad8\u6a39\u9109", "zip": "906" }, {
    "title": "\u76ec\u57d4\u9109",
    "zip": "907"
}, { "title": "\u9577\u6cbb\u9109", "zip": "908" }, {
    "title": "\u9e9f\u6d1b\u9109",
    "zip": "909"
}, { "title": "\u7af9\u7530\u9109", "zip": "911" }, {
    "title": "\u5167\u57d4\u9109",
    "zip": "912"
}, { "title": "\u842c\u4e39\u9109", "zip": "913" }, {
    "title": "\u6f6e\u5dde\u93ae",
    "zip": "920"
}, { "title": "\u6cf0\u6b66\u9109", "zip": "921" }, {
    "title": "\u4f86\u7fa9\u9109",
    "zip": "922"
}, { "title": "\u842c\u5dd2\u9109", "zip": "923" }, {
    "title": "\u5d01\u9802\u9109",
    "zip": "924"
}, { "title": "\u65b0\u57e4\u9109", "zip": "925" }, {
    "title": "\u5357\u5dde\u9109",
    "zip": "926"
}, { "title": "\u6797\u908a\u9109", "zip": "927" }, {
    "title": "\u6771\u6e2f\u93ae",
    "zip": "928"
}, { "title": "\u7409\u7403\u9109", "zip": "929" }, {
    "title": "\u4f73\u51ac\u9109",
    "zip": "931"
}, { "title": "\u65b0\u5712\u9109", "zip": "932" }, {
    "title": "\u678b\u5bee\u9109",
    "zip": "940"
}, { "title": "\u678b\u5c71\u9109", "zip": "941" }, {
    "title": "\u6625\u65e5\u9109",
    "zip": "942"
}, { "title": "\u7345\u5b50\u9109", "zip": "943" }, {
    "title": "\u8eca\u57ce\u9109",
    "zip": "944"
}, { "title": "\u7261\u4e39\u9109", "zip": "945" }, {
    "title": "\u6046\u6625\u93ae",
    "zip": "946"
}, { "title": "\u6eff\u5dde\u9109", "zip": "947" }];
area_list[19] = [{ "title": "\u53f0\u6771\u5e02", "zip": "950" }, {
    "title": "\u7da0\u5cf6\u9109",
    "zip": "951"
}, { "title": "\u862d\u5dbc\u9109", "zip": "952" }, {
    "title": "\u5ef6\u5e73\u9109",
    "zip": "953"
}, { "title": "\u5351\u5357\u9109", "zip": "954" }, {
    "title": "\u9e7f\u91ce\u9109",
    "zip": "955"
}, { "title": "\u95dc\u5c71\u93ae", "zip": "956" }, {
    "title": "\u6d77\u7aef\u9109",
    "zip": "957"
}, { "title": "\u6c60\u4e0a\u9109", "zip": "958" }, {
    "title": "\u6771\u6cb3\u9109",
    "zip": "959"
}, { "title": "\u6210\u529f\u93ae", "zip": "961" }, {
    "title": "\u9577\u6ff1\u9109",
    "zip": "962"
}, { "title": "\u592a\u9ebb\u91cc", "zip": "963" }, {
    "title": "\u91d1\u5cf0\u9109",
    "zip": "964"
}, { "title": "\u5927\u6b66\u9109", "zip": "965" }, { "title": "\u9054\u4ec1\u9109", "zip": "966" }];
area_list[20] = [{ "title": "\u82b1\u84ee\u5e02", "zip": "970" }, {
    "title": "\u65b0\u57ce\u9109",
    "zip": "971"
}, { "title": "\u79c0\u6797\u9109", "zip": "972" }, {
    "title": "\u5409\u5b89\u9109",
    "zip": "973"
}, { "title": "\u58fd\u8c50\u9109", "zip": "974" }, {
    "title": "\u9cf3\u6797\u93ae",
    "zip": "975"
}, { "title": "\u5149\u5fa9\u9109", "zip": "976" }, {
    "title": "\u8c50\u6ff1\u9109",
    "zip": "977"
}, { "title": "\u745e\u7a57\u9109", "zip": "978" }, {
    "title": "\u842c\u69ae\u9109",
    "zip": "979"
}, { "title": "\u7389\u91cc\u93ae", "zip": "981" }, {
    "title": "\u5353\u6eaa\u9109",
    "zip": "982"
}, { "title": "\u5bcc\u91cc\u9109", "zip": "983" }];
area_list[21] = [{ "title": "\u91d1\u6c99", "zip": "890" }, {
    "title": "\u91d1\u6e56",
    "zip": "891"
}, { "title": "\u91d1\u5be7", "zip": "892" }, { "title": "\u91d1\u57ce", "zip": "893" }, {
    "title": "\u70c8\u5dbc",
    "zip": "894"
}, { "title": "\u70cf\u5775", "zip": "896" }];
area_list[22] = [{ "title": "\u5357\u7aff", "zip": "209" }, {
    "title": "\u5317\u7aff",
    "zip": "210"
}, { "title": "\u8392\u5149", "zip": "211" }, { "title": "\u6771\u5f15", "zip": "212" }];



/***/ },
/* 21 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(exports, "default", function() { return items; });
var items = [{
    district: "\u5317\u90e8",
    items: [{ "id": 1, "title": "\u53f0\u5317\u5e02" }, { "id": 2, "title": "\u65b0\u5317\u5e02" }, {
        "id": 3,
        "title": "\u57fa\u9686\u5e02"
    }, { "id": 4, "title": "\u5b9c\u862d\u7e23" }, { "id": 5, "title": "\u65b0\u7af9\u5e02" }, {
        "id": 6,
        "title": "\u65b0\u7af9\u7e23"
    }, { "id": 7, "title": "\u6843\u5712\u7e23" }]
}, {
    district: "\u4e2d\u90e8",
    items: [{ "id": 8, "title": "\u82d7\u6817\u7e23" }, { "id": 9, "title": "\u53f0\u4e2d\u5e02" }, {
        "id": 10,
        "title": "\u5f70\u5316\u7e23"
    }, { "id": 11, "title": "\u5357\u6295\u7e23" }, { "id": 14, "title": "\u96f2\u6797\u7e23" }]
}, {
    district: "\u5357\u90e8",
    items: [{ "id": 12, "title": "\u5609\u7fa9\u5e02" }, { "id": 13, "title": "\u5609\u7fa9\u7e23" }, {
        "id": 15,
        "title": "\u53f0\u5357\u5e02"
    }, { "id": 16, "title": "\u9ad8\u96c4\u5e02" }, { "id": 18, "title": "\u5c4f\u6771\u7e23" }]
}, {
    district: "\u6771\u90e8",
    items: [{ "id": 17, "title": "\u6f8e\u6e56\u7e23" }, { "id": 19, "title": "\u53f0\u6771\u7e23" }, {
        "id": 20,
        "title": "\u82b1\u84ee\u7e23"
    }, { "id": 21, "title": "\u91d1\u9580\u7e23" }, { "id": 22, "title": "\u9023\u6c5f\u7e23" }]
}];



/***/ },
/* 22 */
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
/* 23 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(exports, "default", function() { return occasions; });
var occasions = [{ "id": 1, "title": "\u5496\u5561\u5ef3" }, { "id": 2, "title": "\u9eb5\u5e97" }, {
    "id": 3,
    "title": "\u4e2d\u9910"
}, { "id": 4, "title": "\u897f\u9910" }, { "id": 5, "title": "\u65e5\u672c\u6599\u7406" }, {
    "id": 6,
    "title": "\u6e2f\u5f0f\u98f2\u8336"
}, { "id": 7, "title": "\u706b\u934b\u5e97" }, { "id": 8, "title": "\u5feb\u7092\u5e97" }, {
    "id": 9,
    "title": "\u70b8\u96de\u6392"
}, { "id": 10, "title": "\u81ed\u8c46\u8150" }, { "id": 11, "title": "\u5c0f\u5403\u5e97" }, {
    "id": 12,
    "title": "\u7fa9\u5927\u5229\u9eb5"
}, { "id": 13, "title": "\u65e9\u9910\u5e97" }, { "id": 14, "title": "\u884c\u52d5\u9910\u8eca" }, {
    "id": 15,
    "title": "\u4e00\u822c\u5bb6\u5ead"
}, { "id": 16, "title": "\u5927\u578b\u5eda\u623f" }];



/***/ },
/* 24 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(exports, "default", function() { return ref_specs; });
var ref_specs = [{
    title: '冰箱',
    specs: [{
        title: '冰冷效果',
        unit: '無單位',
        options: ['全冷凍', '全冷藏', '半凍半藏']
    }, {
        title: '冷卻效果',
        unit: '無單位',
        options: ['管冷', '風冷']
    }, {
        title: '壓縮機品牌',
        unit: '無單位',
        options: ['黑金剛', '愛惠普']
    }]
}, {
    title: '咖啡機',
    specs: [{
        title: '孔數', unit: '孔',
        options: [1, 2, 3]
    }, {
        title: '功率',
        unit: '瓦(w)',
        options: [50, 100, 150, 200, 500]
    }]
}, {
    title: '製冰機',
    specs: [{
        title: '磅數', unit: '磅',
        options: [150, 200, 300]
    }, {
        title: '容量', unit: '公升(L)',
        options: [20, 30, 40, 50, 60]
    }]
}];



/***/ },
/* 25 */
/***/ function(module, exports) {

module.exports = "\n\n\n\n\n\n\n\n\n\n\n<div class=\"form-horizontal\">\n    <div class=\"form-group\">\n        <label class=\"col-sm-2 control-label\">\n            <span class=\"text-danger\">*</span>縣市/區\n        </label>\n\n        <div class=\"col-sm-3\">\n            <input type=\"text\"\n                   class=\"hidden\"\n                   name=\"city\"\n                   v-model=\"selection.city.id\">\n\n            <select class=\"form-control\"\n                    v-model=\"selection.city\"\n                    @change=\"refresh_area\"\n                    required>\n                <option value=\"\" data-default>選擇縣市</option>\n                <optgroup v-for=\"district in cities\"\n                          :label=\"district.district\">\n                    <option v-for=\"city in district.items\"\n                            :value=\"city\">\n                        {{city.title }}\n                    </option>\n                </optgroup>\n            </select>\n        </div>\n\n        <div class=\"col-sm-3\">\n            <input type=\"text\" class=\"hidden\"\n                   name=\"zip\"\n                   v-model=\"selection.area.zip\">\n            <select class=\"form-control\"\n                    title=\"選擇區域\"\n                    v-model=\"selection.area\"\n                    required>\n                <option value=\"\">選擇區域</option>\n                <option v-for=\"area in area_selection_options\"\n                        :value=\"area\">\n                    {{ area.title }}\n                </option>\n            </select>\n        </div>\n    </div>\n\n    <div class=\"form-group\">\n        <label class=\"col-sm-2 control-label\">\n            <span class=\"text-danger\">*</span>地址\n        </label>\n\n        <div class=\"col-sm-10\">\n            <input type=\"text\"\n                   name=\"street\"\n                   id=\"vue_input_street\"\n                   class=\"form-control\"\n                   v-model=\"selection.street\"\n                   placeholder=\"道路名稱與門牌號碼\" required>\n            <button class=\"btn btn-info btn-xs\"\n                    @click.prevent=\"unset_street\">重設\n            </button>\n        </div>\n    </div>\n</div>\n";

/***/ },
/* 26 */
/***/ function(module, exports) {

module.exports = "\n\n\n\n\n\n\n\n\n\n<div>\n    <text-table\n            :source=\"list\"\n            :source-selected=\"selected_list\"\n            max-qty=\"1\"\n            @update-selected=\"updateCat\">\n    </text-table>\n</div>\n";

/***/ },
/* 27 */
/***/ function(module, exports) {

module.exports = "\n\n\n\n\n\n\n\n\n\n\n\n\n\n<div>\n    <btn-selector :source=\"list\"\n                  :source_selected=\"selected\"\n                  maxqty=\"unlimited\"\n                  @update-selected=\"updateSelected\">\n    </btn-selector>\n</div>\n";

/***/ },
/* 28 */
/***/ function(module, exports) {

module.exports = "\n<div class=\"full-width\"\n     style=\"position:relative;\">\n\n    <input type=\"file\"\n           style=\"\n            position:absolute;top:0;left:0;\n            z-index:400;opacity:0;\"\n           @change=\"handleFileChanged\"\n           :style=\"{height:imgSize.height+'px',width:imgSize.width+'px'}\">\n\n    <img :src=\"photoPath\" class=\"full-width\"\n         :id=\"imgId\"\n         @load=\"handleImgLoad\">\n\n    <div v-show=\"fileLoading\"\n         style=\"\n         position: absolute;left:0px; top:0px; width: 100%;height:100%;\n        background-color:white;\n        z-index:10\">\n        <span style=\"position: absolute;left:30%;top:30%;\">\n            <i class=\"fa fa-spinner fa-pulse fa-5x\"></i> <br/>檔案上傳中\n        </span>\n    </div>\n\n    <span class=\"btn btn-danger btn-xs\"\n          @click=\"handlePhotoDelete\"\n          style=\"position: absolute;\n                  top:5px;left:5px; z-index:450;\"\n          v-show=\"hasPhoto\">\n        <i class=\"fa fa-trash-o\"></i>&nbsp;刪除圖片\n    </span>\n</div>\n";

/***/ },
/* 29 */
/***/ function(module, exports) {

module.exports = "\n<div>\n    <div class=\"input-group\">\n        <span class=\"input-group-addon\" id=\"\">{{ spec.title }}</span>\n        <input type=\"text\"\n               class=\"form-control\"\n               v-model=\"descriptionPrefix\"\n               placeholder=\"規格說明\"\n                >\n        <span class=\"input-group-addon\" v-show=\"hasUnit\" v-cloak=\"\">{{ spec.unit }}</span>\n        <span class=\"input-group-addon\" @click=\"addSpec\"><span class=\"text-danger\">加入</span></span>\n    </div>\n    <div style=\"background: lightgoldenrodyellow\">\n        參考選項:\n        <spec-option v-for=\"option in spec.options\"\n                     :option=\"option\"\n                     :id=\"id\"\n                     @update-option=\"updateDescriptionPrefix\"\n                >\n        </spec-option>\n        <button class=\"btn btn-success btn-xs\"\n                @click.prevent=\"unset_option\">重設\n        </button>\n    </div>\n    <br>\n</div>\n";

/***/ },
/* 30 */
/***/ function(module, exports) {

module.exports = "\n<div>\n    <h5 class=\"text-danger\">規格小幫手:(1)選擇設備->(2)點選規格->(3)加入</h5>\n\n    <div class=\"input-group\">\n        <span class=\"input-group-addon\" style=\"background: #3073ae;color:white\">\n            常見設備\n        </span>\n        <select class=\"form-control\"\n                v-model=\"selected_device\">\n            <option value=\"\">選擇設備</option>\n            <option v-for=\"device in refSpec\"\n                    :value=\"device\">\n                {{ device.title }}\n            </option>\n        </select>\n    </div>\n    <br>\n    <one-spec v-for=\"spec in selected_device.specs\"\n              :spec=\"spec\"\n              @add-spec=\"addSpec\">\n    </one-spec>\n</div>\n";

/***/ },
/* 31 */
/***/ function(module, exports) {

module.exports = "\n<span>\n    <label>\n        <input type=\"radio\"\n               :value=\"optionValue\"\n               :name=\"idValue\"\n               @click=\"set_option\">{{ optionValue }}\n    </label> &nbsp;\n</span>\n";

/***/ },
/* 32 */
/***/ function(module, exports) {

module.exports = "\n<span>\n    <button class=\"btn btn-default\"\n            :class=\"{'btn-warning':isInSelectedList}\"\n            @click.prevent=\"toggleSelected\"\n            style=\"margin-right:5px;\">\n        {{item.title}}\n    </button>\n</span>\n";

/***/ },
/* 33 */
/***/ function(module, exports) {

module.exports = "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n<span>\n    <one-button v-for=\"item in list\"\n                :item=\"item\"\n                :selected_list=\"selected_list\"\n                @update-selected=\"updateSelected\"\n                @remove-selected=\"removeSelected\">\n    </one-button>\n</span>\n";

/***/ },
/* 34 */
/***/ function(module, exports) {

module.exports = "\n<span>\n    <span class=\"text-underline rwd-text-20\"\n          :class=\"{'text-danger':isInSelectedList}\"\n          @click=\"toggleSelected\"\n          style=\"margin-right:5px;\">\n        {{item.title}}\n    </span>\n</span>\n";

/***/ },
/* 35 */
/***/ function(module, exports) {

module.exports = "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n<table>\n    <thead>\n    <tr>\n        <th style=\"width: 20%\"></th>\n        <th style=\"width: 80%\"></th>\n    </tr>\n    </thead>\n    <tbody>\n    <tr v-for=\"row in list\">\n        <td class=\"text-center vertical-top rwd-text-20\">{{ row.title }}</td>\n        <td>\n            <one-text v-for=\"item in row.items\"\n                      :item=\"item\"\n                      :selected_list=\"selected_list\"\n                      @update-selected=\"updateSelected\"\n                      @remove-selected=\"removeSelected\"></one-text>\n        </td>\n    </tr>\n    </tbody>\n</table>\n";

/***/ },
/* 36 */
/***/ function(module, exports) {

module.exports = "\n<div>\n    <div class=\"form-group\">\n        <label class=\"col-sm-2 control-label\">\n            <span class=\"text-danger\">*</span> 品牌\n        </label>\n\n        <div class=\"col-sm-5\">\n            <input type=\"text\"\n                   class=\"form-control\"\n                   id=\"brand\"\n                   name=\"brand\"\n                   placeholder=\"輸入設備品牌\"\n                   v-model=\"formInput.brand\"\n                   required>\n            <button class=\"btn btn-info btn-xs\"\n                    @click.prevent=\"unsetBrand\">重設/自行輸入\n            </button>\n        </div>\n\n        <div class=\"col-sm-3\">\n            <select name=\"\"\n                    class=\"form-control\"\n                    v-model=\"selectedBrand\"\n                    >\n                <option value=\"\">選擇品牌</option>\n                <option>一般品牌</option>\n                <optgroup label=\"冰箱\">\n                    <option value=\"東元\">東元</option>\n                    <option value=\"聲寶\">聲寶</option>\n                </optgroup>\n                <optgroup label=\"咖啡機\">\n                    <option value=\"惠而浦\">惠而浦</option>\n                    <option value=\"望高寮\">望高寮</option>\n                </optgroup>\n            </select>\n        </div>\n    </div>\n</div>\n";

/***/ },
/* 37 */
/***/ function(module, exports, __webpack_require__) {

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(12)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\app\\refSpecs\\oneRefSpec.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(29)
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
  var id = "_v-111cf222/oneRefSpec.vue"
  if (!module.hot.data) {
    hotAPI.createRecord(id, module.exports)
  } else {
    hotAPI.update(id, module.exports, __vue_template__)
  }
})()}

/***/ },
/* 38 */
/***/ function(module, exports, __webpack_require__) {

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(14)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\app\\refSpecs\\specOption.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(31)
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
  var id = "_v-0ee1d957/specOption.vue"
  if (!module.hot.data) {
    hotAPI.createRecord(id, module.exports)
  } else {
    hotAPI.update(id, module.exports, __vue_template__)
  }
})()}

/***/ },
/* 39 */
/***/ function(module, exports, __webpack_require__) {

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(15)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\selectors\\button.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(32)
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
  var id = "_v-3ef612c2/button.vue"
  if (!module.hot.data) {
    hotAPI.createRecord(id, module.exports)
  } else {
    hotAPI.update(id, module.exports, __vue_template__)
  }
})()}

/***/ },
/* 40 */
/***/ function(module, exports, __webpack_require__) {

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(16)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\selectors\\buttons.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(33)
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
  var id = "_v-33c57e64/buttons.vue"
  if (!module.hot.data) {
    hotAPI.createRecord(id, module.exports)
  } else {
    hotAPI.update(id, module.exports, __vue_template__)
  }
})()}

/***/ },
/* 41 */
/***/ function(module, exports, __webpack_require__) {

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(17)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\selectors\\text.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(34)
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
/* 42 */
/***/ function(module, exports, __webpack_require__) {

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(18)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\selectors\\textTable.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(35)
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
/* 43 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__components_helpers_js__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__components_helpers_js__);
///*app*/
Vue.component('deviceCategory', __webpack_require__(3));
Vue.component('OccasionListButtons', __webpack_require__(4));
Vue.component('address-input', __webpack_require__(2));
Vue.component('ref-specs', __webpack_require__(6));
Vue.component('photo-input', __webpack_require__(5));
Vue.component('brand-selection', __webpack_require__(7));



var deviceDefault = {
    cat: [{ title: '選擇類別' }],
    sn: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,
    title: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,
    brand: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,
    model: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,

    is_new: 1,
    used_time: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,
    guarantee: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,

    price: 0,
    price_note: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,

    transaction: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,
    deposit: 0,

    reads: 0,

    transportation: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,
    freight: 0,

    description: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,

    dimension: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyObj,
    gas_type: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,
    voltage: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,
    specs: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyArray,

    occasions: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyArray,

    //address: addressDefault,
    city: 0,
    zip: 0,
    street: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,

    contact_role: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,
    contact_email: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,
    contact_tel: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,
    contact_name: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString,
    contact_line_id: __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.emptyString
};

/** page level Information  Begin******/
var pageInfo;
pageInfo = {
    user: function () {
        return JSON.parse($('#userObject').val());
    },
    item: function () {
        return JSON.parse($('#itemInfo').val());
    }
};
/** page level Information  End******/

var vm = new Vue({
    el: '#app',
    data: {
        formSaved: false,
        item: pageInfo.item(),
        selectedBrand: '',
        user: pageInfo.user(),
        formInput: deviceDefault,
        selected_options: {
            gas_type_checked: false,
            voltage_checked: false
        },
        viewControl: {
            see_cat_menu: false,
            priceNoteShow: false
        },
        photos: []
    },
    computed: {
        newSelected: function () {
            return this.formInput.is_new == 1;
        },
        has_price: function () {
            return this.formInput.price > 0;
        },
        description_left: function () {
            return 150 - this.formInput.description.length;
        },
        description_over: function () {
            return this.formInput.description.length - 150;
        },
        description_too_long: function () {
            return this.formInput.description.length > 150;
        },
        has_spec: function () {
            if (__WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.isEmpty(this.formInput.specs)) {
                return false;
            }

            return !(this.formInput.specs.length == 0);
        }
    },
    methods: {
        handleMajorFormSubmission: function handleMajorFormSubmission() {
            if (__WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.ifDuplicateTitles(this.formInput.specs)) {
                alert('規格的設定裡面,"自訂規格"的項目有重複,請修改!');
                location.href = "#custom_spec";
                return;
            }
            this.allowPageChange();
            document.querySelector('#inputForm').submit();
        },
        allowPageChange: function allowPageChange() {
            this.formSaved = true;
        },
        unset_formInput: function (key, focus, type) {
            if ( focus === void 0 ) focus = true;
            if ( type === void 0 ) type = 'string';

            this.formInput[key] = __WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.unsetValue(type);
            if (focus) {
                document.querySelector('#' + key).focus();
            }
        },
        updateCat: function (list) {
            this.formInput.cat = list;
        },
        updateOccasion: function (list) {
            this.formInput.occasions = list;
        },
        set_contact_title: function (title) {
            this.formInput.contact_name += title;
        },
        sync_mobile_line_id: function () {
            this.formInput.contact_line_id = this.formInput.contact_tel;
        },
        sync_user_info: function () {
            this.formInput.contact_name = this.user.name;
            this.formInput.contact_email = this.user.email;
            this.formInput.contact_tel = this.user.tel;
        },
        increment_custom_spec_list: function (obj) {
            if (__WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.isEmpty(this.formInput.specs)) {
                this.formInput.specs = [];
            }
            this.formInput.specs.push(obj);
        },
        remove_custom_spec_list: function (item) {
            var index = this.formInput.specs.indexOf(item);
            if (index != -1) {
                this.formInput.specs.splice(index, 1);
            }
        },
        moreSpec: function (specObj) {
            this.increment_custom_spec_list(specObj);
        },
        deleteDevice: function () {
            if (confirm('資料刪除後無法還原\n是否確定刪除?')) {
                this.allowPageChange();
                var form = document.querySelector('#deleteForm');
                form.submit();
            }
        },
        showDimensionNote: function () {
            $('#dimensionNoteShowModal').modal();
        }
    },
    watch: {
        'formInput.cat': function () {
            this.viewControl.see_cat_menu = false;
        },
        'formInput.is_new': function (newValue) {
            if (newValue == 1) {
                this.unset_formInput('used_time');
            }
        },
        'selected_options.gas_type_checked': function (newValue) {
            if (!newValue) {
                this.unset_formInput('gas_type', false);
            }
        },
        'selected_options.voltage_checked': function (newValue) {
            if (!newValue) {
                this.unset_formInput('voltage', false);
            }
        },
        'formInput.price_note': function (newValue) {
            if (newValue == '面議') {
                this.formInput.price = 0;
            }
        }
    },
    beforeMount: function () {
        bootstrap(this);

        this.photos = initPhoto(this);
        //this.sync_user_info()
    }
});

vm.item.photos_list = undefined;
function initPhoto(vm) {
    var photoList = vm.item.photos_list;
    //photoList = (photoList === null) ? [] : photoList;
    //var length = photoList.length;
    var length = 0;

    var photos = vm.item.photos;
    var count = photos.length;

    var arr = [];

    for (var i = 0; i < length; i++) {
        var filepath = '';
        for (var j = 0; j < count; j++) {
            if (photoList[i] == photos[j].field) {
                filepath = photos[j].filepath;
            }
        }
        arr[photoList[i]] = filepath;
    }
    return arr;
}

function initCheckBox(vm) {
    if (!__WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.isEmpty(vm.formInput.gas_type)) {
        vm.selected_options.gas_type_checked = true;
    }

    if (!__WEBPACK_IMPORTED_MODULE_0__components_helpers_js___default.a.isEmpty(vm.formInput.voltage)) {
        vm.selected_options.voltage_checked = true;
    }
}

function bootstrap(vm) {
    //get the data we want
    vm.item.cat[0] = vm.item.cat;
    vm.formInput = vm.item;

    initCheckBox(vm);
}

window.onbeforeunload = function () {
    if (!vm.formSaved) {
        return 'please save your setting before leaving the page';
    }
};

$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 130) {
            $('#control-panel').addClass('panel-fixed');
        } else {
            $('#control-panel').removeClass('panel-fixed');
        }
    });
});

/***/ }
/******/ ]);