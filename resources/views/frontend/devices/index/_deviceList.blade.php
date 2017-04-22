<div v-show="view_control.device_block_view">
    <div class="col-sm-6 col-md-4 col-xs-6" v-for="item in device_list">
        {{--<device-block :device="item"></device-block>--}}
        <div class="thumbnail" style="background: white">
            <a :href="'/devices/'+item.id">
                <img :src="filePath(item.coverphoto)" alt=""
                     style="/*width: 100%*//*max-height:120px*/height:120px">
            </a>

            <div class="caption">
                <h4 class="text-danger">@{{ item.title }}</h4>
                <h4>價格:<span class="text-warning">@{{ item.price|moneyFormat}}</span></h4>

                <p class="text-primary">瀏覽人次: &nbsp;@{{ item.reads }}</p>

                <p class="text-primary">@{{ item.created_date }}刊登
                    <a :href="'/devices/'+item.id">
                        <span class="pull-right text-danger">查看&nbsp;
                            <i class="fa fa-caret-right" aria-hidden="true"></i></span>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>


<div v-show="!view_control.device_block_view">
    <div class="col-md-12">
        <table>
            <thead>
            <tr>
                <th style="width: 25%"></th>
                <th style="width: 25%"></th>
                <th style="width: 25%"></th>
                <th style="width: 25%"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in device_list">
                <td style="padding-bottom: 5px">
                    <img :src="photoDir + item.coverPhoto" alt="" style="width: 120px;height:80px">
                </td>
                <td style="vertical-align: top">
                    <h4 class="text-danger">@{{ item.title }}</h4>
                    <h4 class="text-warning">價格@{{ item.price | currency }} </h4>
                </td>
                <td style="vertical-align: top">
                    @{{ item.description }}
                </td>
                <td style="vertical-align: top">
                    <div class="pull-right">
                        <div class="text-primary">@{{ item.created_date }}刊登</div>
                        <div class="text-primary">瀏覽人次: &nbsp;@{{ item.reads }}</div>
                        <div class="text-danger">
                            <a :href="'/devices/'+item.id">
                                <span class="pull-right text-danger">查看&nbsp;
                                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <hr>
    </div>
</div>
