@extends('layouts.administrator.base')
@section('main_content')
<div class="card mb-3">
  <div class="card-header">
    <div class="h5 mb-0">New Role</div>
  </div>

  <div class="card-body">
    <div class="border rounded position-relative bg-white p-3">
      <form method="post" action="{{url('/administrator/role')}}" enctype="multipart/form-data">
      <div class="form-row">
          <div class="col-12">
            <div class="form-group">
              <label for="video-title">Name <span class="text-danger">*</span></label>
              <input class="form-control form-control-md"  type="text" placeholder="Name" name="name" value="{{isset($roles) && isset($roles->fldrolename) ? $roles->fldrolename : ''}}" required>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label for="video-title">Access <span class="text-danger">*</span></label><br>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" name="access[]" value="product" type="checkbox" id="product" {{isset($roles) && in_array("product", $roles->fldroleaccess) ? "checked='checked'" : ""}}>
                <label class="custom-control-label" for="product">All Products</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" name="access[]" value="product_categories" type="checkbox" id="product_categories" {{isset($roles) && in_array("product_categories", $roles->fldroleaccess) ? "checked='checked'" : ""}}>
                <label class="custom-control-label" for="product_categories">Product Categories</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" name="access[]" value="user" type="checkbox" id="user" {{isset($roles) && in_array("user", $roles->fldroleaccess) ? "checked='checked'" : ""}}>
                <label class="custom-control-label" for="user">Users</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" name="access[]" value="customer_order" type="checkbox" id="customer_order" {{isset($roles) && in_array("customer_order", $roles->fldroleaccess) ? "checked='checked'" : ""}}>
                <label class="custom-control-label" for="customer_order">Customer Orders</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" name="access[]" value="order" type="checkbox" id="order" {{isset($roles) && in_array("order", $roles->fldroleaccess) ? "checked='checked'" : ""}}>
                <label class="custom-control-label" for="order">Orders</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" name="access[]" value="customer" type="checkbox" id="customer" {{isset($roles) && in_array("customer", $roles->fldroleaccess) ? "checked='checked'" : ""}}>
                <label class="custom-control-label" for="customer">Customer</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" name="access[]" value="roles" type="checkbox" id="roles" {{isset($roles) && in_array("roles", $roles->fldroleaccess) ? "checked='checked'" : ""}}>
                <label class="custom-control-label" for="roles">Roles</label>
              </div>
            </div>
          </div>
        <input type="hidden" name="roleid" value="{{isset($roles) ? $roles->fldroleid : null}}">
        <div class="clearfix">
          <div class="col-6 float-left">
            <div class="form-group">
              <input class="btn btn-primary mr-1 mb-1" type="submit" value="Save">
            </div>
          </div>
          <div class="col-6 float-left">
            <div class="form-group">
              <a href="{{url('/administrator/role')}}" class="btn btn-secondary mr-1 mb-1">Cancel</a>
            </div>
          </div>
        </div>
      </div>
      @csrf
    </form>
    </div>
  </div>
</div>

@endsection
@section('scripts')

@endsection
