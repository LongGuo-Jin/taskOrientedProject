<?php

namespace App\Http\Controllers;

use App\Model\Person;
use App\Model\Tag;
use App\Model\TagPerson;
use App\Organization;
use App\User;
use Illuminate\Http\Request;
use App\Helper\Common;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    public function index() {
        $organization_id = auth()->user()->Organization()->first()->id;
        $organization = Organization::findOrFail($organization_id);
        $users = $organization->Users()->get();
//        dd($users);
        $TagPerson = new TagPerson();
        $PersonTagNameList = $TagPerson->getPersonTagName();
        return view('user.index',['users'=>$users , 'organization' => $organization->organization,'PersonTagNameList' => $PersonTagNameList,]);
    }

    public function AddUser() {
        $organization_id = auth()->user()->Organization()->first()->id;
        $organization = Organization::findOrFail($organization_id);
        $TagPerson = new TagPerson();
        $PersonTagNameList = $TagPerson->getPersonTagName();
        return view('user.create' , ['organization' => $organization->organization,'PersonTagNameList' => $PersonTagNameList]);
    }

    public function SaveUser(Request $request) {
//        $organization = auth()->user()->organization;
        $organization_id = auth()->user()->Organization()->first()->id;
        $organization = Organization::findOrFail($organization_id);

        $fields = $this->validate($request, [
            'nameFirst' => ['required', 'string', 'max:255'],
            'nameFamily' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = $organization->Users()->create([
            'nameFirst' => $fields['nameFirst'],
            'nameFamily' => $fields['nameFamily'],
            'organization' => $organization,
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
            'roleID' => $request->roleID,
        ]);

//        dd($user);
//        $person = Person::create([
//            'nameFirst' => $fields['nameFirst'],
//            'nameFamily' => $fields['nameFamily'],
//            'organization' => $organization,
//            'roleID' => $request->roleID,
//            'userID' => $user->id,
//        ]);
        $tag = Tag::create([
            'name' => $user->nameFirst[0].$user->nameFamily[0],
            'tagtype' => 4,
            'color' => 1,
            'note' => 1,
        ]);

        TagPerson::create(['tagID'=>$tag->id , 'personID'=>$user->id]);

        return redirect('user');
    }

    public function EditUser(Request $request) {
        $organization_id = auth()->user()->Organization()->first()->id;
        $organization = Organization::findOrFail($organization_id);

        $id = $request->id;
        $users = User::where('id',$id)->firstOrFail();
        $TagPerson = new TagPerson();
        $PersonTagNameList = $TagPerson->getPersonTagName();
        return view('user.edit',['user'=>$users,'organization' => $organization->organization,'PersonTagNameList' => $PersonTagNameList]);
    }

    public function UpdateUser(Request $request) {
        $fields = $this->validate($request, [
            'nameFirst' => ['required', 'string', 'max:255'],
            'nameFamily' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        
        $user = User::findOrFail($request->id);
        $user->update([
            'nameFirst' => $fields['nameFirst'],
            'nameFamily' => $fields['nameFamily'],
            'email' => $fields['email'],
            'roleID' => $request->roleID,
        ]);

        return redirect('user');
    }

    public function DeleteUser(Request $request) {
        $id = $request->id;
        User::where('id',$id)->firstOrFail()->delete();
        TagPerson::where('personID',$id)->delete();
        return redirect('user');
    }

    public function AskPassword(Request $request) {
        $pwd = $request->password;
        $password = auth()->user()->password;
//        Log::debug("ask password".$pwd);
//        Log::debug("password".$password);
//        Log::debug("hash password".Hash::make($pwd));
        if (Hash::check($pwd, $password)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}