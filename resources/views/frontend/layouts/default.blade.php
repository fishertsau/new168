<!DOCTYPE html>
<html>
<head>
    @include('frontend.layouts._globalHeadSetting')
    <title>
        @section('title')
            | 金豪買
        @show
    </title>
    <!--global css starts-->
    @include('frontend.layouts._globalCSS')
            <!--end of global css-->

    <!--page level css-->
    @yield('header_styles')
            <!--end of page level css-->
</head>

<body>

{{--<div id="fb-root"></div>--}}
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.8&appId=117383188703042";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<!-- Header Start -->
@include('frontend.layouts._mainNavbar')


        <!-- //Header End -->
@yield('content')

        <!-- Footer Section Start -->
@include('frontend.layouts._footer')
@include('frontend.layouts._copyright')

        <!-- //Footer Section End -->
@include('frontend.layouts._backToTop')

        <!-- mobileNavbar Section Start -->
@include('frontend.layouts._mobileNavbar_fixedBottom')
        <!-- //mobileNavbar Section End -->

@include('flash::message')
<!--global js starts-->
@include('frontend.layouts._globalJS')
        <!--global js end-->

<!-- begin page level js -->
@yield('footer_scripts')
        <!-- end page level js -->


        <!-- This is only necessary if you do Flash::overlay('...') -->
<script>
    $('#flash-overlay-modal').modal();
</script>
</body>

</html>
