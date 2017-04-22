@extends('frontend.layouts.default')

{{-- Page title --}}
@section('title')
    建立廠商
    @parent
@stop

{{-- page level styles --}}
{{--@section('header_styles')--}}
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/vendors/index.css') }}">--}}
{{--@stop--}}

@section('content')
    <br>
    @include('frontend.vendors.index._topHeading')

    <br>

    <div class="container" id="app">
        <div class="row ">
            <div class="col-md-9">
                <div class="content-block">
                    <h4 class="text-danger">尋找廠商</h4>
                </div>
            </div>

            <div class="col-md-3">
                <div class="content-block">
                    <h4 class="text-warning">家具交流平台</h4>
                    <h4 class="text-warning">頂店訊息</h4>
                    <h4 class="text-warning">二手設備商</h4>
                    <h4 class="text-warning">搬家公司</h4>
                    <hr class="line-dark">
                    <h4 class="text-danger">(To-do)公司訊息版型設計</h4>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/frontend/vendors/index.js') }}"></script>
@stop