@extends('admin.layout.main')
@section('containerAdmin')
 <!-- Begin Page Content -->
 <div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Chi Tiết Đơn Hàng</h1>
  <div class="card shadow mb-4">
      <div class="card-body">
          <!-- Thông tin đơn hàng -->
          <div class="row mb-3">
              <div class="col-lg-12">
                <h5 class="mb-3"><strong>Thông Tin Khách Hàng</strong></h5>
                <p><strong>Tên Khách Hàng:</strong> {{ $diaChiNhanHang->ho_va_ten_nhan }}</p>
                  <p><strong>Mã Đơn Hàng:</strong> <span style="color: red">{{ $donHang->ma_don_hang }}</span></p>
                  <p><strong>Địa Chỉ Nhận Hàng:</strong>
                        @if ($diaChiNhanHang->dia_chi_chi_tiet)
                            {{$diaChiNhanHang->dia_chi_chi_tiet}} ,
                        @endif
                        {{$diaChiNhanHang->phuongXa->ten_phuong_xa}} ,
                        {{$diaChiNhanHang->quanHuyen->ten_quan_huyen}} ,
                        {{$diaChiNhanHang->tinhThanhPho->ten_tinh_thanh_pho}}.
                    </p>
                  <p><strong>Phương Thức Thanh Toán:</strong>
                    <span style="background-color: #f0f0f0; color: green; padding: 5px; border-radius: 9px;">
                        @if($donHang->phuong_thuc_thanh_toan == 0)
                        Thanh toán khi nhận hàng
                    @else
                        <a href="{{ route('don-hang.danh-sach-da-chuyen-khoan', ['ma_don_hang' => $donHang->ma_don_hang]) }}" style="color: #007bff;">
                            Chuyển khoản
                        </a>
                    @endif
                    </span>
                  </p>
                  <p><strong>Tổng Sản Phẩm:</strong> {{ $donHang->chiTietDonHangs->count() }} Sản Phẩm</p>
                  @if ($donHang->ghi_chu)
                    <p><strong>Ghi Chú : </strong>{{$donHang->ghi_chu}} </p>
                  @endif
                  @if ($donHang->nguoiBan !== null)
                    <hr>
                        <p>
                            @if ($donHang->trang_thai == 4)
                                <strong>Tài khoản hủy đơn: </strong> 
                            @else
                                <strong>Tài khoản duyệt đơn: </strong> 
                            @endif
                            <span style="color: red">{{ $donHang->nguoiBan->ho_va_ten }}</span> - Mã nhân viên: 
                            <span style="color: red">{{ $donHang->nguoiBan->id }}</span>
                        </p>
                    <hr>
                  @endif
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
                          <td colspan="4" class="text-right"><strong>Tổng Tiền ({{$donHang->chiTietDonHangs->count()}} Sản Phẩm):</strong></td>
                          <td>{{ number_format($chiTiet->thanh_tien, 0, ',', '.') }}đ</td>
                      </tr>
                      <tr>
                            <td colspan="4" class="text-right"><strong>Phí vận chuyển:</strong></td>
                            <td>{{ number_format($phiShip, 0, ',', '.') }}đ</td>
                        </tr>
                      @if ($donHang->giam_gia_van_chuyen>0)
                        <tr>
                            <td colspan="4" class="text-right"><strong>Giảm Giá Vận Chuyển:</strong></td>
                            <td>-{{ number_format($donHang->giam_gia_van_chuyen, 0, ',', '.') }}đ</td>
                        </tr>
                      @endif
                      @if ($donHang->giam_gia_don_hang>0)
                        <tr>
                            <td colspan="4" class="text-right"><strong>Giảm Giá Đơn Hàng:</strong></td>
                            <td>-{{ number_format($donHang->giam_gia_don_hang, 0, ',', '.') }}đ</td>
                        </tr>
                      @endif
                      @if ($donHang->namad_xu>0)
                        <tr>
                            <td colspan="4" class="text-right"><strong>Namad-xu:</strong></td>
                            <td>-{{ number_format($donHang->namad_xu, 0, ',', '.') }}đ</td>
                        </tr>
                      @endif
                      <tr>
                          <td colspan="4" class="text-right"><strong>Tổng Thanh Toán:</strong></td>
                          <td class="text-danger"><strong>{{ number_format($donHang->tong_thanh_toan, 0, ',', '.') }}đ</strong></td>
                      </tr>
                  </tfoot>
              </table>
              <div class="col-lg-13 text-right">
                @if ($donHang->trang_thai == 0)
                    {{-- Trạng thái chờ xác nhận --}}
                    <a href="{{ route('don-hang.duyet-don-hang', $donHang->id) }}" class="btn btn-success btn-sm">
                        Duyệt
                    </a>
                    <a href="{{ route('don-hang.huy-don-hang', $donHang->id) }}" class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                        Hủy
                    </a>
                @elseif ($donHang->trang_thai == 1)
                    {{-- Trạng thái chờ lấy hàng --}}
                    <a href="{{ route('don-hang.yeu-cau-lay-hang', $donHang->id) }}" class="btn btn-primary btn-sm">
                        Yêu cầu đến lấy hàng
                    </a>
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
