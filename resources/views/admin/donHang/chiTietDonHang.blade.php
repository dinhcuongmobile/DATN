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
                <h5 class="mb-3"><strong>Thông Tin Khách Hàng</strong></h5>
                <p><strong>Tên Khách Hàng:</strong> {{ $donHang->user->ho_va_ten }}</p>
                  <p><strong>Mã Đơn Hàng:</strong> <span style="color: red">{{ $donHang->ma_don_hang }}</span></p>
                  <p><strong>Địa Chỉ Nhận Hàng:</strong> {{ $donHang->diaChi->dia_chi }}</p>
                  <p><strong>Phương Thức Thanh Toán:</strong> 
                    <span style="background-color: #f0f0f0; color: green; padding: 5px; border-radius: 9px;">
                      {{ $donHang->phuong_thuc_thanh_toan == 0 ? 'Thanh Toán Khi Nhận Hàng' : 'Chuyển Khoản' }}
                    </span>
                  </p>
                  <p><strong>Tổng Sản Phẩm:</strong> {{ $donHang->chiTietDonHangs->count() }} Sản Phẩm</p>
                  <p><strong>Ghi Chú : </strong>{{$donHang->ghi_chu}} </p>
              </div>
              <div class="col-lg-6 text-right">
                  <button class="btn btn-primary btn-sm">💬Chat</button>
              </div>
          </div>
          <!-- Thông tin thanh toán -->
          <h5 class="mb-3"><strong>Thông Tin Thanh Toán</strong></h5>
          <div class="table-responsive">
              <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>STT</th>
                          <th>Sản Phẩm</th>
                          <th>Đơn Giá</th>
                          <th>Số Lượng</th>
                          <th>Thành Tiền</th>
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
                              <br><small>Phân Loại: {{ $chiTiet->bienThe->kich_co }}, {{ $chiTiet->bienThe->ten_mau }}</small>
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
                          <td colspan="4" class="text-right"><strong>Tổng Tiền Sản Phẩm:</strong></td>
                          <td>{{ number_format($tongTienSanPham, 0, ',', '.') }}đ</td>
                      </tr>
                      <tr>
                          <td colspan="4" class="text-right"><strong>Giảm Giá Vận Chuyển:</strong></td>
                          <td>-{{ number_format($phiVanChuyen, 0, ',', '.') }}đ</td>
                      </tr>
                      <tr>
                          <td colspan="4" class="text-right"><strong>Giảm Giá Đơn Hàng:</strong></td>
                          <td>-{{ number_format($giamGiaDonHang, 0, ',', '.') }}đ</td>
                      </tr>
                      <tr>
                          <td colspan="4" class="text-right"><strong>Tổng Thanh Toán:</strong></td>
                          <td class="text-danger"><strong>{{ number_format($tongThanhToan, 0, ',', '.') }}đ</strong></td>
                      </tr>
                  </tfoot>
              </table>
              <div class="col-lg-13 text-right">
                @if ($donHang->trang_thai == 0)
                    {{-- Trạng thái chờ xác nhận --}}
                    <form action="{{ route('don-hang.duyet-don-hang', $donHang->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Duyệt</button>
                    </form>
                    <form action="{{ route('don-hang.huy-don-hang', $donHang->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">Hủy</button>
                    </form>
                @elseif ($donHang->trang_thai == 1)
                    {{-- Trạng thái chờ lấy hàng --}}
                    <form action="{{ route('don-hang.yeu-cau-lay-hang', $donHang->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Yêu cầu đến lấy hàng</button>
                    </form>
                @endif
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
