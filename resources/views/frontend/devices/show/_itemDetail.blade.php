{{-- //title--}}
<span>@{{item.cat.title}}</span>
<h2 class="text-danger" style="margin-top: 0">
    @{{item.title}}
    <a href="{{url()->previous()}}" class="pull-right btn btn-default btn-xs">回上一頁</a>
</h2>


{{--// 7 photos + 4 intros--}}
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div>
            <span class="timestamp text-primary pull-right">@{{item.created_date}}刊登</span>
            <span class="timestamp text-primary">點閱次數:@{{item.reads}} &nbsp;</span><span class="timestamp text-primary">收藏人數:@{{item.likesCount}}</span>
            {{--active photo--}}
            <div style="align-content: center">
                <img
                        :src="filePath(activePhoto)"
                        alt="設備照片"
                        class="img-responsive full-width"
                        style="height:200px">
            </div>
        </div>

        <div>
            <img style="max-width: 23%;max-height: 60px;border:1px solid gray"
                 v-for="photo in item.photos"
                 :src="photo.filepath"
                 @click.prevent="updateActivePhoto(photo)">
        </div>
        <div>
            <carousel :items="pics" :speed="0.8"></carousel>
        </div>
    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="pull-right">
            @include('frontend.partials._fbLineShare')
            &nbsp;
            <button class="btn btn-xs btn-success pull-right"
                    @click.prevent="toggleLike"
                    v-show="!item.isLiked" v-cloak
                    style="height:20px">
                加入收藏
            </button>
            <button class="btn btn-xs btn-warning pull-right"
                    @click.prevent="toggleLike"
                    v-show="item.isLiked" v-cloak
                    style="height:20px">
                解除收藏
            </button>
        </div>
        <br>
        <br>

        <h3 class="zero-margin item-description">售價:
            <span style="color:#ff8c42"><b>@{{item.price | currency}}</b></span>
            <small>元/台</small>
            &nbsp;[@{{item.price_note}}]
        </h3>

        <h5 class="item-description">&#9826;&nbsp;編號: @{{item.sn}}&nbsp;

        </h5>
        <h5 class="item-description">&#9826;&nbsp;品牌/型號:&nbsp;@{{item.brand}}&nbsp;@{{item.model}}</h5>

        <h5 class="item-description"> &#9826;&nbsp;@{{item.new_text}}/@{{item.guarantee}}</h5>

        <h5 class="item-description"> &#9826;&nbsp;@{{item.dimension.width}}x@{{item.dimension.depth}}
            x@{{item.dimension.height}}(公分) &nbsp; [寬x深x高] </h5>

        <h5 class="item-description"> &#9826;&nbsp;@{{item.transaction}}&nbsp;[訂金:@{{item.deposit}}]</h5>

        <h5 class="item-description"> &#9826;&nbsp;@{{item.transportation}}&nbsp;[運費:@{{item.freight}}]</h5>

        <span class="text-danger">*運費:(1)一樓平面為主.(2)外縣市或二樓以上另計</span>
        <br>
        <br>
        <button type="button" class="btn btn-warning full-width"
                data-toggle="modal"
                data-target="#emailModal"
                data-whatever="@mdo"> <span class="glyphicon glyphicon-envelope" aria-hidden="true"
                    ></span>&nbsp;
            寄送郵件給賣家
        </button>
        </button>
        <button class="btn btn-success full-width"
                {{--v-show="!item.isSeller"--}}
                >
            <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>&nbsp;
            @{{ item.contact_tel }}
        </button>
    </div>
</div>

<br>
<div class="row">
    <div class="col-md-12">
        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">&#9613; 設備規格</label>

                <div class="col-sm-10">
                    <ul style="list-style: none;padding:0">
                        <li>&diamondsuit; &nbsp;使用瓦斯 : @{{ item.gas_type | text}}</li>
                        <li>&diamondsuit; &nbsp;使用電力 : @{{ item.voltage  | text}}</li>
                        <li v-for="spec in item.specs">&diamondsuit; &nbsp;@{{ spec.title }}
                            : @{{ spec.description }}</li>
                    </ul>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">&#9613; 其他說明</label>

                <div class="col-sm-10">
                    <p class="zero-margin">@{{item.description}}</p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">&#9613; 設備地點</label>

                <div class="col-sm-10">
                    @{{itemAddress}}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-primary">&#9613; 賣家資訊</label>

                <div class="col-sm-10">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <span class="text-danger">@{{item.contact_role}}</span>
                    <span class="text-danger">@{{item.contact_name}}</span>&nbsp;

                    <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
                    <span class="text-primary">@{{item.contact_tel}}</span>&nbsp;

                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                    <span class="text-primary">@{{ item.contact_email }}</span>&nbsp;

                    <b>Line ID:</b>
                    <span class="text-primary">@{{item.contact_line_id}}</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" style="color:#ff8c42;">&#9613; 適用場合</label>

                <div class="col-sm-10">
                    <span class="text-warning" v-for="occasion in item.occasions">@{{occasion.title}} &nbsp;</span>
                </div>
            </div>
        </div>
    </div>
</div>
