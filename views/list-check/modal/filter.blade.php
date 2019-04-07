<form action="{{route('ajax.test.case')}}" id="formFilter{{$type}}">
    <input type="hidden" id="routeCategoryList{{$type}}" value="{{route('involve.test-category.getList')}}">
    <input type="hidden" name="test_type" value="{{$type}}">
    <input type="hidden" name="project_id" value="{{$project_id}}">
    <div class="col-md-4 form-group">
        <label for="">Domain</label>
        <select class="form-control" name="domain_id" id="domain_id{{$type}}">
            <option value="">Select option</option>
            @foreach($testDomainCompose as $testDomainId => $testDomainName)
                <option value="{{$testDomainId}}">{{$testDomainName}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 form-group">
        <label for="">Category</label>
        <select class="form-control selectFilter{{$type}}" name="test_category_id" id="test_category_id{{$type}}">
            <option value="">Select option</option>
        </select>
    </div>
    <div class="col-md-4 form-group">
        <label for="">Name</label>
        <input  name="name" class="form-control inputFilter{{$type}}">
    </div>
</form>
