
$(document).ready(function () {
    $('#addCompany').on('click',()=>{

        if (($('#companyCardUpdate').length != 0 && !($('#companyCardUpdate')[0].disabled == true))) {
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
                    $('#companyAddForm').show();
                    $('#companyEditForm').hide();
                }
            });
        } else {
            $('#companyAddForm').show();
            $('#companyEditForm').hide();
        }

    });
    $('.company_card, .company_card_selected').on('click',function() {
        var select = $(this).data('select');
        if (($('#companyAddForm').css('display') != 'none' )|| ($('#companyCardUpdate').length != 0 && !($('#companyCardUpdate')[0].disabled == true))) {
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
                    window.location.href = base_url + '/organization?select=' + select;
                }
            });
        } else {
            window.location.href = base_url + '/organization?select=' + select;
        }


    });

    $(".company_detail_span_text").on('click',(target)=>{
        let clicked_span = target.target;
        $(clicked_span).hide();
        $(clicked_span).parent().find('input').show();
    });

    $("#taxPayerSpan").on('click',()=>{
        $("#taxPayerSpan").hide();
        $("#taxPayer").show();
    });
    $('#descriptionSpan').on('click',()=> {
        $("#descriptionSpan").hide();
        $("#description").show();
    });

    $('#organization-tags').on('click',function() {
        $('#organization-edit-tags').show();
        $('#organization-tags').hide();
    });
    $('#organization-edit-tags').on('change',function(){
        $('#companyCardUpdate').enable(true);
        $('input[name=tags]').val($('select[name=orgTags]').val());
    });
    $('#organization-add-tags').on('change',function(){
        $('input[name=addTags]').val($('select[name=orgAddTags]').val());
        $('#companyCardUpdate').enable(true);
    });

    $('#companyEditForm #description' + ',#companyEditForm #shortName' + ',#companyEditForm #longName' + ',#companyEditForm #type' +
        ',#companyEditForm #taxPayer' + ',#companyEditForm #vatNumber' + ',#companyEditForm #registrationNumber' +
        ',#companyEditForm #country' + ',#companyEditForm #address' + ',#companyEditForm #phone' +
        ',#companyEditForm #email' + ',#companyEditForm #messenger' + ',#companyEditForm #swift_bic' + ',#companyEditForm #industry' +
        ',#companyEditForm #bank' + ',#companyEditForm #bankAccount' + ',#companyEditForm #companyID').on('click',()=>{
        $('#companyCardUpdate').enable(true);
    })
});
