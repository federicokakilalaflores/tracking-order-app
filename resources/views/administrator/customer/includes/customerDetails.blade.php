  <form action="{{ url('administrator/customer') }}" method="POST">
    <div class="row">
        <div class="col-md-6 col-sm-6">

          <div class="form-group">
            <label for="firstname">Firstname:</label>
            <input type="text" name="firstname" class="form-control" placeholder="Enter Firstname" id="firstname" value="{{isset($customer) ? $customer->fldcustomerfirstname : ''}}" required>
            @error('firstname')<small class="text-danger">{{ $message }}</small>@enderror
          </div>

          <div class="form-group">
            <label for="middlename">Middlename:</label>
            <input type="text" name="middlename" class="form-control" placeholder="Enter Middlename" id="middlename" value="{{isset($customer) ? $customer->fldcustomermiddlename : ''}}">
            @error('middlename')<small class="text-danger">{{ $message }}</small>@enderror
          </div>

          <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Email Address" id="email" value="{{isset($customer) ? $customer->fldcustomeremail : ''}}">
            @error('email')<small class="text-danger">{{ $message }}</small>@enderror
          </div>

          <div class="form-group">
            <label for="roles">Agent:</label>
            @if($administrator->fldUserRoles === '1')
              <select name="agent" id="agent" class="form-control">
                @foreach($users as $user)
                  <option value="{{$user->fldUserID}}" {{isset($customer) && $customer->fldcustomeragentid == $user->fldUserID ? "selected='selected'" : "" }} >{{$user->fldUserFirstname}} {{$user->fldUserMiddlename}} {{$user->fldUserLastname}}</option>
                @endforeach
              </select>
            @else
              <input type="text" class="form-control" name="agent" value="{{$administrator->fldUserFirstname}} {{$administrator->fldUserMiddlename}} {{$administrator->fldUserLastname}}" disabled>
            @endif
          </div>

        </div>

        <div class="col-md-6 col-sm-6">

          <div class="form-group">
            <label for="lastname">Lastname:</label>
            <input type="text" name="lastname" class="form-control" placeholder="Enter Lastname" id="lastname" value="{{isset($customer) ? $customer->fldcustomerlastname : ''}}">
            @error('lastname')<small class="text-danger">{{ $message }}</small>@enderror
          </div>

          <div class="form-group">
            <label for="contact_number">Contact Number:</label>
            <input type="text" name="contact_number" class="form-control" placeholder="Enter Contact Number" id="contact_number" value="{{ isset($customer) ? $customer->fldcustomercontactnumber : '' }}">
            @error('contact_number')<small class="text-danger">{{ $message }}</small>@enderror
          </div>

          <div class="form-group">
            <label for="address">Home Address:</label>
            <textarea name="address" rows="5" class="form-control" placeholder="Enter Complete Address">{{ isset($customer) ? $customer->fldcustomeraddress : '' }}</textarea>
            @error('address')<small class="text-danger">{{ $message }}</small>@enderror
          </div>
          <input type="hidden" name="customerid" value="{{isset($customer) ? $customer->fldcustomerid : null}}">
        </div>
        @csrf
    </div>
    <div class="row d-flex justify-content-end">
      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary btn-sm"><i class="czi czi-check-circle"></i> Submit</button>
    </div>
  </form>
