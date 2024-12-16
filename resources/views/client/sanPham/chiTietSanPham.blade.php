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
                                    <div class="swiper-slide">
                                        <img src="{{Storage::url($item->hinh_anh)}}" alt="">
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
                        <h3 id="tenSanPhamChiTiet">{{$san_pham->ten_san_pham}}</h3>
                        @php
                            $gia_khuyen_mai = $san_pham->gia_san_pham - ($san_pham->gia_san_pham * $san_pham->khuyen_mai / 100);
                        @endphp
                        <p id="giaKhuyenMai" data-giaKM="{{$gia_khuyen_mai}}">{{ number_format($gia_khuyen_mai, 0, ',', '.') }}đ
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
                                        <input type="hidden" id="size" value="">
                                        @foreach ($kich_cos as $item)
                                            @php
                                                // Kiểm tra nếu có biến thể với kích cỡ này
                                                $kichCoTonTai = $san_pham->bienThes->contains('kich_co', $item->kich_co);
                                            @endphp
                                            @if ($kichCoTonTai)
                                                <li data-size="{{ $item->kich_co }}">
                                                    <a href="javascript:void(0);">{{ $item->kich_co }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h5>Màu sắc:</h5>
                            <div class="color-box">
                                <ul id="selectMauSac">
                                    <input type="hidden" id="mauSac" value="">
                                    @foreach ($san_pham->bienThes->unique('ma_mau') as $item)
                                        <li data-color="{{$item->ma_mau}}" style="background-color: {{$item->ma_mau}}; border: 1px solid #0000003b;" title="{{ $item->ten_mau }}"></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <p class="text-danger" id="errSelect">Vui lòng chọn phân loại hàng !</p>
                        <input class="tokenThemGioHang" type="hidden"  name="_token" value="{{ csrf_token() }}" />
                        <div class="quantity-box d-flex align-items-center gap-3">
                            <div class="quantity">
                                <button class="minus" type="button" disabled> <i class="fa-solid fa-minus" ></i> </button>
                                <input type="hidden" id="soLuong" value="1">
                                <input type="number" value="1" min="1" readonly>
                                <button class="plus" type="button" disabled> <i class="fa-solid fa-plus"></i> </button>
                            </div>
                            <div class="d-flex align-items-center gap-3 w-100 btn-mua-hang">
                                    <a id="themGioHang" class="btn btn_black sm" href="javascript:void(0);"
                                    data-id="{{$san_pham->id}}">Thêm giỏ hàng</a>
                                    <a class="btn btn_outline sm" id="muaNgay" href="javascript:void(0)">Mua ngay</a>
                            </div>
                        </div>
                        <p class="text-danger" id="errSL">Vui lòng xóa bớt số lượng sản phẩm này trong giỏ hàng để tiếp tục thêm !</p>

                        <div class="buy-box border-buttom">
                            <ul>
                                <li class="wishlist-chi-tiet" data-wishlistIdSanPham="{{$san_pham->id}}">
                                    @if ($san_pham->yeuThich->isNotEmpty())
                                        <a class='text-danger'> <i class='fa-regular fa-heart me-2 text-danger'></i>Xóa khỏi yêu thích</a>
                                    @else
                                        <a> <i class="fa-regular fa-heart me-2"></i>Thêm vào yêu thích</a>
                                    @endif
                                </li>
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
                                        <p id="soLuongTon" data-quantityOld="{{$san_pham->bienThes->sum('so_luong')>0?$san_pham->bienThes->sum('so_luong'):'Tạm thời hết hàng'}}"  data-id="{{$san_pham->id}}">{{$san_pham->bienThes->sum('so_luong')>0?$san_pham->bienThes->sum('so_luong'):'Tạm thời hết hàng'}}</p>
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

                        {{-- Đánh giá --}}
                        <div class="tab-pane fade" id="Reviews-tab-pane" role="tabpanel" data-spid="{{$san_pham->id}}"
                            aria-labelledby="Reviews-tab" tabindex="0">
                            <div class="row gy-4">
                                @if ($danh_gias->count()>0)
                                    <div class="col-lg-12">
                                        <div class="review-header">
                                            <h5 class="review-title">ĐÁNH GIÁ SẢN PHẨM</h5>
                                            <div class="select-button">
                                                <div class="box-star">
                                                    <p class=""><span>{{ number_format($avg_rating, 1) }}</span> trên 5</p>
                                                    <ul class="rating p-0 mb">
                                                        {{-- Hiển thị sao đầy --}}
                                                        @for ($i = 0; $i < $full_stars; $i++)
                                                            <li><i class="fa-solid fa-star"></i></li>
                                                        @endfor

                                                        {{-- Hiển thị sao nửa nếu có --}}
                                                        @if ($half_star)
                                                            <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                                        @endif

                                                        {{-- Hiển thị sao rỗng --}}
                                                        @for ($i = 0; $i < $empty_stars; $i++)
                                                            <li><i class="fa-regular fa-star"></i></li>
                                                        @endfor
                                                    </ul>
                                                </div>
                                                <div class="box-button">
                                                    <button class="btn active" data-filter="all">Tất Cả</button>
                                                    <button class="btn" data-filter="5">5 Sao ({{ $saoCounts[5] ?? 0 }})</button>
                                                    <button class="btn" data-filter="4">4 Sao ({{ $saoCounts[4] ?? 0 }})</button>
                                                    <button class="btn" data-filter="3">3 Sao ({{ $saoCounts[3] ?? 0 }})</button>
                                                    <button class="btn" data-filter="2">2 Sao ({{ $saoCounts[2] ?? 0 }})</button>
                                                    <button class="btn" data-filter="1">1 Sao ({{ $saoCounts[1] ?? 0 }})</button>
                                                    <button class="btn mt-3" data-filter="comment">Có Bình Luận ({{ $coBinhLuan }})</button>
                                                    <button class="btn mt-3" data-filter="image">Có Hình ảnh ({{ $coHinhAnh }})</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="review-content">
                                            @foreach ($danh_gias as $key => $item)
                                                @php
                                                    $email = $item->user->email;
                                                    $tachEmail = strlen($email) > 6
                                                        ? substr($email, 0, 4) . '******' . substr($email, strpos($email, '@') - 2, 2) . substr($email, strpos($email, '@'))
                                                        : $email;
                                                    $ratingStars = str_repeat('<li><i class="fa-solid fa-star"></i></li>', $item->so_sao) .
                                                                    str_repeat('<li><i class="fa-regular fa-star"></i></li>', 5 - $item->so_sao);
                                                @endphp
                                                <div class="review-item">
                                                    <div class="avt-user">
                                                        <img src="{{asset('assets/images/user/12.jpg')}}" alt="">
                                                    </div>
                                                    <div class="thong-tin">
                                                        <span class="user-name">{{$item->user->ho_va_ten?$item->user->ho_va_ten:$tachEmail}}</span>
                                                        <ul class="rating mt-1">
                                                            {!! $ratingStars !!}
                                                        </ul>
                                                        <div class="date">{{$item->created_at}}</div>
                                                        <div class="noi-dung">
                                                            <p class="noi-dung-text">{{$item->noi_dung}}</p>
                                                            <div class="noi-dung-img">
                                                                @foreach ($item->anhDanhGias as $anh)
                                                                    <img src="{{Storage::url($anh->hinh_anh)}}">
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        @if ($arrTraLoiDanhGia[$item->id])
                                                            <div class="phan-hoi mt-3">
                                                                <p>Phản hồi từ shop</p>
                                                                <div class="noi-dung-phan-hoi mt-2">
                                                                    <span>{{$arrTraLoiDanhGia[$item->id]->noi_dung}}</span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <h5 class="review-title">CHƯA CÓ ĐÁNH GIÁ</h5>
                                @endif
                            </div>
                            @if ($danh_gias->count()>0)
                            <div class="pagination-wrap">
                                <ul class="pagination">
                                    {{-- Nút "Trước" --}}
                                    <li class="{{ $danh_gias->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="prev" href="javascript:void(0);" data-page="{{ $danh_gias->currentPage() - 1 }}">
                                            <i class="iconsax" data-icon="chevron-left"></i>
                                        </a>
                                    </li>

                                    {{-- Hiển thị số trang --}}
                                    @for ($i = 1; $i <= $danh_gias->lastPage(); $i++)
                                        <li>
                                            <a class="{{ $i == $danh_gias->currentPage() ? 'active' : '' }}"
                                            href="javascript:void(0);" data-page="{{ $i }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    {{-- Nút "Tiếp" --}}
                                    <li class="{{ $danh_gias->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="next" href="javascript:void(0);" data-page="{{ $danh_gias->currentPage() + 1 }}">
                                            <i class="iconsax" data-icon="chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            @endif

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
                        @php
                            $isWishlist = $item->yeuThich->isNotEmpty(); // Kiểm tra trạng thái yêu thích
                        @endphp
                        <div class="swiper-slide">
                            <div class="product-box-3">
                                <div class="img-wrapper">
                                    <div class="label-block">
                                        <a class="label-2 wishlist-icon" style="background-color: {{ $isWishlist ? '#e67e22' : 'rgba(255,255,255,1)' }}"
                                                    tabindex="0" data-wishlistIdSanPham="{{ $item->id }}">
                                            <i class="iconsax" data-icon="heart" style="--Iconsax-Color: {{ $isWishlist ? '#fff' : 'rgba(38,40,52,1)' }}"
                                            aria-hidden="true" data-bs-toggle="tooltip"></i>
                                        </a>
                                    </div>
                                    <div class="product-image style-border">
                                        <a class="pro-first" href="{{route('san-pham.chi-tiet-san-pham',$item->id)}}">
                                            <img class="bg-img" src="{{Storage::url($item->hinh_anh)}}" alt="Sản phẩm">
                                        </a>
                                        <a class="pro-sec" href="{{route('san-pham.chi-tiet-san-pham',$item->id)}}">
                                            <img class="bg-img" src="{{Storage::url($item->bienThes->first()->hinh_anh)}}" alt="Sản phẩm">
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
@section('js')
<script src="{{asset('assets/js/touchspin.js')}}"></script>
@endsection
