 <!-- Navbar-->
 <header class="bg-light box-shadow-sm fixed-top">
    <div class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid"><a class="navbar-brand d-none d-sm-block mr-3 mr-xl-4 flex-shrink-0" href="index.html" style="min-width: 7rem;"><span id="logo">TRACKING <span>APP</span></span></a>
        <a class="navbar-brand d-sm-none mr-2" href="#" style="min-width: 4.625rem;"><span id="logo">T <span>APP</span></a>

        <!-- Toolbar-->
        <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center ml-xl-2">
          <a class="navbar-toggler" href="#sideNav" data-toggle="sidebar"><span class="navbar-toggler-icon"></span></a>
          <div class="navbar-tool-icon-box"></div></a><a class="navbar-tool ml-1 ml-lg-0 mr-n1 mr-lg-2" href="#signin-modal" data-toggle="modal">
            <div class="navbar-tool-icon-box"><i class="navbar-tool-icon czi-user-circle"></i></div>
            <div class="topbar-text dropdown disable-autohide">
            <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">
              {{isset($administrator) && $administrator->fldUserRoles == 1 ? "Administrator" : "Agent"}}
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
              <li>
                <a class="dropdown-item pb-1" href="#">
                    My Settings
                </a>
              </li>
              <li>
                <a class="dropdown-item pb-1" href="{{ url('administrator/logout') }}">
                  Sign out
                </a>
              </li>
            </ul>
          </div>
          <div class="navbar-tool dropdown ml-3">
            <div class="dropdown-menu dropdown-menu-right" style="width: 20rem;">
              <div class="widget widget-cart px-3 pt-2 pb-3">
                <div style="height: 15rem;" data-simplebar data-simplebar-auto-hide="false">
                  <div class="widget-cart-item pb-2 border-bottom">
                    <button class="close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>
                    <div class="media align-items-center">
                      <!-- <a class="d-block mr-2" href="grocery-single.html"><img width="64" src="img/grocery/cart/th01.jpg" alt="Product"/></a> -->
                      <div class="media-body">
                        <h6 class="widget-product-title"><a href="grocery-single.html">Frozen Oven-ready Poultry</a></h6>
                        <div class="widget-product-meta"><span class="text-accent mr-2">$15.<small>00</small></span><span class="text-muted">x 1</span></div>
                      </div>
                    </div>
                  </div>
                  <div class="widget-cart-item py-2 border-bottom">
                    <button class="close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>
                    <div class="media align-items-center">
                      <!-- <a class="d-block mr-2" href="grocery-single.html"><img width="64" src="img/grocery/cart/th02.jpg" alt="Product"/></a> -->
                      <div class="media-body">
                        <h6 class="widget-product-title"><a href="grocery-single.html">Nut Chocolate Paste (750g)</a></h6>
                        <div class="widget-product-meta"><span class="text-accent mr-2">$6.<small>50</small></span><span class="text-muted">x 1</span></div>
                      </div>
                    </div>
                  </div>
                  <div class="widget-cart-item py-2 border-bottom">
                    <button class="close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>
                    <div class="media align-items-center">
                      <!-- <a class="d-block mr-2" href="grocery-single.html"><img width="64" src="img/grocery/cart/th03.jpg" alt="Product"/></a> -->
                      <div class="media-body">
                        <h6 class="widget-product-title"><a href="grocery-single.html">Mozzarella Mini Cheese</a></h6>
                        <div class="widget-product-meta"><span class="text-accent mr-2">$3.<small>50</small></span><span class="text-muted">x 1</span></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center pt-3">
                  <div class="font-size-sm mr-2 py-2"><span class="text-muted">Total:</span><span class="text-accent font-size-base ml-1">$25.<small>00</small></span></div><a class="btn btn-primary btn-sm" href="grocery-checkout.html"><i class="czi-card mr-2 font-size-base align-middle"></i>Checkout<i class="czi-arrow-right ml-1 mr-n1"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
