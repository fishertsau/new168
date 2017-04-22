import Vuex from 'vuex'

const state = {
    count: 150,
    saved: false
}

const mutations = {
    increment(state, amount)
    {
        state.count = state.count + amount
    },
    formSaved(state)
    {
        state.saved = true
    },
}

export default new Vuex.Store({
    state,
    mutations
})