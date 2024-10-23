@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh Sách Đã Phản Hồi</h1>
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
                <form action="" method="post">
                    @csrf
                    <div class="float-left">
                        <a href="{{ route('lienhe.dsLienHe') }}" class="btn btn-secondary btn-sm">Danh Sách Tất Cả</a>
                        <a href="{{ route('lienhe.dsLienHeDaPhanHoi') }}" class="btn btn-secondary btn-sm">Danh Sách Đã Phản Hồi</a>
                        <a href="{{ route('lienhe.dsLienHeChuaPhanHoi') }}" class="btn btn-secondary btn-sm">Danh Sách Chưa Phản Hồi</a>
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
                        <div class="alert alert-success" id="alert-message">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>STT</th>
                                <th>Họ & Tên</th>
                                <th>Email</th>
                                <th>Số Điện Thoại</th>
                                <th>Nội Dung Câu Hỏi</th>
                                <th>Trạng Thái</th>
                                <th>Ngày Phản Hồi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dSLienHe as $index => $item)
                                @if($item->trang_thai == 0) <!-- Chỉ hiển thị đã phản hồi -->
                                <tr>
                                    <td class="align-middle text-center">{{ $index + 1 }}</td>
                                    <td class="col-1 align-middle">{{ $item->ho_va_ten }}</td>
                                    <td class="col-1 align-middle">{{ $item->email }}</td>
                                    <td class="col-1 align-middle">{{ $item->so_dien_thoai }}</td>
                                    <td class="col-2 align-middle">{{ $item->noi_dung }}</td>
                                    <td class="col-2 align-middle">
                                        <span class="text-success">Đã Phản Hồi</span>
                                    </td>
                                    <td class="col-2 align-middle">{{ $item->updated_at }}</td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <div class="phantrang">
                        {{ $dSLienHe->links() }}
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <script>
        setTimeout(function() {
            var alert = document.getElementById('alert-message');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 5000); 
    </script>
@endsection
