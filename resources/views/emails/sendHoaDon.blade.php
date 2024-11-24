<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        /* Reset mặc định */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container-fluid {
            padding: 15px;
            max-width: 1000px;
            margin: auto;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            background-color: #fff;
        }

        .card-header {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
        }

        .card-body {
            padding: 15px;
        }

        .text-center {
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .table th {
            font-weight: bold;
        }

        .table-striped tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #fff;
        }

        .card-body table{
            text-align: center
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            color: #fff;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-success {
            background-color: #28a745;
        }

        .float-right {
            float: right;
        }

        .mt-5 {
            margin-top: 3rem;
        }

        .mb-5 {
            margin-bottom: 3rem;
        }
        .d-flex{
            display: flex;
        }
        img{
            width: 80px;
            height: 80px;
            border: 1px solid #0000002b;
            margin-right: 10px;
        }
        .sanPham p{
            font-size: 14px;
        }
        .textColor{
            color: rgb(255, 136, 0);
        }
        .total{
            font-size: 22px;
            display: flex;
            justify-content: space-between;
            width: 250px;
            height: 30px;
            align-items: center
        }
        .footer{
            padding-left: 685px;
        }
    </style>
    <title>Document</title>
</head>
<body>
<p>Chào {{ $user->ho_va_ten }},</p>
<p>Cảm ơn bạn đã luôn tin tưởng và lựa chọn sản phẩm của chúng tôi. Dưới đây là hóa đơn của đơn hàng bạn đã đặt :</p>
     <!-- Begin Page Content -->
 <div class="container-fluid">
    <div class="card">
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
                    <td class="col-3">{{$user->ho_va_ten}}</td>
                    <td class="col-2">{{$user->so_dien_thoai}}</td>
                    <td class="col-3">{{$user->email}}</td>
                    <td class="col-4">
                        @if ($dia_chi->dia_chi_chi_tiet)
                            {{ $dia_chi->dia_chi_chi_tiet }},
                        @endif
                        {{ $dia_chi->phuongXa?->ten_phuong_xa }},
                        {{ $dia_chi->quanHuyen?->ten_quan_huyen }},
                        {{ $dia_chi->tinhThanhPho?->ten_tinh_thanh_pho }}
                    </td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>

    <div class="card mt-5">
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
                    <td class="col-2">{{$don_hang->diaChi->so_dien_thoai_nhan}}</td>
                    <td class="col-3">
                        @php
                            $dia_chi = $don_hang->diaChi;
                        @endphp
                        @if ($dia_chi->dia_chi_chi_tiet)
                            {{ $dia_chi->dia_chi_chi_tiet }},
                        @endif
                        {{ $dia_chi->phuongXa?->ten_phuong_xa }},
                        {{ $dia_chi->quanHuyen?->ten_quan_huyen }},
                        {{ $dia_chi->tinhThanhPho?->ten_tinh_thanh_pho }}
                    </td>
                    <td class="col-3">{{$don_hang->ghi_chu}}</td>
                    @if ($don_hang->phuong_thuc_thanh_toan==0)
                        <td class="col-2">Ship code</td>
                    @else
                        <td class="col-2">Thanh toán online</td>
                    @endif
                  </tr>
                </tbody>
              </table>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">
            <h3 class="text-center" style="color: #000">Liệt kê chi tiết đơn hàng</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $thanh_tien = 0;
                    @endphp
                    @foreach ($chi_tiet_don_hangs as $index => $item)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td class="col-4">
                                <div class="d-flex sanPham">
                                    <div>
                                        <h4>{{$item->sanPham->ten_san_pham}}</h4>
                                        <p>Phân loại hàng:
                                            <span class="phanLoaiHang">{{ $item->bienThe->kich_co }}, {{ $item->bienThe->ten_mau }}</span>.
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="col-2">{{$item->so_luong}}</td>
                            <td class="col-2">{{number_format($item->don_gia, 0, ',', '.')}}đ</td>
                        </tr>
                        @php
                            $thanh_tien += $item->thanh_tien;
                        @endphp
                    @endforeach
                        <tr>
                            <td colspan="4">
                                <div class="footer">
                                    <div class="total">
                                        <h6>Thành tiền : </h6>
                                        <h6 class="textColor">{{number_format($thanh_tien, 0, ',', '.')}}đ</h6>
                                    </div>
                                    <div class="total">
                                        <h6>Tổng phí giao hàng: </h6>
                                        <h6 class="textColor">{{number_format($phi_ships, 0, ',', '.')}}đ</h6>
                                    </div>
                                    <div class="total">
                                        <h6>Giảm giá vận chuyển: </h6>
                                        <h6 class="textColor">{{number_format($giamGiaVanChuyen, 0, ',', '.')}}đ</h6>
                                    </div>
                                    <div class="total">
                                        <h6>Giảm giá đơn hàng: </h6>
                                        <h6 class="textColor">{{number_format($giamGiaDonHang, 0, ',', '.')}}đ</h6>
                                    </div>
                                    <div class="total">
                                        <h6>Tổng thanh toán : </h6>
                                        <h6 class="textColor">{{number_format($don_hang->tong_thanh_toan, 0, ',', '.')}}đ</h6>
                                    </div>
                                </div>
                            </td>
                        </tr>
                </tbody>
              </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</body>
</html>
