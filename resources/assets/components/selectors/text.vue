<template>
    <span>
        <span class="text-underline rwd-text-20"
              :class="{'text-danger':isInSelectedList}"
              @click="toggleSelected"
              style="margin-right:5px;">
            {{item.title}}
        </span>
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
                return this.selected_items.indexOf(this.item) !== (-1);
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
        }
    }
</script>