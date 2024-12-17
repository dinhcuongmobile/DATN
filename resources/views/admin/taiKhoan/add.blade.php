@extends('admin.layout.main')
@section('containerAdmin')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm mới tài khoản</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('tai-khoan.add') }}" method="post" class="form">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" name="ho_va_ten" placeholder="Nhập họ và tên..." value="{{ old('ho_va_ten') }}">
                    @error('ho_va_ten')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="VD: example@gmail.com..." value="{{ old('email') }}">
                    @error('email')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 password">
                    <label for="" class="form-label">Mật Khẩu</label>
                    <input type="password" class="form-control inputPassword" name="password" placeholder="VD: Example123...">
                    <span class="toggle-password">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                    @error('password')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6 password">
                    <label for="" class="form-label">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control inputPassword" name="confirm_password">
                    <span class="toggle-password">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                    @error('confirm_password')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" name="so_dien_thoai" placeholder="Nhập số điện thoại..." value="{{ old('so_dien_thoai') }}">
                    @error('so_dien_thoai')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="tinh_thanh_pho">Chọn Tỉnh/Thành phố</label>
                    <select class="form-control" id="tinh_thanh_pho" name="tinh_thanh_pho">
                        <option value="">--Chọn tỉnh thành phố--</option>
                        @foreach ($tinh_thanh_pho as $item)
                            <option value="{{$item->ma_tinh_thanh_pho}}">{{$item->ten_tinh_thanh_pho}}</option>
                        @endforeach
                    </select>
                    @error('tinh_thanh_pho')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="sel1">Vai Trò</label>
                    <select class="form-control" id="sel1" name="vai_tro_id">
                        @if (Auth::guard('admin')->user()->id == 1)
                            @foreach ($vai_tro as $item)
                                <option {{$item->id==old('vai_tro_id')?'selected':''}} value="{{$item->id}}">{{$item->vai_tro}}</option>
                            @endforeach
                        @else
                            @foreach ($vai_tro as $item)
                                @if ($item->vai_tro !== "Quản trị viên")
                                <option {{$item->id==old('vai_tro_id')?'selected':''}} value="{{$item->id}}">{{$item->vai_tro}}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-3"  id="style_quan_huyen">
                    <label for="quan_huyen">Chọn Quận/Huyện</label>
                    <select class="form-control" id="quan_huyen" name="quan_huyen">
                        <option value="">--Chọn quận huyện--</option>
                    </select>
                    @error('quan_huyen')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-3" id="style_phuong_xa">
                    <label for="phuong_xa">Chọn Phường/Xã/Thị trấn</label>
                    <select class="form-control" id="phuong_xa" name="phuong_xa">
                        <option value="">--Chọn phường xã--</option>
                    </select>
                    @error('phuong_xa')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6"></div>
                <div class="col-md-6" id="style_dia_chi_chi_tiet">
                    <label>Ghi địa chỉ cụ thể (VD: số nhà, ngõ ngách, xóm...) <span class="text-danger"></span></label>
                    <textarea name="dia_chi_chi_tiet" id="dia_chi_chi_tiet" cols="5" rows="4" class="form-control form-control-sm"></textarea>
                    @error('dia_chi_chi_tiet')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
            </div>
        </form>
    </div>
</div>

</div>
@endsection
