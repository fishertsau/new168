@extends('frontend.layouts.default')

{{-- Page title --}}
@section('title')
    首頁
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/home/home.css') }}">
@stop


@section('content')
    <div id="app">
        <input type="text" class="hidden" id="latestDevices"
               value="{{$latestDevices}}">
        <br>
        @include('frontend.home._banner')
        {{--<br>--}}
        @include('frontend.home._itemSearch')
        <br>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include('frontend.home._carouselAd')
                </div>
            </div>
        </div>
        {{--<br>--}}

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-block">
                        <marquee scrollamount="4" onmouseover="this.stop();" onmouseout="this.start();">
                            <span class="text-danger">
                                <a href="\devices\2"><img src="\images\temp\168.png" alt="" style="height:20px">全新改款，玩家最愛</a>
                            </span>&nbsp;
                            <span class="text-danger">一生守護，全心全意</span>&nbsp;&nbsp;
                            <span class="text-warning">
                                <img src="\images\temp\devices\d1.jpg" alt="" style="height:20px">
                                最新設備，老闆最愛。</span>
                        </marquee>

                    </div>
                </div>
            </div>
        </div>
        <div style="text-align: center;margin-top: 5px;">
            <span class="text-danger">廣告連結-1</span>&nbsp;|&nbsp;
            <span class="text-danger">廣告連結-2</span>&nbsp;|&nbsp;
            <span class="text-danger">廣告連結-1</span>&nbsp;|&nbsp;
            <span class="text-danger">廣告連結-2</span>&nbsp;
        </div>
        <br>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-block">
                        <h3 class="text-center section-title">- 最新上架 -</h3>
                        <hr class="line-dark--lighter">
                        <div class="row">
                            <div class="col-md-3 col-xs-6" v-for="device in latestDevices">
                                <device-block :device="device"></device-block>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include('frontend.home._carouselAdTemp')
                </div>
            </div>
        </div>
        <br>
        {{--testing use--}}
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="content-block">
                        <h3 class="text-center section-title">- 最新廠商 -</h3>

                        <div class="mainBlock-in-development">
                            <br/>
                            <h4 class="text-center note-in-development">新上架廠商</h4>
                            <br/>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="content-block">
                        <h3 class="text-center section-title">- 出清專區 -</h3>

                        <div class="mainBlock-in-development">
                            <br/>
                            <h4 class="text-center note-in-development">出清專區</h4>
                            <br/>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <br>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-block">
                        <h3 class="text-center section-title">- 台灣餐飲最前線 -</h3>

                        <div class="mainBlock-in-development">
                            <br/>
                            <a href="/subpage">
                                <h4 class="text-center note-in-development">台灣餐飲最前線</h4>
                            </a>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-block">
                        <h3 class="text-center section-title">- 熱門搜尋廠商 -</h3>

                        <div class="mainBlock-in-development">
                            <br/>
                            <h4 class="text-center note-in-development">熱門搜尋廠商</h4>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-block">
                        <h3 class="text-center section-title">- 我要開店 -</h3>
                        <hr class="line-dark--lighter">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="\images\temp\toLet.jpg" class="full-width" style="min-height:196px">
                            </div>
                            <div class="col-md-4">
                                <img src="\images\temp\wantedShop.jpg" class="full-width" style="min-height:196px">
                            </div>
                            <div class="col-md-4">
                                <img src="\images\temp\franchise.jpg" class="full-width" style="min-height:196px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-block">
                        <div class="row">
                            <div class="col-md-6">
                                <img class="full-width" src="\images\temp\deal.jpg" alt="">
                            </div>
                            <br class="visible-xs">

                            <div class="col-md-6">
                                <img class="full-width" src="\images\temp\expert.jpg" alt="">
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <br/>
    </div>
@endsection

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/frontend/home/home.js') }}"></script>
    <script>$('.carousel').carousel({interval: 3000});</script>
@stop