<style>

    div.kt-simple-task-item {
        border-radius: 3px;
        margin: 1.6rem 0.6rem;
        -webkit-box-shadow: 0 1px 2px 1px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        background: white;
    }
    div.kt-simple-task-item>div{
        padding: 6px 0 6px 0;
    }

    div.kt-simple-task-item:hover {
        background: #e8e8e8;
        transition: all 0.5s ease;
    }

    div.kt-simple-task-item:active {
        background: #d8d8d8;
        transition: all 0.2s ease;
    }

</style>

@foreach($tasks as $taskItem)
    <a href="{{route('task.taskCard',['task_id'=>$taskItem['ID']])}}" style="color: black">
        <div class="row kt-simple-task-item " style="border: solid 1px #c5cbc7; background: #e8e8e8;  transition: all 0.5s ease;">
        <?php $tagTask =new \App\TagTask();
            $taskTags =  $tagTask->getTaskTagList($taskItem['ID']);
            $color = '#9d88bf';

            foreach($taskTags as $taskTag) {
                if ($taskTag["tagtype"] != 1 ) {
                    continue;
                }

                if($taskTag['name'] == "PROJECT") {
                    $color = '#302344';
                    break;
                }

                if($taskTag['name'] == "MILESTONE") {
                    $color = '#98b6ea';
                    break;
                }

                if($taskTag['name'] == "TO DO") {
                    $color = '#f7dd6d';
                    break;
                }

                if($taskTag['name'] == "PERMANENT") {
                    $color = '#4fc6a2';
                    break;
                }

                if($taskTag['name'] == "PERIODIC") {
                    $color = '#88e588';
                    break;
                }

                if($taskTag['name'] == "TRIP") {
                    $color = '#a5a3aa';
                    break;
                }
                if($taskTag['name'] == "ERROR") {
                    $color = '#ef6f6f';
                    break;
                }
                if($taskTag['name'] == "ALARM") {
                    $color = '#f4c67d';
                    break;
                }
            }
        ?>

        <div style="text-align: center; font-size: 13pt; padding-top: 10px; width: 10%;background-color: {{$color}};">
            <?php echo($taskItem['status_icon'])?>
        </div>
        <div style="width: 90%; padding: 10px; <?php if ($taskItem['overdue']) echo "background: #fff2f2; !important";?> background-color: white;">
            <div class="row">
                <div class="col-lg-9" style="font-size: 10pt;  display: block;  text-overflow: ellipsis; white-space: nowrap; overflow: hidden; margin-top: auto; margin-bottom: auto;">
                    {{$taskItem['title']}}
                </div>
                <div class="col-lg-3 text-right" style="font-size: 10pt;  display: block;  text-overflow: ellipsis; white-space: nowrap; overflow: hidden; margin-top: auto; margin-bottom: auto;">
                    <x-user-avatar :type="$taskItem['avatarType']" :nameTag="$taskItem['nameTag']" :roleID="$taskItem['roleID']" :color="$taskItem['avatarColor']" />
                </div>
            </div>
        </div>
    </div>
    </a>
@endforeach
