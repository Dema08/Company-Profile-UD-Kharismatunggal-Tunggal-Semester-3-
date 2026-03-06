<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Kharisma Tunggal</title>

    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="shortcut icon" href="{{ asset('user_assets/img/logo.png')  }}" type="image/x-icon">
    <meta property="og:image" content="{{ asset('user_assets/img/logo.png')  }}">
    <link
      href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />

    <!-- feather icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- my style -->
    <link rel="stylesheet" href="{{ asset('user_assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <body>
    @include('sweetalert::alert')
    @php
    $pengaturan =  \App\Models\Pengaturan::where('id_pengaturan',1)->first();
    @endphp
    @include('users.layout.navbar')
    @yield('content')
    @include('users.layout.footer')
    <!-- feather icons -->
    <script>
      feather.replace();
    </script>

    <!-- my javascript -->
    <script src="{{ asset('user_assets/js/script.js') }}"></script>
  </body>
</html>
