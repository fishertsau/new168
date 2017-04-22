<ul id="menu" class="page-sidebar-menu">
    {{--首頁--}}
    <li {!! (Request::is('admin') ? 'class="active"' : '') !!}>
        <a href="{{ route('dashboard') }}">
            <i class="livicon" data-name="home" data-size="18" data-c="#F89A14" data-hc="#F89A14"
               data-loop="true"></i>
            <span class="title">個人首頁</span>
        </a>
    </li>

    {{--系統設定--}}
    <li {!! (Request::is('admin/systemConfig') || Request::is('admin/systemConfig/*') ? 'class="active"' : '') !!}>
        <a href="{{ URL::to('admin/systemConfig') }}">
            <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">系統設定</span>
        </a>
    </li>

    <hr/>
    {{--使用場合--}}
    <li {!! (Request::is('admin/occasions') || Request::is('admin/occasions/*') ? 'class="active"' : '') !!}>
        <a href="/admin/occasions">
            <i class="livicon" data-name="building" data-size="18" data-c="#F89A14" data-hc="#F89A14"
               data-loop="true"></i>
            <span class="title">使用場合</span>
        </a>
    </li>

    <hr/>
    {{--餐飲設備--}}
    <li {!! (Request::is('admin/devices') || Request::is('admin/devices/*') ? 'class="active"' : '') !!}>
        <a href="/admin/devices">
            <i class="livicon" data-name="shuffle" data-size="18" data-c="#F89A14" data-hc="#F89A14"
               data-loop="true"></i>
            <span class="title">餐飲設備</span>
        </a>
    </li>



    {{--營運分析--}}
    <li {!! (Request::is('admin/report') || Request::is('admin/report/*') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="linechart" data-size="18" data-c="#67C5DF" data-hc="#67C5DF"
               data-loop="true"></i>
            <span class="title">營運分析</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/aboutUs') || Request::is('admin/aboutUs/*') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/aboutUs') }}">
                    <i class="fa fa-angle-double-right"></i>
                    月報表
                </a>
            </li>
            <li {!! (Request::is('admin/lifeGasSaving') || Request::is('admin/lifeGasSaving/*') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/lifeGasSaving') }}">
                    <i class="fa fa-angle-double-right"></i>
                    日報表
                </a>
            </li>
        </ul>
    </li>

    {{--通路管理--}}
    <li {!! (Request::is('admin/sales') || Request::is('admin/sales/*') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="flag" data-size="18" data-c="#F89A14" data-hc="#F89A14"
               data-loop="true"></i>
            <span class="title">通路管理</span>
        </a>
    </li>


    <hr/>

    {{--訊息管理--}}
    <li>
        <a href="#">
            <i class="livicon" data-name="sky-dish" data-size="18" data-c="#EF6F6C" data-hc="#EF6F6C"
               data-loop="true"></i>
            <span class="title">訊息管理</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    發送訊息給通路
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    發送訊息給客戶
                </a>
            </li>
        </ul>
    </li>


    @can('service-management')
    {{--客服管理--}}
    <li {!! (Request::is('faq') || Request::is('faq/*') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="help" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">客服管理</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/faq') ? 'class="active" id="active"' : '') !!}>
                <a href="#"><i class="fa fa-angle-double-right"></i>常見問題管理</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-angle-double-right"></i>各項條款</a>
            </li>
        </ul>
    </li>
    @endcan

    @can('example-management')
    {{--案例管理--}}
    <li {!! (Request::is('admin/example') || Request::is('admin/example/*') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="camera" data-size="18" data-c="#67C5DF" data-hc="#67C5DF"
               data-loop="true"></i>
            <span class="title">案例管理</span>
        </a>
    </li>
    @endcan



    @can('marketing-management')
    {{--行銷管理--}}
    <li {!! ( Request::is('admin/news') || Request::is('admin/news/*')  ||
        Request::is('admin/video') || Request::is('admin/video/*') ||
        Request::is('admin/talk') || Request::is('admin/talk/*')
        ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="magic" data-size="18" data-c="#F89A14" data-hc="#F89A14"
               data-loop="true"></i>
            <span class="title">行銷管理</span>
            <span class="fa arrow"></span>
        </a>

        <ul class="sub-menu">
            <li {!! (Request::is('admin/news') || Request::is('admin/news/*') ? 'class="active" id="active"' : '') !!}>
                <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    消息廣告管理
                </a>
            </li>
            <li {!! (Request::is('admin/video') || Request::is('admin/video/*') ? 'class="active" id="active"' : '') !!}>
                <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    影音管理
                </a>
            </li>
            <li {!! (Request::is('admin/talk') || Request::is('admin/talk/*') ? 'class="active" id="active"' : '') !!}>
                <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    演講與推廣紀錄
                </a>
            </li>
        </ul>
    </li>
    @endcan


    @can('product-management')
    <hr/>
    {{--產品管理--}}
    <li {!! ( Request::is('admin/product/group') || Request::is('admin/product/group/*') ||
            Request::is('admin/product/product') || Request::is('admin/product/product/*')
        ? 'class="active"' : '')
            !!}>
        <a href="#">
            <i class="livicon" data-name="bulb" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">產品管理</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/product/group') || Request::is('admin/product/group/*') ? 'class="active" id="active"' : '') !!}>
                <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    系列產品
                </a>
            </li>
            <li {!! (Request::is('admin/product/product') || Request::is('admin/product/product/*') ? 'class="active" id="active"' : '') !!}>
                <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    單一產品
                </a>
            </li>
        </ul>
    </li>
    @endcan


    @can('user-management')
    <hr/>
    {{--使用者管理--}}
    <li {!! (Request::is('admin/user') || Request::is('admin/user/*') ? 'class="active"' : '') !!}>
        <a href="/admin/user">
            <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">使用者管理</span>
        </a>
    </li>
    @endcan


    @can('role-management')
    {{--群組管理--}}
    <li {!! (Request::is('admin/role') || Request::is('admin/role/*') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">群組管理</span>
            <span class="fa arrow"></span>
        </a>

        <ul class="sub-menu">
            @can('see-role')
            <li {!! (Request::is('admin/role') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/role') }}">
                    <i class="fa fa-angle-double-right"></i>
                    群組清單
                </a>
            </li>
            @endcan

            @can('create-role')
            <li {!! (Request::is('admin/role/create') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/role/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    新增群組
                </a>
            </li>
            @endcan
        </ul>
    </li>
    @endcan


    @if(Auth::user()->isSuperAdmin())
        {{--權限管理--}}
        <li {!! (Request::is('admin/permission') || Request::is('admin/permission/create') || Request::is('admin/permission/*') ? 'class="active"' : '') !!}>
            <a href="#">
                <i class="livicon" data-name="key" data-size="18" data-c="#EF6F6C" data-hc="#EF6F6C"
                   data-loop="true"></i>
                <span class="title">使用權限</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                <li {!! (Request::is('admin/permission') ? 'class="active" id="active"' : '') !!}>
                    <a href="{{ URL::to('admin/permission') }}">
                        <i class="fa fa-angle-double-right"></i>
                        權限清單
                    </a>
                </li>
                <li {!! (Request::is('admin/permission/create') ? 'class="active" id="active"' : '') !!}>
                    <a href="{{ URL::to('admin/permission/create') }}">
                        <i class="fa fa-angle-double-right"></i>
                        新增權限
                    </a>
                </li>
            </ul>
        </li>
    @endif
</ul>