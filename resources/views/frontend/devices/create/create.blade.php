@extends('frontend.layouts.default')

{{-- Page title --}}
@section('title')
    展示
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/devices/create.css') }}">
@stop

@section('content')
    <br>
    @include('frontend.devices.edit._topHeading')

    <br>

    <div class="container" id="app">
        <div class="row ">
            <div class="col-md-9">
                <div class="content-block">
                    <h4 class="text-danger">新增設備刊登</h4>
                    <hr class="line-dark">
                    <form action="/devices" method="post" id="inputForm" @submit.prevent="storeItem()">
                        {{csrf_field()}}
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">
                                    <span class="text-danger">*</span> 類別
                                </label>

                                <div class="col-sm-10">
                                    <input type="text"
                                           class="hidden"
                                           name="cat_id"
                                           v-model="form_input.cat[0].id"
                                           required
                                            >

                                    <p class="text-danger" style="margin-top: 10px"
                                       @click.prevent="viewControl.see_cat_menu=true"
                                       id="cat_id_selector">
                                        @{{ form_input.cat[0].title }}
                                        <span class="text-primary">
                                        <button class="btn btn-warning btn-xs"
                                                @click.prevent="viewControl.see_cat_menu=true">選擇
                                        </button>
                                    </span>
                                    </p>
                                    <div style="position:relative">
                                        <div style="position: absolute;top:0.2em;left:0;z-index: 100;background: lightyellow"
                                             v-show="viewControl.see_cat_menu" v-cloak>
                                            <div>
                                                <button class="pull-right btn btn-danger btn-sm"
                                                        @click.prevent="viewControl.see_cat_menu=false">
                                                    關閉
                                                </button>
                                            </div>
                                            <br>
                                            <device-category
                                                    :source="form_input.cat"
                                            @update-selected="updateCat">
                                            </device-category>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">
                                    <span class="text-danger">*</span> 名稱
                                </label>

                                <div class="col-sm-5">
                                    <input type="text"
                                           class="form-control"
                                           id="title"
                                           name="title"
                                           v-model="form_input.title"
                                           placeholder="設備名稱,如:急速冷凍櫃"
                                           required>
                                </div>
                            </div>

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

                @if(count($userDevices)>0)
                    @include('frontend.devices.create._devicePosted')
                @endif
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
    <script type="text/javascript" src="{{ asset('assets/frontend/devices/create.js') }}"></script>
@stop