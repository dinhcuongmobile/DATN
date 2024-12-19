@extends('admin.layout.main')
@section('containerAdmin')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-5">Doanh thu nhân viên</h1>
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
                <form method="GET" action="{{ route('thong-ke.doanh-thu-nhan-vien') }}">
                    <div class="float-left d-flex">
                        @if (Auth::guard('admin')->user()->vai_tro_id !== 2)
                            <div class="input-group col-md-3">
                                <p>Tìm kiếm
                                    <input type="text" class="form-control" name="kyw"
                                        placeholder="Tìm kiếm theo..." value="{{ request('kyw') }}">
                                </p>
                            </div>
                        @endif
                        <div class="col-md-3">
                            <p>Từ ngày: <input type="text" name="tu_ngay" id="datepicker" class="form-control" value="{{ request('tu_ngay') }}"></p>
                        </div>
                        <div class="col-md-3">
                            <p>Đến ngày: <input type="text" name="den_ngay" id="datepicker2" class="form-control" value="{{ request('den_ngay') }}"></p>
                        </div>
                        <div class="col-md-3">
                            <p>
                                Lọc theo:
                                <select class="dashboard-filter-by form-control" id="dashboard-filter-by" name="filter_month">
                                    <option value="thangNay" {{ request('filter_month') == 'thangNay' ? 'selected' : '' }}>Tháng này</option>
                                    <option value="thangTruoc" {{ request('filter_month') == 'thangTruoc' ? 'selected' : '' }}>Tháng trước</option>
                                    <option value="365NgayQua" {{ request('filter_month') == '365NgayQua' ? 'selected' : '' }}>365 ngày qua</option>
                                </select>
                            </p>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button type="submit"
                                class="btn btn-success form-control align-items-center justify-content-center"
                                id="btn-dashboard-filter">
                                <i class="fas fa-filter mr-2"></i> Tìm
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body row">
                <div class="table-responsive col-6">
                    <div class="mb-4">
                        <h4>Doanh thu nhân viên theo ngày</h4>
                    </div>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Mã nhân viên</th>
                                <th>Tên nhân viên</th>
                                <th>Số đơn hàng đã bán</th>
                                <th>Doanh thu</th>
                                <th>Ngày bán</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($doanhThuNhanVien->count() > 0)
                                @foreach ($doanhThuNhanVien as $item)
                                    <tr>
                                        <td class="col-1 align-middle">{{ $item->nguoi_ban }}</td>
                                        <td class="col-2 align-middle">{{ $item->nguoiBan->ho_va_ten }}</td>
                                        <td class="col-1 align-middle">{{ $item->so_don_hang }}</td>
                                        <td class="col-2 align-middle">{{ number_format($item->tong_doanh_thu, 0, ',', '.') }} đ</td>
                                        <td class="col-1 align-middle">{{ $item->ngay_ban }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="10" class="text-center">Không có dữ liệu.</td>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive col-6">
                    <div class="mb-4">
                        <h4>Tổng doanh thu nhân viên</h4>
                    </div>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Mã nhân viên</th>
                                <th>Tên nhân viên</th>
                                <th>Tổng đơn hàng đã bán</th>
                                <th>Tổng doanh thu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($tongDonHang->count() > 0)
                                @foreach ($tongDonHang as $item)
                                    <tr>
                                        <td class="col-1 align-middle">{{ $item->nguoi_ban }}</td>
                                        <td class="col-2 align-middle">{{ $item->nguoiBan->ho_va_ten }}</td>
                                        <td class="col-1 align-middle">{{ $item->tong_so_don_hang }}</td>
                                        <td class="col-2 align-middle">{{ number_format($item->tong_doanh_thu, 0, ',', '.') }} đ</td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="10" class="text-center">Không có dữ liệu.</td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#datepicker").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["Chủ nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"],
            dration: "slow"
        });
        $("#datepicker2").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["Chủ nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"],
            dration: "slow"
        });
    </script>
@endsection
