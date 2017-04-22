@extends('frontend.layouts.default')

{{-- Page title --}}
@section('title')
    建立廠商
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/vendors/create.css') }}">
@stop

@section('content')
    <br>
    @include('frontend.vendors.create._topHeading')

    <br>

    <div class="container" id="app">
        <div class="row ">
            <div class="col-md-9">
                <div class="content-block">
                    <h4 class="text-danger">廠商基本資料</h4>
                    <hr class="line-dark--lighter">
                    <form action="{{route('vendors.store')}}" method="post" id="inputForm">
                        {{csrf_field()}}
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">
                                    <span class="text-danger">*</span> 廠商型態
                                </label>

                                <div class="col-sm-10">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">
                                    <span class="text-danger">*</span> 類別
                                </label>

                                <div class="col-sm-10">
                                    {{--<input type="text"--}}
                                    {{--class="hidden"--}}
                                    {{--name="cat_id"--}}
                                    {{--required--}}
                                    {{-->--}}

                                    {{--<p class="text-danger" style="margin-top: 10px"--}}
                                    {{--@click.prevent="viewControl.see_cat_menu=true"--}}
                                    {{--id="cat_id_selector">--}}
                                    {{--@{{ form_input.cat[0].title }}--}}
                                    {{--<span class="text-primary">--}}
                                    {{--<button class="btn btn-warning btn-xs"--}}
                                    {{--@click.prevent="viewControl.see_cat_menu=true">選擇--}}
                                    {{--</button>--}}
                                    {{--</span>--}}
                                    {{--</p>--}}
                                    {{--<div style="position:relative">--}}
                                    {{--<div style="position: absolute;top:0.2em;left:0;z-index: 100;background: lightyellow"--}}
                                    {{--v-show="viewControl.see_cat_menu" v-cloak>--}}
                                    {{--<div>--}}
                                    {{--<button class="pull-right btn btn-danger btn-sm"--}}
                                    {{--@click.prevent="viewControl.see_cat_menu=false">--}}
                                    {{--關閉--}}
                                    {{--</button>--}}
                                    {{--</div>--}}
                                    {{--<br>--}}
                                    {{--<device-category--}}
                                    {{--:source="form_input.cat"--}}
                                    {{--@update-selected="updateCat">--}}
                                    {{--</device-category>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">
                                    <span class="text-danger">*</span> 廠商名稱
                                </label>

                                <div class="col-sm-5">
                                    <input type="text"
                                           class="form-control"
                                           id="title"
                                           name="title"
                                           placeholder="廠商名稱,如:大臺灣設備行"
                                           required>
                                </div>
                            </div>

                            <br>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button class="btn btn-danger full-width"
                                            type="submit">
                                        開始輸入詳細資料<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
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
    <script type="text/javascript" src="{{ asset('assets/frontend/vendors/create.js') }}"></script>
@stop