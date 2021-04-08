<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Tracking App
    </title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Cartzilla - Bootstrap E-commerce Template">
    <meta name="keywords" content="bootstrap, shop, e-commerce, market, modern, responsive,  business, mobile, bootstrap 4, html5, css3, jquery, js, gallery, slider, touch, creative, clean">
    <meta name="author" content="Createx Studio">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>
    <link rel="stylesheet" media="screen" href="{{ url('public/dist/vendor/simplebar/dist/simplebar.min.css') }}"/>
    <link rel="stylesheet" media="screen" href="{{ url('public/dist/vendor/tiny-slider/dist/tiny-slider.css') }}"/>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="{{ url('public/dist/css/theme.min.css') }}">
    <link rel="stylesheet" media="screen" href="{{ url('public/libs/css/admin_custom.css') }}">
    @yield('stylesheets')
  </head>
  <!-- Body-->
  <body class="bg-secondary">
  @include('layouts.administrator.sidebar')
  @include('layouts.administrator.header')
  <main class="sidebar-fixed-enabled" style="padding-top: 5rem;">
    <section class="px-lg-3 pt-4">
      @yield('main_content')
    </section>
    @include('layouts.administrator.footer')

  <!-- Back To Top Button-->
  <a class="btn-scroll-top" href="#top" data-scroll><span class="btn-scroll-top-tooltip text-muted font-size-sm mr-2">Top</span><i class="btn-scroll-top-icon czi-arrow-up">   </i></a>
  </main>
    <!-- Vendor scrits: js libraries and plugins-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- <script src="{{ url('public/dist/vendor/jquery/dist/jquery.slim.min.js') }}"></script> --}}
    <script src="{{ url('public/dist/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/dist/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ url('public/dist/vendor/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ url('public/dist/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
    <script src="{{ url('public/dist/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
    <!-- Main theme script-->
    <script src="{{ url('public/dist/js/theme.min.js') }}"></script>
    <script src="{{ url('public/dist/js/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  
    <script>

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function successMsg(msg){
          swal({
            title: "Successful!",
            text: msg,
            icon: "success",
            button: "Ok!",
          });
        }

        function errorMsg(msg){
          swal({
            title: "Error!",
            text: msg,
            icon: "error",
            button: "Ok!",
          });
        }


      function confirmBox(callbackFunc){
        swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this Record!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                callbackFunc();
                swal("Your Record has been deleted!", {
                  icon: "success",
                });
              }
          });
      }

        @if(session('success'))
          successMsg("{{ session('success') }}");
        @elseif(session('error'))
          errorMsg("{{ session('error') }}");
        @endif

    </script>
    @yield('scripts')
  </body>
</html>
