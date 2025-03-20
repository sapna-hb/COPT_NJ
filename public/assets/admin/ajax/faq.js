$(document).ready(function () {
    // Global AJAX Setup
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    function getPage() {
        return $("body").attr("data-page");
    }

    let page = getPage();

    function handleShow() {
        $(document).ready(function () {
            const columns = [
                {
                    data: "no",
                    name: "no",
                },
                {
                    data: "question",
                    name: "question",
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ];

            $("#faq_table").DataTable({
                responsive: true,
                scrollCollapse: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: faqTable,
                    type: "POST",

                    error: function (xhr, status, error) {
                        console.error("DataTable AJAX error:", status, error);
                    },
                },
                columns: columns,
                drawCallback: function () {
                    console.log("DataTable redrawn");
                },
            });
        });
    }

    function handleAdd() {
        $(document).ready(function () {
            $.validator.addMethod(
                "filesize",
                function (value, element, param) {
                    return (
                        this.optional(element) ||
                        element.files[0]?.size <= param
                    );
                },
                "File size must not exceed {0} bytes"
            );
            $("#FaqForm").validate({
                ignore: [],
                rules: {
                    fq_name: {
                        required: true,
                        minlength: 3,
                    },
                    fa_name: {
                        required: true,
                        minlength: 3,
                    },
                },
                messages: {
                    fq_name: {
                        required: "Please enter the question",
                        minlength:
                            "Question must be at least 3 characters long",
                    },
                    fa_name: {
                        required: "Please enter the answer",
                        minlength: "Answer must be at least 3 characters long",
                    },
                },
                errorElement: "small",
                errorClass: "text-danger",
                errorPlacement: function (error, element) {
                    const errorElementId = element.attr("id") + "_error";
                    $("#" + errorElementId)
                        .html(error)
                        .show();
                },
                highlight: function (element) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function (element) {
                    $(element).removeClass("is-invalid");
                    const errorElementId = element.id + "_error";
                    $("#" + errorElementId).hide();
                },
                submitHandler: function (form, event) {
                    event.preventDefault();

                    const formData = new FormData(form);

                    $.ajax({
                        url: faqAddOp,
                        type: "POST",
                        data: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        beforeSend: function () {
                            $("#submitTherapy")
                                .prop("disabled", true)
                                .html(
                                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                                );
                        },
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            $("#submitTherapy")
                                .prop("disabled", false)
                                .html("Submit");
                            $.alert({
                                type: "success",
                                title: "Success",
                                content: "Faq added successfully!",
                            });
                            form.reset();
                            $("small.text-danger").hide();
                            window.location.href = faqshome;
                        },
                        error: function (xhr, status, error) {
                            $.alert({
                                type: "error",
                                title: "Oops!",
                                content: "Invalid Information!",
                            });
                        },
                    });
                },
            });
        });
    }

    if (page === "show-faq") handleShow();
    if (page === "add-faq") handleAdd();
});
