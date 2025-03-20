@section('treatments')
    active
@endsection
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Treatment</title>
    @include('admin.assets.links')

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />


    <style>
        .ql-container {
            min-height: 100px;
        }
    </style>

</head>


<body class="hold-transition sidebar-mini layout-fixed" data-page="edit-treatment">
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
                                    <h3 class="card-title">Edit Treatment</h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form id="treatmentForm" enctype="multipart/form-data">
                                        <input type="hidden" name="id" id="id"
                                            value="{{ $treatment->id }}">
                                        <div class="form-group mb-3">
                                            <label for="treatment_name" class="form-label">Treatment Name</label>
                                            <input type="text" class="form-control" name="treatment_name"
                                                id="treatment_name" placeholder="Enter Treatment Name"
                                                value="{{ $treatment->treatment_name }}">
                                            <small id="treatment_name_error"></small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <div id="description-quill" class="quill-editor">
                                                {!! $treatment->body_description !!}
                                            </div>
                                            <small id="description_error"></small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="banner" class="form-label">Banner</label>
                                            <input type="file" class="form-control" name="banner" id="banner">
                                            <img class="mt-2" src="{{ $treatment->banner }}"
                                                style="width: 200px; height: 100px;">
                                            <small id="banner_error"></small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" name="image" id="image">
                                            <img class="mt-2" src="{{ $treatment->image }}"
                                                style="width: 200px; height: 100px;">
                                            <small id="image_error"></small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="symptoms" class="form-label">Symptoms</label>
                                            <div id="symptoms-quill" class="quill-editor">
                                                {!! $treatment->symptoms !!}
                                            </div>
                                            <small id="symptoms_error"></small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="extra_information" class="form-label">Extra Information</label>
                                            <div id="extra_information-quill" class="quill-editor">
                                                {!! $treatment->extra_information !!}
                                            </div>
                                            <small id="extra_information_error"></small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="causes_summary" class="form-label">Causes Summary</label>
                                            <div id="causes_summary-quill" class="quill-editor">
                                                {!! $treatment->causes_summary !!}
                                            </div>
                                            <small id="causes_summary_error"></small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="causes_note" class="form-label">Causes Note</label>
                                            <div id="causes_note-quill" class="quill-editor">
                                                {!! $treatment->causes_note !!}
                                            </div>
                                            <small id="causes_note_error"></small>
                                        </div>
                                        <h4>Causes</h4>
                                        <div class="treatment-causes-content">
                                            @foreach ($causes as $cause)
                                                <div class="mb-3 default-row">
                                                    <div class="form-group mb-3">
                                                        <label for="causes_question" class="form-label">Causes
                                                            Question</label>
                                                        <textarea id="causes_question" class="form-control" name="causes_question[]"> {{ $cause->name }}</textarea>
                                                        <small id="causes_question_error"></small>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="causes_answer" class="form-label">Causes
                                                            Answer</label>
                                                        <textarea id="causes_answer" class="form-control" name="causes_answer[]">{{ $cause->description }}</textarea>
                                                        <small id="causes_answer_error"></small>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <hr>
                                            <div id="treatment-causes-data">
                                                <!-- Dynamic rows will be appended here -->
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-success" id="add-row-btn">+
                                                        Add New</button>
                                                </div>
                                            </div>
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
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/additional-methods.min.js"></script>
    <script src="{{ url('/') }}/assets/admin/ajax/treatments.js"></script>
    <script>
        var treatmentEditOp = '{{ route('admin.treatmentEditOp') }}';
        var treatmentshome = '{{ route('admin.treatments') }}';
    </script>
</body>

</html>
