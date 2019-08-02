<div class="fileinput fileinput-new" data-provides="fileinput">
    <div class="fileinput-new thumbnail" data-trigger="fileinput">
        <img class="img-responsive" src="{{$image ? $image : 'http://placehold.it/200x150'}}" alt="{{$name}}">
    </div>
    <div class="fileinput-preview fileinput-exists thumbnail img-responsive"></div>
    <div>
        <span class="btn btn-white btn-file">
            <span class="fileinput-new">Select image</span>
            <span class="fileinput-exists">Change</span>
            <input type="file" name="{{$name}}" id="{{$name}}" accept="image/*">
        </span>
        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
    </div>
</div>