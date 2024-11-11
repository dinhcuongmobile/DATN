@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cập nhật tin tức</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('tin-tuc.update', $tin_tuc->id) }}" method="post" enctype="multipart/form-data"
                    class="form">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="" class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" id="" name="tieu_de"
                            placeholder="Nhập tiêu đề..." value="{{ old('tieu_de', $tin_tuc->tieu_de) }}">
                        @error('tieu_de')
                            <p class="Err mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Ảnh bìa:</label>
                        <input type="file" name="hinh_anh" id="" class="form-control-file border">
                        @error('hinh_anh')
                            <p class="Err mt-1">{{ $message }}</p>
                        @enderror
                        <img src="{{ Storage::url($tin_tuc->hinh_anh) }}" alt="" height="100px">
                    </div>
                    <div class="mb-3">
                        <label for="">Nội dung</label>
                        <textarea class="form-control" rows="10" id="noi_dung" name="noi_dung" placeholder="Nhập nội dung...">{{ old('noi_dung', $tin_tuc->noi_dung) }}</textarea>
                        @error('noi_dung')
                            <p class="Err mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5 ">
                        <label for="">Danh Mục</label>
                        <select class="form-control" name="danh_muc_id" id="">
                            @foreach ($dmTinTuc as $item)
                                <option 
                                    value="{{ $item->id }}" @if ($item->id == $tin_tuc->danh_muc_id) selected @endif>{{ $item->ten_danh_muc }}</option>
                            @endforeach
                        </select>
                        @error('noi_dung')
                            <p class="Err mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" name="submit" class="btn btn-success">Xác nhận</button>
                        <a href="{{ route('tin-tuc.danh-sach') }}"><button type="button" class="btn btn-secondary">Quay
                                lại</button></a>
                    </div>
                </form>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->
@endsection
