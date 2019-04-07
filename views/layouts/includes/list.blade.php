<ul class="list-group">
    <li class="list-group-item">
        <div class="checkbox checkbox-replace color-primary pull-right">
            <input type="checkbox">
        </div>
        All
    </li>
    @foreach($list as $key => $value)
        <li class="list-group-item">
            <div class="checkbox checkbox-replace color-primary pull-right">
                <input type="checkbox" name="role[]" value="{{$key}}" class="role_id">
            </div>
            {{$value}}
        </li>
    @endforeach
</ul>