<!--
Input:
(1)array list: source   (one dimension array)
(2)max chosen qty: default 1,  number of "unlimited"
(3)selected list (source_selected) from external

Output:
(1)Event: 'updateSelected'
(2)data type: array

Example:
 <btn-selector :source="data.occasions"
                    :source_selected="queryTerm.occasions"
                    maxqty="1"
                    @update-selected="updateOccasion"></btn-selector>
-->

<template>
    <span>
        <one-button v-for="item in list"
                    :item="item"
                    :selected_list="selected_list"
                    @update-selected="updateSelected"
                    @remove-selected="removeSelected">
        </one-button>
    </span>
</template>

<script>
    import oneButton from  './button.vue'
    import mixin from './mixins.js'

    export default {
        components: {
            oneButton
        },
        mixins: [mixin],
    }
</script>