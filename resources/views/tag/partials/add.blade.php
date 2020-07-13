<div class="col-md-3" id="tagAddCard" style="display: none;">
    <div class="list-card">
        <form method="post" role="form" action="{{route('tag.add')}}">
            @csrf
            <input type="hidden" name="personalID" value="{{$personalID}}">
            <input type="hidden" name="organizationID" value="{{$organizationID}}">
            <div class="custom-span">
                <span> Tag Name </span>
                <input name="tagName" class="form-control" style="font-size: 16px">
                @if ($errors->has('tagName'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $errors->first('tagName') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <div class="mb-2 custom-span">
                        Tag Type
                    </div>
                    <div class="ml-2" style="display: flex">
                        <input type="hidden" name="tagType" id="tagType">
                        <span id="tagTypeShow"> <h5>Organization Tag</h5></span>
                    </div>
                </div>
                <div class="col-6" id="colorpicker">
                    <span class="custom-span">Tag Color</span>
                    <input type="color" name="tagColor" class="color-picker mt-2 mb-3">
                    <div style="display: flex;">
                        <input type="checkbox" style="width: 25px; height: 25px" name="showTag" checked >
                        <span class="mt-auto mb-auto ml-2 custom-span">Show Tag</span>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <div class="mb-2 custom-span">
                    <span> Note </span>
                    <input name="tagNote" class="form-control" style="font-size: 16px">
                    @if ($errors->has('tagNote'))
                        <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $errors->first('tagNote') }}</strong>
                    </span>
                    @endif

                </div>
                <div class="mb-2 mt-5 custom-span">
                    <span> Description </span>
                    <textarea name="tagDescription" class="form-control" style="font-size: 16px"> </textarea>
                    @if ($errors->has('tagDescription'))
                        <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $errors->first('tagDescription') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div style="text-align: center; margin-top: 100px">
                <button  type="submit" class="btn btn-brand btn-icon-sm" aria-expanded="false">
                    {{__('tag.addNew')}}
                </button>
            </div>
        </form>
    </div>
</div>