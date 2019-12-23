$(document).ready(function () {
    $('div.kt-extended-task-item').on('click', function(){
        var offsetTop = $(this).offset().top - 64 - 25;
        $('div#kt_final_sub_task').css('margin-top', offsetTop);
        $('div#kt_final_sub_task').css('display', 'block');
    });

    $('button.addTask').on('click', function () {
            $('div.detail-edit').css('display', 'none');
            $('div.detail-add').css('display', 'block');
        }
    );

    $('select#detail-add-person').on('change', function () {
        var personId = $(this).val();
        var personTag = personTagList[personId];

        $("span#detail-add-personTag").html(personTag);
    });

    $("div.kt-regular-task-item:not(div.selected), div.kt-extended-task-item:not(div.selected), div.kt-simple-task-item:not(div.selected)").on('click', function () {
        $show_type = $(this).data("show_type");
        $task_id = $(this).data("task_id");
        window.location.href = base_url + "/task/taskCard?task_id=" + $task_id + "&show_type=" + $show_type;
    });

    $( window ).resize(function() {
        fixScrollHeight();
    });
    fixScrollHeight();

    if (task_id  != "")
        $("div.detail-edit").css('display', 'block');

    //set display type on each column.
    setColumnType();
});

function setColumnType()
{
    if ($('div.column_0').find('div.selected').length !== 0) {
        $("div.column_0").addClass("col-task-extended");
        $("div.column_1").addClass("col-task-regular");
        $("div.column_2").addClass("col-task-simple");

        $("div.column_0 .tab-pane").removeClass("active");
        $("div#kt_extended_tab_0").addClass("active");
    } else {
        $("div.column_0").addClass("col-task-regular");
        $("div.column_1").addClass("col-task-extended");
        $("div.column_2").addClass("col-task-simple");
    }
}

function getBrowserDimensions() {
    return {
        width: (window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth),
        height: (window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight)
    };
}

function fixScrollHeight() {
    var browser_dims = getBrowserDimensions();
    $scrollHeight = browser_dims.height - 70 - $("div#kt_header").height() - $("div.kt-portlet__head").height();
    $("div.kt-scroll").height($scrollHeight);
    $("div.detail-add div.kt-scroll").height($scrollHeight + $("div.detail-add div.modal-footer").height() - 42);
}

function confirmAddTask()
{
    swal.fire({
        title: 'Are you sure?',
        text: "Do you add new task?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then(function(result){
        if (result.value) {
            var newID = addTask();
            if (newID != -1)
            {
                swal.fire(
                    'Added!',
                    'You have add new task.',
                    'success'
                ).then(function () {
                    window.location.href = base_url + "/task/taskCard?task_id=" + newID + "&show_type=regular";
                });
            } else {
                swal.fire(
                    'Failed',
                    'You can not add new task.',
                    'error'
                );
            }
        }
    });
}

function addTask()
{
    var ret = -1;
    var tagList = "tagList=" + $("select[name=tags]").val();
    var params = $("#task_add_form").serialize() + "&" + tagList;

    $.ajax({
        type:'POST',
        url:'task/taskCardAdd',
        data: params,
        async: false,
        timeout: 5000,
        crossDomain: true,
        beforeSend: function() {
            KTApp.blockPage({
                overlayColor: '#000000',
                type: 'v2',
                state: 'warning',
                size: 'lg',
                opacity: 0.4,
            });
        },
        complete: function(data) {
            KTApp.unblockPage();
        },
        success:function(data) {
            var result = $.parseJSON(data);
            if (result["result"] == 1)
                ret = result["ID"];
        }
    });

    return ret;
}
