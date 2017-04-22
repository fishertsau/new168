///*app*/
Vue.component('deviceCategory', require('../../../components/app/DeviceCategory.vue'));
Vue.component('OccasionListButtons', require('../../../components/app/OccasionListButtons.vue'));
Vue.component('address-input', require('../../../components/app/AddressInput.vue'));
Vue.component('ref-specs', require('../../../components/app/refSpecs/refSpecs.vue'));
Vue.component('photo-input', require('../../../components/app/PhotoInput.vue'));
Vue.component('brand-selection', require('./BrandSelection.vue'));

import helpers from  '../../../components/helpers.js'

var deviceDefault = {
    cat: [{title: '選擇類別'}],
    sn: helpers.emptyString,
    title: helpers.emptyString,
    brand: helpers.emptyString,
    model: helpers.emptyString,

    is_new: 1,
    used_time: helpers.emptyString,
    guarantee: helpers.emptyString,

    price: 0,
    price_note: helpers.emptyString,

    transaction: helpers.emptyString,
    deposit: 0,

    reads: 0,

    transportation: helpers.emptyString,
    freight: 0,


    description: helpers.emptyString,

    dimension: helpers.emptyObj,
    gas_type: helpers.emptyString,
    voltage: helpers.emptyString,
    specs: helpers.emptyArray,

    occasions: helpers.emptyArray,

    //address: addressDefault,
    city: 0,
    zip: 0,
    street: helpers.emptyString,

    contact_role: helpers.emptyString,
    contact_email: helpers.emptyString,
    contact_tel: helpers.emptyString,
    contact_name: helpers.emptyString,
    contact_line_id: helpers.emptyString
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

const vm = new Vue({
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
            return (150 - this.formInput.description.length);
        },
        description_over: function () {
            return (this.formInput.description.length - 150);
        },
        description_too_long: function () {
            return this.formInput.description.length > 150;
        },
        has_spec: function () {
            if (helpers.isEmpty(this.formInput.specs)) {
                return false;
            }

            return !(this.formInput.specs.length == 0);
        }
    },
    methods: {
        handleMajorFormSubmission(){
            if (helpers.ifDuplicateTitles(this.formInput.specs)) {
                alert('規格的設定裡面,"自訂規格"的項目有重複,請修改!');
                location.href = "#custom_spec";
                return;
            }
            this.allowPageChange();
            document.querySelector('#inputForm').submit();
        },
        allowPageChange(){
            this.formSaved = true;
        },
        unset_formInput: function (key, focus = true, type = 'string') {
            this.formInput[key] = helpers.unsetValue(type);
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
            if (helpers.isEmpty(this.formInput.specs)) {
                this.formInput.specs = [];
            }
            this.formInput.specs.push(obj);
        },
        remove_custom_spec_list: function (item) {
            var index = this.formInput.specs.indexOf(item);
            if (index != (-1)) {
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
                this.formInput.price = 0
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
    if (!helpers.isEmpty(vm.formInput.gas_type)) {
        vm.selected_options.gas_type_checked = true;
    }

    if (!helpers.isEmpty(vm.formInput.voltage)) {
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
