<div class="modal fade" id="myModalTestCase{{$type}}" tabindex="-1" role="dialog"
     aria-labelledby="myModalTestCase{{$type}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalTestCase{{$type}}">Add test case </h4>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#testCase{{$type}}" aria-controls="testCase" role="tab" data-toggle="tab">
                            Test cases
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#tesCaseSelected{{$type}}" aria-controls="tesCaseSelected" role="tab"
                           data-toggle="tab">
                            Selected
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="testCase{{$type}}">
                        @include('_dev.test-case.modal.filter')
                        <div id="table{{$type}}">
                            @include('_dev.test-case.modal.table')
                        </div>
                        <div class="text-center">
                            <button class="btn btn-default addTestCaseBtn{{$type}}"><i class="fa fa-plus"></i> Add
                            </button>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tesCaseSelected{{$type}}">
                        @include('_dev.test-case.modal.item-selected')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>