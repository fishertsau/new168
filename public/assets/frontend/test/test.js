/*!
 * vue-resource v1.0.3
 * https://github.com/vuejs/vue-resource
 * Released under the MIT License.
 */

!function(t,n){"object"==typeof exports&&"undefined"!=typeof module?module.exports=n():"function"==typeof define&&define.amd?define(n):t.VueResource=n()}(this,function(){"use strict";function t(t){this.state=it,this.value=void 0,this.deferred=[];var n=this;try{t(function(t){n.resolve(t)},function(t){n.reject(t)})}catch(t){n.reject(t)}}function n(t,n){t instanceof Promise?this.promise=t:this.promise=new Promise(t.bind(n)),this.context=n}function e(t){at=t.util,ct=t.config.debug||!t.config.silent}function o(t){"undefined"!=typeof console&&ct&&console.warn("[VueResource warn]: "+t)}function r(t){"undefined"!=typeof console&&console.error(t)}function i(t,n){return at.nextTick(t,n)}function u(t){return t.replace(/^\s*|\s*$/g,"")}function s(t){return t?t.toLowerCase():""}function c(t){return t?t.toUpperCase():""}function a(t){return"string"==typeof t}function f(t){return t===!0||t===!1}function h(t){return"function"==typeof t}function p(t){return null!==t&&"object"==typeof t}function l(t){return p(t)&&Object.getPrototypeOf(t)==Object.prototype}function d(t){return"undefined"!=typeof Blob&&t instanceof Blob}function m(t){return"undefined"!=typeof FormData&&t instanceof FormData}function y(t,e,o){var r=n.resolve(t);return arguments.length<2?r:r.then(e,o)}function v(t,n,e){return e=e||{},h(e)&&(e=e.call(n)),g(t.bind({$vm:n,$options:e}),t,{$options:e})}function b(t,n){var e,o;if(t&&"number"==typeof t.length)for(e=0;e<t.length;e++)n.call(t[e],t[e],e);else if(p(t))for(o in t)t.hasOwnProperty(o)&&n.call(t[o],t[o],o);return t}function g(t){var n=ft.call(arguments,1);return n.forEach(function(n){x(t,n,!0)}),t}function w(t){var n=ft.call(arguments,1);return n.forEach(function(n){for(var e in n)void 0===t[e]&&(t[e]=n[e])}),t}function T(t){var n=ft.call(arguments,1);return n.forEach(function(n){x(t,n)}),t}function x(t,n,e){for(var o in n)e&&(l(n[o])||ht(n[o]))?(l(n[o])&&!l(t[o])&&(t[o]={}),ht(n[o])&&!ht(t[o])&&(t[o]=[]),x(t[o],n[o],e)):void 0!==n[o]&&(t[o]=n[o])}function j(t,n){var e=n(t);return a(t.root)&&!e.match(/^(https?:)?\//)&&(e=t.root+"/"+e),e}function E(t,n){var e=Object.keys(k.options.params),o={},r=n(t);return b(t.params,function(t,n){e.indexOf(n)===-1&&(o[n]=t)}),o=k.params(o),o&&(r+=(r.indexOf("?")==-1?"?":"&")+o),r}function O(t,n,e){var o=P(t),r=o.expand(n);return e&&e.push.apply(e,o.vars),r}function P(t){var n=["+","#",".","/",";","?","&"],e=[];return{vars:e,expand:function(o){return t.replace(/\{([^\{\}]+)\}|([^\{\}]+)/g,function(t,r,i){if(r){var u=null,s=[];if(n.indexOf(r.charAt(0))!==-1&&(u=r.charAt(0),r=r.substr(1)),r.split(/,/g).forEach(function(t){var n=/([^:\*]*)(?::(\d+)|(\*))?/.exec(t);s.push.apply(s,C(o,u,n[1],n[2]||n[3])),e.push(n[1])}),u&&"+"!==u){var c=",";return"?"===u?c="&":"#"!==u&&(c=u),(0!==s.length?u:"")+s.join(c)}return s.join(",")}return U(i)})}}}function C(t,n,e,o){var r=t[e],i=[];if($(r)&&""!==r)if("string"==typeof r||"number"==typeof r||"boolean"==typeof r)r=r.toString(),o&&"*"!==o&&(r=r.substring(0,parseInt(o,10))),i.push(R(n,r,A(n)?e:null));else if("*"===o)Array.isArray(r)?r.filter($).forEach(function(t){i.push(R(n,t,A(n)?e:null))}):Object.keys(r).forEach(function(t){$(r[t])&&i.push(R(n,r[t],t))});else{var u=[];Array.isArray(r)?r.filter($).forEach(function(t){u.push(R(n,t))}):Object.keys(r).forEach(function(t){$(r[t])&&(u.push(encodeURIComponent(t)),u.push(R(n,r[t].toString())))}),A(n)?i.push(encodeURIComponent(e)+"="+u.join(",")):0!==u.length&&i.push(u.join(","))}else";"===n?i.push(encodeURIComponent(e)):""!==r||"&"!==n&&"?"!==n?""===r&&i.push(""):i.push(encodeURIComponent(e)+"=");return i}function $(t){return void 0!==t&&null!==t}function A(t){return";"===t||"&"===t||"?"===t}function R(t,n,e){return n="+"===t||"#"===t?U(n):encodeURIComponent(n),e?encodeURIComponent(e)+"="+n:n}function U(t){return t.split(/(%[0-9A-Fa-f]{2})/g).map(function(t){return/%[0-9A-Fa-f]/.test(t)||(t=encodeURI(t)),t}).join("")}function S(t){var n=[],e=O(t.url,t.params,n);return n.forEach(function(n){delete t.params[n]}),e}function k(t,n){var e,o=this||{},r=t;return a(t)&&(r={url:t,params:n}),r=g({},k.options,o.$options,r),k.transforms.forEach(function(t){e=I(t,e,o.$vm)}),e(r)}function I(t,n,e){return function(o){return t.call(e,o,n)}}function H(t,n,e){var o,r=ht(n),i=l(n);b(n,function(n,u){o=p(n)||ht(n),e&&(u=e+"["+(i||o?u:"")+"]"),!e&&r?t.add(n.name,n.value):o?H(t,n,u):t.add(u,n)})}function L(t){return new n(function(n){var e=new XDomainRequest,o=function(o){var r=o.type,i=0;"load"===r?i=200:"error"===r&&(i=500),n(t.respondWith(e.responseText,{status:i}))};t.abort=function(){return e.abort()},e.open(t.method,t.getUrl()),e.timeout=0,e.onload=o,e.onerror=o,e.ontimeout=o,e.onprogress=function(){},e.send(t.getBody())})}function N(t,n){!f(t.crossOrigin)&&q(t)&&(t.crossOrigin=!0),t.crossOrigin&&(yt||(t.client=L),delete t.emulateHTTP),n()}function q(t){var n=k.parse(k(t));return n.protocol!==mt.protocol||n.host!==mt.host}function B(t,n){m(t.body)?t.headers.delete("Content-Type"):(p(t.body)||ht(t.body))&&(t.emulateJSON?(t.body=k.params(t.body),t.headers.set("Content-Type","application/x-www-form-urlencoded")):t.body=JSON.stringify(t.body)),n(function(t){return Object.defineProperty(t,"data",{get:function(){return this.body},set:function(t){this.body=t}}),t.bodyText?y(t.text(),function(n){var e=t.headers.get("Content-Type");if(a(e)&&0===e.indexOf("application/json"))try{t.body=JSON.parse(n)}catch(n){t.body=null}else t.body=n;return t}):t})}function J(t){return new n(function(n){var e,o,r=t.jsonp||"callback",i="_jsonp"+Math.random().toString(36).substr(2),u=null;e=function(e){var r=e.type,s=0;"load"===r&&null!==u?s=200:"error"===r&&(s=500),n(t.respondWith(u,{status:s})),delete window[i],document.body.removeChild(o)},t.params[r]=i,window[i]=function(t){u=JSON.stringify(t)},o=document.createElement("script"),o.src=t.getUrl(),o.type="text/javascript",o.async=!0,o.onload=e,o.onerror=e,document.body.appendChild(o)})}function D(t,n){"JSONP"==t.method&&(t.client=J),n(function(n){if("JSONP"==t.method)return y(n.json(),function(t){return n.body=t,n})})}function M(t,n){h(t.before)&&t.before.call(this,t),n()}function X(t,n){t.emulateHTTP&&/^(PUT|PATCH|DELETE)$/i.test(t.method)&&(t.headers.set("X-HTTP-Method-Override",t.method),t.method="POST"),n()}function F(t,n){var e=pt({},Z.headers.common,t.crossOrigin?{}:Z.headers.custom,Z.headers[s(t.method)]);b(e,function(n,e){t.headers.has(e)||t.headers.set(e,n)}),n()}function W(t,n){var e;t.timeout&&(e=setTimeout(function(){t.abort()},t.timeout)),n(function(t){clearTimeout(e)})}function G(t){return new n(function(n){var e=new XMLHttpRequest,o=function(o){var r=t.respondWith("response"in e?e.response:e.responseText,{status:1223===e.status?204:e.status,statusText:1223===e.status?"No Content":u(e.statusText)});b(u(e.getAllResponseHeaders()).split("\n"),function(t){r.headers.append(t.slice(0,t.indexOf(":")),t.slice(t.indexOf(":")+1))}),n(r)};t.abort=function(){return e.abort()},t.progress&&("GET"===t.method?e.addEventListener("progress",t.progress):/^(POST|PUT)$/i.test(t.method)&&e.upload.addEventListener("progress",t.progress)),e.open(t.method,t.getUrl(),!0),"responseType"in e&&(e.responseType="blob"),t.credentials===!0&&(e.withCredentials=!0),t.headers.forEach(function(t,n){e.setRequestHeader(n,t)}),e.timeout=0,e.onload=o,e.onerror=o,e.send(t.getBody())})}function V(t){function e(e){return new n(function(n){function s(){r=i.pop(),h(r)?r.call(t,e,c):(o("Invalid interceptor of type "+typeof r+", must be a function"),c())}function c(e){if(h(e))u.unshift(e);else if(p(e))return u.forEach(function(n){e=y(e,function(e){return n.call(t,e)||e})}),void y(e,n);s()}s()},t)}var r,i=[_],u=[];return p(t)||(t=null),e.use=function(t){i.push(t)},e}function _(t,n){var e=t.client||G;n(e(t))}function z(t,n){return Object.keys(t).reduce(function(t,e){return s(n)===s(e)?e:t},null)}function K(t){if(/[^a-z0-9\-#$%&'*+.\^_`|~]/i.test(t))throw new TypeError("Invalid character in header field name");return u(t)}function Q(t){return new n(function(n){var e=new FileReader;e.readAsText(t),e.onload=function(){n(e.result)}})}function Y(t){return 0===t.type.indexOf("text")||t.type.indexOf("json")!==-1}function Z(t){var e=this||{},o=V(e.$vm);return w(t||{},e.$options,Z.options),Z.interceptors.forEach(function(t){o.use(t)}),o(new wt(t)).then(function(t){return t.ok?t:n.reject(t)},function(t){return t instanceof Error&&r(t),n.reject(t)})}function tt(t,n,e,o){var r=this||{},i={};return e=pt({},tt.actions,e),b(e,function(e,u){e=g({url:t,params:pt({},n)},o,e),i[u]=function(){return(r.$http||Z)(nt(e,arguments))}}),i}function nt(t,n){var e,o=pt({},t),r={};switch(n.length){case 2:r=n[0],e=n[1];break;case 1:/^(POST|PUT|PATCH)$/i.test(o.method)?e=n[0]:r=n[0];break;case 0:break;default:throw"Expected up to 4 arguments [params, body], got "+n.length+" arguments"}return o.body=e,o.params=pt({},o.params,r),o}function et(t){et.installed||(e(t),t.url=k,t.http=Z,t.resource=tt,t.Promise=n,Object.defineProperties(t.prototype,{$url:{get:function(){return v(t.url,this,this.$options.url)}},$http:{get:function(){return v(t.http,this,this.$options.http)}},$resource:{get:function(){return t.resource.bind(this)}},$promise:{get:function(){var n=this;return function(e){return new t.Promise(e,n)}}}}))}var ot=0,rt=1,it=2;t.reject=function(n){return new t(function(t,e){e(n)})},t.resolve=function(n){return new t(function(t,e){t(n)})},t.all=function(n){return new t(function(e,o){function r(t){return function(o){u[t]=o,i+=1,i===n.length&&e(u)}}var i=0,u=[];0===n.length&&e(u);for(var s=0;s<n.length;s+=1)t.resolve(n[s]).then(r(s),o)})},t.race=function(n){return new t(function(e,o){for(var r=0;r<n.length;r+=1)t.resolve(n[r]).then(e,o)})};var ut=t.prototype;ut.resolve=function(t){var n=this;if(n.state===it){if(t===n)throw new TypeError("Promise settled with itself.");var e=!1;try{var o=t&&t.then;if(null!==t&&"object"==typeof t&&"function"==typeof o)return void o.call(t,function(t){e||n.resolve(t),e=!0},function(t){e||n.reject(t),e=!0})}catch(t){return void(e||n.reject(t))}n.state=ot,n.value=t,n.notify()}},ut.reject=function(t){var n=this;if(n.state===it){if(t===n)throw new TypeError("Promise settled with itself.");n.state=rt,n.value=t,n.notify()}},ut.notify=function(){var t=this;i(function(){if(t.state!==it)for(;t.deferred.length;){var n=t.deferred.shift(),e=n[0],o=n[1],r=n[2],i=n[3];try{t.state===ot?r("function"==typeof e?e.call(void 0,t.value):t.value):t.state===rt&&("function"==typeof o?r(o.call(void 0,t.value)):i(t.value))}catch(t){i(t)}}})},ut.then=function(n,e){var o=this;return new t(function(t,r){o.deferred.push([n,e,t,r]),o.notify()})},ut.catch=function(t){return this.then(void 0,t)},"undefined"==typeof Promise&&(window.Promise=t),n.all=function(t,e){return new n(Promise.all(t),e)},n.resolve=function(t,e){return new n(Promise.resolve(t),e)},n.reject=function(t,e){return new n(Promise.reject(t),e)},n.race=function(t,e){return new n(Promise.race(t),e)};var st=n.prototype;st.bind=function(t){return this.context=t,this},st.then=function(t,e){return t&&t.bind&&this.context&&(t=t.bind(this.context)),e&&e.bind&&this.context&&(e=e.bind(this.context)),new n(this.promise.then(t,e),this.context)},st.catch=function(t){return t&&t.bind&&this.context&&(t=t.bind(this.context)),new n(this.promise.catch(t),this.context)},st.finally=function(t){return this.then(function(n){return t.call(this),n},function(n){return t.call(this),Promise.reject(n)})};var ct=!1,at={},ft=[].slice,ht=Array.isArray,pt=Object.assign||T,lt=document.documentMode,dt=document.createElement("a");k.options={url:"",root:null,params:{}},k.transforms=[S,E,j],k.params=function(t){var n=[],e=encodeURIComponent;return n.add=function(t,n){h(n)&&(n=n()),null===n&&(n=""),this.push(e(t)+"="+e(n))},H(n,t),n.join("&").replace(/%20/g,"+")},k.parse=function(t){return lt&&(dt.href=t,t=dt.href),dt.href=t,{href:dt.href,protocol:dt.protocol?dt.protocol.replace(/:$/,""):"",port:dt.port,host:dt.host,hostname:dt.hostname,pathname:"/"===dt.pathname.charAt(0)?dt.pathname:"/"+dt.pathname,search:dt.search?dt.search.replace(/^\?/,""):"",hash:dt.hash?dt.hash.replace(/^#/,""):""}};var mt=k.parse(location.href),yt="withCredentials"in new XMLHttpRequest,vt=function(t,n){if(!(t instanceof n))throw new TypeError("Cannot call a class as a function")},bt=function(){function t(n){var e=this;vt(this,t),this.map={},b(n,function(t,n){return e.append(n,t)})}return t.prototype.has=function(t){return null!==z(this.map,t)},t.prototype.get=function(t){var n=this.map[z(this.map,t)];return n?n[0]:null},t.prototype.getAll=function(t){return this.map[z(this.map,t)]||[]},t.prototype.set=function(t,n){this.map[K(z(this.map,t)||t)]=[u(n)]},t.prototype.append=function(t,n){var e=this.getAll(t);e.length?e.push(u(n)):this.set(t,n)},t.prototype.delete=function(t){delete this.map[z(this.map,t)]},t.prototype.forEach=function(t,n){var e=this;b(this.map,function(o,r){b(o,function(o){return t.call(n,o,r,e)})})},t}(),gt=function(){function t(n,e){var o=e.url,r=e.headers,i=e.status,u=e.statusText;vt(this,t),this.url=o,this.ok=i>=200&&i<300,this.status=i||0,this.statusText=u||"",this.headers=new bt(r),this.body=n,a(n)?this.bodyText=n:d(n)&&(this.bodyBlob=n,Y(n)&&(this.bodyText=Q(n)))}return t.prototype.blob=function(){return y(this.bodyBlob)},t.prototype.text=function(){return y(this.bodyText)},t.prototype.json=function(){return y(this.text(),function(t){return JSON.parse(t)})},t}(),wt=function(){function t(n){vt(this,t),this.body=null,this.params={},pt(this,n,{method:c(n.method||"GET")}),this.headers instanceof bt||(this.headers=new bt(this.headers))}return t.prototype.getUrl=function(){return k(this)},t.prototype.getBody=function(){return this.body},t.prototype.respondWith=function(t,n){return new gt(t,pt(n||{},{url:this.getUrl()}))},t}(),Tt={"X-Requested-With":"XMLHttpRequest"},xt={Accept:"application/json, text/plain, */*"},jt={"Content-Type":"application/json;charset=utf-8"};return Z.options={},Z.headers={put:jt,post:jt,patch:jt,delete:jt,custom:Tt,common:xt},Z.interceptors=[M,W,X,B,D,F,N],["get","delete","head","jsonp"].forEach(function(t){Z[t]=function(n,e){return this(pt(e||{},{url:n,method:t}))}}),["post","put","patch"].forEach(function(t){Z[t]=function(n,e,o){return this(pt(o||{},{url:n,method:t,body:e}))}}),tt.actions={get:{method:"GET"},save:{method:"POST"},query:{method:"GET"},update:{method:"PUT"},remove:{method:"DELETE"},delete:{method:"DELETE"}},"undefined"!=typeof window&&window.Vue&&window.Vue.use(et),et});
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

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(4)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\app\\AddressInput.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(9)
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
/* 1 */
/***/ function(module, exports, __webpack_require__) {

var __vue_script__, __vue_template__
var __vue_styles__ = {}
__vue_script__ = __webpack_require__(5)
if (__vue_script__ &&
    __vue_script__.__esModule &&
    Object.keys(__vue_script__).length > 1) {
  console.warn("[vue-loader] resources\\assets\\components\\app\\PhotoInput.vue: named exports in *.vue files are ignored.")}
__vue_template__ = __webpack_require__(10)
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
/* 2 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(process) {/**
  * vue-router v2.1.1
  * (c) 2016 Evan You
  * @license MIT
  */
'use strict';

var View = {
  name: 'router-view',
  functional: true,
  props: {
    name: {
      type: String,
      default: 'default'
    }
  },
  render: function render (h, ref) {
    var props = ref.props;
    var children = ref.children;
    var parent = ref.parent;
    var data = ref.data;

    data.routerView = true

    var route = parent.$route
    var cache = parent._routerViewCache || (parent._routerViewCache = {})
    var depth = 0
    var inactive = false

    while (parent) {
      if (parent.$vnode && parent.$vnode.data.routerView) {
        depth++
      }
      if (parent._inactive) {
        inactive = true
      }
      parent = parent.$parent
    }

    data.routerViewDepth = depth
    var matched = route.matched[depth]
    if (!matched) {
      return h()
    }

    var name = props.name
    var component = inactive
      ? cache[name]
      : (cache[name] = matched.components[name])

    if (!inactive) {
      var hooks = data.hook || (data.hook = {})
      hooks.init = function (vnode) {
        matched.instances[name] = vnode.child
      }
      hooks.prepatch = function (oldVnode, vnode) {
        matched.instances[name] = vnode.child
      }
      hooks.destroy = function (vnode) {
        if (matched.instances[name] === vnode.child) {
          matched.instances[name] = undefined
        }
      }
    }

    return h(component, data, children)
  }
}

/*  */

function assert (condition, message) {
  if (!condition) {
    throw new Error(("[vue-router] " + message))
  }
}

function warn (condition, message) {
  if (!condition) {
    typeof console !== 'undefined' && console.warn(("[vue-router] " + message))
  }
}

/*  */

var encode = encodeURIComponent
var decode = decodeURIComponent

function resolveQuery (
  query,
  extraQuery
) {
  if ( extraQuery === void 0 ) extraQuery = {};

  if (query) {
    var parsedQuery
    try {
      parsedQuery = parseQuery(query)
    } catch (e) {
      process.env.NODE_ENV !== 'production' && warn(false, e.message)
      parsedQuery = {}
    }
    for (var key in extraQuery) {
      parsedQuery[key] = extraQuery[key]
    }
    return parsedQuery
  } else {
    return extraQuery
  }
}

function parseQuery (query) {
  var res = {}

  query = query.trim().replace(/^(\?|#|&)/, '')

  if (!query) {
    return res
  }

  query.split('&').forEach(function (param) {
    var parts = param.replace(/\+/g, ' ').split('=')
    var key = decode(parts.shift())
    var val = parts.length > 0
      ? decode(parts.join('='))
      : null

    if (res[key] === undefined) {
      res[key] = val
    } else if (Array.isArray(res[key])) {
      res[key].push(val)
    } else {
      res[key] = [res[key], val]
    }
  })

  return res
}

function stringifyQuery (obj) {
  var res = obj ? Object.keys(obj).map(function (key) {
    var val = obj[key]

    if (val === undefined) {
      return ''
    }

    if (val === null) {
      return encode(key)
    }

    if (Array.isArray(val)) {
      var result = []
      val.slice().forEach(function (val2) {
        if (val2 === undefined) {
          return
        }
        if (val2 === null) {
          result.push(encode(key))
        } else {
          result.push(encode(key) + '=' + encode(val2))
        }
      })
      return result.join('&')
    }

    return encode(key) + '=' + encode(val)
  }).filter(function (x) { return x.length > 0; }).join('&') : null
  return res ? ("?" + res) : ''
}

/*  */

function createRoute (
  record,
  location,
  redirectedFrom
) {
  var route = {
    name: location.name || (record && record.name),
    meta: (record && record.meta) || {},
    path: location.path || '/',
    hash: location.hash || '',
    query: location.query || {},
    params: location.params || {},
    fullPath: getFullPath(location),
    matched: record ? formatMatch(record) : []
  }
  if (redirectedFrom) {
    route.redirectedFrom = getFullPath(redirectedFrom)
  }
  return Object.freeze(route)
}

// the starting route that represents the initial state
var START = createRoute(null, {
  path: '/'
})

function formatMatch (record) {
  var res = []
  while (record) {
    res.unshift(record)
    record = record.parent
  }
  return res
}

function getFullPath (ref) {
  var path = ref.path;
  var query = ref.query; if ( query === void 0 ) query = {};
  var hash = ref.hash; if ( hash === void 0 ) hash = '';

  return (path || '/') + stringifyQuery(query) + hash
}

var trailingSlashRE = /\/$/
function isSameRoute (a, b) {
  if (b === START) {
    return a === b
  } else if (!b) {
    return false
  } else if (a.path && b.path) {
    return (
      a.path.replace(trailingSlashRE, '') === b.path.replace(trailingSlashRE, '') &&
      a.hash === b.hash &&
      isObjectEqual(a.query, b.query)
    )
  } else if (a.name && b.name) {
    return (
      a.name === b.name &&
      a.hash === b.hash &&
      isObjectEqual(a.query, b.query) &&
      isObjectEqual(a.params, b.params)
    )
  } else {
    return false
  }
}

function isObjectEqual (a, b) {
  if ( a === void 0 ) a = {};
  if ( b === void 0 ) b = {};

  var aKeys = Object.keys(a)
  var bKeys = Object.keys(b)
  if (aKeys.length !== bKeys.length) {
    return false
  }
  return aKeys.every(function (key) { return String(a[key]) === String(b[key]); })
}

function isIncludedRoute (current, target) {
  return (
    current.path.indexOf(target.path.replace(/\/$/, '')) === 0 &&
    (!target.hash || current.hash === target.hash) &&
    queryIncludes(current.query, target.query)
  )
}

function queryIncludes (current, target) {
  for (var key in target) {
    if (!(key in current)) {
      return false
    }
  }
  return true
}

/*  */

// work around weird flow bug
var toTypes = [String, Object]

var Link = {
  name: 'router-link',
  props: {
    to: {
      type: toTypes,
      required: true
    },
    tag: {
      type: String,
      default: 'a'
    },
    exact: Boolean,
    append: Boolean,
    replace: Boolean,
    activeClass: String,
    event: {
      type: [String, Array],
      default: 'click'
    }
  },
  render: function render (h) {
    var this$1 = this;

    var router = this.$router
    var current = this.$route
    var ref = router.resolve(this.to, current, this.append);
    var normalizedTo = ref.normalizedTo;
    var resolved = ref.resolved;
    var href = ref.href;
    var classes = {}
    var activeClass = this.activeClass || router.options.linkActiveClass || 'router-link-active'
    var compareTarget = normalizedTo.path ? createRoute(null, normalizedTo) : resolved
    classes[activeClass] = this.exact
      ? isSameRoute(current, compareTarget)
      : isIncludedRoute(current, compareTarget)

    var handler = function (e) {
      if (guardEvent(e)) {
        if (this$1.replace) {
          router.replace(normalizedTo)
        } else {
          router.push(normalizedTo)
        }
      }
    }

    var on = { click: guardEvent }
    if (Array.isArray(this.event)) {
      this.event.forEach(function (e) { on[e] = handler })
    } else {
      on[this.event] = handler
    }

    var data = {
      class: classes
    }

    if (this.tag === 'a') {
      data.on = on
      data.attrs = { href: href }
    } else {
      // find the first <a> child and apply listener and href
      var a = findAnchor(this.$slots.default)
      if (a) {
        // in case the <a> is a static node
        a.isStatic = false
        var extend = _Vue.util.extend
        var aData = a.data = extend({}, a.data)
        aData.on = on
        var aAttrs = a.data.attrs = extend({}, a.data.attrs)
        aAttrs.href = href
      } else {
        // doesn't have <a> child, apply listener to self
        data.on = on
      }
    }

    return h(this.tag, data, this.$slots.default)
  }
}

function guardEvent (e) {
  // don't redirect with control keys
  /* istanbul ignore if */
  if (e.metaKey || e.ctrlKey || e.shiftKey) { return }
  // don't redirect when preventDefault called
  /* istanbul ignore if */
  if (e.defaultPrevented) { return }
  // don't redirect on right click
  /* istanbul ignore if */
  if (e.button !== 0) { return }
  // don't redirect if `target="_blank"`
  /* istanbul ignore if */
  var target = e.target.getAttribute('target')
  if (/\b_blank\b/i.test(target)) { return }

  e.preventDefault()
  return true
}

function findAnchor (children) {
  if (children) {
    var child
    for (var i = 0; i < children.length; i++) {
      child = children[i]
      if (child.tag === 'a') {
        return child
      }
      if (child.children && (child = findAnchor(child.children))) {
        return child
      }
    }
  }
}

var _Vue

function install (Vue) {
  if (install.installed) { return }
  install.installed = true

  _Vue = Vue

  Object.defineProperty(Vue.prototype, '$router', {
    get: function get () { return this.$root._router }
  })

  Object.defineProperty(Vue.prototype, '$route', {
    get: function get$1 () { return this.$root._route }
  })

  Vue.mixin({
    beforeCreate: function beforeCreate () {
      if (this.$options.router) {
        this._router = this.$options.router
        this._router.init(this)
        Vue.util.defineReactive(this, '_route', this._router.history.current)
      }
    }
  })

  Vue.component('router-view', View)
  Vue.component('router-link', Link)

  var strats = Vue.config.optionMergeStrategies
  // use the same hook merging strategy for route hooks
  strats.beforeRouteEnter = strats.beforeRouteLeave = strats.created
}

/*  */

function resolvePath (
  relative,
  base,
  append
) {
  if (relative.charAt(0) === '/') {
    return relative
  }

  if (relative.charAt(0) === '?' || relative.charAt(0) === '#') {
    return base + relative
  }

  var stack = base.split('/')

  // remove trailing segment if:
  // - not appending
  // - appending to trailing slash (last segment is empty)
  if (!append || !stack[stack.length - 1]) {
    stack.pop()
  }

  // resolve relative path
  var segments = relative.replace(/^\//, '').split('/')
  for (var i = 0; i < segments.length; i++) {
    var segment = segments[i]
    if (segment === '.') {
      continue
    } else if (segment === '..') {
      stack.pop()
    } else {
      stack.push(segment)
    }
  }

  // ensure leading slash
  if (stack[0] !== '') {
    stack.unshift('')
  }

  return stack.join('/')
}

function parsePath (path) {
  var hash = ''
  var query = ''

  var hashIndex = path.indexOf('#')
  if (hashIndex >= 0) {
    hash = path.slice(hashIndex)
    path = path.slice(0, hashIndex)
  }

  var queryIndex = path.indexOf('?')
  if (queryIndex >= 0) {
    query = path.slice(queryIndex + 1)
    path = path.slice(0, queryIndex)
  }

  return {
    path: path,
    query: query,
    hash: hash
  }
}

function cleanPath (path) {
  return path.replace(/\/\//g, '/')
}

/*  */

function createRouteMap (routes) {
  var pathMap = Object.create(null)
  var nameMap = Object.create(null)

  routes.forEach(function (route) {
    addRouteRecord(pathMap, nameMap, route)
  })

  return {
    pathMap: pathMap,
    nameMap: nameMap
  }
}

function addRouteRecord (
  pathMap,
  nameMap,
  route,
  parent,
  matchAs
) {
  var path = route.path;
  var name = route.name;
  if (process.env.NODE_ENV !== 'production') {
    assert(path != null, "\"path\" is required in a route configuration.")
    assert(
      typeof route.component !== 'string',
      "route config \"component\" for path: " + (String(path || name)) + " cannot be a " +
      "string id. Use an actual component instead."
    )
  }

  var record = {
    path: normalizePath(path, parent),
    components: route.components || { default: route.component },
    instances: {},
    name: name,
    parent: parent,
    matchAs: matchAs,
    redirect: route.redirect,
    beforeEnter: route.beforeEnter,
    meta: route.meta || {}
  }

  if (route.children) {
    // Warn if route is named and has a default child route.
    // If users navigate to this route by name, the default child will
    // not be rendered (GH Issue #629)
    if (process.env.NODE_ENV !== 'production') {
      if (route.name && route.children.some(function (child) { return /^\/?$/.test(child.path); })) {
        warn(false, ("Named Route '" + (route.name) + "' has a default child route.\n          When navigating to this named route (:to=\"{name: '" + (route.name) + "'\"), the default child route will not be rendered.\n          Remove the name from this route and use the name of the default child route for named links instead.")
        )
      }
    }
    route.children.forEach(function (child) {
      addRouteRecord(pathMap, nameMap, child, record)
    })
  }

  if (route.alias !== undefined) {
    if (Array.isArray(route.alias)) {
      route.alias.forEach(function (alias) {
        addRouteRecord(pathMap, nameMap, { path: alias }, parent, record.path)
      })
    } else {
      addRouteRecord(pathMap, nameMap, { path: route.alias }, parent, record.path)
    }
  }

  if (!pathMap[record.path]) {
    pathMap[record.path] = record
  }
  if (name) {
    if (!nameMap[name]) {
      nameMap[name] = record
    } else if (process.env.NODE_ENV !== 'production') {
      warn(false, ("Duplicate named routes definition: { name: \"" + name + "\", path: \"" + (record.path) + "\" }"))
    }
  }
}

function normalizePath (path, parent) {
  path = path.replace(/\/$/, '')
  if (path[0] === '/') { return path }
  if (parent == null) { return path }
  return cleanPath(((parent.path) + "/" + path))
}

var __moduleExports = Array.isArray || function (arr) {
  return Object.prototype.toString.call(arr) == '[object Array]';
};

var isarray = __moduleExports

/**
 * Expose `pathToRegexp`.
 */
var index = pathToRegexp
var parse_1 = parse
var compile_1 = compile
var tokensToFunction_1 = tokensToFunction
var tokensToRegExp_1 = tokensToRegExp

/**
 * The main path matching regexp utility.
 *
 * @type {RegExp}
 */
var PATH_REGEXP = new RegExp([
  // Match escaped characters that would otherwise appear in future matches.
  // This allows the user to escape special characters that won't transform.
  '(\\\\.)',
  // Match Express-style parameters and un-named parameters with a prefix
  // and optional suffixes. Matches appear as:
  //
  // "/:test(\\d+)?" => ["/", "test", "\d+", undefined, "?", undefined]
  // "/route(\\d+)"  => [undefined, undefined, undefined, "\d+", undefined, undefined]
  // "/*"            => ["/", undefined, undefined, undefined, undefined, "*"]
  '([\\/.])?(?:(?:\\:(\\w+)(?:\\(((?:\\\\.|[^\\\\()])+)\\))?|\\(((?:\\\\.|[^\\\\()])+)\\))([+*?])?|(\\*))'
].join('|'), 'g')

/**
 * Parse a string for the raw tokens.
 *
 * @param  {string}  str
 * @param  {Object=} options
 * @return {!Array}
 */
function parse (str, options) {
  var tokens = []
  var key = 0
  var index = 0
  var path = ''
  var defaultDelimiter = options && options.delimiter || '/'
  var res

  while ((res = PATH_REGEXP.exec(str)) != null) {
    var m = res[0]
    var escaped = res[1]
    var offset = res.index
    path += str.slice(index, offset)
    index = offset + m.length

    // Ignore already escaped sequences.
    if (escaped) {
      path += escaped[1]
      continue
    }

    var next = str[index]
    var prefix = res[2]
    var name = res[3]
    var capture = res[4]
    var group = res[5]
    var modifier = res[6]
    var asterisk = res[7]

    // Push the current path onto the tokens.
    if (path) {
      tokens.push(path)
      path = ''
    }

    var partial = prefix != null && next != null && next !== prefix
    var repeat = modifier === '+' || modifier === '*'
    var optional = modifier === '?' || modifier === '*'
    var delimiter = res[2] || defaultDelimiter
    var pattern = capture || group

    tokens.push({
      name: name || key++,
      prefix: prefix || '',
      delimiter: delimiter,
      optional: optional,
      repeat: repeat,
      partial: partial,
      asterisk: !!asterisk,
      pattern: pattern ? escapeGroup(pattern) : (asterisk ? '.*' : '[^' + escapeString(delimiter) + ']+?')
    })
  }

  // Match any characters still remaining.
  if (index < str.length) {
    path += str.substr(index)
  }

  // If the path exists, push it onto the end.
  if (path) {
    tokens.push(path)
  }

  return tokens
}

/**
 * Compile a string to a template function for the path.
 *
 * @param  {string}             str
 * @param  {Object=}            options
 * @return {!function(Object=, Object=)}
 */
function compile (str, options) {
  return tokensToFunction(parse(str, options))
}

/**
 * Prettier encoding of URI path segments.
 *
 * @param  {string}
 * @return {string}
 */
function encodeURIComponentPretty (str) {
  return encodeURI(str).replace(/[\/?#]/g, function (c) {
    return '%' + c.charCodeAt(0).toString(16).toUpperCase()
  })
}

/**
 * Encode the asterisk parameter. Similar to `pretty`, but allows slashes.
 *
 * @param  {string}
 * @return {string}
 */
function encodeAsterisk (str) {
  return encodeURI(str).replace(/[?#]/g, function (c) {
    return '%' + c.charCodeAt(0).toString(16).toUpperCase()
  })
}

/**
 * Expose a method for transforming tokens into the path function.
 */
function tokensToFunction (tokens) {
  // Compile all the tokens into regexps.
  var matches = new Array(tokens.length)

  // Compile all the patterns before compilation.
  for (var i = 0; i < tokens.length; i++) {
    if (typeof tokens[i] === 'object') {
      matches[i] = new RegExp('^(?:' + tokens[i].pattern + ')$')
    }
  }

  return function (obj, opts) {
    var path = ''
    var data = obj || {}
    var options = opts || {}
    var encode = options.pretty ? encodeURIComponentPretty : encodeURIComponent

    for (var i = 0; i < tokens.length; i++) {
      var token = tokens[i]

      if (typeof token === 'string') {
        path += token

        continue
      }

      var value = data[token.name]
      var segment

      if (value == null) {
        if (token.optional) {
          // Prepend partial segment prefixes.
          if (token.partial) {
            path += token.prefix
          }

          continue
        } else {
          throw new TypeError('Expected "' + token.name + '" to be defined')
        }
      }

      if (isarray(value)) {
        if (!token.repeat) {
          throw new TypeError('Expected "' + token.name + '" to not repeat, but received `' + JSON.stringify(value) + '`')
        }

        if (value.length === 0) {
          if (token.optional) {
            continue
          } else {
            throw new TypeError('Expected "' + token.name + '" to not be empty')
          }
        }

        for (var j = 0; j < value.length; j++) {
          segment = encode(value[j])

          if (!matches[i].test(segment)) {
            throw new TypeError('Expected all "' + token.name + '" to match "' + token.pattern + '", but received `' + JSON.stringify(segment) + '`')
          }

          path += (j === 0 ? token.prefix : token.delimiter) + segment
        }

        continue
      }

      segment = token.asterisk ? encodeAsterisk(value) : encode(value)

      if (!matches[i].test(segment)) {
        throw new TypeError('Expected "' + token.name + '" to match "' + token.pattern + '", but received "' + segment + '"')
      }

      path += token.prefix + segment
    }

    return path
  }
}

/**
 * Escape a regular expression string.
 *
 * @param  {string} str
 * @return {string}
 */
function escapeString (str) {
  return str.replace(/([.+*?=^!:${}()[\]|\/\\])/g, '\\$1')
}

/**
 * Escape the capturing group by escaping special characters and meaning.
 *
 * @param  {string} group
 * @return {string}
 */
function escapeGroup (group) {
  return group.replace(/([=!:$\/()])/g, '\\$1')
}

/**
 * Attach the keys as a property of the regexp.
 *
 * @param  {!RegExp} re
 * @param  {Array}   keys
 * @return {!RegExp}
 */
function attachKeys (re, keys) {
  re.keys = keys
  return re
}

/**
 * Get the flags for a regexp from the options.
 *
 * @param  {Object} options
 * @return {string}
 */
function flags (options) {
  return options.sensitive ? '' : 'i'
}

/**
 * Pull out keys from a regexp.
 *
 * @param  {!RegExp} path
 * @param  {!Array}  keys
 * @return {!RegExp}
 */
function regexpToRegexp (path, keys) {
  // Use a negative lookahead to match only capturing groups.
  var groups = path.source.match(/\((?!\?)/g)

  if (groups) {
    for (var i = 0; i < groups.length; i++) {
      keys.push({
        name: i,
        prefix: null,
        delimiter: null,
        optional: false,
        repeat: false,
        partial: false,
        asterisk: false,
        pattern: null
      })
    }
  }

  return attachKeys(path, keys)
}

/**
 * Transform an array into a regexp.
 *
 * @param  {!Array}  path
 * @param  {Array}   keys
 * @param  {!Object} options
 * @return {!RegExp}
 */
function arrayToRegexp (path, keys, options) {
  var parts = []

  for (var i = 0; i < path.length; i++) {
    parts.push(pathToRegexp(path[i], keys, options).source)
  }

  var regexp = new RegExp('(?:' + parts.join('|') + ')', flags(options))

  return attachKeys(regexp, keys)
}

/**
 * Create a path regexp from string input.
 *
 * @param  {string}  path
 * @param  {!Array}  keys
 * @param  {!Object} options
 * @return {!RegExp}
 */
function stringToRegexp (path, keys, options) {
  return tokensToRegExp(parse(path, options), keys, options)
}

/**
 * Expose a function for taking tokens and returning a RegExp.
 *
 * @param  {!Array}          tokens
 * @param  {(Array|Object)=} keys
 * @param  {Object=}         options
 * @return {!RegExp}
 */
function tokensToRegExp (tokens, keys, options) {
  if (!isarray(keys)) {
    options = /** @type {!Object} */ (keys || options)
    keys = []
  }

  options = options || {}

  var strict = options.strict
  var end = options.end !== false
  var route = ''

  // Iterate over the tokens and create our regexp string.
  for (var i = 0; i < tokens.length; i++) {
    var token = tokens[i]

    if (typeof token === 'string') {
      route += escapeString(token)
    } else {
      var prefix = escapeString(token.prefix)
      var capture = '(?:' + token.pattern + ')'

      keys.push(token)

      if (token.repeat) {
        capture += '(?:' + prefix + capture + ')*'
      }

      if (token.optional) {
        if (!token.partial) {
          capture = '(?:' + prefix + '(' + capture + '))?'
        } else {
          capture = prefix + '(' + capture + ')?'
        }
      } else {
        capture = prefix + '(' + capture + ')'
      }

      route += capture
    }
  }

  var delimiter = escapeString(options.delimiter || '/')
  var endsWithDelimiter = route.slice(-delimiter.length) === delimiter

  // In non-strict mode we allow a slash at the end of match. If the path to
  // match already ends with a slash, we remove it for consistency. The slash
  // is valid at the end of a path match, not in the middle. This is important
  // in non-ending mode, where "/test/" shouldn't match "/test//route".
  if (!strict) {
    route = (endsWithDelimiter ? route.slice(0, -delimiter.length) : route) + '(?:' + delimiter + '(?=$))?'
  }

  if (end) {
    route += '$'
  } else {
    // In non-ending mode, we need the capturing groups to match as much as
    // possible by using a positive lookahead to the end or next path segment.
    route += strict && endsWithDelimiter ? '' : '(?=' + delimiter + '|$)'
  }

  return attachKeys(new RegExp('^' + route, flags(options)), keys)
}

/**
 * Normalize the given path string, returning a regular expression.
 *
 * An empty array can be passed in for the keys, which will hold the
 * placeholder key descriptions. For example, using `/user/:id`, `keys` will
 * contain `[{ name: 'id', delimiter: '/', optional: false, repeat: false }]`.
 *
 * @param  {(string|RegExp|Array)} path
 * @param  {(Array|Object)=}       keys
 * @param  {Object=}               options
 * @return {!RegExp}
 */
function pathToRegexp (path, keys, options) {
  if (!isarray(keys)) {
    options = /** @type {!Object} */ (keys || options)
    keys = []
  }

  options = options || {}

  if (path instanceof RegExp) {
    return regexpToRegexp(path, /** @type {!Array} */ (keys))
  }

  if (isarray(path)) {
    return arrayToRegexp(/** @type {!Array} */ (path), /** @type {!Array} */ (keys), options)
  }

  return stringToRegexp(/** @type {string} */ (path), /** @type {!Array} */ (keys), options)
}

index.parse = parse_1;
index.compile = compile_1;
index.tokensToFunction = tokensToFunction_1;
index.tokensToRegExp = tokensToRegExp_1;

/*  */

var regexpCache = Object.create(null)

function getRouteRegex (path) {
  var hit = regexpCache[path]
  var keys, regexp

  if (hit) {
    keys = hit.keys
    regexp = hit.regexp
  } else {
    keys = []
    regexp = index(path, keys)
    regexpCache[path] = { keys: keys, regexp: regexp }
  }

  return { keys: keys, regexp: regexp }
}

var regexpCompileCache = Object.create(null)

function fillParams (
  path,
  params,
  routeMsg
) {
  try {
    var filler =
      regexpCompileCache[path] ||
      (regexpCompileCache[path] = index.compile(path))
    return filler(params || {}, { pretty: true })
  } catch (e) {
    if (process.env.NODE_ENV !== 'production') {
      warn(false, ("missing param for " + routeMsg + ": " + (e.message)))
    }
    return ''
  }
}

/*  */

function normalizeLocation (
  raw,
  current,
  append
) {
  var next = typeof raw === 'string' ? { path: raw } : raw
  // named target
  if (next.name || next._normalized) {
    return next
  }

  // relative params
  if (!next.path && next.params && current) {
    next = assign({}, next)
    next._normalized = true
    var params = assign(assign({}, current.params), next.params)
    if (current.name) {
      next.name = current.name
      next.params = params
    } else if (current.matched) {
      var rawPath = current.matched[current.matched.length - 1].path
      next.path = fillParams(rawPath, params, ("path " + (current.path)))
    } else if (process.env.NODE_ENV !== 'production') {
      warn(false, "relative params navigation requires a current route.")
    }
    return next
  }

  var parsedPath = parsePath(next.path || '')
  var basePath = (current && current.path) || '/'
  var path = parsedPath.path
    ? resolvePath(parsedPath.path, basePath, append || next.append)
    : (current && current.path) || '/'
  var query = resolveQuery(parsedPath.query, next.query)
  var hash = next.hash || parsedPath.hash
  if (hash && hash.charAt(0) !== '#') {
    hash = "#" + hash
  }

  return {
    _normalized: true,
    path: path,
    query: query,
    hash: hash
  }
}

function assign (a, b) {
  for (var key in b) {
    a[key] = b[key]
  }
  return a
}

/*  */

function createMatcher (routes) {
  var ref = createRouteMap(routes);
  var pathMap = ref.pathMap;
  var nameMap = ref.nameMap;

  function match (
    raw,
    currentRoute,
    redirectedFrom
  ) {
    var location = normalizeLocation(raw, currentRoute)
    var name = location.name;

    if (name) {
      var record = nameMap[name]
      var paramNames = getRouteRegex(record.path).keys
        .filter(function (key) { return !key.optional; })
        .map(function (key) { return key.name; })

      if (typeof location.params !== 'object') {
        location.params = {}
      }

      if (currentRoute && typeof currentRoute.params === 'object') {
        for (var key in currentRoute.params) {
          if (!(key in location.params) && paramNames.indexOf(key) > -1) {
            location.params[key] = currentRoute.params[key]
          }
        }
      }

      if (record) {
        location.path = fillParams(record.path, location.params, ("named route \"" + name + "\""))
        return _createRoute(record, location, redirectedFrom)
      }
    } else if (location.path) {
      location.params = {}
      for (var path in pathMap) {
        if (matchRoute(path, location.params, location.path)) {
          return _createRoute(pathMap[path], location, redirectedFrom)
        }
      }
    }
    // no match
    return _createRoute(null, location)
  }

  function redirect (
    record,
    location
  ) {
    var originalRedirect = record.redirect
    var redirect = typeof originalRedirect === 'function'
        ? originalRedirect(createRoute(record, location))
        : originalRedirect

    if (typeof redirect === 'string') {
      redirect = { path: redirect }
    }

    if (!redirect || typeof redirect !== 'object') {
      process.env.NODE_ENV !== 'production' && warn(
        false, ("invalid redirect option: " + (JSON.stringify(redirect)))
      )
      return _createRoute(null, location)
    }

    var re = redirect
    var name = re.name;
    var path = re.path;
    var query = location.query;
    var hash = location.hash;
    var params = location.params;
    query = re.hasOwnProperty('query') ? re.query : query
    hash = re.hasOwnProperty('hash') ? re.hash : hash
    params = re.hasOwnProperty('params') ? re.params : params

    if (name) {
      // resolved named direct
      var targetRecord = nameMap[name]
      if (process.env.NODE_ENV !== 'production') {
        assert(targetRecord, ("redirect failed: named route \"" + name + "\" not found."))
      }
      return match({
        _normalized: true,
        name: name,
        query: query,
        hash: hash,
        params: params
      }, undefined, location)
    } else if (path) {
      // 1. resolve relative redirect
      var rawPath = resolveRecordPath(path, record)
      // 2. resolve params
      var resolvedPath = fillParams(rawPath, params, ("redirect route with path \"" + rawPath + "\""))
      // 3. rematch with existing query and hash
      return match({
        _normalized: true,
        path: resolvedPath,
        query: query,
        hash: hash
      }, undefined, location)
    } else {
      warn(false, ("invalid redirect option: " + (JSON.stringify(redirect))))
      return _createRoute(null, location)
    }
  }

  function alias (
    record,
    location,
    matchAs
  ) {
    var aliasedPath = fillParams(matchAs, location.params, ("aliased route with path \"" + matchAs + "\""))
    var aliasedMatch = match({
      _normalized: true,
      path: aliasedPath
    })
    if (aliasedMatch) {
      var matched = aliasedMatch.matched
      var aliasedRecord = matched[matched.length - 1]
      location.params = aliasedMatch.params
      return _createRoute(aliasedRecord, location)
    }
    return _createRoute(null, location)
  }

  function _createRoute (
    record,
    location,
    redirectedFrom
  ) {
    if (record && record.redirect) {
      return redirect(record, redirectedFrom || location)
    }
    if (record && record.matchAs) {
      return alias(record, location, record.matchAs)
    }
    return createRoute(record, location, redirectedFrom)
  }

  return match
}

function matchRoute (
  path,
  params,
  pathname
) {
  var ref = getRouteRegex(path);
  var regexp = ref.regexp;
  var keys = ref.keys;
  var m = pathname.match(regexp)

  if (!m) {
    return false
  } else if (!params) {
    return true
  }

  for (var i = 1, len = m.length; i < len; ++i) {
    var key = keys[i - 1]
    var val = typeof m[i] === 'string' ? decodeURIComponent(m[i]) : m[i]
    if (key) { params[key.name] = val }
  }

  return true
}

function resolveRecordPath (path, record) {
  return resolvePath(path, record.parent ? record.parent.path : '/', true)
}

/*  */

var inBrowser = typeof window !== 'undefined'

var supportsHistory = inBrowser && (function () {
  var ua = window.navigator.userAgent

  if (
    (ua.indexOf('Android 2.') !== -1 || ua.indexOf('Android 4.0') !== -1) &&
    ua.indexOf('Mobile Safari') !== -1 &&
    ua.indexOf('Chrome') === -1 &&
    ua.indexOf('Windows Phone') === -1
  ) {
    return false
  }

  return window.history && 'pushState' in window.history
})()

/*  */

function runQueue (queue, fn, cb) {
  var step = function (index) {
    if (index >= queue.length) {
      cb()
    } else {
      if (queue[index]) {
        fn(queue[index], function () {
          step(index + 1)
        })
      } else {
        step(index + 1)
      }
    }
  }
  step(0)
}

/*  */


var History = function History (router, base) {
  this.router = router
  this.base = normalizeBase(base)
  // start with a route object that stands for "nowhere"
  this.current = START
  this.pending = null
};

History.prototype.listen = function listen (cb) {
  this.cb = cb
};

History.prototype.transitionTo = function transitionTo (location, onComplete, onAbort) {
    var this$1 = this;

  var route = this.router.match(location, this.current)
  this.confirmTransition(route, function () {
    this$1.updateRoute(route)
    onComplete && onComplete(route)
    this$1.ensureURL()
  }, onAbort)
};

History.prototype.confirmTransition = function confirmTransition (route, onComplete, onAbort) {
    var this$1 = this;

  var current = this.current
  var abort = function () { onAbort && onAbort() }
  if (isSameRoute(route, current)) {
    this.ensureURL()
    return abort()
  }

  var ref = resolveQueue(this.current.matched, route.matched);
    var deactivated = ref.deactivated;
    var activated = ref.activated;

  var queue = [].concat(
    // in-component leave guards
    extractLeaveGuards(deactivated),
    // global before hooks
    this.router.beforeHooks,
    // enter guards
    activated.map(function (m) { return m.beforeEnter; }),
    // async components
    resolveAsyncComponents(activated)
  )

  this.pending = route
  var iterator = function (hook, next) {
    if (this$1.pending !== route) {
      return abort()
    }
    hook(route, current, function (to) {
      if (to === false) {
        // next(false) -> abort navigation, ensure current URL
        this$1.ensureURL(true)
        abort()
      } else if (typeof to === 'string' || typeof to === 'object') {
        // next('/') or next({ path: '/' }) -> redirect
        (typeof to === 'object' && to.replace) ? this$1.replace(to) : this$1.push(to)
        abort()
      } else {
        // confirm transition and pass on the value
        next(to)
      }
    })
  }

  runQueue(queue, iterator, function () {
    var postEnterCbs = []
    var enterGuards = extractEnterGuards(activated, postEnterCbs, function () {
      return this$1.current === route
    })
    // wait until async components are resolved before
    // extracting in-component enter guards
    runQueue(enterGuards, iterator, function () {
      if (this$1.pending !== route) {
        return abort()
      }
      this$1.pending = null
      onComplete(route)
      if (this$1.router.app) {
        this$1.router.app.$nextTick(function () {
          postEnterCbs.forEach(function (cb) { return cb(); })
        })
      }
    })
  })
};

History.prototype.updateRoute = function updateRoute (route) {
  var prev = this.current
  this.current = route
  this.cb && this.cb(route)
  this.router.afterHooks.forEach(function (hook) {
    hook && hook(route, prev)
  })
};

function normalizeBase (base) {
  if (!base) {
    if (inBrowser) {
      // respect <base> tag
      var baseEl = document.querySelector('base')
      base = baseEl ? baseEl.getAttribute('href') : '/'
    } else {
      base = '/'
    }
  }
  // make sure there's the starting slash
  if (base.charAt(0) !== '/') {
    base = '/' + base
  }
  // remove trailing slash
  return base.replace(/\/$/, '')
}

function resolveQueue (
  current,
  next
) {
  var i
  var max = Math.max(current.length, next.length)
  for (i = 0; i < max; i++) {
    if (current[i] !== next[i]) {
      break
    }
  }
  return {
    activated: next.slice(i),
    deactivated: current.slice(i)
  }
}

function extractGuard (
  def,
  key
) {
  if (typeof def !== 'function') {
    // extend now so that global mixins are applied.
    def = _Vue.extend(def)
  }
  return def.options[key]
}

function extractLeaveGuards (matched) {
  return flatten(flatMapComponents(matched, function (def, instance) {
    var guard = extractGuard(def, 'beforeRouteLeave')
    if (guard) {
      return Array.isArray(guard)
        ? guard.map(function (guard) { return wrapLeaveGuard(guard, instance); })
        : wrapLeaveGuard(guard, instance)
    }
  }).reverse())
}

function wrapLeaveGuard (
  guard,
  instance
) {
  return function routeLeaveGuard () {
    return guard.apply(instance, arguments)
  }
}

function extractEnterGuards (
  matched,
  cbs,
  isValid
) {
  return flatten(flatMapComponents(matched, function (def, _, match, key) {
    var guard = extractGuard(def, 'beforeRouteEnter')
    if (guard) {
      return Array.isArray(guard)
        ? guard.map(function (guard) { return wrapEnterGuard(guard, cbs, match, key, isValid); })
        : wrapEnterGuard(guard, cbs, match, key, isValid)
    }
  }))
}

function wrapEnterGuard (
  guard,
  cbs,
  match,
  key,
  isValid
) {
  return function routeEnterGuard (to, from, next) {
    return guard(to, from, function (cb) {
      next(cb)
      if (typeof cb === 'function') {
        cbs.push(function () {
          // #750
          // if a router-view is wrapped with an out-in transition,
          // the instance may not have been registered at this time.
          // we will need to poll for registration until current route
          // is no longer valid.
          poll(cb, match.instances, key, isValid)
        })
      }
    })
  }
}

function poll (
  cb, // somehow flow cannot infer this is a function
  instances,
  key,
  isValid
) {
  if (instances[key]) {
    cb(instances[key])
  } else if (isValid()) {
    setTimeout(function () {
      poll(cb, instances, key, isValid)
    }, 16)
  }
}

function resolveAsyncComponents (matched) {
  return flatMapComponents(matched, function (def, _, match, key) {
    // if it's a function and doesn't have Vue options attached,
    // assume it's an async component resolve function.
    // we are not using Vue's default async resolving mechanism because
    // we want to halt the navigation until the incoming component has been
    // resolved.
    if (typeof def === 'function' && !def.options) {
      return function (to, from, next) {
        var resolve = function (resolvedDef) {
          match.components[key] = resolvedDef
          next()
        }

        var reject = function (reason) {
          warn(false, ("Failed to resolve async component " + key + ": " + reason))
          next(false)
        }

        var res = def(resolve, reject)
        if (res && typeof res.then === 'function') {
          res.then(resolve, reject)
        }
      }
    }
  })
}

function flatMapComponents (
  matched,
  fn
) {
  return flatten(matched.map(function (m) {
    return Object.keys(m.components).map(function (key) { return fn(
      m.components[key],
      m.instances[key],
      m, key
    ); })
  }))
}

function flatten (arr) {
  return Array.prototype.concat.apply([], arr)
}

/*  */

var positionStore = Object.create(null)

function saveScrollPosition (key) {
  if (!key) { return }
  positionStore[key] = {
    x: window.pageXOffset,
    y: window.pageYOffset
  }
}

function getScrollPosition (key) {
  if (!key) { return }
  return positionStore[key]
}

function getElementPosition (el) {
  var docRect = document.documentElement.getBoundingClientRect()
  var elRect = el.getBoundingClientRect()
  return {
    x: elRect.left - docRect.left,
    y: elRect.top - docRect.top
  }
}

function isValidPosition (obj) {
  return isNumber(obj.x) || isNumber(obj.y)
}

function normalizePosition (obj) {
  return {
    x: isNumber(obj.x) ? obj.x : window.pageXOffset,
    y: isNumber(obj.y) ? obj.y : window.pageYOffset
  }
}

function isNumber (v) {
  return typeof v === 'number'
}

/*  */


var genKey = function () { return String(Date.now()); }
var _key = genKey()

var HTML5History = (function (History) {
  function HTML5History (router, base) {
    var this$1 = this;

    History.call(this, router, base)

    var expectScroll = router.options.scrollBehavior
    window.addEventListener('popstate', function (e) {
      _key = e.state && e.state.key
      var current = this$1.current
      this$1.transitionTo(getLocation(this$1.base), function (next) {
        if (expectScroll) {
          this$1.handleScroll(next, current, true)
        }
      })
    })

    if (expectScroll) {
      window.addEventListener('scroll', function () {
        saveScrollPosition(_key)
      })
    }
  }

  if ( History ) HTML5History.__proto__ = History;
  HTML5History.prototype = Object.create( History && History.prototype );
  HTML5History.prototype.constructor = HTML5History;

  HTML5History.prototype.go = function go (n) {
    window.history.go(n)
  };

  HTML5History.prototype.push = function push (location) {
    var this$1 = this;

    var current = this.current
    this.transitionTo(location, function (route) {
      pushState(cleanPath(this$1.base + route.fullPath))
      this$1.handleScroll(route, current, false)
    })
  };

  HTML5History.prototype.replace = function replace (location) {
    var this$1 = this;

    var current = this.current
    this.transitionTo(location, function (route) {
      replaceState(cleanPath(this$1.base + route.fullPath))
      this$1.handleScroll(route, current, false)
    })
  };

  HTML5History.prototype.ensureURL = function ensureURL (push) {
    if (getLocation(this.base) !== this.current.fullPath) {
      var current = cleanPath(this.base + this.current.fullPath)
      push ? pushState(current) : replaceState(current)
    }
  };

  HTML5History.prototype.handleScroll = function handleScroll (to, from, isPop) {
    var router = this.router
    if (!router.app) {
      return
    }

    var behavior = router.options.scrollBehavior
    if (!behavior) {
      return
    }
    if (process.env.NODE_ENV !== 'production') {
      assert(typeof behavior === 'function', "scrollBehavior must be a function")
    }

    // wait until re-render finishes before scrolling
    router.app.$nextTick(function () {
      var position = getScrollPosition(_key)
      var shouldScroll = behavior(to, from, isPop ? position : null)
      if (!shouldScroll) {
        return
      }
      var isObject = typeof shouldScroll === 'object'
      if (isObject && typeof shouldScroll.selector === 'string') {
        var el = document.querySelector(shouldScroll.selector)
        if (el) {
          position = getElementPosition(el)
        } else if (isValidPosition(shouldScroll)) {
          position = normalizePosition(shouldScroll)
        }
      } else if (isObject && isValidPosition(shouldScroll)) {
        position = normalizePosition(shouldScroll)
      }

      if (position) {
        window.scrollTo(position.x, position.y)
      }
    })
  };

  return HTML5History;
}(History));

function getLocation (base) {
  var path = window.location.pathname
  if (base && path.indexOf(base) === 0) {
    path = path.slice(base.length)
  }
  return (path || '/') + window.location.search + window.location.hash
}

function pushState (url, replace) {
  // try...catch the pushState call to get around Safari
  // DOM Exception 18 where it limits to 100 pushState calls
  var history = window.history
  try {
    if (replace) {
      history.replaceState({ key: _key }, '', url)
    } else {
      _key = genKey()
      history.pushState({ key: _key }, '', url)
    }
    saveScrollPosition(_key)
  } catch (e) {
    window.location[replace ? 'assign' : 'replace'](url)
  }
}

function replaceState (url) {
  pushState(url, true)
}

/*  */


var HashHistory = (function (History) {
  function HashHistory (router, base, fallback) {
    History.call(this, router, base)
    // check history fallback deeplinking
    if (fallback && this.checkFallback()) {
      return
    }
    ensureSlash()
  }

  if ( History ) HashHistory.__proto__ = History;
  HashHistory.prototype = Object.create( History && History.prototype );
  HashHistory.prototype.constructor = HashHistory;

  HashHistory.prototype.checkFallback = function checkFallback () {
    var location = getLocation(this.base)
    if (!/^\/#/.test(location)) {
      window.location.replace(
        cleanPath(this.base + '/#' + location)
      )
      return true
    }
  };

  HashHistory.prototype.onHashChange = function onHashChange () {
    if (!ensureSlash()) {
      return
    }
    this.transitionTo(getHash(), function (route) {
      replaceHash(route.fullPath)
    })
  };

  HashHistory.prototype.push = function push (location) {
    this.transitionTo(location, function (route) {
      pushHash(route.fullPath)
    })
  };

  HashHistory.prototype.replace = function replace (location) {
    this.transitionTo(location, function (route) {
      replaceHash(route.fullPath)
    })
  };

  HashHistory.prototype.go = function go (n) {
    window.history.go(n)
  };

  HashHistory.prototype.ensureURL = function ensureURL (push) {
    var current = this.current.fullPath
    if (getHash() !== current) {
      push ? pushHash(current) : replaceHash(current)
    }
  };

  return HashHistory;
}(History));

function ensureSlash () {
  var path = getHash()
  if (path.charAt(0) === '/') {
    return true
  }
  replaceHash('/' + path)
  return false
}

function getHash () {
  // We can't use window.location.hash here because it's not
  // consistent across browsers - Firefox will pre-decode it!
  var href = window.location.href
  var index = href.indexOf('#')
  return index === -1 ? '' : href.slice(index + 1)
}

function pushHash (path) {
  window.location.hash = path
}

function replaceHash (path) {
  var i = window.location.href.indexOf('#')
  window.location.replace(
    window.location.href.slice(0, i >= 0 ? i : 0) + '#' + path
  )
}

/*  */


var AbstractHistory = (function (History) {
  function AbstractHistory (router) {
    History.call(this, router)
    this.stack = []
    this.index = -1
  }

  if ( History ) AbstractHistory.__proto__ = History;
  AbstractHistory.prototype = Object.create( History && History.prototype );
  AbstractHistory.prototype.constructor = AbstractHistory;

  AbstractHistory.prototype.push = function push (location) {
    var this$1 = this;

    this.transitionTo(location, function (route) {
      this$1.stack = this$1.stack.slice(0, this$1.index + 1).concat(route)
      this$1.index++
    })
  };

  AbstractHistory.prototype.replace = function replace (location) {
    var this$1 = this;

    this.transitionTo(location, function (route) {
      this$1.stack = this$1.stack.slice(0, this$1.index).concat(route)
    })
  };

  AbstractHistory.prototype.go = function go (n) {
    var this$1 = this;

    var targetIndex = this.index + n
    if (targetIndex < 0 || targetIndex >= this.stack.length) {
      return
    }
    var route = this.stack[targetIndex]
    this.confirmTransition(route, function () {
      this$1.index = targetIndex
      this$1.updateRoute(route)
    })
  };

  AbstractHistory.prototype.ensureURL = function ensureURL () {
    // noop
  };

  return AbstractHistory;
}(History));

/*  */

var VueRouter = function VueRouter (options) {
  if ( options === void 0 ) options = {};

  this.app = null
  this.options = options
  this.beforeHooks = []
  this.afterHooks = []
  this.match = createMatcher(options.routes || [])

  var mode = options.mode || 'hash'
  this.fallback = mode === 'history' && !supportsHistory
  if (this.fallback) {
    mode = 'hash'
  }
  if (!inBrowser) {
    mode = 'abstract'
  }
  this.mode = mode

  switch (mode) {
    case 'history':
      this.history = new HTML5History(this, options.base)
      break
    case 'hash':
      this.history = new HashHistory(this, options.base, this.fallback)
      break
    case 'abstract':
      this.history = new AbstractHistory(this)
      break
    default:
      process.env.NODE_ENV !== 'production' && assert(false, ("invalid mode: " + mode))
  }
};

var prototypeAccessors = { currentRoute: {} };

prototypeAccessors.currentRoute.get = function () {
  return this.history && this.history.current
};

VueRouter.prototype.init = function init (app /* Vue component instance */) {
    var this$1 = this;

  process.env.NODE_ENV !== 'production' && assert(
    install.installed,
    "not installed. Make sure to call `Vue.use(VueRouter)` " +
    "before creating root instance."
  )

  this.app = app

  var history = this.history

  if (history instanceof HTML5History) {
    history.transitionTo(getLocation(history.base))
  } else if (history instanceof HashHistory) {
    var setupHashListener = function () {
      window.addEventListener('hashchange', function () {
        history.onHashChange()
      })
    }
    history.transitionTo(getHash(), setupHashListener, setupHashListener)
  }

  history.listen(function (route) {
    this$1.app._route = route
  })
};

VueRouter.prototype.beforeEach = function beforeEach (fn) {
  this.beforeHooks.push(fn)
};

VueRouter.prototype.afterEach = function afterEach (fn) {
  this.afterHooks.push(fn)
};

VueRouter.prototype.push = function push (location) {
  this.history.push(location)
};

VueRouter.prototype.replace = function replace (location) {
  this.history.replace(location)
};

VueRouter.prototype.go = function go (n) {
  this.history.go(n)
};

VueRouter.prototype.back = function back () {
  this.go(-1)
};

VueRouter.prototype.forward = function forward () {
  this.go(1)
};

VueRouter.prototype.getMatchedComponents = function getMatchedComponents (to) {
  var route = to
    ? this.resolve(to).resolved
    : this.currentRoute
  if (!route) {
    return []
  }
  return [].concat.apply([], route.matched.map(function (m) {
    return Object.keys(m.components).map(function (key) {
      return m.components[key]
    })
  }))
};

VueRouter.prototype.resolve = function resolve (
  to,
  current,
  append
) {
  var normalizedTo = normalizeLocation(to, current || this.history.current, append)
  var resolved = this.match(normalizedTo, current)
  var fullPath = resolved.redirectedFrom || resolved.fullPath
  var base = this.history.base
  var href = createHref(base, fullPath, this.mode)
  return {
    normalizedTo: normalizedTo,
    resolved: resolved,
    href: href
  }
};

Object.defineProperties( VueRouter.prototype, prototypeAccessors );

function createHref (base, fullPath, mode) {
  var path = mode === 'hash' ? '#' + fullPath : fullPath
  return base ? cleanPath(base + '/' + path) : path
}

VueRouter.install = install

if (inBrowser && window.Vue) {
  window.Vue.use(VueRouter)
}

module.exports = VueRouter;
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(8)))

/***/ },
/* 3 */
/***/ function(module, exports, __webpack_require__) {

/**
 * vuex v2.1.1
 * (c) 2016 Evan You
 * @license MIT
 */
(function (global, factory) {
   true ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global.Vuex = factory());
}(this, (function () { 'use strict';

var devtoolHook =
  typeof window !== 'undefined' &&
  window.__VUE_DEVTOOLS_GLOBAL_HOOK__

function devtoolPlugin (store) {
  if (!devtoolHook) { return }

  store._devtoolHook = devtoolHook

  devtoolHook.emit('vuex:init', store)

  devtoolHook.on('vuex:travel-to-state', function (targetState) {
    store.replaceState(targetState)
  })

  store.subscribe(function (mutation, state) {
    devtoolHook.emit('vuex:mutation', mutation, state)
  })
}

function applyMixin (Vue) {
  var version = Number(Vue.version.split('.')[0])

  if (version >= 2) {
    var usesInit = Vue.config._lifecycleHooks.indexOf('init') > -1
    Vue.mixin(usesInit ? { init: vuexInit } : { beforeCreate: vuexInit })
  } else {
    // override init and inject vuex init procedure
    // for 1.x backwards compatibility.
    var _init = Vue.prototype._init
    Vue.prototype._init = function (options) {
      if ( options === void 0 ) options = {};

      options.init = options.init
        ? [vuexInit].concat(options.init)
        : vuexInit
      _init.call(this, options)
    }
  }

  /**
   * Vuex init hook, injected into each instances init hooks list.
   */

  function vuexInit () {
    var options = this.$options
    // store injection
    if (options.store) {
      this.$store = options.store
    } else if (options.parent && options.parent.$store) {
      this.$store = options.parent.$store
    }
  }
}

var mapState = normalizeNamespace(function (namespace, states) {
  var res = {}
  normalizeMap(states).forEach(function (ref) {
    var key = ref.key;
    var val = ref.val;

    res[key] = function mappedState () {
      var state = this.$store.state
      var getters = this.$store.getters
      if (namespace) {
        var module = this.$store._modulesNamespaceMap[namespace]
        if (!module) {
          warnNamespace('mapState', namespace)
          return
        }
        state = module.state
        getters = module.context.getters
      }
      return typeof val === 'function'
        ? val.call(this, state, getters)
        : state[val]
    }
  })
  return res
})

var mapMutations = normalizeNamespace(function (namespace, mutations) {
  var res = {}
  normalizeMap(mutations).forEach(function (ref) {
    var key = ref.key;
    var val = ref.val;

    val = namespace + val
    res[key] = function mappedMutation () {
      var args = [], len = arguments.length;
      while ( len-- ) args[ len ] = arguments[ len ];

      return this.$store.commit.apply(this.$store, [val].concat(args))
    }
  })
  return res
})

var mapGetters = normalizeNamespace(function (namespace, getters) {
  var res = {}
  normalizeMap(getters).forEach(function (ref) {
    var key = ref.key;
    var val = ref.val;

    val = namespace + val
    res[key] = function mappedGetter () {
      if (!(val in this.$store.getters)) {
        console.error(("[vuex] unknown getter: " + val))
      }
      return this.$store.getters[val]
    }
  })
  return res
})

var mapActions = normalizeNamespace(function (namespace, actions) {
  var res = {}
  normalizeMap(actions).forEach(function (ref) {
    var key = ref.key;
    var val = ref.val;

    val = namespace + val
    res[key] = function mappedAction () {
      var args = [], len = arguments.length;
      while ( len-- ) args[ len ] = arguments[ len ];

      return this.$store.dispatch.apply(this.$store, [val].concat(args))
    }
  })
  return res
})

function normalizeMap (map) {
  return Array.isArray(map)
    ? map.map(function (key) { return ({ key: key, val: key }); })
    : Object.keys(map).map(function (key) { return ({ key: key, val: map[key] }); })
}

function normalizeNamespace (fn) {
  return function (namespace, map) {
    if (typeof namespace !== 'string') {
      map = namespace
      namespace = ''
    } else if (namespace.charAt(namespace.length - 1) !== '/') {
      namespace += '/'
    }
    return fn(namespace, map)
  }
}

function warnNamespace (helper, namespace) {
  console.error(("[vuex] module namespace not found in " + helper + "(): " + namespace))
}

/**
 * forEach for object
 */
function forEachValue (obj, fn) {
  Object.keys(obj).forEach(function (key) { return fn(obj[key], key); })
}

function isObject (obj) {
  return obj !== null && typeof obj === 'object'
}

function isPromise (val) {
  return val && typeof val.then === 'function'
}

function assert (condition, msg) {
  if (!condition) { throw new Error(("[vuex] " + msg)) }
}

var Module = function Module (rawModule, runtime) {
  this.runtime = runtime
  this._children = Object.create(null)
  this._rawModule = rawModule
};

var prototypeAccessors$1 = { state: {},namespaced: {} };

prototypeAccessors$1.state.get = function () {
  return this._rawModule.state || {}
};

prototypeAccessors$1.namespaced.get = function () {
  return !!this._rawModule.namespaced
};

Module.prototype.addChild = function addChild (key, module) {
  this._children[key] = module
};

Module.prototype.removeChild = function removeChild (key) {
  delete this._children[key]
};

Module.prototype.getChild = function getChild (key) {
  return this._children[key]
};

Module.prototype.update = function update (rawModule) {
  this._rawModule.namespaced = rawModule.namespaced
  if (rawModule.actions) {
    this._rawModule.actions = rawModule.actions
  }
  if (rawModule.mutations) {
    this._rawModule.mutations = rawModule.mutations
  }
  if (rawModule.getters) {
    this._rawModule.getters = rawModule.getters
  }
};

Module.prototype.forEachChild = function forEachChild (fn) {
  forEachValue(this._children, fn)
};

Module.prototype.forEachGetter = function forEachGetter (fn) {
  if (this._rawModule.getters) {
    forEachValue(this._rawModule.getters, fn)
  }
};

Module.prototype.forEachAction = function forEachAction (fn) {
  if (this._rawModule.actions) {
    forEachValue(this._rawModule.actions, fn)
  }
};

Module.prototype.forEachMutation = function forEachMutation (fn) {
  if (this._rawModule.mutations) {
    forEachValue(this._rawModule.mutations, fn)
  }
};

Object.defineProperties( Module.prototype, prototypeAccessors$1 );

var ModuleCollection = function ModuleCollection (rawRootModule) {
  var this$1 = this;

  // register root module (Vuex.Store options)
  this.root = new Module(rawRootModule, false)

  // register all nested modules
  if (rawRootModule.modules) {
    forEachValue(rawRootModule.modules, function (rawModule, key) {
      this$1.register([key], rawModule, false)
    })
  }
};

ModuleCollection.prototype.get = function get (path) {
  return path.reduce(function (module, key) {
    return module.getChild(key)
  }, this.root)
};

ModuleCollection.prototype.getNamespace = function getNamespace (path) {
  var module = this.root
  return path.reduce(function (namespace, key) {
    module = module.getChild(key)
    return namespace + (module.namespaced ? key + '/' : '')
  }, '')
};

ModuleCollection.prototype.update = function update$1 (rawRootModule) {
  update(this.root, rawRootModule)
};

ModuleCollection.prototype.register = function register (path, rawModule, runtime) {
    var this$1 = this;
    if ( runtime === void 0 ) runtime = true;

  var parent = this.get(path.slice(0, -1))
  var newModule = new Module(rawModule, runtime)
  parent.addChild(path[path.length - 1], newModule)

  // register nested modules
  if (rawModule.modules) {
    forEachValue(rawModule.modules, function (rawChildModule, key) {
      this$1.register(path.concat(key), rawChildModule, runtime)
    })
  }
};

ModuleCollection.prototype.unregister = function unregister (path) {
  var parent = this.get(path.slice(0, -1))
  var key = path[path.length - 1]
  if (!parent.getChild(key).runtime) { return }

  parent.removeChild(key)
};

function update (targetModule, newModule) {
  // update target module
  targetModule.update(newModule)

  // update nested modules
  if (newModule.modules) {
    for (var key in newModule.modules) {
      if (!targetModule.getChild(key)) {
        console.warn(
          "[vuex] trying to add a new module '" + key + "' on hot reloading, " +
          'manual reload is needed'
        )
        return
      }
      update(targetModule.getChild(key), newModule.modules[key])
    }
  }
}

var Vue // bind on install

var Store = function Store (options) {
  var this$1 = this;
  if ( options === void 0 ) options = {};

  assert(Vue, "must call Vue.use(Vuex) before creating a store instance.")
  assert(typeof Promise !== 'undefined', "vuex requires a Promise polyfill in this browser.")

  var state = options.state; if ( state === void 0 ) state = {};
  var plugins = options.plugins; if ( plugins === void 0 ) plugins = [];
  var strict = options.strict; if ( strict === void 0 ) strict = false;

  // store internal state
  this._committing = false
  this._actions = Object.create(null)
  this._mutations = Object.create(null)
  this._wrappedGetters = Object.create(null)
  this._modules = new ModuleCollection(options)
  this._modulesNamespaceMap = Object.create(null)
  this._subscribers = []
  this._watcherVM = new Vue()

  // bind commit and dispatch to self
  var store = this
  var ref = this;
  var dispatch = ref.dispatch;
  var commit = ref.commit;
    this.dispatch = function boundDispatch (type, payload) {
    return dispatch.call(store, type, payload)
  }
  this.commit = function boundCommit (type, payload, options) {
    return commit.call(store, type, payload, options)
    }

    // strict mode
  this.strict = strict

  // init root module.
  // this also recursively registers all sub-modules
  // and collects all module getters inside this._wrappedGetters
  installModule(this, state, [], this._modules.root)

  // initialize the store vm, which is responsible for the reactivity
  // (also registers _wrappedGetters as computed properties)
  resetStoreVM(this, state)

  // apply plugins
  plugins.concat(devtoolPlugin).forEach(function (plugin) { return plugin(this$1); })
};

var prototypeAccessors = { state: {} };

prototypeAccessors.state.get = function () {
  return this._vm.$data.state
};

prototypeAccessors.state.set = function (v) {
  assert(false, "Use store.replaceState() to explicit replace store state.")
};

Store.prototype.commit = function commit (_type, _payload, _options) {
    var this$1 = this;

  // check object-style commit
  var ref = unifyObjectStyle(_type, _payload, _options);
    var type = ref.type;
    var payload = ref.payload;
    var options = ref.options;

  var mutation = { type: type, payload: payload }
  var entry = this._mutations[type]
  if (!entry) {
    console.error(("[vuex] unknown mutation type: " + type))
    return
  }
  this._withCommit(function () {
    entry.forEach(function commitIterator (handler) {
      handler(payload)
    })
  })
  this._subscribers.forEach(function (sub) { return sub(mutation, this$1.state); })

  if (options && options.silent) {
    console.warn(
      "[vuex] mutation type: " + type + ". Silent option has been removed. " +
      'Use the filter functionality in the vue-devtools'
    )
  }
};

Store.prototype.dispatch = function dispatch (_type, _payload) {
  // check object-style dispatch
  var ref = unifyObjectStyle(_type, _payload);
    var type = ref.type;
    var payload = ref.payload;

  var entry = this._actions[type]
  if (!entry) {
    console.error(("[vuex] unknown action type: " + type))
    return
  }
  return entry.length > 1
    ? Promise.all(entry.map(function (handler) { return handler(payload); }))
    : entry[0](payload)
};

Store.prototype.subscribe = function subscribe (fn) {
  var subs = this._subscribers
  if (subs.indexOf(fn) < 0) {
    subs.push(fn)
  }
  return function () {
    var i = subs.indexOf(fn)
    if (i > -1) {
      subs.splice(i, 1)
    }
  }
};

Store.prototype.watch = function watch (getter, cb, options) {
    var this$1 = this;

  assert(typeof getter === 'function', "store.watch only accepts a function.")
  return this._watcherVM.$watch(function () { return getter(this$1.state, this$1.getters); }, cb, options)
};

Store.prototype.replaceState = function replaceState (state) {
    var this$1 = this;

  this._withCommit(function () {
    this$1._vm.state = state
  })
};

Store.prototype.registerModule = function registerModule (path, rawModule) {
  if (typeof path === 'string') { path = [path] }
  assert(Array.isArray(path), "module path must be a string or an Array.")
  this._modules.register(path, rawModule)
  installModule(this, this.state, path, this._modules.get(path))
  // reset store to update getters...
  resetStoreVM(this, this.state)
};

Store.prototype.unregisterModule = function unregisterModule (path) {
    var this$1 = this;

  if (typeof path === 'string') { path = [path] }
  assert(Array.isArray(path), "module path must be a string or an Array.")
    this._modules.unregister(path)
  this._withCommit(function () {
    var parentState = getNestedState(this$1.state, path.slice(0, -1))
    Vue.delete(parentState, path[path.length - 1])
  })
  resetStore(this)
};

Store.prototype.hotUpdate = function hotUpdate (newOptions) {
  this._modules.update(newOptions)
  resetStore(this)
};

Store.prototype._withCommit = function _withCommit (fn) {
  var committing = this._committing
  this._committing = true
  fn()
  this._committing = committing
};

Object.defineProperties( Store.prototype, prototypeAccessors );

function resetStore (store) {
  store._actions = Object.create(null)
  store._mutations = Object.create(null)
  store._wrappedGetters = Object.create(null)
  store._modulesNamespaceMap = Object.create(null)
  var state = store.state
  // init all modules
  installModule(store, state, [], store._modules.root, true)
  // reset vm
  resetStoreVM(store, state)
}

function resetStoreVM (store, state) {
  var oldVm = store._vm

  // bind store public getters
  store.getters = {}
  var wrappedGetters = store._wrappedGetters
  var computed = {}
  forEachValue(wrappedGetters, function (fn, key) {
    // use computed to leverage its lazy-caching mechanism
    computed[key] = function () { return fn(store); }
    Object.defineProperty(store.getters, key, {
      get: function () { return store._vm[key]; },
      enumerable: true // for local getters
    })
  })

  // use a Vue instance to store the state tree
  // suppress warnings just in case the user has added
  // some funky global mixins
  var silent = Vue.config.silent
  Vue.config.silent = true
  store._vm = new Vue({
    data: { state: state },
    computed: computed
  })
  Vue.config.silent = silent

  // enable strict mode for new vm
  if (store.strict) {
    enableStrictMode(store)
  }

  if (oldVm) {
    // dispatch changes in all subscribed watchers
    // to force getter re-evaluation.
    store._withCommit(function () {
      oldVm.state = null
    })
    Vue.nextTick(function () { return oldVm.$destroy(); })
  }
}

function installModule (store, rootState, path, module, hot) {
  var isRoot = !path.length
  var namespace = store._modules.getNamespace(path)

  // register in namespace map
  if (namespace) {
    store._modulesNamespaceMap[namespace] = module
  }

  // set state
  if (!isRoot && !hot) {
    var parentState = getNestedState(rootState, path.slice(0, -1))
    var moduleName = path[path.length - 1]
    store._withCommit(function () {
      Vue.set(parentState, moduleName, module.state)
    })
  }

  var local = module.context = makeLocalContext(store, namespace)

  module.forEachMutation(function (mutation, key) {
    var namespacedType = namespace + key
    registerMutation(store, namespacedType, mutation, path)
  })

  module.forEachAction(function (action, key) {
    var namespacedType = namespace + key
    registerAction(store, namespacedType, action, local, path)
  })

  module.forEachGetter(function (getter, key) {
    var namespacedType = namespace + key
    registerGetter(store, namespacedType, getter, local, path)
  })

  module.forEachChild(function (child, key) {
    installModule(store, rootState, path.concat(key), child, hot)
  })
}

/**
 * make localized dispatch, commit and getters
 * if there is no namespace, just use root ones
 */
function makeLocalContext (store, namespace) {
  var noNamespace = namespace === ''

  var local = {
    dispatch: noNamespace ? store.dispatch : function (_type, _payload, _options) {
      var args = unifyObjectStyle(_type, _payload, _options)
      var payload = args.payload;
      var options = args.options;
      var type = args.type;

      if (!options || !options.root) {
        type = namespace + type
        if (!store._actions[type]) {
          console.error(("[vuex] unknown local action type: " + (args.type) + ", global type: " + type))
          return
        }
      }

      return store.dispatch(type, payload)
    },

    commit: noNamespace ? store.commit : function (_type, _payload, _options) {
      var args = unifyObjectStyle(_type, _payload, _options)
      var payload = args.payload;
      var options = args.options;
      var type = args.type;

      if (!options || !options.root) {
        type = namespace + type
        if (!store._mutations[type]) {
          console.error(("[vuex] unknown local mutation type: " + (args.type) + ", global type: " + type))
          return
        }
      }

      store.commit(type, payload, options)
    }
  }

  // getters object must be gotten lazily
  // because store.getters will be changed by vm update
  Object.defineProperty(local, 'getters', {
    get: noNamespace ? function () { return store.getters; } : function () { return makeLocalGetters(store, namespace); }
  })

  return local
}

function makeLocalGetters (store, namespace) {
  var gettersProxy = {}

  var splitPos = namespace.length
  Object.keys(store.getters).forEach(function (type) {
    // skip if the target getter is not match this namespace
    if (type.slice(0, splitPos) !== namespace) { return }

    // extract local getter type
    var localType = type.slice(splitPos)

    // Add a port to the getters proxy.
    // Define as getter property because
    // we do not want to evaluate the getters in this time.
    Object.defineProperty(gettersProxy, localType, {
      get: function () { return store.getters[type]; },
      enumerable: true
    })
  })

  return gettersProxy
}

function registerMutation (store, type, handler, path) {
  var entry = store._mutations[type] || (store._mutations[type] = [])
  entry.push(function wrappedMutationHandler (payload) {
    handler(getNestedState(store.state, path), payload)
  })
}

function registerAction (store, type, handler, local, path) {
  var entry = store._actions[type] || (store._actions[type] = [])
  entry.push(function wrappedActionHandler (payload, cb) {
    var res = handler({
      dispatch: local.dispatch,
      commit: local.commit,
      getters: local.getters,
      state: getNestedState(store.state, path),
      rootGetters: store.getters,
      rootState: store.state
    }, payload, cb)
    if (!isPromise(res)) {
      res = Promise.resolve(res)
    }
    if (store._devtoolHook) {
      return res.catch(function (err) {
        store._devtoolHook.emit('vuex:error', err)
        throw err
      })
    } else {
      return res
    }
  })
}

function registerGetter (store, type, rawGetter, local, path) {
  if (store._wrappedGetters[type]) {
    console.error(("[vuex] duplicate getter key: " + type))
    return
  }
  store._wrappedGetters[type] = function wrappedGetter (store) {
    return rawGetter(
      getNestedState(store.state, path), // local state
      local.getters, // local getters
      store.state, // root state
      store.getters // root getters
    )
  }
}

function enableStrictMode (store) {
  store._vm.$watch('state', function () {
    assert(store._committing, "Do not mutate vuex store state outside mutation handlers.")
  }, { deep: true, sync: true })
}

function getNestedState (state, path) {
  return path.length
    ? path.reduce(function (state, key) { return state[key]; }, state)
    : state
}

function unifyObjectStyle (type, payload, options) {
  if (isObject(type) && type.type) {
    options = payload
    payload = type
    type = type.type
  }
  return { type: type, payload: payload, options: options }
}

function install (_Vue) {
  if (Vue) {
    console.error(
      '[vuex] already installed. Vue.use(Vuex) should be called only once.'
    )
    return
  }
  Vue = _Vue
  applyMixin(Vue)
}

// auto install in dist mode
if (typeof window !== 'undefined' && window.Vue) {
  install(window.Vue)
}

var index = {
  Store: Store,
  install: install,
  version: '2.1.1',
  mapState: mapState,
  mapMutations: mapMutations,
  mapGetters: mapGetters,
  mapActions: mapActions
}

return index;

})));

/***/ },
/* 4 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _cities = __webpack_require__(7);

var _cities2 = _interopRequireDefault(_cities);

var _areas = __webpack_require__(6);

var _areas2 = _interopRequireDefault(_areas);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var area_list = _areas2.default.default;

exports.default = {
    props: ['city', 'area', 'street'],
    data: function data() {
        return {
            cities: _cities2.default.default,
            address_input: { city: '', area: '', street: '' }
        };
    },
    computed: {
        option_areas: function option_areas() {
            return isEmpty(this.address_input.city) ? '' : area_list[this.address_input.city.id];
        }
    },
    methods: {
        refresh_area: function refresh_area() {
            this.address_input.area = '';
        },
        unset_street: function unset_street() {
            this.address_input.street = '';
            document.querySelector('#street').focus();
        }
    },
    beforeMount: function beforeMount() {
        this.address_input.street = this.street;

        if (hasCityAndArea(this)) {
            this.address_input.city = this.city;
            this.address_input.area = this.area;
        }
    }
};


function hasCityAndArea(comp) {
    return !(isEmpty(comp.city) || isEmpty(comp.area));
}

function isEmpty(source) {
    return undefined == source || '' == source;
}

/***/ },
/* 5 */
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
/* 6 */
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
/* 7 */
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
/* 8 */
/***/ function(module, exports) {

// shim for using process in browser
var process = module.exports = {};

// cached from whatever global is present so that test runners that stub it
// don't break things.  But we need to wrap it in a try catch in case it is
// wrapped in strict mode code which doesn't define any globals.  It's inside a
// function because try/catches deoptimize in certain engines.

var cachedSetTimeout;
var cachedClearTimeout;

function defaultSetTimout() {
    throw new Error('setTimeout has not been defined');
}
function defaultClearTimeout () {
    throw new Error('clearTimeout has not been defined');
}
(function () {
    try {
        if (typeof setTimeout === 'function') {
            cachedSetTimeout = setTimeout;
        } else {
            cachedSetTimeout = defaultSetTimout;
        }
    } catch (e) {
        cachedSetTimeout = defaultSetTimout;
    }
    try {
        if (typeof clearTimeout === 'function') {
            cachedClearTimeout = clearTimeout;
        } else {
            cachedClearTimeout = defaultClearTimeout;
        }
    } catch (e) {
        cachedClearTimeout = defaultClearTimeout;
    }
} ())
function runTimeout(fun) {
    if (cachedSetTimeout === setTimeout) {
        //normal enviroments in sane situations
        return setTimeout(fun, 0);
    }
    // if setTimeout wasn't available but was latter defined
    if ((cachedSetTimeout === defaultSetTimout || !cachedSetTimeout) && setTimeout) {
        cachedSetTimeout = setTimeout;
        return setTimeout(fun, 0);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedSetTimeout(fun, 0);
    } catch(e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't trust the global object when called normally
            return cachedSetTimeout.call(null, fun, 0);
        } catch(e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error
            return cachedSetTimeout.call(this, fun, 0);
        }
    }


}
function runClearTimeout(marker) {
    if (cachedClearTimeout === clearTimeout) {
        //normal enviroments in sane situations
        return clearTimeout(marker);
    }
    // if clearTimeout wasn't available but was latter defined
    if ((cachedClearTimeout === defaultClearTimeout || !cachedClearTimeout) && clearTimeout) {
        cachedClearTimeout = clearTimeout;
        return clearTimeout(marker);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedClearTimeout(marker);
    } catch (e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't  trust the global object when called normally
            return cachedClearTimeout.call(null, marker);
        } catch (e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error.
            // Some versions of I.E. have different rules for clearTimeout vs setTimeout
            return cachedClearTimeout.call(this, marker);
        }
    }



}
var queue = [];
var draining = false;
var currentQueue;
var queueIndex = -1;

function cleanUpNextTick() {
    if (!draining || !currentQueue) {
        return;
    }
    draining = false;
    if (currentQueue.length) {
        queue = currentQueue.concat(queue);
    } else {
        queueIndex = -1;
    }
    if (queue.length) {
        drainQueue();
    }
}

function drainQueue() {
    if (draining) {
        return;
    }
    var timeout = runTimeout(cleanUpNextTick);
    draining = true;

    var len = queue.length;
    while(len) {
        currentQueue = queue;
        queue = [];
        while (++queueIndex < len) {
            if (currentQueue) {
                currentQueue[queueIndex].run();
            }
        }
        queueIndex = -1;
        len = queue.length;
    }
    currentQueue = null;
    draining = false;
    runClearTimeout(timeout);
}

process.nextTick = function (fun) {
    var args = new Array(arguments.length - 1);
    if (arguments.length > 1) {
        for (var i = 1; i < arguments.length; i++) {
            args[i - 1] = arguments[i];
        }
    }
    queue.push(new Item(fun, args));
    if (queue.length === 1 && !draining) {
        runTimeout(drainQueue);
    }
};

// v8 likes predictible objects
function Item(fun, array) {
    this.fun = fun;
    this.array = array;
}
Item.prototype.run = function () {
    this.fun.apply(null, this.array);
};
process.title = 'browser';
process.browser = true;
process.env = {};
process.argv = [];
process.version = ''; // empty string to avoid regexp issues
process.versions = {};

function noop() {}

process.on = noop;
process.addListener = noop;
process.once = noop;
process.off = noop;
process.removeListener = noop;
process.removeAllListeners = noop;
process.emit = noop;

process.binding = function (name) {
    throw new Error('process.binding is not supported');
};

process.cwd = function () { return '/' };
process.chdir = function (dir) {
    throw new Error('process.chdir is not supported');
};
process.umask = function() { return 0; };


/***/ },
/* 9 */
/***/ function(module, exports) {

module.exports = "\n\n\n\n\n\n\n\n\n\n\n<div class=\"form-horizontal\">\n    <div class=\"form-group\">\n        <label class=\"col-sm-2 control-label\">\n            <span class=\"text-danger\">*</span>縣市/區\n        </label>\n\n        <div class=\"col-sm-3\">\n            <input type=\"text\" class=\"hidden\" name=\"city\"\n                   v-model=\"address_input.city.id\">\n            <select class=\"form-control\"\n                    v-model=\"address_input.city\"\n                    @change=\"refresh_area\"\n                    required>\n                <option value=\"\" data-default>選擇縣市</option>\n                <optgroup v-for=\"district in cities\"\n                          :label=\"district.district\">\n                    <option v-for=\"city in district.items\"\n                            :value=\"city\">\n                        {{city.title }}\n                    </option>\n                </optgroup>\n            </select>\n        </div>\n\n        <div class=\"col-sm-3\">\n            <input type=\"text\" class=\"hidden\"\n                   name=\"zip\" v-model=\"address_input.area.zip\">\n            <select class=\"form-control\"\n                    title=\"選擇區域\"\n                    v-model=\"address_input.area\"\n                    required>\n                <option value=\"\">選擇區域</option>\n                <option v-for=\"area in option_areas\"\n                        :value=\"area\">\n                    {{ area.title }}\n                </option>\n            </select>\n        </div>\n    </div>\n\n    <div class=\"form-group\">\n        <label class=\"col-sm-2 control-label\">\n            <span class=\"text-danger\">*</span>地址\n        </label>\n\n        <div class=\"col-sm-10\">\n            <input type=\"text\"\n                   name=\"street\"\n                   id=\"street\"\n                   class=\"form-control\"\n                   v-model=\"address_input.street\"\n                   placeholder=\"道路名稱與門牌號碼\" required>\n            <button class=\"btn btn-info btn-xs\"\n                    @click.prevent=\"unset_street\">重設\n            </button>\n        </div>\n    </div>\n</div>\n";

/***/ },
/* 10 */
/***/ function(module, exports) {

module.exports = "\n<div class=\"full-width\"\n     style=\"position:relative;\">\n\n    <input type=\"file\"\n           style=\"\n            position:absolute;top:0;left:0;\n            z-index:400;opacity:0;\"\n           @change=\"handleFileChanged\"\n           :style=\"{height:imgSize.height+'px',width:imgSize.width+'px'}\">\n\n    <img :src=\"photoPath\" class=\"full-width\"\n         :id=\"imgId\"\n         @load=\"handleImgLoad\">\n\n    <div v-show=\"fileLoading\"\n         style=\"\n         position: absolute;left:0px; top:0px; width: 100%;height:100%;\n        background-color:white;\n        z-index:10\">\n        <span style=\"position: absolute;left:30%;top:30%;\">\n            <i class=\"fa fa-spinner fa-pulse fa-5x\"></i> <br/>檔案上傳中\n        </span>\n    </div>\n\n    <span class=\"btn btn-danger btn-xs\"\n          @click=\"handlePhotoDelete\"\n          style=\"position: absolute;\n                  top:5px;left:5px; z-index:450;\"\n          v-show=\"hasPhoto\">\n        <i class=\"fa fa-trash-o\"></i>&nbsp;刪除圖片\n    </span>\n</div>\n";

/***/ },
/* 11 */
/***/ function(module, exports, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__components_app_AddressInput_vue__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__components_app_AddressInput_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__components_app_AddressInput_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__components_app_PhotoInput_vue__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__components_app_PhotoInput_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__components_app_PhotoInput_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_vuex__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_vuex___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_vuex__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_vue_router__ = __webpack_require__(2);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_vue_router___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_vue_router__);




//import store from './store.js'


var store = new __WEBPACK_IMPORTED_MODULE_2_vuex___default.a.Store({
    state: {
        count: 150,
        saved: false
    },
    mutations: {
        increment: function increment(state, amount) {
            state.count = state.count + amount;
        },
        formSaved: function formSaved(state) {
            state.saved = true;
        }
    }
});

var info = {
    user: function () {
        return JSON.parse(document.querySelector('#userInfo').value);
    }
};



var Foo = {
    template: '<div>foo<file-input model="device" id="1" field="coverphoto"></file-input>',
    store: store,
    mounted: function () {
        console.log(store.state.count); // -> 1
    },
    components: { fileInput: __WEBPACK_IMPORTED_MODULE_1__components_app_PhotoInput_vue___default.a }
};

var Bar = { template: '<div>bar</div>' };
var Zen = { template: '<div>Zen</div>' };

var routes = [{ path: '/foo', component: Foo }, { path: '/address', component: __WEBPACK_IMPORTED_MODULE_0__components_app_AddressInput_vue___default.a }, { path: '*', component: Zen }];

var router = new __WEBPACK_IMPORTED_MODULE_3_vue_router___default.a({
    routes: routes // short for routes: routes
});

var app = new Vue({
    router: router
}).$mount('#app');

/***/ }
/******/ ]);