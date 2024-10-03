@extends('admin.layout.main')
@section('containerAdmin')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách danh mục</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class=" float-right">
                    <form action="#" method="GET">
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
                <a href="{{ route('danh-muc.them-danh-muc') }}" class="btn btn-primary btn-sm">Thêm danh mục mới</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Mã Loại</th>
                                <th>Hình ảnh</th>
                                <th>Tên danh mục</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($danhMucs as $danhMuc)
                            <tr>
                                <td>DM-{{ $danhMuc->id }}</td>
                                <td>
                                    @if($danhMuc->hinh_anh)
                                        <img src="{{Storage::url($danhMuc->hinh_anh)}}" alt="{{ $danhMuc->ten_danh_muc }}" width="100">
                                    @else
                                        Không có hình ảnh
                                    @endif
                                </td>
                                <td>{{ $danhMuc->ten_danh_muc }}</td>
                                <td>
                                    <a href="{{ route('danh-muc.sua-danh-muc', $danhMuc->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                    <a href="{{ route('danh-muc.delete', $danhMuc->id) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-danger btn-sm">Xóa</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
