/***********************************************************************
                Add User Information  
 ************************************************************************/

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
        } else if (IsEmail(email) == false) {
            $('#email_error').text("* Please Enter Valid User Email");
            $("#email").addClass("is-invalid");
            emailError = true;
            return false;
        } else {
            $("#email_error").text("");
            $("#email").removeClass("is-invalid");
            emailError = false;
        }
    }

    /* Admin User Password Validation */
    let passwordError = false;
    $("#password").keyup(function () {
        validatePassword();
    });

    function validatePassword() {
        var password = $("#password").val();

        if (password == null || password == "") {
            $("#password_error").text("* Please Enter User Password");
            passwordError = true;
            return false;
        } else {
            $("#password_error").text("");
            passwordError = false;
        }
    }

    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        } else {
            return true;
        }
    }

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

    $("#AddUser").click(function (e) {
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
            addUser();
        } else {
            return false;
        }
    });
});

function addUser() {
    // var formdata = $('#loginform').serialize();
    var url = $("#useraddform").attr("action");
    var name = $("#name").val();
    var contact = $("#contact").val();
    var email = $("#email").val();
    var password = $("#password").val();

    // User Permissions
    // var permission = $('#permission').val();
    // console.log(permission);
    // return false;
    // var menuArray = [];
    // var element = $("input[name=menus]");
    // $(element).each(function (i) {
    //     menuArray.push($($("input[name=menus]")[i]).val());
    // });
    // var permissionArray = [];
    // $("input[name='permission']").each(function (i) {
    //     var element = $("input[name='permission']")[i];
    //     if ($(element).prop('checked') == true) {
    //         debugger
    //         permissionArray.push($(element)[i].defaultValue());
    //         console.log(permissionArray)
    //     }
    //     else {

    //         alert('Not');
    //     }
    // })
    // $('input[name="permission"]:checked').each(function () {
    //     alert('Selected Value: ' + this.value);
    // });

    // var element1 = $("input[name=view]");
    // $(element1).each(function (i) {
    //     permissionArray.push($($("input[name=view]")[i]).val());
    // });
    // console.log(permissionArray);
    // return false;

    $.ajax({
        type: "POST",
        url: url,
        data: {
            name: name,
            contact: contact,
            email: email,
            password: password,
            _token: $("#token").val(),
        },
        beforeSend: function () {
            $("#AddUser").html("Please Wait...");
        },
        success: function (data) {
            $("#AddUser").html("Submit");
            if (data == "success") {
                $.alert({
                    title: "Success!",
                    content: "User Add Successfully!",
                    buttons: {
                        OK: function () {
                            stepper.next();
                        },
                    },
                });
            } else if (data == "error") {
                $.alert({
                    title: "Oops!",
                    content: "Something went Wrong!",
                    buttons: {
                        OK: function () {
                            window.location.reload();
                        },
                    },
                });
                $("#AddUser").html("Login");
            } else if (data == "exists") {
                $.alert({
                    title: "Oops!",
                    content: "User is Already Exists!",
                    // buttons: {
                    //     OK: function () {
                    //         window.location.reload();
                    //     },
                    // },
                });
                $("#AddUser").html("Next Step");
            }
        },
    });
}

/***********************************************************************
                Update User Information
 ************************************************************************/

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
    $("#password").keyup(function () {
        validatePassword();
    });

    function validatePassword() {
        var password = $("#password").val();

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

    $("#editUser").click(function (e) {
        e.preventDefault();

        validateName();
        validateContact();
        validateEmail();
        // validatePassword();

        if (
            nameError == false &&
            contactError == false &&
            emailError == false
            // passwordError == false
        ) {
            editUser();
        } else {
            return false;
        }
    });
});

function editUser() {
    // var formdata = $('#loginform').serialize();
    var user_id = $("#user_id").val();
    var url = $("#usereditform").attr("action");
    var name = $("#name").val();
    var contact = $("#contact").val();
    var email = $("#email").val();
    var password = $("#password").val();

    $.ajax({
        type: "POST",
        url: url,
        data: {
            user_id: user_id,
            name: name,
            contact: contact,
            email: email,
            password: password,
            _token: $("#token").val(),
        },
        beforeSend: function () {
            $("#editUser").html("Please Wait...");
        },
        success: function (data) {
            $("#editUser").html();
            if (data == "success") {
                $.alert({
                    title: "Success!",
                    content: "User Details Edited Successfully!",
                    buttons: {
                        OK: function () {
                            stepper.next();
                        },
                    },
                });
            } else if (data == "error") {
                $.alert({
                    title: "Oops!",
                    content: "Something went Wrong!",
                    buttons: {
                        OK: function () {
                            window.location.reload();
                        },
                    },
                });
                $("#editUser").html("Submit");
            }
        },
    });
}