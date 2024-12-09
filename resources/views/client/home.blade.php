@extends('client.layout.main')
@section('container')
    {{-- banner --}}
    <section class="section-space home-section-4">
        <div class="custom-container container">
            <div class="row">
                <div class="col-12">
                    <div class="home-content">
                        <p>Nâng tầm phong cách phái mạnh - Tự tin lịch lãm mỗi ngày</p>
                        <h2> </h2>
                        <h1>Namad Store</h1>
                        <h6>Diện mạo hoàn hảo cho phái mạnh - Phong cách không thể bỏ qua</h6>
                    </div>
                    @foreach ($banner as $item)
                        <div class="home-images">
                            <img class="img-fluid" src="{{Storage::url($item->hinh_anh)}}" alt="Lỗi">
                        </div>                
                    @endforeach
                    <div class="marquee">
                        <div class="marquee__item">
                            <h4 class="animation-text">Namad</h4>
                        </div>
                        <div class="marquee__item">
                            <h4 class="animation-text">Namad</h4>
                        </div>
                        <div class="marquee__item">
                            <h4 class="animation-text">Namad</h4>
                        </div>
                        <div class="marquee__item">
                            <h4 class="animation-text">Namad</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- danh muc --}}
    <section class="section-t-space">
        <div class="container-fluid fashion-images">
            <div class="swiper fashion-images-slide">
                <div class="swiper-wrapper ratio_square-2" style="justify-content: center;">
                    @foreach ($danh_mucs as $item)
                    <div class="swiper-slide">
                        <div class="fashion-box text-center">
                            <a href="{{route('san-pham.san-pham-danh-muc', $item->id)}}" class="category-link">
                                <img class="img-fluid category-img" src="{{Storage::url($item->hinh_anh)}}" alt="danhmuc">
                                <h5 class="category-title">{{$item->ten_danh_muc}}</h5>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- container --}}
    <section class="section-t-space">
        <div class="custom-container container product-contain">
            <div class="title mb-5">
                <h3>Sản Phẩm Bán Chạy </h3>
            </div>
            <div class="row trending-products">
                <div class="col-12">
                    <div class="theme-tab-1">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation"><a class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#features-products" role="tab" aria-controls="features-products"
                                    aria-selected="true">
                                    <h6>Sản Phẩm Nổi Bật</h6>
                                </a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#latest-products" role="tab" aria-controls="latest-products"
                                    aria-selected="false">
                                    <h6>Sản Phẩm Mới Nhất</h6>
                                </a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#seller-products" role="tab" aria-controls="seller-products"
                                    aria-selected="false">
                                    <h6>Sản Phẩm Bán Chạy Nhất </h6>
                                </a></li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-12 ratio_square">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="features-products" role="tabpanel"
                                    tabindex="0">
                                    <div class="row g-4">
                                        @foreach ($san_pham_noi_bat as $item)
                                            <div class="col-xxl-3 col-md-4 col-6">
                                                <div class="product-box">
                                                    <div class="img-wrapper">
                                                        {{-- on sale --}}
                                                        @if ($item->khuyen_mai > 0)
                                                            <div class="label-block"><img
                                                                    src="{{ asset('assets/images/product/3.png') }}"
                                                                    alt="lable"><span>on <br>Sale!</span>
                                                            </div>
                                                        @endif

                                                        <div class="product-image style-border"><a
                                                                href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}">
                                                                <img class="bg-img"
                                                                    src="{{ Storage::url($item->hinh_anh) }}"
                                                                    alt="sản phẩm"></a>
                                                        </div>
                                                        <div class="cart-info-icon">
                                                            <a class="wishlist-icon" style="background-color: {{  $item->yeuThich->isNotEmpty() ? '#e67e22' : 'rgba(255,255,255,1)' }}"
                                                                tabindex="0" data-wishlistIdSanPham="{{ $item->id }}">
                                                                <i class="iconsax" data-icon="heart" style="--Iconsax-Color: {{ $item->yeuThich->isNotEmpty() ? '#fff' : 'rgba(38,40,52,1)' }}"
                                                                    aria-hidden="true" data-bs-toggle="tooltip"></i>
                                                            </a>
                                                            <a class="quickViewClick" data-id="{{ $item->id }}"
                                                                href="javascript:void(0)" tabindex="0">
                                                                <i class="iconsax" data-icon="eye" aria-hidden="true"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-title="Xem nhanh"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="product-detail">
                                                        <div class="color-box">
                                                            <ul class="color-variant">
                                                                {{-- bien the mau sac --}}
                                                                @foreach ($item->bienThes->unique('ma_mau')->take(4) as $mau_sac)
                                                                    <li
                                                                        style="background-color: {{ $mau_sac->ma_mau }}; border: 1px solid #0000003b;">
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            {{-- danh gia --}}
                                                            @php
                                                                $avg_rating = $item->danhGias->avg('so_sao');
                                                            @endphp

                                                            <span>
                                                                {{ $avg_rating ? number_format($avg_rating, 1) : '' }}
                                                                @if ($avg_rating > 0)
                                                                    <i class="fa-solid fa-star"></i>
                                                                @endif
                                                            </span>
                                                        </div><a
                                                            href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}">
                                                            <h6>{{ $item->ten_san_pham }}</h6>
                                                        </a>
                                                        @php
                                                            $gia_khuyen_mai =
                                                                $item->gia_san_pham -
                                                                ($item->gia_san_pham * $item->khuyen_mai) / 100;
                                                        @endphp
                                                        <p>
                                                            {{ number_format($gia_khuyen_mai, 0, ',', '.') }}đ
                                                            @if ($item->khuyen_mai > 0)
                                                                <del>{{ number_format($item->gia_san_pham, 0, ',', '.') }}đ</del>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="latest-products" role="tabpanel" tabindex="0">
                                    <div class="row g-4">
                                        @foreach ($san_pham_moi_nhat as $item)
                                            <div class="col-xxl-3 col-md-4 col-6">
                                                <div class="product-box">
                                                    <div class="img-wrapper">
                                                        {{-- on sale --}}
                                                        @if ($item->khuyen_mai > 0)
                                                            <div class="label-block"><img
                                                                    src="{{ asset('assets/images/product/3.png') }}"
                                                                    alt="lable"><span>on <br>Sale!</span>
                                                            </div>
                                                        @endif

                                                        <div class="product-image style-border"><a
                                                                href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}">
                                                                <img class="bg-img"
                                                                    src="{{ Storage::url($item->hinh_anh) }}"
                                                                    alt="sản phẩm"></a>
                                                        </div>
                                                        <div class="cart-info-icon">
                                                            <a class="wishlist-icon" style="background-color: {{  $item->yeuThich->isNotEmpty() ? '#e67e22' : 'rgba(255,255,255,1)' }}"
                                                                tabindex="0" data-wishlistIdSanPham="{{ $item->id }}">
                                                                <i class="iconsax" data-icon="heart" style="--Iconsax-Color: {{ $item->yeuThich->isNotEmpty() ? '#fff' : 'rgba(38,40,52,1)' }}"
                                                                    aria-hidden="true" data-bs-toggle="tooltip"></i>
                                                            </a>
                                                            <a class="quickViewClick" data-id="{{ $item->id }}"
                                                                href="javascript:void(0)" tabindex="0">
                                                                <i class="iconsax" data-icon="eye" aria-hidden="true"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-title="Xem nhanh"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="product-detail">
                                                        <div class="color-box">
                                                            <ul class="color-variant">
                                                                {{-- bien the mau sac --}}
                                                                @foreach ($item->bienThes->unique('ma_mau')->take(4) as $mau_sac)
                                                                    <li
                                                                        style="background-color: {{ $mau_sac->ma_mau }}; border: 1px solid #0000003b;">
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            {{-- danh gia --}}
                                                            @php
                                                                $avg_rating = $item->danhGias->avg('so_sao');
                                                            @endphp

                                                            <span>
                                                                {{ $avg_rating ? number_format($avg_rating, 1) : '' }}
                                                                @if ($avg_rating > 0)
                                                                    <i class="fa-solid fa-star"></i>
                                                                @endif
                                                            </span>
                                                        </div><a
                                                            href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}">
                                                            <h6>{{ $item->ten_san_pham }}</h6>
                                                        </a>
                                                        @php
                                                            $gia_khuyen_mai =
                                                                $item->gia_san_pham -
                                                                ($item->gia_san_pham * $item->khuyen_mai) / 100;
                                                        @endphp
                                                        <p>
                                                            {{ number_format($gia_khuyen_mai, 0, ',', '.') }}đ
                                                            @if ($item->khuyen_mai > 0)
                                                                <del>{{ number_format($item->gia_san_pham, 0, ',', '.') }}đ</del>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="seller-products" role="tabpanel" tabindex="0">
                                    <div class="row g-4">
                                        @foreach ($san_pham_ban_chay as $item)
                                            <div class="col-xxl-3 col-md-4 col-6">
                                                <div class="product-box">
                                                    <div class="img-wrapper">
                                                        {{-- on sale --}}
                                                        @if ($item->khuyen_mai > 0)
                                                            <div class="label-block"><img
                                                                    src="{{ asset('assets/images/product/3.png') }}"
                                                                    alt="lable"><span>on <br>Sale!</span>
                                                            </div>
                                                        @endif

                                                        <div class="product-image style-border"><a
                                                                href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}">
                                                                <img class="bg-img"
                                                                    src="{{ Storage::url($item->hinh_anh) }}"
                                                                    alt="sản phẩm"></a>
                                                        </div>
                                                        <div class="cart-info-icon">
                                                            <a class="wishlist-icon" style="background-color: {{  $item->yeuThich->isNotEmpty() ? '#e67e22' : 'rgba(255,255,255,1)' }}"
                                                                tabindex="0" data-wishlistIdSanPham="{{ $item->id }}">
                                                                <i class="iconsax" data-icon="heart" style="--Iconsax-Color: {{ $item->yeuThich->isNotEmpty() ? '#fff' : 'rgba(38,40,52,1)' }}"
                                                                    aria-hidden="true" data-bs-toggle="tooltip"></i>
                                                            </a>
                                                            <a class="quickViewClick" data-id="{{ $item->id }}"
                                                                href="javascript:void(0)" tabindex="0">
                                                                <i class="iconsax" data-icon="eye" aria-hidden="true"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-title="Xem nhanh"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="product-detail">
                                                        <div class="color-box">
                                                            <ul class="color-variant">
                                                                {{-- bien the mau sac --}}
                                                                @foreach ($item->bienThes->unique('ma_mau')->take(4) as $mau_sac)
                                                                    <li
                                                                        style="background-color: {{ $mau_sac->ma_mau }}; border: 1px solid #0000003b;">
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            {{-- danh gia --}}
                                                            @php
                                                                $avg_rating = $item->danhGias->avg('so_sao');
                                                            @endphp

                                                            <span>
                                                                {{ $avg_rating ? number_format($avg_rating, 1) : '' }}
                                                                @if ($avg_rating > 0)
                                                                    <i class="fa-solid fa-star"></i>
                                                                @endif
                                                            </span>
                                                        </div><a
                                                            href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}">
                                                            <h6>{{ $item->ten_san_pham }}</h6>
                                                        </a>
                                                        @php
                                                            $gia_khuyen_mai =
                                                                $item->gia_san_pham -
                                                                ($item->gia_san_pham * $item->khuyen_mai) / 100;
                                                        @endphp
                                                        <p>
                                                            {{ number_format($gia_khuyen_mai, 0, ',', '.') }}đ
                                                            @if ($item->khuyen_mai > 0)
                                                                <del>{{ number_format($item->gia_san_pham, 0, ',', '.') }}đ</del>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-t-space">
        <div class="custom-container container best-seller">
            <div class="row">
                <div class="col-xl-9">
                    <div class="row g-4">
                        <div class="col-md-5">
                            <div class="best-seller-img ratio_square-3"><a href="{{route('san-pham.san-pham')}}"> <img
                                        class="bg-img" src="{{asset('assets/images/layout-4/Bo-Suu-Tap1.png')}}"
                                        alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-7 ratio_landscape">
                            <div class="style-content">
                                <h6>Mặc theo phong cách của bạn</h6>
                                <h2>Tạo phiên bản mới của chính bạn</h2>
                                <h4>Mua hàng trực tuyến</h4>
                                <div class="link-hover-anim underline"><a
                                        class="btn btn_underline link-strong link-strong-unhovered"
                                        href="{{route('san-pham.san-pham')}}">Bộ sưu tập</a><a
                                        class="btn btn_underline link-strong link-strong-hovered"
                                        href="{{route('san-pham.san-pham')}}">Bộ sưu tập</a></div>
                            </div><a href="{{route('san-pham.san-pham')}}"> <img class="bg-img"
                                    src="{{asset('assets/images/layout-4/Bo-Suu-Tap2.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-3 d-none d-xl-block">
                    <div class="col-3 d-none d-xl-block">
                        <div class="col-3 d-none d-xl-block">
                            <div class="best-seller-box">
                                <div class="offer-container">
                                    <!-- Hộp quà -->
                                    <div class="gift-box" onclick="openGift()">
                                        <p class="tap-to-open">Chạm để mở quà!</p>
                                        <div class="box-lid"></div>
                                        <div class="box-body"></div>
                                        <div class="ribbon"></div>
                                    </div>
                                    <!-- Pháo hoa -->
                                    <div class="fireworks hidden">
                                        <div class="firework"></div>
                                        <div class="firework"></div>
                                        <div class="firework"></div>
                                    </div>
                                    <!-- Popup thông báo -->
                                    <div class="popup hidden popup-mo-qua">
                                        <div class="popup-content">
                                            <h4>Chúc mừng bạn!</h4>
                                            <p><span class="coin-amount">0 xu</span></p>
                                            <a href="{{route('san-pham.san-pham')}}" class="btn">Đến cửa hàng</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
    @if (count($san_pham_khuyen_mai) > 0)
        <section class="section-t-space">
            <div class="custom-container container product-contain">
                <div class="title mb-5">
                    <h3>Sản Phẩm Khuyến Mãi</h3>
                </div>
                <div class="swiper fashikart-slide">
                    <div class="swiper-wrapper trending-products ratio_square">
                        @foreach ($san_pham_khuyen_mai as $item)
                            <div class="swiper-slide product-box">
                                <div class="img-wrapper">
                                    {{-- on sale --}}
                                    @if ($item->khuyen_mai > 0)
                                        <div class="label-block"><img src="{{ asset('assets/images/product/3.png') }}"
                                                alt="lable"><span>on <br>Sale!</span>
                                        </div>
                                    @endif

                                    <div class="product-image style-border"><a
                                            href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}">
                                            <img class="bg-img" src="{{ Storage::url($item->hinh_anh) }}"
                                                alt="sản phẩm"></a>
                                    </div>
                                    <div class="cart-info-icon">
                                        <a class="wishlist-icon" style="background-color: {{  $item->yeuThich->isNotEmpty() ? '#e67e22' : 'rgba(255,255,255,1)' }}"
                                        tabindex="0" data-wishlistIdSanPham="{{ $item->id }}">
                                            <i class="iconsax" data-icon="heart" style="--Iconsax-Color: {{ $item->yeuThich->isNotEmpty() ? '#fff' : 'rgba(38,40,52,1)' }}"
                                                aria-hidden="true" data-bs-toggle="tooltip"></i>
                                        </a>
                                        <a class="quickViewClick" data-id="{{ $item->id }}" tabindex="0">
                                            <i class="iconsax" data-icon="eye" aria-hidden="true"
                                                data-bs-toggle="tooltip"
                                                data-bs-title="Xem nhanh"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="color-box">
                                        <ul class="color-variant">
                                            {{-- bien the mau sac --}}
                                            @foreach ($item->bienThes->unique('ma_mau')->take(4) as $mau_sac)
                                                <li
                                                    style="background-color: {{ $mau_sac->ma_mau }}; border: 1px solid #0000003b;">
                                                </li>
                                            @endforeach
                                        </ul>
                                        {{-- danh gia --}}
                                        @php
                                            $avg_rating = $item->danhGias->avg('so_sao');
                                        @endphp

                                        <span>
                                            {{ $avg_rating ? number_format($avg_rating, 1) : '' }}
                                            @if ($avg_rating > 0)
                                                <i class="fa-solid fa-star"></i>
                                            @endif
                                        </span>
                                    </div><a href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}">
                                        <h6>{{ $item->ten_san_pham }}</h6>
                                    </a>
                                    @php
                                        $gia_khuyen_mai =
                                            $item->gia_san_pham - ($item->gia_san_pham * $item->khuyen_mai) / 100;
                                    @endphp
                                    <p>
                                        {{ number_format($gia_khuyen_mai, 0, ',', '.') }}đ
                                        <del>{{ number_format($item->gia_san_pham, 0, ',', '.') }}đ</del>
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </section>
    @endif
    {{-- tin tuc  --}}
    <section class="section-t-space">
        <div class="custom-container container">
            <div class="title">
                <h3>Tin tức</h3>
            </div>
            <div class="swiper blog-slide">
                <div class="swiper-wrapper">
                    @foreach ($tin_tucs as $item)
                    <div class="swiper-slide blog-main">
                        <div class="blog-box ratio3_2">
                            <a class="blog-img" href="{{route('tin-tuc.chi-tiet-tin-tuc',$item->id)}}">
                                <img class="bg-img" src="{{Storage::url($item->hinh_anh)}}" alt="err">
                            </a>
                        </div>
                        <div class="blog-txt">
                            <p>By: {{$item->user->ho_va_ten?$item->user->ho_va_ten:'Admin'}} / {{ \Carbon\Carbon::parse($item->ngay_dang)->format('F j, Y') }}</p>
                            <a href="{{route('tin-tuc.chi-tiet-tin-tuc',$item->id)}}">
                                <h5>{!! Str::limit(strip_tags($item->noi_dung), 60, '...') !!}</h5>
                            </a>
                            <div class="link-hover-anim underline">
                                <a class="btn btn_underline link-strong link-strong-unhovered" href="{{route('tin-tuc.chi-tiet-tin-tuc',$item->id)}}">Xem thêm</a>
                                <a class="btn btn_underline link-strong link-strong-hovered" href="{{route('tin-tuc.chi-tiet-tin-tuc',$item->id)}}">Xem thêm</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    {{-- end tin tuc  --}}
    <section class="section-t-space instashop-section mb-5">
        <div class="container-fluid">
            <div class="row row-cols-xl-5 row-cols-md-4 row-cols-2 ratio_square-1">
                <div class="col">
                    <div class="instagram-box">
                        <div class="instashop-effect"><img class="bg-img"
                                src="{{ asset('assets/images/instagram/Sơ Mi Bò Xanh.jpg') }}" alt="">
                            <div class="insta-txt">
                                <div>
                                    <p>Instashop</p>
                                    <div class="link-hover-anim underline"><a
                                            class="btn btn_underline link-strong link-strong-unhovered"
                                            href="product.html">Khám phá</a>
                                        <a class="btn btn_underline link-strong link-strong-hovered"
                                            href="product.html">Khám phá</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="instagram-box">
                        <div class="instashop-effect"><img class="bg-img"
                                src="{{ asset('assets/images/instagram/SM-Trơn Xanh Trời.jpg') }}" alt="">
                            <div class="insta-txt">
                                <div>
                                    <p>Instashop</p>
                                    <div class="link-hover-anim underline"><a
                                            class="btn btn_underline link-strong link-strong-unhovered"
                                            href="https://www.instagram.com/namad.store.official/">Khám phá</a>
                                        <a class="btn btn_underline link-strong link-strong-hovered"
                                            href="https://www.instagram.com/namad.store.official/">Khám phá</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="instagram-txt-box">
                        <div>
                            <div>
                                <div class="instashop-icon">
                                    <h3>Instashop</h3>
                                </div><span> </span>
                                <p>Nếu bạn có bất kỳ thắc mắc nào hoặc muốn tìm hiểu thêm về các sản phẩm và dịch vụ của
                                    chúng tôi, đừng ngần ngại liên hệ qua Instagram. Theo dõi chúng tôi tại @namadstore để
                                    cập nhật những xu hướng thời trang mới nhất và nhắn tin trực tiếp để được hỗ trợ nhanh
                                    chóng!.</p>
                            </div>
                            <div>
                                <div class="link-hover-anim underline"><a
                                        class="btn btn_underline link-strong link-strong-unhovered"
                                        href="https://www.instagram.com/namad.store.official/"
                                        target="_blank">Instagram</a><a
                                        class="btn btn_underline link-strong link-strong-hovered"
                                        href="https://www.instagram.com/namad.store.official/"
                                        target="_blank">Instagram</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="instagram-box">
                        <div class="instashop-effect"><img class="bg-img"
                                src="{{ asset('assets/images/instagram/sơ mi bò.jpg') }}" alt="">
                            <div class="insta-txt">
                                <div>
                                    <p>Instashop</p>
                                    <div class="link-hover-anim underline"><a
                                            class="btn btn_underline link-strong link-strong-unhovered"
                                            href="https://www.instagram.com/namad.store.official/">Khám phá</a>
                                        <a class="btn btn_underline link-strong link-strong-hovered"
                                            href="https://www.instagram.com/namad.store.official/">Khám phá</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="instagram-box">
                        <div class="instashop-effect"><img class="bg-img"
                                src="{{ asset('assets/images/instagram/AP-Young Rich.jpg') }}" alt="">
                            <div class="insta-txt">
                                <div>
                                    <p>Instashop</p>
                                    <div class="link-hover-anim underline"><a
                                            class="btn btn_underline link-strong link-strong-unhovered"
                                            href="https://www.instagram.com/namad.store.official/">Khám phá</a>
                                        <a class="btn btn_underline link-strong link-strong-hovered"
                                            href="https://www.instagram.com/namad.store.official/">Khám phá</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
