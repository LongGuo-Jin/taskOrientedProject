<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Organization;
use App\User;
use App\Model\Person;
use App\Model\Tag;
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

        $organization = Organization::create([
            'organization'=> $data["organization"]
        ]);
        $user = $organization->Users()->create([
            'nameFirst' => $data['nameFirst'],
            'nameFamily' => $data['nameFamily'],
            'email' => $data['email'],
            'roleID' => 1,
            'password' => Hash::make($data['password']),
        ]);


        Tag::create([
            'name' => 'PROJECT',
            'tagtype' => 1,
            'color' => "#0d861c",
            'note' => "Set of tasks with begin and end",
            'description' => "Project uses regular tasks. It has special meaning only for project doctor and statistics. It can be used as top level or sub-level tag.
Open question: can task that already has tag “project” have a subtaks “project”? (This will cause problems with statistics.)",
            'show' => 1,
            'organization_id' => $organization->id,
        ]);
        Tag::create([
            'name' => 'MILESTONE',
            'tagtype' => 1,
            'color' => "#0d861c",
            'note' => "Achievement of finishing predefined tasks",
            'description' => "Future feature!
Milestone is a special task with autonomous status behavior (user can not set it). It can be used for marking project phases or other project goals.
Milestone has other tags linked to it and it’s status will automatically be set to “finished” when all linked tasks are marked “finished”. Person in charge is notified when milestone is reached.
Milestones can have sub-milestones, they act like tasks as far as completion is concerned – when they are finished, parent milestone can be marked finished (if other conditions are met).",
            'show' => 1,
            'organization_id' => $organization->id,
        ]);
        Tag::create([
            'name' => 'TO DO',
            'tagtype' => 1,
            'color' => "#dbdeob",
            'note' => "Task without timeline",
            'description' => "To Do is a regular task with no dates. Their sub tasks are all auto-tagged To Do.",
            'show' => 1,
            'organization_id' => $organization->id,
        ]);
        Tag::create([
            'name' => 'PERMANENT',
            'tagtype' => 1,
            'color' => "#dbdeob",
            'note' => "Task or group of tasks that is always active",
            'description' => "Permanent tasks have no dates and progress/completion bar (but their regular sub-tasks can) as it is used as a folder for permanent activities, such as maintenance.",
            'show' => 1,
            'organization_id' => $organization->id,
        ]);
        Tag::create([
            'name' => 'PERIODIC',
            'tagtype' => 1,
            'color' => "#dbdeob",
            'note' => "Tasks that are repeated periodically",
            'description' => "Future feature!Periodic tasks are repeated periodically. Case: task “pay the rent” is repeated every month.Problem: tracking previous tasks.",
            'show' => 1,
            'organization_id' => $organization->id,
        ]);
        Tag::create([
            'name' => 'NEW',
            'tagtype' => 1,
            'color' => "#dbdeob",
            'note' => "Recently created tasks",
            'description' => "This tag is automatically assigned to all tasks created less than X days ago. X can be set individually by every user in settings. Default value = 7 days.",
            'show' => 1,
            'organization_id' => $organization->id,
        ]);
        Tag::create([
            'name' => 'CALL',
            'tagtype' => 1,
            'color' => "#4fa9e8",
            'note' => "Call to a person or a conference with persons",
            'description' => "Call (or other form of distant communication) from person in charge to another person/s from the Person table. It has an extra “call person” attribute, that can be repeatedly added. Besides the date attributes it has also hour : minute attributes.",
            'show' => 1,
            'organization_id' => $organization->id,
        ]);
        Tag::create([
            'name' => 'MEETING',
            'tagtype' => 1,
            'color' => "#4fa9e8",
            'note' => "Meeting with other people",
            'description' => "Same as Call, but for personal meetings.",
            'show' => 1,
            'organization_id' => $organization->id,
        ]);
        Tag::create([
            'name' => 'TRIP',
            'tagtype' => 1,
            'color' => "#4fa9e8",
            'note' => "Trip to a defined location",
            'description' => "It is a trip of one – many persons from location A to location B with possible trip-points between them. It has object.vehicle attribute and time attributes. It also has “kilometers allocated” and “kilometers traveled” attributes.",
            'show' => 1,
            'organization_id' => $organization->id,
        ]);
        Tag::create([
            'name' => 'ERROR',
            'tagtype' => 1,
            'color' => "#8c0d19",
            'note' => "Error in procedures or products",
            'description' => "Regular task, but used for bugfix, etc.",
            'show' => 1,
            'organization_id' => $organization->id,
        ]);
        Tag::create([
            'name' => 'ALARM',
            'tagtype' => 1,
            'color' => "#8c0d19",
            'note' => "Alarm in procedures or products",
            'description' => "Regular task, but used to draw attention to certain task. 
Future feature: Preprogramed alarm behaviors can be set for tasks that will mark task “Alarm”. Case: trip is not finished on time; tool is not returned etc.",
            'show' => 1,
            'organization_id' => $organization->id,
        ]);
        Tag::create([
            'name' => 'QUESTION',
            'tagtype' => 1,
            'color' => "#8c0d19",
            'note' => "Question that requires an answer by person",
            'description' => "A formal question from one person to other person/s. (Basic Q&A can be solved with memo system)
Has extra attribute “Answer” (text box).",
            'show' => 1,
            'organization_id' => $organization->id,
        ]);
        Tag::create([
            'name' => 'CUSTOMER',
            'tagtype' => 1,
            'color' => "#b76d21",
            'note' => "Tag for Persons and Organizations.",
            'description' => "Tag for Persons and Organizations. Used for statistics.",
            'show' => 1,
            'organization_id' => $organization->id,
        ]);

//        TagPerson::create(['tagID'=>$tag->id , 'personID'=>$user->id]);
        
        return $user;
    }
}