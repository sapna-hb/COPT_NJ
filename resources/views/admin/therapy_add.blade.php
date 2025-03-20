@section('add_therapy')
    active
@endsection
@section('addtherapys')
    active
@endsection
@php
    $Therapy = true;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Therapy | Add</title>


    @include('admin.assets.links')

</head>


<body class="hold-transition sidebar-mini layout-fixed" data-page="add-therapy">
    <div class="wrapper">

        @include('admin.layout')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Therapy</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Therapy</li>
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
                                    <h3 class="card-title">Add New Therapy</h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form id="TherapyForm" enctype="multipart/form-data">
                                        <div class="form-group mb-3">
                                            <label for="Therapy_name" class="form-label">Therapy Name</label>
                                            <input type="text" class="form-control" name="Therapy_name"
                                                id="Therapy_name" placeholder="Enter Therapy Name">
                                            <small id="Therapy_name_error"></small>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" id="submitTherapy"
                                                class="btn btn-success mr-2">Submit</button>
                                            <a href="{{ route('admin.therapys') }}"><button type="button"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
        integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/additional-methods.min.js"
        integrity="sha512-owaCKNpctt4R4oShUTTraMPFKQWG9UdWTtG6GRzBjFV4VypcFi6+M3yc4Jk85s3ioQmkYWJbUl1b2b2r41RTjA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ url('/') }}/assets/admin/ajax/therapy.js"></script>

    {{-- <script src="{{ url('/') }}/assets/admin/ajax/Therapys.js"></script> --}}
    <script>
        var therapyAddOp = '{{ route('admin.therapyAddOp') }}';
        var therapyshome = '{{ route('admin.therapys') }}';
    </script>
</body>

</html>
