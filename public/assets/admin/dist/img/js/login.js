$(document).ready(function () {
    /* Admin User Email Validation */
    let emailError = false;
    $("#input_user").keyup(function () {
        validateEmail();
    });

    function validateEmail() {
        var input_user = $("#input_user").val();
        if (input_user == null || input_user == "") {
            $("#email_error").text("* Please Enter User Email");
            emailError = true;
            return false;
            // else if (IsEmail(input_user) == false) {
            //     $('#email_error').text("* Please Enter Valid User Email");
            //     emailError = true;
            //     return false;
            // } 
        } else {
            $("#email_error").text("");
            emailError = false;
        }
    }

    /* Admin User Password Validation */
    let passwordError = false;
    $("#input_password").keyup(function () {
        validatePassword();
    });

    function validatePassword() {
        var password = $("#input_password").val();
        var strength = 0;
        if (password == null || password == "") {
            $("#password_error").text("* Please Enter User Password");
            passwordError = true;
            return false;
        } else {
            $("#password_error").text("");
            passwordError = false;
        }
    }

    // function IsEmail(email) {
    //     var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    //     if (!regex.test(email)) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }

    // function isValidatePassword(password) {
    //     var regex1 = /^[A-Za-z0-9\d=!\-@._*]*$/;
    //     var regex2 = /[a-z]/;
    //     var regex3 = /\d/;
    //     if (regex1.test(password) && regex2.test(password) && regex3.test(password)) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    $("#login_btn").click(function (e) {
        e.preventDefault();

        validateEmail();
        validatePassword();

        if (
            emailError == false &&
            passwordError == false
        ) {
            validateLogin();
        } else {
            return false;
        }
    });
});

/* At least one Checkbox is required Validation */
function validateLogin() {
    // var formdata = $('#loginform').serialize();
    var url = $("#loginform").attr("action");
    var input_user = $("#input_user").val();
    var input_password = $("#input_password").val();

    $.ajax({
        type: "POST",
        url: url,
        data: {
            input_user: input_user,
            input_password: input_password,
            _token: $("#token").val(),
        },
        beforeSend: function () {
            $("#login_btn").html("Please Wait...");
        },
        success: function (data) {
            $("#login_btn").html();
            if ((data == 'success')) {
                window.location.href = 'dashboard';
            } else if (data == 'error') {
                $.alert({
                    title: 'Oops!',
                    content: 'Invalid Information!',
                });
                $("#login_btn").html("Login");
            }
        },
    });
}