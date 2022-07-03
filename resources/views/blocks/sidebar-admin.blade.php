<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/" class="brand-link">
    <img src="{{ asset('admin_assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('admin_assets/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="{{Auth::user()->name}}">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item menu-open">
          <a href="{{route('admin.dashboard')}}" class="nav-link {{ (Request::routeIs('admin.dashboard') || Request::routeIs('admin.dashboard.*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                  {{ __('Dashboard') }}
              </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{ route('admin.categories') }}" class="nav-link {{ (Request::routeIs('admin.categories') || Request::routeIs('admin.categories.*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-stream"></i>
              <p>
                  {{ __('Categories') }}
              </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{route('admin.products')}}" class="nav-link {{ (Request::routeIs('admin.products') || Request::routeIs('admin.products.*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                  {{ __('Products') }}
              </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{route('admin.homeslider')}}" class="nav-link {{ (Request::routeIs('admin.homeslider') || Request::routeIs('admin.homeslider.*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-image"></i>
              <p>
                  {{ __('Slider') }}
              </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{route('admin.homecategories')}}" class="nav-link {{ Request::routeIs('admin.homecategories') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                  {{ __('Product Home Category') }}
              </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{route('admin.sale')}}" class="nav-link {{ Request::routeIs('admin.sale') ? 'active' : '' }}">
              <i class="nav-icon fas fa-bookmark"></i>
              <p>
                  {{ __('Sale Setting') }}
              </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{route('admin.coupons')}}" class="nav-link {{ (Request::routeIs('admin.coupons') || Request::routeIs('admin.coupons.*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-barcode"></i>
              <p>
                  {{ __('Coupons') }}
              </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{route('admin.orders')}}" class="nav-link {{ (Request::routeIs('admin.orders') || Request::routeIs('admin.orders.*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                  {{ __('Manager Orders') }}
              </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{route('admin.contact')}}" class="nav-link {{ Request::routeIs('admin.contact') ? 'active' : '' }}">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                  {{ __('List Contacts') }}
              </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{route('admin.attributes')}}" class="nav-link {{ (Request::routeIs('admin.attributes') || Request::routeIs('admin.attributes.*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-list-ol"></i>
              <p>
                  {{ __('Attributes Product') }}
              </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="{{route('admin.settings')}}" class="nav-link {{ Request::routeIs('admin.settings') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                  {{ __('Setting Website') }}
              </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>