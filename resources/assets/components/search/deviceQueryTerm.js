const defaultDeviceQueryTerm = {
    keyword: '',
    occasions: [],
    city: [{title: ''}],
    area_list: [],
    cat: [{title: '', id: ''}],
    price_range: [{upper: '', lower: ''}],
    voltage: '',
    gas_type: '',
    order_by: [{title: '依價格', field: 'price'}],
    order_sequence: 'asc',
    page: ''
};

module.exports = {
    state: {
        queryTerm: defaultDeviceQueryTerm,
    },
    mutations: {
        updateQueryTerm(state, data){
            state.queryTerm[data.property] = data.newValue;
        },
        updateQueryTermObj(state, obj){
            state.queryTerm = obj
        },
    }
}



