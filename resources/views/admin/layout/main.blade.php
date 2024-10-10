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
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/icons/favicon.png') }} ">
    <!-- Custom fonts for this template-->
    <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
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
                <div class="sidebar-brand-text mx-3">Nama Store</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="fas fa-fw fa-house-damage"></i>
                    <span>Home</span>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Quản lý
            </div>

            <!-- Nav Item - Utilities Collapse Menu -->
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

            <!-- Nav Item - Utilities Collapse Menu -->
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
                        <a class="collapse-item" href="" style="background-color: #48dbfb;">
                            <i class="fas fa-fw fa-plus" style="color: #576574;"></i>
                            <span>Thêm mới</span></a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                    aria-expanded="true" aria-controls="collapseFour">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Quản lý sản phẩm</span>
                </a>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{route('san-pham.danh-sach')}}">Danh sách sản phẩm</a>
                        <a class="collapse-item" href="{{route('san-pham.danh-sach-bien-the-san-pham')}}">Quản lý biến thể</a>
                        <a class="collapse-item" href="{{route('san-pham.danh-sach-ma-khuyen-mai')}}">Quản lý khuyến mại</a>
                        <a class="collapse-item" href="{{route('san-pham.danh-sach-san-pham-da-xoa')}}">Thùng rác</a>
                        <a class="collapse-item" href="{{route('san-pham.show-them-san-pham')}}" style="background-color: #48dbfb;">
                            <i class="fas fa-fw fa-plus" style="color: #576574;"></i>
                            <span>Thêm mới</span></a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
                    aria-expanded="true" aria-controls="collapseFive">
                    <i class="fas fa-fw fa-cart-arrow-down"></i>
                    <span>Quản lý đơn hàng</span>
                </a>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Danh sách đơn hàng</a>
                        <a class="collapse-item" href="#">Kiểm duyệt đơn hàng
                            {{-- @if ($sub > 0)
                                <sup style="color: red"><i class="fas fa-fw fa-circle" style="color: red;"></i></sup>
                            @endif --}}
                        </a>
                        <a class="collapse-item" href="#">Danh sách đã giao</a>
                        <a class="collapse-item" href="#">Danh sách đã hủy</a>
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
                        <a class="collapse-item" href="{{ route('tin-tuc.danh-sach') }}">Quản lý tin tức</a>
                        <a class="collapse-item" href="{{ route('banner.dsBanner') }}">Quản lý banner</a>
                        <a class="collapse-item" href="#">Quản lý bình luận</a>
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
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Dinh cuong</span>
                                <i class="fas fa-fw fa-user"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a> -->
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="../controller/index.php" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Thoát
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
                <div class="modal-body">Chọn "Rời khỏi" bên dưới nếu bạn muốn thoát khỏi trang admin.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="#">Rời khỏi</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
    @yield('scripts')

    <!-- Page level plugins -->
    <!-- <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script> -->

    <!-- Page level custom scripts

    <script src="{{asset('admin/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('admin/js/demo/chart-pie-demo.js')}}"></script> -->

</body>

</html>
