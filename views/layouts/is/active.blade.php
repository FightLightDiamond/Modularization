@if($row->active == 1)
    <a data="{{$row->id}}" class="btn btn-xs btn-success setactive"><span class="glyphicon glyphicon-ok"></span></a>
@else
    <a data="{{$row->id}}" class="btn btn-xs btn-danger destroyBtn setactive"  id="active_user"><span class="glyphicon glyphicon-ban-circle"></span></a>
@endif