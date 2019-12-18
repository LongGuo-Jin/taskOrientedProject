
$("div.kt-task-extand-item").on("click", function(){
    $offsetTop = $(this).offset().top - 64 - 25;
    $("div#kt_final_sub_task").css("margin-top", $offsetTop);
    $("div#kt_final_sub_task").css("margin-left", -15);
    if ($("div#kt_final_sub_task").css("display") == "none") {
        $("div#kt_final_sub_task").css("display", "block");
    } else {
        $("div#kt_final_sub_task").css("display", "none");
    }

})