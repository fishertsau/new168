@extends('frontend.layouts.default')

{{-- Page title --}}
@section('title')
    帳號
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/account/account.css') }}">
@stop

@section('content')
    <div id="app">
        <br>
        @include('frontend.users._topHeading')
        <br>

        <div class="hidden" id="pageInfo">
            <input type="text" class="hidden"
                   id="userInfo"
                   value="{{auth()->user()}}">
            <input type="text" class="hidden"
                   id="userDevices"
                   value="{{$userDevices}}">
            <input type="text" class="hidden"
                   id="likeDevices"
                   value="{{$likeDevices}}">
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-block">
                        @if (session('status_danger'))
                            <div class="alert alert-danger text-center">
                                {{ session('status_danger') }}
                            </div>
                        @endif
                        <h3 class="text-danger">建立廠商</h3>
                        <h3 class="text-danger">郵件未認證提醒</h3>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-9">
                    <div class="content-block">
                        <p>
                            <router-link to="/profile">個人資訊</router-link>
                            <router-link to="/likes">我的收藏</router-link>
                            <router-link to="/posts">我的刊登</router-link>
                            <router-link to="/*">其他</router-link>
                        </p>
                        <hr class="line-dark">
                        <router-view></router-view>
                    </div>
                </div>
                <br class="visible-xs">

                <div class="col-md-3">
                    <div class="content-block">右側消息</div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/frontend/account/account.js') }}"></script>
@stop