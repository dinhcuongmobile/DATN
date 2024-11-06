@extends('admin.layout.main')
@section('containerAdmin')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cập nhật phí ship giao hàng</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{route('phi-ship.update',$phi_ships->id)}}" method="post" class="form">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="tinh_thanh_pho">Chọn Tỉnh/Thành phố</label>
                <select class="form-control" id="tinh_thanh_pho" name="ma_tinh_thanh_pho">
                    <option value="">--Chọn tỉnh thành phố--</option>
                    @foreach ($tinh_thanh_pho as $item)
                        <option {{old('ma_tinh_thanh_pho',$phi_ships->ma_tinh_thanh_pho)==$item->ma_tinh_thanh_pho?'selected':''}} value="{{$item->ma_tinh_thanh_pho}}">{{$item->ten_tinh_thanh_pho}}</option>
                    @endforeach
                </select>
                @error('ma_tinh_thanh_pho')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="quan_huyen">Chọn Quận/Huyện</label>
                <select class="form-control" id="quan_huyen" name="ma_quan_huyen">
                    <option value="">--Chọn quận huyện--</option>
                    @foreach ($quan_huyen as $item)
                        <option {{ old('ma_quan_huyen',$phi_ships->ma_quan_huyen) == $item->ma_quan_huyen ? 'selected' : ''}}
                            value="{{ $item->ma_quan_huyen }}">{{ $item->ten_quan_huyen }}
                        </option>
                    @endforeach
                </select>
                @error('ma_quan_huyen')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Phí giao hàng:</label>
                <input type="hidden" name="phi_ship" id="tienJSHidden">
                <input type="text" id="tienJSDisplay" class="form-control" placeholder="Nhập phí ship..." oninput="formatCurrency()" value="{{$phi_ships->phi_ship}}">
                @error('phi_ship')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
                <a href="{{route('phi-ship.danh-sach')}}"><button type="button" class="btn btn-secondary">Quay lại</button></a>
            </div>
        </form>
    </div>
</div>


</div>
<!-- /.container-fluid -->
@endsection
