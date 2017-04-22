import addressInput from '../../../components/app/AddressInput.vue'
import fileInput from '../../../components/app/PhotoInput.vue'

import Vuex from 'vuex'
//import store from './store.js'


const store = new Vuex.Store({
    state: {
        count: 150,
        saved: false
    },
    mutations: {
        increment(state, amount)
        {
            state.count = state.count + amount
        },
        formSaved(state)
        {
            state.saved = true
        },
    }
})

var info = {
    user: function () {
        return JSON.parse(document.querySelector('#userInfo').value);
    }
};

import VueRouter from 'vue-router'

const Foo = {
    template: '<div>foo<file-input model="device" id="1" field="coverphoto"></file-input>',
    store,
    mounted: function () {
        console.log(store.state.count) // -> 1
    },
    components: {fileInput}
};

const Bar = {template: '<div>bar</div>'};
const Zen = {template: '<div>Zen</div>'};

const routes = [
    {path: '/foo', component: Foo},
    {path: '/address', component: addressInput},
    {path: '*', component: Zen}
];

const router = new VueRouter({
    routes // short for routes: routes
});

const app = new Vue({
    router
}).$mount('#app');