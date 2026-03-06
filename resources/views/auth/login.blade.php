<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <link rel="stylesheet" href="{{ asset('auth/style.css') }}">
    <style>
        .password-container {
            position: relative;
            margin-bottom: 1em; /* Optional, adjust as needed */
        }
        .password-container input {
            width: 100%;
            padding-right: 2.5em; /* Adjust padding to make space for the icon */
        }
        .password-container .toggle-password {
            position: absolute;
            right: 0.5em; /* Adjust position as needed */
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2em;
            color: #333; /* Optional: adjust color if needed */
        }
        .error-message {
            color: red;
            margin-bottom: 1em;
        }
    </style>
</head>

<body>
    <div class="wrapper active-popup">

        <!-- Login Form -->
        <div class="form-box login active">
            <h2>Masuk</h2>
            <form action="{{ route('auth.loginMethod') }}" method="POST">
                @csrf
                @if ($errors->has('email'))
                    <div class="error-message">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                @if ($errors->has('password'))
                    <div class="error-message">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email">
                    {{-- <label>Email</label> --}}
                </div>
                <div class="input-box password-container">
                    <input type="password" name="password" id="loginPassword" required placeholder="Kata sandi">
                    {{-- <label>Kata sandi</label> --}}
                    <span class="icon" id="toggleLoginPassword"><ion-icon name="eye"></ion-icon></span>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox"> Ingat saya</label>
                    <a href="{{ route('auth.forgotPassword') }}">Lupa kata sandi?</a>
                </div>
                <button type="submit" class="btn">Masuk</button>
                <div class="login-register">
                    <p>Belum punya akun?<a href="#" class="register-link"> Daftar</a></p>
                </div>
                <div class="back">
                    <p><a href="{{ route('users.index') }}">Kembali</a></p>
                </div>
            </form>
        </div>

        <!-- Registration Form -->
        <div class="form-box register">
            <h2>Daftar</h2>
            <form id="registrationForm" action="{{ route('auth.registerMethod') }}" method="POST">
                @csrf
                @if ($errors->has('nama_pengguna'))
                    <div class="error-message">
                        {{ $errors->first('nama_pengguna') }}
                    </div>
                @endif
                @if ($errors->has('email'))
                    <div class="error-message">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                @if ($errors->has('password'))
                    <div class="error-message">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="nama_pengguna" value="{{ old('nama_pengguna') }}" required placeholder="Nama">
                    {{-- <label>Nama</label> --}}
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email">
                    {{-- <label>Email</label> --}}
                </div>
                <div class="input-box password-container">
                    <input type="password" name="password" id="registerPassword" required placeholder="Kata sandi">
                    {{-- <label>Kata sandi</label> --}}
                    <span class="icon" id="toggleRegisterPassword"><ion-icon name="eye"></ion-icon></span>
                    <small id="passwordHelp" class="form-text text-muted">
                        Harus mengandung setidaknya satu huruf besar dan satu angka.
                    </small>
                </div>
                <div class="input-box password-container mt-5">
                    <input type="password" name="confirm_password" id="ConfirmregisterPassword" required placeholder="Konfirmasi Kata Sandi">
                    {{-- <label>Konfirmasi Kata Sandi</label> --}}
                    <span class="icon" id="toggleConfirmRegisterPassword"><ion-icon name="eye"></ion-icon></span>
                    <div class="attention">
                        Harus mengandung setidaknya satu huruf besar dan satu angka.
                    </div>
                </div>
                <button type="submit" class="btn" id="registerBtn">Daftar</button>
                <div class="login-register">
                    <p>Sudah punya akun?<a href="#" class="login-link"> Masuk</a></p>
                </div>
                <div class="back">
                    <p><a href="{{ route('users.index') }}">Kembali</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('auth/script.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const registerPassword = document.getElementById('registerPassword');
            const ConfirmregisterPassword = document.getElementById('ConfirmregisterPassword');
            const loginPassword = document.getElementById('loginPassword');
            const registerBtn = document.getElementById('registerBtn');
            const passwordHelp = document.getElementById('passwordHelp');

            function validatePassword() {
                const value = registerPassword.value;
                const hasUpperCase = /[A-Z]/.test(value);
                const hasNumber = /[0-9]/.test(value);

                if (hasUpperCase && hasNumber) {
                    passwordHelp.textContent = '';
                    return true;
                } else {
                    passwordHelp.textContent = 'Password must contain at least one uppercase letter and one number.';
                    return false;
                }
            }

            registerPassword.addEventListener('input', validatePassword);
            ConfirmregisterPassword.addEventListener('input', validatePassword);

            document.getElementById('registrationForm').addEventListener('submit', function (event) {
                if (!validatePassword()) {
                    event.preventDefault();
                    alert('Please ensure your password meets the criteria.');
                }
            });

            document.getElementById('toggleRegisterPassword').addEventListener('click', function () {
                const type = registerPassword.type === 'password' ? 'text' : 'password';
                registerPassword.type = type;
                this.querySelector('ion-icon').setAttribute('name', type === 'password' ? 'eye' : 'eye-off');
            });
            document.getElementById('toggleConfirmRegisterPassword').addEventListener('click', function () {
                const type = ConfirmregisterPassword.type === 'password' ? 'text' : 'password';
                ConfirmregisterPassword.type = type;
                this.querySelector('ion-icon').setAttribute('name', type === 'password' ? 'eye' : 'eye-off');
            });

            document.getElementById('toggleLoginPassword').addEventListener('click', function () {
                const type = loginPassword.type === 'password' ? 'text' : 'password';
                loginPassword.type = type;
                this.querySelector('ion-icon').setAttribute('name', type === 'password' ? 'eye' : 'eye-off');
            });
        });
    </script>
</body>

</html>
