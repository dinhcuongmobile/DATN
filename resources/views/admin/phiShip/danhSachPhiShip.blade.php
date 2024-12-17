@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách phí giao hàng ({{$phi_ships->count()}})</h1>
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
                    <form action="{{ route('phi-ship.danh-sach') }}" method="GET">
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
                <form action="{{ route('phi-ship.xoa-nhieu') }}" method="post">
                    @csrf
                    <div class="float-left">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="chontatca()">Chọn tất cả</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="bochontatca()">Bỏ chọn tất
                            cả</button>
                        <button onclick="return confirm('Bạn chắc chắn muốn xóa các phí ship đã chọn ?')" type="submit"
                            class="btn btn-secondary btn-sm">Xóa các mục đã chọn</button>
                        <a href="{{ route('phi-ship.them-phi-ship') }}" class="btn btn-secondary btn-sm">Nhập thêm</a>
                    </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Tỉnh thành phố</th>
                                <th>Quận huyện</th>
                                <th>Phí ship</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($phi_ships->count() > 0)
                                @foreach ($phi_ships as $index => $item)
                                    <tr>
                                        <td class="col-1 align-middle text-center"><input type="checkbox" name="select[]"
                                                value="{{ $item->id }}"></td>
                                        <td class="col-1 align-middle">{{ $index + 1 }}</td>
                                        <td class="col-3 align-middle">{{ $item->tinhThanhPho->ten_tinh_thanh_pho }}</td>
                                        <td class="col-3 align-middle">{{ $item->quanHuyen->ten_quan_huyen }}</td>
                                        <td class="col-2 align-middle">{{ number_format($item->phi_ship, 0, ',', '.') }} VND
                                        </td>
                                        <td class="col-2 align-middle">
                                            <a href="{{ route('phi-ship.sua-phi-ship', $item->id) }}"
                                                class="btn btn-warning btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                <span class="text">Sửa</span>
                                            </a> |
                                            <a onclick="return confirm('Bạn chắc chắn muốn xóa phí ship này ?')"
                                                href="{{ route('phi-ship.delete', $item->id) }}"
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
                                <td colspan="10" class="text-center">Chưa có dữ liệu.</td>
                            @endif
                        </tbody>
                    </table>
                    <div class="phantrang">
                        {{ $phi_ships->links() }}
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
