@extends('client.layout.main')
@section('container')
<section class="section-b-space pt-0">
    <div class="heading-banner">
        <div class="custom-container container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Danh sách sản phẩm yêu thích</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-b-space pt-0">
    <div class="custom-container container wishlist-box">
        <div class="product-tab-content ratio1_3">
            <div class="row-cols-xl-4 row-cols-md-3 row-cols-2 grid-section view-option row gy-4 g-xl-4">
                @foreach ($yeu_thichs as $item)
                    <div class="col">
                        <div class="product-box-3 product-wishlist">
                            <div class="img-wrapper">
                                <div class="label-block">
                                    <a class="label-2 delete-button deleteYeuThich" data-id="{{$item->id}}" title="Xóa khỏi yêu thích" tabindex="0">
                                        <i class="iconsax" data-icon="trash" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="product-image">
                                    <a class="style-border" href="{{route('san-pham.chi-tiet-san-pham',$item->san_pham_id)}}">
                                        <img class="bg-img" src="{{Storage::url($item->sanPham->hinh_anh)}}" alt="err">
                                    </a>
                                </div>
                            </div>
                            <div class="product-detail">
                                <ul class="rating">
                                    <li>
                                        @php
                                            $avg_rating = $item->sanPham->danhGias->avg('so_sao') ?? 0;

                                            $full_stars = floor($avg_rating);
                                            $half_star = $avg_rating - $full_stars >= 0.5 ? 1 : 0;
                                            $empty_stars = 5 - ($full_stars + $half_star);
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
                                    <li>
                                        ({{ $avg_rating > 0 ? number_format($avg_rating, 1) : 'Chưa có đánh giá' }})
                                    </li>
                                </ul>
                                <a href="{{route('san-pham.chi-tiet-san-pham',$item->san_pham_id)}}">
                                    <h6>{{$item->sanPham->ten_san_pham}}</h6>
                                </a>
                                @php
                                    $gia_khuyen_mai = $item->sanPham->gia_san_pham - ($item->sanPham->gia_san_pham * $item->sanPham->khuyen_mai) / 100;
                                @endphp
                                <p>
                                    {{ number_format($gia_khuyen_mai, 0, ',', '.') }}đ
                                    @if ($item->sanPham->khuyen_mai > 0)
                                        <del>{{ number_format($item->sanPham->gia_san_pham, 0, ',', '.') }}đ</del>
                                        <span>-{{$item->sanPham->khuyen_mai}}%</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="no-data" id="data-show" style="display: {{count($yeu_thichs)==0?'block':'none'}}">
                <img src="{{asset('assets/images/cart/1.gif')}}" alt="">
                <h4>Bạn không có sản phẩm yêu thích nào trong danh sách!</h4>
                <p>Hôm nay là ngày tuyệt vời để mua những thứ bạn đã giữ! hoặc đi đến trang
                    <a href="{{route('san-pham.san-pham')}}" style="color: #e67e22">Sản phẩm</a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
