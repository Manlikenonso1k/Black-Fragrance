<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Black Fragrance-Clothing Store eCommerce</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="icon" type="image/png" href="/images/faav-icon.png">
    <base href="/">
    <link rel="stylesheet" type="text/css" href="/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="/icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" media="all" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/vendor.css">
    <link rel="stylesheet" type="text/css" href="/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="/js/modernizr.js"></script>
    <style>
		.whatsapp-float {
			position: fixed;
			right: 20px;
			bottom: 20px;
			width: 56px;
			height: 56px;
			border-radius: 9999px;
			background: #25D366;
			color: #fff;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			font-size: 30px;
			box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
			z-index: 9999;
			text-decoration: none;
		}

		.whatsapp-float:hover,
		.whatsapp-float:focus {
			color: #fff;
			text-decoration: none;
			opacity: 0.95;
		}
	</style>
  </head>
  <body>

    <div class="preloader-wrapper">
      <div class="preloader">
      </div>
    </div>

    <div class="search-popup">
      <div class="search-popup-container">

        <form role="search" method="get" class="search-form" action="">
          <input type="search" id="search-form" class="search-field" placeholder="Type and press enter" value="" name="s" />
          <button type="submit" class="search-submit"><a href="#"><i class="icon icon-search"></i></a></button>
        </form>

        <h5 class="cat-list-title">Browse Categories</h5>
        
        <ul class="cat-list">
          <li class="cat-list-item">
            <a href="{{ route('shop') }}" title="Men Jackets">Men Jackets</a>
          </li>
          <li class="cat-list-item">
            <a href="{{ route('shop') }}" title="Fashion">Fashion</a>
          </li>
          <li class="cat-list-item">
            <a href="{{ route('shop') }}" title="Casual Wears">Casual Wears</a>
          </li>
          <li class="cat-list-item">
            <a href="{{ route('shop') }}" title="Women">Women</a>
          </li>
          <li class="cat-list-item">
            <a href="{{ route('shop') }}" title="Trending">Trending</a>
          </li>
          <li class="cat-list-item">
            <a href="{{ route('shop') }}" title="Hoodie">Hoodie</a>
          </li>
          <li class="cat-list-item">
            <a href="{{ route('shop') }}" title="Kids">Kids</a>
          </li>
        </ul>
      </div>
    </div>

    <header id="header">
      <div id="header-wrap">
        <nav class="secondary-nav border-bottom">
          <div class="container">
            <div class="row d-flex align-items-center">
              <div class="col-md-4 header-contact">
                <p>Let's talk! <strong>+234 818 416 1506</strong>
                </p>
              </div>
              <div class="col-md-4 shipping-purchase text-center">
                <p>Free shipping on a purchase value of ₦200</p>
              </div>
              <div class="col-md-4 col-sm-12 user-items">
                <ul class="d-flex justify-content-end list-unstyled">
                  <li>
                    <a href="/login">
                      <i class="icon icon-user"></i>
                    </a>
                  </li>
                  <li>
                    <a href="/cart">
                      <i class="icon icon-shopping-cart"></i>
                    </a>
                  </li>
                  <li>
                    <a href="/wishlist">
                      <i class="icon icon-heart"></i>
                    </a>
                  </li>
                  <li class="user-items search-item pe-3">
                    <a href="#" class="search-button">
                      <i class="icon icon-search"></i>
                    </a>logo
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </nav>
        <nav class="primary-nav padding-small">
          <div class="container">
            <div class="row d-flex align-items-center">
              <div class="col-lg-2 col-md-2">
                <div class="main-logo">
                  <a href="{{ route('home') }}">
                    <img src="images/logo.png" alt="logo">
                  </a>
                </div>
              </div>
              <div class="col-lg-10 col-md-10">
                <div class="navbar">

                  <div id="main-nav" class="stellarnav d-flex justify-content-end right">
                    <ul class="menu-list">

                      <li class="menu-item has-sub">
                        <a href="{{ route('home') }}" class="item-anchor active d-flex align-item-center" data-effect="Home">Home<i class="icon icon-chevron-down"></i></a>
                        <ul class="submenu">
                          <li><a href="{{ route('home') }}" class="item-anchor active">Home</a></li>
                          <li><a href="/home2" class="item-anchor">Home v2<span class="text-primary"> (PRO)</span></a></li>
                        </ul>
                      </li>

                      <li><a href="{{ route('about') }}" class="item-anchor" data-effect="About">About</a></li>

                      <li class="menu-item has-sub">
                        <a href="{{ route('shop') }}" class="item-anchor d-flex align-item-center" data-effect="Shop">Shop<i class="icon icon-chevron-down"></i></a>
                        <ul class="submenu">
                          <li><a href="{{ route('shop') }}" class="item-anchor">Shop</a></li>
                          <li><a href="/shop-slider" class="item-anchor">Shop slider<span class="text-primary"> (PRO)</span></a></li>
                          <li><a href="/shop-grid" class="item-anchor">Shop grid<span class="text-primary"> (PRO)</span></a></li>
                          <li><a href="/shop-list" class="item-anchor">Shop list<span class="text-primary"> (PRO)</span></a></li>
                          <li><a href="/product" class="item-anchor">Single product<span class="text-primary"> (PRO)</span></a></li>
                          <li><a href="/cart" class="item-anchor">Cart<span class="text-primary"> (PRO)</span></a></li>
                          <li><a href="/wishlist" class="item-anchor">Wishlist<span class="text-primary"> (PRO)</span></a></li>
                          <li><a href="/checkout" class="item-anchor">Checkout<span class="text-primary"> (PRO)</span></a></li>
                        </ul>
                      </li>

                      <li class="menu-item has-sub">
                        <a href="#" class="item-anchor d-flex align-item-center" data-effect="Pages">Pages<i class="icon icon-chevron-down"></i></a>
                        <ul class="submenu">
                          <li><a href="/coming-soon" class="item-anchor">Coming soon<span class="text-primary"> (PRO)</span></a></li>
                          <li><a href="/login" class="item-anchor">Login<span class="text-primary"> (PRO)</span></a></li>
                          <li><a href="/faqs" class="item-anchor">FAQs<span class="text-primary"> (PRO)</span></a></li>
                          <li><a href="{{ route('styles') }}" class="item-anchor">Styles</a></li>
                          <li><a href="{{ route('thank-you') }}" class="item-anchor">Thankyou</a></li>
                          <li><a href="/error" class="item-anchor">Error page<span class="text-primary"> (PRO)</span></a></li>
                        </ul>
                      </li>

                      <li class="menu-item has-sub">
                        <a href="{{ route('blog') }}" class="item-anchor d-flex align-item-center" data-effect="Blog">Blog<i class="icon icon-chevron-down"></i></a>
                        <ul class="submenu">
                          <li><a href="{{ route('blog') }}" class="item-anchor">Blog</a></li>
                          <li><a href="/blog-sidebar" class="item-anchor">Blog with sidebar<span class="text-primary"> (PRO)</span></a></li>
                          <li><a href="/blog-masonry" class="item-anchor">Blog masonry<span class="text-primary"> (PRO)</span></a></li>
                          <li><a href="{{ route('single-post') }}" class="item-anchor">Single post</a></li>
                        </ul>
                      </li>

                      <li><a href="{{ route('contact') }}" class="item-anchor" data-effect="Contact">Contact</a></li>

                    </ul>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>

    @yield('content')

    <a href="https://wa.me/2348184161506" class="whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="Contact Black Fragrance on WhatsApp">
		   <span class="fa fa-whatsapp" aria-hidden="true"></span>
	  </a>

    <footer id="footer">
      <div class="container">
        <div class="footer-menu-list">
          <div class="row d-flex flex-wrap justify-content-between">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="footer-menu">
                <!-- footer column 1 -->
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="footer-menu">
                <!-- footer column 2 -->
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="footer-menu">
                <!-- footer column 3 -->
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="footer-menu">
                <!-- footer column 4 -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
    </footer>

    <div id="footer-bottom">
      <div class="container">
        <div class="d-flex align-items-center flex-wrap justify-content-between">
          <div class="copyright">
            <p>Freebies by <a href="https://templatesjungle.com/">Templates Jungle</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a>
            </p>
          </div>
          <div class="payment-method">
            <p>Payment options :</p>
            <div class="card-wrap">
              <img src="/images/visa-icon.jpg" alt="visa">
              <img src="/images/mastercard.png" alt="mastercard">
              <img src="/images/american-express.jpg" alt="american-express">
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="/js/jquery-1.11.0.min.js"></script>
    <script src="/js/plugins.js"></script>
    <script src="/js/script.js"></script>
  </body>
</html>
