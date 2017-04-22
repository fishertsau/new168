<!--
Input:
(1)array list: source   (two dimension array)
(2)max chosen qty: default 1,  number of "unlimited"
(3)selected list in external

Output:
(1)Event: 'updateSelected'
(2)data type: array

Example:
 <table-selector :source="data.occasions"
                    :sourceSelected="queryTerm.occasions"
                    maxQty="1"
                    @updateSelected="updateOccasion"></table-selector>
-->
<template>
    <table>
        <thead>
        <tr>
            <th style="width: 20%"></th>
            <th style="width: 80%"></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="row in list">
            <td class="text-center vertical-top rwd-text-20">{{ row.title }}</td>
            <td>
                <one-text v-for="item in row.items"
                          :item="item"
                          :selected_list="selected_list"
                          @update-selected="updateSelected"
                          @remove-selected="removeSelected"></one-text>
            </td>
        </tr>
        </tbody>
    </table>
</template>


<script>
    import oneText from './text.vue'
    import mixin from './mixins.js'

    export default {
        components: {
            oneText
        },
        mixins: [mixin],
    }

    //    export default {
    //        props: ['maxQty', 'source', 'source_selected'],
    //        components: {
    //            oneText
    //        },
    //        data: function () {
    //            return {
    //                list: '',
    //                selected_list: [],
    //                maxSelectedQty: ''
    //            }
    //        },
    //        watch: {
    //            source_selected: function () {
    //                this.selected_list = this.sourceSelected;
    //            },
    //            selected_list: function () {
    //                this.$emit('update-selected', this.selected_list);
    //            },
    //        },
    //        methods: {
    //            updateSelected: function (item) {
    //                if (this.maxSelectedQty == 1) {
    //                    this.selected_list.pop();
    //                }
    //
    //                if (this.moreItemIsAllowed(this)) {
    //                    this.selected_list.push(item);
    //                }
    //            },
    //            removeSelected: function (item) {
    //                var index = this.selected_list.indexOf(item);
    //                if (index != (-1)) {
    //                    this.selected_list.splice(index, 1);
    //                }
    //            },
    //            moreItemIsAllowed: function (elem) {
    //                return (elem.maxSelectedQty > elem.selected_list.length) ||
    //                        (elem.maxSelectedQty == 'unlimited');
    //            }
    //        },
    //        mounted: function () {
    //            //maxQty = 1, if not defined by the caller
    //            this.maxSelectedQty =
    //                    (this.maxQty === undefined)
    //                            ? 1
    //                            : this.maxQty;
    //
    //            this.list = this.source;
    //        }
    //    }
</script>