<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Audit Mutu Internal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
     
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-wrapper {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-header {
            background-color: #264de4;
            color: white;
            padding: 30px 20px 20px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .login-header img {
            width: 100px;
            margin: 15px 0;
        }

        .form-group {
            text-align: left;
            position: relative;
        }

        .form-group i {
            position: absolute;
            right: 15px;
            top: 40px;
            cursor: pointer;
        }

        input.form-control {
            padding-right: 40px;
            background-color: #f1f5f9;
        }

        .btn-login {
            background-color: #264de4;
            color: white;
            font-weight: bold;
        }

        .btn-login:hover {
            background-color: #1e40af;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-header">
        <h5>SELAMAT DATANG</h5>
        <p>Pelaksanaan Audit Mutu Internal<br>Politeknik Negeri Banyuwangi</p>
        <img src="{{ asset('assets/img/logo_poliwangi.png') }}" alt="Logo Poliwangi" style="width: 100px;">

    </div>

    <form method="POST" action="{{ route('login') }}" class="p-3">
        @csrf
        <div class="form-group">
            <label for="email">Username</label>
            <input id="email" type="email" name="email"
                   class="form-control @error('email') is-invalid @enderror" required autofocus>
            <i class="bi bi-person-fill"></i>
            @error('email')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror" required>
            <i class="bi bi-eye-slash-fill" id="togglePassword"></i>
            @error('password')
                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-login btn-block rounded-pill">LOG IN</button>
    </form>
</div>

<script>
    // Toggle password visibility
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('bi-eye-fill');
        this.classList.toggle('bi-eye-slash-fill');
    });
</script>

</body>
</html>
