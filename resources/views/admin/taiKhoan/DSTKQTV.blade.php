@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách tài khoản quản trị viên ({{$DSTKQTV->count()}})</h1>
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
                    <form action="{{ route('tai-khoan.danh-sach-QTV') }}" method="GET">
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
                <form action="{{ route('tai-khoan.select-khoa-TK') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="float-left">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="chontatca()">Chọn tất cả</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="bochontatca()">Bỏ chọn tất
                            cả</button>
                        <button onclick="return confirm('Bạn chắc chắn muốn khóa các tài khoản đã chọn?')" type="submit" class="btn btn-secondary btn-sm">Khóa các tài khoản đã chọn</button>
                        <a href="{{ route('tai-khoan.them-tai-khoan') }}"><button type="button"
                                class="btn btn-secondary btn-sm">Nhập thêm</button></a>
                    </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th></th>
                                <th>MQTV</th>
                                <th>Họ và Tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Vai trò</th>
                                @if (Auth::guard('admin')->user()->id==1)
                                <th class="text-center">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if ($DSTKQTV->count() > 0)
                                @foreach ($DSTKQTV as $item)
                                    <tr>
                                        <td class="align-middle text-center col-1"><input type="checkbox" name="select[]"
                                                value="{{ $item->id }}"></td>
                                        <td class="align-middle col-1">{{ $item->id }}</td>
                                        <td class="col-2 align-middle">{{ $item->ho_va_ten }}</td>
                                        <td class="col-1 align-middle">{{ $item->email }}</td>
                                        <td class="col-1 align-middle">{{ $item->so_dien_thoai }}</td>
                                        <td class="col-1 align-middle"> {{ $item->vaiTro->vai_tro }}</td>
                                        @if (Auth::guard('admin')->user()->id==1)
                                        <td class="col-2 align-middle text-center">
                                            <a href="{{ route('tai-khoan.sua-tai-khoan', $item->id) }}"
                                                class="btn btn-warning btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                <span class="text">Sửa</span>
                                            </a> |
                                            <a onclick="return confirm('Bạn chắc chắn muốn khóa tài khoản này?')"
                                                href="{{ route('tai-khoan.khoa-tai-khoan', $item->id) }}"
                                                class="btn btn-danger btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                                <span class="text">Khóa</span>
                                            </a>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="10" class="text-center">Chưa có dữ liệu.</td>
                            @endif

                        </tbody>
                    </table>
                    <div class="phantrang">
                        {{ $DSTKQTV->links() }}
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
