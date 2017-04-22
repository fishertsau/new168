import profile from './Profile.vue'
import likeDevices from './LikeDevices.vue'
import postDevices from './PostDevices.vue'
import otherInfo from './OtherInfo.vue'
import collectedDevices from './CollectedDevices.vue'

var pageInfo = {
    user: JSON.parse($('#userInfo').val()),
    userDevices: JSON.parse($('#userDevices').val()),
    likeDevices: JSON.parse($('#likeDevices').val()),
};


import Vuex from 'vuex'
const store = new Vuex.Store({
    state: {
        count: 10,
        user: pageInfo.user,
        userDevices: pageInfo.userDevices,
        likeDevices: pageInfo.likeDevices
    },
    mutations: {
        increment(state, amount)
        {
            state.count = state.count + amount
        }
    },
    strict: true
})


import VueRouter from 'vue-router'

const routes = [
    {path: '/profile', component: profile},
    {
        path: '/likes', component: likeDevices,
        children: [{
            path: 'device',
            component: collectedDevices
        }]
    },
    {path: '/posts', component: postDevices},
    {path: '*', component: otherInfo}
];

const router = new VueRouter({
    routes // short for routes: routes
});


const app = new Vue({
    store,
    router
}).$mount('#app');

