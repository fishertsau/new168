var occasionListUri = '/admin/occasions/list/unpaginated';


var vm = new Vue({
    el: 'body',
    data: {
        occasion_list: ['temp'],
        sortName:'',
        filterName:''
    },
    methods: {
        doNewSearch: function () {
            getUnPaginatedList(queryTerm());
        },
        resetQuery: function () {
            $('#keyword').val('');
            $('#active').val('');
        },
        reRank: function (newPosition, item) {
            var currentRank = item.rank;
            var data = {'rankAction': newPosition};

            $.ajax({
                url: "/admin/ajax/reRankOccasion/" + currentRank,
                data: data, type: 'post',
                success: function (result) {
                    getUnPaginatedList();
                }
            });
        },
        setSortName:function (sortName)
        {
            if (this.sortName == sortName) {
                this.sortName = '';
                return;
            }
            this.sortName = sortName;
        },
    },
    computed: {
        hasContent: function () {
            return this.occasion_list.length;
        },
        listLength:function () {
            return this.occasion_list.length;
        },
    },
    ready: function () {
        getUnPaginatedList();

    }
});


function getUnPaginatedList(queryTerm, url) {
    var uri = url == undefined ? occasionListUri : url;
    $.getJSON(uri, queryTerm, function (response) {
        refreshData(response);
    });
}


function refreshData(response) {
    updateOccasionList(response);
}


function updateOccasionList(list) {
    vm.occasion_list = list;
}


function queryTerm() {
    return $('#searchForm').serialize();
}
//# sourceMappingURL=index.js.map
