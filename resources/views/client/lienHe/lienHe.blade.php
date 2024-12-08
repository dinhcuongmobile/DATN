@extends('client.layout.main')

@section('css')
    <style>
        div#thong_bao {
            -webkit-backdrop-filter: blur(2px);
            backdrop-filter: blur(2px);
            background-color: rgba(var(--black), .2);
            overflow: hidden
        }
    </style>
@endsection

@section('container')
    <section class="section-b-space pt-0">
        <div class="heading-banner">
            <div class="custom-container container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4>Liên hệ</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-b-space pt-0">
        <div class="custom-container container">
            <div class="contact-main">
                <div class="row gy-3">
                    <div class="col-12">
                        <div class="title-1 address-content">
                            <p class="pb-0">Hãy liên hệ với chúng tôi<span></span></p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="address-items">
                            <div class="icon-box"> <i class="iconsax" data-icon="mail"></i></div>
                            <div class="contact-box">
                                <h6>Địa chỉ Email</h6>
                                <p>namadstore2024@gmail.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="address-items">
                            <div class="icon-box"> <i class="iconsax" data-icon="phone-calling"></i></div>
                            <div class="contact-box">
                                <h6>Số điện thoại</h6>
                                <p>+84 35 786 4779</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-b-space pt-0">
        <div class="custom-container container">
            <div class="contact-main">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-6 order-lg-1 order-2">
                        <div class="contact-box">
                            <h4>Liên hệ với chúng tôi</h4>
                            <p>Nếu bạn thấy sản phẩm tuyệt vời hoặc bạn muốn làm cộng tác viên, hãy liên hệ với chúng tôi.
                            </p>
                            <div class="contact-form">
                                <form class="row gy-4">
                                    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                                    <div class="col-12">
                                        <label class="form-label" for="ho_va_ten">Họ và tên</label>
                                        <input class="form-control" id="ho_va_ten" type="text"
                                            placeholder="Nhập họ và tên">
                                        <p class="text-danger" id="ho_va_ten_err"></p>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control" id="email" type="email"
                                            placeholder="Nhập địa chỉ Email">
                                        <p class="text-danger" id="email_err"></p>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" for="so_dien_thoai">Số điện thoại</label>
                                        <input class="form-control" id="so_dien_thoai" type="text"
                                            placeholder="Nhập số điện thoại">
                                        <p class="text-danger" id="so_dien_thoai_err"></p>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="tieu_de">Tiêu đề</label>
                                        <input class="form-control" id="tieu_de" type="text"
                                            placeholder="Nhập tiêu đề">
                                        <p class="text-danger" id="tieu_de_err"></p>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Nội dung</label>
                                        <textarea class="form-control" id="noi_dung" rows="6" placeholder="Nhập nội dung"></textarea>
                                        <p class="text-danger" id="noi_dung_err"></p>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn_black rounded sm" type="button"
                                            onclick="guiLienHe()">Gửi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 order-lg-2 order-1 offset-xl-1">
                        <div class="contact-img"> <img class="img-fluid"
                                src="https://themes.pixelstrap.net/katie/assets/images/contact/1.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal theme-modal newsletter-modal newsletter-4" id="thong_bao" tabindex="-1" role="dialog"
            aria-modal="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="news-latter-box">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="newslwtter-content">
                                        <h2>Namad Store</h2>
                                        <h4 style="font-family:Arial, Helvetica, sans-serif;">GỬI THÀNH CÔNG</h4>
                                        <p>Cảm ơn bạn đã liên hệ với chúng tôi, chúng tôi sẽ phản hồi lại bạn sớm nhất có
                                            thể.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 d-none d-lg-block">
                                    <div class="newslwtter-img">
                                        <img class="img-fluid" src="{{asset('assets/images/other-img/DM-Sơ Mi Dài Tay.png')}}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
