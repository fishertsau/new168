@extends('frontend.layouts.default')

{{-- Page title --}}
@section('title')
    展示
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/devices/show.css') }}">
@stop

@section('content')
    <div id="app">
        <br>
        @include('frontend.devices.show._topHeading')

        <br>

        <div class="hidden" id="pageInfo">
            <input type="text" class="hidden"
                   id="userInfo"
                   value="{{$user}}">
            <input type="text" class="hidden"
                   id="itemInfo"
                   value="{{$device}}">
            <input type="text" class="hidden"
                   value="{{$device->discussions()->with('dialogues')->get()}}"
                   id="deviceDiscussion">
        </div>


        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="content-block jumbotron"
                         v-if="!item.isSeller">
                        <p class="text-danger">
                            &#9866;&nbsp;溫馨提醒 &nbsp;&#9866;
                        </p>
                        <ol style="padding-left:20px">
                            <li>購買二手設備要到現場確認<span class="text-danger">運作狀況</span>
                                ,以及<span class="text-danger">尺寸</span>等。
                            </li>
                            <li>要考慮<span class="text-danger">後續維修</span>如何進行。</li>
                            <li>盡快跟賣家聯絡,讓賣家把設備保留給您。</li>
                            <li>要注意<span class="text-danger">交易安全</span>。</li>
                        </ol>
                    </div>

                    {{--Owner Control panel--}}
                    <div class="userEntity zero-margin content-block"
                         v-if="item.isSeller"
                         v-cloak>
                        <div class="form-horizontal">
                            <p class="text-warning">開放狀態: @{{ item.active | activeText }}</p>

                            <div v-show="item.active">
                                <p>到期日: @{{ item.due_until | text }}</p>
                                <small class="text-danger">到期日說明: 自發布日起一個月，若無繼續刊登，則自動下架。</small>
                            </div>
                        </div>
                        <div class="form-horizontal zero-margin">
                            @include('frontend.devices.edit._controlPanel')
                        </div>
                    </div>
                    {{--<br v-if="item.isSeller">--}}
                    {{--item detail--}}
                    <div class="content-block">
                        @include('frontend.devices.show._itemDetail')
                    </div>
                    <br>
                    @include('frontend.devices.show._discussion')
                    <br>
                </div>
                <div class="col-md-3">
                    @include('frontend.devices.show._rightSide')
                </div>
            </div>
        </div>

        <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <form @submit.prevent="sendMailToSeller" action='/' method='post' id="emailModalForm">
                {{csrf_field()}}
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">新訊息</h4>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">
                                    您的名稱:<span class="text-danger">(必填)</span>
                                </label>
                                <input type="text" class="form-control" id="sender-name" name="sender" required
                                        >
                            </div>

                            <div class="form-group">
                                <label for="recipient-name" class="control-label">連絡電話<span
                                            class="text-danger">(必填)</span></label>
                                <input type="tel" class="form-control" name="tel" required id="sender-tel">
                            </div>

                            <div class="form-group">
                                <label for="recipient-name" class="control-label">連絡Email</label>
                                <input type="email" class="form-control" name="email" id="sender-email">
                            </div>

                            <div class="form-group">
                                <label for="message-text" class="control-label">內容:<span class="text-danger">(必填)</span></label>
                            <textarea class="form-control" id="message-text" name="content"
                                      required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-warning">送出</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/frontend/devices/show.js') }}"></script>
@stop