@extends('admin.layout.main')
@section('containerAdmin')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cập nhật thông tin</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="#" method="post" class="form">
                
                <div class="mb-4">
                    <label for="" class="form-label">Mã đơn hàng</label>
                    <input type="text" id="" class="form-control" value="DH-id" disabled>
                </div>
                <div class="mb-3">
                    
                        <img src="#" alt="" height="60px">
                        <span style="margin-left:15px;">Áo Sơ Mi</span>
                        <span style="margin-left:80px;">Số lượng x 1</span>
                        <span style="margin-left:100px;">Thành tiền: 210.000đ</span>
                        <hr>
                    
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="" class="form-label">Họ và tên</label>
                        <input type="text" id="" class="form-control" value="Tống Hoàng Bách" onkeydown="return false">
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Số điện thoại</label>
                        <input type="text" id="" class="form-control" value="0917261473" onkeydown="return false">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="" class="form-label">Địa chỉ</label>
                        <input type="text" id="" class="form-control" value="Bắc Giang" onkeydown="return false">
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">ngày đặt hàng</label>
                        <input type="text" id="" class="form-control" value="5/11/2024" onkeydown="return false">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-12">
                        <label for="sel1">Trạng thái giao hàng</label>
                        <select class="form-control" id="sel1" name="trang_thai">
                            <option  value="1">Đơn hàng mới</option>
                            <option  value="2">Chuẩn bị giao hàng cho đơn vị vận chuyển</option>
                            <option  value="3">Đang giao hàng</option>
                            <option value="4">Đã giao</option>
                        </select>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success">Xác nhận</button>
                    <a href=""><button type="button" class="btn btn-success">Quay lại</button></a>
                </div>
            </form>
        </div>
    </div>


    </div>
    <!-- /.container-fluid -->
@endsection
