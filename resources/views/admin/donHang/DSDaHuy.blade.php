@extends('admin.layout.main')
@section('containerAdmin')
<div class="container-fluid">  
    
    <h1 class="h3 mb-2 text-gray-800">Danh Sách Đã Hủy ({{ $donHangs->count() }})</h1>  
    
    <!-- Các nút chức năng và thanh tìm kiếm -->
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
            <form action="" method="post">
    
                <div class="float-left">
                    <a href="{{route('don-hang.danh-sach-kiem-duyet')}}"><button type="button" class="btn btn-secondary btn-sm" >Chờ Xác Nhận</button></a>
                    <a href="{{route('don-hang.danh-sach-cho-lay-hang')}}"><button type="button" class="btn btn-secondary btn-sm" >Chờ Lấy Hàng</button></a>
                    <a href="{{route('don-hang.danh-sach-dang-giao')}}"><button type="button" class="btn btn-secondary btn-sm" >Đang Giao</button></a>
                    <a href="{{route('don-hang.danh-sach-da-giao')}}"><button type="button" class="btn btn-secondary btn-sm" >Đã Giao</button></a>
                    <a href="{{route('don-hang.danh-sach-da-huy')}}"><button type="button" class="btn btn-secondary btn-sm">Đơn Hủy</button></a>
                    <button type="button" class="btn btn-secondary btn-sm">Trả Hàng/Hoàn Tiền</button>
                </div>
            </form>
        </div> 
    </div>

    <!-- Hiển thị mỗi đơn hàng trong một bảng riêng -->
    @foreach ($donHangs as $item)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Tên khách hàng và mã đơn hàng -->
            <div class="d-flex justify-content-between mb-3">  
                <div>  
                    <strong>Tên khách hàng: {{ $item->user->ho_va_ten }}</strong>  
                </div>  
                <div>  
                    <strong>Mã đơn hàng: {{ $item->ma_don_hang }}</strong>  
                </div>  
            </div> 
        </div>
        <div class="card-body">  
            <div class="table-responsive"> 
                <table class="table table-bordered" width="100%" cellspacing="0"> 
                    <thead>  
                        <tr>  
                            <th></th>
                            <th>Sản phẩm</th>  
                            <th>Tổng cộng</th>  
                            <th>Trạng thái</th>  
                            <th>Thanh Toán</th>  
                            <th>Đơn vị vận chuyển</th>  
                            <th>Thao Tác</th>
                        </tr>  
                    </thead>  
                    <tbody>  
                        <tr>  
                            <td class="align-middle">
                                <input type="checkbox" name="select[]" value="{{ $item->id }}">
                            </td>
                            <td class="col-4">
                                @foreach($item->chiTietDonHangs as $chiTiet)
                                    <img src="{{ Storage::url($chiTiet->bienThe->hinh_anh) }}" alt="product" width="15%">
                                    {{ $chiTiet->sanPham->ten_san_pham }}
                                    <span class="badge badge-secondary">x{{ $chiTiet->so_luong }}</span>
                                    <br>
                                    <small>Loại: {{ $chiTiet->bienThe->kich_co }}, {{ $chiTiet->bienThe->ten_mau }}</small>
                                    <br>
                                @endforeach
                            </td>
                            <td>{{ number_format($item->tong_thanh_toan, 0, ',', '.') }}₫</td>
                            <td>
                                <p><span style="color:#cc2e2e; background-color: #f0f0f0; padding: 5px; border-radius: 9px;">
                                    @if($item->trang_thai == 0)
                                        Chờ Xác Nhận
                                    @elseif($item->trang_thai == 1)
                                        Chờ Giao Hàng
                                    @elseif($item->trang_thai == 2)
                                        Đang Giao
                                    @elseif($item->trang_thai == 3)
                                        Đã Giao
                                    @elseif($item->trang_thai == 4)
                                        Đã Hủy
                                    @endif
                                </span></p>
                            </td>
                            <td class="col-2">
                                {{ $item->phuong_thuc_thanh_toan == 0 ? 'Thanh toán khi nhận hàng' : 'Chuyển khoản' }}
                            </td>
                            <td class="col-1">
                                <img src="{{asset('assets/images/logos/logo_ghtk.png')}}" width="85px" alt="">
                            </td>
                            <td>
                                  <a href="{{route('don-hang.chi-tiet-don-hang', $item->id)}}" class="btn btn-secondary btn-sm"> 
                                   Xem Chi Tiết
                                  </a>
                            </td>
                        </tr>  
                    </tbody>  
                </table>  
            </div>  
        </div>  
    </div>  
    @endforeach
    
</div>  
@endsection
