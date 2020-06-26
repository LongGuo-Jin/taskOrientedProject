<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Model\Person;
use App\Model\TagPerson;
use App\Helper\Common;
use DB;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/task/taskCard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nameFirst' => ['required', 'string', 'max:255'],
            'nameFamily' => ['required', 'string', 'max:255'],
            'organization' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // User::create([
        //     'name' => "john",
        //     'email' => "test@test.com",
        //     'password' => Hash::make("12345678"),
        // ]);
        // User::create([
        //     'name' => "john",
        //     'email' => "test1@test.com",
        //     'password' => Hash::make("12345678"),
        // ]);
        // User::create([
        //     'name' => "john",
        //     'email' => "test2@test.com",
        //     'password' => Hash::make("12345678"),
        // ]);
        // User::create([
        //     'name' => "john",
        //     'email' => "test3@test.com",
        //     'password' => Hash::make("12345678"),
        // ]);
        // User::create([
        //     'name' => "john",
        //     'email' => "test4@test.com",
        //     'password' => Hash::make("12345678"),
        // ]);
        // User::create([
        //     'name' => "john",
        //     'email' => "test5@test.com",
        //     'password' => Hash::make("12345678"),
        // ]);
        // $user = User::create([
        //     'name' => "john",
        //     'email' => "test6@test.com",
        //     'password' => Hash::make("12345678"),
        // ]);

        $user = User::create([
            'nameFirst' => $data['nameFirst'],
            'nameFamily' => $data['nameFamily'],
            'organization' => $data['organization'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $person = Person::create([
            'nameFirst' => $data['nameFirst'],
            'nameFamily' => $data['nameFamily'],
            'roleID' => 1,
            'userID' => $user->id,
        ]);
        
        // DB::table('tagperson')->create(['tagID'=>1 , 'personID'=>$person->ID]);
        TagPerson::create(['tagID'=>10 , 'personID'=>$person->id]);
        
        return $user;
    }
}