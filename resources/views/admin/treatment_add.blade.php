@section('treatments')
    active
@endsection
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Treatment | Add</title>
    @include('admin.assets.links')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />


    <style>
        .ql-container {
            min-height: 100px;
        }
    </style>
</head>



<body class="hold-transition sidebar-mini layout-fixed" data-page="add-treatment">
    <div class="wrapper">

        @include('admin.layout')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Treatment</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Treatment</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Add New Treatment</h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form id="treatmentForm" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="treatment_name" class="form-label">Treatment Name <sup
                                                    class="text-danger">*</sup></label>
                                            <input type="text" class="form-control" name="treatment_name"
                                                id="treatment_name" placeholder="Enter Treatment Name">
                                            <small id="treatment_name_error"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="form-label">Description <sup
                                                    class="text-danger">*</sup></label>
                                            <div id="description-quill" class="quill-editor"></div>
                                            <small id="description_error"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="banner" class="form-label">Banner <sup
                                                    class="text-danger">*</sup></label><br>
                                            <input type="file" class="" name="banner" id="banner">
                                            <small id="banner_error"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="image" class="form-label">Image <sup
                                                    class="text-danger">*</sup></label><br>
                                            <input type="file" class="" name="image" id="image">
                                            <small id="image_error"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="causes_summary" class="form-label">Causes Summary</label>
                                            <div id="causes_summary-quill" class="quill-editor"></div>
                                            <small id="causes_summary_error"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="causes_note" class="form-label">Causes Note</label>
                                            <div id="causes_note-quill" class="quill-editor"></div>
                                            <small id="causes_note_error"></small>
                                        </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="">Causes/Occurance</h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="default-row">
                                        <div class="form-group">
                                            <label for="causes" class="form-label">Causes 1</label>
                                            <input class="form-control" name="causes[]"></input>
                                        </div>
                                        <div class="form-group">
                                            <label for="causes_description" class="form-label">Description 1</label>
                                            <textarea class="form-control" name="causes_description[]"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div id="treatment-causes-data">
                                        <!-- Dynamic rows will be appended here -->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-primary" id="add-row-btn">+
                                                Add New</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3>Symptoms</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div id="symptoms-quill" class="quill-editor"></div>
                                        <small id="symptoms_error"></small>
                                    </div>
                                </div>

                                <div class="card-header">
                                    <h3>Extra Information</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        {{-- <label for="extra_information" class="form-label">Extra Information</label> --}}
                                        <div id="extra_information-quill" class="quill-editor"></div>
                                        <small id="extra_information_error"></small>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" id="submitTreatment"
                                            class="btn btn-success mr-2">Submit</button>
                                        <a href="{{ route('admin.treatments') }}"><button type="button"
                                                class="btn btn-danger">Close</button></a>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('admin.footer')

    </div>
    <!-- ./wrapper -->

    @include('admin.assets.scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
    <script src="{{ url('/') }}/assets/admin/ajax/treatments.js"></script>
    <script>
        var treatmentAddOp = '{{ route('admin.treatmentAddOp') }}';
        var treatmentshome = '{{ route('admin.treatments') }}';
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addRowButton = document.getElementById("add-row-btn");
            const dynamicData = document.getElementById("treatment-causes-data");

            const validateAllRows = () => {
                const allRows = document.querySelectorAll(".default-row, .dynamic-row");
                for (const row of allRows) {
                    const inputs = row.querySelectorAll("input, textarea");
                    for (const input of inputs) {
                        if (!input.value.trim()) {
                            alert("Please fill all fields before adding a new row.");
                            input.focus();
                            return false;
                        }
                    }
                }
                return true;
            };

            addRowButton.addEventListener("click", () => {
                if (!validateAllRows()) return;

                let rowCount = document.querySelectorAll(".dynamic-row").length + 2; // Adjust numbering

                const newRow = `
        <div class="dynamic-row">
            <div class="form-group">
                <label for="causes" class="form-label">Causes ${rowCount}</label>
                <input type="text" class="form-control" name="causes[]">
            </div>
            <div class="form-group">
                <label for="causes_description" class="form-label">Description ${rowCount}</label>
                <textarea class="form-control" name="causes_description[]"></textarea>
            </div>
            <button type="button" class="btn btn-secondary remove-row">x Remove</button>
        </div><br>
        `;

                dynamicData.insertAdjacentHTML("beforeend", newRow);
            });

            dynamicData.addEventListener("click", (event) => {
                if (event.target.classList.contains("remove-row")) {
                    event.target.closest(".dynamic-row").remove();
                }
            });
        });
    </script>

</body>

</html>
