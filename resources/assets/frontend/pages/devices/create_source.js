/*app*/
Vue.component('deviceCategory', require('../../../components/app/DeviceCategory.vue'));
Vue.component('deviceBlock', require('../../../components/partials/DeviceVertical.vue'));

import helpers from  '../../../components/helpers.js'

/***Filter**********/
import formatDollar from '../../../components/filters/currency.js'
Vue.filter('currency', formatDollar);

var defaultCat = [{title: '選擇類別', id: 0}];

const vm = new Vue({
    el: '#app',
    data: {
        selectedbrand: '',
        form_input: {
            title: '',
            brand: '',
            cat: defaultCat,
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
            if ((this.form_input.cat[0].id == '')
                || (this.form_input.cat[0].id == undefined)
            )
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
    mounted(){
        var userDevices = $('#userDevices').val();
        if (userDevices) {
            this.userDevices = JSON.parse(userDevices);
        }
    }
});