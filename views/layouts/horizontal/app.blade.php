<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="description" content="Nơi hội tụ của những tài năng" />
    <meta name="author" content="{{config('app.name')}} Minh Cương"/>
    <meta name="keywords" content="english, coding, tutorial, laravel, crazy, test, lesson, section, php, kiểm tra, mất gốc,
    chắc chắn, vượt giới hạn"/>

    <meta name="description" content="Hãy học tập để vươn tầm, kết nối với hàng tỉ người trên thế giới.
                Vượt ra khỏi giới hạn ao làng, vốn kiến thức hạn hẹp của tiếng mẹ đẻ,
                tiếp xúc với thông tin đa chiều của đa quốc gia, lĩnh hội kiến thức toàn cầu" />
    <meta name="og:title" content="{{config('app.name')}} English & Developer Laravel" />
    <meta name="og:description" content="Hãy học tập để vươn tầm, kết nối với hàng tỉ người trên thế giới." />
    <meta name="og:image" content="https://scontent.fhan2-2.fna.fbcdn.net/v/t1.0-9/20294292_661133644092386_3154583665239359062_n.jpg?_nc_cat=111&oh=86e517a93657ad251810baf5d602c079&oe=5C4D84C1" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="Content-Language" content="vi" />
    <meta http-equiv="X-UA-Compatible" content="requiresActiveX=true"/>
    <meta name="ROBOTS" content="index, follow"/>
    <meta name="copyright" content="{{url('')}}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('frontd')}}/images/favicon.ico">
    <title>{{config('app.name')}} | @yield('title')</title>
    <link rel="stylesheet" href="{{$asset_url}}/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/neon-core.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/neon-theme.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/neon-forms.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/custom.css">
    {{--<link rel="stylesheet" href="{{$asset_url}}/assets/css/font-icons/font-awesome/css/font-awesome.min.css">--}}
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    @stack('head')
    @yield('css')
</head>
<body class="page-body">
<div class="page-container horizontal-menu">
    @include('layouts.horizontal.header')
    <div class="main-content">
        <div class="container">
            @include('layouts.alerts.index')
            @yield('content')
        </div>
    </div>
</div>
<script src="{{$asset_url}}/assets/js/jquery-1.11.3.min.js"></script>
<script src="{{$asset_url}}/assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{$asset_url}}/assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
<script src="{{$asset_url}}/assets/js/jquery.sparkline.min.js"></script>
<script src="{{$asset_url}}/assets/js/rickshaw/vendor/d3.v3.js"></script>
<script src="{{$asset_url}}/assets/js/rickshaw/rickshaw.min.js"></script>
<script src="{{$asset_url}}/assets/js/raphael-min.js"></script>
<script src="{{$asset_url}}/assets/js/morris.min.js"></script>
<script src="{{$asset_url}}/assets/js/toastr.js"></script>


<!-- Bottom scripts (common) -->
<script src="{{$asset_url}}/assets/js/gsap/TweenMax.min.js"></script>
<script src="{{$asset_url}}/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="{{$asset_url}}/assets/js/bootstrap.js"></script>
<script src="{{$asset_url}}/assets/js/joinable.js"></script>
<script src="{{$asset_url}}/assets/js/resizeable.js"></script>
<script src="{{$asset_url}}/assets/js/neon-api.js"></script>
<!-- Imported scripts on this page -->
<script src="{{$asset_url}}/assets/js/neon-chat.js"></script>
<!-- JavaScripts initializations and stuff -->
<script src="{{$asset_url}}/assets/js/neon-custom.js"></script>
<!-- Demo Settings -->
<script src="{{$asset_url}}/build/english.js"></script>

@yield('js')
@stack('js')
<script src="{{$asset_url}}/assets/js/neon-demo.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
{{--<script type="module" src="{{asset('build/es.js')}}"></script>--}}
</body>
</html>
