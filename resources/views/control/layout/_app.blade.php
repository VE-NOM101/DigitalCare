<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard: 
        @if(Auth::user()->role==1){{'User'}}
        @elseif(Auth::user()->role==2){{'Doctor'}}
        @elseif(Auth::user()->role==3){{'Pharmacist'}}
        @elseif(Auth::user()->role==4){{'Admin'}}
        @endif</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ config('app.url') }}/Admin/assets/img/favicon.png" rel="icon">
    <link href="{{ config('app.url') }}/Admin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ config('app.url') }}/Admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ config('app.url') }}/Admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ config('app.url') }}/Admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ config('app.url') }}/Admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="{{ config('app.url') }}/Admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="{{ config('app.url') }}/Admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{ config('app.url') }}/Admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ config('app.url') }}/Admin/assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>


    @include('control.layout._header')
    @include('control.layout._sidebar')
    <main id="main" class="main">
        @yield('content')
    </main><!-- End #main -->

    @include('control.layout._footer')

    <!-- Vendor JS Files -->
    <script src="{{ config('app.url') }}/Admin/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="{{ config('app.url') }}/Admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ config('app.url') }}/Admin/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="{{ config('app.url') }}/Admin/assets/vendor/echarts/echarts.min.js"></script>
    <script src="{{ config('app.url') }}/Admin/assets/vendor/quill/quill.min.js"></script>
    <script src="{{ config('app.url') }}/Admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="{{ config('app.url') }}/Admin/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="{{ config('app.url') }}/Admin/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ config('app.url') }}/Admin/assets/js/main.js"></script>

    <script>
        function submitForm(id) {
          document.getElementById("appointment_form_"+id).submit();
        }
    </script>

</body>

</html>
