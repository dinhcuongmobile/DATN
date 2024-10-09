@extends('client.layout.main')
@section('container')
    <section class="section-b-space pt-0">
        <div class="heading-banner">
            <div class="custom-container container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4>Quên mật khẩu</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-b-space pt-0 login-bg-img">
        <div class="custom-container container login-page">
            <div class="row align-items-center">
                <div class="col-xxl-7 col-6 d-none d-lg-block">
                    <div class="login-img">
                        <img class="img-fluid" src="https://themes.pixelstrap.net/katie/assets/images/login/1.svg"
                            alt="">
                    </div>
                </div>
                @if (session('error'))
                    <div class="alert alert-danger" id="error-alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="col-xxl-4 col-lg-6 mx-auto">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h4>Please enter the one time password to verify your account</h4>
                        </div>
                        <div class="login-box">
                            <form action="{{ route('tai-khoan.verify-otp') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-12">
                                    <div class="otp-input">
                                        <input class="form-control text-center" id="" type="number"
                                            placeholder="0" name="otp">
                                        <input type="hidden" name="email" value="{{ session('email') }}">
                                        {{-- <input class="form-control text-center" id="four2" type="number"
                                            placeholder="0" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)">
                                        <input class="form-control text-center" id="four3" type="number"
                                            placeholder="0" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)">
                                        <input class="form-control text-center" id="four4" type="number"
                                            placeholder="0" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)"> --}}
                                    </div>
                                    @error('otp')
                                        <p class="Err text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="forgot-box d-block">
                                        <span>Bạn chưa nhận được code ?</span>
                                        <a href="#">Gửi lại</a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn login btn_black sm">Xác nhận</button>
                                </div>
                            </form>
                        </div>
                        <div class="other-log-in"></div>
                        <div class="sign-up-box">
                            <a class="text-decoration-underline" href="{{ route('tai-khoan.dang-nhap') }}">Đăng nhập</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
