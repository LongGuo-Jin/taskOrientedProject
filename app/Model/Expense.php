<?php

namespace App\Model;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\Helper\Common;

class Expense extends Model
{
    protected $table = "expense";

    protected $fillable = [
        'ID', 'timestamp', 'personID', 'taskID', 'expense', 'description'
    ];

    public function getExpenseByCond($cond)
    {
        $qrBuilder = DB::table($this->table)
            ->leftjoin("users", "expense.personID", "=", "users.id")
            ->leftjoin("task", "expense.taskID", "=", "task.ID")
            ->select("{$this->table}.*", DB::raw("concat(users.nameFamily, ' ', users.nameFirst) as fullName"));

        if (isset($cond["taskID"]) && $cond["taskID"])
            $qrBuilder = $qrBuilder->where("expense.taskID", "=", $cond["taskID"]);
        if (isset($cond["personID"]) && $cond["personID"])
            $qrBuilder = $qrBuilder->where("expense.personID", "=", $cond["personID"]);
        if (isset($cond["entireTree"]))
            $qrBuilder = $qrBuilder->whereIn("expense.taskID", $cond["entireTree"]);

        $ret = $qrBuilder->orderBy('id', 'asc')->get()->toArray();

        return Common::stdClass2Array($ret);
    }

    public function getSumExpense($cond)
    {
        $qrBuilder = DB::table($this->table)->select(DB::raw("sum(expense) as sum"));

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

    public function addExpense($expenseData)
    {
        $ret = DB::table($this->table)
            ->insert($expenseData);

        return $ret;
    }
}
