@extends('admin.layout.main')
@section('containerAdmin')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm mới tài khoản</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('tai-khoan.add') }}" method="post" class="form">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" id="" name="ho_va_ten" placeholder="Nhập họ và tên..." value="{{ old('ho_va_ten') }}">
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
                <div class="col-md-6">
                    <label for="" class="form-label">Mật Khẩu</label>
                    <input type="password" class="form-control" id="" name="password" placeholder="VD: Example123...">
                    @error('password')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control" id="" name="confirm_password">
                    @error('confirm_password')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="" name="so_dien_thoai" placeholder="Nhập số điện thoại..." value="{{ old('so_dien_thoai') }}">
                    @error('so_dien_thoai')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="" name="dia_chi" placeholder="Nhập địa chỉ..." value="{{ old('dia_chi') }}">
                    @error('dia_chi')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="sel1">Vai Trò</label>
                    <select class="form-control" id="sel1" name="vai_tro_id">
                        @foreach ($vai_tro as $item)
                            <option {{$item->id==old('vai_tro_id')?'selected':''}} value="{{$item->id}}">{{$item->vai_tro}}</option>
                        @endforeach
                    </select>
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
