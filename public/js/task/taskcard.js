$(document).ready(function () {
    $('div.kt-extended-task-item').on('click', function(){
        var offsetTop = $(this).offset().top - 64 - 25;
        $('div#kt_final_sub_task').css('margin-top', offsetTop);
        $('div#kt_final_sub_task').css('display', 'block');
    });

    $('button.addTask').on('click', function () {
        var ret = 1;
        var parentId = $(this).data("parent_id");
        if (parentId == "")
            ret = -1;

        if (ret == -1 && userRoleId != 1) {
            swal.fire(
                'Warning',
                'You can not add task in root level.',
                'warning'
            );
            return ;
        }
        $('div.detail-add input#add_parentID').val(parentId);
        $('div.detail-edit').css('display', 'none');
        $('div.detail-add').css('display', 'block');

        }
    );

    $('select#detail-add-person').on('change', function () {
        var personId = $(this).val();
        var personTag = personTagList[personId];

        $("span#detail-add-personTag").html(personTag);
    });

    $('select#quick-add-person').on('change', function () {
        var personId = $(this).val();
        var personTag = personTagList[personId];

        $("span#quick-add-personTag").html(personTag);
    });

    $("div.kt-regular-task-item, div.kt-extended-task-item:not(div.selected), div.kt-simple-task-item").on('click', function () {
        $show_type = $(this).data("show_type");
        $task_id = $(this).data("task_id");
        window.location.href = base_url + "/task/taskCard?task_id=" + $task_id + "&show_type=" + $show_type;
    });

    $("button#taskDetailUpdate").on("click", function () {
        if ($(this).hasClass("disabled"))
            return;

        swal.fire({
            title: 'Are you sure?',
            text: "Do you update task?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then(function(result){
            if (result.value) {
                var newID = updateTask();
                if (newID != -1)
                {
                    swal.fire(
                        'Updated!',
                        'You have updated task.',
                        'success'
                    ).then(function () {
                        window.location.href = base_url + "/task/taskCard?task_id=" + newID + "&show_type=regular";
                    });
                } else {
                    swal.fire(
                        'Failed',
                        'You can not updated task.',
                        'error'
                    );
                }
            }
        });
    });

    //feature about edit-detail

    $("div.detail-edit .detail-information-task-name ,div.detail-edit  .detail-information-staus-content" +
        ",div.detail-edit .detail-information-person-content, div.detail-edit .detail-information-priority-content" +
        ", div.detail-edit .detail-information-weight-content" +
        ", div.detail-edit .detail-start-date" +
        ", div.detail-edit .detail-end-date" +
        ", div.detail-edit .detail-actual-start-date" +
        ", div.detail-edit .detail-actual-end-date" +
        ", div.detail-edit .detail-edit-tags").on("click", function () {
        $("button#taskDetailUpdate").removeClass("disabled");
        $(this).children().eq(0).css("display", "none");
        $(this).children().eq(1).css("display", "block");
        $(this).children().eq(1).focus();
    });

    $("div.detail-information-description").on("click", function () {
        $("button#taskDetailUpdate").removeClass("disabled");
        $(this).children().eq(1).css("display", "none");
        $(this).children().eq(2).css("display", "block");
        $(this).children().eq(2).focus();
    });

    $("div.detail-edit input[name=memo]").on("click", function () {
        $("button#taskDetailUpdate").removeClass("disabled");
    });

    $( window ).resize(function() {
        fixScrollHeight();
    });
    fixScrollHeight();

    if (task_id  != "")
        $("div.detail-edit").css('display', 'block');

    //set display type on each column.
    setColumnType();

    $("input#customFile").on("change", function () {
        var form = document.forms.namedItem("task_update_form"); // high importance!, here you need change "yourformname" with the name of your form
        var formdata = new FormData(form); // high importance!

        $("button#taskDetailUpdate").removeClass("disabled");
        $.ajax({
            async: true,
            type: "POST",
            dataType: "json", // or html if you want...
            contentType: false, // high importance!
            url: 'task/fileUpload', // you need change it.
            data: formdata, // high importance!
            processData: false, // high importance!
            success: function (data) {
                $("input[name=fileInfo]").val(JSON.stringify(data));
            },
            timeout: 10000
        });
    })

    $("div.detail-edit .attach_file").on("click", function () {
        var tmpFileName = $(this).data("tmpfilename");
        window.location.href = base_url + "/uploads/" + tmpFileName;
    });
});

