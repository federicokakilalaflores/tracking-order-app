@extends('layouts.administrator.base')

@section('main_content')
 <div class="container-fluid">
    <h2 class="h3 mb-0 pt-3 mr-3">Dashboard</h2>
    <hr class="mt-2 mb-4">
    <div class="row">
        <div class="col-lg col-sm-6 col-lg-3 pl-2 pr-2">
            <div class="card bg-danger mt-2">
                <i class="fa fa-users text-white fa-4x card-icon opacity-50"></i>
                <div class="card-body">
                  <h5 class="card-title text-white"><span class="font-size-sm">Total</span> CUSTOMERS</h5>
                  <h3 class="card-text text-light">{{ $totalCustomer }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg col-sm-6 col-lg-3 pl-2 pr-2">
            <div class="card bg-warning mt-2">
                <i class="fa fa-shopping-cart text-white fa-4x card-icon opacity-50"></i>
                <div class="card-body">
                  <h5 class="card-title text-white"><span class="font-size-sm">Total</span> ORDERS</h5>
                  <h3 class="card-text text-light">{{ $totalOrder }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg col-sm-6 col-lg-3 pl-2 pr-2">
            <div class="card bg-success mt-2">
                <i class="fab fa-product-hunt text-white fa-4x card-icon opacity-50"></i>
                <div class="card-body">
                  <h5 class="card-title text-white"><span class="font-size-sm">Total</span> PRODUCTS</h5>
                  <h3 class="card-text text-light">{{ $totalProduct }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg col-sm-6 col-lg-3 pl-2 pr-2">
            <div class="card bg-info mt-2">
                <i class="fa fa-shipping-fast text-white fa-4x card-icon opacity-50"></i>
                <div class="card-body">
                  <h5 class="card-title text-white"><span class="font-size-sm">Total</span> DELIVERIES</h5>
                  <h3 class="card-text text-light">{{ $totalDelivery }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header"><h5 class="text-uppercase">Recent Orders</h5></div>
        <div class="card-body">
             <!-- Light table with striped rows -->
                <div class="table-responsive mt-3">
                    <table class="table table-striped bg-white" id="recentOrders" style="width:100%">
                    <thead>
                        <tr>
                        <th>Customer Name</th>
                        <th>Product Ordered</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Date Ordered</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->fldUserLastname . ', ' . $order->fldUserFirstname }}</td>
                            <td>{{ $order->fldProductName }}</td>
                            <td>{{ $order->fldOrderCustomPrice ? number_format($order->fldOrderCustomPrice) : number_format($order->fldProductPrice) }}</td>
                            <td>{{ $order->fldOrderQuantity . ' Item' }}</td>
                            <td>
                                @php
                                    $date = new DateTime($order->fldOrderCreatedAt);
                                    $formattedDate = $date->format('M d Y H:i:s');   
                                @endphp
                                {{  $formattedDate  }}    
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
        </div>
    </div>




 </div>
 {{-- end container fluid --}}
@endsection

@section('scripts')
<script>
     $(document).ready(function(){
        $('#recentOrders').DataTable({
            responsive: true,
            searching:false,
            paging:false,
            sorting: false,
            info:false
        });
     });
</script>
@endsection
