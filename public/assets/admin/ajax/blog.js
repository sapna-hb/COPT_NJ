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
                    data: "image",
                    name: "image",
                },
                {
                    data: "title",
                    name: "title",
                },
                {
                    data: "date",
                    name: "date",
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ];

            $("#blog_table").DataTable({
                responsive: true,
                scrollCollapse: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: BlogTable,
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
            const editorOptions = {
                theme: "snow",
                placeholder: "Enter content...",
            };

            const descriptionEditor = new Quill(
                "#description-quill",
                editorOptions
            );
            // Custom validation methods
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

            // Initialize form validation
            $("#blogForm").validate({
                ignore: [],
                rules: {
                    title: {
                        required: true,
                    },
                    "category_name[]": {
                        required: false,
                    },
                    date: {
                        required: true,
                    },
                    image: {
                        required: true,
                        extension: "jpg|jpeg|png|gif",
                        filesize: 5 * 1024 * 1024, // 5 MB max file size
                    },
                },
                messages: {
                    title: {
                        required: "Please enter a title",
                    },
                    "category_name[]": {
                        required: "Please select a category",
                    },
                    date: {
                        required: "Please select a date",
                    },
                    image: {
                        required: "Please select an image",
                        extension:
                            "Please select a valid image file (jpg, jpeg, png, gif)",
                        filesize: "File size must not exceed 5 MB",
                    },
                },
                errorElement: "small",
                errorClass: "text-danger",
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "category_name[]") {
                        error.appendTo("#category_name_error");
                    }
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
                    formData.append(
                        "description",
                        descriptionEditor.root.innerHTML
                    );

                    $.ajax({
                        url: BlogDetailAddOp,
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
                                content: "Blog added successfully!",
                            });
                            form.reset();
                            descriptionEditor.root.innerHTML = "";
                            $("small.text-danger").hide();
                            window.location.href = BlogDetailshome;
                        },
                        error: function (xhr, status, error) {
                            $.alert({
                                type: "error",
                                title: "Oops!",
                                content: "Invalid Information!",
                            });
                            $("#submitTherapy")
                                .prop("disabled", false)
                                .html("Submit");
                        },
                    });
                },
            });
        });
    }

    function handleEdit() {
        $(document).ready(function () {
            const editorOptions = {
                theme: "snow",
                placeholder: "Enter content...",
            };

            const descriptionEditor = new Quill(
                "#description-quill",
                editorOptions
            );
            // Custom validation methods
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

            // Initialize form validation
            $("#blogForm").validate({
                ignore: [],
                rules: {
                    title: {
                        required: true,
                    },
                    "category_name[]": {
                        required: false,
                    },
                    date: {
                        required: true,
                    },
                    image: {
                        required: false,
                        extension: "jpg|jpeg|png|gif",
                        filesize: 5 * 1024 * 1024, // 5 MB max file size
                    },
                },
                messages: {
                    title: {
                        required: "Please enter a title",
                    },
                    "category_name[]": {
                        required: "Please select a category",
                    },
                    date: {
                        required: "Please select a date",
                    },
                    image: {
                        required: "Please select an image",
                        extension:
                            "Please select a valid image file (jpg, jpeg, png, gif)",
                        filesize: "File size must not exceed 5 MB",
                    },
                },
                errorElement: "small",
                errorClass: "text-danger",
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "category_name[]") {
                        error.appendTo("#category_name_error");
                    }
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
                    formData.append(
                        "description",
                        descriptionEditor.root.innerHTML
                    );

                    $.ajax({
                        url: BlogDetailEditOp,
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
                                content: "Blog updated successfully!",
                            });
                            form.reset();
                            descriptionEditor.root.innerHTML = "";
                            $("small.text-danger").hide();
                            window.location.href = BlogDetailshome;
                        },
                        error: function (xhr, status, error) {
                            $.alert({
                                type: "error",
                                title: "Oops!",
                                content: "Invalid Information!",
                            });
                            $("#submitTherapy")
                                .prop("disabled", false)
                                .html("Submit");
                        },
                    });
                },
            });
        });
    }

    if (page === "show-blog") handleShow();
    if (page === "add-blog") handleAdd();
    if (page === "edit-blog") handleEdit();
});
