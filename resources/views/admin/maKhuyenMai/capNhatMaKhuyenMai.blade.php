@extends('admin.layout.main')
@section('containerAdmin')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cập nhật mã khuyến mại</h1>
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
        <form action="{{route('khuyen-mai.sua-ma-khuyen-mai',$khuyen_mai->id)}}" method="post" class="form">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="" class="form-label">Mã giảm giá</label>
                <input type="text" class="form-control" value="{{$khuyen_mai->ma_giam_gia}}" disabled>
                <input type="hidden" name="trang_thai" value="{{$khuyen_mai->trang_thai}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Số tiền giảm</label>
                <input type="text" class="form-control" name="so_tien_giam" placeholder="Nhập Số tiền giảm..." value="{{old('so_tien_giam',$khuyen_mai->so_tien_giam)}}">
                @error('so_tien_giam')
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
            <div>
                <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
            </div>
        </form>
    </div>
</div>


</div>
<!-- /.container-fluid -->
@endsection
