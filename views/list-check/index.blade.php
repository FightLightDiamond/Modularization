<div>
    <h3 style="border-bottom: 1px solid #8c8b8b;">Test type: {{TEST_TYPES[$type]}}</h3>
    <div class="form-group">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalTestCase{{$type}}">
            <i class="fa fa-plus"></i> Add test case
        </button>
    </div>
    @include('_dev.test-case.table', ['testCases' => $testCaseSelected])
    <div class="form-group text-center">
        <button class="btn btn-danger destroyBtn" id="removeSelectedBtn{{$type}}"><i class="fa fa-trash"></i> Remove
        </button>
    </div>
    @include('_dev.test-case.modal.index')
</div>
