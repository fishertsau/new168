@extends('frontend.layouts.default')

{{-- Page title --}}
@section('title')
    展示
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/devices/edit.css') }}">
@stop

@section('content')
    <br>
    @include('frontend.devices.edit._topHeading')
    <br>

    <div class="hidden" id="pageInfo">
        <input type="text" class="hidden" id="userObject" value="{{$user}}">
        <input type="text" class="hidden" id="itemInfo" value="{{$device}}">
    </div>

    <div class="container" id="app">
        <div class="row ">
            <form :action="'/devices/'+item.id"
                  class="hidden" method="post"
                  id="deleteForm">
                {{csrf_field()}}
                {{method_field('delete')}}
            </form>

            <div class="col-md-9">
                <form :action="'/devices/'+item.id" method="post" id="inputForm"
                      @submit.prevent="handleMajorFormSubmission(this)">
                    {{csrf_field()}}
                    {{method_field('patch')}}

                    <div class="content-block">
                        <p class="text-danger">提醒您: 您輸入的資訊越清楚，成交速度越快。</p>
                    </div>
                    <br>
                    {{--基本資訊--}}
                    @include('frontend.devices.edit.partials._editControlPanel')
                    <br>
                    @include('frontend.devices.edit._form')
                    <br>
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

    <div class="modal fade" id="dimensionNoteShowModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         style="z-index: 5000">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">尺寸說明</h4>
                </div>

                <div class="modal-body">
                    <div>
                        <img src="\images\devices\deviceSize.jpg" alt="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('/assets/frontend/devices/edit.js') }}"></script>
@stop