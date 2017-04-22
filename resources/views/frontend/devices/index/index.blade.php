@extends('frontend.layouts.default')

{{-- Page title --}}
@section('title')
    展示
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/devices/index.css') }}">
@stop

@section('content')
    <div id="app">
        <br>
        @include('frontend.devices.index.deviceSearch._deviceSearch')
        <br>

        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="content-block">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                &nbsp;&nbsp;<span>排序</span>&nbsp;
                                <span style="border: 1px solid grey;border-radius: 20%;padding:0 2px 0 3px"
                                @click="toggle_order_sequence">
                                <i class="fa fa-arrow-down text-warning"
                                   aria-hidden="true" v-show="order_desc"></i><i
                                        class="fa fa-arrow-up text-warning" aria-hidden="true"
                                        v-show="!order_desc"></i></span>
                                &nbsp;
                                <btn-selector
                                        :source_selected="$store.state.queryTerm.order_by"
                                        :source="order_by_list"
                                        maxqty="1"
                                @update-selected="updateOrderBy">
                                </btn-selector>
                            </div>
                            <div class="col-md-4 hidden-sm hidden-xs">
                                <span @click="toggle_block_view" class="text-danger pull-right"
                                style="cursor: pointer">
                                檢視方式&nbsp;
                                <i class="fa fa-list" aria-hidden="true"
                                   v-show="view_control.device_block_view"></i>
                                <i class="fa fa-th-large" aria-hidden="true"
                                   v-show="!view_control.device_block_view"></i>
                                </span>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div v-show="device_list.length" v-cloak>
                            <div class="text-center" v-if="true">
                                <pagination :pagination="pagination"
                                            :callback="loadData"
                                            :options="paginationOptions">
                                </pagination>
                            </div>

                            <div style="text-align: right">
                                符合條件: @{{ pagination.total }} &nbsp;
                                頁數:@{{ pagination.current_page }}/@{{ pagination.last_page }}
                            </div>

                            <div class="row" id="deviceList">
                                @include('frontend.devices.index._deviceList')
                            </div>
                            <div class="text-center">
                                <pagination :pagination="pagination" :callback="loadData"
                                            :options="paginationOptions">
                                </pagination>
                            </div>
                        </div>

                        <div v-show="!device_list.length" v-cloak>
                            @include('frontend.partials._noResult')
                            <div class="jumbotron zero-magrin zero-padding">
                                <a href="/" class="btn btn-warning full-width">輸入搜尋條件</a>
                                <h5 class="text-primary">填入您要找的條件,
                                    若有您要的設備時,我們會通知您!</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="content-block">
                        <h3 class="text-danger">主要顯示</h3>
                        <hr>
                        <ul>
                            <li><h4 class="text-warning">顯示最近設備商</h4></li>
                            <li><h4 class="text-warning">搬家公司</h4></li>
                            <li><h4 class="text-warning">二手設備商</h4></li>
                            <li><h4 class="text-warning">目前行情/成交行情</h4></li>
                            <li><h4 class="text-warning">出清專區</h4></li>
                            <li><h4 class="text-warning">選定類別時,出現熱銷商品</h4></li>
                            <li><h4 class="text-warning">選定場合時,出現相關廠商,如義大利麵醬汁</h4></li>
                        </ul>
                        <hr>
                        <h4 class="text-warning">限時促銷123</h4>
                        <hr>
                        <h4 class="text-warning">成交案例List</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/frontend/devices/index.js') }}"></script>
@stop