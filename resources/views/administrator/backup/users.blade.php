@extends('layouts.administrator.base')

@section('main_content')

 <div class="container-fluid">
    <h2 class="h3 mb-0 pt-3 mr-3">List of Users</h2>
    <hr class="mt-2 mb-4">
    <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#userAddModal"><i class="czi czi-add-circle"></i> Add User</button>
    <!--Product Add Modal markup -->
      <div class="modal fade" tabindex="-1" role="dialog" id="userAddModal">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ url('administrator/users') }}" id="addUserForm" method="POST">
                @csrf
                  <div class="row">
                      <div class="col-md-6 col-sm-6">
                        <input type="hidden" name="status" value="active">
                        <div class="form-group">
                          <label for="firstname">Firstname:</label>
                          <input type="text" name="firstname" class="form-control" placeholder="Enter Firstname" id="firstname" tabindex="1" value="{{ old('firstname') }}">
                          @error('firstname')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group">
                          <label for="middlename">Middlename:</label>
                          <input type="text" name="middlename" class="form-control" placeholder="Enter Middlename" id="middlename" tabindex="3" value="{{ old('middlename') }}">
                          @error('middlename')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group">
                          <label for="email">Email Address:</label>
                          <input type="email" name="email" class="form-control" placeholder="Enter Email Address" id="email" tabindex="5" value="{{ old('email') }}">
                          @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group">
                          <label for="address">Home Address:</label>
                          <textarea name="address" rows="5" class="form-control" placeholder="Enter Complete Address">{{ old('address') }}</textarea>
                          @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="lastname">Lastname:</label>
                          <input type="text" name="lastname" class="form-control" placeholder="Enter Lastname" id="lastname" tabindex="2" value="{{ old('lastname') }}">
                          @error('lastname')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group">
                          <label for="contact_number">Contact Number:</label>
                          <input type="text" name="contact_number" class="form-control" placeholder="Enter Contact Number" id="contact_number" tabindex="4" value="{{ old('contact_number') }}">
                          @error('contact_number')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group">
                          <label for="roles">Roles:</label>
                          <select name="roles" id="roles" class="form-control">
                            <option value="">--Select Roles--</option>
                            @foreach($roles as $role)
                              <option value="{{$role->fldroleid}}" {{ old('roles') == "$role->fldroleid" ? "selected":"" }}>{{$role->fldrolename}}</option>
                            @endforeach
                          </select>
                          @error('roles')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group">
                          <label for="password">Password:</label>
                          <input type="password" name="password" class="form-control" placeholder="Enter Password" id="password">
                          @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group">
                          <label for="password_confirmation">Password Confirmation:</label>
                          <input type="password" name="password_confirmation" class="form-control" placeholder="Enter Password Confirmation" id="password_confirmation">
                          @error('password_confirmation')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                      </div>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-sm" form="addUserForm"><i class="czi czi-check-circle"></i> Submit</button>
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

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-warning btn-sm" form="editCategoryForm"><i class="czi czi-check-circle"></i> Update</button>
            </div>
          </div>
        </div>
      </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="updateUser">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="updateUserData">
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
          <th>Name</th>
          <th>Contact Number</th>
          <th>Roles</th>
          <th>Status</th>
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
        url: "{{ url('/administrator/get-user-list') }}",
        dataSrc : ""
      },
      columns: [
            { "defaultContent": '<input type="checkbox" name="ids" >'
            },
            { "data": null,
              "render": function(data, type, row){
                  return row.fldUserLastname + ', ' + row.fldUserFirstname + ' ' + row.fldUserMiddlename;
              }
            },
            { "data": "fldUserContactNumber" },
            { "data": "fldrolename" },
            { "data": "fldUserStatus" },
            { "data": null,
              "render": function(data, type, row){
                var action_data = '';
                action_data += '<div class="btn-group" role="group" aria-label="Basic example">';
                if (row.actionID != '1') {
                  action_data += '<button class="btn btn-danger btn-sm delete-btn" onClick="deleteUser('+row.fldUserID+')"><i class="czi czi-trash"></i></button>';
                }

                action_data += '<button class="btn btn-warning btn-sm edit-btn" onClick="updateUser('+row.fldUserID+')"><i class="czi czi-edit"></i></button></div>';

                return action_data;
              }

            },
      ],
      // "columnDefs": [
      //   {
      //     "targets": 5,
      //     "data": null,
      //     "defaultContent": '<div class="btn-group" role="group" aria-label="Basic example">' +
      //     '<button class="btn btn-danger btn-sm delete-btn"><i class="czi czi-trash"></i></button>' +
      //     '<button class="btn btn-warning btn-sm edit-btn"><i class="czi czi-edit"></i></button></div>'
      //   }
      // ]
    });

  });

  function deleteUser(userid){
    swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this Record!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.get("{{url('/administrator/delete-user-process')}}"+"/"+userid).done(function(data){
              $('#category-list').DataTable().destroy();
              var categoryTable = $('#category-list').DataTable({
                destroy:  true,
                ajax:{
                  url: "{{ url('/administrator/get-user-list') }}",
                  dataSrc : ""
                },
                columns: [
                      { "defaultContent": '<input type="checkbox" name="ids" >'
                      },
                      { "data": null,
                        "render": function(data, type, row){
                            return row.fldUserLastname + ', ' + row.fldUserFirstname + ' ' + row.fldUserMiddlename;
                        }
                      },
                      { "data": "fldUserContactNumber" },
                      { "data": "fldUserRoles" },
                      { "data": "fldUserStatus" },
                      { "data": null,
                        "render": function(data, type, row){
                          var action_data = '';
                          action_data += '<div class="btn-group" role="group" aria-label="Basic example">';
                          if (row.actionID != '1') {
                            action_data += '<button class="btn btn-danger btn-sm delete-btn" onClick="deleteUser('+row.fldUserID+')"><i class="czi czi-trash"></i></button>';
                          }

                          action_data += '<button class="btn btn-warning btn-sm edit-btn" onClick="updateUser('+row.fldUserID+')"><i class="czi czi-edit"></i></button></div>';

                          return action_data;
                        }

                      },
                ],
              });

              successMsg("Your Record has been deleted!");
            });
          }
      });
  }

  function updateUser(userid){
    $('#updateUser').modal('show');
    $('#updateUserData').html('Loading...');
    $('#updateUserData').load("{{url('/administrator/user-update')}}"+"/"+userid);
  }

</script>

@endsection
