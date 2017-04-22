<template>
    <h4 class="v-component-tab-title v-component-tab-transition text-center"
          :class="{'v-component-tab-title--selected':isSelected}"
          @mouseover="setActiveTitle">{{item}}</h4>
</template>

<style lang="sass">
 @import 'tabBlock.sass';
</style>

<script>
    export default {
        props: ['item', 'active'],
        methods: {
            setActiveTitle: function () {
                this.$emit('update-title', this.item);
            }
        },
        computed: {
            isSelected: function () {
                return this.active == this.item;
            }
        }
    }
</script>