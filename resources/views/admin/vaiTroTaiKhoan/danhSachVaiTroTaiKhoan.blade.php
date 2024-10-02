@extends('admin.layout.main')
@section('containerAdmin')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách vai trò tài khoản</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-secondary btn-sm" onclick="">Chọn tất cả</button>
            <button type="button" class="btn btn-secondary btn-sm" onclick="">Bỏ chọn tất cả</button>
            <button type="submit" name="xoacacmucchon" class="btn btn-secondary btn-sm">Khóa các tài khoản đã
                chọn</button>
            <a href="{{ route('admin.vai-tro-tai-khoan.trang-them') }}"><button type="button" class="btn btn-secondary btn-sm">Nhập thêm</button></a>
            <div class="float-right">
                <div class="input-group">
                    <input type="text" class="form-control" name="kyw" placeholder="Tìm kiếm...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="search">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th class="col-1 text-center align-middle"><input type="checkbox" name="select[]" value=""></th>
                            <th>ID</th>
                            <th>Vai trò của tài khoản</th>
                            <th>Ngày tạo</th>
                            <th>Ngày sửa</th>
                            <th class="col-1 text-center align-middle">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vai_tros as $item)
                            <tr>
                                <td class="align-middle text-center"><input type="checkbox" name="select[]" value=""></td>
                                <td class="col-1 align-middle">{{ $item->id }}</td>
                                <td class="col-2 align-middle">{{ $item->vai_tro }}</td>
                                <td class="col-2">{{ $item->created_at }}</td>
                                <td class="col-2">{{ $item->updated_at }}</td>
                                <td class="col-2 text-center align-middle">
                                    @if ($item->id == 1) {{-- 1 là id vai trò admin, 2 là nhân viên, 3 là người dùng --}}
                                        <button class="btn btn-sm" disabled>Không được chỉnh sửa</button>
                                    @else
                                        @if ($item->id == 2 || $item->id == 3)
                                            <a href="{{ route('admin.vai-tro-tai-khoan.trang-sua', $item->id) }}">
                                                <button type="button" class="btn btn-secondary btn-sm">Sửa</button>
                                            </a> |
                                            <a href="">
                                                <button type="button" class="btn btn-secondary btn-sm" onclick="" disabled>Xoá</button>
                                            </a>
                                        @else
                                            <a href="{{ route('admin.vai-tro-tai-khoan.trang-sua', $item->id) }}">
                                                <button type="button" class="btn btn-secondary btn-sm">Sửa</button>
                                            </a> |
                                            <a href="">
                                                <button type="button" class="btn btn-secondary btn-sm" onclick="">Xoá</button>
                                            </a>
                                        @endif
                                    @endif
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