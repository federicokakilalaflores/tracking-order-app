@extends('layouts.administrator.base')
@section('main_content')
 <div class="container-fluid">
   <div class="row">
      <div class="col-sm-7 col-md-7">
         <h2 class="h3 mb-0 pt-3 mr-3">Track Order <span class="font-size-sm text-primary">{{ $order->fldOrderTrackNumber }}</span></h2>
      </div>
      <div class="col-sm-5 col-md-5 p-2">
         <input type="checkbox"  data-toggle="toggle" data-on="Delivering" data-off="Received" data-onstyle="success" data-offstyle="danger" id="OrderStatusInput" data-number="{{ $order->fldOrderTrackNumber }}"
         {{ $order->fldOrderStatus == 1 ? 'checked' : '' }} >
      </div>
   </div>
   <hr class="mt-2 mb-4">

         <h5 class="text-primary">ORDER DETAILS</h5>
         <div class="row">
            <div class="col-sm-4 col-md-4">
               <p class="mb-0 font-size-sm">ORDER NUMBER:</p>
               <p><span class="font-weight-bold">{{ $order->fldOrderNumber }}</span></p>
            </div>
            <div class="col-sm-4 col-md-4">
               <p class="mb-0 font-size-sm">CUSTOMER NAME:</p>
               <p><span class="font-weight-bold text-capitalize">{{ $order->fldOrderCustomerList->fldcustomerfirstname . " " . $order->fldOrderCustomerList->fldcustomermiddlename. " " . $order->fldOrderCustomerList->fldcustomerlastname }}</span></p>
            </div>
            <div class="col-sm-4 col-md-4">
               <p class="mb-0 font-size-sm">AGENT ASSIGNED:</p>
               <p><span class="font-weight-bold text-capitalize">{{ $order->fldOrderAgentList->fldUserLastname . ", " . $order->fldOrderAgentList->fldUserFirstname }}</span></p>
            </div>
         </div>
         @php
             $totalCost = 0;
         @endphp
         {{-- loop here --}}
         @foreach ($order->fldOrderProductList as $key => $myorder)
         @php
            if( $order->fldOrderCustomPrice[$key] ){
               $totalCost += ($order->fldOrderCustomPrice[$key] * $order->fldOrderQuantity[$key]);
            }else{
               $totalCost += ($myorder->fldProductPrice * $order->fldOrderQuantity[$key]);
            }
         @endphp
         <hr class="mt-4 mb-4">
         <div class="row">
            <div class="col-sm-3 col-md-3">
               <p class="mb-0 font-size-sm">PRODUCT ORDERED:</p>
               <p><span class="font-weight-bold">{{ $myorder->fldProductName }}</span></p>
            </div>
            <div class="col-sm-3 col-md-3">
               <p class="mb-0 font-size-sm">PRICE:</p>
               <p><span class="font-weight-bold">{{ $order->fldOrderCustomPrice[$key] ? $order->fldOrderCustomPrice[$key] : $myorder->fldProductPrice }}</span></p>
            </div>
            <div class="col-sm-3 col-md-3">
               <p class="mb-0 font-size-sm">APPROXIMATE RECEIVED DATE:</p>
               <p><span class="font-weight-bold">{{ $order->fldOrderDateReceived[$key] ? $order->fldOrderDateReceived[$key] : "N/A"  }}</span></p>
            </div>
         </div>

      <div class="row mt-2">
         <div class="col-sm-3 col-md-3">
            <p class="mb-0 font-size-sm">QUANTITY:</p>
            <p><span class="font-weight-bold">{{ $order->fldOrderQuantity[$key] }}</span></p>
         </div>
         <div class="col-sm-3 col-md-3">
            <p class="mb-0 font-size-sm">CATEGORY:</p>
            <p><span class="font-weight-bold">{{ $myorder->fldCategoryName }}</span></p>
         </div>
         <div class="col-sm-3 col-md-3">

         </div>
      </div>
      @endforeach
      {{-- end loop heres --}}
      <hr class="mb-4">
      <div class="row mt-2">
         <div class="col-sm-12 col-md-12">
            <p class="mb-0 font-weight-bold"><span class="font-size-sm">TOTAL COST:</span>   <span class="text-primary font-size-lg">{{ number_format($totalCost,2) }}</span></p>
         </div>
      </div>
      <hr class="mb-4 mt-4">
      <h5 class="text-primary">ADD ORDER STATUS</h5>
      <div class="row">
         <div class="col-sm-6 col-md-6 col-lg-6">
            <form action="{{ url('administrator/track-status/') }}" method="POST" id="trackStatusForm">
               @csrf
               <input type="hidden" name="order_id" value="{{ $order->fldOrderID }}">
               <div class="form-group">
                  <label for="date">Tracking Date:</label>
                  <input type="date" name="date" id="date" class="form-control" required>
               </div>
               <div class="form-group">
                  <label for="place">Order Current Place:</label>
                  <input type="text" name="place" id="place" class="form-control" placeholder="eg. Manila" required>
               </div>

         </div>
         <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
               <label for="status">Order Status:</label>
               <textarea name="status" rows="5" class="form-control" id="status" placeholder="eg. Ready for Cargo Shipment." required></textarea>
            </div>
         </div>
         <button type="submit" class="btn btn-primary btn-sm ml-3" id="submitStatus">Add to Status</button>
      </form>
      </div>
      <hr class="mt-4">
      <h5 class="text-primary mt-4">ORDER STATUS</h5>
      <div class="table-responsive">
         <table class="table table-striped table-bordered" id="trackStatus" style="width:100%">
           <thead class="table-light">
             <tr>
               <th>Date</th>
               <th>Order Status</th>
               <th>Actions</th>
             </tr>
           </thead>
           <tbody>

           </tbody>
         </table>
       </div>
   </div>
 </div>
