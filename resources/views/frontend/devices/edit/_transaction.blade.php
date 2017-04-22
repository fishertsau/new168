<div class="panel panel-warning">
    <div class="panel-heading">
        <h3 class="panel-title">交易方式</h3>
    </div>
    <div class="panel-body">
        <div class="form-horizontal">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"><span class="text-danger">*</span> 付款方式</label>

                <div class="col-sm-10">
                    <div class="radio">
                        <label>
                            <input type="radio" name="transaction" value="現金交易"
                                   v-model="formInput.transaction" required>現金交易
                        </label>
                        <label>
                            <input type="radio" name="transaction" value="匯款"
                                   v-model="formInput.transaction">匯款
                        </label>
                        <label>
                            <input type="radio" name="transaction" value="分期付款"
                                   v-model="formInput.transaction">分期付款
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-2 control-label">
                    <span class="text-danger">*</span> 訂金
                </label>

                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="number" class="form-control"
                               placeholder="輸入訂金"
                               id="deposit"
                               name="deposit"
                               min="0"
                               v-model="formInput.deposit"
                               required>
                        <span class="input-group-addon" id="">元</span>
                    </div>
                    <button class="btn btn-info btn-xs"
                            @click.prevent="unset_formInput('deposit')">重設/自行輸入
                    </button>

                    <button class="btn btn-warning btn-xs"
                            @click.prevent="unset_formInput('deposit',false,'number')">不需訂金
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>