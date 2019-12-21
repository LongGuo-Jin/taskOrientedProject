$(document).ready(function () {
    $('div.kt-task-extand-item').on('click', function(){
        var offsetTop = $(this).offset().top - 64 - 25;
        $('div#kt_final_sub_task').css('margin-top', offsetTop);
        $('div#kt_final_sub_task').css('display', 'block');
    });

    $('button.addTask').on('click', function () {
            $('div.detail-add input#level').val( $(this).data('level') );
            $('div.detail-add input#parentID').val( $(this).data('parentid') );

            $('div.detail-add').css('display', 'block');
        }
    );

    $('select#detail-add-person').on('change', function () {
        var personId = $(this).val();
        var personTag = personTagList[personId];

        $("span#detail-add-personTag").html(personTag);
    });
});

function addTask()
{
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

        }
    });
}
