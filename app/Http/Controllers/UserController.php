<?php

namespace App\Http\Controllers;

use App\Model\Person;
use App\Model\Tag;
use App\Model\TagPerson;
use App\Model\Task;
use App\Organization;
use App\Time;
use App\User;
use App\Filter;
use Illuminate\Http\Request;
use App\Helper\Common;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

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

        return view('user.index',['users'=>$users , 'organization' => $organization->organization]);
    }

    public function AddUser() {
        $organization_id = auth()->user()->Organization()->first()->id;
        $organization = Organization::findOrFail($organization_id);
        return view('user.create' , ['organization' => $organization->organization]);
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
            'nameTag' => $fields['nameFirst'][0].$fields['nameFamily'][0],
            'organization' => $organization,
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
            'roleID' => $request->roleID,
        ]);

        Filter::create([
            'user_id'=>$user['id']
        ]);

//        dd($user);
//        $person = Person::create([
//            'nameFirst' => $fields['nameFirst'],
//            'nameFamily' => $fields['nameFamily'],
//            'organization' => $organization,
//            'roleID' => $request->roleID,
//            'userID' => $user->id,
//        ]);
//        $tag = Tag::create([
//            'name' => $user->nameFirst[0].$user->nameFamily[0],
//            'tagtype' => 4,
//            'color' => 1,
//            'note' => 1,
//        ]);

