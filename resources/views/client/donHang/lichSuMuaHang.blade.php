@extends('client.layout.main')
@section('container')
<section class="section-b-space pt-0">
    <div class="heading-banner">
        <div class="custom-container container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Lịch sử mua hàng</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-b-space pt-0">
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
    <div class="custom-container container">
        <div class="card" style="border-radius: 10px;">
            <div class="card-header text-center donmua">
                <nav>
                    <ul class="nav-tab">
                        <li class="active"><a href="#tap1">Tất cả</a></li>
                        <li><a href="#tap2">Chờ xác nhận</a></li>
                        <li><a href="#tap3">Chờ giao hàng</a></li>
                        <li><a href="#tap4">Đang giao</a></li>
                        <li><a href="#tap5">Hoàn thành</a></li>
                        <li><a href="#tap6">Đã hủy</a></li>
                    </ul>
                </nav>
            </div>
            {{-- tap 1 --}}
            <div id="tap1" class="card-body bg-light an">
                @foreach ($don_hangs['trang_thai_all'] as $itemDonHang)
                    <form action="" method="POST">
                        @csrf
                        <div class="card shadow-0 border mb-4" style="border-radius: 10px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="cart-table-container tableDonMua">
                                            <table class="table">
                                                <tbody>
                                                    @foreach ($chi_tiet_don_hangs[$itemDonHang->id] as $item)
                                                    <tr class="product-row">
                                                        <td class="img">
                                                            <img src="{{Storage::url($item->bienThe->hinh_anh)}}" alt="product">
                                                        </td>
                                                        <td class="col-5 tenSanPham">
                                                            <a href="{{route('san-pham.chi-tiet-san-pham',$item->san_pham_id)}}">{{$item->sanPham->ten_san_pham}}</a>
                                                            <p>Phân loại hàng:
                                                                <span class="phanLoaiHang">{{ $item->bienThe->kich_co }}, {{ $item->bienThe->ten_mau }}</span>.
                                                            </p>
                                                        </td>
                                                        <td class="col-4"><span>Số lượng:</span> {{$item->so_luong}}</td>
                                                        <td class="col-3"><span>Thành tiền:</span> {{number_format($item->thanh_tien, 0, ',', '.')}}đ</td>
                                                    </tr>
                                                    <input type="hidden" name="ids[]" value="{{$item->san_pham_id}}">
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr class="trangThai">
                                                        <td colspan="5" style="border-bottom: none;">
                                                            <p>Trạng thái: <span style="color:#2ecc71;">
                                                                @if ($itemDonHang->trang_thai==0)
                                                                    Chờ xác nhận
                                                                @endif
                                                                @if ($itemDonHang->trang_thai==1)
                                                                    Đang chuẩn bị hàng
                                                                @endif
                                                                @if ($itemDonHang->trang_thai==2)
                                                                    Chuẩn bị giao cho đơn vị vận chuyển
                                                                @endif
                                                                @if ($itemDonHang->trang_thai==3)
                                                                    Đơn hàng đang được giao
                                                                @endif
                                                                @if ($itemDonHang->trang_thai==4)
                                                                    Đã giao
                                                                @endif
                                                                @if ($itemDonHang->trang_thai==5)
                                                                    Đã hủy
                                                                @endif
                                                            </span></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" >
                                                            <p>Được đặt bởi: <span style="color:#000; margin-left: 60px;">{{$itemDonHang->diaChi->ho_va_ten_nhan}}</span></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" >
                                                            <p>Địa chỉ nhận hàng:
                                                                <span style="color:#000; margin-left: 15px;">
                                                                    @php
                                                                        $dia_chi = $itemDonHang->diaChi;
                                                                    @endphp
                                                                    @if ($dia_chi->dia_chi_chi_tiet)
                                                                        {{ $dia_chi->dia_chi_chi_tiet }},
                                                                    @endif
                                                                    {{$dia_chi->phuongXa->ten_phuong_xa}},
                                                                    {{$dia_chi->quanHuyen->ten_quan_huyen}},
                                                                    {{$dia_chi->tinhThanhPho->ten_tinh_thanh_pho}}
                                                                </span>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" >
                                                            <p>Số điện thoại nhận: <span style="color:#000; margin-left: 8px;">{{$itemDonHang->diaChi->so_dien_thoai_nhan}}</span></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" >
                                                            <p>Thanh toán: <span style="color:#2ecc71; margin-left: 72px;">
                                                            @if ($itemDonHang->thanh_toan==0)
                                                                Chưa thanh toán
                                                            @endif
                                                            @if ($itemDonHang->thanh_toan==1)
                                                                Đã thanh toán
                                                            @endif
                                                            </span></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" >
                                                            <p>Mã hóa đơn: <span style="color: red; margin-left: 68px;">{{$itemDonHang->ma_don_hang}}</span></p>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class="btnDonMua">
                                                @if($itemDonHang->trang_thai==0 || $itemDonHang->trang_thai==1 || $itemDonHang->trang_thai==2)
                                                    <a href="" style="text-decoration: none" class="btn">Hủy đơn hàng</a>
                                                @endif
                                                @if($itemDonHang->trang_thai==3)
                                                    <input type="hidden"  name="_token" value="{{ csrf_token() }}" />
                                                    <span data-id="{{$itemDonHang->id}}"  class="btn btnDaNhan">Đã nhận hàng</span>
                                                    <button type="submit" class="btn btnMuaLai">Mua lại</button>
                                                @endif
                                                @if($itemDonHang->trang_thai==4)
                                                    <button class="btn btnMuaLai">Mua lại</button>
                                                @endif
                                                @if($itemDonHang->trang_thai==5)
                                                    <a href="" style="text-decoration: none" class="btn">Xem chi tiết hủy đơn</a>
                                                    <button class="btn btnMuaLai">Mua lại</button>
                                                @endif
                                            </div>
                                        </div><!-- End .cart-table-container -->
                                    </div><!-- End .col-lg-8 -->
                                </div>
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
