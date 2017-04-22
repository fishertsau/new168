<div class="panel panel-warning">
    <div class="panel-heading">
        <h3 class="panel-title">其他說明</h3>
    </div>
    <div class="panel-body">
        <div class="form-horizontal">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">適合場合<br>
                    <button class="btn btn-success btn-xs"
                            @click.prevent="unset_formInput('occasions',false,'array')">
                        清除設定
                    </button>
                </label>

                <div class="col-sm-10">
                    <small class="text-danger">
                        <ins>可複選</ins>
                    </small><br>
                    <input type="hidden"
                           v-for="occasion in formInput.occasions"
                           :value="occasion.id"
                           name="occasion[]">

                    <occasion-list-buttons
                            :source_selected="formInput.occasions"
                            @update-selected="updateOccasion"
                            >
                    </occasion-list-buttons>
                    <br>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-2 control-label">
                    其他說明 (最多150個字)
                </label>

                <div class="col-sm-10">
                        <textarea class="form-control"
                                  rows="3"
                                  name="description"
                                  v-model="formInput.description"
                                  placeholder="請輸入設備說明,最多150個字">
                        {{old('description')}}
                        </textarea>

                    <p class="text-dark" v-show="!description_too_long">剩餘@{{ description_left }}字</p>

                    <p class="text-danger" v-show="description_too_long" v-cloak>超過@{{ description_over }}
                        字(超過部分存檔時會被刪除)</p>
                </div>
            </div>
        </div>
    </div>
</div>