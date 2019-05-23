<div class="modal fade" id="frontendModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="frontendModalLabel">Frontend render</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('frontend.render')}}" method="POST" class="row">
          {{csrf_field()}}
          <div class="form-group col-lg-3">
            <label for="">Name space</label>
            <input value="{{old('namespace', 'App')}}" name="namespace" class="form-control">
          </div>
          <div class="form-group col-lg-3">
            <label for="">Table</label>
            <input value="{{old('table')}}" name="table" class="form-control tableName">
          </div>
          <div class="form-group col-lg-3">
            <label for="">Folder</label>
            <input value="{{old('path', 'app')}}" name="path" class="form-control">
          </div>
          <div class="form-group col-lg-3">
            <label for="">Prefix</label>
            <input value="{{old('prefix')}}" name="prefix" class="form-control">
          </div>
          <div class="col-lg-12">
            <div class="list-group">
              @foreach($optionApis as $option)
                <li type="button" class="list-group-item">{{$option}}
                  <input checked class="pull-right" type="checkbox" name="{{$option}}">
                </li>
              @endforeach
            </div>
          </div>
          <div class="col-lg-12">
            <button class="btn btn-default">submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>