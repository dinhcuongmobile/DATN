
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn Namad</title>

    <!-- ========== logo css ========== -->
    <link rel="icon" href="img/logo-1.png">

    <!-- ========== fonts css ========== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Outfit", sans-serif;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
        
</head>

<body style="margin: 20px auto;width: 650px; overflow-x: auto; ">
    @foreach ( $donHangs as $donHang )
    <table align="center" border="0" cellpadding="0" cellspacing="0" style="background-color:rgba(204, 162, 112, 0.05); overflow: hidden; position: relative;  background-image: url(./img/bg.png); background-size: cover; background-repeat: no-repeat;  width: 100%; padding: 30px; box-shadow: 0 0 13px rgba(0, 0, 0, 0.055);">
        <tbody >
            <tr>
                <td>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 40px;">
                        <tr style="position: absolute; top: -2px; left: 30px; height: 80px; padding: 10px; outline: 1px solid #ffffff; outline-offset: 1px; background-color: #ffffff;">
                            <td style="display: block;text-transform: uppercase;  font-size: 20px; color: #fff;">
                                <a href="../template/index.html" style="float: right;">
                                    <img src="{{asset('assets/images/logo/avatar_ig.png')}}" style="width: 100px; height:100px;  padding: 0 0 10px; object-fit: contain;"
                                        alt="logo">
                                </a>
                            </td>
                        </tr>
                        <tr style="width: 100%;">
                            <td style="float: right; text-align: center;">
                                <h4 style="margin: 0%; font-size: 30px; line-height: 1; color: #cca270;">Hóa Đơn</h4>
                                <h6
                                    style="margin: 0%; line-height: 1; padding-top: 3px; font-size: 14px; font-weight: 500; color: #222;">
                                    {{$donHang->ma_don_hang}}</h6>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%; margin-top: 20px;">
                        <tr>
                            <td style="width: 50%;">
                                <h4 style="margin: 0 0 10px; line-height: 1.3; color: #222; text-transform: uppercase;">Địa Chỉ :</h4>
                                <h5
                                    style="margin: 0%; line-height: 1.3; letter-spacing: 0.3px; color: #222; font-size: 15px; font-weight: 500;">
                                    @if ($donHang->diaChi->dia_chi_chi_tiet)
                                    {{$donHang->diaChi->dia_chi_chi_tiet}} ,
                                    @endif
                                </h5>
                                <h5
                                    style="margin: 0%; line-height: 1.3; letter-spacing: 0.3px; color: #222;
                                    font-size: 15px; font-weight: 500;">
                                    {{$donHang->diaChi->phuongXa->ten_phuong_xa}} ,
                                    {{$donHang->diaChi->quanHuyen->ten_quan_huyen}} ,
                                    </h5>
                                <h5
                                    style="margin: 0%; line-height: 1.3; letter-spacing: 0.3px; color: #222;
                                    font-size: 15px; font-weight: 500;">
                                    {{$donHang->diaChi->tinhThanhPho->ten_tinh_thanh_pho}}.
                                </h5>
                            </td>
                            <td style="width: 50%; padding:15px 20px; text-align: end;">
                                <h6 style="margin: 0%; font-size: 17px; text-transform: capitalize; font-weight: 600; color: #222; line-height: 1.4;">Ngày Đặt :
                                    <span style=" line-height: 1.4; font-size: 15px; font-weight: 400; color: #222;">
                                        {{ \Carbon\Carbon::parse($donHang->ngay_cap_nhat)->format('d-m-Y')}}</span>
                                </h6>
                                <h6 style="margin: 0; font-size: 17px; text-transform: capitalize; font-weight: 600; color: #222; ">
                                    Tên : <span style="line-height: 1.4; font-size: 15px; font-weight: 400; color: #222; text-transform: uppercase;">{{$donHang->user->ho_va_ten}}</span>
                                </h6>
                                <h6 style="margin: 0; font-size: 17px; font-weight: 600; color: #222;  line-height: 1.4;">
                                    Email : <span style="line-height: 1; font-size: 13px; font-weight: 400; color: #222;">{{$donHang->user->email}}</span>
                                </h6>
                                <h6 style="margin: 10px 0; font-size: 17px; font-weight: 600; color: #222; line-height: 1.4;">
                                    Phương Thức Thanh Toán : <span style="font-size: 15px; font-weight: 400; color: #222;">
                                        {{ $donHang->phuong_thuc_thanh_toan == 0 ? 'Thanh toán khi nhận hàng' : 'Chuyển khoản' }}
                                    </span>
                                </h6>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" cellpadding="10" cellspacing="0"
                        style="margin: 20px 0 0px; vertical-align:middle;">
                        <thead>
                            <tr>
                                <th
                                    style="text-transform: uppercase; color: #fff; font-weight: 700; line-height: 1; font-size: 17px; background-color: #cca270; padding: 14px 0;">
                                    STT</th>
                                <th
                                    style="text-transform: uppercase; color: #fff; font-weight: 700; line-height: 1; font-size: 17px; background-color: #cca270; padding: 14px 0;">
                                    Sản Phẩm </th>
                                <th
                                    style="text-transform: uppercase; color: #fff; font-weight: 700; line-height: 1; font-size: 17px; background-color: #cca270; padding: 14px 0;">
                                    Giá</th>
                                <th
                                    style="text-transform: uppercase; color: #fff; font-weight: 700; line-height: 1; font-size: 17px; background-color: #cca270; padding: 14px 0;">
                                    Số Lượng</th>
                                <th
                                    style="text-transform: uppercase; color: #fff; font-weight: 700; line-height: 1; font-size: 17px; background-color: #cca270; padding: 14px 0;">
                                    Tổng</th>
                            </tr>
                        </thead>
                        @foreach ($donHang->chiTietDonHangs as $index => $chiTiet) 
                        <tbody>
                            <tr>
                                <td style="text-align: center; font-weight: 600;">{{$index+01.}}</td>
                                <td>
                                    <h5
                                        style="margin: 0; line-height: 1.3; font-size: 17px; font-weight: 600; text-transform: capitalize;">
                                        {{$chiTiet->sanPham->ten_san_pham}}</h5>
                                    <h6
                                        style="margin: 0; line-height: 1; padding-top: 3px; font-size: 14px; -webkit-line-clamp: 1; -webkit-box-orient: vertical;
                                        display: -webkit-box; overflow: hidden; font-weight: 400; color: #6e6d6d; text-transform: capitalize;">
                                         @if($chiTiet->bienThe)
                                         Phân Loại: {{ $chiTiet->bienThe->kich_co }}, {{ $chiTiet->bienThe->ten_mau }}
                                         @endif
                                    </h6>
                                </td>
                                <td style="text-align: center; font-weight: 500; font-size: 14px;">{{ number_format($chiTiet->don_gia, 0, ',', '.') }}đ</td>
                                <td style="text-align: center; font-weight: 500; font-size: 14px;">{{ $chiTiet->so_luong }}</td>
                                <td style="text-align: center; font-weight: 500; font-size: 14px;">{{ number_format($chiTiet->thanh_tien, 0, ',', '.') }}đ</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    <table width="100%">
                        <tr style="display: flex; justify-content: space-between; gap: 80px;">
                            <td width="50%">
                            </td>
                            <td width="50%">
                                <table width="100%" cellpadding="10">
                                    <tr style="display: flex; justify-content: space-between; text-align: end;">
                                        <td>
                                            <h5
                                                style="margin: 0%; font-size: 14px; line-height: 1.5; color: #6e6d6d; text-transform: capitalize;">
                                                Phí Vận Chuyển:
                                            </h5>
                                            @if ($donHang->giam_gia_van_chuyen>0)
                                            <h5
                                                style="margin: 0%; font-size: 14px; line-height: 1.5; color: #6e6d6d; text-transform: capitalize;">
                                                Giảm Vận Chuyển:
                                            </h5>
                                            @endif
                                            @if ($donHang->giam_gia_don_hang>0)
                                            <h5
                                                style="margin: 0%; font-size: 14px; line-height: 1.5; color: #6e6d6d; text-transform: capitalize;">
                                                Khuyến Mại:
                                            </h5>
                                            @endif
                                            @if ($donHang->giam_gia_don_hang>0)
                                            <h5
                                                style="margin: 0%; font-size: 14px; line-height: 1.5; color: #6e6d6d; text-transform: capitalize;">
                                                Namad-Xu:
                                            </h5>
                                            @endif
                                        </td>
                                        <td>
                                            <h5
                                                style="margin: 0%; font-size: 14px; text-align: start; line-height: 1.5;">
                                                {{ number_format($donHang->phi_ship, 0, ',', '.') }}đ
                                            </h5>
                                            @if ($donHang->giam_gia_van_chuyen>0)
                                            <h5
                                                style="margin: 0%; font-size: 14px; text-align: start; line-height: 1.5;">
                                                -{{ number_format($donHang->giam_gia_van_chuyen, 0, ',', '.') }}đ
                                            </h5>
                                            @endif
                                            @if ($donHang->giam_gia_don_hang>0)
                                            <h5
                                                style="margin: 0%; font-size: 14px; text-align: start; line-height: 1.5;">
                                                -{{ number_format($donHang->giam_gia_don_hang, 0, ',', '.') }}đ
                                            </h5>
                                            @endif
                                            @if ($donHang->namad_xu>0)
                                            <h5
                                                style="margin: 0%; font-size: 14px; text-align: start; line-height: 1.5;">
                                                -{{ number_format($donHang->namad_xu, 0, ',', '.') }}đ
                                            </h5>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr
                                        style="display: flex; justify-content: space-between; background-color: #cca270; text-align: end; margin-top: 10px;">
                                        <td>
                                            
                                            <h5
                                                style="margin: 0%; font-size: 16px; line-height: 1; text-transform: capitalize; color: #fff;">
                                                Thanh toán:
                                            </h5>
                                        </td>
                                        <td>
                                            <h5 style="margin: 0%; font-size: 16px; text-align: start; line-height: 1; color: #fff;">
                                                {{ $donHang->phuong_thuc_thanh_toan == 1 ? '0đ' : number_format($donHang->tong_thanh_toan, 0, ',', '.') . 'đ' }}
                                            </h5>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" style="margin-top: 20px;">
                        <tr style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                            <td style="width: 50%;">
                                <img src="img/signature.svg" width="100px" style="object-fit: contain;" alt="">
                                <h5 style="margin: 0%; line-height: 1; font-size: 18px;">Ký Tên</h5>
                                <h5
                                    style="margin: 0%; line-height: 1; font-size: 16px; padding-top: 3px; color: #6e6d6d;">
                                    Hoàng Bách</h5>
                            </td>
                            <td>
                                <h4 style="margin: 0%; text-transform: capitalize; font-size: 20px; color: #cca270;">
                                    Cảm ơn bạn đã tin tưởng!</h4>
                                <table width="100%">
                                    <tr style="display: flex;  justify-content: space-between; gap: 10px;">
                                        <td 
                                            style="display: flex; align-items: center; gap: 5px; font-weight: 400; color: #6e6d6d;">
                                            LiênHệ:<img src="img/phone.svg" width="16px" alt=""> 0917261473
                                        </td>
                                        <td
                                            style="display: flex; align-items: center; gap: 5px; font-weight: 400; color: #6e6d6d;">
                                            <img src="img/mail.svg" width="16px" alt="">namadstore2024@gmail.com
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
        
    </table>
    <div class="page-break"></div>
    @endforeach
</body>
<script>
    // Tự động in khi load trang
    window.onload = function() {
        window.print();
    };
</script>
</html>