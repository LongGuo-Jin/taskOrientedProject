<?php

namespace App\Http\Middleware;

use App\Model\Task;
use App\PinnedTask;
use Closure;
use App\Model\Tag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
class TagMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        $locale = $user->locale;
//        dd($locale);
        if ($locale != null) {
            Session::put('locale', $locale);
            app()->setlocale(Session::get('locale'));
        }

        $personID = $user->id;
        $role_id = $user->roleID;
        $organization_id = $user->organization_id;

        $tags = Tag::where('organization_id',$organization_id)->where('tagtype','!=' ,3)->where('pinned',1)->get()->toArray();
        $personalTags = Tag::where('person_id',$personID)->where('pinned',1)->get()->toArray();
        $pinnedTasks = PinnedTask::where('personID',$personID)->get()->toArray();
        $pinnedTasks_data = [];
        foreach ($pinnedTasks as $task) {
            $id = $task['taskID'];
            $title = Task::where('ID',$id)->get()->first()->title;
            array_push($pinnedTasks_data,['ID'=>$id,'title'=>$title]);
        }

        View::share('pinnedTags', $tags);
        View::share('pinnedPersonTags', $personalTags);
        View::share('pinnedTasks',$pinnedTasks_data);
        return $next($request);
    }
}
