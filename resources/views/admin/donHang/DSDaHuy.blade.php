@extends('admin.layout.main')
@section('containerAdmin')
 <!-- Begin Page Content -->
 <div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách đơn hàng đã hủy</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="float-right">
                    <form action="#" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Tìm kiếm...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th></th>
                                <th>Mã đơn hàng</th>
                                <th>Khách hàng</th>
                                <th>Số lượng</th>
                                <th>Giá trị đơn hàng</th>
                                <th>Tình trạng đơn hàng</th>
                                <th>Ngày đặt hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <td class=" align-middle"><input type="checkbox" name="select[]"
                                    value="#id"></td>
                                <td class="col-1 align-middle">DH-1</td>
                                <td class="col-3 align-middle">
                                    Tống Hoàng Bách <br>
                                    0917261473 <br>
                                    bachthph35279@fpt.edu.vn <br>
                                    Bắc Giang
                                </td>
                                <td class="text-center align-middle">CountDH_id</td>
                                <td  class="col-1 align-middle">198.000đ</td>
                                <td class="col-2 align-middle">5/11/2024</td>
                                <td  class="col-2 align-middle text-success">Đã Hủy</td>
                                <td class="col-2 align-middle text-center"><a href="#" class="btn btn-warning btn-sm">Xem chi tiết</a></td>
                            </tr>
                               
                        </tbody>
                    </table>
                    <div class="phantrang">
                        {{-- {{$don_hangs->links()}} --}}
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- /.container-fluid -->
@endsection
