@extends('client.layout.main')
@section('container')
    <section class="section-b-space pt-0">
        <div class="heading-banner">
            <div class="custom-container container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4>Đặt lại mật khẩu</h4>
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
                            <h4>Đặt lại mật khẩu</h4>
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
                            <form action="{{ route('tai-khoan.doi-lai-mat-khau') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input class="form-control" id="floatingInputValue1" type="email"
                                            placeholder="name@example.com" value="{{ request()->email }}" name="email">
                                        <label for="floatingInputValue1">Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input class="form-control @error('password') is-invalid @enderror" id="floatingInputValue2" type="password"
                                            placeholder="Password" value="" name="password">
                                        <label for="floatingInputValue2">Mật Khẩu</label>
                                    </div>
                                    @error('password')
                                        <p class="Err text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input class="form-control @error('confirm_password') is-invalid @enderror" id="floatingInputValue2" type="password"
                                            placeholder="Confirm password" value="" name="confirm_password">
                                        <label for="floatingInputValue2">Nhập lại mật Khẩu</label>
                                    </div>
                                    @error('confirm_password')
                                        <p class="Err text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button class="btn login btn_black sm" type="submit">Xác nhận</button>
                                </div>
                            </form>
                        </div>
                        <div class="other-log-in"></div>
                        <div class="sign-up-box">
                            <p>Hoặc</p><a href="{{ route('tai-khoan.dang-nhap') }}">Quay lại đăng Nhập </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
