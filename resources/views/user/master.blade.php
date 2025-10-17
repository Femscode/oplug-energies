<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ url('homepage/css/global.css') }}" />
    <link rel="stylesheet" href="styleguide.css" />
    <link rel="stylesheet" href="{{ url('homepage/css/user-master.css') }}" />
    <link rel="stylesheet" href="{{ url('css/user-orders.css') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    @yield('header')
</head>

<body>
    <header class="header">
        <!-- Top Nav -->
        <div class="top-nav">
            <div class="frame">
                <div class="small">
                    <img src="{{ url('homepage/images/phone.svg') }}" width="12" height="12" alt="phone" />
                    Hotline 24/7
                </div>
                <div class="phone-numbers">+(234) 907 635 1112 | +(234) 916 870 6000</div>
            </div>
            <div class="frame">
                <div>Naira ▾</div>
                <div>Eng ▾</div>
            </div>
        </div>

        <!-- Mid Nav -->
        <div class="mid-nav">
            <a href="/">
            <img src="{{ url('homepage/images/ologo.png') }}" alt="Logo" class="logo" />
</a>
            <!-- Hamburger toggle (mobile only) -->
            <button class="menu-toggle" aria-label="Toggle Menu">
                <span class="hamburger-line top"></span>
                <span class="hamburger-line middle"></span>
                <span class="hamburger-line bottom"></span>
            </button>

            <nav class="nav-links">
                <a href="/">Home</a>
                <a href="/user/dashboard">Dashboard</a>
                <a href="/user/profile">Profile</a>
                <a href="/user/orders">Orders</a>
                <a href="/user/change-password">Change Password</a>
               
            </nav>

            <div class="actions">
                @if(Auth::check())
                <form action="/logout" method="POST" style="display: inline;">
                    @csrf
                <a>
                    <div class="welcome">Welcome To Oplug</div>
                    <button class="submit" style=" background-color: #dc3545; /* red */
                            color: #fff;
                            border: none;
                            padding: 10px 18px;
                            border-radius: 6px;
                            font-size: 15px;
                            cursor: pointer;
                            transition: background-color 0.3s ease, transform 0.1s ease;">
                            Logout</button>
                </a>
                </form>
                <a href="/cart" class="cart">
                    <div class="cart-icon">
                        <img src="{{ url('homepage/images/cart.svg') }}" width="20" alt="cart" />
                        <!-- <span></span> -->
                    </div>
                    <div>
                        <div class="small-cart">Cart</div>
                    </div>
                </a>
                @else  
                <a href="/login">
                    <div class="welcome">Welcome To Oplug</div>
                    <div class="login">LOG IN / REGISTER</div>
                </a>
                @endif
            </div>
        </div>

      
         <div class="nav">
            <form action="{{ route('search') }}" method="GET" class="div-search-cat">
                <div class="input">
                    <input class="div-placeholder" name="q" placeholder="Search anything..." type="text" value="{{ request('q') }}" />
                </div>
                <div class="options">
                    <button type="submit" class="frame" style="background: none; border: none; cursor: pointer;">
                        <div class="text-wrapper">Search</div>
                    </button>
                </div>
            </form>

            <div class="shipping-info">
                <div class="link-free-shipping">FREE SHIPPING OVER ₦1,000,000</div>
                <div class="link-days-money">30 DAYS MONEY BACK</div>
            </div>
          
        </div>
    </header>

    <main>
        <!-- Breadcrumb -->
        @yield('breadcrumb')

        <!-- Solar Account Container -->
        <div class="solar-account">
            <!-- Sidebar -->
            <div class="solar-account-sidebar">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="solar-account-user">
                    <div class="solar-account-user-avatar">
                        <img src="{{ asset('homepage/images/avatar.svg') }}" alt="User Avatar">
                    </div>
                    <div class="solar-account-user-info">
                        <h4>{{ Auth::user()->name }}</h4>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <div class="solar-account-tabs">
                    <a href="{{ route('user.dashboard') }}" class="solar-account-tab {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="{{ route('user.profile') }}" class="solar-account-tab {{ request()->routeIs('user.profile') ? 'active' : '' }}">
                        <i class="fas fa-user"></i> Profile
                    </a>
                    <a href="{{ route('user.orders.index') }}" class="solar-account-tab {{ request()->routeIs('user.orders*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-bag"></i> Orders
                    </a>
                    <a href="{{ route('user.change-password') }}" class="solar-account-tab {{ request()->routeIs('user.change-password') ? 'active' : '' }}">
                        <i class="fas fa-lock"></i> Change Password
                    </a>

                    <form method="POST" action="{{ route('logout') }}" style="margin-top: auto;">
                        @csrf
                        <button type="submit" class="solar-account-tab logout-btn" style="width: 100%; text-align: left; border: none; background: none; color: inherit; font: inherit; cursor: pointer;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Content -->
            <div class="solar-account-content">
                @yield('content')
            </div>
        </div>
    </main>


    <footer class="footer">
        <div class="footer-content">
            <div class="company-info">
                <h3>OPLUG ENERGIES LIMITED</h3>
                <p class="hotline">HOTLINE 24/7</p>
                <p class="phone">+(234) 907 635 1112</p>
                <p class="address">81, Mobolaji Bank Anthony Way, Ikeja<br>Lagos, Nigeria</p>
                <p class="email">info@oplugenergies.com</p>
                <div class="social-links">
                    <a href="#" aria-label="Twitter"><img src="{{ url('homepage/images/x.svg') }}" alt="x" /></a>
                    <a href="#" aria-label="Facebook"><img src="{{ url('homepage/images/facebook.svg') }}" alt="x" /></a>
                    <a href="#" aria-label="Instagram"><img src="{{ url('homepage/images/instagram.svg') }}" alt="x" /></a>
                    <a href="#" aria-label="YouTube"><img src="{{ url('homepage/images/youtube.svg') }}" alt="x" /></a>
                </div>
            </div>
            <div class="product-columns">
                <div class="footer-column">
                    <div>
                        <h4>Inverters</h4>
                        <ul>
                            <li><a href="#">Infini-Solar Inverters</a></li>
                            <li><a href="#">Solis Inverters</a></li>
                            <li><a href="#">Galaxy Solar Inverters</a></li>
                            <li><a href="#">East Inverters</a></li>
                            <li><a href="#">Deye Inverters</a></li>
                            <li><a href="#">Huawei Inverters</a></li>
                            <li><a href="#">Growatt Inverters</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-column">
                    <div>
                        <h4>Solar Panels</h4>
                        <ul>
                            <li><a href="#">Galaxy Solar Panels</a></li>
                            <li><a href="#">Jinko Solar Panels</a></li>
                            <li><a href="#">ZNSHINESOLA Panels</a></li>
                            <li><a href="#">JA Solar Panels</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-column">
                    <div>
                        <h4>All-in-one Solutions</h4>
                        <ul>
                            <li><a href="#">All-In-one Solar Generators</a></li>
                            <li><a href="#">All-in-one Street Light</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-column">
                    <div>
                        <h4>Retail Lubricants</h4>
                        <ul>
                            <li><a href="#">Shell Lubricants</a></li>
                            <li><a href="#">Mobil Lubricants</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- <div class="footer-column">
            <div>
            <h4>Company</h4>
            <ul>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">About Us</a></li>
            </ul>
            </div>
        </div> -->
        </div>
        <div class="footer-bottom">
            <p>© 2025 Oplug. All Rights Reserved</p>
            <div class="payment-methods">
                <span><img src="{{ url('homepage/images/paypal.svg') }}" alt="x" /></span>
                <span><img src="{{ url('homepage/images/visa.svg') }}" alt="x" /></span>
                <span><img src="{{ url('homepage/images/mastercard.svg') }}" alt="x" /></span>
                <span><img src="{{ url('homepage/images/paypal.svg') }}" alt="x" /></span>
                <span><img src="{{ url('homepage/images/klarna.svg') }}" alt="x" /></span>
            </div>
        </div>
    </footer>


    <script>
        // Toggle menu for mobile
        document.querySelector(".menu-toggle").addEventListener("click", function() {
            this.classList.toggle("active");
            document.querySelector(".nav-links").classList.toggle("active");
            document.querySelector(".actions").classList.toggle("active");
        });
    </script>
    @yield('script')
</body>

</html>