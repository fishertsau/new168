<div class="panel panel-warning">
    <div class="panel-heading">
        <h3 class="panel-title">設備價格</h3>
    </div>
    <div class="panel-body">
        <div class="form-horizontal">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">
                    <span class="text-danger">*</span> 價格
                </label>

                <div class="col-sm-7">
                    <div class="input-group">
                        <input type="number" class="form-control"
                               placeholder="輸入價格"
                               name="price"
                               id="price"
                               v-model="formInput.price"
                               min="0"
                               required>
                        <span class="input-group-addon" id="">元</span>
                    </div>
                    <button class="btn btn-info btn-xs"
                            @click.prevent="unset_formInput('price')">重設/自行輸入
                    </button>
                    <div class="radio">

                        <span class="text-dark">價格說明: &nbsp;&nbsp;</span>
                        <label>
                            <input type="radio" name="price_note" value="最低價"
                                   v-model="formInput.price_note" required>最低價(不可議)
                        </label>&nbsp;&nbsp;
                        <label>
                            <input type="radio" name="price_note" value="誠可議"
                                   v-model="formInput.price_note">誠可議
                        </label>&nbsp;&nbsp;
                        <label>
                            <input type="radio" name="price_note" value="面議"
                                   v-model="formInput.price_note"
                                    >
                            面議(不設價錢)
                        </label>
                    </div>
                    <small class="text-danger" style="position:relative">
                        <ins style="cursor: pointer"
                        @mouseover="viewControl.priceNoteShow=true"
                        @mouseout="viewControl.priceNoteShow=false"
                        >說明</ins> </small>
                    <div v-show="viewControl.priceNoteShow" @mouseout="viewControl.priceNoteShow=false"
                    style="background: lightgoldenrodyellow;padding: 5px">

                    <p class="text-primary">[最低價]: 表示賣方最低價，不二價。</p>
                    <p class="text-primary">[誠可議]: 表示尚有議價空間。</p>
                    <p class="text-primary">[面議]: 聯絡賣方後，由賣方另外報價。</p>
                </div>
            </div>


            <div class="col-sm-3" v-show="!has_price">
                <p class="text-danger" style="background: lightgoldenrodyellow">建議您設定價格,可增加成交機率!</p>
            </div>
        </div>
    </div>

</div>
</div>