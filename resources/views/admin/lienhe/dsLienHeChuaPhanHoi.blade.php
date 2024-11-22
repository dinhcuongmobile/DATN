@extends('admin.layout.main')
@section('containerAdmin')
<style>
    .contact-table {
        border: 1px solid #e3e6f0;
        width: 100%;
    }
    
    .contact-table th,
    .contact-table td {
        border: 1px solid #e3e6f0;
        padding: 12px;
    }
    
    .contact-table th {
        background-color: #f8f9fc;
        width: 200px;
        font-weight: bold;
    }
    
    .contact-card {
        border: 1px solid #e3e6f0;
        border-radius: 5px;
        margin-bottom: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    
    .contact-card .card-body {
        padding: 0;
    }
</style>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh Sách Chưa Phản Hồi</h1>
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
                        <a href="{{ route('lien-he.danh-sach') }}" class="btn btn-secondary btn-sm">Danh Sách Tất Cả</a>
                        <a href="{{ route('lien-he.danh-sach-da-phan-hoi') }}" class="btn btn-secondary btn-sm">Danh Sách Đã Phản Hồi</a>
                        <a href="{{ route('lien-he.danh-sach-chua-phan-hoi') }}" class="btn btn-secondary btn-sm">Danh Sách Chưa Phản Hồi</a>
                    </div>
                </form>
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
                    @foreach ($dSLienHe as $index => $item)
                        <div class="contact-card">
                            <div class="card-body">
                                <table class="contact-table">
                                    <tbody>
                                        <tr>
                                            <th>STT</th>
                                            <td>{{ $index + 1 }}</td>
                                        </tr>
                                        <tr>
                                            <th>Họ & Tên</th>
                                            <td>{{ $item->ho_va_ten }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $item->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Số Điện Thoại</th>
                                            <td>{{ $item->so_dien_thoai }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tiêu Đề</th>
                                            <td>{{ $item->tieu_de }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nội Dung Câu Hỏi</th>
                                            <td>{{ $item->noi_dung }}</td>
                                        </tr>
                                        <tr>
                                            <th>Trạng Thái</th>
                                            <td>
                                                <span class="{{ $item->trang_thai == 0 ? 'text-danger' : 'text-success' }}">
                                                    {{ $item->trang_thai == 0 ? 'Chưa Phản Hồi' : 'Đã Phản Hồi' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Ngày Gửi</th>
                                            <td>{{ $item->created_at }}</td>
                                        </tr>
                                        @if($item->trang_thai == 0)
                                            <tr>
                                               <th>Thao Tác</th>
                                                <td>
                                                    <form action="{{ route('lien-he.phan-hoi', $item->id) }}" method="POST" style="display: inline;" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Bạn có chắc đã phản hồi liên hệ này?')">
                                                            Phản Hồi
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                    <div class="phantrang">
                        {{ $dSLienHe->links() }}
                    </div>
                </div>
            </div>
        </div>
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
