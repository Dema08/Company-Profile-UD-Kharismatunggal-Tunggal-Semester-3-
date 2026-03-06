<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        /* Section styles */
        .bg-light {
            background-color: #f8f9fa;
        }

        .p-3 {
            padding: 0.5rem;
        }

        .p-md-4 {
            padding: 1rem;
        }

        .p-xl-5 {
            padding: 1.5rem;
        }

        .container {
            max-width: 100%; /* Reduced width */
            width: 100%;
        }

        /* Card styles */
        .custom-card {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            background-color: #fff;

        }

        .custom-card .card-body {
            padding: 1rem; /* Reduced padding */
        }

        .img-fluid {
            max-width: 100%;
            height: 90vh;
        }

        .rounded-start {
            border-top-left-radius: 0.375rem;
            border-bottom-left-radius: 0.375rem;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        /* Typography */
        .text-center {
            text-align: center;
        }

        .text-secondary {
            color: #6c757d;
        }

        .h4 {
            font-size: 1.25rem; /* Reduced font size */
        }

        .fs-6 {
            font-size: 0.75rem; /* Reduced font size */
        }

        .fw-normal {
            font-weight: 400;
        }

        .m-0 {
            margin: 0;
        }

        .mb-5 {
            margin-bottom: 1rem; /* Reduced margin */
        }

        .mb-4 {
            margin-bottom: 0.75rem; /* Reduced margin */
        }

        /* Form styles */
        .form-floating {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.5rem; /* Reduced padding */
            font-size: 0.875rem; /* Reduced font size */
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
        }

        .form-label {
            position: absolute;
            top: 0.5rem;
            left: 0.5rem;
            font-size: 0.75rem; /* Reduced font size */
            color: #495057;
            pointer-events: none;
            transition: all 0.1s ease-in-out;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: 0.5rem 1rem; /* Reduced padding */
            border-radius: 0.375rem;
        }

        /* Buttons */
        .btn-dark {
            color: #fff;
            background-color: #343a40;
            border: 1px solid #343a40;
            padding: 0.5rem 1rem; /* Reduced padding */
            font-size: 0.875rem; /* Reduced font size */
            border-radius: 0.375rem;
        }

        .btn-lg {
            font-size: 1rem; /* Reduced font size */
            padding: 0.5rem 1rem; /* Reduced padding */
        }

        /* Links */
        .link-secondary {
            color: #6c757d;
            text-decoration: none;
        }

        .link-secondary:hover {
            color: #343a40;
            text-decoration: underline;
        }

        /* Utility classes */
        .d-flex {
            display: flex;
            flex-direction: column;
        }

        .justify-content-center {
            justify-content: center;
        }

        .flex-column {
            flex-direction: column;
        }

        .flex-md-row {
            flex-direction: row;
        }

        .mt-5 {
            margin-top: 1rem; /* Reduced margin */
        }

        .gy-3 {
            gap: 1rem;
        }

        @media (max-width: 768px) {
            .img-fluid {
                object-fit: contain; 
                width: 100%; 
                height: auto;
                display: none;
            }

            .card-body{
                justify-content: center;
                align-items: center;
            }

            .col-12{
                justify-content: center;
                text-align: center;
                padding-bottom: 0.5rem
            }

}

    </style>

</head>

<body>
    <section class="bg-light p-3 p-md-4 p-xl-5">
        <div class="container custom-container" >
            <div class="row justify-content-center">
                <div class="col-12 col-xxl-11">
                    <div class="card custom-card border-light-subtle shadow-sm">
                        <div class="row g-0">
                            <div class="col-12 col-md-6">
                                <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="{{ asset('auth/polije.jpeg') }}" alt="Forgot Password">
                            </div>
                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                <div class="col-12 col-lg-11 col-xl-10">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-5">
                                                    <div class="text-center mb-4">
                                                        <a href="#!">
                                                            <img src="{{ asset('auth/logo.png') }}" alt="Logo" width="100" height="100">
                                                        </a>
                                                    </div>
                                                    <h2 class="h4 text-center">Forgot Password</h2>
                                                    <h3 class="fs-6 fw-normal text-secondary text-center m-0">Provide the email address associated with your account to recover your password.</h3>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Display status message if any -->
                                        @if (session('status'))
                                            <div class="alert alert-success">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                                        <form action="{{ route('password.email') }}" method="POST">
                                            @csrf
                                            <div class="row gy-3 overflow-hidden">
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                                                        <label for="email" class="form-label">Email</label>
                                                        @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-dark btn-lg w-100" type="submit">Send Reset Link</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-5">
                                                    <a href="{{ route('auth.loginMethod') }}" class="link-secondary text-decoration-none">Login</a>
                                                </div>
                                            </div>
                                        </div>
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
</body>

</html>
