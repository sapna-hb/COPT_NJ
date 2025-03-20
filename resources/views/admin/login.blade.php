<!doctype html>
<html lang="en">

<head>
    <title>Coptnj Admin Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ url('/') }}/assets/admin/logo/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ url('/') }}/assets/admin/dist/css/login.css">
    <!-- Alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h2 class="heading-section">Welcome to <b>CoptNJ</b></h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex align-items-center justify-content-center">
                            {{-- style="background: linear-gradient(90deg, rgba(227,86,159,1) 0%, rgba(240,96,136,1) 41%, rgba(246,140,93,1) 100%)" --}}
                            {{-- <span class="fa fa-user-o"></span> --}}
                            <img class="mb-2"
                                src="{{ url('/') }}/assets/admin/logo/comprehensive-orthopedic-physical-therapy-logo-somerset-nj-300x138.png"
                                alt="">
                        </div>
                        <h3 class="text-center mb-4">Sign In</h3>
                        <form action="{{ route('admin.validateLogin') }}" method="POST" id="loginForm"
                            class="login-form">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <input type="text" name="input_user" id="input_user"
                                    class="form-control rounded-left" placeholder="Contact Number"
                                    @if (Cookie::has('saved_input')) value="{{ Cookie::get('saved_input') }}" class="form-control fill" @else  class="form-control rounded-left" @endif>
                                <small id="input_user_error"></small>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" name="input_password" id="input_password"
                                        class="form-control rounded-left" placeholder="Password"
                                        @if (Cookie::has('saved_password')) value="{{ Cookie::get('saved_password') }}" class="form-control fill" @else class="form-control rounded-left" @endif>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-eye-slash" id="togglePassword"></i>
                                        </span>
                                    </div>
                                </div>
                                <small id="input_password_error"></small>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="login_btn" class="form-control btn rounded submit px-3"
                                    style="background: linear-gradient(90deg, rgba(227,86,159,1) 0%, rgba(240,96,136,1) 41%, rgba(246,140,93,1) 100%); color: white"><b>Login</b>
                                </button>
                            </div>
                            {{-- <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Remember Me
                                        <input type="checkbox" name="remember_me" id="remember_me" value="true"
                                            @if (Cookie::has('saved_input')) checked="checked" @else checked="" @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="javascript:void(0)">Forgot Password ?</a>
                                </div>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="{{ url('/') }}/assets/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('/') }}/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- jquery-validation -->
    {{-- <script src="{{ url('/') }}/assets/admin/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{ url('/') }}/assets/admin/plugins/jquery-validation/additional-methods.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/additional-methods.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('/') }}/assets/admin/dist/js/adminlte.min.js"></script>
    <!-- Alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <!-- Login JS -->
    <script src="{{ url('/') }}/assets/admin/ajax/login.js"></script>
    <script>
        // var validateLogin = '{{ route('admin.validateLogin') }}';

        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('input_password');
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                this.className = 'fa fa-eye';
            } else {
                passwordInput.type = "password";
                this.className = 'fa fa-eye-slash';
            }
        });
    </script>

</body>

</html>
