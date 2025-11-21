<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <!-- SB Admin 2 CSS -->
    <link href="/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/template/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .login-card {
            border-radius: 15px;
            padding: 30px;
        }

        .btn-login {
            background-color: #4e73df;
            border: none;
            font-weight: 600;
            padding: 10px;
            border-radius: 8px;
            transition: 0.2s;
        }

        .btn-login:hover {
            background-color: #2e59d9;
            transform: scale(1.02);
        }
    </style>
</head>

<body class="bg-gradient-light">

<div class="container mt-5">

    <div class="col-md-4 mx-auto">

        <div class="card shadow login-card">
            <h4 class="text-center mb-4 text-primary">
                <i class="fas fa-user-shield me-2"></i>Login Admin
            </h4>

            @if ($errors->has('login_error'))
                <div class="alert alert-danger">
                    {{ $errors->first('login_error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.process') }}">
                @csrf

                <div class="mb-3">
                    <label class="fw-semibold">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-login w-100">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </button>
            </form>

            <div class="text-center mt-3">
                <small>Belum punya akun?  
                    <a href="{{ route('register') }}" class="text-primary fw-semibold">
                        Daftar
                    </a>
                </small>
            </div>

        </div>

    </div>

</div>

</body>
</html>
