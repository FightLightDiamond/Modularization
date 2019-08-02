@extends('_extends_')
@section('_content_')
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('_route_.index')}}">{{trans('table._table_')}}</a>
        </li>
        <li class="active">
            <strong>Show</strong>
        </li>
    </ol>
    <div>
        {!! _show_ !!}
    </div>
@endsection

@push('js')
    <script>
        Menu('#_namespace_Menu', '#_var_Menu')
    </script>
@endpush
