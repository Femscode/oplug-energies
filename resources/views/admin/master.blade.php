<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ url('homepage/css/global.css') }}" />
    <link rel="stylesheet" href="styleguide.css" />
    <link rel="stylesheet" href="{{ url('homepage/css/master.css') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    @yield('header')
</head>

<body>
    <header class="header">
        <!-- Top Nav -->
      

        <!-- Mid Nav -->
        <div class="mid-nav">
            <img src="{{ url('homepage/images/ologo.png') }}" alt="Logo" class="logo" />

            <!-- Hamburger toggle (mobile only) -->
            <button class="menu-toggle" aria-label="Toggle Menu">
                <span class="hamburger-line top"></span>
                <span class="hamburger-line middle"></span>
                <span class="hamburger-line bottom"></span>
            </button>

            <nav class="nav-links">
                <a href="#">Homes</a>
                <a href="#">Shop</a>
                <a href="#">Contact</a>
                <a href="#">About Us</a>
            </nav>

          
        </div>

       
    </header>

    <main>
        @yield('content')
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
                    <a href="#" aria-label="Twitter"><img src="{{ url('homepage/images/x.svg') }}" alt="x"/></a>
                    <a href="#" aria-label="Facebook"><img src="{{ url('homepage/images/facebook.svg') }}" alt="x"/></a>
                    <a href="#" aria-label="Instagram"><img src="{{ url('homepage/images/instagram.svg') }}" alt="x"/></a>
                    <a href="#" aria-label="YouTube"><img src="{{ url('homepage/images/youtube.svg') }}" alt="x"/></a>
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
                <span><img src="{{ url('homepage/images/paypal.svg') }}" alt="x"/></span>
                <span><img src="{{ url('homepage/images/visa.svg') }}" alt="x"/></span>
                <span><img src="{{ url('homepage/images/mastercard.svg') }}" alt="x"/></span>
                <span><img src="{{ url('homepage/images/paypal.svg') }}" alt="x"/></span>
                <span><img src="{{ url('homepage/images/klarna.svg') }}" alt="x"/></span>
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