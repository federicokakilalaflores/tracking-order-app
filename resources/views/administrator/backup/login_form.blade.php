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
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>
    <link rel="stylesheet" media="screen" href="{{ url('public/dist/vendor/simplebar/dist/simplebar.min.css') }}"/>
    <link rel="stylesheet" media="screen" href="{{ url('public/dist/vendor/tiny-slider/dist/tiny-slider.css') }}"/>
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="{{ url('public/dist/css/theme.min.css') }}">
    <link rel="stylesheet" media="screen" href="{{ url('public/libs/css/admin_custom.css') }}">
  </head>
  <!-- Body-->
  <body class="bg-secondary">
 <div class="container-fluid mt-5">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                  <h2 class="h4 mb-1">Sign in <small class="text-primary font-size-sm">ADMINISTRATOR<small></h2>
                 <hr class="mb-4 mt-3">
                  <form method="POST" action="{{ url('administrator/authenticate') }}">
                    @csrf
                    <div class="input-group-overlay form-group">
                      <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="czi-mail"></i></span></div>
                      <input class="form-control prepended-form-control" name="email" type="email" placeholder="Email" required>
                    </div>
                    <div class="input-group-overlay form-group">
                      <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="czi-locked"></i></span></div>
                      <div class="password-toggle">
                        <input class="form-control prepended-form-control" name="password" type="password" placeholder="Password" required>
                        <label class="password-toggle-btn">
                          <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Show password</span>
                        </label>
                      </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between">
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" checked id="remember_me">
                        {{-- <label class="custom-control-label" for="remember_me">Remember me</label> --}}
                      </div>
                    </div>
                    <div class="text-right pt-4">
                      <button class="btn btn-primary" type="submit"><i class="czi-sign-in mr-2 ml-n21"></i>Sign In</button>
                    </div>
                  </form>
                </div>
              </div>
        </div>
        <div class="col-lg-3"></div>
      </div>
   </div>
  </main>
  <!-- Vendor scrits: js libraries and plugins-->
  {{-- <script src="{{ url('public/dist/vendor/jquery/dist/jquery.slim.min.js') }}"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  {{-- <script src="{{ url('public/dist/vendor/jquery/dist/jquery.slim.min.js') }}"></script> --}}
  <script src="{{ url('public/dist/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('public/dist/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js') }}"></script>
  <script src="{{ url('public/dist/vendor/simplebar/dist/simplebar.min.js') }}"></script>
  <script src="{{ url('public/dist/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
  <script src="{{ url('public/dist/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
  <!-- Main theme script-->
  <script src="{{ url('public/dist/js/theme.min.js') }}"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
  <script src="{{ url('public/dist/js/sweetalert.min.js') }}"></script>
  <script>
      function successMsg(msg){
        swal({
          title: "Successful!",
          text: msg,
          icon: "success",
          button: "Ok",
        });
      }

      function errorMsg(msg){
        swal({
          title: "Error!",
          text: msg,
          icon: "error",
          button: "Ok",
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
            } else {
              swal("Your Record is safe!");
            }
        });
    }

      @if(session('success'))
        successMsg("{{ session('success') }}");
      @elseif(session('error'))
        errorMsg("{{ session('error') }}");
      @endif

  </script>
</body>
</html>
