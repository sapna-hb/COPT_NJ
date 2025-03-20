@section('blog')
    active
@endsection
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Details</title>


    @include('admin.assets.links')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />


    <style>
        .ql-container {
            min-height: 100px;
        }
    </style>
</head>



<body class="hold-transition sidebar-mini layout-fixed" data-page="add-blog">
    <div class="wrapper">

        @include('admin.layout')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Blog Details</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Blog Details</li>
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
                                    <h3 class="card-title">Add New Blog Details</h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form id="blogForm" enctype="multipart/form-data">
                                        <div class="form-group mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title" id="title"
                                                placeholder="Enter Title">
                                            <small id="title_error"></small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="category_name" class="form-label">Category Name</label>
                                            <select class="form-control" name="category_name[]" id="category_name"
                                                multiple>
                                                @foreach ($tags as $therapy)
                                                    <option value="{{ $therapy->id }}">{{ $therapy->therapy_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small id="category_name_error"></small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <div id="description-quill" class="quill-editor"></div>
                                            <small id="description_error"></small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="date" class="form-label">Date</label>
                                            <input type="date" class="form-control" name="date" id="date">
                                            <small id="date_error"></small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" name="image" id="image">
                                            <small id="image_error"></small>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" id="submitTherapy"
                                                class="btn btn-success mr-2">Submit</button>
                                            <a href="{{ route('admin.therapyDetails') }}"><button type="button"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
        integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/additional-methods.min.js"
        integrity="sha512-owaCKNpctt4R4oShUTTraMPFKQWG9UdWTtG6GRzBjFV4VypcFi6+M3yc4Jk85s3ioQmkYWJbUl1b2b2r41RTjA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ url('/') }}/assets/admin/ajax/blog.js"></script>

    <script>
        var BlogDetailAddOp = '{{ route('admin.BlogDetailAddOp') }}';
        var BlogDetailshome = '{{ route('admin.BlogDetails') }}';
    </script>
</body>

</html>
