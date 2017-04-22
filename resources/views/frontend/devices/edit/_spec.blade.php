<div class="panel panel-warning">
    <div class="panel-heading">
        <h3 class="panel-title">尺寸與規格</h3>
    </div>
    <div class="panel-body">
        <div class="form-horizontal">
            {{--外觀尺寸--}}
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"><span class="text-danger">*</span> 外觀尺寸
                    <br>
                    <small class="text-danger" style="cursor: pointer">
                        <ins @click="showDimensionNote">說明</ins>
                    </small>

                </label>

                <div class="col-sm-5">
                    <div class="input-group">
                        <span class="input-group-addon">寬度</span>
                        <input type="number" class="form-control"
                               min="0"
                               name="dimension[width]"
                               v-model="formInput.dimension.width"
                               required>
                        <span class="input-group-addon">公分</span>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">深度</span>
                        <input type="number" class="form-control"
                               min="0"
                               v-model="formInput.dimension.depth"
                               name="dimension[depth]"
                               required>
                        <span class="input-group-addon">公分</span>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">高度</span>
                        <input type="number" class="form-control"
                               min="0"
                               v-model="formInput.dimension.height"
                               name="dimension[height]"
                               required>
                        <span class="input-group-addon">公分</span>
                    </div>
                </div>
            </div>

            {{--常見規格--}}
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">常用規格</label>

                <div class="col-sm-8">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="gas_type_chosen"
                                   v-model="selected_options.gas_type_checked"> 使用瓦斯
                        </label>
                        <span v-show="selected_options.gas_type_checked"
                              style="background:lightgoldenrodyellow" v-cloak>
                                <label class="">
                                    <input type="radio"
                                           name="gas_type"
                                           id="gas_type_input"
                                           value="天然氣"
                                           v-model="formInput.gas_type"
                                           :required="selected_options.gas_type_checked"
                                            >天然氣
                                </label>
                                <label class="">
                                    <input type="radio" name="gas_type" value="桶裝瓦斯"
                                           v-model="formInput.gas_type">桶裝瓦斯
                                </label>
                                    <label class="">
                                        <input type="radio" name="gas_type" value="其他"
                                               v-model="formInput.gas_type">其他
                                    </label>
                        </span>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" v-model="selected_options.voltage_checked"> 使用電力
                        </label>
                        <span v-show="selected_options.voltage_checked" style="background:lightgoldenrodyellow"
                              v-cloak>

                        <label class="">
                            <input type="radio" name="voltage" value="110V"
                                   v-model="formInput.voltage"
                                   :required="selected_options.voltage_checked"> 110V
                        </label>
                        <label class="">
                            <input type="radio" name="voltage" value="220V"
                                   v-model="formInput.voltage"> 220V
                        </label>
                        <label class="">
                            <input type="radio" name="voltage" value="三向220V"
                                   v-model="formInput.voltage"> 三向220V
                        </label>
                        </span>
                    </div>
                </div>
            </div>

            {{--自訂規格--}}
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">自訂規格
                    <br>
                    <small class="text-danger">
                        <ins>說明</ins>
                    </small>
                    <br>
                    <button class="btn btn-success btn-xs" type="button"
                            @click.prevent="increment_custom_spec_list">
                        <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;新增
                    </button>
                </label>

                <div class="col-sm-10">
                    <div v-show="has_spec" v-cloak id="custom_spec">
                        <table width="100%"
                               class="table table-hover table-nomargin table-striped formTable text-center"
                                >
                            <thead>
                            <tr>
                                <td width="10%"></td>
                                <td width="20%">項目</td>
                                <td width="35%">描述</td>
                                <td width="15%"></td>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="item in formInput.specs">
                                <td style="vertical-align: middle">
                                        <span style="color:white;background: #cc0001;padding:2px;cursor: pointer"
                                              @click.prvent="remove_custom_spec_list(item)"
                                                >刪除
                                        </span>
                                </td>
                                <td><input type="text"
                                           class="form-control"
                                           placeholder="如:'噸數'或'重量'"
                                           name="specs[title][]"
                                           required
                                           v-model="item.title"
                                            >
                                </td>
                                <td><input type="text"
                                           class="form-control"
                                           placeholder="如:'200噸','30公斤'"
                                           name="specs[description][]"
                                           v-model="item.description"
                                           required>
                                </td>
                                <td>
                                    <button class="btn btn-success btn-xs" type="button"
                                            @click.prevent="increment_custom_spec_list">
                                        <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;新增
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-primary" style="background: lightgoldenrodyellow;margin-left:30px;padding:5px">
                        範例: (1)項目:噸數/描述:200噸, (2)項目:重量/描述:30公斤, (3)項目:門數/描述:2門
                    </div>
                    <hr class="line-dark">
                    <div>
                        <ref-specs @add-spec="moreSpec">
                        </ref-specs>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>