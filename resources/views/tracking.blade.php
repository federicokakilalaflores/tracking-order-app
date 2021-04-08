<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tracking App</title>
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
  <link rel="stylesheet" media="screen" href="{{ url('public/dist/css/theme.min.css') }}">
  <link rel="stylesheet" media="screen" href="{{ url('public/libs/css/pages_custom.css') }}">
</head>
<body>

    <div class="jumbotron" id="main-banner" >
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark mb-4" id="main-navbar">
          <a class="navbar-brand" href="#">TRACK MY <span>ORDER</span></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="javascript:voide(0)">Customer Service: (+63) 986 4584 212</a>
              </li>
            </ul>
          </div>
        </nav>
        <div class="row">
            <div class="col-md-2">
              <img src="{{ url('public/images/logo.png') }}" alt="logo" id="main-logo">
            </div>
            <div class="col-md-10">
              <ul class="text-white website-info mt-4" style="list-style-type:none">
                <li><h4 class="font-weight-bold website-name"><span>4D</span> <span>GOLD SCANNER</span></h4></li>
                <li><p class="mb-1">Online Market Place</p></li>
                <li><i class="fa fa-link"></i><a href="https://4dgoldscanner.com/" target="_blank" rel="noreferrer"> 4dgoldscanner.com</a></li>
              </ul>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">

              <div class="input-group mb-3 mt-4">
                <input type="text" class="form-control" placeholder="Enter Your Tracking Number" id="tracking_input">
                <div class="input-group-append">
                  <button class="btn btn-success track-btn" type="button"><i class="fa fa-binoculars" aria-hidden="true"></i> Track Package</button>
                </div>
              </div>

            </div>
        </div>
      </div>
    </div>

    <div class="container">
      <h2>Order Status: <span class="text-primary trackNumberLabel"><span></h2>
      <hr class="mb-4" style="background-color: #ccc;height:1px">

      <div class="row">
        <div class="col-md-8">
          <div id="resultBox">
            <div id="default-result">
              <p>Order status goes here...</p>
              <!-- Primary spinner -->
            </div>

          </div>
        </div>
        <div class="col-md-4" id="contactResult">
          <div class="info-box p-3">
            <h6>Customer Support</h6>
            <ul style="list-style: none; padding:0">
              <li><i class="fa fa-phone p-2"></i> <b>Mobile Number:</b> </li>
              <li class="pl-4"></i>(+63) 986 4584 212</li>
              <li><i class="fa fa-envelope p-2"></i> <b>Email:</b> </li>
              <li class="pl-4">trackmyorder.customerservice@gmail.com</li>
            </ul>
        </div>
        </div>
      </div>

     </div>

     <footer class="bg-dark text-light p-5 mt-5">
       <div class="container">
          <div class="row">
            <div class="col-md-8">
              &copy; Copyright 2021, Tracking App
            </div>
            <div class="col-md-4">
              <p>Customer Service: </p>
              (+63) 986 4584 212
            </div>
        </div>
       </div>


     </footer>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="{{ url('public/dist/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('public/dist/js/sweetalert.min.js') }}"></script>
  {{-- <script src="{{ url('public/dist/js/theme.min.js') }}"></script>  --}}
  <script>
      $(document).ready(function(){
        var resultBox = $('#resultBox');

        $('#tracking_input').on('input', function(){
         $changeLetter =  $(this).val().toUpperCase();
         $(this).val($changeLetter);
        })

        $('.track-btn').on('click', function(){
          var trackNumber = "";

          if($('#tracking_input').val()){
            trackNumber = $('#tracking_input').val()
          }else{
            trackNumber = "";
          }

          var url = "{{ url('/get-orders') . '/' }}" + trackNumber;
            if(trackNumber){
              $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                beforeSend: function(){
                  resultBox.html('<div class="spinner-border text-primary loader d-block" role="status" > <span class="sr-only">Loading...</span></div>');
                  $('.track-btn').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Searching...');
                },
                success: function(data, status){
    
                  if(data.length > 0){
                      if(status == "success"){
                      $('.track-btn').html('<i class="fa fa-binoculars" aria-hidden="true"></i> Track Package');
                      var output = "";
                      $('.trackNumberLabel').text(data[3]);
                      if(data[0]){
                        $.each(data[0] , function(index ,product) {
                            output += `
                            <div class="row mb-3">
                            <div class="col-md-4">
                            <img src="{{ url('public/images/products') }}${'/' + product.fldProductImage}" alt="prod"  class="img-thumbnail rounded" style="width:100%">
                            </div>
                            <div class="col-md-8">
                            <ul class="p-0" style="list-style-type:none">
                            <li><h5 class="font-weight-bold">${product.fldProductName}</h5></li>
                            <li><p class="mb-1">${product.fldProductDescription}</p></li>
                            <li></li>
                            </ul>
                            </div>
                            </div>
                            `;
                        });
                      }


                      output += `<table class="table table-bordered bg-white" id="track-table">`;
                      data[1].forEach(element => {
                        var mydate = new Date(element.fldTrackStatusDate);
                          output += `
                          <tr>
                              <td style="width:20%">${mydate.toDateString()} <div class="circle"></div></td>
                              <td style="width:80%">
                                <h6 class="text-capitalize">${element.fldTrackStatusPlace}</h6>
                                <p>${element.fldTrackStatusMessage}!</p>
                              </td>
                          </tr>
                          `;
                      });

                      output += `</table>`;

                      if(data[1].length > 0 && data[0] != null){
                        resultBox.html(output);
                      }else if(data[1].length == 0 && data[0]){
                        resultBox.html('<div class="alert alert-info"><i class="fa fa-exclamation-circle"></i> Wait for your Order Status. Your Parcel is still in process</div>');
                      }else{
                        resultBox.html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> No Records Match!</div>');
                      }

                    } 
                  }else{ 
                    $('.track-btn').html('<i class="fa fa-binoculars" aria-hidden="true"></i> Track Package');
                    resultBox.html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> No Records Match!, Please check again your Tracking Number.</div>');
                  }
                 
                }
              });
            }else{
              swal({
                title: "Warning!",
                text: "Please Enter your Tracking Number.",
                icon: "warning",
                button: "Ok!",
              });
            }

        });


      });
  </script>
</body>
</html>
