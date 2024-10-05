@extends('admin.layout.main')
@section('containerAdmin')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cập nhật thông tin</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{route('tai-khoan.update',$tai_khoan->id)}}" method="post" class="form">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" id="" name="ho_va_ten" placeholder="Nhập họ và tên..." value="{{old('ho_va_ten',$tai_khoan->ho_va_ten)}}">
                    @error('ho_va_ten')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="" name="so_dien_thoai" placeholder="Nhập số điện thoại..." value="{{old('so_dien_thoai',$tai_khoan->so_dien_thoai)}}">
                    @error('so_dien_thoai')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tinh_thanh_pho">Chọn Tỉnh/Thành phố</label>
                    <select class="form-control" id="tinh_thanh_pho" name="tinh_thanh_pho">
                        <option value="">--Chọn tỉnh thành phố--</option>
                        @foreach ($tinh_thanh_pho as $item)
                            <option {{$item->ten_tinh_thanh_pho===$tinh_thanh_pho_one?'selected':''}} value="{{$item->ma_tinh_thanh_pho}}">{{$item->ten_tinh_thanh_pho}}</option>
                        @endforeach
                    </select>
                    @error('tinh_thanh_pho')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="quan_huyen">Chọn Quận/Huyện</label>
                    <select class="form-control" id="quan_huyen" name="quan_huyen">
                        <option value="">--Chọn quận huyện--</option>
                        @foreach ($quan_huyen as $item)
                            <option {{$item->ten_quan_huyen===$quan_huyen_one?'selected':''}} value="{{$item->ma_quan_huyen}}">{{$item->ten_quan_huyen}}</option>
                        @endforeach
                    </select>
                    @error('quan_huyen')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="phuong_xa">Chọn Phường/Xã/Thị trấn</label>
                    <select class="form-control" id="phuong_xa" name="phuong_xa">
                        <option value="">--Chọn phường xã--</option>
                        @foreach ($phuong_xa as $item)
                            <option {{$item->ten_phuong_xa===$phuong_xa_one?'selected':''}} value="{{$item->ma_phuong_xa}}">{{$item->ten_phuong_xa}}</option>
                        @endforeach
                    </select>
                    @error('phuong_xa')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Ghi địa chỉ cụ thể (VD: số nhà, ngõ ngách, xóm...)</label>
                    <textarea name="dia_chi_chi_tiet" id="dia_chi_chi_tiet" cols="5" rows="4" class="form-control form-control-sm">{{$dia_chi_chi_tiet}}</textarea>
                    @error('dia_chi_chi_tiet')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="sel1">Vai Trò</label>
                    <select class="form-control" id="sel1" name="vai_tro_id">
                        @foreach ($vai_tro as $item)
                            <option {{old('vai_tro_id',$tai_khoan->vai_tro_id)==$item->id?'selected':''}} value="{{$item->id}}">{{$item->vai_tro}}</option>
                        @endforeach
                    </select>
                </div>
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
