<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/icon_web.png') }} ">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
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
            @if (Auth::guard('admin')->user()->vai_tro_id == 1)
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
            @endif

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
                        @if (Auth::guard('admin')->user()->vai_tro_id == 1)
                            <a class="collapse-item" href="{{ route('danh-muc.danh-sach-danh-muc-da-xoa') }}">Thùng rác</a>
                        @endif
                        <a class="collapse-item" href="{{ route('danh-muc.them-danh-muc') }}"
                            style="background-color: #48dbfb;">
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
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('san-pham.danh-sach') }}">Danh sách sản phẩm</a>
                        <a class="collapse-item" href="{{ route('san-pham.danh-sach-bien-the-san-pham') }}">Danh sách
                            biến thể</a>
                        <a class="collapse-item" href="{{ route('san-pham.quan-ly-size') }}">Quản lý size</a>
                        <a class="collapse-item" href="{{ route('san-pham.quan-ly-mau-sac') }}">Quản lý màu sắc</a>
                        @if (Auth::guard('admin')->user()->vai_tro_id == 1)
                            <a class="collapse-item" href="{{ route('san-pham.danh-sach-san-pham-da-xoa') }}">Thùng
                                rác</a>
                        @endif
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
                <div id="collapseEight" class="collapse" aria-labelledby="headingEight"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item"
                            href="{{ route('khuyen-mai.danh-sach-ma-khuyen-mai-don-hang') }}">Khuyến mại đơn hàng</a>
                        <a class="collapse-item"
                            href="{{ route('khuyen-mai.danh-sach-ma-khuyen-mai-van-chuyen') }}">Khuyến mại vận
                            chuyển</a>
                        <a class="collapse-item" href="{{ route('khuyen-mai.show-them-ma-khuyen-mai') }}"
                            style="background-color: #48dbfb;">
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
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('don-hang.danh-sach-don-hang') }}">Danh Sách Đơn Hàng
                        </a>
                        <a class="collapse-item" href="{{ route('don-hang.danh-sach-kiem-duyet') }}">Xác Nhận Đơn
                            Hàng
                            @if ($sub > 0)
                                <sup style="color: red"><i class="fas fa-fw fa-circle" style="color: red;"></i></sup>
                            @endif
                        </a>
                        <a class="collapse-item" href="{{ route('don-hang.danh-sach-cho-lay-hang') }}">Danh Sách Chờ
                            Lấy Hàng </a>
                        <a class="collapse-item" href="{{ route('don-hang.danh-sach-dang-giao') }}">Danh Sách Đang
                            Giao </a>
                        <a class="collapse-item" href="{{ route('don-hang.danh-sach-da-giao') }}">Danh Sách Đã
                            Giao</a>
                        <a class="collapse-item" href="{{ route('don-hang.danh-sach-da-chuyen-khoan') }}">Danh Sách
                            Chuyển Khoản</a>
                        <a class="collapse-item" href="{{ route('don-hang.danh-sach-da-huy') }}">Danh Sách Đã Hủy</a>
                    </div>
                </div>
            </li>

            <!-- quan ly danh gia -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
                    aria-expanded="true" aria-controls="collapseSix">
                    <i class="fas fa-fw fa-star"></i>
                    <span>Quản lý đánh giá</span>
                </a>
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('danh-gia.danh-sach') }}">Danh sách</a>
                        <a class="collapse-item" href="{{ route('danh-gia.chua-phan-hoi') }}">Danh sách chưa phản hồi</a>
                        <a class="collapse-item" href="{{ route('danh-gia.da-phan-hoi') }}">Danh sách đã phản hồi</a>
                        <a class="collapse-item" href="{{ route('danh-gia.danh-sach-bi-an') }}">Danh sách bị ẩn</a>
                    </div>
                </div>
            </li>

            <!-- quan ly tin tuc -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSevent"
                    aria-expanded="true" aria-controls="collapseSevent">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Quản lý tin tức</span>
                </a>
                <div id="collapseSevent" class="collapse" aria-labelledby="headingSix" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('danh-muc-tin-tuc.danh-sach') }}">Danh mục tin
                            tức</a>
                        <a class="collapse-item" href="{{ route('tin-tuc.danh-sach') }}">Danh sách tin tức</a>
                        <a class="collapse-item"
                            href="{{ route('danh-muc-tin-tuc.danh-sach-danh-muc-da-xoa') }}">Thùng rác</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- quan ly doanh thu nhan vien -->
            <li class="nav-item mb-3">
                <a class="nav-link" href="{{ route('thong-ke.doanh-thu-nhan-vien') }}">
                    <i class="fas fa-chart-line"></i>
                    @if (Auth::guard()->user()->vai_tro_id == 1)
                        <span>Doanh thu nhân viên</span>
                    @else
                        <span>Doanh thu của tôi</span>
                    @endif
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item  mb-3">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNine"
                    aria-expanded="true" aria-controls="collapseNine">
                    <i class="fas fa-fw fa-bars"></i>
                    <span>Chức năng khác</span>
                </a>
                <div id="collapseNine" class="collapse" aria-labelledby="headingSevent"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('phi-ship.danh-sach') }}">Quản lý phí vận chuyển</a>
                        <a class="collapse-item" href="{{ route('banner.dsBanner') }}">Quản lý banner</a>
                        <a class="collapse-item" href="{{ route('lien-he.danh-sach') }}">Quản lý liên hệ</a>
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
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter" id="notificationCounter">{{$countThongBao}}+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown" style="width: 25rem !important">
                                <h6 class="dropdown-header">Thông Báo</h6>
                                <div id="notificationContent">

                                </div>
                                <a class="dropdown-item text-center small text-gray-500" style="cursor: pointer"
                                    data-toggle="modal" data-target="#showAllAlertsModal">Hiển Thị tất cả</a>
                            </div>
                        </li>
                        <!-- Modal -->
                        <div class="modal fade" id="showAllAlertsModal" tabindex="-1" role="dialog" aria-labelledby="showAllAlertsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showAllAlertsModalLabel">Tất cả thông báo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="modalNotificationContent">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <li class="nav-item dropdown no-arrow mx-1 liMessagesDropdown">
                            <a class="nav-link dropdown-toggle" id="messagesDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">{{$countMessage}}+</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in divMessagesDropdown"
                                 aria-labelledby="messagesDropdown" style="width: 350px; max-height: 600px; overflow-y: auto;">
                                <h6 class="dropdown-header">
                                    Tin nhắn
                                </h6>
                                <div id="messageContent">
                                </div>

                            </div>
                        </li>

                        <!-- Khu vực chat -->
                        <div class="chat-popup" id="chatPopup" data-userid="{{Auth::guard('admin')->user()->id}}">
                            <div class="chat-header">
                                <span class="chat-title"></span>
                                <span class="close" onclick="closeChat()">&times;</span>
                            </div>
                            <div class="chat-body">
                            </div>
                            <div class="chat-footer">
                                <input type="text" placeholder="Nhập tin nhắn..." id="chatInput" />
                                <button>Gửi</button>
                            </div>
                        </div>
                        {{-- @vite(['resources/js/app.js']) --}}
                        <script src="{{ asset('admin/js/chat.js') }}"></script>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('admin')->user()->ho_va_ten }}</span>
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
                        <span>Copyright &copy; Namad Store</span>
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
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('assets/js/ajax.js') }}"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
    @yield('scripts')

    <!-- Page level plugins -->
    <!-- <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script> -->

    <!-- Page level custom scripts

    <script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('admin/js/demo/chart-pie-demo.js') }}"></script> -->
    {{-- Css Modal Thông Báo --}}
</body>

</html>
