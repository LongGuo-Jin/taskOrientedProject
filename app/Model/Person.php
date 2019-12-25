<?php

namespace App\Model;
use App\Helper\Common;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Person extends Model
{
    protected $table = "person";

    protected $fillable = [
        'ID', 'nameFirst', 'nameMiddle', 'nameFamily', 'roleID', 'addressID', 'administrativeID'
    ];

    public function getPersonList()
    {
        $ret = DB::table($this->table)->orderBy('id', 'asc')->get()->toArray();

        return Common::stdClass2Array($ret);
    }

    public function getPerson($id)
    {
        $ret = DB::table($this->table)->where('id', $id)->get()->toArray();

        return Common::stdClass2Array($ret);
    }

    public function getrolePersonList()
    {
        $Person = new Person();
        $personInfo = $Person->getPerson(Session::get('login_person_id'));
        $roleId = $personInfo[0]["roleID"];
        if ($roleId == Common::constant("role.proManager") || $roleId == Common::constant("role.foreman"))
            $roleId = Common::constant("role.foreman") + 1;
        else {
            $roleId = $roleId + 1;
        }

        $ret = DB::table($this->table)->where("roleID", "=", $roleId)->orderBy('id', 'asc')->get()->toArray();
        $result  = array_merge($personInfo, Common::stdClass2Array($ret));

        return $result;
    }
}
