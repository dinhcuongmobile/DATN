@extends('admin.layout.main')
@section('containerAdmin')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cập nhật mã khuyến mại cho sản phẩm</h1>
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
        <form action="{{route('san-pham.sua-ma-khuyen-mai',$khuyen_mai->id)}}" method="post" class="form">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="" class="form-label">Mã giảm giá</label>
                <input type="text" class="form-control" name="ma_giam_gia" placeholder="VD: ABCXYZ123..." value="{{old('ma_giam_gia',$khuyen_mai->ma_giam_gia)}}">
                @error('ma_giam_gia')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Số tiền giảm</label>
                <input type="text" class="form-control" name="so_tien_giam" placeholder="Nhập Số tiền giảm..." value="{{old('so_tien_giam',$khuyen_mai->so_tien_giam)}}">
                @error('so_tien_giam')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Ngày bắt đầu</label>
                <input type="date" class="form-control" name="ngay_bat_dau" value="{{old('ngay_bat_dau',$khuyen_mai->ngay_bat_dau)}}">
                @error('ngay_bat_dau')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Ngày kết thúc</label>
                <input type="date" class="form-control" name="ngay_ket_thuc" value="{{old('ngay_ket_thuc',$khuyen_mai->ngay_ket_thuc)}}">
                @error('ngay_ket_thuc')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Giá trị tối thiểu</label>
                <input type="text" class="form-control" name="gia_tri_toi_thieu" placeholder="Nhập Giá trị tối thiểu..." value="{{old('gia_tri_toi_thieu',$khuyen_mai->gia_tri_toi_thieu)}}">
                @error('gia_tri_toi_thieu')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="sel1">Sản phẩm</label>
                <select class="form-control" id="sel1" name="san_pham_id">
                    @foreach ($san_phams as $item)
                        <option {{old('san_pham_id',$khuyen_mai->san_pham_id)==$item->id?'selected':''}} value="{{$item->id}}">SP-{{$item->id}} | {{$item->ten_san_pham}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
                <a href="{{route('san-pham.danh-sach-ma-khuyen-mai')}}"><button type="button" class="btn btn-success">Quay lại</button></a>
            </div>
        </form>
    </div>
</div>


</div>
<!-- /.container-fluid -->
@endsection
