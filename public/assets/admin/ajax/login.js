$('#loginForm').validate({
    rules: {
        input_user: {
            required: true,
            number: true
        },
        input_password: {
            required: true,
        }
    },
    messages: {
        input_user: {
            required: 'Please Enter Contact Number',
            number: 'Please Enter Valid Contact Number'
        },
        input_password: {
            required: 'Please select Date',
        }
    },
    errorElement: 'small',
    errorPlacement: function (error, element) {

        var element_name = element.attr("name");
        $("#" + element_name + "_error").length ?
            error.appendTo($("#" + element_name + "_error")) :
            element.after(error); // Fallback to default placement
    },
    submitHandler: function (form) {
        var formData = new FormData(form);
        var formURL = $(form).attr("action");
        $.ajax({
            url: formURL, // Ensure this variable is properly defined
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#login_btn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            success: function (response) {
                $('#login_btn').prop('disabled', false).html('Login');
                if (response.status === 200) {
                    window.location.href = response.url;
                } else {
                    $.alert({
                        type: "error",
                        title: "Oops!",
                        content: "Invalid Information!",
                    });
                }
            },
            error: function (xhr) {
                $.alert({
                    type: "red",
                    title: "Oops!",
                    content: "Something went wrong",
                });
            },
        });
    },
});