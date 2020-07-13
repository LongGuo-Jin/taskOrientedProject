<div class="col-md-3">
    <form method="post" action="{{route('tag.update')}}">
        @csrf
        <input type="hidden" name="tagID" value="{{$selected}}" >
        @if($system == 1)
            <input type="hidden" name="systemTag" value="1" >
        @endif
    <div class="list-card">
        <div style="display: flex; justify-content: space-between;font-size: 22px; color: #464e74;">
            <span {{$system != 1?"id=tagNameEdit":""}}> {{$tags['selected']['name']}} </span>
            @if ($system != 1)
                <input type="text" name="tagName" id = "tagName" class="form-control"   value="{{$tags['selected']['name']}}" style="display: none">
            @endif
            {{--<i class="la la-gavel mt-auto mb-auto font-weight-bold" style="cursor: pointer; color: darkred; font-size: 25px"></i>--}}
            @if($roleID != '1' && $system ==='1')
            @elseif($roleID != '1' && $system ==='2')
            @else
                @if ($tags['selected']['pinned'] == 0)
                    <a href="{{route('tag.updatePin',['tagID'=>$selected])}}"><i class="la la-gavel mt-auto mb-auto font-weight-bold" style="cursor: pointer; color: green; font-size: 25px"></i></a>
                @else
                    <a href="{{route('tag.updatePin',['tagID'=>$selected])}}"><i class="la la-gavel mt-auto mb-auto font-weight-bold" style="cursor: pointer; color: red; font-size: 25px"></i></a>
                @endif
            @endif

        </div>
        <div class="row mt-3">
            <div class="col-6">
                <div class="mb-2 custom-span">
                    Tag Type
                </div>
                <div class="ml-2" style="display: flex">
                    <input type="radio" id="system-radio" {{$tags['selected']['tagtype'] == 1?"checked":""}} disabled class="mt-1 mr-3"> <span> <h5>System Tag</h5></span>
                </div>
                <div class="ml-2" style="display: flex">
                    <input type="radio" id="system-radio" {{$tags['selected']['tagtype'] == 2?"checked":""}} disabled class="mt-1 mr-3"> <span> <h5>Organization Tag</h5></span>
                </div>
                <div class="ml-2" style="display: flex">
                    <input type="radio" id="system-radio" {{$tags['selected']['tagtype'] == 3?"checked":""}} disabled class="mt-1 mr-3"> <span> <h5>Personal Tag</h5></span>
                </div>
            </div>
            <div class="col-6" id="colorpicker">
                <span class="custom-span">Tag Color</span>
                <input type="color" name = "tagColor" id="tagColorEdit" value="{{$tags['selected']['color']}}" class="color-picker mt-2 mb-3">
                <div style="display: flex;">
                    <input type="checkbox" style="width: 25px; height: 25px" name="showTagEdit" id="tagShowEdit" {{$tags['selected']['show'] == 1?"checked":""}}>
                    <span class="mt-auto mb-auto ml-2 custom-span">Show Tag</span>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <div class="mb-2 custom-span">
                Note
            </div>
            <div>
                <span class="ml-2" {{$system != 1?"id=tagNoteEdit":""}} style="font-size: 14px">{{$tags['selected']['note']}}</span>
                @if($system != 1)
                    <input type="text"  id = "tagNote" name="tagNote" class="form-control"  value="{{$tags['selected']['note']}}" style="display: none">
                @endif
            </div>
            <div class="mb-2 mt-5 custom-span">
                Description
            </div>
            <div>
                <span id="tagDescriptionEdit" class="ml-2" style="font-size: 14px">{{$tags['selected']['description']}}</span>
                <textarea type="text"  id = "tagDescription"  name="tagDescription" class="form-control" style="display: none; height: 200px">{{$tags['selected']['description']}}</textarea>
            </div>
        </div>
        <div style="text-align: center; margin-top: 100px">
            <button  type="submit" class="btn btn-brand btn-icon-sm" id="tagUpdate" aria-expanded="false" style="display: none">
                {{__('tag.update')}}
            </button>
            <a href="{{route('tag.delete',['tagID'=>$selected])}}"class="btn btn-brand btn-icon-sm" id="tagDelete" aria-expanded="false" style="display: none">
                {{__('tag.delete')}}
            </a>
        </div>
    </div>
    </form>
</div>