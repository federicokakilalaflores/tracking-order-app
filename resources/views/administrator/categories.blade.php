@extends('layouts.administrator.base')

@section('main_content')

 <div class="container-fluid">
    <h2 class="h3 mb-0 pt-3 mr-3">List of Categories</h2>
    <hr class="mt-2 mb-4">
    <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#categoryAddModal"><i class="czi czi-add-circle"></i> Add Category</button>
    <!--Product Add Modal markup -->
      <div class="modal fade" tabindex="-1" role="dialog" id="categoryAddModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ url('administrator/categories') }}" id="addCategoryForm" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="product_name">Category Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Product Name" id="product_name">
                    </div>
                    <div class="form-group">
                        <label for="product_description">Description:</label>
                        <textarea name="description" rows="4" id="product_description" class="form-control" placeholder="Enter Product Description"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-sm" form="addCategoryForm"><i class="czi czi-check-circle"></i> Submit</button>
            </div>
          </div>
        </div>
      </div>

       <!--Product Edit Modal markup -->
       <div class="modal fade" tabindex="-1" role="dialog" id="categoryEditModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="category_name">Category Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Product Name" id="category_name">
                </div>
                <div class="form-group">
                    <label for="category_description">Description:</label>
                    <textarea name="description" rows="4" id="category_description" class="form-control" placeholder="Enter Product Description"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-warning btn-sm" form="editCategoryForm"><i class="czi czi-check-circle"></i> Update</button>
            </div>
          </div>
        </div>
      </div>

    <!-- Light table with striped rows -->
<div class="table-responsive">
    <table class="table table-striped bg-white" id="category-list">
      <thead>
        <tr class="table-info">
          <th>id</th>
          <th>Category Name</th>
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
    var categoryTable = $('#category-list').DataTable({
      destroy:  true,
      ajax:{
        url: "{{ url('/administrator/get-category-list') }}",
        dataSrc : ""
      },
      columns: [
            { "defaultContent": '<input type="checkbox" name="ids" >'
            },
            { "data": "fldCategoryName" },
            { "data": "fldCategoryCreatedAt" },
      ],
      "columnDefs": [
        {
          "targets": 3,
          "data": null,
          "defaultContent": '<div class="btn-group" role="group" aria-label="Basic example">' +
          '<button class="btn btn-danger btn-sm delete-btn"><i class="czi czi-trash"></i></button>' +
          '<button class="btn btn-warning btn-sm edit-btn"><i class="czi czi-edit"></i></button></div>'
        }
      ]
    });

    // delete event
    $('#category-list tbody').on('click', '.delete-btn', function(){
      var data = categoryTable.row( $(this).parents('tr') ).data();
      var url = "{{ url('administrator/categories') . '/' }}" + data.fldCategoryID;

      function removeFunc(){
        $.post(url, {
          _method: "DELETE",
          _token: "{{ csrf_token() }}"
        },function(data, status){
          successMsg(data.success);
          categoryTable.ajax.reload();
        });
      }

      confirmBox(removeFunc);
    });

    // edit event
    $('#category-list tbody').on('click', '.edit-btn', function(){
      $('#categoryEditModal').modal('show');
      var data = categoryTable.row( $(this).parents('tr') ).data();
      var url = "{{ url('administrator/categories') . '/' }}" + data.fldCategoryID;


      $.get(url, function(data, status){
        $('#editCategoryForm input[name=name]').val(data.fldCategoryName);
        $('#editCategoryForm textarea[name=description]').val(data.fldCategoryDescription);
        $('#editCategoryForm').attr('action', '{{ url("administrator/categories/") }}' + '/' + data.fldCategoryID);

      });


    });


  });

</script>

@endsection
