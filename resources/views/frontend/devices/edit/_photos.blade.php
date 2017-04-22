<div class="panel panel-warning">
    <div class="panel-heading">
        <h3 class="panel-title">設備相片</h3>
    </div>
    <div class="panel-body">
        <div class="form-horizontal">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">各角度相片
                    <br>
                    <small class="text-danger">
                        <ins>範例</ins>
                    </small>
                </label>

                <div class="col-sm-5">

                    <div class="full-width">
                        <!--主要圖片-->
                        <p class="text-primary">主要圖片</p>
                        <photo-input
                                model="device"
                                :id="item.id"
                                field="coverphoto"
                                :filepath="photos['coverphoto']"
                                >
                        </photo-input>
                    </div>
                    <div class="full-width">
                        <!--左側圖片-->
                        <p class="text-primary">左側圖片</p>
                        <photo-input
                                model="device"
                                :id="item.id"
                                field="leftphoto"
                                :filepath="photos['leftphoto']"
                                >
                        </photo-input>
                    </div>
                    <div class="full-width">
                        <!--右側圖片-->
                        <p class="text-primary">右側圖片</p>
                        <photo-input
                                model="device"
                                :id="item.id"
                                field="rightphoto"
                                :filepath="photos['rightphoto']">
                        </photo-input>
                    </div>
                    <div class="full-width">
                        <!--設備背後-->
                        <p class="text-primary">設備背後</p>
                        <photo-input
                                model="device"
                                :id="item.id"
                                field="backphoto"
                                :filepath="photos['backphoto']">
                        </photo-input>
                    </div>
                    <div class="full-width">
                        <!--重要機組-1-->
                        <p class="text-primary">重要機組-1</p>
                        <photo-input
                                model="device"
                                :id="item.id"
                                field="core1photo"
                                :filepath="photos['core1photo']">
                        </photo-input>
                    </div>
                    <div class="full-width">
                        <!--重要機組-2-->
                        <p class="text-primary">重要機組-2</p>
                        <photo-input
                                model="device"
                                :id="item.id"
                                field="core2photo"
                                :filepath="photos['core2photo']">
                        </photo-input>
                    </div>

                    <div class="full-width">
                        <!--設備標籤-->
                        <p class="text-primary">設備標籤</p>
                        <photo-input
                                model="device"
                                :id="item.id"
                                field="tagphoto"
                                :filepath="photos['tagphoto']">
                        </photo-input>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>