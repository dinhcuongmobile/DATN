@extends('admin.layout.main')
@section('containerAdmin')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách vai trò tài khoản</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-secondary btn-sm" onclick="">Chọn tất cả</button>
            <button type="button" class="btn btn-secondary btn-sm" onclick="">Bỏ chọn tất cả</button>
            <button type="submit" name="xoacacmucchon" class="btn btn-secondary btn-sm">Khóa các tài khoản đã
                chọn</button>
            <a href=""><button type="button" class="btn btn-secondary btn-sm">Nhập
                    thêm</button></a>
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
                            <th>STT</th>
                            <th>ID</th>
                            <th>Vai trò của tài khoản</th>
                            <th class="col-1 text-center align-middle">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vai_tros as $index => $item)
                            <tr>
                                <td class="align-middle text-center"><input type="checkbox" name="select[]" value=""></td>
                                <td class="col-1 align-middle">{{ $index + 1 }}</td>
                                <td class="col-1 align-middle">{{ $item->id }}</td>
                                <td class="col-3 align-middle">{{ $item->vai_tro }}</td>
                                <td class="col-1 text-center align-middle">
                                    <a href=""><button type="button" class="btn btn-secondary btn-sm">Sửa</button></a> |
                                    <a href="">
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="">Khóa</button>
                                    </a>
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