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
                            <div class="search-box"><input type="search" name="text" placeholder="Tìm kiếm..."><i
                                    class="iconsax" data-icon="search-normal-2"></i></div>
                            <div class="accordion-item">
                                <h2 class="accordion-header tags-header"><button class="accordion-button"><span>Từ
                                            khóa</span><span>Xem tất cả</span></button></h2>
                                <div class="accordion-collapse collapse show" id="panelsStayOpen-collapse">
                                    <div class="accordion-body">
                                        <ul class="tags">
                                            <li> <a href="#">T-Shirt <i class="iconsax" data-icon="add"></i></a></li>
                                            <li> <a href="#">Handbags<i class="iconsax" data-icon="add"></i></a></li>
                                            <li> <a href="#">Trends<i class="iconsax" data-icon="add"></i></a></li>
                                            <li> <a href="#">Minimog<i class="iconsax" data-icon="add"></i></a></li>
                                            <li> <a href="#">Denim<i class="iconsax" data-icon="add"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseFour"><span>Lọc theo giá</span></button>
                                </h2>
                                <div class="accordion-collapse collapse show mb-3" id="panelsStayOpen-collapseFour">
                                    <div class="accordion-body">
                                        <div class="range-slider">
                                            <input class="range-slider-input" type="range" min="0"
                                                max="120000" step="1" value="20000"><input
                                                class="range-slider-input" type="range" min="0" max="120000"
                                                step="1" value="100000">
                                            <div class="range-slider-display"></div>
                                        </div>
                                    </div>
                                    <button id="enterLoc" class="btn">Lọc</button>
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
                                                <li> <a href="#">{{ $item->ten_danh_muc }}
                                                        ({{ $count_sp_danh_muc[$item->id] ?? 0 }})
                                                    </a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header tags-header"><button class="accordion-button"><span>vận chuyển
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
                                            <option value="a-z" {{ request('orderby') == 'a-z' ? 'selected' : '' }}>Theo
                                                thứ tự, A-Z</option>
                                            <option value="price-high-low"
                                                {{ request('orderby') == 'price-high-low' ? 'selected' : '' }}>Giá cao -
                                                thấp</option>
                                            <option value="discount-high-low"
                                                {{ request('orderby') == 'discount-high-low' ? 'selected' : '' }}>Giảm giá %
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
                                    <div>
                                        <div class="product-box-3">
                                            <div class="img-wrapper">
                                                <div class="label-block">
                                                    <a class="label-2 wishlist-icon" href="#" tabindex="0">
                                                        <i class="iconsax" data-icon="heart" title="Wishlist">
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
                                                        style="
                                                        background-image: url({{ Storage::url($item->hinh_anh) }});
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
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view"
                                                        tabindex="0">
                                                        <i class="iconsax" data-icon="eye" title="Quick view">
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
                                                </ul><a href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}">
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
                                    <li class="{{ $page == $san_phams->currentPage() ? 'active' : '' }}">
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
    <script>
        $(document).ready(function() {
            $('#orderby').change(function() {
                var formData = $('#formFilter').serialize(); // Lấy dữ liệu từ form
                var currentUrl = window.location.href;
                var pageParam = '';

                // Kiểm tra nếu URL hiện tại có chứa tham số page
                if (currentUrl.includes('page=')) {
                    var page = currentUrl.split('page=')[1].split('&')[0];
                    if (page !== '1') { // Nếu không phải trang 1, thêm tham số page vào URL
                        pageParam = '&page=' + page;
                    }
                }

                var newUrl = $('#formFilter').attr('action') + '?' + formData + pageParam; // URL mới

                // Kiểm tra nếu giá trị là Mặc định thì không thêm tham số `orderby` vào URL
                if ($('#orderby').val() === '') {
                    newUrl = '{{ route('san-pham.san-pham') }}' + (pageParam ? '?' + pageParam.substring(
                        1) : '');
                }

                window.history.pushState(null, '', newUrl); // Cập nhật URL

                $.ajax({
                    url: "{{ route('san-pham.san-pham') }}",
                    type: 'GET',
                    data: formData + pageParam,
                    success: function(response) {
                        $('#productList').html(response.html); // Cập nhật danh sách sản phẩm
                    },
                    error: function(xhr) {
                        console.log('Có lỗi xảy ra:', xhr.responseText);
                    }
                });
            });

            // Xử lý sự kiện khi nhấp vào phân trang
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault(); // Ngăn chặn hành động mặc định

                var url = $(this).data('url'); // Lấy URL từ data-url
                if (!url || $(this).parent().hasClass('disabled')) return;
                // Nếu không có URL hoặc là nút disabled, thoát khỏi hàm

                var formData = $('#formFilter').serialize(); // Lấy dữ liệu từ form

                // Kiểm tra nếu có tham số `orderby`, thêm vào URL
                if (formData) {
                    var orderbyValue = $('#orderby').val(); // Lấy giá trị orderby
                    var defaultOrderbyValue = ''; // Thay thế bằng giá trị mặc định của bạn

                    // Chỉ thêm orderby nếu nó không phải là giá trị mặc định
                    if (orderbyValue && orderbyValue !== defaultOrderbyValue) {
                        var separator = url.includes('?') ? '&' : '?';
                        url += separator + formData; // Thêm dữ liệu vào URL
                    }
                }

                // Gửi AJAX request với URL mới
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#productList').html(response.html); // Cập nhật danh sách sản phẩm

                        // Cập nhật URL
                        window.history.pushState(null, '', url);

                        // Cập nhật trạng thái cho các nút số trang
                        $('.pagination li').removeClass(
                            'active'); // Xóa lớp active khỏi tất cả các nút số trang
                        var currentPage = new URL(url).searchParams.get('page') || 1;
                        // Lấy số trang hiện tại từ URL
                        $('.pagination a[data-url*="page=' + currentPage + '"]').closest('li')
                            .addClass('active');
                        // Thêm lớp active vào nút hiện tại

                        // Cập nhật các nút Next và Previous
                        $('.prev').data('url', response.prevUrl);
                        // Cập nhật URL cho nút Previous
                        $('.next').data('url', response.nextUrl);
                        // Cập nhật URL cho nút Next

                        // Cập nhật href cho các nút
                        $('.prev a').attr('href', response.prevUrl);
                        $('.next a').attr('href', response.nextUrl);

                        // Cập nhật các nút số trang
                        $('.pagination .page-link').each(function() {
                            var pageUrl = $(this).data('url');
                            $(this).attr('href', pageUrl);
                        });
                    },
                    error: function(xhr) {
                        console.log('Có lỗi xảy ra:', xhr.responseText);
                    }
                });
            });
        });


        window.addEventListener('popstate', function() {
            // Gửi lại yêu cầu AJAX với URL hiện tại
            $.ajax({
                url: window.location.href,
                type: 'GET',
                success: function(response) {
                    $('#productList').html(response.html); // Cập nhật lại danh sách sản phẩm
                    // Đảm bảo rằng dropdown giữ giá trị đã chọn
                    var selectedValue = new URLSearchParams(window.location.search).get('orderby');
                    $('#orderby').val(selectedValue); // Cập nhật giá trị cho dropdown

                    // Cập nhật trạng thái cho các nút số trang
                    var currentPage = new URL(window.location.href).searchParams.get('page') ||
                    1; // Lấy số trang hiện tại
                    $('.pagination li').removeClass(
                    'active'); // Xóa lớp active khỏi tất cả các nút số trang
                    $('.pagination a[data-url*="page=' + currentPage + '"]').closest('li').addClass(
                        'active'); // Thêm lớp active vào nút hiện tại
                },
                error: function(xhr) {
                    console.log('Có lỗi xảy ra:', xhr.responseText);
                }
            });
        });
    </script>
@endsection
