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
            <div class="col-xxl-9 col-xl-8">
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
                                    $tong_tien=0;
                                    $tiet_kiem=0;
                                @endphp
                                @foreach ($gio_hangs as $item)
                                    @php
                                        $gia_khuyen_mai = $item->sanPham->gia_san_pham - ($item->sanPham->gia_san_pham * $item->sanPham->khuyen_mai / 100);
                                        $thanh_tien= $gia_khuyen_mai*$item->so_luong;
                                        $tong_tien += $gia_khuyen_mai*$item->so_luong;
                                        $tiet_kiem+= (($item->sanPham->gia_san_pham*$item->so_luong)-($gia_khuyen_mai*$item->so_luong));
                                    @endphp
                                    <tr>
                                        <td><input type="checkbox" data-id="{{$item->id}}"></td>
                                        <td>
                                            <div class="cart-box">
                                                <a class="style-border" href="{{route('san-pham.chi-tiet-san-pham',$item->san_pham_id)}}">
                                                    <img src="{{Storage::url($item->sanPham->hinh_anh)}}" alt="">
                                                </a>
                                                <div>
                                                    <a href="{{route('san-pham.chi-tiet-san-pham',$item->san_pham_id)}}">
                                                        <h5>{{Str::limit(strip_tags($item->sanPham->ten_san_pham), 22, '...')}}</h5>
                                                    </a>
                                                    <p>Phân loại hàng: <span>{{$item->bienThe->kich_co}}, {{$item->bienThe->ten_mau}}</span>.
                                                        <span class="thayDoi">Thay đổi</span></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ number_format($gia_khuyen_mai, 0, ',', '.') }}đ</td>
                                        <td>
                                            <div class="quantity">
                                                <button class="minus" type="button">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                                <input type="hidden" data-thanhTien="{{$thanh_tien}}" data-giaKM="{{$gia_khuyen_mai}}" data-id="{{$item->id}}" class="soLuong" value="1">
                                                <input type="number" data-max="{{$item->bienThe->so_luong}}" value="{{$item->so_luong}}" min="1" readonly>
                                                <button class="plus" type="button">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="tdThanhTien">{{ number_format($thanh_tien, 0, ',', '.') }}đ</td>
                                        <td>
                                            <a data-id="{{$item->id}}" class="deleteButton" href="javascript:void(0)"> <i class="iconsax" data-icon="trash"></i></a>
                                        </td>
                                    </tr>
                                    {{-- thay doi bien the --}}
                                    {{-- <div class="chonBienTheMoi">
                                        <form action="" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="" class="form-label">Kích cỡ</label>
                                                @php
                                                    // Kiểm tra nếu có biến thể với kích cỡ này
                                                    $kichCoTonTai = $san_pham->bienThes->contains('kich_co', $item->kich_co);
                                                @endphp
                                                <div class="">
                                                    <input type="hidden" id="kich_co_hidden" name="kich_co" value="">
                                                    @foreach ($kich_cos as $item)
                                                        <input {{ !$kichCoTonTai ? 'disabled' : '' }} type="button" class="btn btn-outline-primary kich_co_btn" value="{{$item->kich_co}}">
                                                    @endforeach
                                                </div>
                                                @error('kich_co')
                                                    <p class="text-danger mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label">Màu sắc</label>
                                                <div class="">
                                                    <input type="hidden" id="ten_mau_hidden" name="ten_mau" value="">
                                                    <input type="hidden" id="ma_mau_hidden" name="ma_mau" value="">
                                                    @foreach ($mau_sacs as $item)
                                                    <input type="button" class="btn btn-outline-primary mau_sac_btn" style="background-color: {{$item->ma_mau}}; color:#fff;" data-color="{{$item->ma_mau}}" value="{{$item->ten_mau}}">
                                                    @endforeach
                                                </div>
                                                @error('ten_mau')
                                                    <p class="text-danger mt-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-danger">Xác nhận</button>
                                        </form>
                                    </div> --}}

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
            <div class="col-xxl-3 col-xl-4">
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
                    <a class="btn btn_black w-100 rounded sm" href="check-out.html">Tiếp tục</a>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- popup thông báo --}}
<div id="thayDoiBienThe">
    <div id="bodyThayDoi">
        <div>
            <h5>Kích cỡ:</h5>
            <div class="sizeBox">
                <ul class="selected" id="selectSize">
                    <input type="hidden" id="size" value="">
                    <li class="">
                        <a href="javascript:void(0);">M</a>
                    </li>
                    <li class="">
                        <a href="javascript:void(0);">L</a>
                    </li>
                    <li class="">
                        <a href="javascript:void(0);">XL</a>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <h5>Màu sắc:</h5>
            <div class="colorBox">
                <ul id="selectMauSac">
                    <input type="hidden" id="mauSac" value="">
                        <li style="background-color: #000; border: 1px solid #0000003b;" title=""></li>
                        <li style="background-color: #fff; border: 1px solid #0000003b;" title=""></li>
                </ul>
            </div>
        </div>
        <div id="btn">
            <button class="btn btn-light">Trở lại</button>
            <button class="btn btn-danger">Xác nhận</button>
        </div>
    </div>
</div>
{{-- end popup thông báo --}}
@endsection
@section('js')
<script src="{{asset('assets/js/cart.js')}}"></script>
@endsection
