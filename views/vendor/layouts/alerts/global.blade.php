@if(session()->has('global'))
    <div class="alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
        <span class="sr-only">Success:</span>
        {{session()->pull('global')}}
    </div>
@endif