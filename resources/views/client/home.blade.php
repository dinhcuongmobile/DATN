@extends('client.layout.main')
@section('container')
{{-- banner --}}
<section class="section-space home-section-4">
    <div class="custom-container container">
        <div class="row">
            <div class="col-12">
                <div class="home-content">
                    <p>Create Your Style<span></span></p>
                    <h2>New Style For</h2>
                    <h1>Spring & Summer</h1>
                    <h6>Amet minim mollit non deserunt dolor do amet sint. </h6><a class="btn btn_outline"
                        href="collection-left-sidebar.html">Shop Now</a>
                </div>
                <div class="product-1">
                    <div class="product"> <img class="img-fluid" src="../assets/images/layout-4/p-1.jpg" alt="">
                        <div class="product-details">
                            <h6>Black Women Top</h6>
                            <p>Women's Style</p>
                            <ul class="rating">
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star"></i></li>
                                <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                <li><i class="fa-regular fa-star"></i></li>
                            </ul>
                            <h5>$48<del>$68 </del><span>-40%</span></h5>
                        </div>
                    </div>
                </div>
                <div class="product-2">
                    <div class="product"><img class="img-fluid" src="../assets/images/layout-4/p-2.png" alt="">
                        <div class="product-details">
                            <div>
                                <h6>Pursesess</h6>
                                <h5>Best Women Bag</h5>
                            </div><span>$65</span>
                        </div>
                    </div>
                </div>
                <div class="home-images">
                    <div class="main-images"></div><img class="img-fluid" src="../assets/images/layout-4/1.png"
                        alt="">
                </div>
                <div class="shape-images"> <img class="img-1 img-fluid" src="../assets/images/layout-4/s-1.png"
                        alt=""><img class="img-2 img-fluid" src="../assets/images/layout-4/s-2.png" alt=""></div>
            </div>
        </div>
    </div>
</section>

