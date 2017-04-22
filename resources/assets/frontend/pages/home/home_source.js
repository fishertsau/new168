/**
 * Created by Fisher on 2016/12/22.
 */
Vue.component('deviceBlock', require('../../../components/partials/DeviceVertical.vue'));
Vue.component('deviceSearch', require('../../../components/search/deviceSearch.vue'));

/** page setting information*/
const deviceQueryTermKey = 'deviceQueryTerm';
const lifespan = 43200000; //12 hr = 12hrx60minx60sec x 1,000 =43200000 m-secs

/***Vuex ******************************/
import Vuex from 'vuex'
const store = new Vuex.Store(require('../../../components/search/deviceQueryTerm.js'));

const vm = new Vue({
    el: '#app',
    store,
    data: {
        latestDevices: []
    },
    methods: {
        turnToDeviceSearch() {
            this.handleQueryTerm();
            window.location.href = "/devices";
            console.log('turn to device search');
        },
        //this method is same in demo.js, should use mixin
        handleQueryTerm (searchType, pageOptions) {
            setLocalStorage(deviceQueryTermKey, store.state.queryTerm);
        },
        //this method is same in demo.js, should use mixin
        fetchPreviousQueryTerm(){
            var historyQueryTermObj;
            if (historyQueryTermObj = JSON.parse(localStorage.getItem(deviceQueryTermKey))) {
                var age = Date.now() - historyQueryTermObj.recorded_at;
                var alive = (age <= lifespan);
                if (alive)  store.commit('updateQueryTermObj', historyQueryTermObj);
            }
        },
    },
    beforeMount(){
        this.fetchPreviousQueryTerm();
        this.latestDevices = JSON.parse($('#latestDevices').val())
    }
});

/*
 * save queryTerm in local storage with timestamp
 * */
function setLocalStorage(keyname, targetObj) {
    localStorage.setItem(keyname,
        JSON.stringify(Object.assign(targetObj, {recorded_at: Date.now()})));
}