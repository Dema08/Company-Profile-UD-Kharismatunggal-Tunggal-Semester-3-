<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .password-error {
            color: red;
            font-size: 0.875em;
        }
    </style>
</head>

<body>
    <section class="bg-light p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xxl-11">
                    <div class="card border-light-subtle shadow-sm">
                        <div class="row g-0">
                            <div class="col-12 col-md-6">
                                <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="{{ asset('auth/polije.jpeg') }}" alt="Reset Password">
                            </div>
                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                <div class="col-12 col-lg-11 col-xl-10">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-5">
                                                    <div class="text-center mb-4">
                                                        <a href="#!">
                                                            <img src="{{ asset('auth/logo.jpg') }}" alt="Logo" width="175" height="100">
                                                        </a>
                                                    </div>
                                                    <h2 class="h4 text-center">Reset Password</h2>
                                                    <h3 class="fs-6 fw-normal text-secondary text-center m-0">Enter your new password below.</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="resetPasswordForm" action="{{ route('password.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <div class="row gy-3 overflow-hidden">
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="{{ old('email', $email) }}" required>
                                                        <label for="email" class="form-label">Email</label>
                                                        @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="New Password" required>
                                                        <label for="password" class="form-label">New Password</label>
                                                        <div class="password-error" id="passwordError"></div>
                                                        @error('password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                        @error('password_confirmation')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-dark btn-lg" type="submit">Reset Password</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const passwordError = document.getElementById('passwordError');
            const form = document.getElementById('resetPasswordForm');

            function validatePassword() {
                const value = passwordInput.value;
                const hasUpperCase = /[A-Z]/.test(value);
                const hasNumber = /[0-9]/.test(value);
                const isLongEnough = value.length >= 8;

                if (hasUpperCase && hasNumber && isLongEnough) {
                    passwordError.textContent = '';
                    return true;
                } else {
                    let errorMessages = [];
                    if (!hasUpperCase) errorMessages.push('Password must contain at least one uppercase letter.');
                    if (!hasNumber) errorMessages.push('Password must contain at least one number.');
                    if (!isLongEnough) errorMessages.push('Password must be at least 8 characters long.');
                    passwordError.textContent = errorMessages.join(' ');
                    return false;
                }
            }

            passwordInput.addEventListener('input', validatePassword);

            form.addEventListener('submit', function (event) {
                if (!validatePassword()) {
                    event.preventDefault();
                    alert('Please ensure your password meets the criteria.');
                }
            });
        });
    </script>
</body>

</html>
