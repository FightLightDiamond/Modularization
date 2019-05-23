<header class="navbar navbar-fixed-top"><!-- set fixed position by adding class "navbar-fixed-top" -->
    <div class="navbar-inner">
        <!-- logo -->
        <div class="navbar-brand">
            <a href="/" style="color: whitesmoke">
                <strong>{{config('app.name')}}</strong>
                {{--                <img src="{{$asset_url}}/assets/images/logo@2x.png" width="88" alt=""/>--}}
            </a>
        </div>
        <!-- main menu -->
        <ul class="navbar-nav">
            <li>
                <a href="{{route('edu.tutorial.index')}}">
                    <span><i class="entypo-docs"></i> {{__('nav.tutorial')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('edu.test.list')}}">
                    <span><i class="entypo-graduation-cap"></i> {{__('nav.test')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('game.index')}}">
                    <span><i class="fa fa-play"></i> Game</span>
                </a>
            </li>
            <li>
                <a href="{{route('english.index')}}">
                    <span><i class="fa fa-language"></i> English</span>
                </a>
            </li>
            <li>
                <a href="{{route('charts')}}">
                    <span><i class="entypo-chart-line"></i> Shark tank</span>
                </a>
            </li>
            <li>
                <a href="{{route('eco.product.show')}}">
                    <span><i class="fa fa-map-marker"></i> Shop</span>
                </a>
            </li>
            <li>
                <a href="{{route('contact')}}">
                    <span><i class="entypo-mail"></i> {{__('nav.contact')}}</span>
                </a>
            </li>
        </ul>

        <ul class="nav navbar-right pull-right">
            @if(auth()->check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <span  style="color: goldenrod">
                            <strong>
                            <span id="moneyTotal">{{number_format(auth()->user()->coin)}}</span>
                                <i class="fa fa-bitcoin"></i>
                                {{auth()->user()->last_name}}
                            </strong>
                        </span>
                        <i class="fa fa-user"></i>
                    </a>
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li class="external">--}}
                            {{--<a href="{{route('acl.profile')}}">--}}
                                {{--<i class="fa fa-user"></i> {{__('auth.profile')}}--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                </li>
                <li class="sep"></li>
                <li>
                    <a onclick="$('#logoutForm').submit()">
                        <i class="fa fa-sign-out"></i>
                    </a>
                    <form id="logoutForm" style="display: none" method="post" action="{{route('logout')}}" >
                        {!! csrf_field() !!}
                    </form>
                </li>
            @else
                <li>
                    <a href="{{asset('login')}}"> {{__('auth.login')}} <span class="fa fa-sign-in"></span></a>
                </li>
                <li class="sep"></li>
                <li>
                    <a href="{{asset('register')}}">{{__('auth.register')}} <span class="fa fa fa-user-plus"></span></a>
                </li>
            @endif
        </ul>

        <!-- mobile only -->
            <li class="visible-xs">
                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="horizontal-mobile-menu visible-xs">
                    <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</header>