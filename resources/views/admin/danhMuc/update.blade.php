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
        <form action="#" method="post" class="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="" class="form-label">Mã loại</label>
                <input type="text" name="" id="" class="form-control" value="" disabled>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tải ảnh lên:</label>
                <input type="file" name="hinh_anh" id="" class="form-control-file border">
            </div>
            <div class="mb-3">
                <label for="tendm" class="form-label">Tên danh mục</label>
                <input type="text" name="ten_danh_muc" id="tendm" class="form-control" value="" placeholder="Nhập tên danh mục...">
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
                <a href="#"><button type="button" class="btn btn-success">Quay lại</button></a>
            </div>
        </form>
    </div>
</div>


</div>
<!-- /.container-fluid -->
@endsection
