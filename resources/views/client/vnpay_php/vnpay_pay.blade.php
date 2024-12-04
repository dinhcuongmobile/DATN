<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Tạo mới đơn hàng</title>
        <!-- Bootstrap core CSS -->
        <link href="assets/bootstrap.min.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Custom styles for this template -->
        <link href="assets/jumbotron-narrow.css" rel="stylesheet">
        <script src="assets/jquery-1.11.3.min.js"></script>
    </head>

    <body>
    @php
        $vnp_TmnCode = "ELVAQEWH"; //Mã định danh merchant kết nối (Terminal Id)
        $vnp_HashSecret = "UMNOHDQWWDIRGSNATSWASPXTXOFSMHZR"; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/gio-hang/vnpay_return";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        //Config input format
        //Expire
        $startTime = date("YmdHis");
        $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));
    @endphp
    <div class="cart-area pt-100 pb-100">
        <div class="container">
            <h3>Tạo mới đơn hàng</h3>
            <div class="table-responsive mt-3 card">
                <div class="card-body border">
                    <form action="{{route('gio-hang.vnpay_create_payment')}}" id="frmCreateOrder" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="amount" class="form-label">Số tiền</label>
                            <input class="form-control" data-val="true" data-val-number="The field Amount must be a number." data-val-required="The Amount field is required." id="amount" name="amount" type="text" value="{{$tongthanhtoan}}" onkeydown="return false"/>
                        </div>
                         <h4>Phương thức thanh toán</h4>
                        <div class="form-group">
                            <h5>Chuyển hướng sang Cổng VNPAY chọn phương thức thanh toán</h5>
                           <input type="radio" Checked="True" id="bankCode" name="bankCode" value="">
                           <label for="bankCode">Cổng thanh toán VNPAYQR</label><br>
                        </div>
                        <div class="form-group">
                            <h5>Chọn ngôn ngữ giao diện thanh toán:</h5>
                             <input type="radio" id="language" Checked="True" name="language" value="vn">
                             <label for="language">Tiếng việt</label><br>
                             <input type="radio" id="language" name="language" value="en">
                             <label for="language">Tiếng anh</label><br>

                        </div>
                        <button type="submit" class="btn btn-info mt-4" href>Tiếp tục</button>
                    </form>
                </div>
            </div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                <p>&copy; VNPAY <?= date('Y');?></p>
            </footer>
        </div>
    </div>
    </body>
</html>
