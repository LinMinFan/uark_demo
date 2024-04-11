$(document).ready(function() {
    let formSubmit = $('#member_register');

    function validateField(fieldName, value) {
        
        // 檢查欄位是否為必填
        let requiredFields = [
            'account',
            'name',
            'password',
            'email',
            'org_no',
            'apply_file',
        ];

        if (requiredFields.includes(fieldName) && !value) {
            return false;
        }

        return true;
    }

    formSubmit.on('click', function(e) {
        e.preventDefault();

        let fieldsToValidates = [
            'account',
            'name',
            'password',
            'email',
            'org_no',
            'birthday',
            'apply_file',
        ];

        let fieldsTranslate = {
            account: '帳號',
            name: '姓名',
            password: '密碼',
            email: 'Email',
            org_no: '單位號碼',
            birthday: '出生日期',
            apply_file: '上傳檔案',
        };

        let isValid = true;

        for (let fieldsToValidate of fieldsToValidates) {
            
            let fieldName = fieldsToValidate;
            let value = $('[name="' + fieldName + '"]').val();
            if (!validateField(fieldName, value)) {
                alert(fieldsTranslate[fieldName] + ' 欄位為必填欄位');
                isValid = false;
                break;
            }

        }

        if (isValid) {
            $('form.member_register').submit();
        }
    });
});
