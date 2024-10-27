@extends('client.layout.main')
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
                                                        ({{ $count_sp_danh_muc[$item->id] ?? 0 }})</a></li>
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
                                <form id="formFilter" action="{{ route('san-pham.filter') }}" method="get">
                                    <div class="category-dropdown">
                                        <label for="orderby">Sắp xếp theo :</label>
                                        <select class="form-select" id="orderby" name="orderby">
                                            <option value="">Mặc định</option>
                                            <option value="best-selling">Bán chạy nhất</option>
                                            <option value="a-z">Theo thứ tự, A-Z</option>
                                            <option value="price-high-low">Giá cao - thấp</option>
                                            <option value="discount-high-low">Giảm giá % từ cao - thấp</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="product-tab-content ratio1_3">
                            <div id="productList" class="row-cols-lg-4 row-cols-md-3 row-cols-2 grid-section view-option row g-3 g-xl-4">
                                @foreach ($san_phams as $item)
                                    <div>
                                        <div class="product-box-3">
                                            <div class="img-wrapper">
                                                <div class="label-block">
                                                    <a class="label-2 wishlist-icon" href="javascript:void(0)"
                                                        tabindex="0">
                                                        <i class="iconsax" data-icon="heart" aria-hidden="true"
                                                            data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i>
                                                    </a>
                                                </div>
                                                <div class="product-image style-border">
                                                    <a class="pro-first"
                                                        href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}">
                                                        <img class="bg-img" src="{{ Storage::url($item->hinh_anh) }}"
                                                            alt="Sản phẩm">
                                                    </a>
                                                    <a class="pro-sec"
                                                        href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}">
                                                        <img class="bg-img"
                                                            src="{{ Storage::url($item->bienThes->first()->hinh_anh) }}"
                                                            alt="Sản phẩm">
                                                    </a>
                                                </div>
                                                <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#addtocart" tabindex="0"><i class="iconsax"
                                                            data-icon="basket-2" aria-hidden="true"
                                                            data-bs-toggle="tooltip" data-bs-title="Add to card">
                                                        </i></a><a href="compare.html" tabindex="0"><i class="iconsax"
                                                            data-icon="arrow-up-down" aria-hidden="true"
                                                            data-bs-toggle="tooltip" data-bs-title="Compare"></i></a><a
                                                        href="#" data-bs-toggle="modal"
                                                        data-bs-target="#quick-view" tabindex="0"><i class="iconsax"
                                                            data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip"
                                                            data-bs-title="Quick View"></i></a>
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
                                {{ $san_phams->links() }}
                                {{-- <li> <a class="prev" href="#"><i class="iconsax" data-icon="chevron-left"></i></a></li>
                            <li> <a href="#">1</a></li>
                            <li> <a class="active" href="#">2</a></li>
                            <li> <a href="#">3 </a></li>
                            <li> <a class="next" href="#"> <i class="iconsax" data-icon="chevron-right"></i></a>
                            </li> --}}
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
        $(function (){
            $('#orderby').change(function (){
                $('#formFilter').submit();
            })
        })
    </script>
@endsection
