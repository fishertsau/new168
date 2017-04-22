<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/companyInfo/iconLogo.png') }}">

    <title>
        @section('title')
            | 金好買
        @show
    </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/auth/appAuth.css') }}">
    <style>
        body {
            /*background: #eeede8;*/
            font-family: "Hiragino Sans GB","华文细黑","STHeiti","微软雅黑","Microsoft YaHei",SimHei,"Helvetica Neue",Helvetica,Arial,sans-serif !important;;
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
            <a href="/">
                <div class="img">
                    <img alt="" class="img-responsive" src="{{asset('assets/images/companyInfo/brandLogo.png')}}"
                         width="25%">
                </div>
                {{--<p class="text-nature text-center" style="margin-top: 10px">瓦斯節能專家 設備齊全 好用好賣</p>--}}
            </a>
        </header>
    </div>

    <div class="row form-box">
        @yield('content')
    </div>

    <br/>

    <div class="form-box">
        @include('auth._moreActions')
    </div>

</div>
<!-- /container -->

@include('auth._companyInfo')

<br/>
<br/>
<br/>
<br/>

</body>
<script src="https://use.fontawesome.com/299e5396e6.js"></script>
</html>

