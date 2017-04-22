@extends('frontend.layouts.default')

{{-- Page title --}}
@section('title')
    展示
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/vendors/edit.css') }}">
@stop

@section('content')
    <br>
    @include('frontend.vendors.edit._topHeading')
    <br>

    {{--<div class="hidden" id="pageInfo">--}}
    {{--<input type="text" class="hidden" id="userObject"--}}
    {{--value="{{$user}}">--}}
    {{--<input type="text" class="hidden" id="itemInfo"--}}
    {{--value="{{$org}}">--}}
    {{--</div>--}}

    <div class="container" id="app">
        <div class="row ">
            {{--<form :action="'/vendors/'+item.id"--}}
            {{--class="hidden" method="post"--}}
            {{--id="deleteForm">--}}
            {{--{{csrf_field()}}--}}
            {{--{{method_field('delete')}}--}}
            {{--</form>--}}

            <div class="col-md-9">
                <form action="{{route('vendors.update',$vendor->id)}}" method="post" id="inputForm">
                    {{csrf_field()}}
                    {{method_field('put')}}

                    {{--基本資訊--}}
                    <br>
                    @include('frontend.vendors.edit._form')
                    <br>

                    @include('frontend.vendors.edit._editControlPanel')
                </form>
            </div>

            <br class="visible-xs">

            <div class="col-md-3">
                <div class="content-block">
                    <h4 class="text-warning">家具交流平台</h4>
                    <h4 class="text-warning">頂店訊息</h4>
                    <h4 class="text-warning">二手設備商</h4>
                    <h4 class="text-warning">搬家公司</h4>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('/assets/frontend/vendors/edit.js') }}"></script>
@stop