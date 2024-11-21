<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/icon_web.png')}} ">
    <!-- Custom fonts for this template-->
    <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink" style="color: #f1c40f;"></i>
                </div>
                <div class="sidebar-brand-text mx-2">Namad Store</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="fas fa-fw fa-house-damage"></i>
                    <span>Trang Chủ</span>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Quản lý
            </div>

            <!-- quan ly tai khoan -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Quản lý tài khoản</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('tai-khoan.danh-sach-QTV') }}">Danh sách quản trị
                            viên</a>
                        <a class="collapse-item" href="{{ route('tai-khoan.danh-sach-NV') }}">Danh sách nhân viên</a>
                        <a class="collapse-item" href="{{ route('tai-khoan.danh-sach-TV') }}">Danh sách người dùng</a>
                        <a class="collapse-item" href="{{ route('tai-khoan.danh-sach-TKK') }}">Tài khoản bị khóa</a>
                        <a class="collapse-item" href="{{ route('tai-khoan.them-tai-khoan') }}"
                            style="background-color: #48dbfb;">
                            <i class="fas fa-fw fa-plus" style="color: #576574;"></i>
                            <span>Thêm mới</span></a>
                    </div>
                </div>
            </li>

           <!-- quan ly danh muc -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Quản lý danh mục</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('danh-muc.danh-sach') }}">Danh sách danh mục</a>
                        <a class="collapse-item" href="{{ route('danh-muc.danh-sach-danh-muc-da-xoa') }}">Thùng rác</a>
                        <a class="collapse-item" href="{{route('danh-muc.them-danh-muc')}}" style="background-color: #48dbfb;">
                            <i class="fas fa-fw fa-plus" style="color: #576574;"></i>
                            <span>Thêm mới</span></a>
                    </div>
                </div>
            </li>

            <!-- quan ly san pham -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                    aria-expanded="true" aria-controls="collapseFour">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Quản lý sản phẩm</span>
                </a>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{route('san-pham.danh-sach')}}">Danh sách sản phẩm</a>
                        <a class="collapse-item" href="{{route('san-pham.danh-sach-bien-the-san-pham')}}">Danh sách biến thể</a>
                        <a class="collapse-item" href="{{route('san-pham.quan-ly-size')}}">Quản lý size</a>
                        <a class="collapse-item" href="{{route('san-pham.quan-ly-mau-sac')}}">Quản lý màu sắc</a>
                        <a class="collapse-item" href="{{route('san-pham.danh-sach-san-pham-da-xoa')}}">Thùng rác</a>
                    </div>
                </div>
            </li>

            <!-- quan ly khuyen mai -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEight"
                    aria-expanded="true" aria-controls="collapseEight">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Quản lý khuyến mại</span>
                </a>
                <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{route('khuyen-mai.danh-sach-ma-khuyen-mai-don-hang')}}">Khuyến mại đơn hàng</a>
                        <a class="collapse-item" href="{{route('khuyen-mai.danh-sach-ma-khuyen-mai-van-chuyen')}}">Khuyến mại vận chuyển</a>
                        <a class="collapse-item" href="{{route('khuyen-mai.show-them-ma-khuyen-mai')}}" style="background-color: #48dbfb;">
                            <i class="fas fa-fw fa-plus" style="color: #576574;"></i>
                            <span>Thêm mới</span></a>
                    </div>
                </div>
            </li>

            <!-- quan ly don hang -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
                    aria-expanded="true" aria-controls="collapseFive">
                    <i class="fas fa-fw fa-cart-arrow-down"></i>
                    <span>Quản lý đơn hàng</span>
                </a>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{route('don-hang.danh-sach-don-hang')}}">Danh Sách Đơn Hàng </a>
                        <a class="collapse-item" href="{{route('don-hang.danh-sach-kiem-duyet')}}">Xác Nhận Đơn Hàng
                            @if ($sub > 0)
                                <sup style="color: red"><i class="fas fa-fw fa-circle" style="color: red;"></i></sup>
                            @endif
                        </a>
                        <a class="collapse-item" href="{{route('don-hang.danh-sach-cho-lay-hang')}}">Danh Sách Chờ Lấy Hàng </a>
                        <a class="collapse-item" href="{{route('don-hang.danh-sach-dang-giao')}}">Danh Sách Đang Giao </a>
                        <a class="collapse-item" href="{{route('don-hang.danh-sach-da-giao')}}">Danh Sách Đã Giao</a>
                        <a class="collapse-item" href="{{route('don-hang.danh-sach-da-huy')}}">Danh Sách Đã Hủy</a>
                        <a class="collapse-item" href="#">Trả Hàng/Hoàn Tiền</a>
                    </div>
                </div>
            </li>

            <!-- quan ly tin tuc -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
                    aria-expanded="true" aria-controls="collapseSix">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Quản lý tin tức</span>
                </a>
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{route('danh-muc-tin-tuc.danh-sach')}}">Danh mục tin tức</a>
                        <a class="collapse-item" href="{{route('tin-tuc.danh-sach')}}">Danh sách tin tức</a>
                        <a class="collapse-item" href="{{route('danh-muc-tin-tuc.danh-sach-danh-muc-da-xoa')}}">Thùng rác</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item  mb-3">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSevent"
                    aria-expanded="true" aria-controls="collapseSevent">
                    <i class="fas fa-fw fa-bars"></i>
                    <span>Chức năng khác</span>
                </a>
                <div id="collapseSevent" class="collapse" aria-labelledby="headingSevent"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('phi-ship.danh-sach') }}">Quản lý phí vận chuyển</a>
                        <a class="collapse-item" href="{{ route('banner.dsBanner') }}">Quản lý banner</a>
                        <a class="collapse-item" href="{{ route('lienhe.dsLienHe') }}">Quản lý liên hệ</a>
                        <a class="collapse-item" href="#">Quản lý đánh giá</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">{{ $donHangMoi->count() + $lienHeMoi->count() + $donHangDaGiao->count() + $lienHeDaPhanHoi->count() }}+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Thông Báo
                                </h6>
                        
                                <!-- Thông báo đơn hàng mới -->
                                @foreach($donHangMoi as $item)
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('don-hang.chi-tiet-don-hang', $item->id) }}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-box text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{ \Carbon\Carbon::parse($item->ngay_tao)->format('d-m-Y')
 }}</div>
                                        <span class="font-weight-bold">Đơn hàng: {{ $item->ma_don_hang }} - Bạn có đơn hàng mới!</span>
                                    </div>
                                </a>
                                @endforeach
                        
                                <!-- Thông báo đơn hàng đã giao -->
                                @foreach($donHangDaGiao as $item)
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('don-hang.chi-tiet-don-hang', $item->id) }}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-truck text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{ \Carbon\Carbon::parse($item->ngay_tao)->format('d-m-Y')
 }}</div>
                                        <span class="font-weight-bold">Đơn hàng: {{ $item->ma_don_hang }} - Đã giao thành công!</span>
                                    </div>
                                </a>
                                @endforeach
                        
                                <!-- Thông báo liên hệ mới -->
                                @foreach($lienHeMoi as $item)
                                <a class="dropdown-item d-flex align-items-center" href="{{route('lienhe.dsLienHeChuaPhanHoi')}}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-comments text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{ $item->created_at }}</div>
                                        <span class="font-weight-bold">Bạn có liên hệ mới từ {{ $item->ho_va_ten }}!</span>
                                    </div>
                                </a>
                                @endforeach
                        
                                <!-- Thông báo liên hệ đã phản hồi -->
                                @foreach($lienHeDaPhanHoi as $item)
                                <a class="dropdown-item d-flex align-items-center" href="{{route('lienhe.dsLienHeDaPhanHoi')}}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-info">
                                            <i class="fas fa-check-circle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{ $item->created_at }}</div>
                                        <span class="font-weight-bold">Liên hệ từ {{ $item->email }} đã được phản hồi!</span>
                                    </div>
                                </a>
                                @endforeach
                        
                                <a class="dropdown-item text-center small text-gray-500" href="#" data-toggle="modal" data-target="#showAllAlertsModal">Hiển Thị Thông Báo</a>
                            </div>
                        </li>
                        <!-- Modal for displaying all notifications -->
                        <div class="modal fade" id="showAllAlertsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tất Cả Thông Báo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                        <!-- Display all the notifications here -->
                                        <!-- Thông báo đơn hàng mới -->
                                        @foreach($donHangMoiAll as $item)
                                        <p><strong>Mã đơn hàng: {{ $item->ma_don_hang }} - Bạn có đơn hàng mới!</strong></p>
                                        <p><small>{{ \Carbon\Carbon::parse($item->ngay_tao)->format('d-m-Y') }}</small></p>
                                        @endforeach

                                        <!-- Thông báo đơn hàng đã giao -->
                                        @foreach($donHangDaGiaoAll as $item)
                                        <p><strong>Mã đơn hàng: {{ $item->ma_don_hang }} - Đã giao thành công!</strong></p>
                                        <p><small>{{ \Carbon\Carbon::parse($item->ngay_tao)->format('d-m-Y') }}</small></p>
                                        @endforeach

                                        <!-- Thông báo liên hệ mới -->
                                        @foreach($lienHeMoiAll as $item)
                                        <p><strong>Liên hệ mới từ: {{ $item->ho_va_ten }}</strong></p>
                                        <p><small>{{ $item->created_at }}</small></p>
                                        @endforeach

                                        <!-- Thông báo liên hệ đã phản hồi -->
                                        @foreach($lienHeDaPhanHoiAll as $item)
                                        <p><strong>Liên hệ từ: {{ $item->email }} đã được phản hồi!</strong></p>
                                        <p><small>{{ $item->created_at }}</small></p>
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="{{asset('admin/img/undraw_profile_1.svg')}}" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="{{asset('admin/img/undraw_profile_2.svg')}}" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="{{asset('admin/img/undraw_profile_3.svg')}}" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->ho_va_ten }}</span>
                                <i class="fas fa-fw fa-user"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('tai-khoan.thong-tin-tai-khoan-admin') }}">
                                    <i class="fas fa-fw fa-user mr-2 text-gray-400"></i>
                                    Tài khoản
                                </a>
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="../controller/index.php" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                @yield('containerAdmin')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc chắn muốn thoát không ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" bên dưới nếu bạn muốn thoát khỏi trang quản trị.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('auth.dang-xuat-admin') }}">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{asset('assets/js/ajax.js')}}"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
    @yield('scripts')

    <!-- Page level plugins -->
    <!-- <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script> -->

    <!-- Page level custom scripts

    <script src="{{asset('admin/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('admin/js/demo/chart-pie-demo.js')}}"></script> -->

</body>

</html>
