@extends('auth.app.authApp')

@section('title')
    重設密碼 @parent
@stop


@section('content')
    <h4 class="text-center">寄送郵件認證信</h4>
    <br/>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form class="form-horizontal" role="form" method="POST"
          action="{{ route('sendEmailConfirmForm') }}">
        {!! csrf_field() !!}

        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="inputEmail3" class="col-sm-3 control-label">電子信箱</label>

            <div class="col-sm-9">
                <input type="email" name="email" placeholder="請輸入您的電子信箱"
                       value="{{ old('email') }}" class="form-control" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <button class="btn btn-primary full-width" style="height: 3em;" type="submit"><i
                    class="fa fa-btn fa-envelope"
                    id="submitForm"></i>&nbsp;寄送郵件認證信
        </button>
    </form>

@stop
