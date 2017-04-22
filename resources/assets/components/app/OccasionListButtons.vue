<!--
Input: (1)Selected Category
Output:
(1)Array, Many Selected Occasions
(2)Event: 'update-selected'

View Format:  Buttons

Note:
- When the original selected array is passed,
- the array will be updated and send back to the source
- So that the items in array could sync up with the list to be chosen
-->
<template>
    <div>
        <btn-selector :source="list"
                      :source_selected="selected"
                      maxqty="unlimited"
                      @update-selected="updateSelected">
        </btn-selector>
    </div>
</template>


<script>
    import btnSelector from '../selectors/buttons.vue'

    /*external data*/
    import occasionList from '../data/occasions.js'

    export default {
        props: ['source_selected'],
        components: {btnSelector},
        data: function () {
            return {
                list: occasionList.default,
                selected: [],
                sync: false
            }
        },
        watch: {
            'source_selected': function (list) {
                this.selected = list;
                if (!this.sync) {
                    this.sync = true;
                    syncUpOriginalOccasions(this);
                }
            },
        },
        methods: {
            updateSelected: function (list) {
                this.selected = list;
                this.$emit('update-selected', this.selected)
            }
        },
        beforeMount: function () {
            syncUpOriginalOccasions(this);
        },
    }


    function syncUpOriginalOccasions(component) {
        if (component.source_selected != undefined) {
            var newSelectedList = [];
            for (var i = 0; i < component.source_selected.length; i++) {
                //original component title
                var selectedTitle = component.source_selected[i].title;
                for (var j = 0; j < component.list.length; j++) {
                    //total list title
                    var itemTitle = component.list[j].title;
                    if (selectedTitle == itemTitle) {
                        newSelectedList.push(component.list[j]);
                        break;
                    }
                }
            }
            component.updateSelected(newSelectedList);
        }
    }
</script>