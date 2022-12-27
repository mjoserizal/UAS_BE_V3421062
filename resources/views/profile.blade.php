<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ URL::to('assets/images/logo/logo.ico') }}" type='image/x-icon'>
    <title>User Profile | AdminSystem</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{ url('plugins/fontawesome-free/css/all.min.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ url('dist/css/adminlte.min.css') }}>
</head>

@php
    $URL = url('/');
    if (isset($Use_API)) {
        $URL = url('/apiclient');
    }
@endphp


<body class="hold-transition light-mode sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->

        @include('include.header')

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="./index3.html" class="brand-link">
                <img src="{{ url('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminSystem</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @include('include.sidebar')
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><b>Edit Profile</b></h1>
                        </div>

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Edit Profile</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="container" <div class="col">
                            <div class="card card-primary card-outline">
                                <div class="card-header text-center bg-light text-white mt-3">
                                    <h4>Edit User Data</h4>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="settings">
                                            <form class="form-horizontal" action="{{ $URL . '/user62' }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="name" class="form-control"
                                                            id="inputName" placeholder="Name"
                                                            value="{{ $user['name'] }}"
                                                            {{ $is_preview ? 'disabled' : '' }}>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail"
                                                        class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" name="email" class="form-control"
                                                            id="inputEmail" placeholder="Email"
                                                            value={{ $user['email'] }}
                                                            {{ $is_preview ? 'disabled' : '' }}>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputAlamat"
                                                        class="col-sm-2 col-form-label">Alamat</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="alamat" class="form-control"
                                                            id="inputText" placeholder="Alamat"
                                                            value="{{ $user['detail']['alamat'] }}"
                                                            {{ $is_preview ? 'disabled' : '' }}>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputTanggalLahir"
                                                        class="col-sm-2 col-form-label">Agama</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name="id_agama" id="inputAgama"
                                                            {{ $is_preview ? 'disabled' : '' }}>
                                                            @foreach ($agama as $a)
                                                                <option value="{{ $a['id'] }}"
                                                                    @if ($a['id'] == $user['detail']['id_agama']) selected @endif>
                                                                    {{ $a['nama_agama'] }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>



                                                <div class="form-group row">
                                                    <label for="inputTempatLahir" class="col-sm-2 col-form-label">Tempat
                                                        Lahir</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="tempat_lahir" class="form-control"
                                                            id="inputText" placeholder="Tempat Lahir"
                                                            value="{{ $user['detail']['tempat_lahir'] }}"
                                                            {{ $is_preview ? 'disabled' : '' }}>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputTanggalLahir"
                                                        class="col-sm-2 col-form-label">Tanggal
                                                        Lahir</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" name="tanggal_lahir"
                                                            class="form-control" id="inputText"
                                                            placeholder="Tanggal Lahir"
                                                            value="{{ $user['detail']['tanggal_lahir'] }}"
                                                            {{ $is_preview ? 'disabled' : '' }}>

                                                    </div>
                                                </div>

                                                @if (!$is_preview)
                                                    <div class="form-group">
                                                        <div
                                                            style="width: 100%; display:flex; justify-content:flex-end;">
                                                            <button type="submit"
                                                                class="btn btn-info btn-block">Edit</button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card card-success card-outline">

                        <div class="card-body box-profile">
                            <div class="card-header text-center bg-light text-white mb-2">
                                <h4>Upload Foto Profil</h4>
                            </div>
                            <div class="text-center">
                                @if ($is_preview)
                                    <h2>Foto Profil</h2>
                                @endif
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ url("photo/{$user['foto']}") }}" alt="User profile picture"
                                    style="height: 100px; width:100px;">
                            </div>
                            @if (!$is_preview)
                                <p class="text-muted text-center">{{ $user['role'] }}</p>
                                <form enctype='multipart/form-data' action="{{ $URL . '/user62/photo' }}"
                                    method="POST">
                                    @csrf
                                    <div class="mt-3 form-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="photoProfil" class="custom-file-input"
                                                    id="validatedCustomFile" required>
                                                <label class="custom-file-label" for="exampleInputFile">Pilih
                                                    Foto...</label>

                                            </div>
                                        </div>
                                        <button type="submit" class="mt-3 btn btn-success btn-block"><b>Upload
                                                Foto</b></button>

                                    </div>
                                </form>
                            @endif
                        </div>

                        <!-- /.card-body -->
                    </div>

                    <br>

                    <div class="card card-danger card-outline">
                        <div class="card-body box-profile">
                            <div class="card-header text-center bg-light text-white mb-2">
                                <h4>Upload Foto KTP</h4>
                            </div>
                            <div class="text-center">
                                @if ($is_preview)
                                    <h2>Foto KTP</h2>
                                @endif
                                <img class="profile-user-img img-fluid" style="height: 100px; width:150px;"
                                    src="{{ url("photo/{$user['detail']['foto_ktp']}") }}" </div>

                                @if (!$is_preview)
                                    <form enctype='multipart/form-data' action="{{ $URL . '/user62/photoKTP' }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group mt-3">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="photoKTP" class="custom-file-input"
                                                        id="validatedCustomFile" required>
                                                    <label class="custom-file-label" for="validatedCustomFile">Pilih
                                                        Foto...</label>
                                                    <div class="invalid-feedback">Example invalid custom file
                                                        feedback
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="mt-3 btn btn-danger btn-block"><b>Upload
                                                    Foto KTP</b></button>

                                        </div>
                                    </form>
                                @endif
                            </div>
                            <!-- /.card-body -->
                            <!-- /.col -->
                        </div>
                    </div>
            </section>
        </div>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src={{ url('plugins/jquery/jquery.min.js') }}></script>
    <!-- Bootstrap 4 -->
    <script src={{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <!-- AdminLTE App -->
    <script src={{ url('dist/js/adminlte.min.js') }}></script>
    <!-- AdminLTE for demo purposes -->
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>

</html>
