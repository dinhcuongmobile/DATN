@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách mã khuyến mại đơn hàng ({{$ma_khuyen_mais->count()}})</h1>
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
                    <form action="{{route('khuyen-mai.danh-sach-ma-khuyen-mai-don-hang')}}" method="GET">
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
                <form action="{{route('khuyen-mai.xoa-nhieu-ma-khuyen-mai')}}" method="post">
                    @csrf
                    <div class="float-left">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="chontatca()">Chọn tất cả</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="bochontatca()">Bỏ chọn tất
                            cả</button>
                        <button onclick="return confirm('Bạn chắc chắn muốn xóa các mã khuyến mại này?')"
                        type="submit" class="btn btn-secondary btn-sm">Xóa các mục đã chọn</button>
                        <a href="{{route('khuyen-mai.show-them-ma-khuyen-mai')}}"><button type="button"
                                class="btn btn-secondary btn-sm">Nhập thêm</button></a>
                    </div>
            </div>
            <div class="card-body" id="table_sp">
                <div class="table-responsive">
                    <table class="table table-bordered danhSachMaKhuyenMai" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th></th>
                                <th>Mã giảm giá</th>
                                <th>Số tiền giảm</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Giá trị tối thiểu</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($ma_khuyen_mais->count() > 0)
                                @foreach ($ma_khuyen_mais as $index => $item)
                                    <tr>
                                        <td class="align-middle text-center"><input type="checkbox" name="select[]" id="" value="{{$item->id}}"></td>
                                        <td class="col-1 align-middle text-danger">{{$item->ma_giam_gia}}</td>
                                        <td class="col-2 align-middle">{{ number_format($item->so_tien_giam, 0, ',', '.') }} VND</td>
                                        <td class="align-middle">{{$item->ngay_bat_dau}}</td>
                                        <td class="align-middle">{{$item->ngay_ket_thuc}}</td>
                                        <td class="col-2 align-middle">{{ number_format($item->gia_tri_toi_thieu, 0, ',', '.') }} VND</td>
                                        @php
                                            $ngayKetThuc = \Carbon\Carbon::parse($item->ngay_ket_thuc);
                                            $ngayHienTai = now();
                                            $tongGiayConLai = $ngayHienTai->diffInSeconds($ngayKetThuc, false);

                                            // Tính giờ, phút, giây còn lại
                                            $gioConLai = floor($tongGiayConLai / 3600);
                                            $phutConLai = floor(($tongGiayConLai % 3600) / 60);
                                            $giayConLai = $tongGiayConLai % 60;
                                        @endphp

                                        @if ($tongGiayConLai > 0 && $tongGiayConLai <= 86400)
                                            <td class="col-2 align-middle text-warning tdHSD">
                                                Sắp kết thúc (còn <span id="hours">0{{ $gioConLai }}</span> : <span id="minutes">{{ $phutConLai }}</span> : <span id="seconds">{{ $giayConLai }}</span>)
                                            </td>
                                        @elseif ($tongGiayConLai > 86400)
                                            <td class="col-1 align-middle text-success">Đang diễn ra</td>
                                        @else
                                            <td class="col-1 align-middle text-muted">Đã hết hạn</td>
                                        @endif
                                        <td class="text-center col-2 align-middle">
                                            <a href="{{route('khuyen-mai.show-sua-ma-khuyen-mai',$item->id)}}" class="btn btn-warning btn-sm">
                                            <span class="icon text-white-50">
                                                    <i class="fas fa-edit"></i>
                                            </span> <span class="text">Sửa</span>
                                            </a> |
                                            <a onclick="return confirm('Bạn chắc chắn muốn xóa mã khuyến mại này?')"
                                            href="{{route('khuyen-mai.xoa-ma-khuyen-mai',$item->id)}}" class="btn btn-danger btn-sm"><span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Xóa</span></a></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="10" class="text-center">Chưa có dữ liệu.</td>
                            @endif
                        </tbody>
                    </table>
                    <div class="phantrang">
                        {{ $ma_khuyen_mais->links() }}
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
