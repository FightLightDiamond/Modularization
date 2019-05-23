<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="author" content="{{config('app.name')}} Minh Cương"/>
    <meta name="keywords" content="english, coding, tutorial, laravel, crazy, test, lesson, section, php, kiểm tra, mất gốc,
    chắc chắn, vượt giới hạn"/>

    <meta name="description" content="Hãy học tập để vươn tầm, kết nối với hàng tỉ người trên thế giới.
                Vượt ra khỏi giới hạn ao làng, vốn kiến thức hạn hẹp của tiếng mẹ đẻ,
                tiếp xúc với thông tin đa chiều của đa quốc gia, lĩnh hội kiến thức toàn cầu" />
    <meta name="og:title" content="{{config('app.name')}} English & Developer Laravel" />
    <meta name="og:description" content="Hãy học tập để vươn tầm, kết nối với hàng tỉ người trên thế giới." />
    <meta name="og:image" content="https://scontent.fhan2-2.fna.fbcdn.net/v/t1.0-9/20294292_661133644092386_3154583665239359062_n.jpg?_nc_cat=111&oh=86e517a93657ad251810baf5d602c079&oe=5C4D84C1" />


    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('meta')

    <link rel="icon" href="{{$asset_url}}/assets/images/favicon.ico">
    <title>{{config('app.name')}} - Education @yield('title')</title>
    <meta content="Kết nối tất cả">
    <link rel="stylesheet" href="{{$asset_url}}/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/neon-core.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/neon-theme.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/custom.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/skins/blue.css">
    {{--<link rel="stylesheet" href="{{$asset_url}}/assets/css/font-icons/font-awesome/css/font-awesome.min.css">--}}
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/neon-forms.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/js/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/js/rickshaw/rickshaw.min.css">
    @stack('css')
    @yield('css')
</head>
<body class="page-body skin-black">
<div class="page-container">
    @include('mod::layouts.sidebar')
    <div class="main-content">
        <div class="row">
            @include('mod::layouts.raw-links')
        </div>
        <hr/>
        @include('mod::layouts.alerts.index')
        @yield('content')
    </div>
{{--    @include('admin.vocabularies.search')--}}
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Bottom scripts (common) -->
<script src="{{$asset_url}}/assets/js/gsap/TweenMax.min.js"></script>
<script src="{{$asset_url}}/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="{{$asset_url}}/assets/js/bootstrap.js"></script>
<script src="{{$asset_url}}/assets/js/joinable.js"></script>
<script src="{{$asset_url}}/assets/js/resizeable.js"></script>
<script src="{{$asset_url}}/assets/js/neon-api.js"></script>
<script src="{{$asset_url}}/assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{$asset_url}}/assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
<script src="{{$asset_url}}/assets/js/jquery.sparkline.min.js"></script>
<script src="{{$asset_url}}/assets/js/rickshaw/vendor/d3.v3.js"></script>
<script src="{{$asset_url}}/assets/js/rickshaw/rickshaw.min.js"></script>
<script src="{{$asset_url}}/assets/js/raphael-min.js"></script>
<script src="{{$asset_url}}/assets/js/morris.min.js"></script>
<script src="{{$asset_url}}/assets/js/toastr.js"></script>
<script src="{{$asset_url}}/assets/js/neon-custom.js"></script>
<script src="{{$asset_url}}/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="{{$asset_url}}/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script src="{{$asset_url}}/build/english.js"></script>
<script src="{{$asset_url}}/build/menu.js"></script>

<script src="{{asset('bower_components/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{asset('bower_components/tinymce/tinymce.min.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        statusCode: {
            404: function () {
                toastr.error( "Địa chỉ liên kết với máy chủ không chính xác" );
            },
            401: function() {
                toastr.error( "Do quá lâu bạn không thao tác, tài khoản tự động đăng xuất, vui lòng đăng nhập lại" );
            },
            500: function() {
                toastr.error( "Máy chủ bị lỗi, vui lòng liên hệ kỹ thuật viên" );
            }
        }
    });
    const options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    };

    $('.ckeditor') && $('.ckeditor').ckeditor(options);
</script>
<!-- Demo Settings -->
<script src="{{$asset_url}}/assets/js/neon-demo.js"></script>
<script src="{{$asset_url}}/assets/js/fileinput.js"></script>
@stack('js')
@yield('js')
<script src="{{asset('build/config/mctiny.js')}}"></script>
<script>
    $(document).on('click', '.destroyBtn', function (e) {
        const ok = confirm('Are you sure?');
        if(ok === false) {
            e.preventDefault();
        }
    });

    $('.isBack').click(function (e) {
        const form = $(this).parents('form');
        const route = form.attr('action') + '?is_back=1';
        form.attr('action', route)
    });

    $('#locale').change(function () {
        const self = $(this);
        const locale = self.val();
        const url = self.attr('data-url');
        $.ajax({
            url: url,
            data: {locale:locale},
            method: 'GET',
            success: function (data) {
                location.reload();
            }
        })
    })
</script>
</body>
</html>


