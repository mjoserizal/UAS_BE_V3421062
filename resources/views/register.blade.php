<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="icon" href="{{ URL::to('assets/images/logo/logo.ico') }}" type='image/x-icon'>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
</head>

<body class="hold-transition register-page">
    <div class="registerbox">
        <div class="login-logo">
            <b>Duk</b>capil</a>
        </div>
    </div>
    <div class="register-box">
        <div class="card card-outline card-success">
            <div class="card-body">
                <p class="login-box-msg">Daftar Akun</p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ url('/register62') }}" class="md-float-material">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" placeholder="Enter Your Name">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    {{-- insert defaults --}}
                    <input type="hidden" class="image" name="image" value="photo_defaults.jpg">

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-lg @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" placeholder="Enter Your Email">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password"
                            class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
                            placeholder="Choose Password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-lg" name="repassword"
                            placeholder="Choose Confirm Password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                    </div>
                    <button class="btn btn-success btn-block btn-lg shadow-lg">Sign Up</button>
                </form>
                <hr>
                <p class="mb-0 text-center">
                    <a>Sudah Punya Akun? </a><a href="{{ url('/login62') }}" class="text-center">Login</a>
                </p>


            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{ asset('../../plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('../../plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('../../dist/js/adminlte.min.js') }}"></script>
</body>

</html>
