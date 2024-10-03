@extends('admin.layout.main')
@section('containerAdmin')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cập nhật thông tin danh mục</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('danh-muc.update', $danhMuc->id) }}" method="post" class="form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="maLoai" class="form-label">Mã loại</label>
                    <input type="text" name="maLoai" id="maLoai" class="form-control" value="NM-{{ $danhMuc->id }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="hinhAnh" class="form-label">Tải ảnh lên:</label>
                    <input type="file" name="hinh_anh" id="hinhAnh" class="form-control-file border">
                    @if ($danhMuc->hinh_anh)
                        <div class="mt-2">
                            <img src="{{ Storage::url($danhMuc->hinh_anh) }}" alt="{{ $danhMuc->ten_danh_muc }}" width="100">
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="tendm" class="form-label">Tên danh mục</label>
                    <input type="text" name="ten_danh_muc" id="tendm" class="form-control" value="{{ $danhMuc->ten_danh_muc }}" placeholder="Nhập tên danh mục...">
                </div>
                <div>
                    <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
                    <a href="{{ route('danh-muc.danh-sach') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
