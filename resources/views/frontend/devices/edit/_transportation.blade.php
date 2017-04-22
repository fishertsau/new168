<div class="panel panel-warning">
    <div class="panel-heading">
        <h3 class="panel-title">運送方式</h3>
    </div>
    <div class="panel-body">
        <div class="form-horizontal">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"><span class="text-danger">*</span> 運送方式</label>

                <div class="col-sm-10">
                    <div class="radio">
                        <label>
                            <input type="radio" name="transportation" value="自行取貨"
                                   v-model="formInput.transportation" required>
                            自行取貨
                        </label>
                        <label>
                            <input type="radio" name="transportation" value="配送到府"
                                   v-model="formInput.transportation">
                            配送到府
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-2 control-label"><span class="text-danger">*</span> 運費</label>

                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="number" class="form-control"
                               placeholder="輸入運費"
                               id="freight"
                               name="freight"
                               min="0"
                               value="{{old('freight')}}"
                               v-model="formInput.freight"
                               required>
                        <span class="input-group-addon" id="">元</span>
                    </div>
                    <button class="btn btn-info btn-xs"
                            @click.prevent="unset_formInput('freight')">重設/自行輸入
                    </button>
                    <button class="btn btn-warning btn-xs"
                            @click.prevent="unset_formInput('freight',false,'number')">不需運費
                    </button>

                    <div>
                        <div class="radio">
                            <span class="text-danger">運費: (1)以一樓平面為主,(2)外縣市或二樓以上另計</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>