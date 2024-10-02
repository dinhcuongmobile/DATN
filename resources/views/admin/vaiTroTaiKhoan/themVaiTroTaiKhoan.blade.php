@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thêm mới vai trò tài khoản</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('admin.vai-tro-tai-khoan.them') }}" method="post" class="form">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">ID</label>
                        <input type="text" name="id" id="" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="vai_tro" class="form-label">Vai trò tài khoản</label>
                        <input type="text" name="vai_tro" id="vai_tro"
                            class="form-control @error('vai_tro') is-invalid @enderror"
                            placeholder="Nhập tên vai trò tài khoản..." value="{{ old('vai_tro') }}">
                        @error('vai_tro')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
                        <a href="{{ route('admin.vai-tro-tai-khoan.danh-sach') }}"><button type="button" class="btn btn-success">Quay lại</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
