let sec = 0;
let min = 0;
let hour = 0;
let timer;
$(document).ready(function () {

    $('#filter_manage').on('click', function(e){

        if (document.getElementById('statusOrderMenu').contains(e.target) ||
            document.getElementById('priorityOrderMenu').contains(e.target) ||
            document.getElementById('weightOrderMenu').contains(e.target) ||
            document.getElementById('dateOrderMenu').contains(e.target) ||
            document.getElementById('workTimeOrderMenu').contains(e.target) ||
            document.getElementById('budgetOrderMenu').contains(e.target)) {
        } else {
            $('.task-order-item').parent().find('.dropdown-menu').hide();
        }
    });

    $('div.kt-extended-task-item').on('click', function(){
        var offsetTop = $(this).offset().top - 64 - 25;
        $('div#kt_final_sub_task').css('margin-top', offsetTop);
        $('div#kt_final_sub_task').css('display', 'block');
    });

    $('.kt-portlet__head-toolbar .dropdown .dropdown-menu .dropdown-item').on('click',function(){
        let tab = $(this).attr('href');
        let element = tab+ ' .selected';
        let targetTask = $(tab);
        let parentTask = targetTask.parents('.kt-scroll');
        parentTask.scrollTop(0);

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
            url:'isFinalTask',
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
                    swal.fire({
                        title: 'Are u sure to delete this task?',
                        text: "",
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
                }
            }
        });
    });

    $("button#startCounter").on("click",function(){
        sec = 0; min = 0; hour = 0;
        timer = setInterval(WorkTimeCounter, 1000)
        $("button#startCounter").hide();
        $("button#stopCounter").show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $("button#stopCounter").on("click",function(){
        clearInterval(timer)
        let newID = UpdateWorkTime();
        console.log(newID,"successTaskID");
        if (newID != "-1")
        {
            console.log(newID,"successTaskID");
            window.location.href = base_url + "/task/taskCard?task_id=" + newID + "&show_type=regular&message=Success&messageType=success";
        } else {
            console.log(newID,"successTaskID");
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
        $("button#startCounter").show();
        $("button#stopCounter").hide();

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
            url: 'fileUpload', // you need change it.
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

        if ($(this).data("type") == "col-task-extended")
            $(this).parents("div.kt-portlet__head-toolbar").find("a[data-toggle=dropdown]").html("<i class=\"la flaticon-background\"></i>");
        else if ($(this).data("type") == "col-task-regular")
            $(this).parents("div.kt-portlet__head-toolbar").find("a[data-toggle=dropdown]").html("<i class=\"flaticon-laptop\"></i>");
        else if ($(this).data("type") == "col-task-simple")
            $(this).parents("div.kt-portlet__head-toolbar").find("a[data-toggle=dropdown]").html("<i class=\"fa fa-align-justify\"></i>");
    });

    $("button#budgetAdd").on("click", function () {
        var description = $("input#income_description").val();
        var income = $("input#income").val();
        var params = "description=" + description + "&income=" + income + "&taskID=" + task_id
            + "&_token=" + $("div.detail-edit input[name=_token]").val();

        $.ajax({
            type:'POST',
            url:'addBudget',
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
            url:'addExpense',
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
            url:'addExpense',
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

    $("button#addAllocationTime").on('click',function(){
        let workHour = $("#allocationHour").val();
        let workMin = $("#allocationMin").val();
        let description =  $('#allocationDescription').val();
        let params = "description="+ description +"&hour=" + workHour + "&min=" + workMin + "&taskID=" + task_id + "&personID=" + person_id;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:base_url+'/addAllocationTime',
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
                if (result["result"] === 1) {
                    window.location.href = base_url + "/task/taskCard?task_id=" + task_id + "&show_type=regular&message=Success&messageType=success";
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

    });

    $("button#addWorkHour").on("click",function(){
        let workHour = $("#workHour").val();
        let workMin = $("#workMin").val();
        let description =  $('#workDescription').val();
        let params = "description="+ description +"&hour=" + workHour + "&min=" + workMin + "&taskID=" + task_id + "&personID=" + person_id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:base_url+'/addWorkTime',
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
                if (result["result"] === 1) {
                    window.location.href = base_url + "/task/taskCard?task_id=" + task_id + "&show_type=regular&message=Success&messageType=success";
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

    });

    if (message["flage"] == 1) {
        showToast();
    }

    /*
     * focus on memo if it is unread
     */
    let notifications = memoNotification.split(',');
    console.log('#blink_mail_icon_'+task_id,"---------------");
    $('.kt-extended-task-item #blink_mail_icon_'+task_id).removeClass('blink_mail_icon');
    $('.kt-regular-task-item #blink_mail_icon_'+task_id).removeClass('blink_mail_icon');
    if (notifications.includes(task_id)) {
        $('input#detail-information-task-memos_input').focus();
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
        url:'taskCardDelete',
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
    if (showType === "regular") {
        $("div.selected").parents("div.column-body").addClass("col-task-regular");
    } else if (showType === 'extended') {
        $("div.selected").parents("div.column-body").addClass("col-task-extended");
    } else {
        $("div.selected").parents("div.column-body").addClass("col-task-simple");
    }
    // $("div.selected").parents("div.column-body").addClass("col-task-regular");
    $("div.selected").parents("div.column-body").next("div.column-body").addClass("col-task-simple");

    if ($("div.selected").length == 0)
        $("div[data-column_id = 0]").addClass("col-task-regular");

    let regColumns = $.find("div.col-task-regular");
    let extendedColumns = $.find("div.col-task-extended");
    let simpleColumns = $.find("div.col-task-simple");
    // var regColumId = $("div.col-task-regular").data("column_id");
    // var extendedColumId = $("div.col-task-extended").data("column_id");
    // var simpleColumId = $("div.col-task-simple").data("column_id");

    $("div.col-task-regular").find("div.tab-pane").removeClass("active");
    $("div.col-task-regular").each(function(){
        let regColumId = $(this).data('column_id');
        $("div.col-task-regular").find("div#kt_regular_tab_" + regColumId).addClass("active");
    });
    $("div.col-task-regular div.kt-portlet__head-toolbar a[data-toggle=dropdown]").html("<i class=\"flaticon-laptop\"></i>");
    $("div.col-task-extended").find("div.tab-pane").removeClass("active");
    $("div.col-task-extended").each(function(){
        let extendedColumId = $(this).data('column_id');
        $("div.col-task-extended").find("div#kt_extended_tab_" + extendedColumId).addClass("active");
    });

    $("div.col-task-extended div.kt-portlet__head-toolbar a[data-toggle=dropdown]").html("<i class=\"la flaticon-background\"></i>");
    $("div.col-task-simple").find("div.tab-pane").removeClass("active");
    $("div.col-task-simple").each(function(){
        let simpleColumId = $(this).data('column_id');
        $("div.col-task-simple").find("div#kt_simple_tab_" + simpleColumId).addClass("active");
    });

    $("div.col-task-simple div.kt-portlet__head-toolbar a[data-toggle=dropdown]").html("<i class=\"fa fa-align-justify\"></i>");

    //set Tab for task detail
    $("div.detail-edit div.tab-pane").removeClass("active");
    $("div.detail-edit div.kt-portlet__head li.nav-item a").removeClass("active");
    if (detailTab == "time") {
        $("div.detail-edit div#edit_panel_tab_time").addClass("active");
        $("div.detail-edit div.kt-portlet__head a#tab_time").addClass("active");
    }
    else if (detailTab == "budget") {
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
    // $("div.task-extand-add input#quick-subtask-title").focus();
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
        url:'taskCardAdd',
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
    let ret = -1;
    let tagList = "tagList=" + $("div.detail-edit select[name=tags]").val();
    let params = $("#task_update_form").serialize() + "&" + tagList;

    console.log(tagList,"------------>parameter lists");

    $.ajax({
        type:'POST',
        url:'taskCardUpdate',
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
            url:'taskCardAdd',
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

function WorkTimeCounter() {

    sec ++;
    if ( sec > 59) {
        min ++;
        sec = 0;
        if (min > 59) {
            hour ++;
            min = 0;
        }
    }
    let timeText = hour < 10?"0"+hour:hour;
    timeText+=":";
    timeText += min < 10?"0"+min:min;
    timeText+=":";
    timeText += sec < 10?"0"+sec:sec;
    $("#workTimeCounterText").text(timeText);
    if (sec % 30 === 0) {
        $.ajax({
            type:'POST',
            url:base_url+'/shake',
            data: [],
            async: false,
            timeout: 5000,
            crossDomain: true,
            success:function(data) {

            },
            failed: function (err) {

            }
        });
    }
}



function UpdateWorkTime()
{
    let ret = -1;
    let timeValue = hour +  min/60.0;
    let params = $("#task_update_form").serialize() + "&" + "workTime="+timeValue;

    $.ajax({
        type:'POST',
        url:'taskWorkTimeUpdate',
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
            let result = $.parseJSON(data);
            ret = result["result"];
        }
    });

    return ret;
}

function StatusFilter(object, index) {
    let val = $("#statusFilter").val();
    let value='';
    for (let i = 0; i < val.length; i ++) {
        if (i === index) {
            value+= val.charAt(i) ==='0'?'1':'0';
        } else {
            value += val.charAt(i);
        }
    }
    $("#statusFilter").val(value);
    console.log($("#statusFilter").val());
    if ($(object).hasClass('eye-deselect')) {
        $(object).removeClass('eye-deselect');
    } else {
        $(object).addClass('eye-deselect');
    }
}

function PriorityFilter(object,index) {
    let val = $("#priorityFilter").val();
    let value='';

    for (let i = 0; i < val.length; i ++) {
        if (i === index) {
            value+= val.charAt(i) ==='0'?'1':'0';
        } else {
            value += val.charAt(i);
        }
    }

    $("#priorityFilter").val(value);
    console.log($("#priorityFilter").val());
    if ($(object).hasClass('eye-deselect')) {
        $(object).removeClass('eye-deselect');
    } else {
        $(object).addClass('eye-deselect');
    }
}

function WeightFilter(object,index) {
    let val = $("#weightFilter").val();
    let value='';

    for (let i = 0; i < val.length; i ++) {
        if (i === index) {
            value+= val.charAt(i) ==='0'?'1':'0';
        } else {
            value += val.charAt(i);
        }
    }

    $("#weightFilter").val(value);
    console.log($("#weightFilter").val());
    if ($(object).hasClass('eye-deselect')) {
        $(object).removeClass('eye-deselect');
    } else {
        $(object).addClass('eye-deselect');
    }
}

function DateFilter(index) {
    let val = $("#dateFilter").val();
    let value='';
    if(index === 6) {
        for (let i = 0; i < val.length; i ++) {
            if (i === 2) {
                value+= val[2]==='0'?'1':'0';
            } else {
                value += val[i];
            }
        }
        $("#dateFilter").val(value);
        console.log($("#dateFilter").val());

        return;
    }
    for (let i = 0; i < val.length; i ++) {
        if (i === 0) {
            value+= index + 1;
        } else {
            value += val[i];
        }
    }
    $("#dateFilter").val(value);
    console.log($("#dateFilter").val());
}

function WorkTimeFilter(index) {
    let val = $("#workTimeFilter").val();
    let value='';

    for (let i = 0; i < val.length; i ++) {
        if (i === 0) {
            value+= index + 1;
        } else {
            value += val[i];
        }
    }
    $("#workTimeFilter").val(value);
    console.log($("#workTimeFilter").val());
}

function BudgetFilter(index) {
    let val = $("#budgetFilter").val();
    let value='';

    for (let i = 0; i < val.length; i ++) {
        if (i === 0) {
            value+= index + 1;
        } else {
            value += val[i];
        }
    }
    $("#budgetFilter").val(value);
    console.log($("#budgetFilter").val());
}

function StatusOrderMenu() {
    $('#statusOrderDropDownMenu').css('display')==='none'?$('#statusOrderDropDownMenu').show():$('#statusOrderDropDownMenu').hide();
}

function StatusScending(option) {
    let val = $("#statusFilter").val();
    let value='';
    for (let i = 0; i < val.length-1; i ++) {
        value += val.charAt(i);
    }

    if (option === true) {
        value+='1';
        $("#statusOrderMenu span:nth-child(2)")[0].innerHTML ='<i class="fa fa-caret-up"></i>';
    } else {
        value+='0';
        $("#statusOrderMenu span:nth-child(2)")[0].innerHTML ='<i class="fa fa-caret-down"></i>';
    }

    $("#statusFilter").val(value);
    console.log($("#statusOrderMenu span:nth-child(2)"));
    this.StatusOrderMenu();
}

function PriorityOrderMenu() {
    $('#priorityOrderDropDownMenu').css('display')==='none'?$('#priorityOrderDropDownMenu').show():$('#priorityOrderDropDownMenu').hide();
}

function PriorityScending(option) {
    let val = $("#priorityFilter").val();
    let value='';
    for (let i = 0; i < val.length-1; i ++) {
        value += val.charAt(i);
    }

    if (option === true) {
        value+='1';
        $("#priorityOrderMenu span:nth-child(2)")[0].innerHTML ='<i class="fa fa-caret-up"></i>';
    } else {
        value+='0';
        $("#priorityOrderMenu span:nth-child(2)")[0].innerHTML ='<i class="fa fa-caret-down"></i>';
    }

    $("#priorityFilter").val(value);
    this.PriorityOrderMenu();
}

function WeightOrderMenu() {
    $('#weightOrderDropDownMenu').css('display')==='none'?$('#weightOrderDropDownMenu').show():$('#weightOrderDropDownMenu').hide();
}

function WeightScending(option) {
    let val = $("#weightFilter").val();
    let value='';
    for (let i = 0; i < val.length-1; i ++) {
        value += val.charAt(i);
    }

    if (option === true) {
        value+='1';
        $("#weightOrderMenu span:nth-child(2)")[0].innerHTML ='<i class="fa fa-caret-up"></i>';
    } else {
        value+='0';
        $("#weightOrderMenu span:nth-child(2)")[0].innerHTML ='<i class="fa fa-caret-down"></i>';
    }

    $("#weightFilter").val(value);

    this.WeightOrderMenu();
}


function DateOrderMenu() {
    $('#dateOrderDropDownMenu').css('display')==='none'?$('#dateOrderDropDownMenu').show():$('#dateOrderDropDownMenu').hide();
}

function DateScending(option) {
    let val = $("#dateFilter").val();
    let value='';
    for (let i = 0; i < val.length-1; i ++) {
        value += val.charAt(i);
    }

    if (option === true) {
        value+='1';
        $("#dateOrderMenu span:nth-child(2)")[0].innerHTML ='<i class="fa fa-caret-up"></i>';
    } else {
        value+='0';
        $("#dateOrderMenu span:nth-child(2)")[0].innerHTML ='<i class="fa fa-caret-down"></i>';
    }

    $("#dateFilter").val(value);

    this.DateOrderMenu();
}

function WorkTimeOrderMenu() {
    $('#workTimeOrderDropDownMenu').css('display')==='none'?$('#workTimeOrderDropDownMenu').show():$('#workTimeOrderDropDownMenu').hide();
}

function WorkTimeScending(option) {
    let val = $("#workTimeFilter").val();
    let value='';
    for (let i = 0; i < val.length-1; i ++) {
        value += val.charAt(i);
    }

    if (option === true) {
        value+='1';
        $("#workTimeOrderMenu span:nth-child(2)")[0].innerHTML ='<i class="fa fa-caret-up"></i>';
    } else {
        value+='0';
        $("#workTimeOrderMenu span:nth-child(2)")[0].innerHTML ='<i class="fa fa-caret-down"></i>';
    }

    $("#workTimeFilter").val(value);

    this.WorkTimeOrderMenu();
}

function BudgetOrderMenu() {
    $('#budgetOrderDropDownMenu').css('display')==='none'?$('#budgetOrderDropDownMenu').show():$('#budgetOrderDropDownMenu').hide();
}

function BudgetScending(option) {
    let val = $("#budgetFilter").val();
    let value='';
    for (let i = 0; i < val.length-1; i ++) {
        value += val.charAt(i);
    }

    if (option === true) {
        value+='1';
        $("#budgetOrderMenu span:nth-child(2)")[0].innerHTML ='<i class="fa fa-caret-up"></i>';
    } else {
        value+='0';
        $("#budgetOrderMenu span:nth-child(2)")[0].innerHTML ='<i class="fa fa-caret-down"></i>';
    }

    $("#budgetFilter").val(value);

    this.BudgetOrderMenu();
}

function task_filter_reorder(myOrder, index) {
    let order = $('#task_filter_order').val();
    let val = index + 1;

    let value = "";
    if (val === order[myOrder] * 1) {
        return;
    }


    let origin = order[myOrder] * 1;
    if ( origin > val ) {
        for (let i = 0; i < 6; i ++) {
            if (i === myOrder) {
                value += val;
            } else if (order[i] * 1 === val) {
                value += origin;
            } else {
                value += order[i];
            }
        }
    } else {
        for (let i = 0; i < 6; i ++) {
            if (i === myOrder) {
                value += val;
            } else {
                if (order[i] * 1 < val) {
                    value += order[i]
                } else {
                    if (order[i] === '6') {
                        if (val > order[myOrder])
                            value+=origin;
                        // else value += origin * 1 + 1;
                    } else {
                        value += order[i] * 1 + 1;
                    }
                }
            }
        }
    }


    $('#task_filter_order').val(value);
    let orderCharacters = ["I","II", "III", "IV","V", "VI"];
    $("#statusOrderMenu span:first-child")[0].innerHTML = orderCharacters[value[0] * 1 -1];
    $("#priorityOrderMenu span:first-child")[0].innerHTML = orderCharacters[value[1] * 1 -1];
    $("#weightOrderMenu span:first-child")[0].innerHTML = orderCharacters[value[2] * 1 -1];
    $("#dateOrderMenu span:first-child")[0].innerHTML = orderCharacters[value[3] * 1 -1];
    $("#workTimeOrderMenu span:first-child")[0].innerHTML = orderCharacters[value[4] * 1 -1];
    $("#budgetOrderMenu span:first-child")[0].innerHTML = orderCharacters[value[5] * 1 -1];

}
function StatusOrderSelect(index) {
    task_filter_reorder(0,index);
    this.StatusOrderMenu();

}

function PriorityOrderSelect(index) {
    task_filter_reorder(1,index);
    this.PriorityOrderMenu();
}

function WeightOrderSelect(index) {
    task_filter_reorder(2,index);
    this.WeightOrderMenu();
}

function DateOrderSelect(index) {
    task_filter_reorder(3,index);
    this.DateOrderMenu();
}

function WorkTimeOrderSelect(index) {
    task_filter_reorder(4,index);
    this.WorkTimeOrderMenu();
}

function BudgetOrderSelect(index) {
    task_filter_reorder(5,index);
    this.BudgetOrderMenu();
}