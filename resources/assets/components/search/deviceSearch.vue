<!--
To return the devices list and pagination information basing upon the query term

Input: initial query term | obj
output: query result  | (1)device list array of obj, (2)pagination

output:
   (1)event: 'do-search'
   To notify its ancestor an "do search" action should be taken

   (2)Update the shared data set with the received input value
-->

<template>
    <div>
        <div class="text-yellow" v-cloak>
            <div class="text-yellow"
                 style="margin-bottom: 5px;display: flex">
                <span style="flex: 0.6"><span class="hidden-xs">&nbsp;搜尋</span>條件: &nbsp;</span>
                <span style="flex: 5">
                    <!--關鍵字-->
                    <span class="gearSearchBlock__queryTerm--item rwd-text-16"
                          v-show="hasKeyword">{{ queryTerm.keyword }}<span
                            class="gearSearchBlock__queryTerm--item--close"
                            @click="unset_query_keyword">X</span></span>

                    <!--使用場合-->
                    <span class="gearSearchBlock__queryTerm--item rwd-text-16"
                          v-show="hasOccasion">
                            {{ queryTerm.occasions | titles }}
                        <span class="gearSearchBlock__queryTerm--item--close"
                              @click="unset_query_occasions">X</span>
                    </span>

                    <!--設備類別-->
                    <span class="gearSearchBlock__queryTerm--item rwd-text-16"
                          v-show="hasCat">
                            {{ queryTerm.cat[0].title }}
                        <span class="gearSearchBlock__queryTerm--item--close"
                              @click="unset_query_cat">X</span>
                    </span>

                    <!--價格範圍-->
                    <span class="gearSearchBlock__queryTerm--item rwd-text-16"
                          v-show="hasPrice">{{ queryTerm.price_range[0].title }}<span
                            class="gearSearchBlock__queryTerm--item--close"
                            @click="unset_query_price_range">X</span></span>
                    
                    <!--常用規格-->
                    <span class="gearSearchBlock__queryTerm--item rwd-text-16"
                          v-show="hasSpec">
                            {{ queryTerm.gas_type }}/{{ queryTerm.voltage }}<span
                            class="gearSearchBlock__queryTerm--item--close"
                            @click="unsetQueryTermSpec">X</span></span>

                <!--賣方位置-->
                    <span class="gearSearchBlock__queryTerm--item rwd-text-16"
                          v-show="hasCity">{{ queryTerm.city[0].title}}/{{queryTerm.area_list | titles}}

                        <span class="gearSearchBlock__queryTerm--item--close"
                              @click="unset_query_city">X</span></span>
                </span>
                </span>
                <span style="flex: 0.6" @click="clearAll">清除<span class="hidden-xs">條件</span></span>
            </div>
        </div>

        <div class="gearSearchBlock__query">
            <input type="text" class="gearSearchBlock__query__input__grp--name rwd-input-txt-20"
                   placeholder="輸入設備名稱"
                   v-model="queryTerm.keyword"
                   name="keyword"
                   @keyup.enter="doSearch">
            <button class="gearSearchBlock__query__input__grp__moreBtn rwd-text-20"
                    @click="toggle_see_more_term">
                <span>更多</span><span class="hidden-xs hidden-sm">條件&nbsp;
                <i class="fa fa-caret-right" aria-hidden="true"></i></span>
            </button>
            <button class="gearSearchBlock__query__input__grp--submitBtn rwd-text-20"
                    id="doSearch"
                    @click="doSearch">
                <i class="fa fa-search" aria-hidden="true"></i><span class="hidden-xs">&nbsp;搜尋</span>
            </button>
        </div>

        <div style="position: relative">
            <div class="search-more"
                 v-show="view_control.see_more_term"
                 style="padding:8px"
                 v-cloak>
                <div class="" style="padding-top:0;background:white;">
                    <tab-block source="適用場合,類別,價格規格,設備位置"
                               :active="moreTermTab.activetitle"
                               @update-title="updateActiveTitle">

                        <tab-content :activetitle="moreTermTab.activetitle"
                                     current="適用場合">
                            <h6 class="text-warning rwd-text-16">單選
        <span class="text-danger"
              @click="unset_query_occasions">[重設]</span>
                            </h6>
                            <btn-selector :source="dataSource.occasions"
                                          :source_selected="queryTerm.occasions"
                                          maxqty="1"
                                          @update-selected="updateOccasion">
                            </btn-selector>
                        </tab-content>

                        <tab-content :activetitle="moreTermTab.activetitle"
                                     current="類別">
                            <h6 class="text-warning rwd-text-16">設備類別
        <span class="text-danger"
              @click="unset_query_cat">[重設]</span>
                            </h6>
                            <device-category
                                    :source_selected="queryTerm.cat"
                                    @update-selected="updateCat"
                                    >
                            </device-category>
                        </tab-content>

                        <tab-content :activetitle="moreTermTab.activetitle"
                                     current="價格規格">
                            <h6 class="text-warning rwd-text-16">價格範圍

                            </h6>
                            <btn-selector :source="dataSource.priceRange"
                                          :source_selected="queryTerm.price_range"
                                          maxqty="1"
                                          @update-selected="updatePriceRange"
                                    >
                            </btn-selector>

                            <hr>
                            <h6 class="text-warning rwd-text-16">常用規格
                                <span class="text-danger"
                                      @click="unsetQueryTermSpec">[重設]</span>
                            </h6>
                            <table class="full-width">
                                <thead>
                                <tr>
                                    <th style="width: 25%"></th>
                                    <th style="width: 75%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center rwd-text-24 vertical-top">瓦斯</td>
                                    <td>
                                        <span v-for="item in dataSource.spec_list[0].item_list">
                                            <input type="radio"
                                                   class="queryTerm-checkbox queryTerm-spec"
                                                   name="queryTerm_gas_type"
                                                   v-model="queryTerm.gas_type"
                                                   :value="item">
                                            <span class="rwd-text-24">{{ item }}</span>
                                            <br>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center rwd-text-24 vertical-top">電壓</td>
                                    <td>
                                        <span v-for="item in dataSource.spec_list[1].item_list">
                                        <input type="radio"
                                               class="queryTerm-checkbox queryTerm-spec"
                                               name="queryTerm_voltage"
                                               v-model="queryTerm.voltage"
                                               :value="item">
                                        <span class="rwd-text-24">{{ item }}</span>
                                        <br>
                                        </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </tab-content>

                        <tab-content :activetitle="moreTermTab.activetitle"
                                     current="設備位置">
                            <h5 class="text-warning rwd-text-24">縣市:
        <span class="text-danger" @click="toggle_city_menu">
        {{ queryTerm.city[0].title }}
        </span>
                                <span class="text-info" @click="toggle_city_menu">[選擇]</span>
                                <span class="text-danger" @click="unset_query_city">[重設]</span>
                            </h5>

                            <div v-show="view_control.city_menu">
                                <text-table :source="dataSource.districts"
                                            :source_selected="queryTerm.city"
                                            @update-selected="updateCity"></text-table>
                            </div>

                            <h5 class="text-warning rwd-text-24">區域
                                <span class="text-danger" @click="unset_query_area">[重設]</span></h5>

                            <div>
        <span class="text-dark rwd-text-22" v-for="area in areaCandidates">
        <input type="checkbox"
               :value="area"
               v-model="queryTerm.area_list">
        {{area.title}}
        </span>
                            </div>
                        </tab-content>
                    </tab-block>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="sass">
    @import 'searchBlock.sass';