function setColumnType()
{
    $("div.parent_selected").parents("div.column-body").addClass("col-task-regular");
    $("div.selected").parents("div.column-body").addClass("col-task-extended");
    $("div.selected").parents("div.column-body").next("div.column-body").addClass("col-task-simple");

    if ($("div.selected").length == 0)
        $("div[data-column_id = 0]").addClass("col-task-regular");

    var regColumId = $("div.col-task-regular").data("column_id");
    var extendedColumId = $("div.col-task-extended").data("column_id");
    var simpleColumId = $("div.col-task-simple").data("column_id");

    $("div.col-task-regular").find("div.tab-pane").removeClass("active");
    $("div.col-task-regular").find("div#kt_regular_tab_" + regColumId).addClass("active");
    $("div.col-task-extended").find("div.tab-pane").removeClass("active");
    $("div.col-task-extended").find("div#kt_extended_tab_" + extendedColumId).addClass("active");
    $("div.col-task-simple").find("div.tab-pane").removeClass("active");
    $("div.col-task-simple").find("div#kt_simple_tab_" + simpleColumId).addClass("active");
}

function reCalcWidth() {
    var regular = 5, extended = 3, simple = 2;
    var regularW = regular/(regular + extended + simple) * 100;
    var extendW = extended/(regular + extended + simple) * 100;
    var simpleW = simple/(regular + extended + simple) * 100;

    $(".col-task-extend").css("-ms-flex", "0 0 " + extendW + "%");
    $(".col-task-extend").css("flex", "0 0 " + extendW + "%");
    $(".col-task-extend").css("max-width", "0 0 " + extendW + "%");

    $(".col-task-regular").css("-ms-flex", "0 0 " + regularW + "%");
    $(".col-task-regular").css("flex", "0 0 " + regularW + "%");
    $(".col-task-regular").css("max-width", "0 0 " + regularW + "%");

    $(".col-task-simple").css("-ms-flex", "0 0 " + simpleW + "%");
    $(".col-task-simple").css("flex", "0 0 " + simpleW + "%");
    $(".col-task-simple").css("max-width", "0 0 " + simpleW + "%");
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
    $("div.detail-add div.kt-scroll, div.detail-edit div.kt-scroll").height($scrollHeight + $("div.detail-add div.modal-footer").height() - 42);
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

function updateTask()
{
    var ret = -1;
    var tagList = "tagList=" + $("div.detail-edit select[name=tags]").val();
    var params = $("#task_update_form").serialize() + "&" + tagList;

    $.ajax({
        type:'POST',
        url:'task/taskCardUpdate',
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

$("button.quick-add-task").on("click", function () {
    var parentId = $(this).data("parent_id");

    swal.fire({
        title: 'Are you sure?',
        text: "Do you add new subtask?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then(function(result){
        if (result.value) {
            var newID = addSubTask();
            if (newID != -1)
            {
                swal.fire(
                    'Added!',
                    'You have add new sub task.',
                    'success'
                ).then(function () {
                    window.location.href = base_url + "/task/taskCard?task_id=" + newID + "&show_type=regular";
                });
            } else {
                swal.fire(
                    'Failed',
                    'You can not add new sub task.',
                    'error'
                );
            }
        }
    });

    function addSubTask()
    {
        var ret = -1;
        var params = "parentID=" + parentId + "&title=" + $("input#quick-title").val() + "&parentID=" + task_id + "&personID=" + $("select#quick-add-person").val() +
            "&_token=" + $("input#quick_token").val();

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
})

function changeUserId()
{
    var userId = $("select#select_user").val();
    window.location.href = base_url + "/task/setLoginUser?user_id=" + userId;
}
