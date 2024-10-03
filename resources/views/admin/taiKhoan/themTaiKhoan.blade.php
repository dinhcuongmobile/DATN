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
                <form action="{{ route('tai-khoan.them') }}" method="post" class="form">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="ho_va_ten" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control @error('ho_va_ten') is-invalid @enderror"
                                id="ho_va_ten" name="ho_va_ten" placeholder="Nhập họ và tên..."
                                value="{{ old('ho_va_ten') }}">
                            @error('ho_va_ten')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="VD: example@gmail.com..." value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>  
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">Mật Khẩu</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="VD: Example123!..."
                                value="{{ old('password') }}">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="dia_chi" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control @error('dia_chi') is-invalid @enderror" id="dia_chi"
                                name="dia_chi" placeholder="Nhập địa chỉ..." value="{{ old('dia_chi') }}">
                            @error('dia_chi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control @error('so_dien_thoai') is-invalid @enderror"
                                id="so_dien_thoai" name="so_dien_thoai" placeholder="Nhập số điện thoại..."
                                value="{{ old('so_dien_thoai') }}">
                            @error('so_dien_thoai')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="vai_tro_id">Vai Trò</label>
                            <select class="form-control @error('vai_tro_id') is-invalid @enderror" id="sel1" name="vai_tro_id">
                                <option selected>--Chọn vai trò--</option>
                                @foreach ($vaiTro as $item)
                                    <option value="{{ $item->id }}" {{ old('vai_tro_id') == $item->id ? 'selected': '' }}>{{ $item->vai_tro }}</option>
                                @endforeach
                            </select>
                            @error('vai_tro_id')
                                <div class="text-danger">{{ $message }}</div>
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
