@extends('layouts.administrator.base')
@section('main_content')
 <div class="container-fluid">
   <div class="row">
     <h2 class="h3 mb-0 mr-3">Roles</h2>
     <a class="btn btn-primary btn-sm ml-auto" href="{{url('/administrator/role/add-new')}}">Add new roles</a>
   </div>
    <hr class="mt-2 mb-4">
    <!-- Light table with striped rows -->
    <div class="table-responsive">
    <table class="table table-striped bg-white" id="table-role">
      <thead>
        <tr class="table-info">
          <th>Name</th>
          <th>Access</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($roles as $role)
          <tr>
            <td>{{$role->fldrolename}}</td>
            <td>{{$role->fldroleaccess}}</td>
            <td>
              @if($role->fldroleid != 1)
              <button class="btn btn-danger btn-sm delete-btn" onClick="deleteRoles('{{$role->fldroleid}}')"><i class="czi czi-trash"></i></button>
              @endif
              <a class="btn btn-warning btn-sm edit-btn" href="{{url('/administrator/role/update'.'/'.$role->fldroleid)}}"><i class="czi czi-edit"></i></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
 </div>
@endsection
@section('scripts')

<script>

  $('#table-role').DataTable();

  function deleteRoles(userid){
    swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this Record!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {

          }
      });
  }

</script>

@endsection
