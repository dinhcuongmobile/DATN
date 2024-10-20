@extends('client.layout.main')
@section('container')
    <section class="section-b-space pt-0">
        <div class="heading-banner">
            <div class="custom-container container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4>Đăng Ký</h4>
                    </div>
                    <div class="col-sm-6">

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
                            <h4>Đăng Ký</h4>
                            <p>Tạo tài khoản mới</p>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success" id="error-alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" id="error-alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="login-box">
                            <form id="loginForm" action="{{ route('tai-khoan.dang-ky') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input class="form-control @error('ho_va_ten') is-invalid @enderror" id="floatingInputValue" type="text"
                                            placeholder="Full Name" value="{{ old('ho_va_ten') }}" name="ho_va_ten">
                                        <label for="floatingInputValue">Họ Và Tên</label>
                                    </div>
                                    <p class="Err text-danger ho_va_ten-error">
                                        @error('ho_va_ten')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input class="form-control @error('email') is-invalid @enderror" id="floatingInputValue1" type="email"
                                            placeholder="name@example.com" value="{{ old('email') }}" name="email">
                                        <label for="floatingInputValue1">Email</label>
                                    </div>
                                    <p class="Err text-danger email-error">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input class="form-control @error('password') is-invalid @enderror" id="floatingInputValue2" type="password"
                                            placeholder="Password" value="" name="password">
                                        <label for="floatingInputValue2">Mật Khẩu</label>
                                    </div>
                                    <p class="Err text-danger password-error">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input class="form-control @error('confirm_password') is-invalid @enderror" id="floatingInputValue2" type="password"
                                            placeholder="Confirm password" value="" name="confirm_password">
                                        <label for="floatingInputValue2">Nhập lại mật Khẩu</label>
                                    </div>
                                    <p class="Err text-danger confirm_password-error">
                                        @error('confirm_password')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <div class="col-12">
                                    <button class="btn login btn_black sm" type="submit" onsubmit="ajaxAuth()">Đăng Ký</button>
                                </div>
                            </form>
                        </div>
                        <div class="other-log-in">
                            <h6>Hoặc</h6>
                        </div>
                        <div class="log-in-button">
                            <ul>
                                <li> <a href="https://www.google.com/" target="_blank"> <i class="fa-brands fa-google me-2">
                                        </i>Google</a></li>
                                <li> <a href="https://www.facebook.com/" target="_blank"><i
                                            class="fa-brands fa-facebook-f me-2"></i>Facebook </a></li>
                            </ul>
                        </div>
                        <div class="other-log-in"></div>
                        <div class="sign-up-box">
                            <p>Bạn đã có tài khoản?</p><a href="{{ route('tai-khoan.dang-nhap') }}">Đăng Nhập </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
