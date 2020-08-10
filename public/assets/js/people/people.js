

$(document).ready(function () {
    $('input.date-picker').datepicker({
        rtl: KTUtil.isRTL(),
        orientation: "bottom right",
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    $('.people_P_Field').on('click',function() {
        $(this).parent().find('.people_input_field').show();
        $(this).hide();
        $('#peopleUpdate').enable(true);
    });
    $('.people_input_field').on('change',function() {
        $('#peopleUpdate').enable(true);
    });
    $('select[name=peopleTags]').on('change',function(){
        $('input[name=tags]').val($('select[name=peopleTags]').val());
        $('#peopleUpdate').enable(true);
    });

    $('#people-tags').on('click',function() {
        $('#people-tags').hide();
        $('#people-edit-tags').show();
    });

    $('#addPerson').on('click',function() {
        $('#personAddForm').show();
        $('#personDetails').hide();
    });
    $('select[name=personAddTags]').on('change',function(){
        $('input[name=personTags]').val($('select[name=personAddTags]').val());
    });


});