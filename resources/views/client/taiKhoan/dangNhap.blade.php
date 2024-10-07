@extends('client.layout.main')
@section('container')
    <section class="section-b-space pt-0">
        <div class="heading-banner">
            <div class="custom-container container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4>Đăng Nhập</h4>
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
                            <h4>Đăng Nhập</h4>
                            <p>Nếu bạn đã có tài khoản</p>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success" id="error-alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" id="error-alert">
                                {{ session('error') }}
                                @if (session('error') === 'Tài khoản của bạn chưa được xác thực !')
                                    <a href="{{ route('tai-khoan.gui-lai-email', old('email')) }}"
                                        style="color: #229ec7; margin-left: 10px; text-decoration: underline;">Gửi lại email
                                        xác thực.</a>
                                @endif
                            </div>
                        @endif
                        <div class="login-box">
                            <form action="{{ route('tai-khoan.dang-nhap') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input class="form-control @error('email') is-invalid @enderror"
                                            id="floatingInputValue" type="" placeholder="name@example.com"
                                            value="{{ old('email') }}" name="email">
                                        <label for="floatingInputValue">Email</label>
                                    </div>
                                    @error('email')
                                        <p class="Err text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input class="form-control @error('password') is-invalid @enderror"
                                            id="floatingInputValue1" type="password" placeholder="Password confirm"
                                            value="" name="password">
                                        <label for="floatingInputValue1">Mật Khẩu</label>
                                    </div>
                                    @error('password')
                                        <p class="Err text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="forgot-box">
                                        <div>
                                            <input class="custom-checkbox me-2" id="category1" type="checkbox"
                                                name="text">
                                            <label for="category1">Ghi nhớ</label>
                                        </div>
                                        <a href="{{ route('tai-khoan.quen-mat-khau') }}">Quên Mật Khẩu?</a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn login btn_black sm" type="submit" data-bs-dismiss="modal"
                                        aria-label="Close">Đăng Nhập</button>
                                </div>
                            </form>
                        </div>
                        <div class="other-log-in">
                            <h6>Hoặc</h6>
                        </div>
                        <div class="log-in-button">
                            <ul>
                                <li>
                                    <a href="https://www.google.com/" target="_blank"> <i class="fa-brands fa-google me-2">
                                        </i>Google</a>
                                </li>
                                <li>
                                    <a href="https://www.facebook.com/" target="_blank"><i
                                            class="fa-brands fa-facebook-f me-2"></i>Facebook </a>
                                </li>
                            </ul>
                        </div>
                        <div class="other-log-in"></div>
                        <div class="sign-up-box">
                            <p>Bạn chưa có tài khoản?</p><a href="{{ route('tai-khoan.dang-ky') }}">Đăng Ký</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
