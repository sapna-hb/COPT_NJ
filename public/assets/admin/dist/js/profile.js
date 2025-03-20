$(document).ready(function () {
    /* Admin User Contact Validation */
    let nameError = false;
    $("#name").keyup(function () {
        validateName();
    });

    function validateName() {
        var name = $("#name").val();
        if (name == null || name == "") {
            $("#name_error").text("* Please Enter User Name");
            $("#name").addClass("is-invalid");
            nameError = true;
            return false;
        } else {
            $("#name_error").text("");
            $("#name").removeClass("is-invalid");
            nameError = false;
        }
    }

    /* Admin User Contact Validation */
    let contactError = false;
    $("#contact").keyup(function () {
        validateContact();
    });

    function validateContact() {
        var contact = $("#contact").val();
        if (contact == null || contact == "") {
            $("#contact_error").text("* Please Enter User Contact Number");
            $("#contact").addClass("is-invalid");
            contactError = true;
            return false;
        } else if (contact.length < 10 || contact.length > 10) {
            $("#contact_error").text(
                "* Please Enter Valid 10 Digit User Contact Number"
            );
            $("#contact").addClass("is-invalid");
            contactError = true;
            return false;
        } else {
            $("#contact_error").text("");
            $("#contact").removeClass("is-invalid");
            contactError = false;
        }
    }

    /* Admin User Email Validation */
    let emailError = false;
    $("#email").keyup(function () {
        validateEmail();
    });

    function validateEmail() {
        var email = $("#email").val();
        if (email == null || email == "") {
            $("#email_error").text("* Please Enter User Email");
            $("#email").addClass("is-invalid");
            emailError = true;
            return false;
            // else if (IsEmail(input_user) == false) {
            //     $('#email_error').text("* Please Enter Valid User Email");
            //     emailError = true;
            //     return false;
            // }
        } else {
            $("#email_error").text("");
            $("#email").removeClass("is-invalid");
            emailError = false;
        }
    }

    /* Admin User Password Validation */
    let passwordError = false;
    $("#change_password").keyup(function () {
        validatePassword();
    });

    function validatePassword() {
        var password = $("#change_password").val();
        if (password) {
            if (password == null || password == "") {
                $("#password_error").text("* Please Enter User Password");
                passwordError = true;
                return false;
            } else {
                $("#password_error").text("");
                passwordError = false;
            }
        } else {
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

    $("#update_profile").click(function (e) {
        e.preventDefault();

        validateName();
        validateContact();
        validateEmail();
        validatePassword();

        if (
            nameError == false &&
            contactError == false &&
            emailError == false
            // passwordError == false
        ) {
            updateProfile();
        } else {
            return false;
        }
    });
});

function updateProfile() {
    // var formdata = $('#loginform').serialize();
    var user_id = $("#user_id").val();
    var url = $("#profileform").attr("action");
    var name = $("#name").val();
    var contact = $("#contact").val();
    var email = $("#email").val();
    var change_password = $("#change_password").val();

    $.ajax({
        type: "POST",
        url: url,
        data: {
            user_id: user_id,
            name: name,
            contact: contact,
            email: email,
            change_password: change_password,
            _token: $("#token").val(),
        },
        beforeSend: function () {
            $("#update_profile").html("Please Wait...");
        },
        success: function (data) {
            $("#update_profile").html();
            if (data == "success") {
                $.alert({
                    type: "green",
                    title: "Success!",
                    content: "Profile Updated Successfully!",
                    buttons: {
                        OK: {
                            btnClass: "btn-danger",
                            action: function () {
                                window.location.reload();
                            },
                        },
                    },
                });
            } else if (data == "error") {
                $.alert({
                    type: "red",
                    title: "Oops!",
                    content: "Something went Wrong!",
                    buttons: {
                        OK: {
                            btnClass: "btn-danger",
                            action: function () {
                                window.location.reload();
                            },
                        },
                    },
                });
                $("#update_profile").html("Login");
            }
        },
    });
}
