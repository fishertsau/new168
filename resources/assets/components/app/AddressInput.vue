<!--
Input:
(1)city: CityObject from City Model
(2)Area:  AreaObject from Area Model
(3)Street: string

Output:
  (1)Void
  (2) 3 input fields:   [city]:city id, [area]:area zip, [street]:street
-->
<template>
    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">
                <span class="text-danger">*</span>縣市/區
            </label>

            <div class="col-sm-3">
                <input type="text"
                       class="hidden"
                       name="city"
                       v-model="selection.city.id">

                <select class="form-control"
                        v-model="selection.city"
                        @change="refresh_area"
                        required>
                    <option value="" data-default>選擇縣市</option>
                    <optgroup v-for="district in cities"
                              :label="district.district">
                        <option v-for="city in district.items"
                                :value="city">
                            {{city.title }}
                        </option>
                    </optgroup>
                </select>
            </div>

            <div class="col-sm-3">
                <input type="text" class="hidden"
                       name="zip"
                       v-model="selection.area.zip">
                <select class="form-control"
                        title="選擇區域"
                        v-model="selection.area"
                        required>
                    <option value="">選擇區域</option>
                    <option v-for="area in area_selection_options"
                            :value="area">
                        {{ area.title }}
                    </option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">
                <span class="text-danger">*</span>地址
            </label>

            <div class="col-sm-10">
                <input type="text"
                       name="street"
                       id="vue_input_street"
                       class="form-control"
                       v-model="selection.street"
                       placeholder="道路名稱與門牌號碼" required>
                <button class="btn btn-info btn-xs"
                        @click.prevent="unset_street">重設
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import city_list from '../data/cities.js'
    import areas from '../data/areas.js'
    var area_list = areas.default;

    export default {
        props: ['city', 'zip', 'street'],
        data: function () {
            return {
                cities: city_list.default,
                source: {city: '', zip: '', street: ''},
                selection: {city: '', area: '', street: ''},
            }
        },
        computed: {
            area_selection_options: function () {
                return (
                        isEmpty(this.selection.city)
                                ? ''
                                : area_list[this.selection.city.id]);
            }
        },
        methods: {
            refresh_area: function () {
                this.selection.area = '';
            },
            unset_street: function () {
                this.selection.street = '';
                document.querySelector('#vue_input_street').focus();
            }
        },
        beforeMount: function () {
            bootstrap(this);
        }
    }


    function isEmpty(source) {
        return ((undefined == source) || ('' == source));
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
    /**
     * return array /city
     * */
    function cityObjList() {
        var myArray = [];

        var myObj = city_list.default;
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

    /**
     * return object
     *  example:  if  (1)key == city.id , (2) zip ==  area.zip, then return;
     * */
    function findByKeyForProperty(key, List, property) {
        var target = List[0];
        for (var i = 0; i < List.length; i++) {
            if (key == List[i][property]) {
                target = List[i];
            }
        }

        return target;
    }
</script>