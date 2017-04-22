@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')

    @parent - 管理系統
@stop

{{-- page level styles --}}
@section('header_styles')
    {{--<link rel="stylesheet" media="all"--}}
          {{--href="{{ asset('assets/vendors/bower-jvectormap/css/jquery-jvectormap-1.2.2.css') }}"/>--}}
    {{--<link rel="stylesheet" href="{{ asset('assets/css/pages/only_dashboard.css') }}"/>--}}
    <meta name="_token" content="{{ csrf_token() }}">
@stop

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <h1>{{$company_name}}管理系統</h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="#">
                    <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                    首頁
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12 ">
                <p>{{Auth::user()->name}} 您好,歡迎來到{{$company_name}}管理系統.</p>

                <hr>

                <h4>最新公告</h4>

                <p>以下事項敬請配合.</p>
                <hr/>
                <p>您有以下待處理工作:</p>
                <ul style="list-style: circle">
                    <li>訂單審核</li>

                </ul>

                <hr/>
                <h4>系統使用紀錄</h4>
                <table class="table table-bordered">
                    <tr>
                        <td>登入時間(now:{{Carbon\Carbon::now()}})</td>
                        <td>{{Auth::user()->login_at}}</td>
                    </tr>

                    <tr>
                        <td>上次登入時間</td>
                        <td>{{session('user_last_login_at')}}</td>
                    </tr>
                    <tr>
                        <td>登入次數</td>
                        <td>{{Auth::user()->login_count}}</td>
                    </tr>

                    <tr>
                        <td>登入地點</td>
                        <td>{{Auth::user()->login_ip}}</td>
                    </tr>
                </table>

            </div>
        </div>
        <!--/row-->
    </section>

    @stop

    {{-- page level scripts --}}
    @section('footer_scripts')
            <!--  todolist-->
    {{--    <script src="{{ asset('assets/js/pages/todolist.js') }}"></script>--}}
    {{--<script src="{{ asset('assets/js/pages/dashboard.js') }}" type="text/javascript"></script>--}}
@stop
