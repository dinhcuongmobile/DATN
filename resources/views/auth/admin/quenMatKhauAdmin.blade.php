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
                            <div class="col-lg-6 d-none d-lg-block bg-password-image">
                                <img src="{{asset('assets/images/blog/3.jpg')}}" alt="Err" width="440" height="400">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Quên Mật Khẩu</h1>
                                        <p class="mb-4">Hãy Nhập Email Để Chúng Tôi Gửi Mã Xác Nhận
                                        </p>
                                    </div>
                                    @if (session('error'))
                                        <div class="alert alert-danger" id="error-alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <form id="loginForm" action="{{ route('auth.gui-otp-admin') }}" method="POST" class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email"
                                                class="form-control form-control-user @error('otp') is-invalid @enderror"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Nhập địa chỉ Email..." name="email"
                                                value="{{ old('email') }}">
                                        </div>
                                        <p class="Err text-danger email-error">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                        <button type="submit" class="btn btn-primary btn-user btn-block" onsubmit="ajaxAuth()">Xác Nhận</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('auth.dang-nhap-admin') }}">Quay Lại Đăng Nhập</a>
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
