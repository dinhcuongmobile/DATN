@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Trang chủ quản trị</h1>
        </div>

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h4 class="font-weight-bold text-primary text-center mt-3">Thống Kê Doanh Thu</h4>
                    </div>

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <form autocomplete="off" class="d-flex flex-wrap">
                            @csrf
                            <div class="col-md-3 ">
                                <p class="alert alert-info text-center">
                                    <strong>Tổng Đơn Hàng:</strong> <span id="so-don-hang">0</span>
                                </p>
                                <p class="alert alert-info text-center">
                                    <strong>Tổng Doanh Thu:</strong> <span id="tong_thanh_toan">0 đ</span>
                                </p>
                            </div>
                            <div class="col-md-3">
                                <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
                                <button type="button"
                                    class="btn btn-success form-control align-items-center justify-content-center col-6"
                                    id="btn-dashboard-filter">
                                    <i class="fas fa-filter mr-2"></i> Lọc
                                </button>
                            </div>
                            <div class="col-md-3">
                                <p>Đến ngày: <input type="text" id="datepicker2" class="form-control" >
                                </p>
                            </div>
                            <div class="col-md-3">
                                <p>
                                    Lọc theo:
                                    <select class="dashboard-filter-by form-control" id="dashboard-filter-by">
                                        <option value="30ngay">--Chọn--</option>
                                        <option value="7ngay">7 ngày qua</option>
                                        <option value="thangNay">Tháng này</option>
                                        <option value="thangTruoc">Tháng trước</option>
                                        <option value="365NgayQua">365 ngày qua</option>
                                    </select>
                                </p>
                            </div>
                        </form>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <div id="chart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Thứ hạng sản phẩm -->
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Thứ Hạng Sản Phẩm</h6>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="product-ranking-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="by-sales-tab" data-toggle="pill" href="#by-sales" role="tab">Theo Doanh Số</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="product-ranking-tabContent">
                            <div class="tab-pane fade show active" id="by-sales" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Thứ Hạng</th>
                                                <th>Thông Tin Sản Phẩm</th>
                                                <th>Doanh Thu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($thongKeSanPhams as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <img src="{{Storage::url($item->hinh_anh)}}" alt="err" height="60px">
                                                        {{ $item->ten_san_pham }}
                                                    </td>
                                                    <td>{{ $item->tong_doanh_thu }} VND</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Thứ hạng ngành hàng -->
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Thứ Hạng Danh Mục</h6>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="industry-ranking-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="by-sales-industry-tab" data-toggle="pill" href="#by-sales-industry" role="tab">Theo Doanh Số</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="industry-ranking-tabContent">
                            <div class="tab-pane fade show active" id="by-sales-industry" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Thứ Hạng</th>
                                                <th>Danh Mục</th>
                                                <th>Doanh Thu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($thongKeDanhMucs as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <img src="{{Storage::url($item->hinh_anh)}}" alt="err" height="60px">
                                                        {{ $item->ten_danh_muc }}
                                                    </td>
                                                    <td>{{ $item->tong_doanh_thu }} VND</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            load30Ngay();

            var chart = new Morris.Area({
                // ID of the element in which to draw the chart.
                element: 'chart',

                lineColors: ['#0090F7', '#FF970D'],
                pointFillColors: ['#ffffff'],
                pointStrokeColors: ['black'],
                // Chart data records -- each entry in this array corresponds to a point on
                fillOpacity: 0.3,
                hideHover: 'auto',
                parseTime: false,
                behaveLikeLine: true,
                // the chart.

                // The name of the data record attribute that contains x-values.
                xkey: 'ngay_ban',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['tong_don_hang', 'tong_thanh_toan'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Đơn hàng', 'Doanh thu']
            });

            function load30Ngay() {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('thong-ke.load-30-ngay') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        chart.setData(data.chart_data);

                        // Đổ tổng tiền thanh toán vào view
                        $('#tong_thanh_toan').text(data.tong_doanh_thu.toLocaleString() + ' đ');

                        // Đổ tổng số đơn hàng vào view
                        $('#so-don-hang').text(data.so_don_hang.toLocaleString());
                    }
                });
            }

            $('.dashboard-filter-by').change(function() {
                var _token = $('input[name="_token"]').val();
                var dashboardValue = $(this).val();

                $.ajax({
                    url: "{{ route('thong-ke.thong-ke-doanh-so-by') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        dashboardValue: dashboardValue,
                        _token: _token
                    },
                    success: function(data) {
                        chart.setData(data.chart_data);

                        // Đổ tổng tiền thanh toán vào view
                        $('#tong_thanh_toan').text(data.tong_doanh_thu.toLocaleString() + ' đ');

                        // Đổ tổng số đơn hàng vào view
                        $('#so-don-hang').text(data.so_don_hang.toLocaleString());
                    }
                });
            })

            $('#btn-dashboard-filter').click(function() {
                var _token = $('input[name="_token"]').val();
                var fromDate = $('#datepicker').val();
                var toDate = $('#datepicker2').val();

                $.ajax({
                    url: "{{ route('thong-ke.thong-ke-doanh-so') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        fromDate: fromDate,
                        toDate: toDate,
                        _token: _token
                    },
                    success: function(data) {
                        chart.setData(data.chart_data);

                        // Đổ tổng tiền thanh toán vào view
                        $('#tong_thanh_toan').text(data.tong_doanh_thu.toLocaleString() + ' đ');

                        // Đổ tổng số đơn hàng vào view
                        $('#so-don-hang').text(data.so_don_hang.toLocaleString());
                    }
                });
            })
        })
        $(document).on('click', '#btn-xem-them-danh-muc', function () {
        let offset = $(this).data('offset');
        let limit = $(this).data('limit');
    });
    </script>
@endsection
