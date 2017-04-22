@extends('auth.app.authApp')

@section('title')
    重設密碼 @parent
@stop


@section('content')
    <h4 class="text-center">忘記密碼了?</h4>
    <br/>
    @if (session('status'))
        <div class="alert alert-success text-center">
            {{ session('status') }}
        </div>
    @endif

    @if (session('status_danger'))
        <div class="alert alert-danger text-center">
            {{ session('status_danger') }}
        </div>
    @endif


    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
        {!! csrf_field() !!}

        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="inputEmail3" class="col-sm-3 control-label">電子信箱</label>

            <div class="col-sm-9">
                <input type="email" name="email" placeholder="輸入在金豪買註冊的電子信箱"
                       value="{{ old('email') }}" class="form-control">
                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <button class="btn btn-primary full-width" style="height: 3em;" type="submit"
                id="submitForm">
            <i class="fa fa-btn fa-envelope"></i>&nbsp;重設密碼
        </button>
    </form>

    <div>
        <p>用 Facebook 註冊的帳號？ Facebook 快速登入</p>
    </div>
@stop
