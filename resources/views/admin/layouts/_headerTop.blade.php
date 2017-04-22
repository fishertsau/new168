<header class="header">
    <a href="{{ url('/') }}" class="logo">
        <img src="{{ asset('assets/images/companyInfo/brandLogo.png') }}" alt="logo" style="height: 40px;">

    </a>
    <nav class="navbar navbar-static-top"
         role="navigation">
        <!-- Sidebar toggle button-->
        <div>
            <a href="#"
               class="navbar-btn sidebar-toggle"
               data-toggle="offcanvas"
               role="button">
                <div class="responsive_nav"></div>
            </a>
        </div>

        <div class="navbar-right">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if(Auth::user()->avatar !='')
                            {{--<img src="{!! asset('assets/images/uploads/user/').'/'.Auth::user()->avatar !!}" alt="img"--}}
                                 {{--class="img-circle img-responsive pull-left" height="35px" width="35px"/>--}}

                            <img src="{!! auth()->user()->avatar !!}" alt="img"
                                 class="img-circle img-responsive pull-left" height="35px" width="35px"/>
                        @else
                            <img src="{!! asset('assets/images/default/man-icon.jpg') !!} " width="35"
                                 class="img-circle img-responsive pull-left" height="35" alt="riot">
                        @endif
                        <div class="riot">
                            <div>
                                {{ Auth::user()->name }}
                                <span>
                                        <i class="caret"></i>
                                    </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            @if(Auth::user()->avatar!='')
                                {{--<img src="{{URL::asset('assets/images/uploads/users')}}/{{Auth::user()->avatar}}"--}}
                                     {{--alt="img"--}}
                                     {{--class="img-circle img-bor"/>--}}
                                <img src="{{auth()->user()->avatar}}"
                                     alt="img"
                                     class="img-circle img-bor"/>
                            @else
                                <img src="{!! asset('assets/images/default/man-icon.jpg') !!}"
                                     class="img-responsive img-circle" alt="User Image">
                            @endif
                            <p class="topprofiletext">{{ Auth::user()->name }} </p>
                        </li>
                        <!-- Menu Body -->
                        <li>
                            <a href="{{ URL::route('userProfile',Auth::user()->id) }}">
                                <i class="livicon" data-name="user" data-s="18"></i>
                                我的帳號
                            </a>
                        </li>
                        <li role="presentation"></li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ URL::to('admin/lockscreen') }}">
                                    <i class="livicon" data-name="lock" data-s="18"></i>
                                    鎖定螢幕
                                </a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ URL::to('logout') }}">
                                    <i class="livicon" data-name="sign-out" data-s="18"></i>
                                    登出
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>