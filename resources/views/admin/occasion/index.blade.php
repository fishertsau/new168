@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    使用場合
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/admin/occasion/index.css') }}" rel="stylesheet">
    @stop

    {{-- Page content --}}
    @section('content')
    @include('admin.occasion._contentHeader',
        ['section_title'=> '清單'])

            <!-- Main content -->
    <section class="content paddingleft_right15">
        <div class="row" id="app">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left">
                        <i class="livicon" data-name="list" data-size="16"
                           data-loop="true" data-c="#fff" data-hc="white"></i>
                        @lang('occasion/title.list')
                    </h4>

                    <div class="pull-right">
                        <a href="/admin/occasions/create" class="btn btn-danger">
                            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;新增
                        </a>
                        @include('admin.occasion._occasionSearch')
                    </div>
                </div>
                <div class="panel-body">
                    <div id="content" v-show="hasContent" v-cloak>

                        <span class="pull-right">
                            <div class="form-inline">
                                <div class="form-group">
                                    <label for="exampleInputName2"> 名稱</label>
                                    <input type="text" class="form-control"
                                           placeholder="使用場合名稱" v-model="filterName">
                                </div>
                            </div>
                        </span>
                        總筆數: @{{ listLength }} &nbsp;<span class="text-info">(最多:255筆)</span>
                        <br>
                        <br>
                        <table class="table table-bordered" id="table">
                            <thead>
                            <tr>
                                <th class="text-center" style="width:20%">改順序</th>
                                <th class="text-center" style="width:20%" @click="setSortName('rank')">順序</th>
                                <th class="text-center" style="width:15%" @click="setSortName('active')">狀態</th>
                                <th class="text-center" style="width:35%" @click="setSortName('title')">名稱
                                </th>
                                <th class="text-center" style="width:10%">編輯</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in occasion_list | orderBy sortName | filterBy filterName">
                                <td class="text-center">
                                    <i class="fa fa-angle-double-up reRank" aria-hidden="true"
                                    @click="reRank('top',item)"></i>
                                    <i class="fa fa-angle-up reRank" aria-hidden="true"
                                    @click="reRank('up',item)"></i>
                                    <i class="fa fa-angle-down reRank" aria-hidden="true"
                                    @click="reRank('down',item)"></i>
                                    <i class="fa fa-angle-double-down reRank" aria-hidden="true"
                                    @click="reRank('bottom',item)"></i>
                                </td>
                                <td class="text-center">@{{ item.rank }}</td>
                                <td class="text-center"
                                    :class="item.active=='停用' ? 'text-danger':'' ">@{{ item.active }}</td>
                                <td>@{{ item.title }}</td>
                                <td class="text-center">
                                    <a href="/admin/occasions/@{{ item.id }}/edit">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                        <div id="pagination"></div>
                    </div>

                    <div v-show="!hasContent" v-cloak>
                        @include('admin.partials._noResult')
                    </div>
                </div>
            </div>
        </div>
        <!-- row-->
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{  asset('assets/admin/occasion/index.js') }}"></script>
@stop