@extends('frontend.layouts.default')

{{-- Page title --}}
@section('title')
    首頁
    @parent
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mainBlock-in-development">
                    <br/>
                    <h4 class="text-center note-in-development">黃金版位</h4>
                    <h4 class="text-center note-in-development">(重要廣告.活動.消息)</h4>
                    <br/>
                </div>
            </div>
        </div>
    </div>


    <br/>
    @include('frontend.home._itemSearch')
    <br/>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mainBlock-in-development">
                    <h4 class="text-center note-in-development">文字跑馬燈</h4>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mainBlock-in-development">
                    <br/>
                    <h4 class="text-center note-in-development">平台推薦內容(商品、開店、食譜、討論…….瀏覽人次最多的優先)</h4>
                    <h4 class="text-center note-in-development">有花錢要標明贊助,或以瀏覽人次最多者為主</h4>
                    <br/>
                </div>
            </div>
        </div>
    </div>

    <br/>

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="content-block">
                    <br/><br/>
                    <h4 class="text-center note-in-development">近期活動</h4>
                    <h4 class="text-center note-in-development">過往活動</h4>
                    <h4 class="text-center note-in-development">有花錢要標明贊助,擺前面</h4>
                    <br/><br/>
                </div>
                <br>

                <div class="content-block">
                    <br/><br/>
                    <h4 class="text-center note-in-development">特惠商品&出清專區</h4>
                    <br/><br/>
                </div>
            </div>

            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-block">
                            <br/><br/>
                            <h4 class="text-center note-in-development">廠商廣告</h4>
                            <h4 class="text-center note-in-development">To-do(EDM版型設計)</h4>
                            <h4 class="text-center note-in-development">廠商自填</h4>
                            <ul>
                                <li>商品(設備.頂店....)</li>
                                <li>活動(周年慶,促銷特惠,)</li>
                                <li>品牌推廣(廠商)</li>
                            </ul>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br/>

    <div class="container">
        <div class="row" style="background-color: lightgray;padding:5px 0px">
            <div class="col-md-12">
                <div class="content-block">
                    <br/><br/>
                    <h4 class="text-center note-in-development">熱門關鍵字</h4>
                    <br/><br/>
                </div>
            </div>
        </div>
    </div>

    <br/>
@endsection