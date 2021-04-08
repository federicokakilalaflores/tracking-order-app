   <!-- Sidebar menu-->
   <aside class="cz-sidebar cz-sidebar-fixed" id="sideNav" style="padding-top: 5rem;">
    <button class="close" type="button" data-dismiss="sidebar" aria-label="Close"><span class="d-inline-block font-size-xs font-weight-normal align-middle">Close sidebar</span><span class="d-inline-block align-middle ml-2" aria-hidden="true">&times;</span></button>
    <div class="cz-sidebar-inner">
      <div class="user-profile mt-3">
        <img src="{{ url('public/images/admin.jpg') }}" class="img-thumbnail rounded-circle user-img" alt="Circle image">
        <p class="text-center mb-0 text-capitalize">{{isset($administrator->fldUserFirstname) ? $administrator->fldUserFirstname : ""}} {{isset($administrator->fldUserLastname) ? $administrator->fldUserLastname : ""}}</p>
      </div>


      <div class="pl-4 pb-2 pr-4 mt-3 font-weight-bold border-bottom text-primary">Main Menu</div>
      <div class="cz-sidebar-body pt-0 pb-0" data-simplebar>
        <div class="tab-content">
          <!-- Categories-->
          <div class="sidebar-nav tab-pane fade show active" id="categories" role="tabpanel">
            <div class="widget widget-categories">
              <div class="accordion" id="categories">
                {{-- dashboard --}}
                <div class="card border-bottom">
                  <div class="card-header">
                    <h3 class="accordion-heading font-size-base px-grid-gutter"><a class="collapsed py-3 {{ $active_page == "dashboard" ? "text-primary" : ""}} " href="{{ url('administrator/dashboard') }}"><span class="d-flex align-items-center">
                        <i class="fa fa-tachometer-alt font-size-lg text-danger mt-n1 mr-2"></i>Dashboard</span></a>
                    </h3>
                  </div>
                </div>
                <!-- Products-->
                @if(in_array("product",$admin_role))
                <div class="card border-bottom">
                  <div class="card-header">
                  <h3 class="accordion-heading font-size-base px-grid-gutter"><a class="collapsed py-3 {{ $active_page == "product" ? "text-primary" : ""}} " href="{{ url('administrator/products') }}"><span class="d-flex align-items-center">
                        <i class="fab fa-product-hunt font-size-lg text-danger mt-n1 mr-2"></i>All Products</span></a>
                    </h3>
                  </div>
                </div>
                @endif
                <!--Categopries-->
                @if(in_array("product_categories",$admin_role))
                <div class="card border-bottom">
                 <div class="card-header">
                 <h3 class="accordion-heading font-size-base px-grid-gutter"><a class="collapsed py-3 {{ $active_page == "category" ? "text-primary" : ""}} " href="{{ url('administrator/categories') }}"><span class="d-flex align-items-center">
                       <i class="fa fa-list-alt font-size-lg text-danger mt-n1 mr-2"></i>Product Categories</span></a>
                   </h3>
                 </div>
                </div>
                @endif
                <!-- Agents-->
                @if(in_array("customer",$admin_role))
                  <div class="card border-bottom">
                      <div class="card-header">
                        <h3 class="accordion-heading font-size-base px-grid-gutter"><a class="collapsed py-3 {{ $active_page == 'customer' ? 'text-primary' : ""}} " href="{{ url('administrator/customer') }}"><span class="d-flex align-items-center">
                            <i class="fa fa-users font-size-lg text-danger mt-n1 mr-2"></i>Customer</span></a>
                        </h3>
                      </div>
                  </div>
                @endif
                
                @if(in_array("order",$admin_role))
                <div class="card border-bottom">
                    <div class="card-header">
                      <h3 class="accordion-heading font-size-base px-grid-gutter"><a class="collapsed py-3 {{ $active_page == "order" ? "text-primary" : ""}} " href="{{ url('administrator/orders') }}"><span class="d-flex align-items-center">
                          <i class="fa fa-shopping-cart font-size-lg text-danger mt-n1 mr-2"></i>Customer Orders</span></a>
                      </h3>
                    </div>
                </div>
                @endif
                @if(in_array("order",$admin_role))
                <div class="card border-bottom">
                  <div class="card-header">
                    <h3 class="accordion-heading font-size-base px-grid-gutter"><a class="collapsed py-3 {{ $active_page == "track_order" ? "text-primary" : ""}}" href="{{ url('administrator/track-orders') }}"><span class="d-flex align-items-center">
                        <i class="fa fa-shipping-fast font-size-lg text-danger mt-n1 mr-2"></i>Track Orders</span></a>
                    </h3>
                  </div>
                </div>
                @endif
                <!-- Reports-->
                @if(in_array("report",$admin_role))
                <div class="card border-bottom">
                    <div class="card-header">
                      <h3 class="accordion-heading font-size-base px-grid-gutter"><a class="collapsed py-3" href="#reports" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="reports"><span class="d-flex align-items-center">
                          <i class="fa fa-folder font-size-lg text-danger mt-n1 mr-2"></i>Reports</span><span class="accordion-indicator"></span></a>
                      </h3>
                    </div>
                    <div class="collapse" id="reports" data-parent="#categories">
                      <div class="card-body px-grid-gutter pb-4">
                        <div class="widget widget-links">
                          <ul class="widget-list">
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Weekly Report</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Monthly Report</a></li>
                            <li class="widget-list-item"><a class="widget-list-link" href="#">Yearly Report</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                </div>
                @endif
                <!-- Reports-->
                @if(in_array("roles",$admin_role) || $administrator->fldUserRoles == 1)
                  <div class="card border-bottom">
                      <div class="card-header">
                        <h3 class="accordion-heading font-size-base px-grid-gutter"><a class="collapsed py-3 {{ $active_page == 'roles' || $active_page == 'user' ? 'text-primary' : ''}}" href="#settings" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="reports"><span class="d-flex align-items-center">
                            <i class="fa fa-folder font-size-lg text-danger mt-n1 mr-2"></i>Settings</span><span class="accordion-indicator"></span></a>
                        </h3>
                      </div>
                      <div class="collapse  {{ $active_page == 'roles' || $active_page == 'user' ? 'text-primary collapse show' : ''}}" id="settings" data-parent="#categories">
                        <div class="card-body px-grid-gutter">
                          <div class="widget widget-links">
                            <ul class="widget-list">
                              <li class="widget-list-item"><a class="widget-list-link {{ $active_page == 'roles' ? 'text-primary' : ''}}" href="{{url('/administrator/role')}}">Roles</a></li>
                              <!-- <li class="widget-list-item"><a class="widget-list-link" href="#">Monthly Report</a></li>
                              <li class="widget-list-item"><a class="widget-list-link" href="#">Yearly Report</a></li> -->
                            </ul>
                          </div>
                        </div>
                        <div class="card-body px-grid-gutter">
                          <div class="widget widget-links">
                            <ul class="widget-list">
                              <li class="widget-list-item"><a class="widget-list-link {{ $active_page == 'user' ? 'text-primary' : ""}}" href="{{ url('administrator/users') }}" href="{{url('/administrator/role')}}">Users</a></li>
                              <!-- <li class="widget-list-item"><a class="widget-list-link" href="#">Monthly Report</a></li>
                              <li class="widget-list-item"><a class="widget-list-link" href="#">Yearly Report</a></li> -->
                            </ul>
                          </div>
                        </div>
                      </div>
                  </div>
                @endif

  </aside>
  <!-- Page-->
