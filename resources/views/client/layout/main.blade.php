<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themes.pixelstrap.net/katie/template/layout-4.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Sep 2024 14:55:23 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Namad">
    <meta name="keywords" content="Namad">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="UyRAaausx7o6Lm-UGCU7ydWTZOdU1ugGbgYzSeMFV-Y" />
    <link rel="icon" href="{{ asset('assets/images/icon_web.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/icon_web.png') }}" type="image/x-icon">
    <title>Namad Store </title><!-- icon_web icon-->
    <link rel="icon" href="{{ asset('assets/images/icon_web.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/icon_web.png') }}" type="image/x-icon">
    <!-- Google Font Outfit-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <!-- Iconsax icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/iconsax.css') }}"><!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" id="rtl-link" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/swiper-slider/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/toastify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="{{ asset('assets/css/landing_page.js') }}"></script>
    <script defer src="{{ asset('assets/css/style.js') }}"></script>
    <link href="{{ asset('assets/css/landing_page.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @yield('css')
    <link rel="stylesheet" href="{{ asset('assets/css/coin.css') }}">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-D79M039PCJ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-D79M039PCJ');
    </script>
</head>

<body class="layout-4 skeleton_body">
    <div class="tap-top">
        <div><i class="fa-solid fa-angle-up"></i></div>
    </div>
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
                                <li> <a href="{{ route('trang-chu.home') }}"><i class="iconsax"
                                            data-icon="home-1"></i>Trang Chủ</a></li>
                                <li><a href="#"><i class="iconsax" data-icon="search-normal-2"></i>Tìm Kiếm</a>
                                </li>
                                <li><a href="#"><i class="iconsax" data-icon="shopping-cart"></i>Giỏ Hàng</a></li>
                                <li><a href="{{ route('tai-khoan.thong-tin-tai-khoan') }}"><i class="iconsax"
                                            data-icon="heart"></i>Yêu Thích</a></li>
                                <li> <a href="#"><i class="iconsax" data-icon="user-2"></i>Tài Khoản</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="main-menu"> <a class="brand-logo" href="#"> <img class="img-fluid for-light"
                                    src="{{ asset('assets/images/logo/logo_namad.png') }}" alt="logo"><img
                                    class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_namad.png') }}"
                                    alt="logo"></a>
                            <nav id="main-nav-1">
                                <ul class="nav-menu sm-horizontal">
                                    <li class="mobile-back text-end">Thoát<i class="fa-solid fa-angle-right ps-2"
                                            aria-hidden="true"></i></li>
                                    <li> <a class="nav-link" href="{{ route('trang-chu.home') }}">Trang chủ</a></li>
                                    <li> <a class="nav-link" href="{{ route('gioi-thieu') }}">Giới thiệu</a></li>
                                    <li> <a class="nav-link" href="{{ route('san-pham.san-pham') }}">Sản
                                            Phẩm<span></span></a></li>
                                    <li> <a class="nav-link" href="{{ route('tin-tuc.tin-tuc') }}">Tin
                                            tức<span></span></a></li>
                                    <li> <a class="nav-link" href="{{ route('lien-he.lien-he') }}">Liên hệ </a></li>
                                </ul>
                            </nav>
                            <div class="sub_header">
                                <div class="toggle-nav"><i class="fa-solid fa-bars-staggered sidebar-bar"></i></div>
                                <ul class="justify-content-end">
                                    <li> <button class="search-icon"><i class="iconsax"
                                                data-icon="search-normal-2"></i></button></li>
                                    <li> <a href="wishlist.html"><i class="iconsax" data-icon="heart"></i><span
                                        class="cart_qty_cls">{{$count_yeu_thich}}</span></a></li>
                                    <li><a><i class="iconsax" data-icon="user-2"></i></a></li>
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
                        <div class="shape-images"> <img class="img-1 img-fluid"
                                src="{{ asset('assets/images/layout-4/s-1.png') }}" alt=""><img
                                class="img-2 img-fluid" src="{{ asset('assets/images/layout-4/s-2.png') }}"
                                alt="">
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
            @if (Auth::check())
                <p> Ưu đãi Namad Xu truy cập website hàng ngày để nhận xu <span>NEW</span>
                    <a href="javascript:void(0)" id="tich-xu" title="Quick View" tabindex="0"> NHẬN NGAY</a>
                </p>
            @else
                <p> Ưu đã Namad Xu truy cập website hàng ngày để nhận xu <span>NEW</span>
                    <a href="{{ route('tai-khoan.dang-nhap') }}"> ĐĂNG NHẬP ĐỂ NHẬN XU</a>
                </p>
            @endif
        </div>
        <div class="custom-container container header-1">
            <div class="row">
                <div class="col-12 p-0">
                    <div class="mobile-fix-option">
                        <ul>
                            <li> <a href="{{ route('trang-chu.home') }}"><i class="iconsax"
                                        data-icon="home-1"></i>Trang chủ</a></li>
                            <li><a href="search.html"><i class="iconsax" data-icon="search-normal-2"></i>Tìm kiếm</a>
                            </li>
                            <li class="shopping-cart"> <a href="{{route('gio-hang.gio-hang')}}"><i class="iconsax"
                                        data-icon="shopping-cart"></i>Giỏ hàng</a></li>
                            <li><a href="{{route('yeu-thich.yeu-thich')}}"><i class="iconsax" data-icon="heart"></i>Yêu thích</a></li>
                            @if (Auth::check())
                                <li> <a href="{{route('tai-khoan.thong-tin-tai-khoan')}}"><i class="iconsax" data-icon="user-2"></i>Tài khoản</a>
                            @else
                                <li> <a href="{{route('tai-khoan.dang-nhap')}}"><i class="iconsax" data-icon="user-2"></i>Tài khoản</a>
                            @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="main-menu">
                        <a class="brand-logo" href="{{ route('trang-chu.home') }}">
                            <img class="img-fluid for-light" src="{{ asset('assets/images/logo/logo_namad.png') }}" alt="logo">
                        </a>
                        <nav id="main-nav">
                            <ul class="nav-menu sm-horizontal theme-scrollbar" id="sm-horizontal">
                                <li class="mobile-back" id="mobile-back">Thoát<i class="fa-solid fa-angle-right ps-2"
                                        aria-hidden="true"></i></li>
                                <li> <a class="nav-link" href="{{ route('trang-chu.home') }}">Trang Chủ</a>
                                </li>
                                <li> <a class="nav-link" href="{{ route('gioi-thieu') }}">Giới Thiệu</a>
                                </li>
                                <li> <a class="nav-link" href="{{ route('san-pham.san-pham') }}">Sản Phẩm<span> <i
                                                class="fa-solid fa-angle-down"></i></span>
                                        <p class="lable-nav" style="right: -7px">Hot</p>
                                    </a>
                                    <ul class="nav-submenu">
                                        @foreach ($danh_mucs as $item)
                                            <li>
                                                <a href="{{ route('san-pham.san-pham-danh-muc', $item->id) }}">{{ $item->ten_danh_muc }}
                                                    <span class="badge-sm danger-color animated">Hot</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li> <a class="nav-link" href="{{ route('tin-tuc.tin-tuc') }}">Tin Tức<span> <i
                                                class="fa-solid fa-angle-down"></i></span></a>
                                    <ul class="nav-submenu">
                                        @foreach ($danhMucTinTuc as $item)
                                            <li> <a
                                                    href="{{ route('tin-tuc.tin-tuc-danh-muc', $item->id) }}">{{ $item->ten_danh_muc }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li> <a class="nav-link" href="{{ route('lien-he.lien-he') }}">Liên Hệ </a></li>
                            </ul>
                        </nav>
                        <div class="sub_header">
                            <div class="toggle-nav" id="toggle-nav"><i
                                    class="fa-solid fa-bars-staggered sidebar-bar"></i></div>
                            <ul class="justify-content-end">
                                <li> <button href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop"
                                        aria-controls="offcanvasTop"><i class="iconsax"
                                            data-icon="search-normal-2"></i></button></li>
                                <li>
                                    <a href="{{route('yeu-thich.yeu-thich')}}">
                                        <i class="iconsax" data-icon="heart"></i>
                                        <span class="cart_qty_cls soLuongYeuThich">{{$count_yeu_thich}}</span>
                                    </a>
                                </li>
                                <li class="onhover-div"><a href="{{route('tai-khoan.thong-tin-tai-khoan')}}"><i class="iconsax"
                                            data-icon="user-2"></i></a>
                                    <div class="onhover-show-div user">
                                        <ul>
                                            @if (Auth::check())
                                                <li> <a href="{{ route('tai-khoan.thong-tin-tai-khoan') }}">Tài
                                                        khoản</a></li>
                                                <li> <a class="donMuaMenu">Đơn mua</a></li>
                                                <li> <a href="{{ route('tai-khoan.dang-xuat') }}">Đăng Xuất</a></li>
                                            @else
                                                <li> <a href="{{ route('tai-khoan.dang-nhap') }}">Đăng Nhập </a></li>
                                                <li> <a href="{{ route('tai-khoan.dang-ky') }}">Đăng Ký</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                                <li class="onhover-div shopping-cart">
                                    <a class="p-0" href="{{ route('gio-hang.gio-hang') }}">
                                        <div class="shoping-prize countGioHangMenu">
                                            <i class="iconsax pe-2" data-icon="basket-2"></i>
                                            <span
                                                style="border: none; margin: 0px; padding: 0px;">{{ $count_gio_hang }}</span>
                                            sản phẩm
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    {{-- end header --}}
    {{-- popup thông báo --}}
    <div id="thongbaothemgiohang">
        <div id="cart-message"></div>
    </div>
    {{-- end popup thông báo --}}
    @yield('container')

    {{-- footer --}}
    <footer class="footer-layout-img">
        <section class="section-b-space footer-1">
            <div class="custom-container container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer-content">
                            <div class="footer-logo">
                                <a href="index.html">
                                    <img class="img-fluid" src="{{ asset('assets/images/logo/logo_namad.png') }}"
                                        alt="Footer Logo">
                                </a>
                            </div>
                            <ul>
                                <li> <i class="iconsax" data-icon="location"></i>
                                    <h6>Mỹ Đình, Hà Nội</h6>
                                </li>
                                <li> <i class="iconsax" data-icon="phone-calling"></i>
                                    <h6>+84 35 786 4779</h6>
                                </li>
                                <li> <i class="iconsax" data-icon="mail"></i>
                                    <h6>namadstore2024@gmail.com</h6>
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
                                        <li> <a class="nav" href="{{ route('trang-chu.home') }}">Trang chủ</a>
                                        </li>
                                        <li> <a class="nav" href="{{ route('gioi-thieu') }}">Giới thiệu</a></li>
                                        <li> <a class="nav" href="{{ route('san-pham.san-pham') }}">Sản phẩm</a>
                                        </li>
                                        <li> <a class="nav" href="{{ route('tin-tuc.tin-tuc') }}">Tin tức</a></li>
                                        <li> <a class="nav" href="{{ route('lien-he.lien-he') }}">Liên hệ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-content">
                            <div>
                                <div class="footer-title d-md-block">
                                    <h5>Danh Mục</h5>
                                    <ul class="footer-details accordion-hidden">
                                        @foreach ($danh_mucs as $item)
                                            <li>
                                                <a class="nav"
                                                    href="{{ route('san-pham.san-pham-danh-muc', $item->id) }}">{{ $item->ten_danh_muc }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-content">
                            <div>
                                <div class="footer-title d-md-block">
                                    <h5>Chính sách</h5>
                                    <ul class="footer-details accordion-hidden">
                                        <li> <a class="nav" href="{{ route('chinh-sach-bao-mat') }}">Chính sách
                                            bảo mật</a></li>
                                        <li> <a class="nav" href="{{ route('cau-hoi-thuong-gap') }}">Câu hỏi
                                                thường gặp </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="footer-content">
                            <div>
                                <div class="footer-title d-md-block">
                                    <h5>Tài Khoản Của Tôi</h5>
                                    <ul class="footer-details accordion-hidden">
                                        @if (Auth::check())
                                            <li> <a class="nav" href="{{ route('tai-khoan.thong-tin-tai-khoan') }}">Tài khoản của tôi</a></li>
                                            <li> <a class="nav" href="{{ route('gio-hang.gio-hang') }}">Giỏ hàng</a></li>
                                            <li> <a class="nav" href="{{ route('yeu-thich.yeu-thich') }}">Sản phẩm yêu thích</a></li>
                                        @else
                                            <li> <a class="nav" href="{{ route('tai-khoan.dang-nhap') }}">Đăng nhập / Đăng ký</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>

    @if (Auth::check())

        @if (Auth::user()->vai_tro_id == 3) {{-- khach hang --}}
            {{-- Chát trực tiếp --}}
            <div class="chat-button" id="chatButton" onclick="toggleChat({{Auth::id()}})">
                <span class="chat-icon">💬</span>
            </div>

            <div class="chat-container" id="chatContainer">
                <div class="chat-header">
                    <h3>Gửi tin nhắn</h3>
                    <button class="btn-close" type="button" onclick="closeChat()"></button>
                </div>

                <div class="chat-messages" id="chatMessages">
                    <!-- Tin nhắn sẽ được load ở đây -->
                </div>

                <div class="chat-input">
                    <input type="text" id="messageInput" placeholder="Nhập tin nhắn..." />
                    <button data-userid="{{Auth::id()}}">Gửi</button>
                </div>
            </div>
            {{-- @vite(['resources/js/app.js']) --}}
            <script src="{{ asset('assets/js/chat.js') }}"></script>
            {{-- END Chát trực tiếp --}}
        @endif

        {{-- GIAO DIỆN NHẠN XU --}}
        <div class="reviews-modal modal theme-modal fade" id="daily-coin" data-id="{{ $userId }}"
            tabindex="-1" role="dialog" aria-modal="true">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body pt-0 coin-content">
                        <div class="modal-header">
                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div id="dailyCoinContainer" class="coin-container">
                            <div class="coin-header">Namad Xu</div>
                            {{-- Tổng xu --}}
                            <div id="userCoin" class="current-coin"></div>
                            <div class="days-container d-flex">
                                <div class="day-box" id="day-1">
                                    <div class="coin-icon">
                                        <img src="{{ asset('assets/images/coin.png') }}" alt="lỗi">
                                    </div>
                                    <div class="check-icon" style="display: none;">
                                        <img src="{{ asset('assets/images/v.png') }}" alt="lỗi">
                                    </div>
                                    <div>Ngày 1</div>
                                    <div>+100</div>
                                </div>
                                <div class="day-box" id="day-2">
                                    <div class="coin-icon">
                                        <img src="{{ asset('assets/images/coin.png') }}" alt="coin">
                                    </div>
                                    <div class="check-icon" style="display: none;">
                                        <img src="{{ asset('assets/images/v.png') }}" alt="lỗi">
                                    </div>
                                    <div>Ngày 2</div>
                                    <div>+100</div>
                                </div>
                                <div class="day-box" id="day-3">
                                    <div class="coin-icon">
                                        <img src="{{ asset('assets/images/coin.png') }}" alt="coin">
                                    </div>
                                    <div class="check-icon" style="display: none;">
                                        <img src="{{ asset('assets/images/v.png') }}" alt="lỗi">
                                    </div>
                                    <div>Ngày 3</div>
                                    <div>+100</div>
                                </div>
                                <div class="day-box" id="day-4">
                                    <div class="coin-icon">
                                        <img src="{{ asset('assets/images/coin.png') }}" alt="coin">
                                    </div>
                                    <div class="check-icon" style="display: none;">
                                        <img src="{{ asset('assets/images/v.png') }}" alt="lỗi">
                                    </div>
                                    <div>Ngày 4</div>
                                    <div>+100</div>
                                </div>
                                <div class="day-box" id="day-5">
                                    <div class="coin-icon">
                                        <img src="{{ asset('assets/images/coin.png') }}" alt="coin">
                                    </div>
                                    <div class="check-icon" style="display: none;">
                                        <img src="{{ asset('assets/images/v.png') }}" alt="lỗi">
                                    </div>
                                    <div>Ngày 5</div>
                                    <div>+100</div>
                                </div>
                                <div class="day-box" id="day-6">
                                    <div class="coin-icon">
                                        <img src="{{ asset('assets/images/coin.png') }}" alt="coin">
                                    </div>
                                    <div class="check-icon" style="display: none;">
                                        <img src="{{ asset('assets/images/v.png') }}" alt="lỗi">
                                    </div>
                                    <div>Ngày 6</div>
                                    <div>+100</div>
                                </div>
                                <div class="day-box complete" id="day-7">
                                    <div class="coin-icon">
                                        <img src="{{ asset('assets/images/coin.png') }}" alt="coin">
                                    </div>
                                    <div class="check-icon" style="display: none;">
                                        <img src="{{ asset('assets/images/v.png') }}" alt="lỗi">
                                    </div>
                                    <div>Ngày 7</div>
                                    <div>+300</div>
                                </div>
                            </div>
                            <button class="btn btn_black rounded sm mt-3" id="dailyCoinButton">Nhận Xu</button>
                            <div class="mt-3" style="color: red; font-size: 20px" id="coinMessage"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- Xem nhanh sản phẩm quick view --}}
    <div class="modal theme-modal fade" id="quick-view" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-xs-12 img-quick-view"></div>
                        <div class="col-lg-6 rtl-text">
                            <div class="product-right">
                                <h3></h3>
                                <h5></h5>
                                <input type="hidden" id="mauSac-quick-view" value="">
                                <ul class="color-variant" id="selectMauSac-quick-view"></ul>
                                <div class="product-description">
                                    <div class="size-box">
                                        <input type="hidden" id="size-quick-view" value="">
                                        <ul id="selectSize-quick-view"></ul>
                                    </div>
                                    <p class="text-danger" id="errSelect-quick-view">Vui lòng chọn phân loại hàng ! </p>
                                    <h6 class="product-title">Số lượng</h6>
                                    <div class="quantity">
                                        <button class="minus" type="button" disabled> <i
                                                class="fa-solid fa-minus"></i> </button>
                                        <input type="hidden" id="soLuong-quick-view" value="1">
                                        <input type="number" value="1" min="1" readonly>
                                        <button class="plus" type="button" disabled> <i
                                                class="fa-solid fa-plus"></i> </button>
                                    </div>
                                    <p class="text-danger" id="errSL-quick-view">Vui lòng xóa bớt số lượng sản phẩm này trong giỏ hàng để tiếp tục thêm !</p>
                                </div>
                                <input class="tokenThemGioHang" type="hidden" name="_token"
                                    value="{{ csrf_token() }}" />
                                <div class="product-buttons">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- cửa sổ nhỏ thêm thành công sản phẩm vào giỏ hàng --}}
    <div class="modal theme-modal fade cart-modal" id="addtocart" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body modal1">
                    <div class="custom-container container">
                        <div class="row">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- tim kiem --}}
    <div class="offcanvas offcanvas-top search-details" id="offcanvasTop" tabindex="-1"
        aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header"><button class="btn-close" type="button" data-bs-dismiss="offcanvas"
                aria-label="Close"><i class="fa-solid fa-xmark"></i></button></div>
        <div class="offcanvas-body theme-scrollbar">
            <div class="container">
                <h3>Tìm Kiếm</h3>
                    <div class="search-box">
                        <input type="search" name="search_text" placeholder="..." required>
                        <i class="iconsax"
                            data-icon="search-normal-2">
                        </i>
                    </div>
                <div class="row gy-4 ratio_square-2 preemptive-search">

                </div>
            </div>
        </div>
    </div>
    <div class="modal theme-modal fade" id="size-chart" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Size Chart</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <a href="#">
                        <img class="img-fluid" src="{{ asset('assets/images/size-chart/size-chart.png') }}"
                            alt="Size Chart">
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- popup thông báo tự làm  --}}
    <div class="modal theme-modal fade" id="thongBao" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="row align-items-center">
                        <div class="thongBaoXoa">
                            <div class="titleThongBao">Bạn có muốn xóa các sản phẩm đã chọn không ?</div>
                            <div class="btnDongY"><button class="btn btn-danger">Đồng ý</button></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap js-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/iconsax.js') }}"></script><!-- cursor js-->
    <script src="{{ asset('assets/js/stats.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-slider/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-slider/swiper-custom.js') }}"></script>
    <script src="{{ asset('assets/js/countdown.js') }}"></script>
    <script src="{{ asset('assets/js/skeleton-loader.js') }}"></script><!-- touchspin-->
    <script src="{{ asset('assets/js/cookie.js') }}"></script><!-- tost js -->
    <script src="{{ asset('assets/js/toastify.js') }}"></script>
    <script src="{{ asset('assets/js/theme-setting.js') }}"></script><!-- Theme js-->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/otp.js') }}"></script>
    <script src="{{ asset('assets/js/ajax.js') }}"></script>
    <script src="{{ asset('assets/js/tich-xu.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @yield('js')
</body>
<!-- Mirrored from themes.pixelstrap.net/katie/template/layout-4.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Sep 2024 14:56:02 GMT -->

</html>
