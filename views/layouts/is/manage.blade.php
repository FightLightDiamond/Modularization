@if($row->manager == 1)
    <a data="{{$row->id}}" class="btn btn-xs btn-success  active_mod"><span class="glyphicon glyphicon-flag"></span></a>
@else
    <a data="{{$row->id}}" class="btn btn-xs btn-default active_mod"><span class="glyphicon glyphicon-flag"></span></a>
@endif