 <!-- Start Header Area -->
 <header class="header_area sticky-header">
     <div class="main_menu">
         <nav class="navbar navbar-expand-lg navbar-light main_box">
             <div class="container">
                 <!-- Brand and toggle get grouped for better mobile display -->
                 <a class="navbar-brand logo_h" href="{{ route('home') }}"><img src="/img/logo-sgu.png" alt=""
                         style="max-height: 50px"></a>
                 <button class="navbar-toggler" type="button" data-toggle="collapse"
                     data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                     aria-label="Toggle navigation">
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                 </button>

                 {{-- admin page menu  --}}
                 @if (request()->is('admin*'))
                     <!-- Collect the nav links, forms, and other content for toggling -->
                     <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                         <ul class="nav navbar-nav menu_nav ml-auto">
                             <li class="nav-item admin {{ request()->is('admin') ? 'active' : '' }}"><a class="nav-link"
                                     href="{{ route('admin') }}">Home</a></li>
                             <li class="nav-item admin {{ request()->is('admin/category*') ? 'active' : '' }}"><a
                                     class="nav-link" href="{{ route('admin.category') }}">Category</a></li>
                             <li class="nav-item admin {{ request()->is('admin/product*') ? 'active' : '' }}"><a
                                     class="nav-link" href="{{ route('admin.product') }}">Product</a></li>
                             <li class="nav-item admin {{ request()->is('admin/admin*') ? 'active' : '' }}"><a
                                     class="nav-link" href="{{ route('admin.admin') }}">Admin</a></li>
                             <li class="nav-item admin {{ request()->is('admin/customer*') ? 'active' : '' }}"><a
                                     class="nav-link" href="{{ route('admin.customer') }}">Customer</a></li>
                             <li class="nav-item admin {{ request()->is('admin/order*') ? 'active' : '' }}"><a
                                     class="nav-link" href="{{ route('admin.orders') }}">Orders</a></li>
                             <li class="nav-item admin {{ request()->is('/admin/logout') ? 'active' : '' }}"><a
                                     class="nav-link" href="{{ route('admin.logout') }}">Logout</a></li>
                         </ul>
                     </div>
                 @else
                     {{-- customer page menu --}}
                     <!-- Collect the nav links, forms, and other content for toggling -->
                     <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                         <ul class="nav navbar-nav menu_nav ml-auto">
                             <li class="nav-item {{ request()->is('/') ? 'active' : '' }}"><a class="nav-link"
                                     href="{{ route('home') }}">Home</a></li>
                             <li class="nav-item {{ request()->is('products') ? 'active' : '' }}"><a class="nav-link"
                                     href="{{ route('products') }}">Products</a></li>

                             <li class="nav-item {{ request()->is('history') ? 'active' : '' }}"><a class="nav-link"
                                     href="{{ route('history') }}">History</a></li>

                             <li class="nav-item"><a
                                     class="nav-link" href="{{ route('admin.login') }}">Admin</a></li>

                             <li class="nav-item {{ request()->is('/contact') ? 'active' : '' }}"><a class="nav-link"
                                     href="{{ route('contact') }}">Contact</a></li>

                             @if (Auth::guard('customer')->check())
                                 {{-- Customer is authenticated --}}
                                 <li class="nav-item submenu dropdown">
                                     <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"
                                         role="button" aria-haspopup="true" aria-expanded="false">Profile</a>
                                     <ul class="dropdown-menu">
                                        <li class="nav-item" style="padding-bottom: 10px"><span style="color: #ffba00; padding: 0 30px;">{{ Auth::guard('customer')->user()->nama }}</span></li>
                                         <li class="nav-item"><a class="nav-link" href="{{ route('authentication.logout') }}">Logout</a></li>
                                     </ul>
                                 </li>
                             @else
                                 <li class="nav-item {{ request()->is('login') ? 'active' : '' }}"><a class="nav-link"
                                         href="{{ route('authentication.login') }}">Login</a></li>
                                 <li class="nav-item {{ request()->is('registration') ? 'active' : '' }}"><a
                                         class="nav-link"
                                         href="{{ route('authentication.registration') }}">Registration</a></li>
                             @endif


                         </ul>
                         @if (Auth::guard('customer')->check())
                             <ul class="nav navbar-nav navbar-right">
                                 <li class="nav-item {{ request()->is('/cart') ? 'active' : '' }}"><a
                                         href="{{ route('cart') }}" class="cart"><span class="ti-bag"></span></a>
                                 </li>
                             </ul>
                         @endif
                     </div>
                 @endif
             </div>
         </nav>
     </div>
 </header>
 <!-- End Header Area -->
