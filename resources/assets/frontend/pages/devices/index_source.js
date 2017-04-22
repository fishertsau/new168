Vue.component('deviceSearch', require('../../../components/search/deviceSearch.vue'));
Vue.component('pagination', require('../../../components/pagination/pagination.js'));
Vue.component('btnSelector', require('../../../components/selectors/buttons.vue'));
//Vue.component('deviceBlock', require('../../../components/partials/DeviceVertical.vue'));

import helpers from  '../../../components/helpers.js'

/***Filter**********/
import formatDollar from '../../../components/filters/currency.js';
Vue.filter('moneyFormat', formatDollar);

/** *******************************/
const orderByList = [
    {title: '依價格', field: 'price'},
    {title: '刊登日期', field: 'created_at'},
    {title: '瀏覽人數', field: 'reads'}];

const pager = {
    pagination: {
        total: 0,
        per_page: 12,    // required
        current_page: 1, // required
        last_page: 0,    // required
        from: 1,
        to: 12           // required
    },
    paginationOptions: {
        offset: 2,
        previousText: "<",
        nextText: '>',
        alwaysShowPrevNext: true
    }
};

/***Vuex ******************************/
import Vuex from 'vuex'
const store = new Vuex.Store(require('../../../components/search/deviceQueryTerm.js'));

/** page setting information*/
const deviceQueryTermKey = 'deviceQueryTerm';
const lifespan = 43200000; //12 hr = 12hrx60minx60sec x 1,000 =43200000 m-secs
var defaultPhotoPath = '/assets/images/cover/coverPhoto.jpg';


/***vue begin************** *****/
/**
 * Timing to fire doQuery:
 * (1)page is onload, (2)"enter" keyup in keyword input, (3)search button pressed
 * (4)order_by, order_sequence are changed, (5)page changed
 * */

/**
 * searchType: (1)newSearch, (2)page, (3)pageOnload
 * */
const vm = new Vue({
    el: '#app',
    store,
    data: {
        device_list: [],
        view_control: {
            device_block_view: true
        },
        order_by_list: orderByList,
        pagination: pager.pagination,
        paginationOptions: pager.paginationOptions,
        photoDir: '\\assets\\images\\cover\\',
    },
    computed: {
        order_desc() {
            return store.state.queryTerm.order_sequence == 'asc';
        },
    },
    methods: {
        filePath: function (obj) {
            if (!obj) {
                return defaultPhotoPath;
            }
            return obj.filepath;
        },
        toggle_block_view () {
            this.view_control.device_block_view = !this.view_control.device_block_view;
        },
        toggle_order_sequence() {
            var newValue =
                store.state.queryTerm.order_sequence == 'asc' ?
                    'desc' : 'asc';
            store.commit('updateQueryTerm', {
                property: 'order_sequence',
                newValue: newValue
            });
            this.doQuery('newSearch');
        },
        updateOrderBy (list) {
            //list is an array, and only the 1st item is valid
            store.commit('updateQueryTerm', {
                property: 'order_by',
                newValue: list
            });
            this.doQuery('newSearch');
        },
        loadData () {
            var pageOptions = {page: this.pagination.current_page};
            this.doQuery('page', pageOptions);
        },
        updateQueryTermFromHistory(){
            var historyQueryTermObj = JSON.parse(localStorage.getItem(deviceQueryTermKey));
            if (!helpers.isEmpty(historyQueryTermObj)) {
                var age = Date.now() - historyQueryTermObj.recorded_at;
                var alive;
                /* = (age <= lifespan);*/
                if (alive = (age <= lifespan))  store.commit('updateQueryTermObj', historyQueryTermObj);
            }
        },
        updateQueryTermPage(searchType, pageOptions) {
            var page = (searchType == 'newSearch') ? 1 : pageOptions.page;
            store.commit('updateQueryTerm', {property: 'page', newValue: page});
            setLocalStorage(deviceQueryTermKey, store.state.queryTerm);
        },
        getQueryList(){
            //get queryList
            //from history or send query again
            var queryResultHistory = JSON.parse(localStorage.getItem('deviceQueryResponse'));
            if (!helpers.isEmpty(queryResultHistory)) {
                this.refreshQueryResult(queryResultHistory)
            }
            else {
                this.ajaxQuery(serializeQueryRequest(store.state.queryTerm));
            }
        },
        doQuery (searchType = null, pageOptions = null) {
            //validate
            if (helpers.isEmpty(searchType)) {
                alert('no search type is given:(1)newSearch, (2)page');
                return;
            }

            this.updateQueryTermPage(searchType, pageOptions);
            this.ajaxQuery(serializeQueryRequest(store.state.queryTerm));
        },
        ajaxQuery(queryRequest) {
            var deviceListUrl = 'api/devices/list/paginated';
            $.post(deviceListUrl, queryRequest, function (response) {
                    vm.refreshQueryResult(response);
                    setLocalStorage('deviceQueryResponse', response);
                }
            );
        },
        refreshQueryResult(queryResult) {
            this.device_list = queryResult.data;
            this.pagination = {
                total: queryResult.total,
                per_page: queryResult.per_page,
                current_page: queryResult.current_page,
                last_page: queryResult.last_page,
                from: queryResult.from,
                to: queryResult.to
            };
        }
    },
    beforeMount() {
        this.updateQueryTermFromHistory();
        this.getQueryList();
    }
});


/*
 * save queryTerm in local storage with timestamp
 * */
function setLocalStorage(keyname, targetObj) {
    localStorage.setItem(keyname,
        JSON.stringify(Object.assign(targetObj, {recorded_at: Date.now()})));
}

/*
 * Convert the query term format
 * So that the server can read it for list filtering
 *
 * */
function serializeQueryRequest(queryTerm) {
    var occasionsIdList = queryTerm.occasions.map(function (obj) {
        return obj.id;
    });

    var areaIdList = queryTerm.area_list.map(function (obj) {
        return obj.zip;
    });

    //fit into format before sending query request
    return {
        queryTerm: {
            cat_id: queryTerm.cat[0].id,
            keyword: queryTerm.keyword,
            occasion: occasionsIdList,
            price_lower: queryTerm.price_range[0].lower,
            price_upper: queryTerm.price_range[0].upper,
            gas_type: queryTerm.gas_type,
            voltage: queryTerm.voltage,
            city: queryTerm.city[0].id,
            zips: areaIdList,
            order_by: queryTerm.order_by[0].field,
            order_sequence: queryTerm.order_sequence
        },
        page: queryTerm.page
    };
}
/***vue end************** *****/