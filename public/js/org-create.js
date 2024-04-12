$(document).ready(function() {
    
    function orgValidateField(orgFieldName, orgValue) {
        
        let orgRequiredFields = [
            'title',
            'create_org_no',
        ];

        if (orgRequiredFields.includes(orgFieldName) && !orgValue) {
            return false;
        }

        return true;
    }

    $('#createOrgSubmit').on('click',function(e){
        e.preventDefault();

        $(this).prop('disabled', true);

        let orgFieldsToValidates = [
            'title',
            'create_org_no',
        ];

        let orgFieldsTranslate = {
            title: '單位名稱',
            create_org_no: '單位編號',
        };

        let orgIsValid = true;

        for (let orgFieldsToValidate of orgFieldsToValidates) {
            
            let orgFieldName = orgFieldsToValidate;
            let orgValue = $('#' + orgFieldName).val();
            if (!orgValidateField(orgFieldName, orgValue)) {
                alert(orgFieldsTranslate[orgFieldName] + ' 欄位為必填欄位');
                orgIsValid = false;
                $('#createOrgSubmit').prop('disabled', false);
                break;
            }

        }

        if (orgIsValid) {
            let title = $('#title').val();
            let org_no = $('#create_org_no').val();

            $.ajax({
                type:'POST',
                url:"create_org",
                data:{
                    title : title,
                    org_no : org_no,
                    _token : $('#_token').val()
                },
                success : function(res){

                    
                    $('.success-message').text(' 單位名稱:' + res.message.title);
                    $('#success-alert').show();
                    setTimeout(function () {
                        window.location.reload();
                       }, 1500);
                },
                error : function(res){
                    $('.error-message').text(' ' + res.responseJSON.message);
                    $('#error-alert').show();
                    setTimeout(function () {
                        $('#error-alert').hide();
                        $('#createOrgSubmit').prop('disabled', false);
                       }, 2000);
                }
            });
        }

        
    });

});
