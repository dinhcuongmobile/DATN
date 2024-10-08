@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cập nhật Banner</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('banner.update', $old_banner->id) }}" method="post" enctype="multipart/form-data"
                    class="form">
                    @csrf
                    <div class="mb-3">
                        <label for="image" class="form-label">Title :</label>
                        <input type="text" name="ten_anh" class="form-control" value="{{ $old_banner->ten_anh }}">
                        @error('title')
                            <p class="Err mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <img src="{{ Storage::url($old_banner->hinh_anh) }}" width="60px" alt="err">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Ảnh :</label>
                        <input type="file" name="hinh_anh" id="image" class="form-control-file border">
                        @error('hinh_anh')
                            <p class="Err mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sel1">Status</label>
                        <select class="form-control" id="sel1" name="trang_thai">
                            <option value="0" {{ $old_banner->trang_thai == 0 ? 'selected' : '' }}>OFF</option>
                            <option value="1"{{ $old_banner->trang_thai == 1 ? 'selected' : '' }}>ON</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Start_date</label>
                        <input type="datetime-local" name="ngay_bat_dau" class="form-control-file border"
                            value="{{ $old_banner->ngay_bat_dau }}">
                        @error('start_date')
                            <p class="Err mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">End_date</label>
                        <input type="datetime-local" name="ngay_ket_thuc" class="form-control-file border"
                            value="{{ $old_banner->ngay_ket_thuc }}">
                        @error('end_date')
                            <p class="Err mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
                        <a href="{{ route('banner.dsBanner') }}"><button type="button" class="btn btn-success">Quay
                                lại</button></a>
                    </div>
                </form>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->
@endsection
