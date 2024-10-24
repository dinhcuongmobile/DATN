@extends('admin.layout.main')
@section('containerAdmin')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm mới danh mục tin tức</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{route('danh-muc-tin-tuc.add')}}" method="post" class="form" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Mã loại</label>
                <input type="text" name="id" id="" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tên danh mục</label>
                <input type="text" name="ten_danh_muc" id="" class="form-control" placeholder="Nhập tên danh mục..." value="{{old('ten_danh_muc')}}">
                @error('ten_danh_muc')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
                <a href="{{route('danh-muc-tin-tuc.danh-sach')}}"><button type="button" class="btn btn-secondary">Quay lại</button></a>
            </div>
        </form>
    </div>
</div>


</div>
<!-- /.container-fluid -->
@endsection
