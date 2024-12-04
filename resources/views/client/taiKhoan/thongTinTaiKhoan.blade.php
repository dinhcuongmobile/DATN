@extends('client.layout.main')
@section('container')
    <section class="section-b-space pt-0">
        <div class="heading-banner">
            <div class="custom-container container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4>TÀI KHOẢN</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-b-space pt-0">
        <div class="custom-container container user-dashboard-section">
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
                <div class="col-xl-3 col-lg-4">
                    <div class="left-dashboard-show">
                        <button class="btn btn_black sm rounded bg-primary">Show
                            Menu</button>
                    </div>
                    <div class="dashboard-left-sidebar sticky">
                        <div class="profile-box">
                            <div class="profile-bg-img"></div>
                            <div class="dashboard-left-sidebar-close">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                            <div class="profile-contain">
                                <div class="profile-image">
                                    <img class="img-fluid" src="{{ asset('assets/images/user/12.jpg') }}" alt="">
                                </div>
                                <div class="profile-name">
                                    <h4>{{ Auth::user()->ho_va_ten }}</h4>
                                </div>
                            </div>
                        </div>
                        <ul class="nav flex-column nav-pills dashboard-tab" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <li>
                                <button class="nav-link active" id="dashboard-tab" data-bs-toggle="pill"
                                    data-bs-target="#dashboard" role="tab" aria-controls="dashboard"
                                    aria-selected="true"><i class="iconsax" data-icon="home-1"></i> Tổng Quan</button>
                            </li>
                            <li>
                                <button class="nav-link" id="order-tab" data-bs-toggle="pill" data-bs-target="#order"
                                    role="tab" aria-controls="order" aria-selected="false"><i class="iconsax"
                                        data-icon="receipt-square"></i> Đơn Hàng</button>
                            </li>
                            <li>
                                <button class="nav-link" id="wishlist-tab" data-bs-toggle="pill" data-bs-target="#wishlist"
                                    role="tab" aria-controls="wishlist" aria-selected="false"> <i class="iconsax"
                                        data-icon="heart"></i>Yêu Thích </button>
                            </li>
                            <li>
                                <button class="nav-link" id="address-tab" data-bs-toggle="pill" data-bs-target="#address"
                                    role="tab" aria-controls="address" aria-selected="false"><i class="iconsax"
                                        data-icon="cue-cards"></i>Địa Chỉ</button>
                            </li>
                        </ul>
                        <div class="logout-button">
                            <a href="{{ route('tai-khoan.dang-xuat') }}" class="btn btn_black sm" title="Quick View"
                                tabindex="0"><i class="iconsax me-1" data-icon="logout-1"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
                {{-- Nội dung --}}
                <div class="col-xl-9 col-lg-8">
                    <div class="tab-content" id="v-pills-tabContent">
                        {{-- Thông tin tài khoản --}}
                        <div class="tab-pane fade show active" id="dashboard" role="tabpanel"
                            aria-labelledby="dashboard-tab">
                            <div class="dashboard-right-box">
                                <div class="my-dashboard-tab">
                                    <div class="dashboard-items"> </div>
                                    <div class="sidebar-title">
                                        <div class="loader-line"></div>
                                        <h4></h4>
                                    </div>
                                    <div class="dashboard-user-name">
                                        <h6>Chào, <b>{{ Auth::user()->ho_va_ten }}</b></h6>
                                        <p>Trang tài khoản Namad Store giúp bạn dễ dàng quản lý thông tin cá nhân, theo dõi
                                            đơn hàng và cập nhật trạng thái giao hàng.
                                            Tại đây, bạn có thể chỉnh sửa thông tin liên lạc, thay đổi mật khẩu.</p>
                                    </div>
                                    <div class="total-box">
                                        <div class="row gy-4">
                                            <div class="col-xl-6">
                                                <div class="totle-contain">
                                                    <div class="wallet-point">
                                                        <img src="https://themes.pixelstrap.net/katie/assets/images/svg-icon/coin.svg"
                                                            alt="">
                                                        <img class="img-1"
                                                            src="https://themes.pixelstrap.net/katie/assets/images/svg-icon/coin.svg"
                                                            alt="">
                                                    </div>
                                                    <div class="totle-detail">
                                                        <h6>Tổng Xu</h6>
                                                        <h4 class="tongCoin">{{ $tongCoin }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="totle-contain">
                                                    <div class="wallet-point">
                                                        <img src="https://themes.pixelstrap.net/katie/assets/images/svg-icon/order.svg"
                                                            alt="">
                                                        <img class="img-1"
                                                            src="https://themes.pixelstrap.net/katie/assets/images/svg-icon/order.svg"
                                                            alt="">
                                                    </div>
                                                    <div class="totle-detail">
                                                        <h6>Đơn Hàng</h6>
                                                        <h4>{{ $countDonHang }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-about">
                                        <div class="row">
                                            <div class="col-xl-7">
                                                <div class="sidebar-title">
                                                    <div class="loader-line"></div>
                                                    <h5>Thông Tin Tài Khoản</h5>
                                                </div>
                                                <ul class="profile-information">
                                                    <input type="hidden" class="tokenThongTin" name="_token"
                                                        value="{{ csrf_token() }}" />
                                                    <li>
                                                        <h6>Họ&Tên :</h6>
                                                        <p>{{ Auth::user()->ho_va_ten }}</p>
                                                        <a class="thayDoiHoTen" href="javascript:void(0)">Thay đổi</a>
                                                    </li>
                                                    <li class="form-hoVaTen" style="display: none;">
                                                        <input class="form-control" type="text"
                                                            value="{{ Auth::user()->ho_va_ten }}">
                                                        <button class="btn btn-danger"
                                                            data-id="{{ Auth::user()->id }}">Lưu</button>
                                                        <p class="text-danger" style="width: 100%"></p>
                                                    </li>
                                                    <li>
                                                        <h6>Số Điện Thoại:</h6>
                                                        <p>{{ Auth::user()->so_dien_thoai }}</p>
                                                        <a class="thayDoiSDT" href="javascript:void(0)">Thay đổi</a>
                                                    </li>
                                                    <li class="form-SDT" style="display: none;">
                                                        <input class="form-control" type="text"
                                                            value="{{ Auth::user()->so_dien_thoai }}">
                                                        <button class="btn btn-danger"
                                                            data-id="{{ Auth::user()->id }}">Lưu</button>
                                                        <p class="text-danger" style="width: 100%"></p>
                                                    </li>
                                                    <li>
                                                        <h6>Địa Chỉ:</h6>
                                                        <p>
                                                            @if ($dia_chi)
                                                                @if ($dia_chi->dia_chi_chi_tiet)
                                                                    {{ $dia_chi->dia_chi_chi_tiet }},
                                                                @endif
                                                                {{ $dia_chi->phuongXa?->ten_phuong_xa }},
                                                                {{ $dia_chi->quanHuyen?->ten_quan_huyen }},
                                                                {{ $dia_chi->tinhThanhPho?->ten_tinh_thanh_pho }}
                                                            @else
                                                                Chưa có địa chỉ.
                                                            @endif
                                                        </p>
                                                    </li>
                                                </ul>
                                                <div class="sidebar-title">
                                                    <div class="loader-line"></div>
                                                    <h5>Chi Tiết Đăng Nhập</h5>
                                                </div>
                                                <ul class="profile-information mb-0">
                                                    <li>
                                                        <h6>Email :</h6>
                                                        @php
                                                            $email = Auth::user()->email;
                                                        @endphp
                                                        <p>{{ substr($email, 0, 4) . '******' . substr($email, strpos($email, '@') - 2, 2) . substr($email, strpos($email, '@')) }}
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <h6>Password :</h6>
                                                        <p>●●●●●●
                                                            <span data-bs-toggle="modal" data-bs-target="#edit-password"
                                                                title="Quick View" tabindex="0">Đổi mật khẩu</span>
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-xl-5">
                                                <div class="profile-image d-none d-xl-block"> <img class="img-fluid"
                                                        src="../assets/images/other-img/dashboard.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Mục yêu thích --}}
                        <div class="tab-pane fade" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
                            <div class="dashboard-right-box">
                                <div class="wishlist-box ratio1_3">
                                    <div class="sidebar-title">
                                        <div class="loader-line"></div>
                                        <h4>Danh sách yêu thích</h4>
                                    </div>
                                    <div class="row-cols-md-3 row-cols-2 grid-section view-option row gy-4 g-xl-4">
                                        @foreach ($yeuThichs as $item)
                                            <div class="col">
                                                <div class="product-box-3 product-wishlist">
                                                    <div class="img-wrapper">
                                                        <div class="label-block"><a
                                                                class="label-2 wishlist-icon delete-button"
                                                                href="javascript:void(0)" title="Add to Wishlist"
                                                                tabindex="0"><i class="iconsax" data-icon="trash"
                                                                    aria-hidden="true"></i></a>
                                                        </div>
                                                        <div class="product-image">
                                                            <a class="pro-first" href="#">
                                                                <img class="bg-img"
                                                                    src="{{ Storage::url($item->hinh_anh) }}"
                                                                    alt="product">
                                                            </a>
                                                        </div>

                                                        <div class="product-detail">
                                                            <a
                                                                href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}">
                                                                <h6>{{ $item->ten_san_pham }}</h6>
                                                            </a>
                                                            <p>{{ number_format($item->gia_san_pham) }} VNĐ</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Đơn hàng --}}
                        <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
                            <div class="dashboard-right-box">
                                <div class="order">
                                    <div class="sidebar-title">
                                        <div class="loader-line"></div>
                                        <h4>Lịch sử đơn hàng của tôi</h4>
                                    </div>
                                    <div class="row gy-4">
                                        <div class="card" style="border-radius: 10px;">
                                            <div class="card-header text-center donmua">
                                                <nav>
                                                    <ul class="nav-tab">
                                                        <li class="active"><a data-tap="tap1">Tất cả</a></li>
                                                        <li><a data-tap="tap2">Chờ xác nhận</a></li>
                                                        <li><a data-tap="tap3">Chờ giao hàng</a></li>
                                                        <li><a data-tap="tap4">Đang giao</a></li>
                                                        <li><a data-tap="tap5">Hoàn thành</a></li>
                                                        <li><a data-tap="tap6">Đã hủy</a></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                            {{-- tap 1 --}}
                                            <div id="tap1" class="card-body bg-light an">
                                                @foreach ($don_hangs['trang_thai_all'] as $itemDonHang)
                                                    <div class="card shadow-0 border mb-4" style="border-radius: 10px;"
                                                        data-donHangId="{{ $itemDonHang->id }}">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="cart-table-container tableDonMua">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <span class="chatLS">💬 Chat</span>
                                                                                        <a href="{{ route('san-pham.san-pham') }}"
                                                                                            class="shopLS"><i
                                                                                                class="fas fa-box"></i> Xem
                                                                                            cửa hàng</a>
                                                                                    </td>
                                                                                    <td colspan="2" class="thongBaoLS"
                                                                                        style="text-align: right">
                                                                                        <span class="thongBao">
                                                                                            @switch($itemDonHang->trang_thai)
                                                                                                @case(0)
                                                                                                    <span class="text-warning">Chờ
                                                                                                        xác nhận</span>
                                                                                                @break

                                                                                                @case(1)
                                                                                                    <span>Đang chuẩn bị hàng</span>
                                                                                                @break

                                                                                                @case(2)
                                                                                                    <i
                                                                                                        class="fas fa-truck icon"></i>
                                                                                                    <span>Đang giao</span>
                                                                                                @break

                                                                                                @case(3)
                                                                                                    <span>Đã giao</span>
                                                                                                @break

                                                                                                @case(4)
                                                                                                    <span class="text-danger">Đã
                                                                                                        hủy</span>
                                                                                                @break
                                                                                            @endswitch
                                                                                        </span> |
                                                                                        <span class="choThanhToan"
                                                                                            style="color: {{ $itemDonHang->thanh_toan == 0 ? 'red' : '#26aa99' }}; font-size: 16px">
                                                                                            {{ $itemDonHang->thanh_toan == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                                @foreach ($chi_tiet_don_hangs[$itemDonHang->id] as $item)
                                                                                    <tr class="product-row" title="Xem chi tiết">
                                                                                        <td class="img">
                                                                                            <img src="{{ Storage::url($item->bienThe->hinh_anh) }}"
                                                                                                alt="product">
                                                                                        </td>
                                                                                        <td class="col-9 tenSanPham">
                                                                                            <a>{{ $item->sanPham->ten_san_pham }}</a>
                                                                                            <p>Phân loại hàng:
                                                                                                <span
                                                                                                    class="phanLoaiHang">{{ $item->bienThe->kich_co }},
                                                                                                    {{ $item->bienThe->ten_mau }}</span>.
                                                                                            </p>
                                                                                            <p style="color: #000">
                                                                                                x{{ $item->so_luong }}</p>
                                                                                        </td>
                                                                                        <td class="col-3 giaTienLS"
                                                                                            style="text-align: right">
                                                                                            <span>{{ number_format($item->thanh_tien, 0, ',', '.') }}đ</span>
                                                                                            <span><del>{{ number_format($item->sanPham->gia_san_pham * $item->so_luong, 0, ',', '.') }}đ</del></span>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        <p class="thanhTien">Thành tiền:
                                                                            <span>{{ number_format($itemDonHang->tong_thanh_toan, 0, ',', '.') }}đ</span>
                                                                        </p>
                                                                        <div class="btnDonMua">
                                                                            @if ($itemDonHang->trang_thai == 0 || $itemDonHang->trang_thai == 1)
                                                                                <button style="margin-right:15px;"
                                                                                    class="btn btn-outline-danger huyDonHang">Hủy đơn hàng</button>
                                                                            @elseif ($itemDonHang->trang_thai == 2)
                                                                                <button class="btn btn-success daNhanHang">Đã nhận hàng</button>
                                                                                <button class="btn btn-primary muaLai">Mua lại</button>
                                                                            @elseif ($itemDonHang->trang_thai == 3)
                                                                                @if (isset($chua_danh_gia[$itemDonHang->id]) && $chua_danh_gia[$itemDonHang->id])
                                                                                    <button class="btn btn-warning btnDanhGia">Đánh giá</button>
                                                                                @endif
                                                                                <button class="btn btn-primary muaLai">Mua lại</button>
                                                                            @elseif ($itemDonHang->trang_thai == 4)
                                                                                <button class="btn btn-primary muaLai">Mua lại</button>
                                                                            @endif
                                                                            <a href="{{ route('lien-he.lien-he') }}"
                                                                                class="btn btn-outline-secondary">Liên hệ Shop</a>
                                                                        </div>
                                                                    </div><!-- End .cart-table-container -->
                                                                </div><!-- End .col-lg-8 -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            {{-- tap 2 --}}
                                            <div id="tap2" class="card-body bg-light an">
                                                @foreach ($don_hangs['trang_thai_0'] as $itemDonHang)
                                                    <div class="card shadow-0 border mb-4" style="border-radius: 10px;"
                                                        data-donHangId="{{ $itemDonHang->id }}">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="cart-table-container tableDonMua">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <span class="chatLS">💬 Chat</span>
                                                                                        <a href="{{ route('san-pham.san-pham') }}"
                                                                                            class="shopLS"><i
                                                                                                class="fas fa-box"></i> Xem
                                                                                            cửa hàng</a>
                                                                                    </td>
                                                                                    <td colspan="2" class="thongBaoLS"
                                                                                        style="text-align: right">
                                                                                        <span class="thongBao">
                                                                                            <span class="text-warning">Chờ
                                                                                                xác nhận</span>
                                                                                        </span> |
                                                                                        <span class="choThanhToan"
                                                                                            style="color: {{ $itemDonHang->thanh_toan == 0 ? 'red' : '#26aa99' }}; font-size: 16px">
                                                                                            {{ $itemDonHang->thanh_toan == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                                @foreach ($chi_tiet_don_hangs[$itemDonHang->id] as $item)
                                                                                    <tr class="product-row" title="Xem chi tiết">
                                                                                        <td class="img">
                                                                                            <img src="{{ Storage::url($item->bienThe->hinh_anh) }}"
                                                                                                alt="product">
                                                                                        </td>
                                                                                        <td class="col-9 tenSanPham">
                                                                                            <a>{{ $item->sanPham->ten_san_pham }}</a>
                                                                                            <p>Phân loại hàng:
                                                                                                <span
                                                                                                    class="phanLoaiHang">{{ $item->bienThe->kich_co }},
                                                                                                    {{ $item->bienThe->ten_mau }}</span>.
                                                                                            </p>
                                                                                            <p style="color: #000">
                                                                                                x{{ $item->so_luong }}</p>
                                                                                        </td>
                                                                                        <td class="col-3 giaTienLS"
                                                                                            style="text-align: right">
                                                                                            <span>{{ number_format($item->thanh_tien, 0, ',', '.') }}đ</span>
                                                                                            <span><del>{{ number_format($item->sanPham->gia_san_pham * $item->so_luong, 0, ',', '.') }}đ</del></span>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        <p class="thanhTien">Thành tiền:
                                                                            <span>{{ number_format($itemDonHang->tong_thanh_toan, 0, ',', '.') }}đ</span>
                                                                        </p>
                                                                        <div class="btnDonMua">
                                                                            <button style="margin-right:15px;"
                                                                                class="btn btn-outline-danger huyDonHang">Hủy
                                                                                đơn hàng</button>
                                                                            <a href="{{ route('lien-he.lien-he') }}"
                                                                                class="btn btn-outline-secondary">Liên hệ
                                                                                Shop</a>
                                                                        </div>
                                                                    </div><!-- End .cart-table-container -->
                                                                </div><!-- End .col-lg-8 -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            {{-- tap 3 --}}
                                            <div id="tap3" class="card-body bg-light an">
                                                @foreach ($don_hangs['trang_thai_1'] as $itemDonHang)
                                                    <div class="card shadow-0 border mb-4" style="border-radius: 10px;"
                                                        data-donHangId="{{ $itemDonHang->id }}">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="cart-table-container tableDonMua">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <span class="chatLS">💬 Chat</span>
                                                                                        <a href="{{ route('san-pham.san-pham') }}"
                                                                                            class="shopLS"><i
                                                                                                class="fas fa-box"></i> Xem
                                                                                            cửa hàng</a>
                                                                                    </td>
                                                                                    <td colspan="2" class="thongBaoLS"
                                                                                        style="text-align: right">
                                                                                        <span class="thongBao">
                                                                                            <span>Đang chuẩn bị hàng</span>
                                                                                        </span> |
                                                                                        <span class="choThanhToan"
                                                                                            style="color: {{ $itemDonHang->thanh_toan == 0 ? 'red' : '#26aa99' }}; font-size: 16px">
                                                                                            {{ $itemDonHang->thanh_toan == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                                @foreach ($chi_tiet_don_hangs[$itemDonHang->id] as $item)
                                                                                    <tr class="product-row" title="Xem chi tiết">
                                                                                        <td class="img">
                                                                                            <img src="{{ Storage::url($item->bienThe->hinh_anh) }}"
                                                                                                alt="product">
                                                                                        </td>
                                                                                        <td class="col-9 tenSanPham">
                                                                                            <a>{{ $item->sanPham->ten_san_pham }}</a>
                                                                                            <p>Phân loại hàng:
                                                                                                <span
                                                                                                    class="phanLoaiHang">{{ $item->bienThe->kich_co }},
                                                                                                    {{ $item->bienThe->ten_mau }}</span>.
                                                                                            </p>
                                                                                            <p style="color: #000">
                                                                                                x{{ $item->so_luong }}</p>
                                                                                        </td>
                                                                                        <td class="col-3 giaTienLS"
                                                                                            style="text-align: right">
                                                                                            <span>{{ number_format($item->thanh_tien, 0, ',', '.') }}đ</span>
                                                                                            <span><del>{{ number_format($item->sanPham->gia_san_pham * $item->so_luong, 0, ',', '.') }}đ</del></span>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        <p class="thanhTien">Thành tiền:
                                                                            <span>{{ number_format($itemDonHang->tong_thanh_toan, 0, ',', '.') }}đ</span>
                                                                        </p>
                                                                        <div class="btnDonMua">
                                                                            <button style="margin-right:15px;"
                                                                                class="btn btn-outline-danger huyDonHang">Hủy
                                                                                đơn hàng</button>
                                                                            <a href="{{ route('lien-he.lien-he') }}"
                                                                                class="btn btn-outline-secondary">Liên hệ
                                                                                Shop</a>
                                                                        </div>
                                                                    </div><!-- End .cart-table-container -->
                                                                </div><!-- End .col-lg-8 -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            {{-- tap 4 --}}
                                            <div id="tap4" class="card-body bg-light an">
                                                @foreach ($don_hangs['trang_thai_2'] as $itemDonHang)
                                                    <div class="card shadow-0 border mb-4" style="border-radius: 10px;"
                                                        data-donHangId="{{ $itemDonHang->id }}">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="cart-table-container tableDonMua">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <span class="chatLS">💬 Chat</span>
                                                                                        <a href="{{ route('san-pham.san-pham') }}"
                                                                                            class="shopLS"><i
                                                                                                class="fas fa-box"></i> Xem
                                                                                            cửa hàng</a>
                                                                                    </td>
                                                                                    <td colspan="2" class="thongBaoLS"
                                                                                        style="text-align: right">
                                                                                        <span class="thongBao">
                                                                                            <i
                                                                                                class="fas fa-truck icon"></i>
                                                                                            <span>Đang giao</span>
                                                                                        </span> |
                                                                                        <span class="choThanhToan"
                                                                                            style="color: {{ $itemDonHang->thanh_toan == 0 ? 'red' : '#26aa99' }}; font-size: 16px">
                                                                                            {{ $itemDonHang->thanh_toan == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                                @foreach ($chi_tiet_don_hangs[$itemDonHang->id] as $item)
                                                                                    <tr class="product-row" title="Xem chi tiết">
                                                                                        <td class="img">
                                                                                            <img src="{{ Storage::url($item->bienThe->hinh_anh) }}"
                                                                                                alt="product">
                                                                                        </td>
                                                                                        <td class="col-9 tenSanPham">
                                                                                            <a>{{ $item->sanPham->ten_san_pham }}</a>
                                                                                            <p>Phân loại hàng:
                                                                                                <span
                                                                                                    class="phanLoaiHang">{{ $item->bienThe->kich_co }},
                                                                                                    {{ $item->bienThe->ten_mau }}</span>.
                                                                                            </p>
                                                                                            <p style="color: #000">
                                                                                                x{{ $item->so_luong }}</p>
                                                                                        </td>
                                                                                        <td class="col-3 giaTienLS"
                                                                                            style="text-align: right">
                                                                                            <span>{{ number_format($item->thanh_tien, 0, ',', '.') }}đ</span>
                                                                                            <span><del>{{ number_format($item->sanPham->gia_san_pham * $item->so_luong, 0, ',', '.') }}đ</del></span>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        <p class="thanhTien">Thành tiền:
                                                                            <span>{{ number_format($itemDonHang->tong_thanh_toan, 0, ',', '.') }}đ</span>
                                                                        </p>
                                                                        <div class="btnDonMua">
                                                                            <button class="btn btn-success daNhanHang">Đã
                                                                                nhận hàng</button>
                                                                            <button class="btn btn-primary muaLai">Mua
                                                                                lại</button>
                                                                            <a href="{{ route('lien-he.lien-he') }}"
                                                                                class="btn btn-outline-secondary">Liên hệ
                                                                                Shop</a>
                                                                        </div>
                                                                    </div><!-- End .cart-table-container -->
                                                                </div><!-- End .col-lg-8 -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            {{-- tap 5 --}}
                                            <div id="tap5" class="card-body bg-light an">
                                                @foreach ($don_hangs['trang_thai_3'] as $itemDonHang)
                                                    <div class="card shadow-0 border mb-4" style="border-radius: 10px;"
                                                        data-donHangId="{{ $itemDonHang->id }}">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="cart-table-container tableDonMua">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <span class="chatLS">💬 Chat</span>
                                                                                        <a href="{{ route('san-pham.san-pham') }}"
                                                                                            class="shopLS"><i
                                                                                                class="fas fa-box"></i> Xem
                                                                                            cửa hàng</a>
                                                                                    </td>
                                                                                    <td colspan="2" class="thongBaoLS"
                                                                                        style="text-align: right">
                                                                                        <span class="thongBao">
                                                                                            <i
                                                                                                class="fas fa-truck icon"></i>
                                                                                            <span>Đã giao</span>
                                                                                        </span> |
                                                                                        <span class="choThanhToan"
                                                                                            style="color: {{ $itemDonHang->thanh_toan == 0 ? 'red' : '#26aa99' }}; font-size: 16px">
                                                                                            {{ $itemDonHang->thanh_toan == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                                @foreach ($chi_tiet_don_hangs[$itemDonHang->id] as $item)
                                                                                    <tr class="product-row" title="Xem chi tiết">
                                                                                        <td class="img">
                                                                                            <img src="{{ Storage::url($item->bienThe->hinh_anh) }}"
                                                                                                alt="product">
                                                                                        </td>
                                                                                        <td class="col-9 tenSanPham">
                                                                                            <a>{{ $item->sanPham->ten_san_pham }}</a>
                                                                                            <p>Phân loại hàng:
                                                                                                <span
                                                                                                    class="phanLoaiHang">{{ $item->bienThe->kich_co }},
                                                                                                    {{ $item->bienThe->ten_mau }}</span>.
                                                                                            </p>
                                                                                            <p style="color: #000">
                                                                                                x{{ $item->so_luong }}</p>
                                                                                        </td>
                                                                                        <td class="col-3 giaTienLS"
                                                                                            style="text-align: right">
                                                                                            <span>{{ number_format($item->thanh_tien, 0, ',', '.') }}đ</span>
                                                                                            <span><del>{{ number_format($item->sanPham->gia_san_pham * $item->so_luong, 0, ',', '.') }}đ</del></span>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        <p class="thanhTien">Thành tiền:
                                                                            <span>{{ number_format($itemDonHang->tong_thanh_toan, 0, ',', '.') }}đ</span>
                                                                        </p>
                                                                        <div class="btnDonMua">
                                                                            @if (isset($chua_danh_gia[$itemDonHang->id]) && $chua_danh_gia[$itemDonHang->id])
                                                                                <button
                                                                                    class="btn btn-warning btnDanhGia">Đánh
                                                                                    giá</button>
                                                                            @endif
                                                                            <button class="btn btn-primary muaLai">Mua
                                                                                lại</button>
                                                                            <a href="{{ route('lien-he.lien-he') }}"
                                                                                class="btn btn-outline-secondary">Liên hệ
                                                                                Shop</a>
                                                                        </div>
                                                                    </div><!-- End .cart-table-container -->
                                                                </div><!-- End .col-lg-8 -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            {{-- tap 6 --}}
                                            <div id="tap6" class="card-body bg-light an">
                                                @foreach ($don_hangs['trang_thai_4'] as $itemDonHang)
                                                    <div class="card shadow-0 border mb-4" style="border-radius: 10px;"
                                                        data-donHangId="{{ $itemDonHang->id }}">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="cart-table-container tableDonMua">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <span class="chatLS">💬 Chat</span>
                                                                                        <a href="{{ route('san-pham.san-pham') }}"
                                                                                            class="shopLS"><i
                                                                                                class="fas fa-box"></i> Xem
                                                                                            cửa hàng</a>
                                                                                    </td>
                                                                                    <td colspan="2" class="thongBaoLS"
                                                                                        style="text-align: right">
                                                                                        <span class="thongBao">
                                                                                            <span style="color: red;">Đã
                                                                                                hủy</span>
                                                                                        </span> |
                                                                                        <span class="choThanhToan"
                                                                                            style="color: {{ $itemDonHang->thanh_toan == 0 ? 'red' : '#26aa99' }}; font-size: 16px">
                                                                                            {{ $itemDonHang->thanh_toan == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                                @foreach ($chi_tiet_don_hangs[$itemDonHang->id] as $item)
                                                                                    <tr class="product-row" title="Xem chi tiết">
                                                                                        <td class="img">
                                                                                            <img src="{{ Storage::url($item->bienThe->hinh_anh) }}"
                                                                                                alt="product">
                                                                                        </td>
                                                                                        <td class="col-9 tenSanPham">
                                                                                            <a>{{ $item->sanPham->ten_san_pham }}</a>
                                                                                            <p>Phân loại hàng:
                                                                                                <span
                                                                                                    class="phanLoaiHang">{{ $item->bienThe->kich_co }},
                                                                                                    {{ $item->bienThe->ten_mau }}</span>.
                                                                                            </p>
                                                                                            <p style="color: #000">
                                                                                                x{{ $item->so_luong }}</p>
                                                                                        </td>
                                                                                        <td class="col-3 giaTienLS"
                                                                                            style="text-align: right">
                                                                                            <span>{{ number_format($item->thanh_tien, 0, ',', '.') }}đ</span>
                                                                                            <span><del>{{ number_format($item->sanPham->gia_san_pham * $item->so_luong, 0, ',', '.') }}đ</del></span>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        <p class="thanhTien">Thành tiền:
                                                                            <span>{{ number_format($itemDonHang->tong_thanh_toan, 0, ',', '.') }}đ</span>
                                                                        </p>
                                                                        <div class="btnDonMua">
                                                                            <button class="btn btn-primary muaLai">Mua
                                                                                lại</button>
                                                                            <a href="{{ route('lien-he.lien-he') }}"
                                                                                class="btn btn-outline-secondary">Liên hệ
                                                                                Shop</a>
                                                                        </div>
                                                                    </div><!-- End .cart-table-container -->
                                                                </div><!-- End .col-lg-8 -->
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
                        {{-- chi tiet don hang --}}
                        <div class="tab-pane fade" id="order-details" role="tabpanel" aria-labelledby="address-tab">
                            <div class="dashboard-right-box">
                                <div class="row gy-3 order-details">
                                    <div class="header">
                                        <a class="back">
                                            <i class="fas fa-arrow-left" style="margin-right: 5px;"></i>
                                            <span>TRỞ LẠI</span>
                                        </a>
                                        <p class="maDH">
                                            <span>MÃ ĐƠN HÀNG:
                                                <span class="maDonHang">240508SN4RTJ5M</span>
                                            </span> |
                                            <span class="thongBaoDonHang"></span>
                                        </p>
                                    </div>
                                    <div class="timeline">
                                        <div class="step zezo">
                                            <i class=""></i>
                                            <span></span>
                                        </div>
                                        <div class="step one">
                                            <i class="fas fa-file-alt"></i>
                                            <span>Đơn Hàng Đã Đặt</span>
                                        </div>
                                        <div class="step two">
                                            <i class="fa-solid fa-clock"></i>
                                            <span>Đang chuẩn bị hàng</span>
                                        </div>
                                        <div class="step three">
                                            <i class="fas fa-truck"></i>
                                            <span>Đã Giao Cho ĐVC</span>
                                        </div>
                                        <div class="step four">
                                            <i class="fas fa-box-open"></i>
                                            <span>Đã Nhận Hàng</span>
                                        </div>
                                        <div class="step five">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Đơn Hàng Đã Hoàn Thành</span>
                                        </div>
                                    </div>

                                    <div class="van-chuyen">
                                        <div class="address">
                                            <h3>Địa Chỉ Nhận Hàng</h3>
                                            <p class="ten-nhan-hang">Nguyễn Đình Cường</p>
                                            <p class="sdt-nhan">(+84) 964426158</p>
                                            <p class="dia-chi-nhan">Nhà Văn Hóa phú Hữu, Phú Hữu 1, Xã Phú Nghĩa, Huyện
                                                Chương Mỹ, Hà Nội</p>
                                        </div>

                                        <div class="delivery-status">
                                            <h3>Trạng Thái</h3>
                                            <div class="trang-thai">

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Thêm phần thông tin sản phẩm và thanh toán -->
                                    <div class="product-info">
                                        <div class="product-info-header">
                                            <span class="chatLS">💬 Chat</span>
                                            <a href="{{ route('san-pham.san-pham') }}" class="shopLS"><i
                                                    class="fas fa-box"></i> Xem cửa hàng</a>
                                        </div>
                                        <div class="list-san-pham">

                                        </div>

                                        <table class="table">
                                            <tr class="tongTienHang">
                                                <th>Tổng tiền hàng</th>
                                                <td>50.700 VNĐ</td>
                                            </tr>
                                            <tr class="phiVanChuyen">
                                                <th>Phí vận chuyển</th>
                                                <td>16.500 VNĐ</td>
                                            </tr>
                                            <tr class="giamGiaVanChuyen">
                                                <th>Giảm giá phí vận chuyển</th>
                                                <td>-15.000 VNĐ</td>
                                            </tr>
                                            <tr class="giamGiaDonHang">
                                                <th>Voucher giảm giá</th>
                                                <td>-15.210 VNĐ</td>
                                            </tr>
                                            <tr class="namadXu">
                                                <th>Namad xu</th>
                                                <td>-15.210 VNĐ</td>
                                            </tr>
                                            <tr class="thanhTien">
                                                <th>Thành tiền</th>
                                                <td class="price">36.990 VNĐ</td>
                                            </tr>
                                            <tr class="phuongThucThanhToan">
                                                <th>Phương thức thanh toán</th>
                                                <td>Ship COD</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="action-button">

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Địa chỉ --}}
                        <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                            <div class="dashboard-right-box">
                                <div class="address-tab">
                                    <div class="sidebar-title">
                                        <div class="loader-line"></div>
                                        <h4>Địa chỉ của tôi</h4>
                                    </div>
                                    <div class="row gy-3 dia-chi-item">
                                        <input type="hidden" class="tokenThietLap" name="_token"
                                            value="{{ csrf_token() }}" />
                                        @foreach ($dia_chis as $item)
                                            <div class="col-xxl-4 col-md-6">
                                                <div class="address-option">
                                                    <label for="address-billing-0">
                                                        <span class="delivery-address-box">
                                                            <span class="address-detail" style="width: 100%">
                                                                <span class="address">
                                                                    <span
                                                                        class="address-title">{{ $item->ho_va_ten_nhan }}</span>
                                                                </span>
                                                                <span class="address">
                                                                    <span class="address-home">
                                                                        <span class="address-tag">Địa chỉ :</span>
                                                                        <p class="dia-chi" style="display: inline">
                                                                            @if ($item->dia_chi_chi_tiet)
                                                                                {{ $item->dia_chi_chi_tiet }},
                                                                            @endif
                                                                            {{ $item->phuongXa?->ten_phuong_xa }},
                                                                            {{ $item->quanHuyen?->ten_quan_huyen }},
                                                                            {{ $item->tinhThanhPho?->ten_tinh_thanh_pho }}
                                                                        </p>
                                                                    </span>
                                                                </span>
                                                                <span class="address">
                                                                    <span class="address-home">
                                                                        <span class="address-tag">Số điện thoại :</span>
                                                                        <p class="so-dien-thoai" style="display: inline">
                                                                            {{ $item->so_dien_thoai_nhan }}
                                                                        </p>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                        <span class="buttons">
                                                            <button class="btn btn_outline sm thietLapDiaChiMacDinh"
                                                                data-id="{{ $item->id }}"
                                                                {{ $item->trang_thai == 1 ? 'disabled' : '' }}>Thiết lập
                                                                mặc
                                                                định</button>
                                                        </span>
                                                        <span class="buttons actionsDiaChi">
                                                            <a class="btn btn_black sm suaDiaChi"
                                                                data-id="{{ $item->id }}" href="javascript:void(0)"
                                                                title="edit" tabindex="0">Sửa
                                                            </a>
                                                            @if ($item->trang_thai != 1)
                                                                <a class="btn btn_outline sm btnDelete"
                                                                    data-id="{{ $item->id }}"
                                                                    href="javascript:void(0)" title="delete">Xóa
                                                                </a>
                                                            @endif
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div><button class="btn add-address" data-bs-toggle="modal"
                                        data-bs-target="#add-address" title="Thêm địa chỉ" tabindex="0">+ Thêm địa chỉ
                                        mới</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Chỉnh sửa thông tin tài khoản --}}
        <div class="reviews-modal modal theme-modal fade" id="edit-box" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Chỉnh sửa thông tin địa chỉ</h4><button class="btn-close" type="button"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="row g-3">
                            <div class="col-6 hoVaTen">
                                <div class="from-group">
                                    <label class="form-label">Họ và tên</label>
                                    <input class="form-control" type="text" placeholder="Nhập họ và tên...">
                                </div>
                                <p class="text-danger"></p>
                            </div>
                            <div class="col-6 soDienThoai">
                                <div class="from-group ">
                                    <label class="form-label">Số điện thoại</label>
                                    <input class="form-control" type="text" placeholder="Nhập số điện thoại...">
                                </div>
                                <p class="text-danger"></p>
                            </div>
                            <div class="col-12 tinhThanhPho">
                                <label class="form-label" for="tinh_thanh_pho">Chọn Tỉnh/Thành phố</label>
                                <select class="form-select" name="tinh_thanh_pho">
                                    <option value="">--Chọn tỉnh thành phố--</option>
                                </select>
                                <p class="text-danger"></p>
                            </div>
                            <div class="col-6 quanHuyen">
                                <label class="form-label" for="quan_huyen">Chọn Quận/Huyện</label>
                                <select class="form-select" name="quan_huyen">
                                    <option value="">--Chọn quận huyện--</option>
                                </select>
                                <p class="text-danger"></p>
                            </div>
                            <div class="col-6 phuongXa">
                                <label class="form-label" for="phuong_xa">Chọn Phường/Xã/Thị trấn</label>
                                <select class="form-select" name="phuong_xa">
                                    <option value="">--Chọn phường xã--</option>
                                </select>
                                <p class="text-danger"></p>
                            </div>
                            <div class="col-12 diaChiChiTiet">
                                <label class="form-label">Ghi địa chỉ cụ thể (VD: số nhà, ngõ ngách, xóm...)</label>
                                <textarea cols="5" rows="4" class="form-control form-control-sm"></textarea>
                            </div>
                            <input type="hidden" class="tokenSuaDiaChi" name="_token" value="{{ csrf_token() }}" />
                            <button class="btn btn-submit mt-3">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Đổi mật khẩu --}}
        <div class="reviews-modal modal theme-modal fade" id="edit-password" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>ĐỔI MẬT KHẨU</h4><button class="btn-close" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-0">
                        <form id="resetPasswordForm" action="{{ route('tai-khoan.doi-mat-khau') }}" method="post">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="from-group password">
                                        <label class="form-label">Nhập mật khẩu hiện tại</label>
                                        <input class="form-control inputPassword" type="password" name="current_password"
                                            placeholder="Nhập mật khẩu hiện tại...">
                                        <span class="toggle-password">
                                            <i class="fas fa-eye-slash"></i>
                                        </span>
                                    </div>
                                    <p class="Err text-danger current_password-error">
                                        @error('current_password')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div class="from-group password">
                                        <label class="form-label">Nhập mật khẩu mới</label>
                                        <input class="form-control inputPassword" type="password" name="new_password"
                                            placeholder="Nhập mật khẩu mới...">
                                        <span class="toggle-password">
                                            <i class="fas fa-eye-slash"></i>
                                        </span>
                                    </div>
                                    <p class="Err text-danger new_password-error">
                                        @error('new_password')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div class="from-group password">
                                        <label class="form-label">Nhập lại mật khẩu mới</label>
                                        <input class="form-control inputPassword" type="password" name="confirm_password"
                                            placeholder="Nhập lại mật khẩu mới...">
                                        <span class="toggle-password">
                                            <i class="fas fa-eye-slash"></i>
                                        </span>
                                    </div>
                                    <p class="Err text-danger confirm_password-error">
                                        @error('confirm_password')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <button class="btn btn-submit mt-3" type="submit" onsubmit="ajaxResetPassword()">Xác
                                    nhận</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Nhập địa chỉ mới --}}
        <div class="reviews-modal modal theme-modal fade" id="add-address" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Địa chỉ mới</h4><button class="btn-close" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-0">
                        <form id="themDiaChiMoi" action="{{ route('tai-khoan.them-dia-chi-moi') }}" method="POST">
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
                                            <option value="{{ $item->ma_tinh_thanh_pho }}">
                                                {{ $item->ten_tinh_thanh_pho }}</option>
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
                                    <select class="form-select @error('phuong_xa') is-invalid @enderror"
                                        id="them_phuong_xa" name="phuong_xa">
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
                                <button class="btn btn-submit mt-3" type="submit" onsubmit="ajaxThemDiaChi()">Xác
                                    nhận</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Đánh giá --}}
        <div class="reviews-modal modal theme-modal fade" id="reviews" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document" style="max-width: 850px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Đánh giá sản phẩm</h4><button class="btn-close" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-0">
                        {{-- ****** --}}
                        <div class="row">
                            <div class="thongBao">
                                <img src="/assets/images/coin.png" alt="coin">
                                <p>Chia sẻ cảm nhận của bạn về tất cả sản phẩm trong cùng đơn hàng với tối thiểu 50 ký tự
                                    cùng
                                    ít nhất 1 hình ảnh (trên một sản phẩm) để nhận 200 Namad Xu. Lưu ý: Nếu đánh giá có nội
                                    dung không phù hợp
                                    Namad xu sẽ bị thu hồi cùng với đánh giá của bạn sẽ bị xóa.
                                </p>
                            </div>
                        </div>
                        {{-- ***** --}}

                        <div class="main">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('assets/js/thongTinTaiKhoan.js') }}"></script>
@endsection
