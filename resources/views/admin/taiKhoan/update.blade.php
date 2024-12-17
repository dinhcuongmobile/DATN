@extends('admin.layout.main')
@section('containerAdmin')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cập nhật vai trò tài khoản</h1>
</div>
@if ($tai_khoan->vai_tro_id == 1 && $tai_khoan->id == 1)
    <span>Tài khoản này không được chỉnh sửa</span>
@else
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('tai-khoan.update',$tai_khoan->id)}}" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" value="{{$tai_khoan->ho_va_ten}}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="" class="form-label">Email</label>
                        <input type="text" class="form-control" value="{{$tai_khoan->email}}" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-12">
                        <label for="sel1">Vai Trò</label>
                        <select class="form-control" id="sel1" name="vai_tro_id">
                            @if (Auth::guard('admin')->user()->id == 1)
                                @foreach ($vai_tro as $item)
                                <option {{old('vai_tro_id',$tai_khoan->vai_tro_id)==$item->id?'selected':''}} value="{{$item->id}}">{{$item->vai_tro}}</option>
                                @endforeach
                            @else
                                @foreach ($vai_tro as $item)
                                    @if ($item->vai_tro !== "Quản trị viên")
                                    <option {{old('vai_tro_id',$tai_khoan->vai_tro_id)==$item->id?'selected':''}} value="{{$item->id}}">{{$item->vai_tro}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div>
                    <button onclick="return confirm('Bạn chắc chắn muốn cập nhật vai trò cho tài khoản này?')" type="submit" name="submit" class="btn btn-success">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
@endif


</div>
<!-- /.container-fluid -->
@endsection
