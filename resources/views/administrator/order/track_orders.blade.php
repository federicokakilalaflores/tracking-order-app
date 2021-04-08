@extends('layouts.administrator.base')
@section('main_content')
 <div class="container-fluid">
    <h2 class="h3 mb-0 pt-3 mr-3">Tracked Orders</h2>
    <hr class="mt-2 mb-4">

    <!-- Light table with striped rows -->
<div class="table-responsive">
    <table class="table table-striped bg-white" id="order-list">
      <thead>
        <tr class="table-info">
          <th>Tracking #</th>
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
            { "data": "fldOrderTrackNumber" },
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
            },
            { "data": null,
              "render": function(data, type, row){
                  return '<a class="btn btn-warning btn-sm" href="{{ url('administrator/track-orders') }}/'+ row.fldOrderID +'"><i class="fa fa-shipping-fast"></i> Order Status</a>' ;
              }
            },
      ]
    //   "columnDefs": [
    //     {
    //       "targets": 5,
    //       "data": null,
    //       "defaultContent":
    //       '<a class="btn btn-warning btn-sm" href="{{ url('administrator/track-orders/show') }}"><i class="fa fa-shipping-fast"></i> Track</a>'
    //     }
    //   ]
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

    // edit event
    $('#order-list tbody').on('click', '.edit-btn', function(){
      $('#productEditModal').modal('show');
      var data = orderTable.row( $(this).parents('tr') ).data();
      var url = "{{ url('administrator/products') . '/' }}" + data.fldProductID;


      $.get(url, function(data, status){
        $('#editProductForm input[name=name]').val(data.fldProductName);
        $('#editProductForm textarea[name=description]').val(data.fldProductDescription);
        $('#editProductForm input[name=price]').val(data.fldProductPrice);

        $('#editProductForm select > option').each(function(){
            if( $(this).val() == data.fldCategoryID ){
              $(this).attr('selected', 'selected');
            }else{
              $(this).removeAttr('selected');
            }
        })

        $('#editProductForm').attr('action', '{{ url("administrator/products/") }}' + '/' + data.fldProductID);

      });

    });

    // View event
    $('#order-list tbody').on('click', '.view-btn', function(){
      $('#orderViewModal').modal('show');
      var data = orderTable.row( $(this).parents('tr') ).data();
      var totalCost = 0;

      totalCost = (data.fldProductPrice * data.fldOrderQuantity);

      $('#orderNumber').text(data.fldOrderNumber);
      $('#dateReceived').text(data.fldOrderDateReceived);
      $('#customerName').text(data.fldUserLastname + ', ' + data.fldUserFirstname);
      $('#customerContact').text(data.fldUserContactNumber);
      $('#customerEmail').text(data.fldUserEmail);
      $('#customerAddress').text(data.fldUserAddress);
      $('#productName').text(data.fldProductName);
      $('#productPrice').text(numberWithCommas(data.fldProductPrice));
      $('#productCategory').text(data.fldCategoryName);
      $('#productQuantity').text(data.fldOrderQuantity);
      $('#totalCost').text(' PHP ' + numberWithCommas(totalCost));

      console.log(data);
    });

  });

</script>

@endsection
