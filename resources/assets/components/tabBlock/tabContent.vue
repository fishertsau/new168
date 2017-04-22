<template>
    <div v-show="isSelected" v-cloak class="tab-content">
            <slot></slot>
    </div>
</template>

<style>
    .tab-content {
        border-left:1px solid lightgray;
        border-right:1px solid lightgray;
        border-bottom:1px solid lightgray;
        margin:0
    }

    .tab-content h1 {
        margin:0
    }
</style>

<script>
    export default {
        props: ['activetitle', 'current'],
        computed: {
            isSelected: function () {
                return this.activetitle == this.current;
            }
        }
    }
</script>