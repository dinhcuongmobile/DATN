@extends('admin.layout.main')
@section('containerAdmin')
 <!-- Begin Page Content -->
 <div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Chi Tiết Đơn Hàng</h1>
  <div class="card shadow mb-4">
      <div class="card-body">
          <!-- Thông tin đơn hàng -->
          <div class="row mb-3">
              <div class="col-lg-6">
                <p><strong>Tên Khách Hàng:</strong> {{ $donHang->user->ho_va_ten }}</p>
                  <p><strong>Mã đơn hàng:</strong> {{ $donHang->ma_don_hang }}</p>
                  <p><strong>Địa chỉ nhận hàng:</strong> {{ $donHang->diaChi->dia_chi }}</p>
                  <p><strong>Phương thức thanh toán:</strong> 
                      {{ $donHang->phuong_thuc_thanh_toan == 0 ? 'Ship COD' : 'Chuyển khoản' }}
                  </p>
                  <p><strong>Tổng sản phẩm:</strong> {{ $donHang->chiTietDonHangs->count() }} sản phẩm</p>
              </div>
              <div class="col-lg-6 text-right">
                  <button class="btn btn-primary btn-sm">💬Chat</button>
              </div>
          </div>
          <!-- Thông tin thanh toán -->
          <h5 class="mb-3"><strong>Thông tin thanh toán</strong></h5>
          <div class="table-responsive">
              <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>STT</th>
                          <th>Sản phẩm</th>
                          <th>Đơn Giá</th>
                          <th>Số lượng</th>
                          <th>Thành tiền</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($donHang->chiTietDonHangs as $index => $chiTiet)
                      <tr>
                          <td>{{ $index + 1 }}</td>
                          <td class="col-5">
                              <img src="{{ Storage::url($chiTiet->bienThe->hinh_anh) }}" alt="product" width="10%">
                              <strong>{{ $chiTiet->sanPham->ten_san_pham }}</strong>
                              @if($chiTiet->bienThe)
                              <br><small>Phân loại: {{ $chiTiet->bienThe->kich_co }}, {{ $chiTiet->bienThe->ten_mau }}</small>
                              @endif
                          </td>
                          <td>{{ number_format($chiTiet->don_gia, 0, ',', '.') }}đ</td>
                          <td>{{ $chiTiet->so_luong }}</td>
                          <td>{{ number_format($chiTiet->thanh_tien, 0, ',', '.') }}đ</td>
                      </tr>
                      @endforeach
                  </tbody>
                  <tfoot>
                      <tr>
                          <td colspan="4" class="text-right"><strong>Tổng tiền sản phẩm:</strong></td>
                          <td>{{ number_format($tongTienSanPham, 0, ',', '.') }}đ</td>
                      </tr>
                      <tr>
                          <td colspan="4" class="text-right"><strong>Giảm giá vận chuyển:</strong></td>
                          <td>{{ number_format($phiVanChuyen, 0, ',', '.') }}đ</td>
                      </tr>
                      <tr>
                          <td colspan="4" class="text-right"><strong>Giảm giá đơn hàng:</strong></td>
                          <td>{{ number_format($giamGiaDonHang, 0, ',', '.') }}đ</td>
                      </tr>
                      <tr>
                          <td colspan="4" class="text-right"><strong>Tổng thanh toán:</strong></td>
                          <td class="text-danger"><strong>{{ number_format($tongThanhToan, 0, ',', '.') }}đ</strong></td>
                      </tr>
                  </tfoot>
              </table>
              <div class="col-lg-13 text-right">
                <a href="{{ url()->previous() }}">
                    <button class="btn btn-secondary btn-sm">Quay Lại</button>
                </a>
            </div>
          </div>
      </div>
  </div>
</div>
<!-- /.container-fluid -->
@endsection
