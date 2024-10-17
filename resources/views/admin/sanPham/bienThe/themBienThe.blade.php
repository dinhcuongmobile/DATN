@extends('admin.layout.main')
@section('containerAdmin')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm mới biến thể sản phẩm</h1>
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
        <form action="{{route('san-pham.them-bien-the-san-pham')}}" method="post" class="form" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Kích cỡ</label>
                <div class="">
                    <input type="hidden" id="kich_co_hidden" name="kich_co" value="">
                    @foreach ($kich_cos as $item)
                        <input type="button" class="btn btn-outline-primary kich_co_btn" value="{{$item->kich_co}}">
                    @endforeach
                </div>
                @error('kich_co')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Màu sắc</label>
                <div class="">
                    <input type="hidden" id="ten_mau_hidden" name="ten_mau" value="">
                    <input type="hidden" id="ma_mau_hidden" name="ma_mau" value="">
                    @foreach ($mau_sacs as $item)
                    <input type="button" class="btn btn-outline-primary mau_sac_btn" style="background-color: {{$item->ma_mau}}; color:#fff;" data-color="{{$item->ma_mau}}" value="{{$item->ten_mau}}">
                    @endforeach
                </div>
                @error('ten_mau')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tải ảnh lên:</label>
                <input type="file" name="hinh_anh" id="" class="form-control-file border">
                @error('hinh_anh')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Số lượng</label>
                <input type="text" class="form-control" id="" name="so_luong" placeholder="Nhập số lượng..." value="{{old('so_luong')}}">
                @error('so_luong')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="sel1">Sản phẩm</label>
                <select class="form-control" id="sel1" name="san_pham_id">
                    @foreach ($san_phams as $item)
                        <option {{old('san_pham_id')==$item->id?'selected':''}} value="{{$item->id}}">NM-{{$item->id}} | {{$item->ten_san_pham}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
                <a href="{{route('san-pham.danh-sach-bien-the-san-pham')}}"><button type="button" class="btn btn-secondary">Quay lại</button></a>
            </div>
        </form>
    </div>
</div>


</div>
<!-- /.container-fluid -->
@endsection
