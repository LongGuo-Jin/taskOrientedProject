<?php

namespace App\Model;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\Helper\Common;

class Budget extends Model
{
    protected $table = "budget";

    protected $fillable = [
        'ID', 'timestamp', 'personID', 'taskID', 'income', 'description'
    ];

    public function getBudgetByCond($cond)
    {
        $qrBuilder = DB::table($this->table)
            ->leftjoin("users", "budget.personID", "=", "users.id")
            ->leftjoin("task", "budget.taskID", "=", "task.ID")
            ->select("{$this->table}.*", DB::raw("concat(users.nameFamily, ' ', users.nameFirst) as fullName"));

        if (isset($cond["taskID"]) && $cond["taskID"])
            $qrBuilder = $qrBuilder->where("budget.taskID", "=", $cond["taskID"]);
        if (isset($cond["personID"]) && $cond["personID"])
            $qrBuilder = $qrBuilder->where("budget.personID", "=", $cond["personID"]);
        if (isset($cond["entireTree"]))
            $qrBuilder = $qrBuilder->whereIn("budget.taskID", $cond["entireTree"]);

        $ret = $qrBuilder->orderBy('id', 'asc')->get()->toArray();

        return Common::stdClass2Array($ret);
    }

    public function getSumBudget($cond)
    {
        $qrBuilder = DB::table($this->table)->select(DB::raw("sum(income) as sum"));

        if (isset($cond["taskID"]) && $cond["taskID"])
            $qrBuilder = $qrBuilder->where("taskID", "=", $cond["taskID"]);
        if (isset($cond["personID"]) && $cond["personID"])
            $qrBuilder = $qrBuilder->where("personID", "=", $cond["personID"]);
        if (isset($cond["entireTree"]))
            $qrBuilder = $qrBuilder->whereIn("taskID", $cond["entireTree"]);

        $ret = $qrBuilder->get()->toArray();
        $result = Common::stdClass2Array($ret);

        $sum = isset($result[0]['sum']) ? $result[0]['sum']: 0;
        return $sum;
    }

    public function addBudget($budgetData)
    {
        $ret = DB::table($this->table)
            ->insert($budgetData);

        return $ret;
    }
}
