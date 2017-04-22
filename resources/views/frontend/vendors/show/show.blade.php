@extends('frontend.layouts.default')

{{-- Page title --}}
@section('title')
    廠商訊息
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/vendors/show.css') }}">
@stop

@section('content')
    <div id="app">
        <br>
        @include('frontend.vendors.show._topHeading')
        <br>

        <div class="hidden" id="pageInfo">
            {{--<input type="text" class="hidden"--}}
                   {{--id="userInfo"--}}
                   {{--value="{{$user}}">--}}
            {{--<input type="text" class="hidden"--}}
                   {{--id="itemInfo"--}}
                   {{--value="{{$org}}">--}}
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    {{--Owner Control panel--}}
                    {{--<div class="userEntity zero-margin content-block"--}}
                         {{--v-if="item.isSeller"--}}
                         {{--v-cloak>--}}
                        {{--<div class="form-horizontal zero-margin">--}}
                            {{--@include('frontend.vendors.edit._controlPanel')--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--item detail--}}
                    <div class="content-block">
                        @include('frontend.vendors.show._itemDetail')
                    </div>

                    <br>
                    <div class="content-block">
                        <h3 class="zero-margin text-danger">上架商品</h3>
                        <hr class="line-dark--light">
                        <span class="pull-right text-danger">查看更多 &nbsp;&gt;</span>
                        <br>
                    </div>
                    <br>
                    <div class="content-block">
                        <div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#productIntro" aria-controls="productIntro" role="tab" data-toggle="tab">產品介紹</a></li>
                                <li role="presentation">
                                    <a href="#activity" aria-controls="activity" role="tab" data-toggle="tab">活動訊息</a>
                                </li>
                                <li role="presentation">
                                    <a href="#lessons" aria-controls="lessons" role="tab" data-toggle="tab">課程訊息</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="productIntro">home...</div>
                                <div role="tabpanel" class="tab-pane" id="activity">活動訊息</div>
                                <div role="tabpanel" class="tab-pane" id="lessons">課程訊息</div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="content-block">
                        <h3 class="zero-margin">服務案例</h3>
                        <hr class="line-dark--light">
                        <span class="pull-right text-danger">查看更多 &nbsp;&gt;</span>
                        <br>
                    </div>
                    <br>
                </div>
                <div class="col-md-3">
                    @include('frontend.vendors.show._rightSide')
                    <br>
                </div>

            </div>
        </div>

    </div>
@endsection

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/frontend/vendors/show.js') }}"></script>
@stop