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
        <form action="{{route('danh-muc.update',$danh_muc->id)}}" method="post" class="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="" class="form-label">Mã loại</label>
                <input type="text" name="" id="" class="form-control" value="{{$danh_muc->id}}" disabled>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Ảnh danh mục</label>
                <input type="file" name="hinh_anh" id="" class="form-control">
                @if ($danh_muc->hinh_anh)
                <img class="mt-2" src="{{Storage::url($danh_muc->hinh_anh)}}" alt="err" width="100px">
                @endif
                @error('hinh_anh')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tendm" class="form-label">Tên danh mục</label>
                <input type="text" name="ten_danh_muc" id="tendm" class="form-control" value="{{$danh_muc->ten_danh_muc}}" placeholder="Nhập tên danh mục...">
                @error('ten_danh_muc')
                    <p class="Err mt-1">{{$message}}</p>
                @enderror
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
                <a href="{{route('danh-muc.danh-sach')}}"><button type="button" class="btn btn-secondary">Quay lại</button></a>
            </div>
        </form>
    </div>
</div>


</div>
<!-- /.container-fluid -->
@endsection
