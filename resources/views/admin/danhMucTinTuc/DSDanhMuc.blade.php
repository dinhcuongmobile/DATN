@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách danh mục ({{$DSDanhmuc->count()}})</h1>
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
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class=" float-right">
                    <form action="{{ route('danh-muc-tin-tuc.danh-sach') }}" method="GET">
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
                <form action="{{ route('danh-muc-tin-tuc.xoa-nhieu') }}" method="post">
                    @csrf
                    <div class="float-left">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="chontatca()">Chọn tất cả</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="bochontatca()">Bỏ chọn tất
                            cả</button>
                        <button onclick="return confirm('Chuyển các danh mục này vào thùng rác. Các sản phẩm trong danh mục cũng sẽ bị xóa?')" type="submit"
                            class="btn btn-secondary btn-sm">Xóa các mục đã chọn</button>
                        <a href="{{ route('danh-muc-tin-tuc.them-danh-muc-tin-tuc') }}" class="btn btn-secondary btn-sm">Nhập thêm</a>
                    </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th></th>
                                <th>Mã loại</th>
                                <th>Tên danh mục</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($DSDanhmuc->count() > 0)
                                @foreach ($DSDanhmuc as $item)
                                    <tr>
                                        <td class="col-1 text-center"><input type="checkbox" name="select[]"
                                                value="{{ $item->id }}"></td>
                                        <td class="col-2 align-middle">NM-{{ $item->id }}</td>
                                        <td class="align-middle">{{ $item->ten_danh_muc }}</td>
                                        <td class="col-2 align-middle">
                                            <a href="{{ route('danh-muc-tin-tuc.danh-muc', $item->id) }}"
                                                class="btn btn-warning btn-icon-split btn-sm">

                                                <span class="icon text-white-50">
                                                    <i class="fas fa-edit"></i>
                                            </span>
                                            <span class="text">Sửa</span>
                                            </a> |
                                            <a  onclick="return confirm('Chuyển danh mục này vào thùng rác. Các sản phẩm trong danh mục cũng sẽ bị xóa?')"
                                                href="{{ route('danh-muc-tin-tuc.delete', $item->id) }}"
                                                class="btn btn-danger btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Xóa</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="5" class="text-center">Chưa có dữ liệu.</td>
                            @endif
                        </tbody>
                    </table>
                    <div class="phantrang">
                        {{ $DSDanhmuc->links() }}
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
