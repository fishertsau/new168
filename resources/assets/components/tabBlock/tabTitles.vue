<!--
Comments:
input: (1)string of titles/array, (2)active

Examples:
(1) String: <component source="first,second">
(2) Array: <component :source="array variable">
-->

<template>
    <div style="display:flex;">
        <tab-title v-for="item in titles"
                   :item="item"
                   :active="activetitle"
                   @update-title="setActiveTitle">
        </tab-title>
    </div>
</template>


<script>
    import tabTitle from './tabTitle.vue';

    export default {
        components: {
            tabTitle
        },
        props: ['input', 'active'],
        data: function () {
            return {
                titles: '', activetitle: ''
            }
        },
        methods: {
            setActiveTitle: function (item) {
                this.activetitle = item;
                this.$emit('update-title', item);
            },
            initialization: function () {
                //initialize data basing upon input data type
                if (("array" === typeof(this.input)) ||
                        ("object" === typeof(this.input))) {
                    this.titles = this.input;
                } else if ("string" == typeof(this.input)) {
                    this.titles = this.input.split(",");
                }
                if (this.active === undefined) {
                    this.activetitle = this.titles[0];
                } else {
                    this.activetitle = this.active;
                }
            }
        },
        watch: {
            input: function () {
                this.initialization();
            },
            active: function () {
                this.initialization();
            }
        },
        mounted: function () {
            this.initialization();
        }
    }
</script>
