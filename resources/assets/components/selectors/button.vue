<template>
    <span>
        <button class="btn btn-default"
                :class="{'btn-warning':isInSelectedList}"
                @click.prevent="toggleSelected"
                style="margin-right:5px;">
            {{item.title}}
        </button>
    </span>
</template>

<script>
    export default {
        props: ['item', 'selected_list'],
        data: function () {
            return {selected_items: []}
        },
        computed: {
            isInSelectedList: function () {
                var index = this.selected_items.indexOf(this.item);
                return (index != (-1));
//                var inList = false;
//                var arrayLength = this.selected_list.length;
//                for (var i = 0; i < arrayLength; i++) {
//                    if (this.selected_list[i].title == this.item.title) {
//                        inList = true;
//                    }
//                }
//                return inList;
            },
        },
        watch: {
            selected_list: function () {
                this.selected_items = this.selected_list;
            },
        },
        methods: {
            toggleSelected: function () {
                var event = (this.isInSelectedList) ? 'remove-selected' : 'update-selected';
                this.$emit(event, this.item);
            }
        },
        mounted: function () {
            this.selected_items = this.selected_list;
        }
    }
</script>