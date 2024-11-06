@extends('admin.layout.main')
@section('containerAdmin')
 <!-- Begin Page Content -->
 <div class="container-fluid">
    <div class="card shadow">
        <div class="card-header">
            <h3 class="text-center" style="color: #000">Thông tin khách hàng</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="col-3">Tống Hoàng Bách</td>
                    <td class="col-2">0917261473</td>
                    <td class="col-3">bachthph35279@fpt.edu.vn</td>
                    <td class="col-4">Bắc Giang</td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>

    <div class="card shadow mt-5">
        <div class="card-header">
            <h3 class="text-center" style="color: #000">Thông tin vận chuyển hàng</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Tên người vận chuyển</th>
                    <th>SDT nhận hàng</th>
                    <th>Địa chỉ nhận hàng</th>
                    <th>Ghi chú</th>
                    <th>Hình thức thanh toán</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="col-2">Tống hoàng bách</td>
                    <td class="col-2">0917261473</td>
                    <td class="col-3">Bắc Giang</td>
                    <td class="col-3"></td>
                    
                        <td class="col-2">Ship code</td>
                    
                        <td class="col-2">Thanh toán online</td>
                   
                  </tr>
                </tbody>
              </table>
        </div>
    </div>

    <div class="card shadow mt-5">
        <div class="card-header">
            <h3 class="text-center" style="color: #000">Liệt kê chi tiết đơn hàng</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>Phí ship</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                  </tr>
                </thead>
                <tbody>
                    
                        <tr>
                            <td>1</td>
                            <td class="col-4">Áo Sơ Mi</td>
                            <td class="col-2">0đ</td>
                            <td class="col-2">SL : 1</td>
                            <td class="col-2">298.000đ</td>
                            <td class="col-2">210.000đ</td>
                        </tr>
                    
                </tbody>
              </table>
        </div>
    </div>

    <div class="">
        <a target="_blank" href="#" class="btn btn-success mt-5 mb-5 float-right">In hóa đơn</a>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
