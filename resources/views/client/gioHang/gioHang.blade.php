@extends('client.layout.main')
@section('container')
<section class="section-b-space pt-0">
    <div class="heading-banner">
        <div class="custom-container container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Giỏ hàng</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-b-space pt-0">
    <div class="custom-container container">
        <div class="row g-4">
            <div class="col-12">
                <div class="cart-countdown" style="display: none;">
                    <img src="{{asset('assets/images/gif/fire-2.gif')}}" alt="">
                    <h6>Xin hãy nhanh chân! Có người đã đặt hàng một trong những mặt hàng bạn có trong giỏ hàng.</h6>
                </div>
            </div>
            <div class="col-xxl-12 col-xl-12 gioHangFull">
                <div class="cart-table">
                    <div class="table-title">
                        <h5></h5>
                        <p style="display: none;">
                            <input type="checkbox" name="selectAll[]" value="">
                            <button id="selectAll">Chọn tất cả (<span>{{count($gio_hangs)}}</span>)</button>
                            <button id="clearAllButton">Xóa</button>
                        </p>
                    </div>
                    <div class="table-responsive theme-scrollbar">
                        <table class="table" id="cart-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Sản phẩm </th>
                                    <th>Giá </th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $tong_tien = 0;
                                    $tiet_kiem = 0;
                                @endphp
                                @foreach ($gio_hangs as $item)
                                    @php
                                        $sanPham = $item->sanPham;
                                        $gia_khuyen_mai = $sanPham->gia_san_pham - ($sanPham->gia_san_pham * $sanPham->khuyen_mai / 100);
                                        $thanh_tien = $gia_khuyen_mai * $item->so_luong;
                                        $tong_tien += $thanh_tien;
                                        $tiet_kiem += (($sanPham->gia_san_pham * $item->so_luong) - $thanh_tien);
                                    @endphp
                                    <tr>
                                        <td><input type="checkbox" name="select[]" data-id="{{ $item->id }}" value="{{ $item->id }}"></td>
                                        <td>
                                            <div class="cart-box">
                                                <a class="style-border" href="{{ route('san-pham.chi-tiet-san-pham', $sanPham->id) }}">
                                                    <img src="{{ Storage::url($sanPham->hinh_anh) }}" alt="">
                                                </a>
                                                <div>
                                                    <a href="{{ route('san-pham.chi-tiet-san-pham', $sanPham->id) }}">
                                                        <h5>{{ Str::limit(strip_tags($sanPham->ten_san_pham), 22, '...') }}</h5>
                                                    </a>
                                                    <p>Phân loại hàng:
                                                        <span class="phanLoaiHang">{{ $item->bienThe->kich_co }}, {{ $item->bienThe->ten_mau }}</span>.
                                                        <span data-idsp="{{ $sanPham->id }}" class="thayDoi">Thay đổi</span>
                                                    </p>
                                                </div>
                                            </div>
                                            {{-- popup thông báo thay đổi biến thể --}}
                                            <div class="thayDoiBienThe">
                                                <div class="bodyThayDoi">
                                                    <div>
                                                        <h5>Kích cỡ:</h5>
                                                        <div class="sizeBox">
                                                            <ul class="thayDoiSize">
                                                                @foreach ($kich_cos as $itemKichCo)
                                                                    @php
                                                                        // Kiểm tra nếu kích cỡ này có trong các biến thể
                                                                        $kichCoTonTai = $sanPham->bienThes->contains('kich_co', $itemKichCo->kich_co);
                                                                    @endphp
                                                                    @if ($kichCoTonTai)
                                                                        <li class="{{$item->bienThe->kich_co===$itemKichCo->kich_co?'active':''}}"
                                                                            data-size="{{ $itemKichCo->kich_co }}">
                                                                            <a href="javascript:void(0);">{{ $itemKichCo->kich_co }}</a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h5>Màu sắc:</h5>
                                                        <div class="colorBox">
                                                            <ul class="thayDoiMauSac">
                                                                @foreach ($sanPham->bienThes->unique('ma_mau') as $itemMauSac)
                                                                    <li class="{{$item->bienThe->ma_mau===$itemMauSac->ma_mau?'active':''}}" data-color="{{ $itemMauSac->ma_mau }}" style="background-color: {{ $itemMauSac->ma_mau }};" title="{{ $itemMauSac->ten_mau }}"></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="btnThayDoi">
                                                        <button class="btn btn-light">Trở lại</button>
                                                        <button class="btn btn-danger">Xác nhận</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ number_format($gia_khuyen_mai, 0, ',', '.') }}đ</td>
                                        <td>
                                            <div class="quantity">
                                                <button class="minus" type="button">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                                <input type="hidden" data-thanhTien="{{ $thanh_tien }}" data-giaKM="{{ $gia_khuyen_mai }}" data-id="{{ $item->id }}" class="soLuong" value="1">
                                                <input type="number" data-max="{{ $item->bienThe->so_luong }}" value="{{ $item->so_luong }}" min="1" readonly>
                                                <button class="plus" type="button">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="tdThanhTien">{{ number_format($thanh_tien, 0, ',', '.') }}đ</td>
                                        <td>
                                            <a data-id="{{ $item->id }}" class="deleteButton" href="javascript:void(0)"> <i class="iconsax" data-icon="trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="no-data" id="data-show" style="display: {{count($gio_hangs)==0?'block':'none'}}"><img src="{{asset('assets/images/cart/1.gif')}}" alt="">
                        <h4>Bạn không có sản phẩm nào trong giỏ hàng!</h4>
                        <p>Hôm nay là ngày tuyệt vời để mua những thứ bạn đã giữ! hoặc <a href="{{route('san-pham.san-pham')}}">Tiếp tục mua</a></p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 gioHangTiepTuc" style="display: none">
                <div class="cart-items">
                    <div class="cart-body">
                        <h6>Chi tiết đơn hàng (<span>{{count($gio_hangs)}}</span> sản phẩm) </h6>
                        <ul>
                            <li>
                                <p>Tổng thanh toán </p><span data-tongTien="{{$tong_tien}}" id="tongTienGioHang">{{ number_format($tong_tien, 0, ',', '.') }}đ </span>
                            </li>
                            <li>
                                <p>Tiết kiệm được </p><span id="tietKiemGioHang" class="theme-color">{{ number_format($tiet_kiem, 0, ',', '.') }}đ </span>
                            </li>
                        </ul>
                    </div>
                    <input type="hidden" class="tokenTiepTuc" name="_token" value="{{ csrf_token() }}" />
                    <button class="btn btn_black w-100 rounded sm check-url" id="tiepTucDatHangBtn">Tiếp tục</button>
                </div>
            </div>
            <div class="col-12" style="margin-top: 100px">
                <div class="cart-slider">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <h6>Để có sự thay đổi hợp thời trang và hiện đại, đặc biệt là trong mùa giao mùa.</h6>
                            <p> <img class="me-2" src="../assets/images/gif/fire-2.gif" alt="">Bạn có thể xem các sản phẩm mới ra mắt dưới đây</p>
                        </div><a class="btn btn_outline sm rounded" href="{{route('san-pham.san-pham')}}">Xem tất cả</a>
                    </div>
                    <div class="swiper cart-slider-box">
                        <div class="swiper-wrapper">
                            @foreach ($san_pham_moi_nhat as $item)
                                <div class="swiper-slide">
                                    <div class="cart-box">
                                        <a href="{{route('san-pham.chi-tiet-san-pham',$item->id)}}">
                                            <img class="style-border" src="{{Storage::url($item->hinh_anh)}}" alt="err">
                                        </a>
                                        <div> <a href="{{route('san-pham.chi-tiet-san-pham',$item->id)}}">
                                                <h5>{{$item->ten_san_pham}}</h5>
                                            </a>
                                            <div class="color-box">
                                                <ul class="color-variant">
                                                    {{-- bien the mau sac --}}
                                                    @foreach ($item->bienThes->unique('ma_mau')->take(4) as $mau_sac)
                                                        <li
                                                            style="background-color: {{ $mau_sac->ma_mau }}; border: 1px solid #0000003b;
                                                            width: 15px; height: 15px; border-radius: 50%"
                                                        >
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                {{-- danh gia --}}
                                                @php
                                                    $avg_rating = $item->danhGias->avg('so_sao');
                                                @endphp

                                                <span>
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    @if ($avg_rating > 0)
                                                        {{ $avg_rating ? number_format($avg_rating, 1) : '' }}
                                                    @else
                                                        (Chưa có đánh giá)
                                                    @endif
                                                </span>
                                            </div>
                                            @php
                                                $gia_khuyen_mai = $item->gia_san_pham - ($item->gia_san_pham * $item->khuyen_mai) / 100;
                                            @endphp
                                            <p>
                                                {{ number_format($gia_khuyen_mai, 0, ',', '.') }}đ
                                                <del>{{ number_format($item->gia_san_pham, 0, ',', '.') }}đ</del>
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
</section>
@endsection
@section('js')
<script src="{{asset('assets/js/cart.js')}}"></script>
@endsection