@endsection
@section('scripts')
<script>
   $(document).ready(function(){

      var trackStatus =  $('#trackStatus').DataTable({
         destroy:  true,
            ajax:{
            url: "{{ url('/administrator/get-track-status') }}" + "/"  + "{{ $order->fldOrderID }}",
            dataSrc : ""
            },
            columns: [
                  { "data": null,
                     "render": function(data, type, row){
                           var date = new Date(row.fldTrackStatusDate);
                           return date.toDateString();
                     }
                  },
                  { "data": null,
                     "render": function(data, type, row){
                           return '<b>[' + row.fldTrackStatusPlace + ']</b> ' + row.fldTrackStatusMessage;
                     }
                  },
                  { "data": null,
                     "render": function(data, type, row){
                           return '<button class="btn btn-danger btn-sm delete-btn"><i class="czi czi-trash"></i></button>' ;
                     }
                  },
            ]
      });


      // this is the id of the form
      $("#trackStatusForm").submit(function(e) {

         e.preventDefault();

         var form = $(this);
         var url = form.attr('action');

         $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(),
               beforeSend: function(){
                  $('#submitStatus').text('Saving...');
               },
               success: function(data)
               {
                     $('#submitStatus').text('Add to Status');
                     trackStatus.ajax.reload();
               }
         });
      });

      // delete btn
      $('#trackStatus tbody').on('click', '.delete-btn', function(){
         var data = trackStatus.row( $(this).parents('tr') ).data();
         var url = "{{ url('administrator/track-status') . '/' }}" + data.fldTrackStatusID;

         function removeFunc(){
            $.post(url, {
               _method: "DELETE",
               _token: "{{ csrf_token() }}"
            },function(data, status){
               successMsg(data.success);
               trackStatus.ajax.reload();
            });
         }

         confirmBox(removeFunc);

      });

      $('#OrderStatusInput').change(function(){
         var url = "{{ url('administrator/orders/update-status')  }}";
         var status = 0;

         if($(this).prop('checked')){
            status = 1;
         }else{
            status =2;
         }

         $.post(url, {
            number: $(this).data('number'),
            status: status,
            _method:"POST",
            _token: "{{ csrf_token() }}"
         }, function(data, status){
            if(status == "success"){
                  if(status == 1){
                     $('#OrderStatusInput').attr('checked', 'checked')
                  }else if(status == 2){
                     $('#OrderStatusInput').removeAttr('checked');
                  }
                  successMsg(data.success);
            }
         });

      });


   });


</script>

@endsection
