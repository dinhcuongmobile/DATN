@extends('admin.layout.main')
@section('containerAdmin')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm mới màu sắc</h1>
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
        <form action="{{route('san-pham.them-mau-sac')}}" method="post" class="form">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Tên màu</label>
                <input type="text" class="form-control" id="" name="ten_mau" placeholder="Nhập tên màu..." value="{{old('ten_mau')}}">
                @error('ten_mau')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Mã màu</label>
                <input type="text" class="form-control" id="maMauInput" name="ma_mau" placeholder="Nhập mã màu (VD: #FFFFFF)..." value="{{old('ma_mau','#')}}">
                @error('ma_mau')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3 hienThiMauSac">
                <label for="" class="form-label">Màu hiển thị</label>
                <div id="colorDiv" style="width: 100px; height: 50px; border: 1px solid #ddd;"></div>
            </div>

            <div>
                <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
                <a href="{{route('san-pham.quan-ly-mau-sac')}}"><button type="button" class="btn btn-success">Quay lại</button></a>
            </div>
        </form>
    </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection
