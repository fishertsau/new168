<template>
    <div>
        <div class="input-group">
            <span class="input-group-addon" id="">{{ spec.title }}</span>
            <input type="text"
                   class="form-control"
                   v-model="descriptionPrefix"
                   placeholder="規格說明"
                    >
            <span class="input-group-addon" v-show="hasUnit" v-cloak="">{{ spec.unit }}</span>
            <span class="input-group-addon" @click="addSpec"><span class="text-danger">加入</span></span>
        </div>
        <div style="background: lightgoldenrodyellow">
            參考選項:
            <spec-option v-for="option in spec.options"
                         :option="option"
                         :id="id"
                         @update-option="updateDescriptionPrefix"
                    >
            </spec-option>
            <button class="btn btn-success btn-xs"
                    @click.prevent="unset_option">重設
            </button>
        </div>
        <br>
    </div>
</template>

<script>
    import specOption from './specOption.vue'

    export default {
        props: ['spec'],
        data: function () {
            return {title: '', descriptionPrefix: '', id: '', unit: ''}
        },
        components: {
            specOption
        },
        methods: {
            validateInput: function () {
                if (this.descriptionPrefix == '') {
                    alert('請輸入規格說明');
                    return false;
                }

                return true;
            },
            unset_option: function () {
                this.descriptionPrefix = '';
            },
            addSpec: function () {
                if (!this.validateInput()) {
                    return;
                }
                var speObj = {
                    title: this.title,
                    description: this.fullDescription,
                    id: this.id
                }
                this.$emit('add-spec', speObj);
            },
            updateDescriptionPrefix: function (option) {
                this.descriptionPrefix = option;
            },
            initData: function () {
                this.title = this.spec.title;
                this.unit = this.spec.unit;
                this.id = this.title + (new Date().getTime());
                this.descriptionPrefix = '';
            }
        },
        computed: {
            fullDescription: function () {
                var unit = (this.spec.unit == '無單位') ? '' : this.spec.unit;
                return (this.descriptionPrefix + unit);
            },
            hasUnit: function () {
                return this.unit != '無單位';
            }
        },
        watch: {
            spec: function () {
                this.initData();
            }
        },
        mounted: function () {
            this.initData();
        }
    };
</script>