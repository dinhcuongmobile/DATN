<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themes.pixelstrap.net/katie/template/layout-4.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Sep 2024 14:55:23 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Katie">
    <meta name="keywords" content="Katie">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <title>Katie - Online Fashion Store </title><!-- Favicon icon-->
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon"><!-- Google Font Outfit-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/fontawesome.css')}}"><!-- Iconsax icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/iconsax.css')}}"><!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" id="rtl-link" href="{{asset('assets/css/vendors/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/swiper-slider/swiper-bundle.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/toastify.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <script defer src="{{asset('assets/css/landing_page.js')}}"></script>
    <script defer src="{{asset('assets/css/style.js')}}"></script>
    <link href="{{asset('assets/css/landing_page.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    @yield('css')
</head>

<body class="layout-4 skeleton_body">
    <div class="tap-top">
        <div><i class="fa-solid fa-angle-up"></i></div>
    </div><span class="cursor"><span class="cursor-move-inner"><span class="cursor-inner"></span></span><span
            class="cursor-move-outer"><span class="cursor-outer"></span></span></span>
    <div class="skeleton_loader">
        <header>
            <div class="top_header">
                <p> </p>
            </div>
            <div class="custom-container container header-1">
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="mobile-fix-option">
                            <ul>
                                <li> <a href="#"><i class="iconsax" data-icon="home-1"></i>Home</a></li>
                                <li><a href="#"><i class="iconsax" data-icon="search-normal-2"></i>Search</a></li>
                                <li><a href="#"><i class="iconsax" data-icon="shopping-cart"></i>Cart</a></li>
                                <li><a href="#"><i class="iconsax" data-icon="heart"></i>My Wish</a></li>
                                <li> <a href="#"><i class="iconsax" data-icon="user-2"></i>Account</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="main-menu"> <a class="brand-logo" href="#"> <img class="img-fluid for-light"
                                    src="{{asset('assets/images/logo/logo-4.png')}}" alt="logo"><img class="img-fluid for-dark"
                                    src="{{asset('assets/images/logo/logo-white-4.png')}}" alt="logo"></a>
                            <nav id="main-nav-1">
                                <ul class="nav-menu sm-horizontal">
                                    <li class="mobile-back text-end">Thoát<i class="fa-solid fa-angle-right ps-2"
                                    aria-hidden="true"></i></li>
                                    <li> <a class="nav-link" href="{{route('trang-chu.home')}}">Trang chủ</a>
                                    </li>
                                    <li> <a class="nav-link" href="{{route('gioi-thieu')}}">Giới thiệu</a>
                                    </li>
                                    <li> <a class="nav-link" href="{{route('san-pham.san-pham')}}">Sản Phẩm<span> <i
                                                    class="fa-solid fa-angle-down"></i></span>
                                                    <p class="lable-nav" style="right: -7px">Hot</p>
                                        </a>
                                        <ul class="nav-submenu">
                                            <li> <a href="{{route('san-pham.san-pham-danh-muc')}}">Over size
                                                    <span class="badge-sm danger-color animated">Hot</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li> <a class="nav-link" href="{{ route('tin-tuc.tin-tuc') }}">Tin tức<span> <i
                                                    class="fa-solid fa-angle-down"></i></span></a>
                                        <ul class="nav-submenu">
                                            <li> <a href="{{ route('tin-tuc.tin-tuc-danh-muc') }}">Tin tức danh muc</a></li>
                                        </ul>
                                    </li>
                                    <li> <a class="nav-link" href="{{ route('lien-he.lien-he') }}">Liên hệ </a></li>
                                </ul>
                            </nav>
                            <div class="sub_header">
                                <div class="toggle-nav"><i class="fa-solid fa-bars-staggered sidebar-bar"></i></div>
                                <ul class="justify-content-end">
                                    <li> <button class="search-icon"><i class="iconsax"
                                                data-icon="search-normal-2"></i></button></li>
                                    <li> <a href="#"><i class="iconsax" data-icon="heart"></i><span
                                                class="cart_qty_cls">2</span></a></li>
                                    <li><a href="#"><i class="iconsax" data-icon="user-2"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section class="section-space home-section-4">
            <div class="custom-container container">
                <div class="row">
                    <div class="col-12">
                        <div class="home-content">
                            <p> </p>
                            <h2> </h2>
                            <h1> </h1>
                            <h6> </h6><a class="btn" href="#"></a>
                        </div>
                        <div class="product-1">
                            <div class="product">
                                <div class="img-fluid"></div>
                                <div class="product-details">
                                    <h6> </h6>
                                    <p> </p>
                                    <ul></ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-2">
                            <div class="product">
                                <div class="img-fluid"></div>
                            </div>
                        </div>
                        <div class="home-images">
                            <div class="main-images"></div>
                        </div>
                        <div class="home-box-1"> <span> </span></div>
                        <div class="home-box-2"> <span> </span></div>
                        <div class="marquee">
                            <div class="marquee__item">
                                <h4 class="animation-text">Collection</h4>
                            </div>
                            <div class="marquee__item">
                                <h4 class="animation-text">Collection</h4>
                            </div>
                            <div class="marquee__item">
                                <h4 class="animation-text">Collection</h4>
                            </div>
                        </div>
                        <div class="shape-images"> <img class="img-1 img-fluid" src="{{asset('assets/images/layout-4/s-1.png')}}"
                                alt=""><img class="img-2 img-fluid" src="{{asset('assets/images/layout-4/s-2.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-t-space">
            <div class="container-fluid fashion-images">
                <div class="swiper fashion-images-slide">
                    <div class="swiper-wrapper ratio_square-2">
                        <div class="swiper-slide">
                            <div class="fashion-box"></div>
                            <h5> </h5>
                        </div>
                        <div class="swiper-slide">
                            <div class="fashion-box"></div>
                            <h5> </h5>
                        </div>
                        <div class="swiper-slide">
                            <div class="fashion-box"></div>
                            <h5> </h5>
                        </div>
                        <div class="swiper-slide">
                            <div class="fashion-box"></div>
                            <h5> </h5>
                        </div>
                        <div class="swiper-slide">
                            <div class="fashion-box"></div>
                            <h5> </h5>
                        </div>
                        <div class="swiper-slide">
                            <div class="fashion-box"></div>
                            <h5> </h5>
                        </div>
                        <div class="swiper-slide">
                            <div class="fashion-box"></div>
                            <h5> </h5>
                        </div>
                        <div class="swiper-slide">
                            <div class="fashion-box"></div>
                            <h5> </h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-b-space product-section">
            <div class="custom-container container">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="title">
                            <h3></h3><svg></svg>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-4 col-6">
                        <div class="product-box"></div>
                    </div>
                    <div class="col-xxl-3 col-md-4 col-6">
                        <div class="product-box"></div>
                    </div>
                    <div class="col-xxl-3 col-md-4 col-6">
                        <div class="product-box"></div>
                    </div>
                    <div class="col-xxl-3 col-md-4 col-6">
                        <div class="product-box"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- end mobile --}}

    <header>
        <div class="top_header">
            <p>Mã giảm giá miễn phí: Giảm giá cực mạnh cho những sản phẩm mới ra mắt <span>NEW 26</span><a
                    href="collection-left-sidebar.html"> MUA NGAY</a></p>
        </div>
        <div class="custom-container container header-1">
            <div class="row">
                <div class="col-12 p-0">
                    <div class="mobile-fix-option">
                        <ul>
                            <li> <a href="{{route('trang-chu.home')}}"><i class="iconsax" data-icon="home-4"></i>Trang chủ</a></li>
                            <li><a href="search.html"><i class="iconsax" data-icon="search-normal-2"></i>Tìm kiếm</a></li>
                            <li class="shopping-cart"> <a href="cart.html"><i class="iconsax"
                                        data-icon="shopping-cart"></i>Giỏ hàng</a></li>
                            <li><a href="wishlist.html"><i class="iconsax" data-icon="heart"></i>Yêu thích</a></li>
                            <li> <a href="dashboard.html"><i class="iconsax" data-icon="user-2"></i>Tài khoản</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="main-menu"> <a class="brand-logo" href="{{route('trang-chu.home')}}"> <img class="img-fluid for-light"
                                src="{{asset('assets/images/logo/logo-4.png')}}" alt="logo"><img class="img-fluid for-dark"
                                src="{{asset('assets/images/logo/logo-white-4.png')}}" alt="logo"></a>
                        <nav id="main-nav">
                            <ul class="nav-menu sm-horizontal theme-scrollbar" id="sm-horizontal">
                                <li class="mobile-back" id="mobile-back">Thoát<i class="fa-solid fa-angle-right ps-2"
                                        aria-hidden="true"></i></li>
                                <li> <a class="nav-link" href="{{route('trang-chu.home')}}">Trang Chủ</a>
                                </li>
                                <li> <a class="nav-link" href="{{route('gioi-thieu')}}">Giới Thiệu</a>
                                </li>
                                <li> <a class="nav-link" href="{{route('san-pham.san-pham')}}">Sản Phẩm<span> <i
                                                class="fa-solid fa-angle-down"></i></span>
                                                <p class="lable-nav" style="right: -7px">Hot</p>
                                    </a>
                                    <ul class="nav-submenu">
                                        <li> <a href="{{route('san-pham.san-pham-danh-muc')}}">Over size
                                                <span class="badge-sm danger-color animated">Hot</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li> <a class="nav-link" href="{{ route('tin-tuc.tin-tuc') }}">Tin tức<span> <i
                                                class="fa-solid fa-angle-down"></i></span></a>
                                    <ul class="nav-submenu">
                                        <li> <a href="{{ route('tin-tuc.tin-tuc-danh-muc') }}">Tin tức danh muc</a></li>
                                    </ul>
                                </li>
                                <li> <a class="nav-link" href="{{ route('lien-he.lien-he') }}">Liên hệ </a></li>
                            </ul>
                        </nav>
                        <div class="sub_header">
                            <div class="toggle-nav" id="toggle-nav"><i
                                    class="fa-solid fa-bars-staggered sidebar-bar"></i></div>
                            <ul class="justify-content-end">
                                <li> <button href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop"
                                        aria-controls="offcanvasTop"><i class="iconsax"
                                            data-icon="search-normal-2"></i></button></li>
                                <li> <a href="wishlist.html"><i class="iconsax" data-icon="heart"></i><span
                                            class="cart_qty_cls">2</span></a></li>
                                <li class="onhover-div"><a href="#"><i class="iconsax" data-icon="user-2"></i></a>
                                    <div class="onhover-show-div user">
                                        <ul>
                                            @if (Auth::check())
                                                <li> <a href="{{route('tai-khoan.thong-tin-tai-khoan',Auth::user()->id)}}">Thông tin</a></li>
                                                <li> <a href="{{ route('tai-khoan.dang-xuat') }}">Đăng xuất</a></li>
                                            @else
                                                <li> <a href="{{route('tai-khoan.dang-nhap')}}">Đăng Nhập </a></li>
                                                <li> <a href="{{route('tai-khoan.dang-ky')}}">Đăng Ký</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                                <li class="onhover-div shopping-cart"> <a class="p-0" href="#"
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                        aria-controls="offcanvasRight">
                                        <div class="shoping-prize"><i class="iconsax pe-2" data-icon="basket-2"> </i>0
                                            sản phẩm</div>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    {{-- end header --}}

    @yield('container')

    {{-- footer --}}
    <footer class="footer-layout-img">
        <section class="section-b-space footer-1">
            <div class="custom-container container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer-content">
                            <div class="footer-logo"><a href="index.html"> <img class="img-fluid"
                                        src="{{asset('assets/images/logo/logo-white-4.png')}}" alt="Footer Logo"></a></div>
                            <ul>
                                <li> <i class="iconsax" data-icon="location"></i>
                                    <h6>1 Trinh Van Bo</h6>
                                </li>
                                <li> <i class="iconsax" data-icon="phone-calling"></i>
                                    <h6>+ 185659635</h6>
                                </li>
                                <li> <i class="iconsax" data-icon="mail"></i>
                                    <h6>contact@namastore.com</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col offset-xl-1">
                        <div class="footer-content">
                            <div>
                                <div class="footer-title d-md-block">
                                    <h5>Về Chúng Tôi</h5>
                                    <ul class="footer-details accordion-hidden">
                                        <li> <a class="nav" href="index.html">Trang Chủ</a></li>
                                        <li> <a class="nav" href="collection-left-sidebar.html">Giới Thiệu</a></li>
                                        <li> <a class="nav" href="about-us.html">Sản Phẩm</a></li>
                                        <li> <a class="nav" href="blog-left-sidebar.html">Tin Tức</a></li>
                                        <li> <a class="nav" href="contact.html">Liên Hệ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-content">
                            <div>
                                <div class="footer-title d-md-block">
                                    <h5>New Categories</h5>
                                    <ul class="footer-details accordion-hidden">
                                        <li> <a class="nav" href="product-bundle.html">Latest Shoes</a></li>
                                        <li> <a class="nav" href="variant-radio.html">Branded Jeans</a></li>
                                        <li> <a class="nav" href="product.html">New Jackets</a></li>
                                        <li> <a class="nav" href="variant-images.html">Colorful Hoodies</a></li>
                                        <li> <a class="nav" href="variant-dropdown.html">Best Perfume</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-content">
                            <div>
                                <div class="footer-title d-md-block">
                                    <h5>Get Help</h5>
                                    <ul class="footer-details accordion-hidden">
                                        <li> <a class="nav" href="order-success.html">Your Orders</a></li>
                                        <li> <a class="nav" href="dashboard.html">Your Account</a></li>
                                        <li> <a class="nav" href="order-tracking.html">Track Orders</a></li>
                                        <li> <a class="nav" href="wishlist.html">Your Wishlist</a></li>
                                        <li> <a class="nav" href="faq.html">Shopping FAQs</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-content">
                            <div>
                                <div class="footer-title d-md-block">
                                    <h5>My Account</h5>
                                    <ul class="footer-details accordion-hidden">
                                        <li> <a class="nav" href="dashboard.html">My Account</a></li>
                                        <li> <a class="nav" href="login.html">Login/Register</a></li>
                                        <li> <a class="nav" href="cart.html">Cart</a></li>
                                        <li> <a class="nav" href="order-success.html">Order History</a></li>
                                        <li> <a class="nav" href="faq.html">Shopping FAQs</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>
    <div class="modal theme-modal fade" id="quick-view" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body"><button class="btn-close" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-xs-12">
                            <div class="quick-view-img">
                                <div class="swiper modal-slide-1">
                                    <div class="swiper-wrapper ratio_square-2">
                                        <div class="swiper-slide"><img class="bg-img" src="{{asset('assets/images/pro/1.jpg')}}"
                                                alt=""></div>
                                        <div class="swiper-slide"><img class="bg-img" src="{{asset('assets/images/pro/2.jpg')}}"
                                                alt=""></div>
                                        <div class="swiper-slide"><img class="bg-img" src="{{asset('assets/images/pro/3.jpg')}}"
                                                alt=""></div>
                                        <div class="swiper-slide"><img class="bg-img" src="{{asset('assets/images/pro/4.jpg')}}"
                                                alt=""></div>
                                    </div>
                                </div>
                                <div class="swiper modal-slide-2">
                                    <div class="swiper-wrapper ratio3_4">
                                        <div class="swiper-slide"><img class="bg-img" src="{{asset('assets/images/pro/5.jpg')}}"
                                                alt=""></div>
                                        <div class="swiper-slide"><img class="bg-img" src="{{asset('assets/images/pro/6.jpg')}}"
                                                alt=""></div>
                                        <div class="swiper-slide"><img class="bg-img" src="{{asset('assets/images/pro/7.jpg')}}"
                                                alt=""></div>
                                        <div class="swiper-slide"><img class="bg-img" src="{{asset('assets/images/pro/8.jpg')}}"
                                                alt=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 rtl-text">
                            <div class="product-right">
                                <h3>Women Pink Shirt</h3>
                                <h5>$32.96<del>$50.12</del></h5>
                                <ul class="color-variant">
                                    <li class="bg-color-brown"></li>
                                    <li class="bg-color-chocolate"></li>
                                    <li class="bg-color-coffee"></li>
                                    <li class="bg-color-black"></li>
                                </ul>
                                <div class="border-product">
                                    <h6>Product details</h6>
                                    <p>Western yoke on an Indigo shirt made of 100% cotton. Ideal for informal
                                        gatherings, this top will ensure your comfort and style throughout the day.</p>
                                </div>
                                <div class="product-description">
                                    <div class="size-box">
                                        <ul>
                                            <li class="active"><a href="#">s</a></li>
                                            <li><a href="#">m</a></li>
                                            <li><a href="#">l</a></li>
                                            <li><a href="#">xl</a></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-title">Quantity</h6>
                                    <div class="quantity"><button class="minus" type="button"><i
                                                class="fa-solid fa-minus"></i></button><input type="number" value="1"
                                            min="1" max="20"><button class="plus" type="button"><i
                                                class="fa-solid fa-plus"></i></button></div>
                                </div>
                                <div class="product-buttons"><a class="btn btn-solid" href="cart.html">Add to cart</a><a
                                        class="btn btn-solid" href="product.html">View detail</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal theme-modal fade cart-modal" id="addtocart" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body modal1">
                    <div class="custom-container container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <div class="modal-bg addtocart"><button class="btn-close" type="button"
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                    <div class="d-flex"><a href="#"><img class="img-fluid blur-up lazyload pro-img"
                                                src="{{asset('assets/images/modal/0.jpg')}}" alt=""></a>
                                        <div class="add-card-content align-self-center text-center"><a href="#">
                                                <h6><i class="fa-solid fa-check"> </i>Item <span>men full
                                                        sleeves</span><span> successfully added to your Cart</span></h6>
                                            </a>
                                            <div class="buttons"><a class="view-cart btn btn-solid"
                                                    href="cart.html">Your cart</a><a class="checkout btn btn-solid"
                                                    href="check-out.html">Check out</a><a class="continue btn btn-solid"
                                                    href="index.html">Continue shopping</a></div>
                                            <div class="upsell_payment"><img class="img-fluid blur-up lazyload"
                                                    src="{{asset('assets/images/payment_cart.png')}}" alt=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="product-upsell">
                                    <h5>Products Loved by Our Customers</h5><svg>
                                        <use
                                            href="https://themes.pixelstrap.net/katie/{{asset('assets/svg/icon-sprite.svg#main-line')}}">
                                        </use>
                                    </svg>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="card-img"> <img src="{{asset('assets/images/modal/1.jpg')}}" alt="user"><a href="#">
                                        <h6>Woven Jacket</h6>
                                        <p>$25</p>
                                    </a></div>
                                <div class="card-img"> <img src="{{asset('assets/images/modal/2.jpg')}}" alt="user"><a href="#">
                                        <h6>Printed Dresses</h6>
                                        <p>$25</p>
                                    </a></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="card-img"> <img src="{{asset('assets/images/modal/3.jpg')}}" alt="user"><a href="#">
                                        <h6>Woven Jacket</h6>
                                        <p>$25</p>
                                    </a></div>
                                <div class="card-img"> <img src="{{asset('assets/images/modal/4.jpg')}}" alt="user"><a href="#">
                                        <h6>Printed Dresses</h6>
                                        <p>$25</p>
                                    </a></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="card-img"> <img src="{{asset('assets/images/modal/5.jpg')}}" alt="user"><a href="#">
                                        <h6>Woven Jacket</h6>
                                        <p>$25</p>
                                    </a></div>
                                <div class="card-img"> <img src="{{asset('assets/images/modal/6.jpg')}}" alt="user"><a href="#">
                                        <h6>Printed Dresses</h6>
                                        <p>$25</p>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-end shopping-details" id="offcanvasRight" tabindex="-1"
        aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="offcanvasRightLabel">Giỏ hàng</h4><button class="btn-close"
                type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body theme-scrollbar">
            <ul class="offcanvas-cart">
                <li> <a href="#"> <img src="{{asset('assets/images/cart/1.jpg')}}" alt=""></a>
                    <div>
                        <h6 class="mb-0">Shirts Men's Clothing</h6>
                        <p>$35<del>$40</del><span class="btn-cart">$<span class="btn-cart__total"
                                    id="total">105</span></span></p>
                        <div class="btn-containter">
                            <div class="btn-control"><button class="btn-control__remove"
                                    id="btn-remove">&minus;</button>
                                <div class="btn-control__quantity">
                                    <div id="quantity-previous">2</div>
                                    <div id="quantity-current">3</div>
                                    <div id="quantity-next">4</div>
                                </div><button class="btn-control__add" id="btn-add">+</button>
                            </div>
                        </div>
                    </div><i class="iconsax delete-icon" data-icon="trash"></i>
                </li>
                <li> <a href="#"> <img src="{{asset('assets/images/cart/2.jpg')}}" alt=""></a>
                    <div>
                        <h6 class="mb-0">Shirts Men's Clothing</h6>
                        <p>$35<del>$40</del><span class="btn-cart">$<span class="btn-cart__total"
                                    id="total1">105</span></span></p>
                        <div class="btn-containter">
                            <div class="btn-control"><button class="btn-control__remove"
                                    id="btn-remove1">&minus;</button>
                                <div class="btn-control__quantity">
                                    <div id="quantity1-previous">2</div>
                                    <div id="quantity1-current">3</div>
                                    <div id="quantity1-next">4</div>
                                </div><button class="btn-control__add" id="btn-add1">+</button>
                            </div>
                        </div>
                    </div><i class="iconsax delete-icon" data-icon="trash"></i>
                </li>
                <li> <a href="#"> <img src="{{asset('assets/images/cart/3.jpg')}}" alt=""></a>
                    <div>
                        <h6 class="mb-0">Shirts Men's Clothing</h6>
                        <p>$35<del>$40</del><span class="btn-cart">$<span class="btn-cart__total"
                                    id="total2">105</span></span></p>
                        <div class="btn-containter">
                            <div class="btn-control"><button class="btn-control__remove"
                                    id="btn-remove2">&minus;</button>
                                <div class="btn-control__quantity">
                                    <div id="quantity2-previous">2</div>
                                    <div id="quantity2-current">3</div>
                                    <div id="quantity2-next">4</div>
                                </div><button class="btn-control__add" id="btn-add2">+</button>
                            </div>
                        </div>
                    </div><i class="iconsax delete-icon" data-icon="trash"></i>
                </li>
                <li> <a href="#"> <img src="{{asset('assets/images/cart/4.jpg')}}" alt=""></a>
                    <div>
                        <h6 class="mb-0">Shirts Men's Clothing</h6>
                        <p>$35<del>$40</del><span class="btn-cart">$<span class="btn-cart__total"
                                    id="total3">105</span></span></p>
                        <div class="btn-containter">
                            <div class="btn-control"><button class="btn-control__remove"
                                    id="btn-remove3">&minus;</button>
                                <div class="btn-control__quantity">
                                    <div id="quantity3-previous">2</div>
                                    <div id="quantity3-current">3</div>
                                    <div id="quantity3-next">4</div>
                                </div><button class="btn-control__add" id="btn-add3">+</button>
                            </div>
                        </div>
                    </div><i class="iconsax delete-icon" data-icon="trash"></i>
                </li>
            </ul>
        </div>
        <div class="offcanvas-footer">
            <p>Spend <span>$ 14.81 </span>more and enjoy <span>FREE SHIPPING!</span></p>
            <div class="footer-range-slider">
                <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="46"
                    aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-striped progress-bar-animated theme-default"
                        style="width: 46%"></div>
                </div>
            </div>
            <div class="price-box">
                <h6>Total :</h6>
                <p>$ 49.59 USD</p>
            </div>
            <div class="cart-button"> <a class="btn btn_outline" href="{{route('gio-hang.gio-hang')}}"> Xem giỏ hàng</a><a class="btn btn_black"
                    href="check-out.html"> Thanh Toán</a></div>
        </div>
    </div>
    <div class="offcanvas offcanvas-top search-details" id="offcanvasTop" tabindex="-1"
        aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header"><button class="btn-close" type="button" data-bs-dismiss="offcanvas"
                aria-label="Close"><i class="fa-solid fa-xmark"></i></button></div>
        <div class="offcanvas-body theme-scrollbar">
            <div class="container">
                <h3>What are you trying to find?</h3>
                <div class="search-box"> <input type="search" name="text" placeholder="I'm looking for…"><i
                        class="iconsax" data-icon="search-normal-2"></i></div>
                <h4>Popular Searches</h4>
                <ul class="rapid-search">
                    <li> <a href="collection-left-sidebar.html"><i class="iconsax" data-icon="search-normal-2"></i>Jeans
                            Women</a></li>
                    <li> <a href="collection-left-sidebar.html"><i class="iconsax"
                                data-icon="search-normal-2"></i>Blazer Women</a></li>
                    <li> <a href="collection-left-sidebar.html"><i class="iconsax" data-icon="search-normal-2"></i>Jeans
                            Men</a></li>
                    <li> <a href="collection-left-sidebar.html"><i class="iconsax"
                                data-icon="search-normal-2"></i>Blazer Men</a></li>
                    <li> <a href="collection-left-sidebar.html"><i class="iconsax"
                                data-icon="search-normal-2"></i>T-Shirts Men</a></li>
                    <li> <a href="collection-left-sidebar.html"><i class="iconsax" data-icon="search-normal-2"></i>Shoes
                            Men</a></li>
                    <li> <a href="collection-left-sidebar.html"><i class="iconsax"
                                data-icon="search-normal-2"></i>T-Shirts Women</a></li>
                    <li> <a href="collection-left-sidebar.html"><i class="iconsax"
                                data-icon="search-normal-2"></i>Bags</a></li>
                    <li> <a href="collection-left-sidebar.html"><i class="iconsax"
                                data-icon="search-normal-2"></i>Sneakers Women</a></li>
                    <li> <a href="collection-left-sidebar.html"><i class="iconsax"
                                data-icon="search-normal-2"></i>Dresses</a></li>
                </ul>
                <h4>You Might Like</h4>
                <div class="row gy-4 ratio_square-2 preemptive-search">
                    <div class="col-xl-2 col-sm-4 col-6">
                        <div class="product-box-6">
                            <div class="img-wrapper">
                                <div class="product-image"><a href="product.html"> <img class="bg-img"
                                            src="{{asset('assets/images/product/product-2/blazers/1.jpg')}}" alt="product"></a>
                                </div>
                            </div>
                            <div class="product-detail">
                                <div><a href="product.html">
                                        <h6> Women's Stylish Top</h6>
                                    </a>
                                    <p>$50.00 </p>
                                    <ul class="rating">
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                        <li><i class="fa-regular fa-star"></i></li>
                                        <li>4+</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-4 col-6">
                        <div class="product-box-6">
                            <div class="img-wrapper">
                                <div class="product-image"><a href="product.html"> <img class="bg-img"
                                            src="{{asset('assets/images/product/product-2/blazers/2.jpg')}}" alt="product"></a>
                                </div>
                            </div>
                            <div class="product-detail">
                                <div><a href="product.html">
                                        <h6> Women's Stylish Top</h6>
                                    </a>
                                    <p>$95.00 <del>$140.00</del></p>
                                    <ul class="rating">
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                        <li><i class="fa-regular fa-star"></i></li>
                                        <li><i class="fa-regular fa-star"></i></li>
                                        <li>3+</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-4 col-6">
                        <div class="product-box-6">
                            <div class="img-wrapper">
                                <div class="product-image"><a href="product.html"> <img class="bg-img"
                                            src="{{asset('assets/images/product/product-2/blazers/3.jpg')}}" alt="product"></a>
                                </div>
                            </div>
                            <div class="product-detail">
                                <div><a href="product.html">
                                        <h6> Women's Stylish Top</h6>
                                    </a>
                                    <p>$80.00 <del>$140.00</del></p>
                                    <ul class="rating">
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                        <li><i class="fa-regular fa-star"></i></li>
                                        <li>4</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-4 col-6">
                        <div class="product-box-6">
                            <div class="img-wrapper">
                                <div class="product-image"><a href="product.html"> <img class="bg-img"
                                            src="{{asset('assets/images/product/product-2/blazers/4.jpg')}}" alt="product"></a>
                                </div>
                            </div>
                            <div class="product-detail">
                                <div><a href="product.html">
                                        <h6> Women's Stylish Top</h6>
                                    </a>
                                    <p>$90.00 </p>
                                    <ul class="rating">
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                        <li><i class="fa-regular fa-star"></i></li>
                                        <li>2+</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-4 col-6">
                        <div class="product-box-6">
                            <div class="img-wrapper">
                                <div class="product-image"><a href="product.html"> <img class="bg-img"
                                            src="{{asset('assets/images/product/product-2/blazers/5.jpg')}}" alt="product"></a>
                                </div>
                            </div>
                            <div class="product-detail">
                                <div><a href="product.html">
                                        <h6> Women's Stylish Top</h6>
                                    </a>
                                    <p>$180.00 <del>$140.00</del></p>
                                    <ul class="rating">
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                        <li><i class="fa-regular fa-star"></i></li>
                                        <li>4+</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-4 col-6">
                        <div class="product-box-6">
                            <div class="img-wrapper">
                                <div class="product-image"><a href="product.html"> <img class="bg-img"
                                            src="{{asset('assets/images/product/product-2/blazers/6.jpg')}}" alt="product"></a>
                                </div>
                            </div>
                            <div class="product-detail"><a href="product.html">
                                    <h6> Women's Stylish Top</h6>
                                </a>
                                <p>$120.00 </p>
                                <ul class="rating">
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                    <li><i class="fa-regular fa-star"></i></li>
                                    <li>4+</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="theme-btns"><button class="btntheme" id="dark-btn"><i class="fa-regular fa-moon"></i>
            <div class="text">Dark</div>
    </div>
    {{-- <div class="modal theme-modal newsletter-modal newsletter-4 fade" id="newsletter" tabindex="-1" role="dialog"
        aria-modal="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content"><button class="btn-close" type="button" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <div class="modal-body p-0">
                    <div class="news-latter-box">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="newslwtter-content">
                                    <h2>Stay Fashionable</h2><span>Stay Informed</span>
                                    <h4>Subscriber to Our Newsletter!</h4>
                                    <p>Keep up to date so you don't miss any new updates or goods we reveal.</p>
                                    <div class="form-floating"><input type="text" placeholder="Enter Your Name.."></div>
                                    <div class="form-floating"><input type="email" placeholder="Enter Your Email..">
                                    </div><button class="btn btn-submit" type="submit" data-bs-dismiss="modal"
                                        aria-label="Close">Submit</button>
                                </div>
                            </div>
                            <div class="col-md-6 d-none d-lg-block">
                                <div class="newslwtter-img"> <img class="img-fluid"
                                        src="{{asset('assets/images/other-img/news-latter4.png')}}" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Bootstrap js-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script><!-- iconsax js -->
    <script src="{{asset('assets/js/iconsax.js')}}"> </script><!-- cursor js-->
    <script src="{{asset('assets/js/stats.min.js')}}"> </script>
    <script src="{{asset('assets/js/cursor.js')}}"> </script>
    <script src="{{asset('assets/js/swiper-slider/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/swiper-slider/swiper-custom.js')}}"></script>
    <script src="{{asset('assets/js/countdown.js')}}"></script>
    <script src="{{asset('assets/js/newsletter.js')}}"></script>
    <script src="{{asset('assets/js/skeleton-loader.js')}}"></script><!-- touchspin-->
    <script src="{{asset('assets/js/touchspin.js')}}"></script><!-- cookie js-->
    <script src="{{asset('assets/js/cookie.js')}}"></script><!-- tost js -->
    <script src="{{asset('assets/js/toastify.js')}}"></script>
    <script src="{{asset('assets/js/theme-setting.js')}}"></script><!-- Theme js-->
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/otp.js')}}"></script>
    <script src="{{asset('assets/js/ajax.js')}}"></script>
    @yield('js')
</body>
<!-- Mirrored from themes.pixelstrap.net/katie/template/layout-4.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Sep 2024 14:56:02 GMT -->

</html>
