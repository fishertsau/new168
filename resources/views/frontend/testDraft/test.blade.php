@extends('frontend.layouts.default')

{{-- Page title --}}
@section('title')
    展示
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/test/test.css') }}">
@stop

@section('content')
    {{--@include('frontend.demo._banner_short')--}}
    <br>
    {{--@include('frontend.demo.deviceSearch._deviceSearch2')--}}
    <br>

    <iframe src="http://www.w3schools.com"></iframe>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <iframe src="https://laravel.com/docs/5.3/validation#conditionally-adding-rules"
                        class="full-width"
                        style="border:none">
                </iframe>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row" id="app">
            <input type="text" class="hidden"
                   value="{{auth()->user()}}"
                   id="userInfo">

            <h1>Hello App!</h1>
            <p>
            <!-- use router-link component for navigation. -->
            <!-- specify the link by passing the `to` prop. -->
            <!-- <router-link> will be rendered as an `<a>` tag by default -->
            <router-link to="/foo">Go to Foo</router-link>
            <router-link to="/bar">Go to Bar</router-link>
            <router-link to="/address">Go to Address</router-link>
            <a href="/demo2">Demo2</a>
            </p>
            <!-- route outlet -->
            <!-- component matched by the route will render here -->
            <router-view></router-view>
        </div>
    </div>
@endsection

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/frontend/test/test.js') }}"></script>
@stop