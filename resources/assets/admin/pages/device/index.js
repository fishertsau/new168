$(document).ready(function() {
    $("#occasion").select2();
});
var deviceListUrl = '/admin/devices/list/paginated';

var vm = new Vue({
    el: 'body',
    data: {
        device_list: ['temp'],
        paginator: {
            total: '',
            current_page: '',
            last_page: ''
        },
        sortName: '',
        price_range: ''
    },
    methods: {
        doNewSearch: function () {
            getList(queryTerm());
        },
        resetQuery: function () {
            $('#cat_id').val('');
            $('#keyword').val('');
            $('#occasion').val('');
            $('#voltage').val('');
            $('#order_by').val('');
            this.price_range = '';
        },
        setSortName: function (sortName) {
            this.sortName =
                this.sortName == sortName ? '' : sortName;
        }
    },
    computed: {
        listLength: function () {
            return this.device_list.length;
        },
        price_lower: function () {
            if (this.price_range == '') {
                return '';
            }
            return lower[this.price_range];
        },
        price_upper: function () {
            if (this.price_range == '') {
                return '';
            }
            return upper[this.price_range];
        }
    },
    ready: function () {
        getList();
    }
});


function getList(queryTerm, url) {
    var uri = url == undefined ? deviceListUrl : url;
    $.getJSON(uri, queryTerm, function (response) {
        refreshData(response);
    });
}


function refreshData(response) {
    updateDeviceList(response.paginator.data);
    updatePager(response.pager);
    updatePaginator(response.paginator)
}


function updateDeviceList(list) {
    vm.device_list = list;
}

function updatePager(pager) {
    $('#pagination').html(pager);
}

function updatePaginator(paginator) {
    vm.paginator.total = paginator.total;
    vm.paginator.current_page = paginator.current_page;
    vm.paginator.last_page = paginator.last_page;
}

function queryTerm() {
    return $('#searchForm').serialize();
}

