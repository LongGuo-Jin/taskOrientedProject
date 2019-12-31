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

        var newID = updateTask();
        if (newID != -1)
        {
            window.location.href = base_url + "/task/taskCard?task_id=" + newID + "&show_type=regular&message=Success&messageType=success";
        } else {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            toastr.error("failed");
        }
    });

    $("button#taskDetailDelete").on("click", function () {

        if (userRoleId != 1) {
            swal.fire(
                'Warning!',
                'Administrator can only delete.',
                'Warning'
            ).then(function () {
                return;
            });

            return;
        }

        var taskId = $(this).data('taskid');
        var params = "taskID=" + taskId + "&_token=" + $("div.detail-edit input[name=_token]").val();
        var parentId = $(this).data("parentid");

        //confirm what is final subtask.
        $.ajax({
            type:'POST',
            url:'task/isFinalTask',
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
                if (result["result"] == -1) {
                    swal.fire({
                        title: 'This task has sub task.',
                        text: "Do you allow to delete entire sub task?",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',
                        reverseButtons: true
                    }).then(function(result){
                        if (result.value) {
                            deleteTask(params, parentId);
                        }
                    });
                } else {
                    deleteTask(params, parentId);
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
                var fileName = data["fileName"];
                $(".custom-file-label").html(fileName);
            },
            timeout: 10000
        });
    })

    $("div.detail-edit .attach_file").on("click", function () {
        var tmpFileName = $(this).data("tmpfilename");
        window.open(
            base_url + "/uploads/" + tmpFileName,
            '_blank' // <- This is what makes it open in a new window.
        );
    });

    $("div.kt-portlet__head-toolbar a[data-toggle=tab]").on("click", function () {
        $(this).parents("div.column-body").removeClass("col-task-regular");
        $(this).parents("div.column-body").removeClass("col-task-simple");
        $(this).parents("div.column-body").removeClass("col-task-extended");
        $(this).parents("div.column-body").addClass($(this).data("type"));

        $(this).parents("div.content-task").children("div.column-body");
    });

    $("button#budgetAdd").on("click", function () {
        var description = $("input#income_description").val();
        var income = $("input#income").val();
        var params = "description=" + description + "&income=" + income + "&taskID=" + task_id
            + "&_token=" + $("div.detail-edit input[name=_token]").val();

        $.ajax({
            type:'POST',
            url:'task/addBudget',
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
                if (result["result"] == 1) {
                    window.location.href = base_url + "/task/taskCard?task_id=" + task_id + "&show_type=regular" + "&detailTab=budget&message=Success&messageType=success";
                }
            }
        });
    });

    $("button#expensetAdd").on("click", function () {
        var description = $("input#expense_description").val();
        var expense = $("input#expense").val();
        var params = "description=" + description + "&expense=" + expense + "&taskID=" + task_id
            + "&_token=" + $("div.detail-edit input[name=_token]").val();

        $.ajax({
            type:'POST',
            url:'task/addExpense',
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
                if (result["result"] == 1) {
                    window.location.href = base_url + "/task/taskCard?task_id=" + task_id + "&show_type=regular" + "&detailTab=budget&message=Success&messageType=success";
                }
            }
        });
    });

    $("button.quick-add-expense").on("click", function () {

        var description = $("input#quick-expense-title").val();
        var expense = $("input#quick-expense-val").val();
        var params = "description=" + description + "&expense=" + expense + "&taskID=" + task_id
            + "&_token=" + $("div.detail-edit input[name=_token]").val();

        $.ajax({
            type:'POST',
            url:'task/addExpense',
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
                if (result["result"] == 1) {
                    window.location.href = base_url + "/task/taskCard?task_id=" + task_id + "&show_type=regular" + "&detailTab=budget&message=Success&messageType=success";
                }
            }
        });
    });

    if (message["flage"] == 1) {
        showToast();
    }
});

function showToast()
{
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    toastr.success(message["message"]);
}

function deleteTask(params, parentId)
{
    var ret = -1;
    $.ajax({
        type:'POST',
        url:'task/taskCardDelete',
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
            if (result["result"] == 1) {
                if (parentId != "")
                    window.location.href = base_url + "/task/taskCard?task_id=" + parentId + "&show_type=regular&message=Success&messageType=success";
                else
                    window.location.href = base_url + "/task/taskCard?message=Success&messageType=success";
            }
            else if (result["result"] > 1) {
                window.location.href = base_url + "/task/taskCard?message=Success&messageType=success";
            }
            else {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.error("failed");
            }
        }
    });
}

function setColumnType()
{
    //set Tab for task column
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

    //set Tab for task detail
    $("div.detail-edit div.tab-pane").removeClass("active");
    $("div.detail-edit div.kt-portlet__head li.nav-item a").removeClass("active");
    if (detailTab == "budget") {
        $("div.detail-edit div#edit_panel_tab_budget").addClass("active");
        $("div.detail-edit div.kt-portlet__head a#tab_budget").addClass("active");
    }
    else if (detailTab == "statistics") {
        $("div.detail-edit div#edit_panel_tab_statistics").addClass("active");
        $("div.detail-edit div.kt-portlet__head a#tab_statistics").addClass("active");
    }
    else {
        $("div.detail-edit div#edit_panel_tab_information").addClass("active");
        $("div.detail-edit div.kt-portlet__head a#tab_information").addClass("active");
    }
    $("div.task-extand-add input#quick-subtask-title").focus();
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
    var newID = addTask();
    if (newID != -1)
    {
        window.location.href = base_url + "/task/taskCard?task_id=" + newID + "&show_type=regular&message=Success&messageType=success";
    } else {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr.error("failed");
    }
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

    var newID = addSubTask();
    if (newID != -1)
    {
        window.location.href = base_url + "/task/taskCard?task_id=" + task_id + "&show_type=regular&message=Success&messageType=success";
    } else {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr.error("failed");
    }

    function addSubTask()
    {
        var ret = -1;
        var params = "title=" + $("input#quick-subtask-title").val() + "&parentID=" + task_id + "&personID=" + $("select#quick-add-person").val() +
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
