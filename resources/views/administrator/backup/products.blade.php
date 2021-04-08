@extends('layouts.administrator.base')

@section('main_content')
 <div class="container-fluid">
    <h2 class="h3 mb-0 pt-3 mr-3">List of Product</h2>
    <hr class="mt-2 mb-4">
    <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#productAddModal"><i class="czi czi-add-circle"></i> Add Product</button>
    <!--Product Add Modal markup -->
      <div class="modal fade" tabindex="-1" role="dialog" id="productAddModal">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ url('administrator/products') }}" id="addProductForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row text-center">
                      <div class="col-md-12" id="image-container">
                        <img src="{{ url('public/images/default-placeholder-image-300x300.png') }}" class="rounded-lg mb-2 " alt="Rounded image" alt="image" id="profile_image_update">
                      </div>
                      <div class="col-md-12">
                        <label class="btn btn-sm btn-warning" for="productImage" type="button">Add image </label>
                        <input type="file" name="product_image" id="productImage" accept="image/*" hidden>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="product_name">Product Name:</label>
                      <input type="text" name="name" class="form-control" placeholder="Enter Product Name" id="product_name">
                    </div>
                    <div class="form-group">
                      <label for="product_description">Description:</label>
                      <textarea name="description" rows="4" id="product_description" class="form-control" placeholder="Enter Product Description"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="product_price">Price:</label>
                      <input type="number" name="price" class="form-control" placeholder="Enter Product Price" id="product_price">
                    </div>
                    <div class="form-group">
                      <label for="product_category">Category:</label>
                      <select name="category_id" id="category_id" class="form-control">
                        <option value="">--Select Category--</option>
                        @foreach ($categories as $category)
                          <option value="{{ $category->fldCategoryID }}">{{ $category->fldCategoryName }}</option>
                        @endforeach
                      </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-sm" form="addProductForm"><i class="czi czi-check-circle"></i> Submit</button>
            </div>
          </div>
        </div>
      </div>

       <!--Product Edit Modal markup -->
       <div class="modal fade" tabindex="-1" role="dialog" id="productEditModal">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" id="editProductForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row text-center">
                      <div class="col-md-12">
                        <img  class="rounded-lg mb-2 " alt="Rounded image" alt="image" id="profile_image_update1">
                      </div>
                      <div class="col-md-12">
                        <label class="btn btn-sm btn-warning" for="productImageUpdate" type="button">Add image </label>
                        <input type="file" name="product_image" id="productImageUpdate" accept="image/*" hidden>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="product_name">Product Name:</label>
                      <input type="text" name="name" class="form-control" placeholder="Enter Product Name" id="product_name">
                    </div>
                    <div class="form-group">
                      <label for="product_description">Description:</label>
                      <textarea name="description" rows="4" id="product_description" class="form-control" placeholder="Enter Product Description"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="product_price">Price:</label>
                      <input type="number" name="price" class="form-control" placeholder="Enter Product Price" id="product_price">
                    </div>
                    <div class="form-group">
                      <label for="product_category">Category:</label>
                      <select name="category_id" id="category_id" class="form-control">
                        <option value="">--Select Category--</option>
                        @foreach ($categories as $category)
                          <option value="{{ $category->fldCategoryID }}">{{ $category->fldCategoryName }}</option>
                        @endforeach
                      </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-warning btn-sm" form="editProductForm"><i class="czi czi-check-circle"></i> Update</button>
            </div>
          </div>
        </div>
      </div>

    <!-- Light table with striped rows -->
<div class="table-responsive">
    <table class="table table-striped bg-white" id="product-list">
      <thead>
        <tr class="table-info">
          <th>id</th>
          <th></th>
          <th>Name</th>
          <th>Price</th>
          <th>Category</th>
          <th>Created at</th>
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
    var productTable = $('#product-list').DataTable({
      destroy:  true,
      autoWidth:  false,
      ajax:{
        url: "{{ url('/administrator/get-product-list') }}",
        dataSrc : ""
      },
      columns: [
            { "defaultContent": '<input type="checkbox" name="ids" >'},
            { "data":  null,
              "render": function(data, type, row){
                if (row.fldProductImage) {
                  return '<img src="'+'{{url("public/images/products")}}'+'/'+row.fldProductImage+'" class="img-thumbnail rounded" alt="Rounded image" style="width:50px">';
                }else {
                  return '<img src="'+'{{ url("public/images/default-placeholder-image-300x300.png") }}'+'" class="img-thumbnail rounded" alt="Rounded image" style="width:50px">';
                }
              }
            },
            { "data": "fldProductName" },
            { "data": "fldProductPrice" },
            { "data": "fldCategoryName" },
            { "data": "fldProductCreatedAt" },
            { "data":  null,
              "render": function(data, type, row){
                return '<div class="btn-group" role="group" aria-label="Basic example">' +
                '<button class="btn btn-danger btn-sm delete-btn"><i class="czi czi-trash"></i></button>' +
                '<button class="btn btn-warning btn-sm edit-btn"><i class="czi czi-edit"></i></button></div>';
              }
            },
      ],
      // "columnDefs": [
      //   {
      //     "targets": 5,
      //     "data": null,
      //     "defaultContent":
      //   }
      // ]
    });

    // delete event
    $('#product-list tbody').on('click', '.delete-btn', function(){
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
    $('#product-list tbody').on('click', '.edit-btn', function(){
      $('#productEditModal').modal('show');
      var data = productTable.row( $(this).parents('tr') ).data();
      var url = "{{ url('administrator/products') . '/' }}" + data.fldProductID;


      $.get(url, function(data, status){
        $('#editProductForm input[name=name]').val(data.fldProductName);
        $('#editProductForm textarea[name=description]').val(data.fldProductDescription);
        $('#editProductForm input[name=price]').val(data.fldProductPrice);
        if (data.fldProductImage !== null) {
          $('#editProductForm img[id=profile_image_update1]').attr('src','{{url("public/images/products")}}'+'/'+data.fldProductImage);
        }else {
          $('#editProductForm img[id=profile_image_update1]').attr('src','{{ url("public/images/default-placeholder-image-300x300.png") }}');
        }

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
  });

  $(document).on("change","#productImage", function(){
      if (this.files[0].size <= 5000000) {
        var tmppath = URL.createObjectURL(event.target.files[0]);
        $('#profile_image_update').fadeIn("fast").attr('src',tmppath);
        $('#productImage').show();
        return true;
      }else {
        swal({
            title: "File is to Big. The image must be 5mb bellow",
            text: false,
            icon: "error",
          });
        $(this).val(null);
        return false;
      }
  });

  $(document).on("change","#productImageUpdate", function(){
    console.log(this.files[0].size <= 5000000);
    if (this.files[0].size <= 5000000) {
    var tmppath = URL.createObjectURL(event.target.files[0]);
    $('#profile_image_update1').fadeIn("fast").attr('src',tmppath);
    $('#productImageUpdate').show();
     return true;
  }else {
    swal({
        title: "File is to Big. The image must be 5mb bellow",
        text: false,
        icon: "error",
      });
    $(this).val(null);
    return false;
  }
  });

</script>

@endsection
