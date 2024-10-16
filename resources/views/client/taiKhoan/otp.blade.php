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
                @if (session('success'))
                    <div class="alert alert-success" id="success-alert">
                        {{ session('success') }}
                    </div>
                @endif
                @error('email')
                    <div class="alert alert-danger" id="danger-alert">
                        {{ $message }}
                    </div>
                @enderror
                <div class="col-xxl-4 col-lg-6 mx-auto">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h4>Vui lòng nhập OTP để xác minh tài khoản của bạn</h4>
                        </div>
                        <div class="login-box">
                            <form action="{{ route('tai-khoan.verify-otp') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-12">
                                    <div class="otp-input">
                                        <input type="hidden" name="email" value="{{ request('v') }}">
                                        {{-- v là email đã được mã hóa bên controller --}}
                                        <input class="form-control text-center" id="" type="number"
                                            placeholder="0" name="otp">
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
                                    <button type="submit" class="btn login btn_black sm">Xác nhận</button>
                                </div>
                            </form>
                            <div class="other-log-in"></div>
                            <form action="{{ route('tai-khoan.gui-lai-otp') }}" method="post" class="sign-up-box">
                                @csrf
                                <div>
                                    <div class="forgot-box d-block">
                                        <input type="hidden" name="email" value="{{ request('v') }}">
                                        {{-- v là email đã được mã hóa bên controller --}}
                                        <p>Bạn chưa nhận được code ?</p>
                                        <button type="submit" class="btn btn-orange sm text-decoration-underline">Gửi
                                            lại</button>
                                    </div>
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
