@extends('admin.layout.main')
@section('containerAdmin')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm tin tức mới</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{route('tin-tuc.add')}}" method="post" enctype="multipart/form-data" class="form">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="" name="tieu_de" placeholder="Nhập tiêu đề..." value="{{old('tieu_de')}}">
                @error('tieu_de')
                <p class="Err mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Ảnh bìa:</label>
                <input type="file" name="hinh_anh" id="" class="form-control-file border">
                @error('hinh_anh')
                <p class="Err mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Nội dung</label>
                <textarea class="form-control" rows="10" id="" name="noi_dung" placeholder="Nhập nội dung...">{{old('noi_dung')}}</textarea>
                @error('noi_dung')
                <p class="Err mt-1">{{$message}}</p>
                @enderror
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
                <a href="{{route('tin-tuc.danh-sach')}}"><button type="button" class="btn btn-success">Quay lại</button></a>
            </div>
        </form>
    </div>
</div>
</div>

<!-- /.container-fluid -->
@endsection
