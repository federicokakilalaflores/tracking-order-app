@extends('layouts.administrator.base')

@section('main_content')

 <div class="container-fluid">
   <div class="row mb-4">
     <h2 class="h3 mb-0 pt-3 mr-3">Customer</h2>
     <button type="button" class="btn btn-primary btn-sm ml-auto" onClick="addCustomer()"><i class="czi czi-add-circle"></i> Add Customer</button>
   </div>
   <div class="row">
     <div class="table-responsive">
       <table class="table table-striped bg-white" id="customer-list">
         <thead>
           <tr class="table-info">
             <th>Name</th>
             <th>Contact Number</th>
             <th>Agent</th>
             <th></th>
           </tr>
         </thead>
         <tbody>
           @foreach($customers as $customer)
             <tr>
               <td>{{$customer->fldcustomerfirstname}} {{$customer->fldcustomermiddlename}} {{$customer->fldcustomerlastname}}</td>
               <td>{{$customer->fldcustomercontactnumber}}</td>
               <td>{{$customer->agent}}</td>
               <td>
                 <button class="btn btn-danger btn-sm delete-btn" onClick="deleteCustomer('{{$customer->fldcustomerid}}')"><i class="czi czi-trash"></i></button>
                 <button class="btn btn-warning btn-sm edit-btn ml-1" onClick="updateCustomer('{{$customer->fldcustomerid}}')"><i class="czi czi-edit"></i></button></div>
               </td>
             </tr>
           @endforeach
         </tbody>
       </table>
     </div>
   </div>
 </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="customerModal">
   <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="customerModalLabel">Add New Customer</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body" id="customerModalData">
       </div>
     </div>
   </div>
  </div>

@endsection
@section('scripts')
<script>
  $('#customer-list').DataTable({
    autoWidth:false,
  });

  function addCustomer(customerid){
    $('#customerModal').modal('show');
    $('#customerModalData').html('Loading...');
    $('#customerModalLabel').html('Add New Customer');
    $('#customerModalData').load("{{url('/administrator/add-customer')}}");
  }
  function updateCustomer(customerid){
    $('#customerModal').modal('show');
    $('#customerModalData').html('Loading...');
    $('#customerModalLabel').html('Update Customer');
    $('#customerModalData').load("{{url('/administrator/update-customer')}}"+"/"+customerid);
  }

  function deleteCustomer(customerid){
    swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this Record!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.get("{{url('/administrator/delete-customer')}}"+"/"+customerid).done(function(data){
              $('#customer-list').DataTable().destroy();
              $('#customer-list').DataTable({
                destroy:  true,
                autoWidth:false,
                ajax:{
                  url: "{{ url('/administrator/customer-get-data') }}",
                  dataSrc : ""
                },
                columns: [
                      { "data": "customerName" },
                      { "data": "fldcustomercontactnumber" },
                      { "data": "agent" },
                      { "data": null,
                        "render": function(data, type, row){
                          var action_data = '';
                          action_data += '<div class="btn-group" role="group" aria-label="Basic example">';
                          action_data += '<button class="btn btn-danger btn-sm delete-btn" onClick="deleteCustomer('+row.fldcustomerid+')"><i class="czi czi-trash"></i></button>';

                          action_data += '<button class="btn btn-warning btn-sm edit-btn ml-1" onClick="updateCustomer('+row.fldcustomerid+')"><i class="czi czi-edit"></i></button></div>';

                          return action_data;
                        }
                      },
                    ],
              });
            });
          }
      });
  }
</script>

@endsection
