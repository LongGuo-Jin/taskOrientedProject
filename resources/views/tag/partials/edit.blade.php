<div class="col-md-3" id="tagEditCard">
    <div class="list-card kt-scroll" data-scroll="true">
        <form method="post" action="{{route('tag.update')}}">
            @csrf
            <input type="hidden" name="tagID" value="{{$selected}}" >
            @if($system == 1)
                <input type="hidden" name="systemTag" value="1" >
            @endif
        <div style="display: flex; justify-content: space-between;font-size: 17px; color: #464e74;">
            <span {{$system != 1?"id=tagNameEdit":""}}> {{$system == 1?__('tag.'.$tags['selected']['name']):$tags['selected']['name']}} </span>
            @if ($system != 1)
                <input type="text" name="tagName" id = "tagName" class="form-control"   value="{{$tags['selected']['name']}}" style="display: none">
            @endif
            @if($roleID != '1' && $system == '1')
            @elseif($roleID != '1' && $system == '2')
            @else
                @if ($tags['selected']['pinned'] == 0)
                    <a href="{{route('tag.updatePin',['tagID'=>$selected])}}"><img src="{{asset('public/images/unpinned.png')}}" alt="logo" height="25"></a>
                @else
                    <a href="{{route('tag.updatePin',['tagID'=>$selected])}}"><img src="{{asset('public/images/pinned.png')}}" alt="logo" height="25"></a>
                @endif
            @endif

        </div>
        <div class="row mt-3">
                <div class="ml-2">
                    <div class="mb-2 custom-span">
                        {{__('tag.tagType')}}
                    </div>
                    <div class="ml-2" style="display: flex">
                        <input type="radio" id="system-radio" {{$tags['selected']['tagtype'] == 1?"checked":""}} disabled class="mt-1 mr-3"> <span> <h6>{{__('tag.sysTag')}}</h6></span>
                    </div>
                    <div class="ml-2" style="display: flex">
                        <input type="radio" id="system-radio" {{$tags['selected']['tagtype'] == 2?"checked":""}} disabled class="mt-1 mr-3"> <span> <h6>{{__('tag.orgTag')}}</h6></span>
                    </div>
                    <div class="ml-2" style="display: flex">
                        <input type="radio" id="system-radio" {{$tags['selected']['tagtype'] == 3?"checked":""}} disabled class="mt-1 mr-3"> <span> <h6>{{__('tag.perTag')}}</h6></span>
                    </div>
                </div>
        </div>
        <div class="row mt-2">
            <span class="custom-span mb-2 ml-2">{{__('tag.tagColor')}}</span>
            <div class="ml-2">
                <input type="hidden" name="tagColor" id="tagColorEdit" value="{{$tags['selected']['color']}}">
                <input type="hidden" name="tagColorValue" id="tagColorValueEdit" value="{{$tags['selected']['colorValue']}}">
                <?php
                $colorValue = $tags['selected']['colorValue'];
                $col = ($colorValue % 8) * 1;
                $row = (($colorValue-$col) / 8) * 1;
                $colors = [
                    ['#FF0000','#FF000099','#FF000044'],
                    ['#d4b04d','#d4b04d99','#d4b04d44'],
                    ['#e5ff08','#e5ff0899',"#e5ff0844"],
                    ['#08ff0f','#08ff0f99','#08ff0f44'],
                    ['#4a6f4b','#4a6f4b99','#4a6f4b44'],
                    ['#277af7','#277af799','#277af744'],
                    ['#2a27f7','#2a27f799','#2a27f744'],
                    ['#f72787','#f7278799','#f7278744'],
                ];
                ?>
                @for( $i = 0; $i < 3;  $i ++)
                    <div style="display: flex;margin-left: 10px">
                        @for( $j = 0; $j < 8; $j ++)
                            <div class="color-check-box" >
                                @if($i == $row && $j == $col)
                                    <input type="radio" name="radio" onclick="ColorSelectEdit('{{$j}}','{{$i}}')"  checked>
                                @else
                                    <input type="radio" name="radio" onclick="ColorSelectEdit('{{$j}}','{{$i}}')"  >
                                @endif
                                <span class="checkmark" style="background-color: {{$colors[$j][$i]}};"></span>
                            </div>
                        @endfor
                    </div>
                @endfor
                <div style="display: flex;margin-left: 10px">
                    <input type="checkbox" style="width: 25px; height: 25px" name="showTagEdit" id="tagShowEdit" {{$tags['selected']['show'] == 1?"checked":""}}>
                    <span class="mt-auto mb-auto ml-2 custom-span">{{__('tag.showTag')}}</span>
                </div>
            </div>

        </div>
        <div class="mt-3">
            <div class="mb-2 custom-span">
                {{__('tag.note')}}
            </div>
            <div>
                <span class="ml-2" {{$system != 1?"id=tagNoteEdit":""}} style="font-size: 13px">{{$system == 1?__('tag.'.$tags['selected']['name'].'_D'):$tags['selected']['note']}}</span>
                @if($system != 1)
                    <input type="text"  id = "tagNote" name="tagNote" class="form-control"  value="{{$tags['selected']['note']}}" style="display: none">
                @endif
            </div>
            <div class="mb-2 mt-3 custom-span">
                {{__('tag.description')}}
            </div>
            <div>
                <span id="tagDescriptionEdit" class="ml-2" style="font-size: 13px">{{$tags['selected']['description']}}</span>
                <textarea type="text"  id = "tagDescription"  name="tagDescription" class="form-control" style="display: none; height: 200px">{{$tags['selected']['description']}}</textarea>
            </div>
        </div>
        <div style="text-align: center; margin-top: 100px; justify-content: space-between; display: flex">
            @if(($roleID == '1' && $system == '2') || $system == '3')
                <a href="{{route('tag.delete',['tagID'=>$selected])}}"class="btn btn-brand btn-icon-sm" id="tagDelete" aria-expanded="false">
                    {{__('tag.delete')}}
                </a>
            @endif

            <button  type="submit" class="btn btn-brand btn-icon-sm" id="tagUpdate" aria-expanded="false" style="display: none">
                {{__('tag.update')}}
            </button>
        </div>
        </form>
    </div>

</div>