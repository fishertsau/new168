<div class="slideNavbar"
     title="search">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-danger">&nbsp;&nbsp;我要尋找
                <span class="pull-right">
                    <button class="btn btn-success" onclick="closeMobileNavbar()">
                        關閉
                    </button>&nbsp;&nbsp;
                </span>
            </h3>
            @include('frontend.layouts._searchAll',['bottom'=>true])
        </div>
    </div>
</div>

<div class="slideNavbar"
     title="post">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-danger">&nbsp;&nbsp;我要刊登
                <span class="pull-right">
                    <button class="btn btn-success" onclick="closeMobileNavbar()">
                        關閉
                    </button>&nbsp;&nbsp;
                </span>
            </h3>
            @include('frontend.layouts._postAll')
        </div>
    </div>
</div>

<div class="slideNavbar"
     title="moreService">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-danger">&nbsp;&nbsp;更多服務
                <span class="pull-right">
                    <button class="btn btn-success" onclick="closeMobileNavbar()">
                        關閉
                    </button>&nbsp;&nbsp;
                </span>
            </h3>
            @include('frontend.layouts._serviceAll')
        </div>
    </div>
</div>

<div class="slideNavbar"
     title="moreInfo">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-danger">&nbsp;&nbsp;交流訊息
                <span class="pull-right">
                    <button class="btn btn-success" onclick="closeMobileNavbar()">
                        關閉
                    </button>&nbsp;&nbsp;
                </span>
            </h3>
            @include('frontend.layouts._infoAll')
        </div>
    </div>
</div>

