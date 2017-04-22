module.exports = {
    props: {
        maxqty: {
            type: String,
            required: false
        },
        source: {
            type: Array,
            required: true
        },
        source_selected: {
            type: Array,
            required: false
        }
    },
    data () {
        return {
            list: '',
            selected_list: [],
            maxSelectedQty: '',
        }
    },
    watch: {
        source_selected(e){
            this.selected_list = e;
        }
    },
    methods: {
        notifyListChanged: function () {
            this.$emit('update-selected', this.selected_list);
        },
        updateSelected: function (item) {
            if (this.maxSelectedQty == 1) {
                this.selected_list.pop();
            }

            if (this.moreItemIsAllowed(this)) {
                this.selected_list.push(item);
            }
            this.notifyListChanged();
        },
        removeSelected: function (item) {
            var index = this.selected_list.indexOf(item);
            if (index != (-1)) {
                this.selected_list.splice(index, 1);
            }
            this.notifyListChanged();
        },
        moreItemIsAllowed: function (elem) {
            return (elem.maxSelectedQty > elem.selected_list.length) ||
                (elem.maxSelectedQty == 'unlimited');
        },
        syncUpSource() {
            //loop through the list
            //check to see if the item is in list
            //if yes, put the item in the selected list, and break
            if (this.source_selected) {
                var listLength = this.list.length;
                var sourceSelectedLength = this.source_selected.length;
                for (var i = 0; i < listLength; i++) {
                    var item = this.list[i];
                    for (var j = 0; j < sourceSelectedLength; j++) {
                        if (this.source_selected[j].title == item.title) {
                            this.selected_list.push(item);
                            break;
                        }
                    }
                }
            }
        },
    },
    beforeMount () {
        this.maxSelectedQty =
            (this.maxqty === undefined) ? 1 : this.maxqty;
        this.list = this.source;
        this.syncUpSource();
    }
}