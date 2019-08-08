<table class="table table-bordered table-striped">
    <tr>
        <td><input type="checkbox" class="check_all{{$type}}"></td>
        <td>ID</td>
        <td>name</td>
        <td>Version</td>
        <td>Category</td>
        <td>Priority</td>
        {{--<td>Domain</td>--}}
        <td>Severity</td>
        {{--<td>Remark</td>--}}
        {{--<td>Active</td>--}}
    </tr>
    @foreach($testCases as $testCase)
        <tr>
            <td><input value="{{$testCase->id}}" nick="{{$testCase->name}}" type="checkbox" class="check_item{{$type}}">
            </td>
            <td>{{$testCase->id }}</td>
            <td>{{$testCase->name}}</td>
            <td>{{$testCase->version}}</td>
            <td>{{$testCase->testCategory?$testCase->testCategory->name:''}}</td>
            <td>{{$testCase->priority}}</td>
            {{--            <td>{{$testCase->testDomain?$testCase->testDomain->name:''}}</td>--}}
            <td>{{$testCase->severity}}</td>
            {{--<td>{{$testCase->remark}}</td>--}}
            {{--<td>{{$testCase->active}}</td>--}}
        </tr>
    @endforeach
</table>
<div class="text-right">
    {{$testCases->appends(['test_type' => $type])->links()}}
</div>
