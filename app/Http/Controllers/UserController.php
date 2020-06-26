<?php

namespace App\Http\Controllers;

use App\Model\Person;
use App\Model\TagPerson;
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
        $organization = auth()->user()->organization;
        $users = User::where('users.organization',$organization)->join('person','users.id','=','person.userID')
                ->select('users.id','users.nameFirst', 'users.nameFamily','users.organization' ,'users.email' , 'person.roleID')->get();

        return view('user.index',['users'=>$users]);
    }

    public function AddUser() {
        return view('user.create');
    }

    public function SaveUser(Request $request) {
        $organization = auth()->user()->orgnization;
        $fields = $this->validate($request, [
            'nameFirst' => ['required', 'string', 'max:255'],
            'nameFamily' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = User::create([
            'nameFirst' => $fields['nameFirst'],
            'nameFamily' => $fields['nameFamily'],
            'organization' => $organization,
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

        $person = Person::create([
            'nameFirst' => $fields['nameFirst'],
            'nameFamily' => $fields['nameFamily'],
            'organization' => $fields['organization'],
            'roleID' => $request->roleID,
            'userID' => $user->id,
        ]);        

        TagPerson::create(['tagID'=>10 , 'personID'=>$person->id]);
        return redirect('user');
    }

    public function EditUser(Request $request) {
        $id = $request->id;
        $users = User::where('users.id',$id)->join('person','users.id','=','person.userID')
                ->select('users.id','users.nameFirst', 'users.nameFamily','users.email' , 'person.roleID')
                ->firstOrFail();
        
        return view('user.edit',['user'=>$users]);
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
        ]);

        $person = Person::where('userID' , $user->id)->update([
            'nameFirst' => $fields['nameFirst'],
            'nameFamily' => $fields['nameFamily'],
            'roleID' => $request->roleID,
        ]);
        // $person1 = Person::findOrFail($person->ID);
        //  dd($person1);
        // $person1->update([
        //     'nameFirst' => $fields['nameFirst'],
        //     'nameFamily' => $fields['nameFamily'],
        //     'roleID' => $request->roleID,
        // ]);
        //  dd($person);
        return redirect('user');
    }

    public function DeleteUser(Request $request) {
        $id = $request->id;
        User::where('id',$id)->firstOrFail()->delete();
        $person = Person::where('userID' , $id)->firstOrFail();
        Person::where('userID' , $id)->firstOrFail()->delete();
        TagPerson::where('personID',$person->id)->delete();
        return redirect('user');
    }

    public function AskPassword(Request $request) {
        $pwd = $request->password;
        $password = auth()->user()->password;
        Log::debug("ask password".$pwd);
        Log::debug("password".$password);
        Log::debug("hash password".Hash::make($pwd));
        if (Hash::check($pwd, $password)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}