@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thêm banner mới</h1>
        </div>
        @if (session('error'))
            <div class="alert alert-danger" id="alert-message">
                {{ session('error') }}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('banner.storeBanner') }}" method="post" enctype="multipart/form-data" class="form">
                    @csrf
                    <div class="mb-3">
                        <label for="image" class="form-label">Title :</label>
                        <input type="text" name="ten_anh" class="form-control">
                        @error('ten_anh')
                            <p class="Err mt-1">{{ $message }}</p>
                        @enderror
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
                            <option value="0">OFF</option>
                            <option value="1">ON</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Start_date</label>
                        <input type="datetime-local" name="ngay_bat_dau" class="form-control-file border">
                        @error('ngay_bat_dau')
                            <p class="Err mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">End_date</label>
                        <input type="datetime-local" name="ngay_ket_thuc" class="form-control-file border">
                        @error('ngay_ket_thuc')
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
    <script>
        // Đoạn mã này sẽ ẩn thông báo sau 5 giây
        setTimeout(function() {
            var alert = document.getElementById('alert-message');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 5000); // 5000 ms = 5 giây
    </script>
@endsection
