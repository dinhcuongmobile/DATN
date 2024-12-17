@extends('client.layout.main')

@section('css')
    <style>
        .page-link {
            color: black
        }

        .page-link.active,
        .active>.page-link {
            background-color: #cd773d;
            border-color: #cd773d;
        }
    </style>
@endsection

@section('container')
    <section class="section-b-space pt-0">
        <div class="heading-banner">
            <div class="custom-container container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4>Bộ Sưu Tập</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- slider danh muc --}}
    <section class="section-b-space pt-0">
        <div class="custom-container container collection-images">
            <div class="swiper collection-images-slide">
                <div class="swiper-wrapper ratio_square-2">
                    <div class="swiper-slide">
                        <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/1.png"
                                alt=""></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/3.png"
                                alt=""></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/6.png"
                                alt=""></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/8.png"
                                alt=""></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/10.png"
                                alt=""></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/1.png"
                                alt=""></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/3.png"
                                alt=""></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/6.png"
                                alt=""></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/8.png"
                                alt=""></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/10.png"
                                alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section-b-space pt-0">
        <div class="custom-container container">
            <div class="row">
                <div class="col-3">
                    <div class="custom-accordion theme-scrollbar left-box">
                        <div class="left-accordion">
                            <h5>Thoát </h5><i class="back-button fa-solid fa-xmark"></i>
                        </div>
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseFour"><span>Lọc theo giá</span></button>
                                </h2>
                                <div class="accordion-collapse collapse show mb-3" id="panelsStayOpen-collapseFour">
                                    <div class="accordion-body">
                                        <form action="{{ route('san-pham.san-pham') }}" method="get">
                                            <div class="range-slider">
                                                <input id="minPrice" name="minPrice" class="range-slider-input"
                                                    type="range" min="0" max="{{ $maxPrice }}"
                                                    step="1" value="{{ request()->get('minPrice', $minPrice) }}">
                                                <input id="maxPrice" name="maxPrice" class="range-slider-input"
                                                    type="range" min="0" max="{{ $maxPrice }}"
                                                    step="1" value="{{ request()->get('maxPrice', $maxPrice) }}">
                                                <div class="range-slider-display"></div>
                                            </div>
                                            <button type="submit" id="enterLoc" class="btn">Lọc</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseTwo"><span>Danh mục</span></button>
                                </h2>
                                <div class="accordion-collapse collapse show" id="panelsStayOpen-collapseTwo">
                                    <div class="accordion-body">
                                        <ul class="catagories-side theme-scrollbar styleSPDanhMuc">
                                            @foreach ($danh_mucs as $item)
                                                <li> <a href="{{route('san-pham.san-pham-danh-muc',$item->id)}}">{{ $item->ten_danh_muc }}
                                                        ({{ $count_sp_danh_muc[$item->id] ?? 0 }})
                                                    </a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header tags-header"><button class="accordion-button"><span>Vận Chuyển
                                            & Giao hàng</span><span></span></button></h2>
                                <div class="accordion-collapse collapse show" id="panelsStayOpen-collapseSeven">
                                    <div class="accordion-body">
                                        <ul class="widget-card">
                                            <li><i class="iconsax" data-icon="truck-fast"></i>
                                                <div>
                                                    <h6>Miễn phí vận chuyển</h6>
                                                </div>
                                            </li>
                                            <li><i class="iconsax" data-icon="headphones"></i>
                                                <div>
                                                    <h6>Hỗ trợ 24/7</h6>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="sticky">
                        <div class="top-filter-menu">
                            <div> <a class="filter-button btn">
                                    <h6> <i class="iconsax" data-icon="filter"></i>Danh sách bộ lọc </h6>
                                </a>
                                <form id="formFilter" action="{{ route('san-pham.san-pham') }}" method="get">
                                    <div class="category-dropdown">
                                        <label for="orderby">Sắp xếp theo :</label>
                                        <select class="form-select" id="orderby" name="orderby">
                                            <option value="" {{ request('orderby') == '' ? 'selected' : '' }}>Mặc
                                                định</option>
                                            <option value="best-selling"
                                                {{ request('orderby') == 'best-selling' ? 'selected' : '' }}>Bán chạy nhất
                                            </option>
                                            <option value="a-z" {{ request('orderby') == 'a-z' ? 'selected' : '' }}>
                                                Theo
                                                thứ tự, A-Z</option>
                                            <option value="price-high-low"
                                                {{ request('orderby') == 'price-high-low' ? 'selected' : '' }}>Giá cao -
                                                thấp</option>
                                            <option value="discount-high-low"
                                                {{ request('orderby') == 'discount-high-low' ? 'selected' : '' }}>Giảm giá
                                                %
                                                từ cao - thấp</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="product-tab-content ratio1_3">
                            <div id="productList"
                                class="row-cols-lg-4 row-cols-md-3 row-cols-2 grid-section view-option row g-3 g-xl-4">
                                @foreach ($san_phams as $item)
                                    @if ($item->bienThes->count()>0)
                                        @php
                                            $isWishlist = $item->yeuThich->isNotEmpty(); // Kiểm tra trạng thái yêu thích
                                        @endphp 
                                        <div>
                                            <div class="product-box-3">
                                                <div class="img-wrapper">
                                                    <div class="label-block">
                                                        <a class="label-2 wishlist-icon" style="background-color: {{ $isWishlist ? '#e67e22' : 'rgba(255,255,255,1)' }}"
                                                        tabindex="0" data-wishlistIdSanPham="{{ $item->id }}">
                                                            <i class="iconsax" data-icon="heart" style="--Iconsax-Color: {{ $isWishlist ? '#fff' : 'rgba(38,40,52,1)' }}">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12 21.6516C11.69 21.6516 11.39 21.6116 11.14 21.5216C7.32 20.2116 1.25
                                                                        15.5616 1.25 8.69156C1.25 5.19156 4.08 2.35156 7.56 2.35156C9.25 2.35156 10.83 3.01156
                                                                        12 4.19156C13.17 3.01156 14.75 2.35156 16.44 2.35156C19.92 2.35156 22.75 5.20156 22.75 8.69156C22.75
                                                                        15.5716 16.68 20.2116 12.86 21.5216C12.61 21.6116 12.31 21.6516 12 21.6516ZM7.56 3.85156C4.91 3.85156 2.75
                                                                        6.02156 2.75 8.69156C2.75 15.5216 9.32 19.3216 11.63 20.1116C11.81 20.1716 12.2 20.1716 12.38 20.1116C14.68
                                                                        19.3216 21.26 15.5316 21.26 8.69156C21.26 6.02156 19.1 3.85156 16.45 3.85156C14.93 3.85156 13.52 4.56156
                                                                        12.61 5.79156C12.33 6.17156 11.69 6.17156 11.41 5.79156C10.48 4.55156 9.08 3.85156 7.56 3.85156Z"
                                                                        fill="#292D32">
                                                                    </path>
                                                                </svg>
                                                            </i>
                                                        </a>
                                                    </div>
                                                    <div class="product-image style-border">
                                                        <a class="pro-first bg-size"
                                                            href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}"
                                                            style="background-image: url({{ Storage::url($item->hinh_anh) }});
                                                            background-size:cover;
                                                            background-position: center;
                                                            background-repeat: no-repeat;
                                                            display: block;
                                                            ">
                                                            <img class="bg-img" src="{{ Storage::url($item->hinh_anh) }}"
                                                                alt="Sản phẩm" style="display: none;">
                                                        </a>
                                                        <a class="pro-sec bg-size"
                                                            href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}"
                                                            style="
                                                            background-image: url({{ Storage::url($item->bienThes->first()->hinh_anh) }});
                                                            background-size:cover;
                                                            background-position: center;
                                                            background-repeat: no-repeat;
                                                            display: block;
                                                            ">
                                                            <img class="bg-img"
                                                                src="{{ Storage::url($item->bienThes->first()->hinh_anh) }}"
                                                                alt="Sản phẩm" style="display: none;">
                                                        </a>
                                                    </div>
                                                    <div class="cart-info-icon">
                                                        <a class="quickViewClick" data-id="{{$item->id}}" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#quick-view"
                                                            tabindex="0">
                                                            <i class="iconsax" data-icon="eye" title="Xem nhanh">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M15.58 12C15.58 13.98 13.98 15.58 12 15.58C10.02 15.58 8.42004 13.98 8.42004
                                                                        12C8.42004 10.02 10.02 8.42004 12 8.42004C13.98 8.42004
                                                                        15.58 10.02 15.58 12Z"
                                                                        stroke="#292D32" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path
                                                                        d="M12 20.27C15.53 20.27 18.82 18.19 21.11 14.59C22.01 13.18 22.01 10.81
                                                                        21.11 9.39997C18.82 5.79997 15.53 3.71997 12 3.71997C8.46997 3.71997 5.17997
                                                                        5.79997 2.88997 9.39997C1.98997 10.81 1.98997 13.18 2.88997 14.59C5.17997 18.19
                                                                        8.46997 20.27 12 20.27Z"
                                                                        stroke="#292D32" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                </svg>
                                                            </i>
                                                        </a>
                                                    </div>
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
                                                                $half_star = $avg_rating - $full_stars >= 0.5 ? 1 : 0; // Sao nửa
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
                                                            if ($avg_rating > 0) {
                                                                $danh_gia = number_format($avg_rating, 1);
                                                            } else {
                                                                $danh_gia = 'Chưa có đánh giá';
                                                            }
                                                        @endphp
                                                        <li>({{ $danh_gia }})</li>
                                                    </ul>
                                                    <a href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}">
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
                                    @endif
                                @endforeach

                            </div>
                        </div>
                        <div class="pagination-wrap">
                            <ul class="pagination">
                                {{-- Nút Previous --}}
                                <li>
                                    <a class="prev" data-url="{{ $san_phams->previousPageUrl() ?? '#' }}">
                                        <i class="iconsax" data-icon="chevron-left"></i>
                                    </a>
                                </li>
                                {{-- Hiển thị các số trang --}}
                                @foreach ($san_phams->getUrlRange(1, $san_phams->lastPage()) as $page => $url)
                                    <li class="page-item {{ $page == $san_phams->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $url }}" class="page-link"
                                            data-url="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                {{-- Nút Next --}}
                                <li>
                                    <a class="next" data-url="{{ $san_phams->nextPageUrl() ?? '#' }}">
                                        <i class="iconsax" data-icon="chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    {{-- Phân trang --}}
    <script src="{{ asset('assets/js/page.js') }}"></script>
    {{-- Lọc sản phẩm theo giá --}}
    <script src="{{ asset('assets/js/filter-range-slider.js') }}"></script>
    {{-- Sắp xếp sản phẩm --}}
    <script>
        $('#orderby').change(function() {
            var formData = $('#formFilter').serializeArray(); // Lấy dữ liệu từ form
            var urlParams = new URLSearchParams(window.location.search);
            // Lấy các tham số từ URL hiện tại

            // Cập nhật các tham số từ formData vào urlParams
            formData.forEach(function(item) {
                urlParams.set(item.name, item.value); // Lưu các tham số
            });

            // Lấy giá trị của orderby
            var orderbyValue = $('#orderby').val();

            // Thêm hoặc xóa tham số `orderby` vào URLParams
            if (orderbyValue) {
                urlParams.set('orderby', orderbyValue); // Thêm tham số orderby
            } else {
                urlParams.delete('orderby'); // Xóa tham số orderby nếu là mặc định
            }

            // Tạo URL mới
            var newUrl = $('#formFilter').attr('action') + '?' + urlParams.toString();
            // Cập nhật URL với tham số mới

            window.history.pushState(null, '', newUrl); // Cập nhật URL

            $.ajax({
                url: "{{ route('san-pham.san-pham') }}",
                type: 'GET',
                data: urlParams.toString(), // Gửi tất cả các tham số đã được thêm vào
                success: function(response) {
                    $('#productList').html(response.html); // Cập nhật danh sách sản phẩm
                },
                error: function(xhr) {
                    console.log('Có lỗi xảy ra:', xhr.responseText);
                }
            });
        });
    </script>
    <script>
        function loadFilteredPage(url) {
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    // Cập nhật danh sách sản phẩm
                    $('#productList').html(response.html);

                    // Hiển thị và ẩn các nút trang
                    $('.pagination .page-item').each(function() {
                        let page = parseInt($(this).find('.page-link').text());

                        // Ẩn nút nếu trang không có trong danh sách `pages`
                        if (response.pages.includes(page)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                },
                error: function() {
                    console.error('Lỗi');
                }
            });
        }
    </script>
@endsection
