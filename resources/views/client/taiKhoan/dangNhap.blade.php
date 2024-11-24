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
                            <div class="alert alert-danger">
                                {{ session('error') }}
                                @if (session('error') === 'Tài khoản của bạn chưa được xác thực !')
                                    <a href="{{ session('resend_verification_url') }}"
                                        style="color: #229ec7; margin-left: 10px; text-decoration: underline;">Gửi
                                        lại
                                        email
                                        xác thực.</a>
                                @endif
                            </div>
                        @endif
                        <div class="login-box">
                            <form id="loginForm" action="{{ route('tai-khoan.dang-nhap') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input class="form-control @error('email') is-invalid @enderror"
                                             type="" placeholder="name@example.com"
                                            value="{{ old('email') }}" name="email">
                                        <label for="">Email</label>
                                    </div>
                                    <p class="Err text-danger email-error">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating password">
                                        <input class="form-control inputPassword @error('password') is-invalid @enderror"
                                             type="password" placeholder="Password confirm"
                                            value="" name="password">
                                        <span class="toggle-password">
                                            <i class="fas fa-eye-slash"></i>
                                        </span>
                                        <label for="">Mật Khẩu</label>
                                    </div>
                                    <p class="Err text-danger password-error">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div class="forgot-box">
                                        <div>
                                            <input class="custom-checkbox me-2" id="category1" type="checkbox"
                                                name="remember">
                                            <label for="category1">Ghi nhớ</label>
                                        </div>
                                        <a href="{{ route('tai-khoan.quen-mat-khau') }}">Quên Mật Khẩu?</a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn login btn_black sm" type="submit" data-bs-dismiss="modal"
                                        aria-label="Close" onsubmit="ajaxAuth()">Đăng Nhập</button>
                                </div>
                            </form>
                        </div>
                        <div class="other-log-in">
                            <h6>Hoặc</h6>
                        </div>
                        <div class="log-in-button">
                            <ul>
                                <li>
                                    <a href="{{ route('auth.google') }}"> <i class="fa-brands fa-google me-2">
                                        </i>Google</a>
                                </li>
                                <li>
                                    <a href="{{ route('auth.facebook') }}"><i
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

@section('js')
    <script>
        // Lưu thông tin đăng nhập vào cookie
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy giá trị từ cookie
            var email = getCookie('remember_cookie');
            if (email) {
                document.querySelector('input[name="email"]').value = email;
                document.querySelector('input[name="remember"]').checked = true;
            }
        });

        // Hàm lấy giá trị cookie
        function getCookie(name) {
            var value = "; " + document.cookie;
            var parts = value.split("; " + name + "=");
            if (parts.length == 2) return parts.pop().split(";").shift();
        }
    </script>
@endsection
