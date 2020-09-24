<div class="col-md-3" id="tagAddCard" style="display: none;">
    <div class="list-card kt-scroll" data-scroll="true" >
        <form method="post" role="form" action="{{route('tag.add')}}">
            @csrf
            <input type="hidden" name="personalID" value="{{$personalID}}">
            <input type="hidden" name="organizationID" value="{{$organizationID}}">
            <div class="custom-span">
                <span> {{__('tag.tagName')}} </span>
                <input name="tagName" class="form-control" style="font-size: 16px">
                @if ($errors->has('tagName'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $errors->first('tagName') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row mt-3">
                <div class="ml-2">
                    <div class="mb-2 custom-span">
                        {{__('tag.tagType')}}
                    </div>
                    <div class="ml-2" style="display: flex">
                        <input type="hidden" name="tagType" id="tagType">
                        <span id="tagTypeShow"> {{__('tag.orgTag')}} </span>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <span class="custom-span mb-2 ml-2">{{__('tag.tagColor')}}</span>
                <div class="ml-2">
                    <input type="hidden" name="tagColor" id="tagColor" value="#4a6f4b99" class="color-picker mt-2 mb-3">
                    <input type="hidden" name="tagColorValue" id="tagColorValue" value="{{13}}">
                    <?php
                    $colorValue = 13;

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
                        <div style="display: flex; margin-left: 10px">
                            @for( $j = 0; $j < 8; $j ++)
                                <div class="color-check-box" >
                                    @if($i == $row && $j == $col)
                                        <input type="radio" name="radio" onclick="ColorSelect('{{$j}}','{{$i}}')"  checked>
                                    @else
                                        <input type="radio" name="radio" onclick="ColorSelect('{{$j}}','{{$i}}')"  >
                                    @endif
                                    <span class="checkmark" style="background-color: {{$colors[$j][$i]}};"></span>
                                </div>
                            @endfor
                        </div>
                    @endfor
                    <div style="display: flex;margin-left: 10px">
                        <input type="checkbox" style="width: 25px; height: 25px" name="showTag" checked >
                        <span class="mt-auto mb-auto ml-2 custom-span">{{__('tag.showTag')}}</span>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div class="mb-2 custom-span">
                    <span> {{__('tag.note')}} </span>
                    <input name="tagNote" class="form-control" style="font-size: 16px">
                    @if ($errors->has('tagNote'))
                        <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $errors->first('tagNote') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="mb-2 mt-3 custom-span">
                    <span> {{__('tag.description')}} </span>
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
                    {{__('tag.done')}}
                </button>
            </div>
        </form>
    </div>
</div>