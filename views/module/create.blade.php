@extends('mod::layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form class="form-group">
                <input name="name" class="form-control" placeholder="Search ... " value="{{request('name')}}">
            </form>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Table</th>
                        <th>API</th>
                        <th>Module</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tables as $table)
                        <tr>
                            <td>{{$table}}</td>
                            <td>
                                <button class="btn btn-xs btn-default setTable" data-toggle="modal" data-target="#apiModal"
                                        data-table="{{$table}}">
                                    <i class="fa fa-connectdevelop"></i>
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-xs btn-default setTable" data-toggle="modal" data-target="#moduleModal"
                                        data-table="{{$table}}">
                                    <i class="fa fa-group"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="apiModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">API render</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('api-ctrl.produce')}}" method="POST" >
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="">Name space</label>
                                <input value="{{old('namespace', 'App')}}" name="namespace" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Table</label>
                                <input value="{{old('table')}}" name="table" class="form-control tableName">
                            </div>
                            <div class="form-group">
                                <label for="">Folder</label>
                                <input value="{{old('path', 'app')}}" name="path" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Prefix</label>
                                <input value="{{old('prefix')}}" name="prefix" class="form-control">
                            </div>
                            <button class="btn btn-default">submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="moduleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Module render</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('dbmagic.store')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="">Name space</label>
                                <input value="{{old('namespace', 'App')}}" name="namespace" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Table</label>
                                <input value="{{old('table')}}" name="table" class="form-control tableName">
                            </div>
                            <div class="form-group">
                                <label for="">Folder</label>
                                <input value="{{old('path', 'app')}}" name="path" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Prefix</label>
                                <input value="{{old('prefix')}}" name="prefix" class="form-control">
                            </div>
                            <button class="btn btn-default">submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        Menu('#modularizationMenu', '#crudMenu')
    </script>
    <script>
        const setTable = '.setTable';
        $(setTable).click(function () {
            const self = $(this);
            const table = self.attr('data-table');
            $('.tableName').val(table);
        });
    </script>
@endpush