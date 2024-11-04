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
            <div class="col-xxl-8 col-lg-7">
                <div class="left-sidebar-checkout sticky">
                    <div class="address-option">
                        <div class="address-title">
                            <h4>Địa chỉ giao hàng </h4>
                            <a href="#" data-bs-toggle="modal"
                                data-bs-target="#address-modal" title="add product" tabindex="0">+ Thêm địa chỉ mới</a>
                        </div>
                        <div class="row">
                            @foreach ($dia_chis as $item)
                            <div class="col-xxl-4" style="width: 100%">
                                <label for="address-billing-0">
                                    <span class="delivery-address-box">
                                        <span class="form-check">
                                            <input class="custom-radio" id="address-billing-0" type="radio" {{$item->trang_thai==1?'checked':''}} name="selectDiaChi" data-id="{{$item->id}}">
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
                                <div class="payment-box"><input class="custom-radio me-2" id="cod" type="radio"
                                        checked="checked" name="radio"><label for="cod">Thanh toán khi nhận hàng</label></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="payment-box"><input class="custom-radio me-2" id="paypal" type="radio"
                                        name="radio"><label for="paypal">Chuyển khoản</label></div>
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
                                    $sanPham = $item->sanPham;
                                    $gia_khuyen_mai = $sanPham->gia_san_pham - ($sanPham->gia_san_pham * $sanPham->khuyen_mai / 100);
                                    $thanh_tien = $gia_khuyen_mai * $item->so_luong;
                                    $tong_tien += $thanh_tien;
                                    $tiet_kiem += (($sanPham->gia_san_pham * $item->so_luong) - $thanh_tien);
                                @endphp
                                <li> <img width="60px" src="{{Storage::url($sanPham->hinh_anh)}}" alt="{{$sanPham->ten_san_pham}}">
                                    <div>
                                        <h6>{{ Str::limit(strip_tags($sanPham->ten_san_pham), 20, '...') }}</h6>
                                        <span>{{$item->bienThe->kich_co}}, {{$item->bienThe->ten_mau}}</span>
                                    </div>
                                    <p>x {{$item->so_luong}}</p>
                                    <p>{{ number_format($gia_khuyen_mai, 0, ',', '.') }}đ</p>
                                </li>
                            @endforeach
                        </ul>
                        <div class="summary-total">
                            <ul>
                                <li>
                                    <p>Tổng số tiền ({{$count_gio_hang}} sản phẩm)</p><span>{{ number_format($tong_tien, 0, ',', '.') }}đ</span>
                                </li>
                                <li>
                                    <p>Tổng tiền phí vận chuyển</p><span>50.000đ</span>
                                </li>
                                <li>
                                    <p>Chọn mã giảm giá</p><a href="javascript:void(0)" style="color: #05a">Chọn mã</a>
                                </li>
                                <li>
                                    <p>Giảm giá vận chuyển</p><span>2 ty</span>
                                </li>
                                <li>
                                    <p>Giảm giá đơn hàng</p><span>1 ty</span>
                                </li>
                            </ul>
                        </div>
                        <div class="total">
                            <h6>Tổng tiền hàng : </h6>
                            <h6>$ 37.73</h6>
                        </div>
                        <div class="total">
                            <h6>Tổng tiền phí vận chuyển : </h6>
                            <h6>$ 37.73</h6>
                        </div>
                        <div class="total">
                            <h6>Tổng thanh toán : </h6>
                            <h6>$ 37.73</h6>
                        </div>
                        <div class="order-button"><a class="btn btn_black sm w-100 rounded" href="#">Đặt hàng
                            </a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
