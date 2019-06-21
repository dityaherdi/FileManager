<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="{{ asset('img/logo.ico') }}" type="image/x-icon">

  <title>Bunda FM</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    @toastr_css
</head>

<body class="bg-gradient-primary">
    @php
    if ($errors->any()) {
        foreach ($errors->all() as $message)
        {
            toastr()->error($message, 'Error');
        }
    }
    @endphp
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="p-5">
                    <div class="text-center">
                        <img src="{{ asset('img/logo.ico') }}" style="width: 50px;">
                        <h1 class="h4 text-gray-900 mb-4">Login Bunda FM</h1>
                    </div>
                    <form class="user" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" value="{{ old('nik') }}" name="nik" class="form-control form-control-user" id="inputNik" placeholder="NIK">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control form-control-user" id="inputPassword" placeholder="Password">
                        </div>
                        <button class="btn btn-primary btn-user btn-block">
                            Login
                        </button>
                        <hr>
                    </form>
                    <div class="text-center">
                        <a class="small" href="{{ route('password.forget') }}">Lupa Password?</a> | 
                        <a class="small" href="{{ route('user.manual') }}" target="_blank">Panduan Penggunaan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
        @toastr_js
        @toastr_render
</body>

</html>
