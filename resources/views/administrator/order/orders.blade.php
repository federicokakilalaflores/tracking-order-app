@extends('layouts.administrator.base')
@section('main_content')
 <div class="container-fluid">
    <h2 class="h3 mb-0 pt-3 mr-3">List of Orders</h2>
    <hr class="mt-2 mb-4">
    <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#orderAddModal"><i class="czi czi-add-circle"></i> Add Order</button>

    <!--Product Add Modal markup -->
      <div class="modal fade" tabindex="-1" role="dialog" id="orderAddModal">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Order</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ url('administrator/orders') }}" method="POST" id="addOrderForm">
                @csrf
                <div class="row mb-3">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="customer_id">Customer:</label>
                      <select name="customer_id" id="customer_id" class="form-control" required>
                         <option value="">Select Customer</option>
                         @foreach ($customers as $customer)
                          <option value="{{ $customer->fldcustomerid }}" class="text-uppercase">{{ $customer->fldcustomerfirstname . " " . $customer->fldcustomermiddlename ." ". $customer->fldcustomerlastname }}</option>
                         @endforeach
                      </select>
                   </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                       <label for="agent_id">Assigned Agent:</label>
                       @if($administrator->fldUserRoles == 1)
                       <select name="agent_id" id="agent_id" class="form-control" required>
                         <option value="">Select Assigned Agent</option>
                         @foreach ($agents as $agent)
                         <option value="{{ $agent->fldUserID }}" class="text-uppercase">{{ $agent->fldUserLastname . ", " . $agent->fldUserFirstname  }}</option>
                         @endforeach
                       </select>
                       @else
                       <p class="form-control border-0 pl-0 text-capitalize">{{isset($administrator->fldUserFirstname) ? $administrator->fldUserFirstname : ""}} {{isset($administrator->fldUserLastname) ? $administrator->fldUserLastname : ""}}</p>
                       <input type="hidden" name="agent_id" value="{{ $administrator->fldUserID }}">
                       @endif
                    </div>
                 </div>
                </div> <hr class="mb-4">

                <div class="row input-row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="product_id">Product:</label>
                      <select name="product_id[]" id="product_id" class="form-control" required>
                         <option value="">Select Product</option>
                         @foreach ($products as $product)
                         <option value="{{ $product->fldProductID }}" class="text-uppercase">{{ $product->fldProductName }}</option>
                         @endforeach
                      </select>
                   </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity[]" id="quantity" class="form-control" placeholder="Enter Quantity" min="1"  required>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="date_received">Estimated Date Received:</label>
                        <input type="date" name="date_received[]" id="date_received" class="form-control">
                     </div>
                  </div>
                  <div class="col-md-3">
                   <div class="form-group">
                      <label for="custom_price">Custom Price:</label>
                      <input type="number" name="custom_price[]" id="custom_price" class="form-control" placeholder="Enter Custom Price" min="0">
                   </div>
                 </div>
               </div>
             </form>
             <button id="addFormInput" class="btn btn-success btn-sm">Add to Order List</button>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-sm" form="addOrderForm"><i class="czi czi-check-circle"></i> Confirm</button>
            </div>
          </div>
        </div>
      </div>

        <!--Product Add Modal markup -->
        <div class="modal fade" tabindex="-1" role="dialog" id="orderViewModal">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-8 col-sm-8">
                        <p class="label mb-0 font-size-sm">Order Number:</p>
                        <p class="font-weight-bold" id="orderNumber"></p>
                      </div>

                  </div><hr class="mb-3">
                  <h6 class="text-primary">CUSTOMER INFORMATION</h6>
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <p class="label mb-0 font-size-sm">Customer Name:</p>
                      <p class="font-weight-bold" id="customerName"></p>
                      <p class="label mb-0 font-size-sm" >Email:</p>
                      <p class="font-weight-bold" id="customerEmail"></p>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <p class="label mb-0 font-size-sm">Contact Number:</p>
                      <p class="font-weight-bold" id="customerContact"></p>
                      <p class="label mb-0 font-size-sm">Address:</p>
                      <p class="font-weight-bold" id="customerAddress"></p>
                    </div>
                </div><hr class="mb-3">
                <h6 class="text-primary">ORDERED PRODUCT</h6>
                <div class="products">

                </div>

              <h6><span class="font-size-sm">TOTAL COST:</span><span class="text-primary" id="totalCost"></span></h6>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


    <!-- Light table with striped rows -->
