@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách quản trị viên</h1>
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
                <a href="{{ route('tai-khoan.them-tai-khoan') }}"><button type="button" class="btn btn-secondary btn-sm">Nhập thêm</button></a>
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
                                <th class="col-1 align-middle text-center"><input type="checkbox" name="select[]" value=""></th>
                                <th>MQTV</th>
                                <th>Họ và Tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Vai trò</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($taiKhoan as $index => $item)
                                @if ($item->vai_tro_id == 1)
                                     {{-- vai_tro_id = 1 là tài khoản quản trị viên, 2 là nhân viên, 3 là người dùng --}}
                                    <tr>
                                        @if ($item->id == 1)
                                            <td class="col-1 align-middle text-center"><input type="checkbox" name="select[]" value="" disabled></td>
                                        @else
                                            <td class="col-1 align-middle text-center"><input type="checkbox" name="select[]" value=""></td>
                                        @endif
                                        <td class="col-1 align-middle">QTV-{{ $item->id }}</td>
                                        <td class="col-2 align-middle">{{ $item->ho_va_ten }}</td>
                                        <td class="col-2 align-middle">{{ $item->email }}</td>
                                        <td class="col-1 align-middle">{{ $item->so_dien_thoai }}</td>
                                        <td class="col-3 align-middle">{{ $item->dia_chi }}</td>
                                        <td class="col-1">{{ $item->vaiTro->vai_tro }}</td>
                                        <td class="col-1 align-middle">
                                            <a href="{{ route('tai-khoan.sua-tai-khoan', $item->id) }}">
                                                <button type="button" class="btn btn-secondary btn-sm">Sửa</button>
                                            </a> |
                                            <a href="{{ route('tai-khoan.khoa-tai-khoan', $item->id) }}">
                                                <button type="button" class="btn btn-secondary btn-sm" 
                                                    onclick="return confirm('Xác nhận khóa tài khoản')">Khóa</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
