<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Model\Task;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OverdueTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail for overdue Tasks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all()->toArray();
        $Task = new Task();
        foreach ($users as $user) {
            $id = $user['id'];

            $tasks = Task::where('personID',$id)
                        ->orWhere('taskCreatorID',$id)->get();
            $message = '';
            $messages = [];
            foreach($tasks as $task) {
                $statusID = $task->statusID;
                if ($statusID == '1' || $statusID == '2' || $statusID == '3') {
                    $datePlanEnd = $task->datePlanEnd;
                    $today = strtotime('today');
                    $endDate = strtotime('-1 day',strtotime($datePlanEnd));

                    if ($today == $endDate) {
                        $title = $task->title;
                        $pathArr = $Task->getPathName($task->ID);

                        array_push($messages,$pathArr);
                    }
                }
            }

            if (count($messages) > 0) {
                try {
                    Log::debug($message);
                    Mail::send('mail.overdue', ['subject'=>'Overdue Tasks' ,'messages' => $messages], function($message) use ($user)  {
                        $message->to($user['email'],$user['nameFirst'].' '.$user['nameMiddle'].' '.$user['nameFamily'])->subject('Overdue Tasks from TaskOrientedProjects');
                        $message->from('alert@taskorientedprojects.com');
                    });
                } catch (Exception $exception) {
                    Log::debug(__FUNCTION__.$exception->getMessage());
                }
            }
        }

        return 0;
    }
}
