{{-- //title--}}

<h4>廠商類別/子類別</h4>
<h2 class="text-danger" style="margin-top: 0;display: inline">
    {{$vendor->title}}
    <h5 class="text-danger " style="margin-top: 0;display: inline">&nbsp;編號: 170211</h5>
    <span class="pull-right" style="margin-top:5px"> 加到常用廠商
        <span class="glyphicon glyphicon-heart text-danger" aria-hidden="true"></span>
    </span>
</h2>
<hr class="line-dark--lighter">

<div class="row">
    <div class="col-md-12" style="margin-top:0">
        <span class="pull-left">
            廠商型態:公司 &nbsp;
            認證狀態:完整認證
        </span>
        <span class="pull-right">
        @include('frontend.partials._fbLineShare')
        </span>
    </div>
    <div class="col-md-7 col-sm-12 col-xs-12">
        {{--active photo--}}
        <div style="align-content: center">
            <img src=""
                 alt="公司照片"
                 class="img-responsive full-width"
                 style="height:300px">
        </div>
    </div>
    <div class="col-md-5 col-sm-12 col-xs-12">
        <h3>營業時間</h3>

        <p>周一至周日 09:00am - 18:00pm (週六休息)</p>
        <hr class="line-dark--lighter">

        <h3>聯絡方式</h3>

        <p>聯絡人:王大同</p>

        <p>電話:04-22228888</p>

        <p>傳真:04-22228888</p>

        <p>Email:vendor@example.com</p>

        <p>官網: http://www.vendor.com.tw</p>

        <p>粉絲頁: http://www.facebook.com</p>
        <hr class="line-dark--lighter">
        <div class="text-center">
            <a class="btn btn-default full-width" href="#" id="emailVendor">
                <p class="text-primary" style="margin-top: 8px">
                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                    聯絡廠商
                </p>
            </a>
        </div>

    </div>
</div>
<hr class="line-dark--lighter">

<div class="row">
    <div class="col-md-12">
        <div class="form-horizontal">
            {{--廠商簡介--}}
            <div class="form-group">
                <label class="col-sm-2 control-label">&#9613; 廠商簡介</label>

                <div class="col-sm-10">
                    <p>廠商簡介內容,廠商簡介內容,廠商簡介內容,廠商簡介內容,廠商簡介內容,</p>

                    <p>廠商簡介內容,廠商簡介內容,廠商簡介內容,廠商簡介內容,廠商簡介內容.</p>
                </div>
            </div>

            {{--營業據點--}}
            <div class="form-group">
                <label class="col-sm-2 control-label">&#9613; 營業據點</label>

                <div class="col-sm-10">
                    <ul>
                        <li>營業據點: 據點地址據點地址據點地址據點地址</li>
                        <li>營業據點: 據點地址據點地址據點地址據點地址</li>
                    </ul>
                </div>
            </div>

            {{--服務項目--}}
            <div class="form-group">
                <label class="col-sm-2 control-label">&#9613; 服務項目</label>

                <div class="col-sm-10">
                    <p>服務項目 . 服務項目 . 服務項目 . 服務項目</p>
                </div>
            </div>

            {{--服務區域--}}
            <div class="form-group">
                <label class="col-sm-2 control-label">&#9613; 服務區域</label>

                <div class="col-sm-10">
                    <p>服務區域 . 服務區域 . 服務區域 . 服務區域</p>
                </div>
            </div>

            {{--維修項目--}}
            <div class="form-group">
                <label class="col-sm-2 control-label">&#9613;維修項目</label>

                <div class="col-sm-10">
                    <p>維修項目 . 維修項目 . 維修項目 . 維修項目</p>
                </div>
            </div>
        </div>
    </div>
</div>