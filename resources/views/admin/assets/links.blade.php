<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ url('/') }}/assets/admin/plugins/fontawesome-free/css/all.min.css">
<link rel="icon" href="{{ url('/') }}/assets/admin/logo/favicon.png" type="image/x-icon">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- DataTables -->
<link rel="stylesheet" href="{{ url('/') }}/assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
    href="{{ url('/') }}/assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet"
    href="{{ url('/') }}/assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet"
    href="{{ url('/') }}/assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{ url('/') }}/assets/admin/plugins/select2/css/select2.min.css">
<link rel="stylesheet"
    href="{{ url('/') }}/assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="{{ url('/') }}/assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- BS Stepper -->
<link rel="stylesheet" href="{{ url('/') }}/assets/admin/plugins/bs-stepper/css/bs-stepper.min.css">
<!-- JQVMap -->
<link rel="stylesheet" href="{{ url('/') }}/assets/admin/plugins/jqvmap/jqvmap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{ url('/') }}/assets/admin/dist/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ url('/') }}/assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ url('/') }}/assets/admin/plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="{{ url('/') }}/assets/admin/plugins/summernote/summernote-bs4.min.css">
<script src="https://kit.fontawesome.com/e04a23e55e.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="{{ url('/') }}/assets/admin/dist/css/jquery-confirm.min.css">
<script src="https://kit.fontawesome.com/fff032a962.js" crossorigin="anonymous"></script>
<style>
    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active {
        background-color: #e47f42 !important;
        color: #ffffff;
        font-weight: normal;
    }

    .card-info:not(.card-outline)>.card-header {
        background-color: #0d1218;
    }

    .btn-info {
        color: #fff;
        background-color: #0d1218;
        border-color: #0d1218;
        box-shadow: none;
    }

    /* Scrollbar CSS */
    ::-webkit-scrollbar {
        width: 8px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #b8afaf;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #888;
    }
</style>
<style>
    /* Hide the counter for number input */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
        display: none;
    }

    @media only screen and (max-width: 633px) {

        .buttons-html5,
        .buttons-print,
        .buttons-colvis,
        .btn-info {
            font-size: 0.5rem !important;
        }
    }

    @media only screen and (max-width: 450px) {

        .buttons-html5,
        .buttons-print,
        .buttons-colvis,
        .btn-info {
            /* font-size: 0.4rem !important; */
            padding: 0.375rem .4rem !important;
        }

        .dtr-data {
            font-size: 12px !important;
        }
    }


    @media only screen and (max-width: 383px) {

        .buttons-html5,
        .buttons-print,
        .buttons-colvis,
        .btn-info {
            font-size: 0.4rem !important;
        }

        .form-control-sm {
            display: block !important;
        }

        .flex-wrap {
            flex-wrap: nowrap !important;
        }
    }
</style>
