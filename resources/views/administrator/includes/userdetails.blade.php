  <form action="{{ url('administrator/users') }}" method="POST">
    <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="form-group">
            <label for="firstname">Firstname:</label>
            <input type="text" name="firstname" class="form-control" placeholder="Enter Firstname" id="firstname" value="{{isset($userdata) ? $userdata->fldUserFirstname : ''}}">
            @error('firstname')<small class="text-danger">{{ $message }}</small>@enderror
          </div>
          <div class="form-group">
            <label for="middlename">Middlename:</label>
            <input type="text" name="middlename" class="form-control" placeholder="Enter Middlename" id="middlename" value="{{isset($userdata) ? $userdata->fldUserMiddlename : ''}}">
            @error('middlename')<small class="text-danger">{{ $message }}</small>@enderror
          </div>
          <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Email Address" id="email" value="{{isset($userdata) ? $userdata->fldUserEmail : ''}}">
            @error('email')<small class="text-danger">{{ $message }}</small>@enderror
          </div>
          <div class="form-group">
            <label for="address">Home Address:</label>
            <textarea name="address" rows="5" class="form-control" placeholder="Enter Complete Address">{{ isset($userdata) ? $userdata->fldUserAddress : '' }}</textarea>
            @error('address')<small class="text-danger">{{ $message }}</small>@enderror
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="form-group">
            <label for="lastname">Lastname:</label>
            <input type="text" name="lastname" class="form-control" placeholder="Enter Lastname" id="lastname" value="{{isset($userdata) ? $userdata->fldUserLastname : ''}}">
            @error('lastname')<small class="text-danger">{{ $message }}</small>@enderror
          </div>
          <div class="form-group">
            <label for="contact_number">Contact Number:</label>
            <input type="text" name="contact_number" class="form-control" placeholder="Enter Contact Number" id="contact_number" value="{{ isset($userdata) ? $userdata->fldUserContactNumber : '' }}">
            @error('contact_number')<small class="text-danger">{{ $message }}</small>@enderror
          </div>
          <div class="form-group">
            <label for="roles">Roles:</label>
            <select name="roles" id="roles" class="form-control">
              <option value="">--Select Roles--</option>
              @foreach($roles as $role)
                <option value="{{$role->fldroleid}}" {{ isset($userdata) && $userdata->fldUserRoles == "$role->fldroleid" ? "selected='selected'" : "" }}>{{$role->fldrolename}}</option>
              @endforeach
            </select>
            @error('roles')<small class="text-danger">{{ $message }}</small>@enderror
          </div>
          <div class="form-group">
            <label for="roles">Status:</label>
            <select name="status" id="roles" class="form-control">
              <option value="">--Select Status--</option>
              <option value="active" {{ isset($userdata) && $userdata->fldUserStatus == "active" ? "selected='selected'" : ""}}>Active</option>
              <option value="disable" {{ isset($userdata) && $userdata->fldUserStatus == "disable" ? "selected='selected'" : ""}}>Disable</option>
            </select>
            @error('roles')<small class="text-danger">{{ $message }}</small>@enderror
          </div>
          <input type="hidden" name="userid" value="{{isset($userdata) ? $userdata->fldUserID : ''}}">
          <input type="hidden" name="password" value="{{isset($userdata) ? $userdata->fldUserPassword : ''}}">
        </div>
        @csrf
    </div>
    <div class="row d-flex justify-content-end">
      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary btn-sm"><i class="czi czi-check-circle"></i> Submit</button>
    </div>
  </form>
