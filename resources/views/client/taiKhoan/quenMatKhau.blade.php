@extends('client.layout.main')
@section('container')
    <section class="section-b-space pt-0">
        <div class="heading-banner">
            <div class="custom-container container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4>Quên Mật Khẩu</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-b-space pt-0 login-bg-img">
        <div class="custom-container container login-page">
            <div class="row align-items-center">
                <div class="col-xxl-7 col-6 d-none d-lg-block">
                    <div class="login-img"> <img class="img-fluid"
                            src="https://themes.pixelstrap.net/katie/assets/images/login/1.svg" alt=""></div>
                </div>
                <div class="col-xxl-4 col-lg-6 mx-auto">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h4>Quên Mật Khẩu</h4>
                            <p></p>
                        </div>
                        <div class="login-box">
                            <form id="loginForm" action="{{ route('tai-khoan.gui-otp') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input class="form-control @error('email') is-invalid @enderror" id="floatingInputValue" type="email"
                                            placeholder="name@example.com" value="" name="email">
                                        <label for="floatingInputValue">Email</label>
                                        <p class="Err text-danger email-error">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn login btn_black sm" onsubmit="ajaxAuth()">Gửi OTP</button>
                                </div>
                            </form>
                        </div>
                        <div class="other-log-in"></div>
                        <div class="sign-up-box"> <a class="text-decoration-underline"
                                href="{{ route('tai-khoan.dang-nhap') }}">Quay Lại Đăng Nhập</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
