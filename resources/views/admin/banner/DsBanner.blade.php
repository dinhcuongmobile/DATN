@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Quản lý banner</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class=" float-right">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="kyw" placeholder="Tìm kiếm...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <form action="{{ route('banner.deleteAll') }}" method="post">
                    @csrf
                    <div class="float-left">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="chontatca()">Chọn tất cả</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="bochontatca()">Bỏ chọn tất
                            cả</button>
                        <button type="submit" class="btn btn-secondary btn-sm">Xóa các mục đã chọn</button>
                        <a href="{{ route('banner.viewAdd') }}">
                            <button type="button" class="btn btn-secondary btn-sm">Nhập
                                thêm
                            </button>
                        </a>
                    </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (session('error'))
                        <div class="alert alert-danger" id="alert-message">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success"id="alert-message">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th></th>
                                <th>STT</th>
                                <th>Title Banner</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Start date</th>
                                <th>End date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($DSBanner as $index => $item)
                                <tr>
                                    <td class="text-center align-middle">
                                        <input type="checkbox" name="select[]" value="{{ $item->id }}">
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ $index + 1 }}

                                    </td>
                                    <td class="col-2 align-middle">
                                        DCM-{{ $item->ten_anh }}

                                    </td>
                                    <td class="col-2 align-middle">
                                        <img src="{{ Storage::url($item->hinh_anh) }}" alt="err" height=60px>
                                    </td>
                                    <td class="col-2 align-middle">
                                        {{ $item->trang_thai == 0 ? 'OFF' : 'ON' }}
                                    </td>
                                    <td class="col-2 align-middle">
                                        {{ $item->ngay_bat_dau }}
                                    </td>
                                    <td class="col-2 align-middle">
                                        {{ $item->ngay_ket_thuc }}
                                    </td>
                                    <td class="col-3 align-middle">
                                        <a href="{{ route('banner.updatebanner', $item->id) }}"
                                            class="btn btn-secondary btn-sm">Cập nhật
                                        </a> |
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa')"
                                            href="{{ route('banner.delete', $item->id) }}"class="btn btn-secondary btn-sm">
                                            Xóa
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="phantrang">
                        {{ $DSBanner->links() }}
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
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
