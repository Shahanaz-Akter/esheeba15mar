<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('public/website/images/favicon.png') }}" type="image/png" />
        <!--plugins-->
        <link href="{{ asset('public/admin/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
        <link href="{{ asset('public/admin/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/admin/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
        <!-- Bootstrap CSS -->
        <link href="{{ asset('public/admin/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/admin/css/bootstrap-extended.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/admin/css/style.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/admin/css/icons.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        

        <!-- loader-->
        <link href="{{ asset('public/admin/css/pace.min.css') }}" rel="stylesheet" />


        @yield('title')

        <style>

            #logout:hover{
                color: #ec2024;
            }
                        
        </style>

    </head>

    <body>

        <!--start wrapper-->
        <div class="wrapper">

            @yield('top_header')
            @yield('side_bar')
            
            <main class="page-content">
                @yield('main')
            </main>

            <!--Start Back To Top Button-->
		     <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
             <!--End Back To Top Button-->

        </div>
        <!--end wrapper-->

  <!-- Bootstrap bundle JS -->
  <script src="{{ asset('public/admin/js/bootstrap.bundle.min.js') }}"></script>
  <!--plugins-->
  <script src="{{ asset('public/admin/js/jquery.min.js') }}"></script>
  <script src="{{ asset('public/admin/plugins/simplebar/js/simplebar.min.js') }}"></script>
  <script src="{{ asset('public/admin/plugins/metismenu/js/metisMenu.min.js') }}"></script>
  <script src="{{ asset('public/admin/js/pace.min.js') }}"></script>
  <script src="{{ asset('public/admin/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('public/admin/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('public/admin/js/table-datatable.js') }}"></script>
  <!--app-->
  <script src="{{ asset('public/admin/js/app.js') }}"></script>
</body>

</html>