<div class="table-responsive">
    <table class="table table-striped bg-white" id="order-list">
      <thead>
        <tr class="table-info">
          <th>Order #</th>
          <th>Customer Name</th>
          <th>Product</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>

 </div>
@endsection
@section('scripts')
<script>
  $(document).ready(function() {
    var orderTable = $('#order-list').DataTable({
      destroy:  true,
      ajax:{
        url: "{{ url('/administrator/get-order-list') }}",
        dataSrc : ""
      },
      columns: [
             { "data": "fldOrderNumber" },
            { "data": null,
              "render": function(data, type, row){
                      if (row.fldOrderCustomerList) {
                            return (row.fldOrderCustomerList.fldcustomerfirstname != null ? row.fldOrderCustomerList.fldcustomerfirstname+ ' ' : '') + (row.fldOrderCustomerList.fldcustomermiddlename != null ? row.fldOrderCustomerList.fldcustomermiddlename+ ' ' : '') + (row.fldOrderCustomerList.fldcustomerlastname != null ? row.fldOrderCustomerList.fldcustomerlastname+ ' ' : '');  
                          }else {
                            return "";
                          }
                  }
            },
            { "data": null,
              "render": function(data, type, row){
                  var product = "";
                  row.fldOrderProductList.forEach(element => {
                      if(element){
                        product += element.fldProductName != null ? "<p class='mb-0 text-nowrap'>" + element.fldProductName + "</p>"  : '' ;
                      }
                  });
                  return product;
              }
            },
            { "data": null,
              "render": function(data, type, row){
                var quantity = "";
                  row.fldOrderQuantity.forEach(element => {
                    quantity += "<p class='mb-0 text-nowrap'>" + element + "</p>";
                  });
                  return quantity;

              }
            },
            { "data": null,
              "render": function(data, type, row){
                var price = "";
                  for(var i=0; i < row.fldOrderCustomPrice.length; i++){

                    if(row.fldOrderCustomPrice[i]){
                      price += "<p class='mb-0 text-nowrap'>" + row.fldOrderCustomPrice[i] + "</p>";
                    }else{
                      price += "<p class='mb-0 text-nowrap'>" + row.fldOrderProductList[i].fldProductPrice + "</p>";
                    }
                  }
                  return price;
              }
            }
      ],
      "columnDefs": [
        {
          "targets": 5,
          "data": null,
          "defaultContent": '<div class="btn-group" role="group" aria-label="Basic example">' +
          '<button class="btn btn-info btn-sm view-btn"><i class="czi czi-eye"></i></button></div>'
        }
      ]
    });

    // delete event
    $('#order-list tbody').on('click', '.delete-btn', function(){
      var data = productTable.row( $(this).parents('tr') ).data();
      var url = "{{ url('administrator/products') . '/' }}" + data.fldProductID;

      function removeFunc(){
        $.post(url, {
          _method: "DELETE",
          _token: "{{ csrf_token() }}"
        },function(data, status){
          successMsg(data.success);
          productTable.ajax.reload();
        });
      }

      confirmBox(removeFunc);
    });


    // View event
    $('#order-list tbody').on('click', '.view-btn', function(){
      var productOutput = "";

      $('#orderViewModal').modal('show');
      var data = orderTable.row( $(this).parents('tr') ).data();
      var totalCost = 0;

      $('#orderNumber').text(data.fldOrderNumber);
      $('#customerName').text((data.fldOrderCustomerList.fldcustomerfirstname != null ? data.fldOrderCustomerList.fldcustomerfirstname+ ' ' : '') + (data.fldOrderCustomerList.fldcustomermiddlename != null ? data.fldOrderCustomerList.fldcustomermiddlename+ ' ' : '') + (data.fldOrderCustomerList.fldcustomerlastname != null ? data.fldOrderCustomerList.fldcustomerlastname+ ' ' : ''));
      $('#customerContact').text(data.fldOrderCustomerList.fldcustomercontactnumber);
      $('#customerEmail').text(data.fldOrderCustomerList.fldcustomeremail);
      $('#customerAddress').text(data.fldOrderCustomerList.fldcustomeraddress);

     for(var i=0;i<data.fldOrderProductList.length; i++){

        if(data.fldOrderCustomPrice[i]){
          totalCost += (parseInt(data.fldOrderCustomPrice[i]) * parseInt(data.fldOrderQuantity[i]));
        }else{
          totalCost += (parseInt(data.fldOrderProductList[i].fldProductPrice) * parseInt(data.fldOrderQuantity[i]));
        }

        productOutput += `
            <div class="row">
                <div class="col-md-6 col-sm-6">
                  <p class="label mb-0 font-size-sm">Approximate Date Received:</p>
                  <p class="font-weight-bold" id="dateReceived">${ data.fldOrderDateReceived[i] ? data.fldOrderDateReceived[i] : "N/A" }</p>
                  <p class="label mb-0 font-size-sm">Product Ordered:</p>
                  <p class="font-weight-bold" id="productName">${ data.fldOrderProductList[i].fldProductName }</p>
                  <p class="label mb-0 font-size-sm">Category:</p>
                  <p class="font-weight-bold" id="productCategory">${ data.fldOrderProductList[i].fldCategoryName }</p>
                </div>
                <div class="col-md-6 col-sm-6">
                  <p class="label mb-0 font-size-sm">Price:</p>
                  <p class="font-weight-bold">PHP <span id="productPrice">${ data.fldOrderCustomPrice[i] ? numberWithCommas(data.fldOrderCustomPrice[i]) : numberWithCommas(data.fldOrderProductList[i].fldProductPrice) }</span></p>
                  <p class="label mb-0 font-size-sm">Quantity:</p>
                  <p class="font-weight-bold"><span id="productQuantity">${data.fldOrderQuantity[i]}</span> Item</p>
                </div>
            </div><hr class="mb-3">
        `;
     }

     $('.products').html(productOutput);


      $('#totalCost').text(' PHP ' + numberWithCommas(totalCost));

    });

    //remove input
    $('#addOrderForm').on('click', '.removeInput',function(){
      $(this).parents('.input-row').remove();
    });
    // add input
    $('#addFormInput').click(function(){

        if($('select[name="product_id[]"]:last').val() && $('input[name="quantity[]"]:last').val()){
          $('#addOrderForm').append(`
          <div class="row input-row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="product_id">Product:</label>
                          <select name="product_id[]" id="product_id" class="form-control" required>
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->fldProductID }}" class="text-uppercase">{{ $product->fldProductName }}</option>
                            @endforeach
                          </select>
                      </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity[]" id="quantity" class="form-control" placeholder="Enter Quantity" min="1"  required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="date_received">Estimated Date Received:</label>
                            <input type="date" name="date_received[]" id="date_received" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                      <div class="form-group">
                          <label for="custom_price">Custom Price: <span class="removeInput">&times;</span></label>
                          <input type="number" name="custom_price[]" id="custom_price" class="form-control" placeholder="Enter Custom Price" min="0">
                      </div>
                    </div>
                  </div>
          `);
        }else{
          errorMsg("Please Select Product and Quantity");
        }
    });


  });


</script>

@endsection
