<div class="form-horizontal">

    {{--Title--}}
    <div class="form-group">
        <label for="name"
               class="col-sm-2 control-label">@lang('occasion/form.title')</label>

        <div class="col-sm-5">
            {!! Form::text('title', null , ['class'=>'form-control','placeholder'=>'名稱','id'=>'title','required'=>true]) !!}
        </div>
    </div>


    <!--手動停用-->
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">手動停止</label>

        <div class="col-sm-8">
            {!! Form::radio('active', true,true) !!}正常
            {!! Form::radio('active', false) !!}停止
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            <a class="btn btn-danger" href="/admin/occasions">
                @lang('button.cancel')
            </a>
            <button type="submit" class="btn btn-success">
                @lang('button.save')
            </button>
        </div>
    </div>
</div>
