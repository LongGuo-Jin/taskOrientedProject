<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Helper\Common;
use DB;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'organization_id', 'nameFirst', 'nameFamily','roleID' ,'addressID','administrativeID' , 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function Organization() {
        return $this->belongsTo(Organization::class,'organization_id');
    }

    //get person in a organization
    public function getPersonList()
    {
        $user = auth()->user();
        $organization_id = $user->Organization()->get()->first()->id;
        $ret = DB::table($this->table)->where('organization_id',$organization_id)->orderBy('id', 'asc')->get()->toArray();

        return Common::stdClass2Array($ret);
    }

    // get person data from id.
    public function getPerson($id)
    {
        $ret = DB::table($this->table)->where('id', $id)->get()->toArray();

        return Common::stdClass2Array($ret);
    }

    //get people who is same role with authed user
    public function getrolePersonList()
    {
        $PersonInfo = auth()->user();
        $roleId = $PersonInfo->roleID;

        if ($roleId == Common::constant("role.proManager") || $roleId == Common::constant("role.foreman")) {
            $roleId = Common::constant("role.foreman") + 1;
        } else {
            $roleId = $roleId + 1;
        }

        $ret = DB::table($this->table)->where('organization_id',$PersonInfo->organization_id)->where("roleID", "=", $roleId)->orderBy('id', 'asc')->get()->toArray();
        $result  = Common::stdClass2Array($ret);
        array_push($result , $PersonInfo->toArray());
        return $result;
    }
}
