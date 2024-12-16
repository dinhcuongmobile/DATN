@extends('client.layout.main')
@section('container')
<section class="section-b-space pt-0">
    <div class="heading-banner">
        <div class="custom-container container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Chi tiết thanh toán</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-b-space pt-0">
    <div class="custom-container container">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success" id="error-alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" id="error-alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="col-xxl-8 col-lg-7">
                <div class="left-sidebar-checkout sticky">
                    <div class="address-option">
                        <div class="address-title">
                            <h4>Địa chỉ giao hàng </h4>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#add-address-checkout" tabindex="0">+ Thêm địa chỉ mới</a>
                        </div>
                        <div class="row dia-chi-item">
                            @foreach ($dia_chis as $item)
                            <div class="col-xxl-4" style="width: 100%">
                                <label for="address-billing-0">
                                    <span class="delivery-address-box">
                                        <span class="form-check">
                                            <input class="custom-radio" id="address-billing-0" type="radio" data-maQuanHuyen="{{$item->ma_quan_huyen}}"
                                             {{$item->trang_thai==1?'checked':''}} name="selectDiaChi" data-id="{{$item->id}}">
                                        </span>
                                        <span class="address-detail">
                                            <span class="address">
                                                <span class="address-title">{{$item->ho_va_ten_nhan}} </span>
                                            </span>
                                            <span class="address">
                                                <span class="address-home">
                                                    <span class="address-tag">Liên hệ :</span><span style="font-size: 18px">{{$item->so_dien_thoai_nhan}}</span>
                                                </span>
                                            </span>
                                            <span class="address">
                                                <span class="address-home">
                                                    <span class="address-tag"> Địa chỉ:</span>
                                                    <span style="font-size: 18px">
                                                        @if ($item->dia_chi_chi_tiet)
                                                            {{ $item->dia_chi_chi_tiet }},
                                                        @endif
                                                        {{$item->phuongXa->ten_phuong_xa}},
                                                        {{$item->quanHuyen->ten_quan_huyen}},
                                                        {{$item->tinhThanhPho->ten_tinh_thanh_pho}}
                                                    </span>
                                                </span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="payment-options">
                        <h4 class="mb-3">Phương thức thanh toán</h4>
                        <div class="row gy-3">
                            <div class="col-sm-6">
                                <div class="payment-box">
                                    <input class="custom-radio me-2" id="cod" type="radio" checked name="phuong_thuc_thanh_toan" value="0">
                                    <label for="cod">Thanh toán khi nhận hàng</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="payment-box">
                                    <input class="custom-radio me-2" id="paypal" type="radio" name="phuong_thuc_thanh_toan" value="1">
                                    <label for="paypal">Chuyển khoản</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-lg-5">
                <div class="right-sidebar-checkout">
                    <h4>Sản phẩm</h4>
                    <div class="cart-listing">
                        <ul>
                            @php
                                $tong_tien = 0;
                                $tiet_kiem = 0;
                            @endphp
                            @foreach ($gio_hangs as $item)
                                @php
                                    $sanPham = $item['san_pham'];
                                    $gia_khuyen_mai = $item['gia_khuyen_mai'];
                                    $thanh_tien = $gia_khuyen_mai * $item['so_luong'];
                                    $tong_tien += $thanh_tien;
                                    $tiet_kiem += (($sanPham->gia_san_pham * $item['so_luong']) - $thanh_tien);
                                @endphp
                                <li>
                                    <img width="60px" src="{{ Storage::url($sanPham->hinh_anh) }}" alt="{{ $sanPham->ten_san_pham }}">
                                    <div>
                                        <h6>{{ Str::limit(strip_tags($sanPham->ten_san_pham), 20, '...') }}</h6>
                                        <span>{{ $item['bien_the']->kich_co }}, {{ $item['bien_the']->ten_mau }}</span>
                                    </div>
                                    <p>x{{ $item['so_luong'] }}</p>
                                    <p>{{ number_format($gia_khuyen_mai, 0, ',', '.') }}đ</p>
                                </li>
                            @endforeach
                        </ul>
                        <div class="summary-total">
                            <ul>
                                <li>
                                    <p>Tổng số tiền ({{$count_gio_hang?$count_gio_hang:0}} sản phẩm)</p><span class="thanhTien">{{ number_format($tong_tien, 0, ',', '.') }}đ</span>
                                </li>
                                <li>
                                    <p>Phí vận chuyển</p><span id="tienPhiShip">{{ $phi_ship_goc ? (number_format($phi_ship_goc->phi_ship, 0, ',', '.')): "0" }}đ</span>
                                </li>
                                <li>
                                    <p>Chọn mã giảm giá</p><a id="chon-voucher" href="javascript:void(0)" style="color: #05a">Chọn mã</a>
                                </li>
                                <li class="divTongCoin" style="display: {{$tongCoin>0?"flex":"none"}}">
                                    <p>Sử dụng xu (<span class="tongCoin">{{$tongCoin}}</span> xu)</p>
                                    <div class="toggle-button">
                                        <div class="toggle-circle"></div>
                                    </div>
                                </li>
                                <li>
                                    <p>Giảm giá vận chuyển</p><span class="giamTienVanChuyen">0đ</span>
                                </li>
                                <li>
                                    <p>Giảm giá đơn hàng</p><span class="giamTienDonHang">0đ</span>
                                </li>
                            </ul>
                            <div class="ghi-chu mt-3">
                                <p>Lời nhắn: </p>
                                <input class="form-control" type="text" placeholder="Gửi lời nhắn đến shop...">
                            </div>
                        </div>
                        <div class="total">
                            <h6>Tổng tiền hàng : </h6>
                            <h6 class="textColor tongTienHang">{{ number_format($tong_tien, 0, ',', '.') }}đ</h6>
                        </div>
                        <div class="total">
                            <h6>Tổng tiền phí vận chuyển : </h6>
                            <h6 class="textColor tongPhiVanChuyen">{{ $phi_ship_goc ? (number_format($phi_ship_goc->phi_ship, 0, ',', '.')): "0" }}đ</h6>
                        </div>
                        <div class="total">
                            @php
                                $phi_ship = $phi_ship_goc ? $phi_ship_goc->phi_ship : 0;
                                $tong_thanh_toan = $tong_tien + $phi_ship;
                            @endphp
                            <h6>Tổng thanh toán : </h6>
                            <h6 class="textColor tongThanhToan">{{ number_format($tong_thanh_toan, 0, ',', '.') }}đ</h6>
                        </div>
                        <input type="hidden" class="tokenDatHang" name="_token" value="{{ csrf_token() }}" />
                        <div class="order-button btn btn_black sm w-100 rounded">Đặt hàng</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- popup chọn voucher chi tiết thanh toán  --}}
    <div class="modal theme-modal fade" id="popup-voucher" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header">
                        <h4>Chọn voucher của shop</h4>
                    </div>
                    <div class="card-body">
                        <div class="free-ship">
                            <p class="titleGiamGia">Mã miễn phí vận chuyển</p>
                            @foreach ($ma_giam_gia_van_chuyen as $item)
                                @php
                                    $ngayBatDau = \Carbon\Carbon::parse($item->ngay_bat_dau);
                                    $ngayKetThuc = \Carbon\Carbon::parse($item->ngay_ket_thuc);
                                    $ngayHienTai = now();
                                    $gioRaMat = $ngayHienTai->diffInSeconds($ngayBatDau, false);
                                    $tongGiayConLai = $ngayHienTai->diffInSeconds($ngayKetThuc, false);
                                    // Tính giờ, phút, giây còn lại
                                    $gioConLai = floor($tongGiayConLai / 3600);
                                    $phutConLai = floor(($tongGiayConLai % 3600) / 60);
                                    $giayConLai = $tongGiayConLai % 60;
                                @endphp
                                @if ($giayConLai>0 && $gioRaMat<0)
                                    <div class="voucher-item">
                                        <div class="img-item">
                                            <img src="{{asset('assets/images/cart/nen-free-ship.jpg')}}" alt="" width="120px">
                                        </div>
                                        <div class="item-content">
                                            <div class="text-content">
                                                <p>Giảm tối đa <span class="textColor">{{ number_format($item->so_tien_giam, 0, ',', '.') }}đ</span></p>
                                                <p>Đơn tối thiểu <span class="textColor">{{ number_format($item->gia_tri_toi_thieu, 0, ',', '.') }}đ</span></p>
                                                @if ($tongGiayConLai > 0 && $tongGiayConLai <= 86400)
                                                    <p>Sắp hết hạn: <span>còn <span id="hours">0{{ $gioConLai }}</span> : <span id="minutes">{{ $phutConLai }}</span> : <span id="seconds">{{ $giayConLai }}</span></span></p>
                                                @elseif ($tongGiayConLai > 86400)
                                                    <p>HSD: <span>{{$item->ngay_ket_thuc}}</span></p>
                                                @endif
                                                @if ($tong_tien < $item->gia_tri_toi_thieu)
                                                    <p class="tien">Giá trị đơn hàng chưa đủ.</p>
                                                @endif
                                            </div>
                                            <div class="radio-container">
                                                @if ($tong_tien >= $item->gia_tri_toi_thieu)
                                                    <input type="radio" name="ma_giam_gia_van_chuyen" value="{{$item->id}}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="free-order mt-4">
                            <p class="titleGiamGia">Mã giảm giá đơn hàng</p>
                                @foreach ($ma_giam_gia_don_hang as $item)
                                    @php
                                    $ngayBatDau = \Carbon\Carbon::parse($item->ngay_bat_dau);
                                    $ngayKetThuc = \Carbon\Carbon::parse($item->ngay_ket_thuc);
                                    $ngayHienTai = now();
                                    $gioRaMat = $ngayHienTai->diffInSeconds($ngayBatDau, false);
                                    $tongGiayConLai = $ngayHienTai->diffInSeconds($ngayKetThuc, false);
                                    // Tính giờ, phút, giây còn lại
                                    $gioConLai = floor($tongGiayConLai / 3600);
                                    $phutConLai = floor(($tongGiayConLai % 3600) / 60);
                                    $giayConLai = $tongGiayConLai % 60;
                                @endphp
                                @if ($giayConLai>0 && $gioRaMat<0)
                                    <div class="voucher-item">
                                        <div class="img-item">
                                            <img src="{{asset('assets/images/cart/nen-free-order.jpg')}}" alt="" width="120px">
                                        </div>
                                        <div class="item-content">
                                            <div class="text-content">
                                                <p>Giảm tối đa <span class="textColor">{{ number_format($item->so_tien_giam, 0, ',', '.') }}đ</span></p>
                                                <p>Đơn tối thiểu <span class="textColor">{{ number_format($item->gia_tri_toi_thieu, 0, ',', '.') }}đ</span></p>
                                                @if ($tongGiayConLai > 0 && $tongGiayConLai <= 86400)
                                                    <p>Sắp hết hạn: <span>còn <span id="hours">0{{ $gioConLai }}</span> : <span id="minutes">{{ $phutConLai }}</span> : <span id="seconds">{{ $giayConLai }}</span></span></p>
                                                @elseif ($tongGiayConLai > 86400)
                                                    <p>HSD: <span>{{$item->ngay_ket_thuc}}</span></p>
                                                @endif
                                                @if ($tong_tien < $item->gia_tri_toi_thieu)
                                                    <p class="tien">Giá trị đơn hàng chưa đủ.</p>
                                                @endif
                                            </div>
                                            <div class="radio-container">
                                                @if ($tong_tien >= $item->gia_tri_toi_thieu)
                                                    <input type="radio" name="ma_giam_gia_don_hang" value="{{$item->id}}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btnQuayLai">Quay lại</button>
                        <Button class="btnXacNhan" disabled>Xác nhận</Button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Nhập địa chỉ mới --}}
    <div class="reviews-modal modal theme-modal fade" id="add-address-checkout" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Địa chỉ mới</h4><button class="btn-close" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="themDiaChiMoiCheckOut" action="{{ route('tai-khoan.them-dia-chi-moi') }}"
                        method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="from-group">
                                    <label class="form-label">Họ và tên</label>
                                    <input class="form-control @error('ho_va_ten_nhan') is-invalid @enderror"
                                        type="text" name="ho_va_ten" placeholder="Nhập họ và tên..."
                                        value="">
                                </div>
                                <p class="Err text-danger ho_va_ten-error-dia-chi">
                                    @error('ho_va_ten')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="col-6">
                                <div class="from-group">
                                    <label class="form-label">Số điện thoại</label>
                                    <input class="form-control @error('so_dien_thoai_nhan') is-invalid @enderror"
                                        type="text" name="so_dien_thoai" placeholder="Nhập số điện thoại."
                                        value="">
                                </div>
                                <p class="Err text-danger so_dien_thoai-error-dia-chi">
                                    @error('so_dien_thoai')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="them_tinh_thanh_pho">Chọn Tỉnh/Thành phố</label>
                                <select class="form-select @error('them_tinh_thanh_pho') is-invalid @enderror"
                                    id="them_tinh_thanh_pho" name="tinh_thanh_pho">
                                    <option value="">--Chọn tỉnh thành phố--</option>
                                    @foreach ($tinh_thanh_pho as $item)
                                        <option value="{{ $item->ma_tinh_thanh_pho }}">{{ $item->ten_tinh_thanh_pho }}</option>
                                    @endforeach
                                </select>
                                <p class="Err text-danger tinh_thanh_pho-error-dia-chi">
                                    @error('tinh_thanh_pho')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="them_quan_huyen">Chọn Quận/Huyện</label>
                                <select class="form-select @error('quan_huyen') is-invalid @enderror"
                                    id="them_quan_huyen" name="quan_huyen">
                                    <option value="">--Chọn quận huyện--</option>
                                </select>
                                <p class="Err text-danger quan_huyen-error-dia-chi">
                                    @error('quan_huyen')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="them_phuong_xa">Chọn Phường/Xã/Thị trấn</label>
                                <select class="form-select @error('phuong_xa') is-invalid @enderror" id="them_phuong_xa"
                                    name="phuong_xa">
                                    <option value="">--Chọn phường xã--</option>
                                </select>
                                <p class="Err text-danger phuong_xa-error-dia-chi">
                                    @error('phuong_xa')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Ghi địa chỉ cụ thể (VD: số nhà, ngõ ngách, xóm...)</label>
                                <textarea name="dia_chi_chi_tiet" id="them_dia_chi_chi_tiet" cols="5" rows="4"
                                    class="form-control form-control-sm @error('dia_chi_chi_tiet') is-invalid @enderror"></textarea>
                                <p class="Err text-danger dia_chi_chi_tiet-error-dia-chi">
                                    @error('dia_chi_chi_tiet')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <button class="btn btn-submit mt-3 check-url" type="submit" onsubmit="ajaxThemDiaChiCheckOut()">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('js')
<script src="{{asset('assets/js/check-out.js')}}"></script>
@endsection
