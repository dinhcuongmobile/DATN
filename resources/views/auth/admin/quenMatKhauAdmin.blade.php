@extends('auth.admin.layouts.main')

@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Quên mật khẩu</h1>
                                        <p class="mb-4">Chúng tôi hiểu, mọi chuyện đều có thể xảy ra. Chỉ cần nhập địa chỉ
                                            email của bạn bên dưới và chúng tôi sẽ gửi cho bạn mã OTP để đặt lại mật khẩu!
                                        </p>
                                    </div>
                                    @if (session('error'))
                                        <div class="alert alert-danger" id="error-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <form action="{{ route('auth.gui-otp-admin') }}" method="POST" class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email"
                                                class="form-control form-control-user @error('otp') is-invalid @enderror"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Nhập địa chỉ Email..." name="email"
                                                value="{{ old('email') }}">
                                        </div>
                                        @error('email')
                                            <p class="Err text-danger">{{ $message }}</p>
                                        @enderror
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Xác nhận</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('auth.dang-nhap-admin') }}">Quay lại đăng nhập</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