{{-- danh muc --}}
<section class="section-t-space">
    <div class="container-fluid fashion-images">
        <div class="swiper fashion-images-slide">
            <div class="swiper-wrapper ratio_square-2">
                <div class="swiper-slide">
                    <div class="fashion-box"><a href="#"> <img class="img-fluid"
                                src="../assets/images/fashion/category/1.png" alt=""></a></div>
                    <h5>Top Wear</h5>
                </div>
                <div class="swiper-slide">
                    <div class="fashion-box"><a href="#"> <img class="img-fluid"
                                src="../assets/images/fashion/category/2.png" alt=""></a></div>
                    <h5>dresses</h5>
                </div>
                <div class="swiper-slide">
                    <div class="fashion-box"><a href="#"> <img class="img-fluid"
                                src="../assets/images/fashion/category/3.png" alt=""></a></div>
                    <h5>bottom</h5>
                </div>
                <div class="swiper-slide">
                    <div class="fashion-box"><a href="#"> <img class="img-fluid"
                                src="../assets/images/fashion/category/4.png" alt=""></a></div>
                    <h5>inner/sleep</h5>
                </div>
                <div class="swiper-slide">
                    <div class="fashion-box"><a href="#"> <img class="img-fluid"
                                src="../assets/images/fashion/category/5.png" alt=""></a></div>
                    <h5>footwear</h5>
                </div>
                <div class="swiper-slide">
                    <div class="fashion-box"><a href="#"> <img class="img-fluid"
                                src="../assets/images/fashion/category/6.png" alt=""></a></div>
                    <h5>sports/active</h5>
                </div>
                <div class="swiper-slide">
                    <div class="fashion-box"><a href="#"> <img class="img-fluid"
                                src="../assets/images/fashion/category/7.png" alt=""></a></div>
                    <h5>Mini dresses</h5>
                </div>
                <div class="swiper-slide">
                    <div class="fashion-box"><a href="#"> <img class="img-fluid"
                                src="../assets/images/fashion/category/3.png" alt=""></a></div>
                    <h5>footwear</h5>
                </div>
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
                                <h6>Sản Phẩm nổi bật</h6>
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
                                                @if ($item->khuyen_mai>0)
                                                    <div class="label-block"><img src="{{asset('assets/images/product/3.png')}}"
                                                            alt="lable"><span>on <br>Sale!</span>
                                                    </div>
                                                @endif

                                                <div class="product-image style-border"><a href="{{route('san-pham.chi-tiet-san-pham',$item->id)}}">
                                                    <img class="bg-img" src="{{Storage::url($item->hinh_anh)}}" alt="sản phẩm"></a>
                                                </div>
                                                <div class="cart-info-icon">
                                                    <a class="wishlist-icon" href="javascript:void(0)" tabindex="0">
                                                        <i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a>
                                                        <a href="compare.html" tabindex="0">
                                                            <i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0">
                                                                <i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i>
                                                        </a>
                                                </div>
                                            </div>
                                            <div class="product-detail">
                                                <div class="color-box">
                                                    <ul class="color-variant">
                                                        {{-- bien the mau sac --}}
                                                        @foreach ($item->bienThes->unique('ma_mau')->take(4) as $mau_sac)
                                                            <li style="background-color: {{$mau_sac->ma_mau}}; border: 1px solid #0000003b;"></li>
                                                        @endforeach
                                                    </ul>
                                                    {{-- danh gia --}}
                                                    @php
                                                        $avg_rating = $item->danhGias->avg('so_sao');
                                                    @endphp

                                                    <span>
                                                        {{ $avg_rating ? number_format($avg_rating, 1) : '' }}
                                                        @if ($avg_rating>0)
                                                        <i class="fa-solid fa-star"></i>
                                                        @endif
                                                    </span>
                                                </div><a href="{{route('san-pham.chi-tiet-san-pham',$item->id)}}">
                                                    <h6>{{$item->ten_san_pham}}</h6>
                                                </a>
                                                @php
                                                    $gia_khuyen_mai = $item->gia_san_pham - ($item->gia_san_pham * $item->khuyen_mai / 100);
                                                @endphp
                                                <p>
                                                    {{ number_format($gia_khuyen_mai, 0, ',', '.') }}đ
                                                    @if ($item->khuyen_mai>0)
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
                                                @if ($item->khuyen_mai>0)
                                                    <div class="label-block"><img src="{{asset('assets/images/product/3.png')}}"
                                                            alt="lable"><span>on <br>Sale!</span>
                                                    </div>
                                                @endif

                                                <div class="product-image style-border"><a href="{{route('san-pham.chi-tiet-san-pham',$item->id)}}">
                                                    <img class="bg-img" src="{{Storage::url($item->hinh_anh)}}" alt="sản phẩm"></a>
                                                </div>
                                                <div class="cart-info-icon">
                                                    <a class="wishlist-icon" href="javascript:void(0)" tabindex="0">
                                                        <i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i>
                                                    </a>
                                                    <a href="compare.html" tabindex="0">
                                                        <i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i>
                                                    </a>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0">
                                                        <i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-detail">
                                                <div class="color-box">
                                                    <ul class="color-variant">
                                                        {{-- bien the mau sac --}}
                                                        @foreach ($item->bienThes->unique('ma_mau')->take(4) as $mau_sac)
                                                            <li style="background-color: {{$mau_sac->ma_mau}}; border: 1px solid #0000003b;"></li>
                                                        @endforeach
                                                    </ul>
                                                    {{-- danh gia --}}
                                                    @php
                                                        $avg_rating = $item->danhGias->avg('so_sao');
                                                    @endphp

                                                    <span>
                                                        {{ $avg_rating ? number_format($avg_rating, 1) : '' }}
                                                        @if ($avg_rating>0)
                                                        <i class="fa-solid fa-star"></i>
                                                        @endif
                                                    </span>
                                                </div><a href="{{route('san-pham.chi-tiet-san-pham',$item->id)}}">
                                                    <h6>{{$item->ten_san_pham}}</h6>
                                                </a>
                                                @php
                                                    $gia_khuyen_mai = $item->gia_san_pham - ($item->gia_san_pham * $item->khuyen_mai / 100);
                                                @endphp
                                                <p>
                                                    {{ number_format($gia_khuyen_mai, 0, ',', '.') }}đ
                                                    @if ($item->khuyen_mai>0)
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
                                                @if ($item->khuyen_mai>0)
                                                    <div class="label-block"><img src="{{asset('assets/images/product/3.png')}}"
                                                            alt="lable"><span>on <br>Sale!</span>
                                                    </div>
                                                @endif

                                                <div class="product-image style-border"><a href="{{route('san-pham.chi-tiet-san-pham',$item->id)}}">
                                                    <img class="bg-img" src="{{Storage::url($item->hinh_anh)}}" alt="sản phẩm"></a>
                                                </div>
                                                <div class="cart-info-icon">
                                                    <a class="wishlist-icon" href="javascript:void(0)" tabindex="0">
                                                        <i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a>
                                                        <a href="compare.html" tabindex="0">
                                                            <i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0">
                                                                <i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i>
                                                        </a>
                                                </div>
                                            </div>
                                            <div class="product-detail">
                                                <div class="color-box">
                                                    <ul class="color-variant">
                                                        {{-- bien the mau sac --}}
                                                        @foreach ($item->bienThes->unique('ma_mau')->take(4) as $mau_sac)
                                                            <li style="background-color: {{$mau_sac->ma_mau}}; border: 1px solid #0000003b;"></li>
                                                        @endforeach
                                                    </ul>
                                                    {{-- danh gia --}}
                                                    @php
                                                        $avg_rating = $item->danhGias->avg('so_sao');
                                                    @endphp

                                                    <span>
                                                        {{ $avg_rating ? number_format($avg_rating, 1) : '' }}
                                                        @if ($avg_rating>0)
                                                        <i class="fa-solid fa-star"></i>
                                                        @endif
                                                    </span>
                                                </div><a href="{{route('san-pham.chi-tiet-san-pham',$item->id)}}">
                                                    <h6>{{$item->ten_san_pham}}</h6>
                                                </a>
                                                @php
                                                    $gia_khuyen_mai = $item->gia_san_pham - ($item->gia_san_pham * $item->khuyen_mai / 100);
                                                @endphp
                                                <p>
                                                    {{ number_format($gia_khuyen_mai, 0, ',', '.') }}đ
                                                    @if ($item->khuyen_mai>0)
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
                        <div class="best-seller-img ratio_square-3"><a href="collection-left-sidebar.html"> <img
                                    class="bg-img" src="../assets/images/layout-4/main-category/1.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-md-7 ratio_landscape">
                        <div class="style-content">
                            <h6>Mặc theo phong cách của bạn</h6>
                            <h2>Tạo phiên bản mới của chính bạn</h2>
                            <h4>Mua hàng trực tuyến</h4>
                            <div class="link-hover-anim underline"><a
                                    class="btn btn_underline link-strong link-strong-unhovered"
                                    href="collection-left-sidebar.html">Bộ sưu tập</a><a class="btn btn_underline link-strong link-strong-hovered"
                                    href="collection-left-sidebar.html">Bộ sưu tập</a></div>
                        </div><a href="collection-left-sidebar.html"> <img class="bg-img"
                                src="../assets/images/layout-4/main-category/2.jpg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-3 d-none d-xl-block">
                <div class="best-seller-box">
                    <div class="offer-banner"><a href="collection-left-sidebar.html">
                            <h2>Giảm thêm 15%</h2><span> </span>
                            <p>Mùa giảm giá của thương hiệu thiết kế tại cửa hàng và trực tuyến trong thời gian có hạn.</p>
                            <div class="btn">
                                <h6>Use Code: <span>KHUTRD***</span></h6>
                            </div>
                        </a></div>
                    <div class="best-seller-content">
                        <h3>Làm bạn thoải mái và sang trọng</h3><span> </span>
                        <div class="link-hover-anim underline"><a
                                class="btn btn_underline link-strong link-strong-unhovered"
                                href="collection-left-sidebar.html">Bộ sưu tập</a>
                                <a class="btn btn_underline link-strong link-strong-hovered"
                                href="collection-left-sidebar.html">Bộ sưu tập</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if (count($san_pham_khuyen_mai)>0)
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
                        @if ($item->khuyen_mai>0)
                            <div class="label-block"><img src="{{asset('assets/images/product/3.png')}}"
                                    alt="lable"><span>on <br>Sale!</span>
                            </div>
                        @endif

                        <div class="product-image style-border"><a href="{{route('san-pham.chi-tiet-san-pham',$item->id)}}">
                            <img class="bg-img" src="{{Storage::url($item->hinh_anh)}}" alt="sản phẩm"></a>
                        </div>
                        <div class="cart-info-icon">
                            <a class="wishlist-icon" href="javascript:void(0)" tabindex="0">
                                <i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i></a>
                                <a href="compare.html" tabindex="0">
                                    <i class="iconsax" data-icon="arrow-up-down" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Compare"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0">
                                        <i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Quick View"></i>
                                </a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="color-box">
                            <ul class="color-variant">
                                {{-- bien the mau sac --}}
                                @foreach ($item->bienThes->unique('ma_mau')->take(4) as $mau_sac)
                                    <li style="background-color: {{$mau_sac->ma_mau}}; border: 1px solid #0000003b;"></li>
                                @endforeach
                            </ul>
                            {{-- danh gia --}}
                            @php
                                $avg_rating = $item->danhGias->avg('so_sao');
                            @endphp

                            <span>
                                {{ $avg_rating ? number_format($avg_rating, 1) : '' }}
                                @if ($avg_rating>0)
                                <i class="fa-solid fa-star"></i>
                                @endif
                            </span>
                        </div><a href="{{route('san-pham.chi-tiet-san-pham',$item->id)}}">
                            <h6>{{$item->ten_san_pham}}</h6>
                        </a>
                        @php
                            $gia_khuyen_mai = $item->gia_san_pham - ($item->gia_san_pham * $item->khuyen_mai / 100);
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
<section class="section-t-space">
    <div class="custom-container container">
        <div class="title">
            <h3>Latest Blog</h3>
        </div>
        <div class="swiper blog-slide">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="blog-main">
                        <div class="blog-box ratio3_2"><a class="blog-img" href="blog-details.html"><img
                                    class="bg-img" src="../assets/images/blog/layout-4/1.jpg" alt=""></a></div>
                        <div class="blog-txt">
                            <p>By: Admin / 26th aug 2020</p><a href="blog-details.html">
                                <h5>Many desktop publishing pack-ages abd page editor...</h5>
                            </a>
                            <div class="link-hover-anim underline"><a
                                    class="btn btn_underline link-strong link-strong-unhovered" href="#">Đọc thêm
                                    </a><a class="btn btn_underline link-strong link-strong-hovered"
                                    href="#">Đọc thêm</a></div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="blog-main">
                        <div class="blog-box ratio3_2"><a class="blog-img" href="blog-details.html"><img
                                    class="bg-img" src="../assets/images/blog/layout-4/1.jpg" alt=""></a></div>
                        <div class="blog-txt">
                            <p>By: Admin / 26th aug 2020</p><a href="blog-details.html">
                                <h5>Many desktop publishing pack-ages abd page editor...</h5>
                            </a>
                            <div class="link-hover-anim underline"><a
                                    class="btn btn_underline link-strong link-strong-unhovered" href="#">Đọc
                                    thêm</a><a class="btn btn_underline link-strong link-strong-hovered"
                                    href="#">Đọc thêm</a></div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="blog-main">
                        <div class="blog-box ratio3_2"><a class="blog-img" href="blog-details.html"><img
                                    class="bg-img" src="../assets/images/blog/layout-4/1.jpg" alt=""></a></div>
                        <div class="blog-txt">
                            <p>By: Admin / 26th aug 2020</p><a href="blog-details.html">
                                <h5>Many desktop publishing pack-ages abd page editor...</h5>
                            </a>
                            <div class="link-hover-anim underline"><a
                                    class="btn btn_underline link-strong link-strong-unhovered" href="#">

                                Đọc thêm</a><a class="btn btn_underline link-strong link-strong-hovered"
                                    href="#">Đọc thêm</a></div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="blog-main">
                        <div class="blog-box ratio3_2"><a class="blog-img" href="blog-details.html"><img
                                    class="bg-img" src="../assets/images/blog/layout-4/1.jpg" alt=""></a></div>
                        <div class="blog-txt">
                            <p>By: Admin / 26th aug 2020</p><a href="blog-details.html">
                                <h5>Many desktop publishing pack-ages abd page editor...</h5>
                            </a>
                            <div class="link-hover-anim underline"><a
                                    class="btn btn_underline link-strong link-strong-unhovered" href="#">

                                    Đọc thêm</a><a class="btn btn_underline link-strong link-strong-hovered"
                                    href="#">Đọc thêm</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-t-space instashop-section mb-5">
    <div class="container-fluid">
        <div class="row row-cols-xl-5 row-cols-md-4 row-cols-2 ratio_square-1">
            <div class="col">
                <div class="instagram-box">
                    <div class="instashop-effect"><img class="bg-img" src="../assets/images/instagram/17.jpg"
                            alt="">
                        <div class="insta-txt">
                            <div>
                                <p>Instashop</p>
                                <div class="link-hover-anim underline"><a
                                        class="btn btn_underline link-strong link-strong-unhovered"
                                        href="product.html">Khám phá</a>
                                        <a class="btn btn_underline link-strong link-strong-hovered"
                                        href="product.html">Khám phá</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="instagram-box">
                    <div class="instashop-effect"><img class="bg-img" src="../assets/images/instagram/18.jpg"
                            alt="">
                        <div class="insta-txt">
                            <div>
                                <p>Instashop</p>
                                <div class="link-hover-anim underline"><a
                                        class="btn btn_underline link-strong link-strong-unhovered"
                                        href="product.html">Khám phá</a>
                                        <a class="btn btn_underline link-strong link-strong-hovered"
                                        href="product.html">Khám phá</a></div>
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
                            <p>Nếu bạn có bất kỳ thắc mắc nào hoặc muốn tìm hiểu thêm về các sản phẩm và dịch vụ của chúng tôi, đừng ngần ngại liên hệ qua Instagram. Theo dõi chúng tôi tại @namadstore để cập nhật những xu hướng thời trang mới nhất và nhắn tin trực tiếp để được hỗ trợ nhanh chóng!.</p>
                        </div>
                        <div>
                            <div class="link-hover-anim underline"><a
                                    class="btn btn_underline link-strong link-strong-unhovered"
                                    href="https://www.instagram.com/namad.store.official/" target="_blank">Instagram</a><a
                                    class="btn btn_underline link-strong link-strong-hovered"
                                    href="https://www.instagram.com/namad.store.official/" target="_blank">Instagram</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="instagram-box">
                    <div class="instashop-effect"><img class="bg-img" src="../assets/images/instagram/19.jpg"
                            alt="">
                        <div class="insta-txt">
                            <div>
                                <p>Instashop</p>
                                <div class="link-hover-anim underline"><a
                                        class="btn btn_underline link-strong link-strong-unhovered"
                                        href="product.html">Khám phá</a>
                                        <a class="btn btn_underline link-strong link-strong-hovered"
                                        href="product.html">Khám phá</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="instagram-box">
                    <div class="instashop-effect"><img class="bg-img" src="../assets/images/instagram/20.jpg"
                            alt="">
                        <div class="insta-txt">
                            <div>
                                <p>Instashop</p>
                                <div class="link-hover-anim underline"><a
                                        class="btn btn_underline link-strong link-strong-unhovered"
                                        href="product.html">Khám phá</a>
                                        <a class="btn btn_underline link-strong link-strong-hovered"
                                        href="product.html">Khám phá</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
