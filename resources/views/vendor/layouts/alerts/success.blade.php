@if(session()->has('success'))
  <div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
    <span class="sr-only">Success:</span>
    {{session()->pull('success')}}
  </div>
@endif