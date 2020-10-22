

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

        if (($('#peopleUpdate').length != 0 && !($('#peopleUpdate')[0].disabled == true))) {
            swal.fire({
                title: 'Are u sure to go out without saving task?',
                text: '',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                reverseButtons: true
            }).then(function(result){
                if (result.value) {
                    $('#personAddForm').show();
                    $('#personDetails').hide();
                }
            });
        } else {
            $('#personAddForm').show();
            $('#personDetails').hide();
        }
    });

    $('.filter_item, .filter_item_selected').on('click',function(){
        var alphaV = $(this).data('alpha');

        if (($('#personAddForm').css('display') != 'none' )|| ($('#peopleUpdate').length != 0 && !($('#peopleUpdate')[0].disabled == true))) {
            swal.fire({
                title: 'Are u sure to go out without saving task?',
                text: '',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                reverseButtons: true
            }).then(function(result){
                if (result.value) {
                    window.location.href = base_url + '/people?alpha=' + alphaV;
                }
            });
        } else {
            window.location.href = base_url + '/people?alpha=' + alphaV;
        }
    });

    $('select[name=personAddTags]').on('change',function(){
        $('input[name=personTags]').val($('select[name=personAddTags]').val());
    });

    $('.person_info_card').on('click',function() {
        var alphaV = $(this).data('alpha');
        var select = $(this).data('select');

        if (($('#personAddForm').css('display') != 'none' )|| ($('#peopleUpdate').length != 0 && !($('#peopleUpdate')[0].disabled == true))) {
            swal.fire({
                title: 'Are u sure to go out without saving task?',
                text: '',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                reverseButtons: true
            }).then(function(result){
                if (result.value) {
                    window.location.href = base_url + '/people?alpha=' + alphaV + '&select=' + select;
                }
            });
        } else {
            window.location.href = base_url + '/people?alpha=' + alphaV + '&select=' + select;
        }
    });
});