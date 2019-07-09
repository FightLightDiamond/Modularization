@extends('mod::layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
             <pre>
                {!! session('moduleContent') !!}
            </pre>
        </div>

        <div class="col-lg-12">
            <form class="form-group">
                <input name="name" class="form-control" placeholder="Search ... " value="{{request('name')}}">
            </form>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Table</th>
                        <th>API</th>
                        <th>Admin</th>
                        {{--<th>Frontend</th>--}}
                        {{--<th>All</th>--}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($tables as $k => $table)
                        <tr>
                            <td>{{$k + 1}}</td>
                            <td>{{$table}}</td>
                            <td>
                                <button class="btn btn-xs btn-default setTable" data-toggle="modal" data-target="#apiModal"
                                        data-table="{{$table}}">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-xs btn-default setTable" data-toggle="modal" data-target="#adminModal"
                                        data-table="{{$table}}">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </button>
                            </td>
                            {{--<td>--}}
                                {{--<button class="btn btn-xs btn-default setTable" data-toggle="modal" data-target="#frontendModal"--}}
                                        {{--data-table="{{$table}}">--}}
                                    {{--<i class="glyphicon glyphicon-plus"></i>--}}
                                {{--</button>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<button class="btn btn-xs btn-default setTable" data-toggle="modal" data-target="#allModal"--}}
                                        {{--data-table="{{$table}}">--}}
                                    {{--<i class="glyphicon glyphicon-plus"></i>--}}
                                {{--</button>--}}
                            {{--</td>--}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @include('mod::module.modals.api')
        @include('mod::module.modals.admin')
        {{--@include('mod::module.modals.all')--}}
        {{--@include('mod::module.modals.frontend')--}}
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