//        TagPerson::create(['tagID'=>$tag->id , 'personID'=>$user->id]);

        return redirect('user');
    }

    public function EditUser(Request $request) {
        $organization_id = auth()->user()->Organization()->first()->id;
        $organization = Organization::findOrFail($organization_id);

        $id = $request->id;
        $users = User::where('id',$id)->firstOrFail();

        return view('user.edit',['user'=>$users,'organization' => $organization->organization]);
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
        return redirect('user');
    }

    public function AskPassword(Request $request) {
        $pwd = $request->password;
        $password = auth()->user()->password;
        if (Hash::check($pwd, $password)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function People(Request $request) {
        $orgID = auth()->user()->organization_id;
        $selected_Id = $request->select;
        $alpha_filter = $request->alpha;
        $select_person = null;
        $Tag = new Tag();
        $tagList = $Tag->getTagList();
        $peopleTag = new TagPerson();
        $PeopleTagList = [];
        if ($selected_Id)
            $PeopleTagList = $peopleTag->getPersonTagList($selected_Id);

        $statistics = Task::where('personID',$selected_Id)->get()->toArray();
        $times = Time::where('personID',$selected_Id)->get()->toArray();

        $workTime = $this->GetWorkTime($times);
        $statistics = $this->GetStatistics($statistics);

        if (isset($selected_Id) && $selected_Id !== '') {
            $select_person = User::leftJoin('organizations','organizations.id','=','users.organization_id')->select('users.*','organizations.organization')->where('users.id',$selected_Id)->get()->first();
        }

        $people = User::leftJoin('organizations','organizations.id','=','users.organization_id')->select('users.*','organizations.organization')->where('users.organization_id',$orgID)->get()->toArray();

        $alpha_filter = !isset($alpha_filter)?'All':($alpha_filter==''?'All':$alpha_filter);
        $people = $this->GetPeopleByAlphaAndCategory($people,$alpha_filter);

        return view('people.index',
            [
                'people' => $people,
                'selected_person' => $select_person,
                'alpha' => $alpha_filter,
                'selectedID'=>$selected_Id,
                'workTime' => $workTime,
                'statistics' => $statistics,
                'tagList' => $tagList,
                'peopleTagList' => $PeopleTagList
            ]
        );
    }

    public function AddPerson(Request $request) {
        $orgId = $request->input('organizationID');
        $tags = $request->input('personTags');

        $fields = $this->validate($request, [
            'nameFirst' => ['required', 'string', 'max:255'],
            'nameFamily' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $data = [
            'nameFirst' => $request->input('nameFirst'),
            'nameMiddle' => $request->input('nameMiddle'),
            'nameFamily' => $request->input('nameFamily'),
            'nameTag' => $request->input('nameFirst')[0].$request->input('nameFamily')[0],
            'gender' => $request->input('gender'),
            'birthday' => $request->input('birthday'),
            'nationality' => $request->input('nationality'),
            'address' => $request->input('address'),
            'country' => $request->input('country'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'messenger' => $request->input('messenger'),
            'companyID' => $request->input('companyID'),
            'nationalID' => $request->input('nationalID'),
            'bankAccount' => $request->input('bankAccount'),
            'bank' => $request->input('bank'),
            'swift_bic' => $request->input('swift_bic'),
            'family' => $request->input('family'),
            'roleID' => $request->input('roleID'),
            'description' => $request->input('description'),
            'password' => Hash::make($request->input('password')),
        ];

        $user = Organization::findOrFail($orgId)->Users()->create($data);
        if ($tags != "") {
            $tags = explode(",",$tags);
            foreach($tags as $tag) {
                TagPerson::create(['personID'=>$user->id,'tagID'=>$tag]);
            }
        }
        return redirect('people?select='.$user->id);

    }

    public function UpdatePeople(Request $request) {
        $id = $request->input('selectedID');
        $tags = $request->input('tags');

        if ($tags != "") {
            TagPerson::where('personID',$id)->delete();
            $tags = explode(",",$tags);

            foreach($tags as $tag) {
                TagPerson::create(['personID'=>$id,'tagID'=>$tag]);
            }

        }

        $data = [
            'nameFirst' => $request->input('nameFirst'),
            'nameMiddle' => $request->input('nameMiddle'),
            'nameFamily' => $request->input('nameFamily'),
            'gender' => $request->input('gender'),
            'birthday' => $request->input('birthday'),
            'nationality' => $request->input('nationality'),
            'address' => $request->input('address'),
            'country' => $request->input('country'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'messenger' => $request->input('messenger'),
            'companyID' => $request->input('companyID'),
            'nationalID' => $request->input('nationalID'),
            'bankAccount' => $request->input('bankAccount'),
            'bank' => $request->input('bank'),
            'swift_bic' => $request->input('swift_bic'),
            'family' => $request->input('family'),
            'description' => $request->input('description'),
        ];
        User::where('id',$id)->update($data);
        return redirect()->back();

    }

    public function GetPeopleByAlphaAndCategory($people,$alpha) {
        $filtered_people = array();
        $employee = [];
        $employee_count = 0;
        $partner = [];
        $partner_count = 0;
        $customer = [];
        $customer_count = 0;
        $contact = [];
        $contact_count = 0;
        foreach ($people as $person) {
            if ($person['roleID'] == 1 || $person['roleID'] == 2 || $person['roleID'] == 4) {
                $employee_count ++;
            }
            if ($person['roleID'] == 5) {
                $partner_count ++;
            }
            if ($person['roleID'] == 6) {
                $customer_count++;
            }
            if ($person['roleID'] == 7) {
                $contact_count++;
            }
            if ($alpha=='All' || strtoupper($person['nameFirst'])[0] === $alpha) {
                if ($person['roleID'] == 1 || $person['roleID'] == 2 || $person['roleID'] == 4) {
                    array_push($employee,$person);
                }
                if ($person['roleID'] == 5) {
                    array_push($partner,$person);
                }
                if ($person['roleID'] == 6) {
                    array_push($customer,$person);
                }
                if ($person['roleID'] == 7) {
                    array_push($contact,$person);
                }
            }
        }

        $filtered_people['employee'] = $employee;
        $filtered_people['partner'] = $partner;
        $filtered_people['customer'] = $customer;
        $filtered_people['contact'] = $contact;
        $filtered_people['employee_count'] = $employee_count;
        $filtered_people['partner_count'] = $partner_count;
        $filtered_people['customer_count'] = $customer_count;
        $filtered_people['contact_count'] = $contact_count;
        return $filtered_people;
    }

    public function GetWorkTime($date) {
        $workTime = [
            'today'=>0,
            'week'=>0,
            'month'=>0
        ];
        $today = date('Y-m-d');
        $monday = date('Y-m-d',strtotime('last monday'));
        $first_day = date('Y-m-d',strtotime(getdate()['year'].'-'.getdate()['month']));

        $lastMonths = [];
        $last_month1 = getdate(strtotime('-1 month'))['month'];
        $last_month2 = getdate(strtotime('-2 month'))['month'];
        $last_month3 = getdate(strtotime('-3 month'))['month'];
        $last_year1 = getdate(strtotime('-1 month'))['year'];
        $last_year2 = getdate(strtotime('-2 month'))['year'];
        $last_year3 = getdate(strtotime('-3 month'))['year'];
        $lastMonths[$last_month1.' '.$last_year1] = 0;
        $lastMonths[$last_month2.' '.$last_year2] = 0;
        $lastMonths[$last_month3.' '.$last_year3] = 0;
        foreach($date as $item) {
            $workDate = date('Y-m-d',strtotime($item['workDate']));
            $workMonth = getdate(strtotime($item['workDate']))['month'];
            $workYear = getdate(strtotime($item['workDate']))['year'];

            if ($workMonth == $last_month1 && $last_year1 == $workYear) {
                $lastMonths[$last_month1.' '.$last_year1] += $item['timeSpent'];
            }
            if ($workMonth == $last_month2 && $last_year2 == $workYear) {
                $lastMonths[$last_month2.' '.$last_year2] += $item['timeSpent'];
            }
            if ($workMonth == $last_month3 && $last_year3 == $workYear) {
                $lastMonths[$last_month3.' '.$last_year3] += $item['timeSpent'];
            }
            if ($workDate == $today) {
                $workTime['today'] += $item['timeSpent'];
            }
            if ($workDate <= $today && $workDate >= $monday) {
                $workTime['week'] += $item['timeSpent'];
            }
            if ($workDate <= $today && $workDate >= $first_day) {
                $workTime['month'] += $item['timeSpent'];
            }
        }
        foreach ($lastMonths as $index => $item) {
            $workTime[$index] = $item;
        }

        return $workTime;
    }

    public function GetStatistics($data) {
        $statistics = [
            'today'=>[
                'created'=>0,
                1 => 0,2 => 0,3 => 0,  4 => 0,  5 => 0, 6 => 0,7 => 0,8 => 0,9 => 0,10 => 0],
            'week'=>[
                'created'=>0,
                1 => 0,2 => 0,3 => 0,  4 => 0,  5 => 0, 6 => 0,7 => 0,8 => 0,9 => 0,10 => 0],
            'month'=>[
                'created'=>0,
                1 => 0,2 => 0,3 => 0,  4 => 0,  5 => 0, 6 => 0,7 => 0,8 => 0,9 => 0,10 => 0],

        ];

        $today = date('Y-m-d');
        $monday = date('Y-m-d',strtotime('last monday'));
        $first_day = date('Y-m-d',strtotime(getdate()['year'].'-'.getdate()['month']));

        $lastMonths = [];
        $last_month1 = getdate(strtotime('-1 month'))['month'];
        $last_month2 = getdate(strtotime('-2 month'))['month'];
        $last_month3 = getdate(strtotime('-3 month'))['month'];
        $last_year1 = getdate(strtotime('-1 month'))['year'];
        $last_year2 = getdate(strtotime('-2 month'))['year'];
        $last_year3 = getdate(strtotime('-3 month'))['year'];
        $lastMonths[$last_month1.' '.$last_year1] = [
            'created'=>0,
            1 => 0,2 => 0,3 => 0,  4 => 0,  5 => 0, 6 => 0,7 => 0,8 => 0,9 => 0,10 => 0];
        $lastMonths[$last_month2.' '.$last_year2] = [
            'created'=>0,
            1 => 0,2 => 0,3 => 0,  4 => 0,  5 => 0, 6 => 0,7 => 0,8 => 0,9 => 0,10 => 0];
        $lastMonths[$last_month3.' '.$last_year3] = [
            'created'=>0,
            1 => 0,2 => 0,3 => 0,  4 => 0,  5 => 0, 6 => 0,7 => 0,8 => 0,9 => 0,10 => 0];

        foreach($data as $item) {
            $workDate = date('Y-m-d',strtotime($item['updateAt']));
            $workMonth = getdate(strtotime($item['updateAt']))['month'];
            $workYear = getdate(strtotime($item['updateAt']))['year'];

            if ($workMonth == $last_month1 && $last_year1 == $workYear) {
                $lastMonths[$last_month1.' '.$last_year1]['created'] ++;
                if (!isset($lastMonths[$last_month1.' '.$last_year1][$item['statusID']])) {
                    $lastMonths[$last_month1.' '.$last_year1][$item['statusID']] = 0;
                } else {
                    $lastMonths[$last_month1 . ' ' . $last_year1][$item['statusID']]+=1;
                }
            }

            if ($workMonth == $last_month2 && $last_year2 == $workYear) {
                $lastMonths[$last_month2.' '.$last_year2]['created'] ++;
                if (!isset($lastMonths[$last_month2.' '.$last_year2][$item['statusID']])) {
                    $lastMonths[$last_month2.' '.$last_year2][$item['statusID']] = 0;
                } else {
                    $lastMonths[$last_month2 . ' ' . $last_year2][$item['statusID']]+=1;
                }
            }

            if ($workMonth == $last_month3 && $last_year3 == $workYear) {
                $lastMonths[$last_month3.' '.$last_year3]['created'] ++;
                if (!isset($lastMonths[$last_month3.' '.$last_year3][$item['statusID']])) {
                    $lastMonths[$last_month3.' '.$last_year3][$item['statusID']] = 0;
                } else {
                    $lastMonths[$last_month3 . ' ' . $last_year3][$item['statusID']]+=1;
                }
            }

            if ($workDate == $today) {
                $statistics['today']['created'] ++;
                if (!isset($statistics['today'][$item['statusID']])) {
                    $statistics['today'][$item['statusID']] = 0;
                } else {
                    $statistics['today'][$item['statusID']]++;
                }
            }

            if ($workDate <= $today && $workDate >= $monday) {
                $statistics['week']['created'] ++;
                if (!isset($statistics['week'][$item['statusID']])) {
                    $statistics['week'][$item['statusID']] = 0;
                } else {
                    $statistics['week'][$item['statusID']]++;
                }
            }

            if ($workDate <= $today && $workDate >= $first_day) {
                $statistics['month']['created'] ++;
                if (!isset($statistics['month'][$item['statusID']])) {
                    $statistics['month'][$item['statusID']] = 0;
                } else {
                    $statistics['month'][$item['statusID']]++;
                }
            }
        }


        foreach ($lastMonths as $item => $eachMonth) {
            if ($eachMonth['created'] == 0) {
                $lastMonths[$item]['success'] = 0;
            } else {
                $lastMonths[$item]['success'] = ($eachMonth['4'] + $eachMonth[7] - $eachMonth[5])/$eachMonth['created'];
            }
            $statistics[$item] = $lastMonths[$item];
        }

        if ($statistics['today']['created'] == 0) {
            $statistics['today']['success'] = 0;
        } else {
            $statistics['today']['success'] = ($statistics['today'][4] + $statistics['today'][7] - $statistics['today'][5])/$statistics['today']['created'];
        }
        if ($statistics['week']['created'] == 0) {
            $statistics['week']['success'] = 0;
        } else {
            $statistics['week']['success'] = ($statistics['week'][4] + $statistics['week'][7] - $statistics['week'][5])/$statistics['week']['created'];
        }
        if ($statistics['month']['created'] == 0) {
            $statistics['month']['success'] = 0;
        } else {
            $statistics['month']['success'] = ($statistics['month'][4] + $statistics['month'][7] - $statistics['month'][5])/$statistics['month']['created'];
        }

        return $statistics;
    }

}