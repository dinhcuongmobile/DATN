@extends('admin.layout.main')

@section('containerAdmin')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách danh mục đã bị xóa</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="col-1 text-center">Chọn</th>
                        <th class="col-2">Mã loại</th>
                        <th>Ảnh</th>
                        <th>Tên danh mục</th>
                        <th class="col-2">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trashedDanhMucs as $danhMuc)
                    <tr id="danh-muc-{{ $danhMuc->id }}">
                        <td class="col-1 text-center"><input type="checkbox" name="select[]" value="{{ $danhMuc->id }}"></td>
                        <td class="col-2">NM-{{ $danhMuc->id }}</td>
                        <td>
                                    <img src="{{ asset('storage/' . $danhMuc->hinh_anh) }}" alt="{{ $danhMuc->ten_danh_muc }}" width="100">
                                </td>
                        <td>{{ $danhMuc->ten_danh_muc }}</td>
                        <td class="col-3">
                            <form action="{{ route('admin.danhMuc.restore', $danhMuc->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Khôi phục</button>
                            </form>
                            |
                            <form action="{{ route('admin.danhMuc.forceDelete', $danhMuc->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa vĩnh viễn</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
