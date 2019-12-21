<?php

namespace App\Model;
use App\Helper\Common;
use DB;
use Illuminate\Database\Eloquent\Model;

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
}
