<template>
    <span>
        <label>
            <input type="radio"
                   :value="optionValue"
                   :name="idValue"
                   @click="set_option">{{ optionValue }}
        </label> &nbsp;
    </span>
</template>

<script>
    export default {
        props: ['option', 'id'],
        data: function () {
            return {optionValue: '', idValue: ''}
        },
        methods: {
            set_option: function () {
                this.$emit('update-option', this.optionValue);
            },
            initData: function () {
                this.optionValue = this.option;
                this.idValue = this.id;
            }
        },
        watch: {
            'option': function () {
                this.initData();
            }
        },
        mounted: function () {
            this.initData();
        }
    }
</script>