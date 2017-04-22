    <!-- Nav tabs -->
    <?php $gears = isset($bottom)?'bottom-gears':'gear' ?>
    <?php $vendors = isset($bottom)?'bottom-vendors':'vendors' ?>
    <?php $sites = isset($bottom)?'bottom-sites':'sites' ?>
    <?php $chain = isset($bottom)?'bottom-chain':'chain' ?>
    <?php $orgs = isset($bottom)?'bottom-orgs':'orgs' ?>
    <?php $resources = isset($bottom)?'bottom-resources':'resources' ?>
    <?php $expertise = isset($bottom)?'bottom-expertise':'expertise' ?>
    <?php $jobs = isset($bottom)?'bottom-jobs':'jobs' ?>
    <?php $services = isset($bottom)?'bottom-services':'services' ?>
    <?php $themes = isset($bottom)?'bottom-themes':'themes' ?>

    <ul class="nav nav-tabs zero-margin" role="tablist" style="border: none;">
        <li role="presentation" class="active">
            {{--<a href="#{{$gears}}" aria-controls="{{$gears}}" role="tab"--}}
               {{--data-toggle="tab">餐飲設備</a>--}}
            <a href="/devices">餐飲設備</a>
        </li>
        <li role="presentation">
            <a href="#{{$vendors}}" aria-controls="{{$vendors}}" role="tab"
               data-toggle="tab">各式廠商</a></li>
        <li role="presentation">
            <a href="#{{$sites}}" aria-controls="{{$sites}}" role="tab"
               data-toggle="tab">經營地點</a></li>
        <li role="presentation">
            <a href="#{{$chain}}" aria-controls="{{$chain}}" role="tab"
               data-toggle="tab">連鎖加盟</a>
        </li>
        <li role="presentation">
            <a href="#{{$orgs}}" aria-controls="{{$orgs}}" role="tab"
               data-toggle="tab">協會工會</a>
        </li>
        <li role="presentation">
            <a href="#{{$resources}}" aria-controls="{{$resources}}" role="tab"
               data-toggle="tab">經營資源</a>
        </li>
        <li role="presentation">
            <a href="#{{$expertise}}" aria-controls="{{$expertise}}" role="tab"
               data-toggle="tab">餐飲專業</a>
        </li>
        <li role="presentation">
            <a href="#{{$jobs}}" aria-controls="{{$jobs}}" role="tab"
               data-toggle="tab">工作機會</a>
        </li>
        <li role="presentation">
            <a href="#{{$services}}" aria-controls="{{$services}}" role="tab"
               data-toggle="tab">料理服務</a>
        </li>
        <li role="presentation">
            <a href="#{{$themes}}" aria-controls="{{$themes}}" role="tab"
               data-toggle="tab">料理主題</a>
        </li>
    </ul>

