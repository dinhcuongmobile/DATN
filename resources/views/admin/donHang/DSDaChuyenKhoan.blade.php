@extends('admin.layout.main')
@section('containerAdmin')
<div class="container-fluid">  
    <h1 class="h3 mb-2 text-gray-800">Danh Sách Đã Chuyển Khoản ({{ $donHangs->count() }})</h1>  
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
    <!-- Các nút chức năng và thanh tìm kiếm -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <form action="{{ route('don-hang.danh-sach-da-chuyen-khoan') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Tìm kiếm mã đơn hàng...">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="float-left">
                <a href="{{route('don-hang.danh-sach-kiem-duyet')}}"><button type="button" class="btn btn-secondary btn-sm" >Chờ Xác Nhận</button></a>
                <a href="{{route('don-hang.danh-sach-cho-lay-hang')}}"><button type="button" class="btn btn-secondary btn-sm" >Chờ Lấy Hàng</button></a>
                <a href="{{route('don-hang.danh-sach-dang-giao')}}"><button type="button" class="btn btn-secondary btn-sm" >Đang Giao</button></a>
                <a href="{{route('don-hang.danh-sach-da-giao')}}"><button type="button" class="btn btn-secondary btn-sm" >Đã Giao</button></a>
                <a href="{{route('don-hang.danh-sach-da-huy')}}"><button type="button" class="btn btn-secondary btn-sm">Đơn Hủy</button></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã Đơn Hàng</th>
                            <th>Tên Khách Hàng</th>
                            <th>Tổng Thanh Toán</th>
                            <th>Ngày Thanh Toán</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donHangs as $item)
                            <tr>
                                <td>{{ $item->ma_don_hang }}</td>
                                <td>{{ $item->user->ho_va_ten }}</td>
                                <td>{{ number_format($item->tong_thanh_toan, 0, ',', '.') }} VND</td>
                                <td>{{ \Carbon\Carbon::parse($item->ngay_tao)->format('H:i d/m/Y') }}</td>
                                <td>
                                    <a href="{{route('don-hang.chi-tiet-don-hang', $item->id)}}" class="btn btn-info btn-sm">
                                        Xem Chi Tiết
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
