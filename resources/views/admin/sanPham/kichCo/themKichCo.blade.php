@extends('admin.layout.main')
@section('containerAdmin')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm mới size</h1>
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
        <form action="{{route('san-pham.them-size')}}" method="post" class="form">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Size</label>
                <input type="text" class="form-control" id="" name="kich_co" placeholder="Nhập size..." value="{{old('kich_co')}}">
                @error('kich_co')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
                <a href="{{route('san-pham.quan-ly-size')}}"><button type="button" class="btn btn-secondary">Quay lại</button></a>
            </div>
        </form>
    </div>
</div>


</div>
<!-- /.container-fluid -->
@endsection