</style>

<script>
    import tabBlock from '../tabBlock/tabBlock.vue'
    import tabContent from '../tabBlock/tabContent.vue'
    import btnSelector from '../selectors/buttons.vue'
    import textTable from '../selectors/textTable.vue'

    /*external data*/
    import occasionList from '../data/occasions.js'
    import priceRange from '../data/priceRange.js'
    import cities from '../data/cities.js'
    import areas from '../data/areas.js'
    import specList from '../data/spec.js'

    /*app*/
    import deviceCategory from '../app/DeviceCategory.vue'

    Vue.filter('titles', function (value) {
        var titles = '';
        var comma;
        for (var i = 0; i < value.length; i++) {
            comma = i == 0 ? '' : ','
            titles += comma + value[i].title;
        }
        return titles;
    });

    export default {
        props: {
            querysource: {
                type: Object,
                required: true
            }
        },
        data: function () {
            return {
                queryTerm: {},
                view_control: {
                    see_more_term: false,
                    city_menu: true
                },
                dataSource: {
                    occasions: occasionList.default,
                    priceRange: priceRange.default,
                    districts: cities.default,
                    areas: areas.default,
                    spec_list: specList.default
                },
                moreTermTab: {activetitle: '適用場合'},
                result: ''
            }
        },
        components: {
            tabBlock, tabContent, btnSelector, textTable,
            deviceCategory
        },
        computed: {
            hasKeyword: function () {
                return this.queryTerm.keyword != '';
            },
            hasOccasion: function () {
                return this.queryTerm.occasions.length;
            },
            hasPrice: function () {
                var empty =
                        ( (this.queryTerm.price_range[0].lower == '') && (this.queryTerm.price_range[0].upper == ''));
                return !empty;
            },
            hasCity: function () {
                return this.queryTerm.city[0].title != '';
            },
            hasCat: function () {
                return this.queryTerm.cat[0].title != '';
            },
            areaCandidates: function () {
                var id = this.queryTerm.city[0].id;
                return this.dataSource.areas[id];
            },
            hasSpec: function () {
                return ((this.queryTerm.gas_type != '') || (this.queryTerm.voltage != ''))
            },
        },
        watch: {
            queryTerm: {
                handler: function (val, oldVal) {
                    this.$store.commit('updateQueryTermObj', val);
                },
                deep: true
            },
            'queryTerm.city': function (e) {
                this.unset_query_area();
                if (e[0].title == '') {
                    this.show_city_menu();
                } else {
                    this.hide_city_menu();
                }
            },
        },
        methods: {
            clearAll: function () {
                this.unset_query_keyword();
                this.unset_query_occasions();
                this.unset_query_cat();
                this.unset_query_price_range();
                this.unsetQueryTermSpec();
                this.unset_query_city();
                this.unset_query_area();
            },
            updateState: function (property, value) {
                this.$store.commit('updateQueryTerm', {
                    property: property,
                    newValue: value
                });
            },
            doSearch: function () {
                this.hide_see_more_term();
                this.$emit('do-search', 'newSearch');
            },
            hide_see_more_term: function () {
                this.view_control.see_more_term = false;
            },
            toggle_see_more_term: function () {
                this.view_control.see_more_term = !this.view_control.see_more_term;
            },
            updateActiveTitle: function (title) {
                this.moreTermTab.activetitle = title;
            },
            unset_query_occasions: function () {
                this.queryTerm.occasions = [];
            },
            unset_query_keyword: function () {
                this.queryTerm.keyword = '';
            },
            unset_query_price_range: function () {
                this.queryTerm.price_range = [{upper: '', lower: ''}];
            },
            updateOccasion: function (list) {
                this.queryTerm.occasions = list;
            },
            updatePriceRange: function (list) {
                //price_range is an array
                this.queryTerm.price_range = list;
            },
            updateCity: function (list) {
                //city is an array
                this.queryTerm.city = list;
            },
            toggle_city_menu: function () {
                this.view_control.city_menu = !this.view_control.city_menu;
            },
            hide_city_menu: function () {
                this.view_control.city_menu = false;
            },
            show_city_menu: function () {
                this.view_control.city_menu = true;
            },
            unset_query_city: function () {
                this.queryTerm.city = [{title: ''}];
                this.view_control.city_menu = true;
            },
            unset_query_area: function () {
                this.queryTerm.area_list = [];
            },
            updateCat: function (list) {
                this.queryTerm.cat = list;
            },
            unset_query_cat: function () {
                this.queryTerm.cat = [{title: ''}];
            },
            unsetQueryTerm: function (property) {
                this.queryTerm[property] = '';
            },
            unsetQueryTermSpec: function () {
                this.unsetQueryTerm('voltage');
                this.unsetQueryTerm('gas_type');
            },
        },
        beforeMount: function () {
            this.queryTerm = this.querysource;
        }
    }
</script>