@extends('client.layout.main')
@section('container')
<section class="section-b-space pt-0">
    <div class="heading-banner">
        <div class="custom-container container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Sản phẩm</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-b-space pt-0 product-thumbnail-page">
    <div class="custom-container container">
        <div class="row gy-4">
            <div class="col-lg-6">
                <div class="row sticky">
                    <div class="col-sm-2 col-3">
                        <div class="swiper product-slider product-slider-img">
                            <div class="swiper-wrapper">
                                @foreach ($san_pham->bienThes->unique('ma_mau') as $item)
                                    <div class="swiper-slide"> <img src="{{Storage::url($item->hinh_anh)}}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10 col-9">
                        <div class="swiper product-slider-thumb product-slider-img-1">
                            <div class="swiper-wrapper ratio_square-2">
                                @foreach ($san_pham->bienThes->unique('ma_mau') as $item)
                                    <div class="swiper-slide"> <img class="bg-img"
                                        src="{{Storage::url($item->hinh_anh)}}" alt=""></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product-detail-box">
                    <div class="product-option">
                        <h3>{{$san_pham->ten_san_pham}}</h3>
                        @php
                            $gia_khuyen_mai = $san_pham->gia_san_pham - ($san_pham->gia_san_pham * $san_pham->khuyen_mai / 100);
                        @endphp
                        <p>{{ number_format($gia_khuyen_mai, 0, ',', '.') }}đ
                            @if ($san_pham->khuyen_mai>0)
                                <del>{{ number_format($san_pham->gia_san_pham, 0, ',', '.') }}đ</del>
                                <span class="offer-btn">{{$san_pham->khuyen_mai}}% off</span>
                            @endif
                        </p>
                        <div class="rating">
                            @php
                                $avg_rating = $san_pham->danhGias->avg('so_sao');
                            @endphp
                            <ul>
                                <li>
                                    @php
                                        // Tính số sao đầy, sao nửa và sao rỗng
                                        $full_stars = floor($avg_rating); // Số sao đầy
                                        $half_star = ($avg_rating - $full_stars) >= 0.5 ? 1 : 0; // Sao nửa
                                        $empty_stars = 5 - ($full_stars + $half_star); // Sao rỗng
                                    @endphp

                                    {{-- Hiển thị sao đầy --}}
                                    @for ($i = 0; $i < $full_stars; $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor

                                    {{-- Hiển thị sao nửa nếu có --}}
                                    @if ($half_star)
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    @endif

                                    {{-- Hiển thị sao rỗng --}}
                                    @for ($i = 0; $i < $empty_stars; $i++)
                                        <i class="fa-regular fa-star"></i>
                                    @endfor
                                </li>

                                {{-- Hiển thị số điểm đánh giá --}}
                                <li>({{ number_format($avg_rating, 1) }}) Đánh giá</li>
                            </ul>
                        </div>
                        <div class="buy-box border-buttom">
                            <ul>
                                <li> <span data-bs-toggle="modal" data-bs-target="#size-chart" title="Quick View"
                                        tabindex="0"><i class="iconsax me-2" data-icon="ruler"></i>Bảng kích thước</span>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex">
                            <div>
                                <h5>Kích cỡ:</h5>
                                <div class="size-box">
                                    <ul class="selected" id="selectSize">
                                        @foreach ($kich_cos as $item)
                                            @php
                                                // Kiểm tra nếu có biến thể với kích cỡ này
                                                $kichCoTonTai = $san_pham->bienThes->contains('kich_co', $item->kich_co);
                                            @endphp
                                            <li class="{{ !$kichCoTonTai ? 'disabled' : '' }}" data-size="{{ $item->kich_co }}">
                                                <a href="javascript:void(0);">{{ $item->kich_co }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h5>Màu sắc:</h5>
                            <div class="color-box">
                                <ul id="selectMauSac">
                                    @foreach ($san_pham->bienThes->unique('ma_mau') as $item)
                                        <li data-color="{{$item->ma_mau}}" style="background-color: {{$item->ma_mau}}; border: 1px solid #0000003b;"></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="quantity-box d-flex align-items-center gap-3">
                            <div class="quantity"><button class="minus" type="button"><i
                                        class="fa-solid fa-minus"></i></button><input type="number" value="1"
                                    min="1" max="20"><button class="plus" type="button"><i
                                        class="fa-solid fa-plus"></i></button></div>
                            <div class="d-flex align-items-center gap-3 w-100"> <a class="btn btn_black sm" href="#"
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                    aria-controls="offcanvasRight">Thêm giỏ hàng</a><a class="btn btn_outline sm"
                                    href="#">Mua ngay</a></div>
                        </div>
                        <div class="buy-box">
                            <ul>
                                <li> <a href="wishlist.html"> <i class="fa-regular fa-heart me-2"></i>Thêm vào yêu thích</a></li>
                            </ul>
                        </div>
                        <div class="dz-info">
                            <ul>
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <h6>Mã sản phẩm:</h6>
                                        <p> SP-{{$san_pham->id}} </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <h6>SL kho: </h6>
                                        <p id="soLuongTon"  data-id="{{$san_pham->id}}">{{$san_pham->bienThes->sum('so_luong')}}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <h6>Tags: </h6>
                                        <p>Color Pink Clay , Athletic, Accessories, Vendor Kalles</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <h6>Danh mục: </h6>
                                        <p><a href="#">{{$san_pham->danhMuc->ten_danh_muc}}</a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-section-box x-small-section pt-0 mt-5">
        <div class="custom-container container">
            <div class="row">
                <div class="col-12">
                    <ul class="product-tab theme-scrollbar nav nav-tabs nav-underline" id="Product" role="tablist">
                        <li class="nav-item" role="presentation"><button class="nav-link active"
                                id="Description-tab" data-bs-toggle="tab" data-bs-target="#Description-tab-pane"
                                role="tab" aria-controls="Description-tab-pane"
                                aria-selected="true">Mô tả</button></li>
                        <li class="nav-item" role="presentation"><button class="nav-link" id="Reviews-tab"
                                data-bs-toggle="tab" data-bs-target="#Reviews-tab-pane" role="tab"
                                aria-controls="Reviews-tab-pane" aria-selected="false">Đánh giá</button></li>
                    </ul>
                    <div class="tab-content product-content" id="ProductContent">
                        <div class="tab-pane fade show active" id="Description-tab-pane" role="tabpanel"
                            aria-labelledby="Description-tab" tabindex="0">
                            <div class="row gy-4">
                                <div class="col-12">
                                    <p class="paragraphs">{!! $san_pham->mo_ta !!}</p>
                                </div>
                            </div>
                        </div>

                        {{-- binh luan --}}
                        <div class="tab-pane fade" id="Reviews-tab-pane" role="tabpanel"
                            aria-labelledby="Reviews-tab" tabindex="0">
                            <div class="row gy-4">
                                <div class="col-lg-4">
                                    <div class="review-right">
                                        <div class="customer-rating">
                                            <div class="global-rating">
                                                <div>
                                                    <h5>4.5</h5>
                                                </div>
                                                <div>
                                                    <h6>Average Ratings</h6>
                                                    <ul class="rating p-0 mb">
                                                        <li><i class="fa-solid fa-star"></i></li>
                                                        <li><i class="fa-solid fa-star"></i></li>
                                                        <li><i class="fa-solid fa-star"></i></li>
                                                        <li><i class="fa-solid fa-star"></i></li>
                                                        <li><i class="fa-regular fa-star"></i></li>
                                                        <li><span>(14)</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <ul class="rating-progess">
                                                <li>
                                                    <p>5 Star</p>
                                                    <div class="progress" role="progressbar"
                                                        aria-label="Animated striped example" aria-valuenow="75"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                            style="width: 80%"></div>
                                                    </div>
                                                    <p>80%</p>
                                                </li>
                                                <li>
                                                    <p>4 Star</p>
                                                    <div class="progress" role="progressbar"
                                                        aria-label="Animated striped example" aria-valuenow="75"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                            style="width: 70%"></div>
                                                    </div>
                                                    <p>70%</p>
                                                </li>
                                                <li>
                                                    <p>3 Star</p>
                                                    <div class="progress" role="progressbar"
                                                        aria-label="Animated striped example" aria-valuenow="75"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                            style="width: 55%"></div>
                                                    </div>
                                                    <p>55%</p>
                                                </li>
                                                <li>
                                                    <p>2 Star</p>
                                                    <div class="progress" role="progressbar"
                                                        aria-label="Animated striped example" aria-valuenow="75"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                            style="width: 40%"></div>
                                                    </div>
                                                    <p>40%</p>
                                                </li>
                                                <li>
                                                    <p>1 Star</p>
                                                    <div class="progress" role="progressbar"
                                                        aria-label="Animated striped example" aria-valuenow="75"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                            style="width: 25%"></div>
                                                    </div>
                                                    <p>25%</p>
                                                </li>
                                            </ul><button class="btn reviews-modal" data-bs-toggle="modal"
                                                data-bs-target="#Reviews-modal" title="Quick View"
                                                tabindex="0">Write a review</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="comments-box">
                                        <h5>Comments </h5>
                                        <ul class="theme-scrollbar">
                                            <li>
                                                <div class="comment-items">
                                                    <div class="user-img"> <img src="../assets/images/user/1.jpg"
                                                            alt=""></div>
                                                    <div class="user-content">
                                                        <div class="user-info">
                                                            <div class="d-flex justify-content-between gap-3">
                                                                <h6> <i class="iconsax"
                                                                        data-icon="user-1"></i>Michel Poe</h6><span>
                                                                    <i class="iconsax" data-icon="clock"></i>Mar 29,
                                                                    2022</span>
                                                            </div>
                                                            <ul class="rating p-0 mb">
                                                                <li><i class="fa-solid fa-star"></i></li>
                                                                <li><i class="fa-solid fa-star"></i></li>
                                                                <li><i class="fa-solid fa-star"></i></li>
                                                                <li><i class="fa-solid fa-star"></i></li>
                                                                <li><i class="fa-regular fa-star"></i></li>
                                                            </ul>
                                                        </div>
                                                        <p>Khaki cotton blend military jacket flattering fit mock
                                                            horn buttons and patch pockets showerproof black
                                                            lightgrey. Printed lining patch pockets jersey blazer
                                                            built in pocket square wool casual quilted jacket
                                                            without hood azure.</p><a href="#"> <span> <i
                                                                    class="iconsax" data-icon="undo"></i>
                                                                Replay</span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="reply">
                                                <div class="comment-items">
                                                    <div class="user-img"> <img src="../assets/images/user/2.jpg"
                                                            alt=""></div>
                                                    <div class="user-content">
                                                        <div class="user-info">
                                                            <div class="d-flex justify-content-between gap-3">
                                                                <h6> <i class="iconsax"
                                                                        data-icon="user-1"></i>Michel Poe</h6><span>
                                                                    <i class="iconsax" data-icon="clock"></i>Mar 29,
                                                                    2022</span>
                                                            </div>
                                                            <ul class="rating p-0 mb">
                                                                <li><i class="fa-solid fa-star"></i></li>
                                                                <li><i class="fa-solid fa-star"></i></li>
                                                                <li><i class="fa-solid fa-star"></i></li>
                                                                <li><i class="fa-solid fa-star"></i></li>
                                                                <li><i class="fa-regular fa-star"></i></li>
                                                            </ul>
                                                        </div>
                                                        <p>Khaki cotton blend military jacket flattering fit mock
                                                            horn buttons and patch pockets showerproof black
                                                            lightgrey. Printed lining patch pockets jersey blazer
                                                            built in pocket square wool casual quilted jacket
                                                            without hood azure.</p><a href="#"> <span> <i
                                                                    class="iconsax" data-icon="undo"></i>
                                                                Replay</span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="comment-items">
                                                    <div class="user-img"> <img src="../assets/images/user/3.jpg"
                                                            alt=""></div>
                                                    <div class="user-content">
                                                        <div class="user-info">
                                                            <div class="d-flex justify-content-between gap-3">
                                                                <h6> <i class="iconsax"
                                                                        data-icon="user-1"></i>Michel Poe</h6><span>
                                                                    <i class="iconsax" data-icon="clock"></i>Mar 29,
                                                                    2022</span>
                                                            </div>
                                                            <ul class="rating p-0 mb">
                                                                <li><i class="fa-solid fa-star"></i></li>
                                                                <li><i class="fa-solid fa-star"></i></li>
                                                                <li><i class="fa-solid fa-star"></i></li>
                                                                <li><i class="fa-solid fa-star"></i></li>
                                                                <li><i class="fa-regular fa-star"></i></li>
                                                            </ul>
                                                        </div>
                                                        <p>Khaki cotton blend military jacket flattering fit mock
                                                            horn buttons and patch pockets showerproof black
                                                            lightgrey. Printed lining patch pockets jersey blazer
                                                            built in pocket square wool casual quilted jacket
                                                            without hood azure.</p><a href="#"> <span> <i
                                                                    class="iconsax" data-icon="undo"></i>
                                                                Replay</span></a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-b-space pt-0">
    <div class="custom-container container product-contain">
        <div class="title text-start">
            <h3>Sản phẩm liên quan</h3>
        </div>
        <div class="swiper special-offer-slide-2">
            <div class="swiper-wrapper ratio1_3">
                @foreach ($san_pham_lien_quan as $item)
                    @if ($item->id!=$san_pham->id)
                        <div class="swiper-slide">
                            <div class="product-box-3">
                                <div class="img-wrapper">
                                    <div class="label-block"><span class="lable-1">NEW</span><a
                                            class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0"><i
                                                class="iconsax" data-icon="heart" aria-hidden="true"
                                                data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích"></i></a></div>
                                    <div class="product-image style-border">
                                        <a class="pro-first" href="{{route('san-pham.chi-tiet-san-pham',$item->id)}}">
                                            <img class="bg-img" src="{{Storage::url($item->hinh_anh)}}" alt="Sản phẩm">
                                        </a>
                                        <a class="pro-sec" href="{{route('san-pham.chi-tiet-san-pham',$item->id)}}">
                                            <img class="bg-img" src="{{Storage::url($item->bienThes->first()->hinh_anh)}}" alt="Sản phẩm">
                                        </a>
                                    </div>
                                    <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#addtocart" tabindex="0"><i class="iconsax" data-icon="basket-2"
                                                aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Thêm giỏ hàng">
                                            </i></a>
                                            <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#quick-view" tabindex="0"><i class="iconsax" data-icon="eye"
                                                aria-hidden="true" data-bs-toggle="tooltip"
                                                data-bs-title="Quick View"></i></a></div>
                                </div>
                                <div class="product-detail">
                                    <ul class="rating">
                                        <li>
                                            @php
                                                $avg_rating = $item->danhGias->avg('so_sao');
                                            @endphp

                                            @php
                                                // Tính số sao đầy, sao nửa và sao rỗng
                                                $full_stars = floor($avg_rating); // Số sao đầy
                                                $half_star = ($avg_rating - $full_stars) >= 0.5 ? 1 : 0; // Sao nửa
                                                $empty_stars = 5 - ($full_stars + $half_star); // Sao rỗng
                                            @endphp

                                            {{-- Hiển thị sao đầy --}}
                                            @for ($i = 0; $i < $full_stars; $i++)
                                                <i class="fa-solid fa-star"></i>
                                            @endfor

                                            {{-- Hiển thị sao nửa nếu có --}}
                                            @if ($half_star)
                                                <i class="fa-solid fa-star-half-stroke"></i>
                                            @endif

                                            {{-- Hiển thị sao rỗng --}}
                                            @for ($i = 0; $i < $empty_stars; $i++)
                                                <i class="fa-regular fa-star"></i>
                                            @endfor
                                        </li>

                                        {{-- Hiển thị số điểm đánh giá --}}
                                        @php
                                            if($avg_rating>0){
                                                $danh_gia=number_format($avg_rating, 1);
                                            }else{
                                                $danh_gia="Chưa có đánh giá";
                                            }
                                        @endphp
                                        <li>({{$danh_gia}})</li>
                                    </ul><a href="{{route('san-pham.chi-tiet-san-pham',$item->id)}}">
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
                    @endif
                @endforeach

            </div>
        </div>
    </div>
</section>
@endsection
