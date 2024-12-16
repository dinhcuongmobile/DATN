@extends('client.layout.main')
@section('container')
    <section class="section-b-space pt-0">
        <div class="heading-banner">
            <div class="custom-container container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4>Thông tin chuyển khoản</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-b-space pt-0 login-bg-img">
        <div class="custom-container container">
            <div class="table">
                <div class="form-group mt-3">
                    <label >Mã đơn hàng:</label>
                    <input type="text" class="form-control" value="{{ $_GET['vnp_TxnRef']}}" readonly>
                </div>
                <div class="form-group mt-3">
                    <label >Số tiền:</label>
                    <input type="text" class="form-control" value="{{ number_format($_GET['vnp_Amount'] / 100, 0, ',', '.') }}đ" readonly>
                </div>
                <div class="form-group mt-3">
                    <label >Nội dung thanh toán:</label>
                    <input type="text" class="form-control" value="{{ $_GET['vnp_OrderInfo']}}" readonly>
                </div>
                <div class="form-group mt-3">
                    <label >Mã GD Tại VNPAY:</label>
                    <input type="text" class="form-control" value="{{ $_GET['vnp_TransactionNo']}}" readonly>
                </div>
                <div class="form-group mt-3">
                    <label >Mã Ngân hàng:</label>
                    <input type="text" class="form-control" value="{{ $_GET['vnp_BankCode']}}" readonly>
                </div>
                <div class="form-group mt-3">
                    <label>Thời gian thanh toán:</label>
                    <input type="text" class="form-control" value="{{ $_GET['vnp_PayDate']}}" readonly>
                </div>
                <div class="form-group mt-3">
                    <label >Kết quả:</label>
                    <label>
                        @if ($_GET['vnp_ResponseCode'] == '00')
                            <span class="text-primary">Giao dịch Thành công</span>
                        @else
                            <span class="text-danger">Giao dịch Không thành công</span>
                        @endif
                    </label>
                    @if ($_GET['vnp_ResponseCode'] == '00')
                        <a style="display: block;" class="btn btn-success mt-3" onclick="hoanThanhTTOnline()">Tiếp tục</a>
                    @else
                        <a style="display: block;" class="btn btn-success mt-3" href="{{route('gio-hang.gio-hang')}}">Quay lại</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
