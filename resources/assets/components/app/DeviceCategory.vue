<!--
Input: (1)Selected Category
Output:
(1)Array, One Selected Category
(2)Event: 'update-selected'


View Format:  2D Table Text
-->
<template>
    <div>
        <text-table
                :source="list"
                :source-selected="selected_list"
                max-qty="1"
                @update-selected="updateCat">
        </text-table>
    </div>
</template>

<script>
    import textTable from '../selectors/textTable.vue'

    /*external data*/
    import deviceCat from '../data/deviceCat.js'

    export default {
        props: ['source_selected'],
        components: {
            textTable
        },
        data: function () {
            return {
                list: deviceCat.default,
                selected_list: [],
            }
        },
        watch: {
            'source_selected': function (source_selected) {
                this.selected_list = source_selected;
            }
        },
        methods: {
            updateCat: function (list) {
                this.selected_list = list;
                this.$emit('update-selected', this.selected_list)
            }
        }
    }
</script>