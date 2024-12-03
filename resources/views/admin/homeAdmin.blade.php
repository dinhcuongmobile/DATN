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
                        <button class="btn view-more-btn" data-toggle="modal" data-target="#viewMoreModalSanPham">Xem thêm</button>
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
                        <button class="btn view-more-btn" data-toggle="modal" data-target="#viewMoreModalDanhMuc">Xem thêm</button>
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
        
        <!-- Modal Xem Thêm Sản Phẩm -->
        <div class="modal fade" id="viewMoreModalSanPham" tabindex="-1" role="dialog" aria-labelledby="viewMoreModalLabelSanPham" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewMoreModalLabelSanPham">Thứ Hạng Sản Phẩm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Nội dung động sẽ được nạp qua AJAX vào đây -->
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Thông tin sản phẩm</th>
                                        <th>Xem sản phẩm</th>
                                        <th>Sản phẩm (Thêm vào giỏ hàng)</th>
                                        <th>Sản phẩm (Đơn đã đã giao)</th>
                                        <th>Doanh thu (Đơn đã đã giao)</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="product-detail-tbody-san-pham">
                                    <!-- Dữ liệu sản phẩm sẽ được nạp qua AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Xem Thêm Danh Mục -->
        <div class="modal fade" id="viewMoreModalDanhMuc" tabindex="-1" role="dialog" aria-labelledby="viewMoreModalLabelDanhMuc" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewMoreModalLabelDanhMuc">Thứ Hạng Danh Mục</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Nội dung động sẽ được nạp qua AJAX vào đây -->
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Thông tin danh mục</th>
                                        <th>Xem danh mục</th>
                                        <th>Sản phẩm (Thêm vào giỏ hàng)</th>
                                        <th>Sản phẩm (Đơn đã đã giao)</th>
                                        <th>Doanh thu (Đơn đã đã giao)</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="product-detail-tbody-danh-muc">
                                    <!-- Dữ liệu danh mục sẽ được nạp qua AJAX -->
                                </tbody>
                            </table>
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
                xkey: 'ngay_cap_nhat',
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

        // Gửi request lấy thông tin thứ hạng danh mục
        $.ajax({
            url: '/admin/xem-them-thu-hang/danh-muc',
            method: 'GET',
            data: { offset: offset, limit: limit },
            success: function (response) {
                let htmlDanhMuc = '';

                // Hiển thị dữ liệu danh mục
                response.danhMucs.forEach(item => {
                    htmlDanhMuc += `
                        <tr>
                            <td>
                                <img src="${item.hinh_anh}" alt="${item.ten_danh_muc}" height="60px">
                                ${item.ten_danh_muc}
                            </td>
                            <td><a href="/san-pham/${item.id}">Xem</a></td>
                            <td><button class="btn btn-primary">Thêm vào giỏ hàng</button></td>
                            <td><button class="btn btn-success">Xác nhận</button></td>
                            <td>${item.tong_doanh_thu} VNĐ</td>
                            <td><button class="btn btn-info">Chi tiết</button></td>
                        </tr>
                    `;
                });

                // Thêm dữ liệu vào bảng trong modal
                $('#product-detail-tbody').html(htmlDanhMuc);

                // Cập nhật offset cho lần gọi tiếp theo
                $('#btn-xem-them-danh-muc').data('offset', offset + limit);
                $('#viewMoreModal').modal('show'); // Hiển thị modal
            },
            error: function() {
                alert('Đã xảy ra lỗi khi tải dữ liệu.');
            }
        });
    });

    $(document).on('click', '#btn-xem-them-san-pham', function () {
        let offset = $(this).data('offset');
        let limit = $(this).data('limit');

        // Gửi request lấy thông tin thứ hạng sản phẩm
        $.ajax({
            url: '/admin/xem-them-thu-hang/san-pham',
            method: 'GET',
            data: { offset: offset, limit: limit },
            success: function (response) {
                let htmlSanPham = '';

                // Hiển thị dữ liệu sản phẩm
                response.sanPhams.forEach(item => {
                    htmlSanPham += `
                        <tr>
                            <td>
                                <img src="${item.hinh_anh}" alt="${item.ten_san_pham}" height="60px">
                                ${item.ten_san_pham}
                            </td>
                            <td><a href="/san-pham/${item.id}">Xem</a></td>
                            <td><button class="btn btn-primary">Thêm vào giỏ hàng</button></td>
                            <td><button class="btn btn-success">Xác nhận</button></td>
                            <td>${item.tong_doanh_thu} VNĐ</td>
                            <td><button class="btn btn-info">Chi tiết</button></td>
                        </tr>
                    `;
                });

                // Thêm dữ liệu vào bảng trong modal
                $('#product-detail-tbody-san-pham').html(htmlSanPham);

                // Cập nhật offset cho lần gọi tiếp theo
                $('#btn-xem-them-san-pham').data('offset', offset + limit);
                $('#viewMoreModal').modal('show'); // Hiển thị modal
            },
            error: function() {
                alert('Đã xảy ra lỗi khi tải dữ liệu.');
            }
        });
    });
    </script>
@endsection
