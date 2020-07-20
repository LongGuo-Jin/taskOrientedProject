<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Psy\Command\HistoryCommand;
use App\Helper\Common;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Model\Tag;

class TagController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request) {
        $user = auth()->user();
        $personID = $user->id;
        $role_id = $user->roleID;
        $organization_id = $user->organization_id;


        $selectedTag = null;
        $selected = null;
        $system = null;
        if (isset($request['tagID']) && $request['tagID'] != '') {
            $selectedTag = Tag::where('ID' , $request['tagID'])->firstOrFail()->toArray();
            $selected = $request['tagID'];
            $system = $request['system'];
        }

        $system_tag = Tag::where('organization_id', $organization_id)->where('tagtype',1)->get()->toArray();
        $organization_tag = Tag::where('organization_id', $organization_id)->where('tagtype',2)->get()->toArray();
        $personal_tag = Tag::where('organization_id', $organization_id)->where('tagtype' , 3)->where('person_id',$personID)->get()->toArray();

        $tags = [];
        $tags['system'] = $system_tag;
        $tags['organization'] = $organization_tag;
        $tags['personal'] = $personal_tag;
        $tags['selected'] = $selectedTag;

        return view('tag.index',
            [
                'TagManager' => true,
                'personalID' => $personID,
                'tags' => $tags,
                'roleID' => $role_id,
                'organizationID' => $organization_id,
                'selected' => $selected,
                'system' => $system,
            ]
        );
    }

    public function Add(Request $request) {
        $user = auth()->user();
        $personID = $user->id;
        $role_id = $user->roleID;
        $organization_id = $user->organization_id;

        $fields = $this->validate($request, [
            'tagName' => ['required', 'string', 'max:255'],
            'tagNote' => ['required', 'string', 'max:255'],
            'tagDescription' => ['required', 'string', 'max:255'],
        ]);

        if ($request['tagType'] == 'organization') {
            if ($role_id == 1) {
                Tag::create(['name'=>$request['tagName'],
                             'organization_id' => $organization_id,
                             'person_id' => $personID,
                             'tagtype' => 2,
                             'color' => $request['tagColor'],
                             'colorValue' => $request['tagColorValue'],
                             'note' => $request['tagNote'],
                             'description' => $request['tagDescription'] ,
                             'show' => $request['showTag']=='on'?1:0
                ]);
            }
        } else if ($request['tagType'] == 'personal') {
            Tag::create(['name'=>$request['tagName'],
                'organization_id' => $organization_id,
                'person_id' => $personID,
                'tagtype' => 3,
                'color' => $request['tagColor'],
                'colorValue' => $request['tagColorValue'],
                'note' => $request['tagNote'],
                'description' => $request['tagDescription'] ]);
        }

        return redirect('tag');
    }

    public function Update(Request $request) {

//        dd($request);
        $systemTag = null;
        if (isset($request['systemTag'])) {
            Tag::where('ID',$request['tagID'])->update(
                [
                    'color' => $request['tagColor'],
                    'colorValue' => $request['tagColorValue'],
                    'description' => $request['tagDescription'],
                    'show' => $request['showTagEdit']=='on'?1:0,
                ]
            );
        } else {
            Tag::where('ID',$request['tagID'])->update(
                [
                    'name' => $request['tagName'],
                    'color' => $request['tagColor'],
                    'colorValue' => $request['tagColorValue'],
                    'note' => $request['tagNote'],
                    'description' => $request['tagDescription'],
                    'show' => $request['showTagEdit']=='on'?1:0,
                ]
            );
        }
        return redirect('tag');
    }

    public function Delete(Request $request) {
        Tag::where('ID',$request['tagID'])->delete();
        return redirect('tag');
    }
    public function UpdatePin(Request $request) {

        $tag = Tag::where('ID',$request['tagID'])->firstOrFail()->toArray();

        if ($tag['pinned'] == 1) {
            Tag::where('ID',$request['tagID'])->update(
                ['pinned' => 0]
            );
        } else {
            Tag::where('ID',$request['tagID'])->update(
                ['pinned' => 1]
            );
        }
        return redirect()->back();
    }
}
