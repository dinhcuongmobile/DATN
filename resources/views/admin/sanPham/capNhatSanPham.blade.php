@extends('admin.layout.main')
@section('containerAdmin')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cập nhật thông tin sản phẩm</h1>
    <div class="mt-3">
        @if (session('success'))
            <div class="alert alert-success" id="error-alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" id="error-alert">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{route('san-pham.sua-san-pham',$san_pham->id)}}" method="post" enctype="multipart/form-data" class="form">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="" name="ten_san_pham" placeholder="Nhập tên sản phẩm..." value="{{old('ten_san_pham',$san_pham->ten_san_pham)}}">
                @error('ten_san_pham')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Giá</label>
                <input type="hidden" name="gia_san_pham" id="tienJSHidden" value="">
                <input type="text" class="form-control" id="tienJSDisplay" placeholder="Nhập giá..." oninput="formatCurrency()" value="{{$san_pham->gia_san_pham}}">
                @error('gia_san_pham')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tải ảnh lên:</label>
                <input type="file" name="hinh_anh" id="" class="form-control-file border">
                @if ($san_pham->hinh_anh)
                    <img class="mt-2" src="{{Storage::url($san_pham->hinh_anh)}}" alt="err" width="120px">
                @endif
                @error('hinh_anh')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Khuyến mãi (%)</label>
                <input type="text" class="form-control" id="" name="khuyen_mai" placeholder="Nhập khuyến mãi..." value="{{old('khuyen_mai',$san_pham->khuyen_mai)}}">
                @error('khuyen_mai')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Mô tả</label>
                <textarea class="form-control" rows="5" id="mo_ta" name="mo_ta" placeholder="Nhập mô tả...">{{old('mo_ta',$san_pham->mo_ta)}}</textarea>
                @error('mo_ta')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="sel1">Danh mục</label>
                <select class="form-control" id="sel1" name="danh_muc_id">
                    @foreach ($danh_mucs as $item)
                        @if ($item->id!=1)
                            <option {{old('danh_muc_id',$san_pham->danh_muc_id)==$item->id?'selected':''}} value="{{$item->id}}">{{$item->ten_danh_muc}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
</div>
<!-- /.container-fluid -->
@endsection
