@extends('admin.layouts.default')

{{-- Page title --}}
@section('title')
@parent-@lang('permission/title.management')
@stop


{{-- Content --}}
@section('content')
@include('admin.auth.permission._contentHeader',
    ['section_title'=> '新增權限'])

        <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="wrench" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white"></i>
                        @lang('permission/title.edit')
                    </h4>
                        <span class="pull-right">
                            <a href="{{ URL::previous()}}" style="color: white">
                                回上一頁 &nbsp; <i class="fa fa-reply"></i>
                            </a>
                        </span>
                </div>
                <div class="panel-body">
                    @include('admin.partials.errors')

                    {!! Form::model($permission = new \App\Models\Authorization\Permission, ['method'=>'post','action'=>'Auth\PermissionController@store']) !!}
                    @include('admin.auth.permission._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- row-->
</section>
@stop