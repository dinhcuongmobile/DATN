@extends('admin.layout.main')

@section('containerAdmin')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Cập Nhật Trạng Thái Liên Hệ</h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('lienhe.capNhatTrangThai.post', $lienHe->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Họ & Tên</label>
                        <input type="text" class="form-control" value="{{ $lienHe->ho_va_ten }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" value="{{ $lienHe->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Trạng Thái</label>
                        <input type="text" class="form-control" value="{{ $lienHe->trang_thai == 0 ? 'Chưa Phản Hồi' : 'Đã Phản Hồi' }}" readonly>
                    </div>

                    @if ($lienHe->trang_thai == 0)
                        <button type="submit" class="btn btn-primary">Cập Nhật Trạng Thái</button>
                    @else
                        <button type="button" class="btn btn-secondary" disabled>Đã Phản Hồi, Không Thể Cập Nhật</button>
                    @endif
                </form>
                <a href="{{ route('lienhe.dsLienHe') }}" class="btn btn-danger mt-3">Quay Lại</a>
            </div>
        </div>
    </div>
@endsection
