@extends('admin.layout.main')
@section('containerAdmin')
    <!-- Begin Page Content -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Trang chủ quản trị</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Thành viên</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">1
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Đơn hàng</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cart-arrow-down fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Bình luận</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comment-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Nguời xem</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">1
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-eye fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h4 class="font-weight-bold text-primary text-center mt-3">Thống Kê Doanh Số</h4>
                    </div>

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <form autocomplete="off" class="d-flex">
                            @csrf
                            <div class="col-md-4">
                                <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
                                <input type="button" class="btn btn-success form-control col-md-4" id="btn-dashboard-filter" value="Lọc">
                            </div>
                            <div class="col-md-4">
                                <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    Lọc theo:
                                    <select class="dashboard-filter-by form-control">
                                        <option>--Chọn--</option>
                                        <option value="7ngay">7 ngày qua</option>
                                        <option value="thangTruoc">Tháng trước</option>
                                        <option value="thangNay">Tháng này</option>
                                        <option value="365NgayQua">365 ngày qua</option>
                                    </select>
                                </p>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <div id="chart" style="height: 250px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Biểu Đồ</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas id="myPieChart" width="447" height="306" style="display: block; height: 245px; width: 358px;" class="chartjs-render-monitor"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Direct
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Social
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> Referral
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- /.container-fluid -->
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#datepicker").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: [ "Chủ nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7" ],
            dration: "slow"
        });
        $("#datepicker2").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: [ "Chủ nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7" ],
            dration: "slow"
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            load30Ngay();

            var chart = new Morris.Bar({
                // ID of the element in which to draw the chart.
                element: 'chart',
                // Chart data records -- each entry in this array corresponds to a point on
                hideHover: 'auto',
                parseTime: false,
                // the chart.

                // The name of the data record attribute that contains x-values.
                xkey: 'ngay_dat_hang',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['tong_thanh_toan'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Doanh thu']
            });

            function load30Ngay() {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('thong-ke.load-30-ngay') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {_token:_token},
                    success:function(data) {
                        chart.setData(data);
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
                    data: {dashboardValue:dashboardValue, _token:_token},
                    success:function(data) {
                        chart.setData(data);
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
                    data: {fromDate:fromDate, toDate:toDate, _token:_token},
                    success:function(data) {
                        chart.setData(data);
                    }
                });
            })
        })
    </script>
@endsection
