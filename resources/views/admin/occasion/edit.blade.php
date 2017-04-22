@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
@parent-@lang('occasion/title.management')
@stop

{{-- page level styles --}}
@section('header_styles')
{{--    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{ asset('assets/css/admin/pages/news.css') }}" rel="stylesheet" type="text/css">--}}
        <!--end of page level css-->
@stop

{{-- Content --}}
@section('content')
@include('admin.occasion._contentHeader',
    ['section_title'=> '修改內容'])

        <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="wrench" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white"></i>
                        @lang('occasion/title.edit')
                    </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                        </span>
                </div>
                <div class="panel-body">
                    @include('admin.partials.errors')

                    {!! Form::model($occasion,
                    ['method' => 'patch',
                    'action' => ['Admin\Device\OccasionsController@update', $occasion->id]
                    ]) !!}

                    @include('admin.occasion._form')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- row-->
</section>
@stop


{{-- page level scripts --}}
@section('footer_scripts')

    {{--my javascript--}}
    {{--<script type="text/javascript" src="{{ asset('assets/js/admin/pages/occasion.js') }}"></script>--}}

@stop