<div class="col-md-12 col-sm-4 clearfix hidden-xs">

    <ul class="list-inline links-list">
        <li>
            {{--<select name="locale" id="locale" class="form-control input-sm" data-url="{{route('locale.db')}}">--}}
                {{--@foreach(LOCALES as $LOCALE => $name)--}}
                    {{--<option {{\App::getLocale() === $LOCALE ? 'selected' : ''}} value="{{$LOCALE}}">{{$name}}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
        </li>
        <li class="dropdown pull-right">
            <strong>{{ auth()->check() ? auth()->user()->email : '' }}</strong>: &nbsp;
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                <i class="entypo-user"></i>
                <i class="entypo-down-open-mini"></i>
            </a>
            <ul class="dropdown-menu pull-right">
                {{--<li>--}}
                    {{--<a href="{{route('acl.profile')}}">--}}
                        {{--<i class="entypo-user"></i> Profile--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li class="navbar-form">
                    <form method="post" action="{{route('logout')}}">
                        {!! csrf_field() !!}
                        <button class="btn btn-sm">
                            <i class="entypo-logout right"></i>Log Out
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</div>