<br>
    <hr class="line-dark zero-margin"/>
    <!-- Tab panes -->
    <div class="tab-content nav-tab-content">
        {{--餐飲廠商--}}
        <div role="tabpanel"
             class="tab-pane active" id="{{$gears}}">
            <h4 class="text-danger">
                <a href="/devices" style="color:#cc0001">尋找餐飲設備</a>
            </h4>
        </div>

        {{--餐飲廠商--}}
        <div role="tabpanel"
             class="tab-pane" id="{{$vendors}}">

            <h4 class="text-danger">各式廠商 &nbsp;&nbsp;
            </h4>
            <table width="100%" class="table table-condensed table-striped">
                <thead>
                    <tr>
                       <th style="width: 20%;border:none;"></th>
                       <th style="width: 70%;border:none;"></th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>餐飲設備
                    <td>
                        <a href="#">瓦斯節能</a>&nbsp;
                        <a href="#">不鏽鋼廠</a>&nbsp;
                        <a href="#">二手設備</a>&nbsp;
                        <a href="#">設備維修</a>&nbsp;</td>
                </tr>
                <tr>
                    <td>器具工具</td>
                    <td><a href="#">餐桌椅</a>&nbsp;
                        <a href="#">生財器具</a>&nbsp;
                        <a href="#">碗盤餐具</a>&nbsp;
                    </td>
                </tr>
                <tr>
                    <td>裝潢施工</td>
                    <td>
                        <a href="#">店面裝潢</a>&nbsp;
                        <a href="#">水電施作</a>&nbsp;
                        <a href="#">招牌製作</a>&nbsp;
                </tr>
                <tr>
                    <td>食材耗材</td>
                    <td><a href="#">蔬菜廠商</a>&nbsp;
                        <a href="#">食材廠商</a>&nbsp;
                        <a href="#">耗材廠商</a>&nbsp;
                    </td>
                </tr>
                <tr>
                    <td>電腦網路</td>
                    <td><a href="#">點菜系統</a>&nbsp;
                        <a href="#">管理系統</a>&nbsp;
                    </td>
                </tr>
                <tr>
                    <td>其他廠商</td>
                    <td>
                        <a href="#">餐飲規劃</a>&nbsp;
                        <a href="#">貨車租借</a>&nbsp;
                        <a href="#">搬家公司</a>&nbsp;
                        <a href="#">垃圾清運</a>&nbsp;
                    </td>
                </tr>

                </tbody>
            </table>
        </div>

        {{--經營地點--}}
        <div role="tabpanel" class="tab-pane" id="{{$sites}}">
            <h4 class="text-danger">經營地點</h4>
            <table width="100%" class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th style="width: 20%;border:none;"></th>
                    <th style="width: 70%;border:none;"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>傳統市場<td>
                        <a href="#">早市</a>&nbsp;
                        <a href="#">夜市</a>&nbsp;
                        <a href="#">黃昏市場</a>&nbsp;
                        <a href="#">攤位出租</a>&nbsp;
                        <a href="#">攤位頂讓</a>&nbsp;
                </tr>
                <tr>
                    <td>經營店面</td>
                    <td><a href="#">店面出租</a>&nbsp;
                        <a href="#">店面頂讓</a>&nbsp;

                    </td>
                </tr>
                <tr>
                    <td>節慶活動</td>
                    <td>
                        <a href="#">觀光景點</a>&nbsp;
                        <a href="#">特殊節慶</a>&nbsp;
                </tr>
                <tr>
                    <td>特殊活動</td>
                    <td>
                        <a href="#">公司活動</a>&nbsp;
                        <a href="#">外燴料理</a>&nbsp;
                        <a href="#">活動包場</a>&nbsp;
                </tr>
                </tbody>
            </table>
        </div>

        {{--連鎖加盟--}}
        <div role="tabpanel" class="tab-pane" id="{{$chain}}">
            <h4 class="text-danger">連鎖加盟</h4>
            <hr>
            <h5 class="text-danger">加盟總部</h5>
            <h5 class="text-danger">個人加盟</h5>
        </div>

        {{--工會協會--}}
        <div role="tabpanel" class="tab-pane" id="{{$orgs}}">
            <h4 class="text-danger">協會工會</h4>
            <hr>
            <h5 class="text-danger">工會組織 各式協會</h5>
        </div>

        {{--餐飲專業--}}
        <div role="tabpanel" class="tab-pane" id="{{$expertise}}">
            <h4 class="text-danger">餐飲專業</h4>
            <hr>
            <h5 class="text-danger">餐飲人才 餐飲技術 顧問規劃</h5>
        </div>

        {{--經營資源--}}
        <div role="tabpanel" class="tab-pane" id="{{$resources}}">
            <h4 class="text-danger">經營資源</h4>
            <hr>
            <h5 class="text-danger">經營資金 法律服務 餐飲課程</h5>
        </div>

        {{--工作機會--}}
        <div role="tabpanel" class="tab-pane" id="{{$jobs}}">
            <h4 class="text-danger">工作機會</h4>
            <hr>
            <h5 class="text-danger">徵人廣告 廠商需求 食材需求 服務需求</h5>
        </div>

        {{--料理服務--}}
        <div role="tabpanel" class="tab-pane" id="{{$services}}">
            <h4 class="text-danger">料理服務</h4>
            <hr>
            <h5 class="text-danger">外燴服務 美味料理</h5>
        </div>

        {{--料理主題--}}
        <div role="tabpanel" class="tab-pane" id="{{$themes}}">
            <h4 class="text-danger">料理主題</h4>
            <hr>
            <h5 class="text-danger">義式料理 日本料理 韓式料理</h5>
        </div>
    </div>
