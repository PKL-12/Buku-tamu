<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>

    <!-- SB Admin 2 CSS -->
    <link href="/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/template/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .register-card {
            border-radius: 15px;
            padding: 30px;
        }

        .btn-register {
            background-color: #4e73df;
            border: none;
            font-weight: 600;
            padding: 10px;
            border-radius: 8px;
            transition: 0.2s;
        }

        .btn-register:hover {
            background-color: #2e59d9;
            transform: scale(1.02);
        }
    </style>
</head>

<body class="bg-gradient-light">

<div class="container mt-5">

    <div class="col-md-5 mx-auto">

        <div class="card shadow register-card">
            <h4 class="text-center mb-4 text-primary">
                <i class="fas fa-user-plus me-2"></i>Daftar Admin Baru
            </h4>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-register w-100 mt-2">
                    <i class="fas fa-user-plus me-2"></i> Daftar
                </button>
            </form>

            <div class="text-center mt-3">
                <small>Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-primary fw-semibold">
                        Login
                    </a>
                </small>
            </div>

        </div>

    </div>
</div>

</body>
</html>
