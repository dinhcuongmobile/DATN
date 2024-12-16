@extends('admin.layout.main')

@section('containerAdmin')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Thông tin tài khoản</h1>
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
            <div class="col-4">
                <!-- Profile Image -->
                <div class="card shadow mb-4">
                    <div class="card-body text-center">
                        <img class="img-profile rounded-circle" src="{{ asset('assets/images/user/12.jpg') }}"
                            alt="User Avatar" width="100">
                        <h5 class="mt-3">{{ Auth::guard('admin')->user()->ho_va_ten }}</h5>
                        <p>{{ Auth::guard('admin')->user()->vaiTro->vai_tro }}</p>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <!-- User Details -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Thông tin cá nhân</h6>
                    </div>
                    <div class="card-body">
                        <h5><strong>Họ và tên:</strong> {{ Auth::guard('admin')->user()->ho_va_ten }}</h5>
                        <h5><strong>Số điện thoại:</strong> {{ Auth::guard('admin')->user()->so_dien_thoai }}</h5>
                        <h5>
                            <strong>Địa chỉ:</strong>
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
                        </h5>
                        <p class="btn btn-primary mt-3" data-toggle="modal" data-target="#editProfileModal">Chỉnh sửa thông tin</p>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Thông tin đăng nhập</h6>
                    </div>
                    <div class="card-body">
                        <h5><strong>Email:</strong> {{ Auth::guard('admin')->user()->email }}</h5>
                        <h5><strong>Mật khẩu:</strong> ●●●●●●</h5>
                        <p class="btn btn-primary mt-3" data-toggle="modal" data-target="#changePassword">Đổi
                            mật khẩu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal User -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Chỉnh sửa thông tin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" action="{{ route('tai-khoan.cap-nhat-thong-tin-tai-khoan-admin') }}"
                        method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="ho_va_ten">Họ và tên</label>
                                <input type="text" class="form-control" id="ho_va_ten" name="ho_va_ten"
                                    value="{{ Auth::guard('admin')->user()->ho_va_ten }}" placeholder="Nhập họ và tên...">
                                <p class="Err text-danger ho_va_ten-error">
                                    @error('ho_va_ten')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group col-6">
                                <label for="so_dien_thoai">Số điện thoại</label>
                                <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai"
                                    value="{{ Auth::guard('admin')->user()->so_dien_thoai }}" placeholder="Nhập số điện thoại...">
                                <p class="Err text-danger so_dien_thoai-error">
                                    @error('so_dien_thoai')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-12">
                                <label for="tinh_thanh_pho">Tỉnh/Thành phố</label>
                                <select class="form-control" id="tinh_thanh_pho" name="tinh_thanh_pho">
                                    <option value="">--Chọn tỉnh thành phố--</option>
                                    @foreach ($tinh_thanh_pho as $item)
                                        <option {{ $dia_chi ? ($item->ma_tinh_thanh_pho === $dia_chi->tinhThanhPho->ma_tinh_thanh_pho ? 'selected' : ''): '' }}
                                            value="{{ $item->ma_tinh_thanh_pho }}">{{ $item->ten_tinh_thanh_pho }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="Err text-danger tinh_thanh_pho-error">
                                    @error('tinh_thanh_pho')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6" id="style_quan_huyen">
                                <label for="quan_huyen">Quận/Huyện</label>
                                <select class="form-control" id="quan_huyen" name="quan_huyen">
                                    <option value="">--Chọn quận huyện--</option>
                                    @foreach ($quan_huyen as $item)
                                        <option {{ $dia_chi ? ($item->ma_quan_huyen === $dia_chi->quanHuyen->ma_quan_huyen ? 'selected' : '') : '' }}
                                            value="{{ $item->ma_quan_huyen }}">{{ $item->ten_quan_huyen }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="Err text-danger quan_huyen-error">
                                    @error('quan_huyen')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="col-md-6" id="style_phuong_xa">
                                <label for="phuong_xa">Phường/Xã/Thị trấn</label>
                                <select class="form-control" id="phuong_xa" name="phuong_xa">
                                    <option value="">--Chọn phường xã--</option>
                                    @foreach ($phuong_xa as $item)
                                        <option {{ $dia_chi ? ($item->ma_phuong_xa === $dia_chi->phuongXa->ma_phuong_xa ? 'selected' : '') :'' }}
                                            value="{{ $item->ma_phuong_xa }}">{{ $item->ten_phuong_xa }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="Err text-danger phuong_xa-error">
                                    @error('phuong_xa')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12" id="style_dia_chi_chi_tiet">
                                <label>Ghi địa chỉ cụ thể (VD: số nhà, ngõ ngách, xóm...) <span
                                        class="text-danger"></span></label>
                                <textarea name="dia_chi_chi_tiet" id="dia_chi_chi_tiet" cols="5" rows="4"
                                    class="form-control form-control-sm @error('dia_chi_chi_tiet') is-invalid @enderror">{{ $dia_chi ? ($dia_chi->dia_chi_chi_tiet) : '' }}</textarea>
                                <p class="Err text-danger dia_chi_chi_tiet-error">
                                    @error('dia_chi_chi_tiet')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary" onsubmit="ajaxAuth()">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Change Password -->
    <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePassword"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Đổi mật khẩu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="resetPasswordForm" action="{{ route('tai-khoan.doi-mat-khau-admin') }}" method="POST">
                        @csrf
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary" onsubmit="ajaxResetPassword()">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
