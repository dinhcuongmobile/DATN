@extends('admin.layout.main')
@section('containerAdmin')
<div class="container-fluid">  
    
    <h1 class="h3 mb-2 text-gray-800">Đơn Hủy (2)</h1>  
    <div class="card shadow mb-4"> 
        <div class="card-header py-3">
            <div class=" float-right">
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
            <form action="" method="post">
    
                <div class="float-left">
                    <button type="button" class="btn btn-secondary btn-sm" >Chờ Xác Nhận</button>
                    <button type="button" class="btn btn-secondary btn-sm" >Chờ Lấy Hàng</button>
                    <button type="submit" class="btn btn-secondary btn-sm" >Đang Giao</button>
                    <button type="submit" class="btn btn-secondary btn-sm">Đơn Hủy</button> 
                    <button type="submit" class="btn btn-secondary btn-sm">Trả Hàng/Hoàn Tiền</button> 
                </div>
            </form>
        </div> 
        <div class="card-body">  
            <div class="table-responsive">  
                <div class="d-flex justify-content-between mb-3">  
                    <div>  
                        <strong>Tên khách hàng: th.lie</strong>  
                    </div>  
                    <div>  
                        <strong>Mã đơn hàng: 2411122SUHDYCS</strong>  
                    </div>  
                </div>  
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">  
                    <thead>  
                        <tr>  
                           
                            <th>Sản phẩm</th>  
                            <th>Tổng cộng</th>  
                            <th>Trạng thái</th>  
                            <th>Đếm ngược</th>  
                            <th>Đơn vị vận chuyển</th>  
                            <th>Thao Tác</th>
                        </tr>  
                    </thead>  
                    <tbody>  
                        <tr>  
                            
                            <td>   
                                gel metal nổi Gulauri 
                                <span class="badge badge-secondary">x1</span>
                                <br>  
                                <small>Variation: Ngọc trai JC 11</small>
                                <br>  
                                gel metal nổi Gulauri 
                                <span class="badge badge-secondary">x1</span>
                                <br>  
                                <small>Variation: Ảnh động JC 13</small>  
                            </td>  
                            <td>₫253.000<br><small>Thanh toán khi nhận hàng</small></td>  
                            <td>Chờ lấy hàng<br><small>Để tránh việc giao hàng trễ</small></td>  
                            <td>Nhanh</td>  
                            <td>SPX Express</td>  
                            <td>
                                <button class="btn btn-primary btn-sm">Xem Chi Tiết</button>
                            </td>
                        </tr>  
                        
                        <!-- Thêm nhiều sản phẩm khác tại đây -->  
                    </tbody>  
                </table>  
            </div>  
        </div>  
    </div>  
    
</div>  
@endsection