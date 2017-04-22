<template>
    <div>
        <div class="form-group">
            <label class="col-sm-2 control-label">
                <span class="text-danger">*</span> 品牌
            </label>

            <div class="col-sm-5">
                <input type="text"
                       class="form-control"
                       id="brand"
                       name="brand"
                       placeholder="輸入設備品牌"
                       v-model="formInput.brand"
                       required>
                <button class="btn btn-info btn-xs"
                        @click.prevent="unsetBrand">重設/自行輸入
                </button>
            </div>

            <div class="col-sm-3">
                <select name=""
                        class="form-control"
                        v-model="selectedBrand"
                        >
                    <option value="">選擇品牌</option>
                    <option>一般品牌</option>
                    <optgroup label="冰箱">
                        <option value="東元">東元</option>
                        <option value="聲寶">聲寶</option>
                    </optgroup>
                    <optgroup label="咖啡機">
                        <option value="惠而浦">惠而浦</option>
                        <option value="望高寮">望高寮</option>
                    </optgroup>
                </select>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        props: ['sourcebrand'],
        data: function () {
            return {
                formInput: {brand: ''},
                selectedBrand: ''
            }
        },
        watch: {
            'selectedBrand': function (brand) {
                this.formInput.brand = brand;
            }
        },
        methods: {
            unsetBrand: function () {
                this.formInput.brand = '';
                document.querySelector('#brand').focus();
                this.selectedBrand = '';
            }
        },
        beforeMount: function () {
            if (this.sourcebrand) {
                this.formInput.brand = this.sourcebrand;
            }
        },
    }
</script>