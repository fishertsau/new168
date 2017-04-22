<template>
    <div>
        <h5 class="text-danger">規格小幫手:(1)選擇設備->(2)點選規格->(3)加入</h5>

        <div class="input-group">
            <span class="input-group-addon" style="background: #3073ae;color:white">
                常見設備
            </span>
            <select class="form-control"
                    v-model="selected_device">
                <option value="">選擇設備</option>
                <option v-for="device in refSpec"
                        :value="device">
                    {{ device.title }}
                </option>
            </select>
        </div>
        <br>
        <one-spec v-for="spec in selected_device.specs"
                  :spec="spec"
                  @add-spec="addSpec">
        </one-spec>
    </div>
</template>

<script>
    import oneSpec from './oneRefSpec.vue';

    /*external data*/
    import refSpec from '../../data/refSpec.js';

    export default {
        data: function () {
            return {
                refSpec: refSpec.default,
                selected_device: ''
            }
        },
        components: {
            oneSpec
        },
        methods: {
            addSpec: function (obj) {
                this.$emit('add-spec', obj);
            }
        }
    }
    ;
</script>