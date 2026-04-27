<header class="header_area">
    <div class="top_menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="float-left">
                        <p>Phone: +201281856592</p>
                        <p>email: mosasameh123@gmail.com</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="float-right">
                        <ul class="right_side">
                            <li><a href="{{ route('cart.index') }}">Cart</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            @guest
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main_menu">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light w-100">
                <a class="navbar-brand logo_h" href="{{ route('home') }}">
                    <img src="{{ asset('new-template/img/logo.png') }}" alt="OrabyStore" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
                    <div class="row w-100 mr-0">
                        <div class="col-lg-7 pr-0">
                            <ul class="nav navbar-nav center_nav pull-right">
                                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item submenu dropdown {{ request()->routeIs('products*', 'categories*', 'subcategories*', 'brands*') ? 'active' : '' }}">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Shop</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('categories') }}">Categories</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('subcategories') }}">Subcategories</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('products') }}">Products</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('brands') }}">Brands</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-5 pr-0">
                            <ul class="nav navbar-nav navbar-right right_nav pull-right">
                                <li class="nav-item">
                                    <a href="#" class="icons"><i class="ti-search"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('cart.index') }}" class="icons">
                                        <i class="ti-shopping-cart"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    @guest
                                        <a href="{{ route('login') }}" class="icons">
                                            <i class="ti-user"></i>
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="icons user-toggle">
                                            <i class="ti-user"></i> {{ Auth::user()->name }}
                                        </a>
                                        <ul class="user-dropdown">
                                            @if(Auth::user()->is_admin)
                                                <li><a href="{{ url('/admin') }}">Dashboard</a></li>
                                            @endif
                                            <li><a href="{{ route('orders.index') }}">My Orders</a></li>
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    Logout
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    @endguest
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>