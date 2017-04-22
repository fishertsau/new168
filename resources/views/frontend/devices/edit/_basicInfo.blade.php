<div class="form-horizontal">
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">
            <span class="text-danger">*</span> 類別
        </label>

        <div class="col-sm-10">
            <input type="text"
                   class="hidden"
                   name="cat_id"
                   v-model="formInput.cat[0].id"
                   required
                    >

            <p class="text-danger" style="margin-top: 10px"
               @click.prevent="viewControl.see_cat_menu=true"
               id="cat_id_selector">
                @{{ formInput.cat[0].title }}
                <span class="text-primary">
                                        <button class="btn btn-warning btn-xs"
                                                @click.prevent="viewControl.see_cat_menu=true">選擇
                                        </button>
                                    </span>
            </p>
            <div style="position:relative">
                <div style="position: absolute;top:0.2em;left:0;z-index: 100;background: lightyellow"
                     v-show="viewControl.see_cat_menu" v-cloak>
                    <div>
                        <button class="pull-right btn btn-danger btn-sm"
                                @click.prevent="viewControl.see_cat_menu=false">
                            關閉
                        </button>
                    </div>
                    <br>
                    <device-category
                            :source="formInput.cat"
                    @update-selected="updateCat">
                    </device-category>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="" class="col-sm-2 control-label">
            <span class="text-danger">*</span> 名稱
        </label>

        <div class="col-sm-5">
            <input type="text"
                   class="form-control"
                   id="title"
                   name="title"
                   v-model="formInput.title"
                   placeholder="設備名稱,如:急速冷凍櫃"
                   required>
        </div>
    </div>


</div>