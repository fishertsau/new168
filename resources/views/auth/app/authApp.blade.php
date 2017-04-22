<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('/images/companyInfo/iconLogo.png') }}">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <title>
        @section('title')
            | 金豪買
        @show
    </title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/app.css') }}">
    <style>
        body {
            background: #eeede8;
        }

        label, h4 {
            color: #505662;
        }

        .form-box {
            max-width: 540px;
            padding: 30px;
            margin: 0 auto;
            background: white;
        }
    </style>

</head>

<body>
<div class="container-fluid">
    <div class="row" align="center">
        <header style=" margin:20px auto 20px;">
            <a href="/" class="noDecoration">
                <div class="img">
                    <img alt="" class="img-responsive" src="{{asset('images/companyInfo/brandLogo.png')}}"
                         width="25%">
                </div>
                {{--<p class="text-nature text-center" style="margin-top: 10px">瓦斯節能專家 設備齊全 好用好賣</p>--}}
            </a>
        </header>
    </div>

    <div class="row form-box">
        @include('auth.app.flash')
        {{--@include('flash::message')--}}

        @yield('content')
    </div>

    <br/>

    <div class="form-box">
        @include('auth.app._moreActions')
    </div>

</div>
<!-- /container -->

@include('auth.app._companyInfo')

<br/>
<br/>
<br/>
<br/>

@include('flash::message')


</body>
<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!-- This is only necessary if you do Flash::overlay('...') -->
<script>
    $('#flash-overlay-modal').modal();
</script>

{{--<script src="https://code.jquery.com/jquery-3.1.0.js"></script>--}}
{{--<script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>--}}
{{--<script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>--}}
<!--livicons-->
{{--<script src="{{ asset('assets/js/raphael-min.js') }}"></script>--}}
{{--<script src="{{ asset('assets/js/livicons-1.4.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('assets/js/frontend/josh_frontend.js') }}"></script>--}}
{{--<script src="{{asset('assets/js/app_old20160727.js')}}"></script>--}}
</html>

