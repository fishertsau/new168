<div class="panel panel-warning">
    <div class="panel-heading">
        <h3 class="panel-title">聯絡資訊

        </h3>
    </div>
    <div class="panel-body">
        <div class="form-horizontal">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">
                    <span class="text-danger">*</span>聯絡人
                </label>

                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                        <button class="btn btn-success" type="button">身分</button>
                        </span>
                        <select name="contact_role"
                                class="form-control"
                                v-model="formInput.contact_role"
                                required>
                            <option value="">選擇身分</option>
                            <option value="店家">店家</option>
                            <option value="個人">個人</option>
                            <option value="設備商">設備商</option>
                            <option value="其他">其他</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <input type="text"
                           class="form-control"
                           name="contact_name"
                           id="contact_name"
                           placeholder="聯絡人姓氏"
                           v-model="formInput.contact_name"
                           required>
                    <button class="btn btn-info btn-xs"
                            @click.prevent="unset_formInput('contact_name')">重寫
                    </button>
                    <button class="btn btn-success btn-xs"
                            @click.prevent="set_contact_title('先生')">先生
                    </button>
                    <button class="btn btn-success btn-xs"
                            @click.prevent="set_contact_title('小姐')">小姐
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-2 control-label">
                    <span class="text-danger">*</span>聯絡電話
                </label>

                <div class="col-sm-5">
                    <input type="tel"
                           class="form-control"
                           id="contact_tel"
                           name="contact_tel"
                           v-model="formInput.contact_tel"
                           placeholder="聯絡電話,09xx-" required>
                    <button class="btn btn-info btn-xs"
                            @click.prevent="unset_formInput('contact_tel')">重寫
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-2 control-label">
                    <span class="text-danger">*</span>Email
                </label>

                <div class="col-sm-5">
                    <input type="email"
                           class="form-control"
                           id="contact_email"
                           name="contact_email"
                           v-model="formInput.contact_email"
                           placeholder="電子信箱, abc@abc.com" required>
                    <button class="btn btn-info btn-xs"
                            @click.prevent="unset_formInput('contact_email')">重寫
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-2 control-label">
                    <span class="text-danger">*</span>Line Id
                </label>

                <div class="col-sm-5">
                    <input type="text"
                           class="form-control"
                           id="contact_line_id"
                           name="contact_line_id"
                           v-model="formInput.contact_line_id"
                           placeholder="Line Id" required>
                    <button class="btn btn-info btn-xs"
                            @click.prevent="unset_formInput('contact_line_id')">重寫
                    </button>
                    <button class="btn btn-warning btn-xs"
                            @click.prevent="sync_mobile_line_id">同行動電話
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>