<div class="panel panel-warning">
    <div class="panel-heading">
        <h3 class="panel-title">設備狀況</h3>
    </div>
    <div class="panel-body">
        <div class="form-horizontal">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"><span class="text-danger">*</span> 新舊</label>

                <div class="col-sm-10">
                    <div class="radio">
                        <label>
                            <input type="radio"
                                   id="is_new_true"
                                   name="is_new"
                                   value="1"
                                   v-model="formInput.is_new"
                                   required
                                    >全新
                        </label>&nbsp;&nbsp;&nbsp;
                        <label>
                            <input type="radio"
                                   id="is_new_false"
                                   name="is_new"
                                   v-model="formInput.is_new"
                                   value="0">二手
                        </label>
                    </div>
                    <br>

                    <div class="form-inline" v-show="!newSelected" v-cloak>
                        <div class="form-group" style="background: lightgoldenrodyellow;padding:3px">
                            <label for=""><span class="text-danger">*</span> 使用狀況/時間</label>

                            <div>
                                <input type="text"
                                       class="form-control"
                                       id="used_time"
                                       name="used_time"
                                       v-model="formInput.used_time"
                                       placeholder="使用狀況/時間">
                                <button class="btn btn-info btn-xs"
                                        {{--@click.prevent="unset_used_time"--}}
                                        @click.prevent="unset_formInput('used_time')"
                                        >重設/自行輸入
                                </button>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio"
                                           value="九成新"
                                           v-model="formInput.used_time"
                                            >九成新
                                </label>&nbsp;&nbsp;
                                <label>
                                    <input type="radio"
                                           value="3個月內"
                                           v-model="formInput.used_time"
                                            >3個月內
                                </label>&nbsp;&nbsp;
                                <label>
                                    <input type="radio"
                                           value="6個月內"
                                           v-model="formInput.used_time"
                                            >6個月內
                                </label>&nbsp;&nbsp;
                                <label>
                                    <input type="radio"
                                           value="1年內"
                                           v-model="formInput.used_time"
                                            >1年內
                                </label>&nbsp;&nbsp;
                                <label>
                                    <input type="radio"
                                           value="1年以上"
                                           v-model="formInput.used_time"
                                            >1年以上
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"><span class="text-danger">*</span> 保固</label>

                <div class="col-md-7">
                    <input type="text" class="form-control"
                           id="guarantee"
                           name="guarantee"
                           placeholder="設備保固"
                           value="{{old('guarantee')}}"
                           v-model="formInput.guarantee"
                           required>
                    <button class="btn btn-info btn-xs"
                            @click.prevent="unset_formInput('guarantee')">重設/自行輸入
                    </button>
                    <div class="radio" style="background:lightgoldenrodyellow">
                        <label>
                            <input type="radio" name="guarantee_content" value="3個月"
                                   v-model="formInput.guarantee"
                                    >3個月
                        </label>&nbsp;&nbsp;
                        <label>
                            <input type="radio" name="guarantee_content" value="6個月"
                                   v-model="formInput.guarantee"
                                    >6個月
                        </label>&nbsp;&nbsp;
                        <label>
                            <input type="radio" name="guarantee_content" id="" value="1年"
                                   v-model="formInput.guarantee"
                                    >1年
                        </label>&nbsp;&nbsp;
                        <label>
                            <input type="radio" name="guarantee_content" value="保修不保固"
                                   v-model="formInput.guarantee"
                                    >保修不保固
                        </label>&nbsp;&nbsp;
                        <label>
                            <input type="radio" name="guarantee_content" value="現況交貨"
                                   v-model="formInput.guarantee"
                                    >現況交貨
                        </label>&nbsp;&nbsp;
                        <label>
                            <input type="radio" name="guarantee_content" value="主要機組3個月"
                                   v-model="formInput.guarantee"
                                    >主要機組3個月
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>