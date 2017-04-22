<template>
    <div>
        <tab-titles :input="titles"
                    @update-title="updateActiveTitle"
                    :active="active">
        </tab-titles>

        <slot></slot>
    </div>
</template>


<script>
    import tabTitles from './tabTitles.vue';

    export default {
        props: ['source'],
        components: {
            tabTitles
        },
        data: function () {
            return {titles: '', active: ''}
        },
        methods: {
            updateActiveTitle: function (title) {
                this.active = title;
                this.$emit('update-title', title);
            },
            initialization: function () {
                //initialize data basing upon source data type
                if (("array" === typeof(this.source)) ||
                        ("object" === typeof(this.source))) {
                    this.titles = this.source;
                } else {
                    this.titles = this.source.split(",");
                }
                this.active = this.titles[0];
            }
        },
        mounted: function () {
            this.initialization();
        }
    }
</script>