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
                    data: "therapy_name",
                    name: "therapy_name",
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ];

            $("#therapy_table").DataTable({
                responsive: true,
                scrollCollapse: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: therapyTable,
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
            $("#TherapyForm").validate({
                ignore: [],
                rules: {
                    Therapy_name: {
                        required: true,
                        minlength: 3,
                    },
                },
                messages: {
                    Therapy_name: {
                        required: "Please enter the therapy name",
                        minlength:
                            "therapy name must be at least 3 characters long",
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
                        url: therapyAddOp,
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
                                content: "Therapy added successfully!",
                            });
                            form.reset();
                            $("small.text-danger").hide();
                            window.location.href = therapyshome;
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

    function handleEdit() {
        $(document).ready(function () {
            $("#TherapyForm").validate({
                ignore: [],
                rules: {
                    Therapy_name: {
                        required: true,
                        minlength: 3,
                    },
                },
                messages: {
                    treatment_name: {
                        required: "Please enter the treatment name",
                        minlength:
                            "Treatment name must be at least 3 characters long",
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
                        url: therapyEditOp,
                        type: "POST",
                        data: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            $("#submitTherapy")
                                .prop("disabled", true)
                                .html(
                                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                                );
                        },
                        success: function (response) {
                            $("#submitTherapy")
                                .prop("disabled", false)
                                .html("Submit");
                            $.alert({
                                type: "success",
                                title: "Success",
                                content: "Therapy updated successfully!",
                            });
                            form.reset();
                            $("small.text-danger").hide();
                            window.location.href = therapyshome;
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

    if (page === "show-therapy") handleShow();
    if (page === "add-therapy") handleAdd();
    if (page === "edit-therapy") handleEdit();
});
