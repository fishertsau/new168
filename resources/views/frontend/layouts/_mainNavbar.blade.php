<div id="top-navbar-outter-frame"
     class="full-width"
     style="position:fixed;top:0;left:0;z-index:500;height:56px"
        >
    <div class="full-width visible-mobile-block zero-margin"
         id="mobile-navbar">
        <h3 class="zero-margin">
            <a href="/"><img src="/images/companyInfo/168.png" alt=""
                             class="img-responsive pull-left"
                             id="mobile-navbar-logo"></a>
            <span class="pull-right" style="margin-top:5px">
                @if(Auth::guest())
                    <a href="{{ URL::to('login') }}">
                        <span class="text-black">登入</span>
                    </a>
                    <a href="{{ URL::to('register') }}">
                        <span class="text-black">註冊</span>
                    </a>
                @else
                    <ul class="nav navbar-nav">
                        <li class="dropdown account">
                            <a href="#"
                               class="dropdown-toggle"
                               data-toggle="dropdown"
                               role="button"
                               aria-haspopup="true"
                               aria-expanded="false"
                               onmouseover="this.style.background = 'transparent'">
                                <span class="text-danger username">
                                    {{auth()->user()->name}}
                                </span>
                                <span class="caret text-danger"></span>
                            </a>

                            <div class="dropdown-menu">
                                <ul>
                                    <li><a href="/account">我的帳號</a></li>
                                    <li><a href="#">我的收藏</a></li>
                                    <li><a href="#">我的刊登</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <form action="/logout" method="post">
                                            {{csrf_field()}}
                                            {{--<button style="border:none;background: transparent">登出</button>--}}
                                            <a href="#" onclick="this.parentNode.submit()"
                                                    >
                                                登出</a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                    </ul>
            </span>
        </h3>
    </div>

    <nav class="navbar navbar-default hidden-xs hidden-sm"
         id="top-navbar"
         style="height:20px">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" id="navbar-left">
                <a class="navbar-brand" href="/">
                    <span class="rwd-text-22 text-black">首頁</span>
                </a>
                <a class="navbar-brand" href="/subpage">
                    <span class="rwd-text-22 text-black">縱貫線</span>
                </a>

                <a class="navbar-brand" href="/devices">
                    <span class="rwd-text-22 text-black">找設備</span>
                </a>

                <a class="navbar-brand" href="/devices/create">
                    <span class="rwd-text-22 text-black">賣設備</span>
                </a>
                <a class="navbar-brand" href="/vendors/create">
                    <span class="rwd-text-22 text-black">建立廠商</span>
                </a>
            </div>

            <div {{--class="collapse navbar-collapse"--}}
                    class="pull-right"
                    id="navbar-right">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#"
                           class="dropdown-toggle"
                           data-toggle="dropdown"
                           role="button"
                           aria-haspopup="true"
                           aria-expanded="false"
                           onmouseover="this.style.background = 'transparent'">
                            <span class="glyphicon glyphicon-search"></span>
                            <span class="text-black">我要尋找</span>
                        </a>

                        <div class="dropdown-menu">
                            @include('frontend.layouts._searchAll')
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"
                           data-toggle="dropdown"
                           role="button"
                           aria-haspopup="true"
                           aria-expanded="false"
                           onmouseover="this.style.background = 'transparent'"
                                >
                            <span class="glyphicon glyphicon-list-alt"></span>
                            <span class="text-black">我要刊登</span></a>

                        <div class="dropdown-menu">
                            @include('frontend.layouts._postAll')
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#"
                           class="dropdown-toggle"
                           data-toggle="dropdown"
                           role="button"
                           aria-haspopup="true"
                           aria-expanded="false"
                           onmouseover="this.style.background = 'transparent'">
                            <span class="glyphicon glyphicon-transfer"></span>
                            <span class="text-black">交流資訊</span></a>

                        <div class="dropdown-menu">
                            @include('frontend.layouts._infoAll')
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#"
                           class="dropdown-toggle"
                           data-toggle="dropdown"
                           role="button"
                           aria-haspopup="true"
                           aria-expanded="false"
                           onmouseover="this.style.background = 'transparent'">
                            <span class="glyphicon glyphicon-plus"></span>
                            <span class="text-black">更多服務</span></a>

                        <div class="dropdown-menu">
                            @include('frontend.layouts._serviceAll')
                        </div>
                    </li>

                    @if(Auth::guest())
                        <li><a href="{{ URL::to('login') }}">
                                <i class="fa fa-sign-in text-black"></i>&nbsp;
                                <span class="text-black">登入</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('register') }}">
                                <span class="text-black">註冊</span>
                            </a>
                        </li>
                    @else
                        <li class="dropdown account">
                            <a href="#"
                               class="dropdown-toggle"
                               data-toggle="dropdown"
                               role="button"
                               aria-haspopup="true"
                               aria-expanded="false"
                               onmouseover="this.style.background = 'transparent'">
{{--                                <img src="{{auth()->user()->avatar}}" style="width:20px">--}}
                                <span class="text-danger username" id="username">
                                    {{auth()->user()->name}}
                                </span>
                                <span class="caret text-black"></span>
                            </a>

                            <div class="dropdown-menu">
                                <ul>
                                    <li><a href="/account">我的帳號</a></li>
                                    <li><a href="#">我的收藏</a></li>
                                    <li><a href="#">我的刊登</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <form action="/logout" method="post"
                                                class="logoutForm">
                                            {{csrf_field()}}
                                            <a onclick="this.parentNode.submit()"
                                                    id="doLogout">登出</a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</div>
