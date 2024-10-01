@extends('admin.layout.main')
@section('containerAdmin')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="{{ route('admin.danhMuc.create') }}"><h1 class="h3 mb-0 text-gray-800">Thêm mới danh mục</h1></a>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin.danhMuc.store') }}" method="POST" class="form" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Mã loại</label>
                <input type="text" name="" id="" class="form-control" value="NM-" disabled>
            </div>
            <div class="mb-3">
                <label for="hinh_anh" class="form-label">Tải ảnh lên:</label>
                <input type="file" name="hinh_anh" id="hinh_anh" class="form-control-file border">
                @error('hinh_anh')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="ten_danh_muc" class="form-label">Tên danh mục</label>
                <input type="text" name="ten_danh_muc" id="ten_danh_muc" class="form-control" placeholder="Nhập tên danh mục..." value="{{ old('ten_danh_muc') }}">
                @error('ten_danh_muc')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-success">Xác nhận</button>
                <a href="{{ route('admin.danhMuc.DSDanhMuc') }}" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
</div>
</div>
<!-- /.container-fluid -->
@endsection
