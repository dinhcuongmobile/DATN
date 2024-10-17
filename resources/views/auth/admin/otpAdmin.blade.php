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
                                        <h1 class="h4 text-gray-900 mb-2">Xác nhận OTP</h1>
                                        <p class="mb-4">Hãy kiểm tra Email của bạn. Chúng tôi đã gửi một mã OTP, bạn hãy
                                            nhập xuống bên dưới để xác nhận!
                                        </p>
                                    </div>
                                    {{-- @if (session('error'))
                                        <div class="alert alert-danger" id="error-alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif --}}
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            @foreach (session('error') as $key => $message)
                                                {{ $message }}
                                            @endforeach
                                        </div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success" id="success-alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <form id="loginForm" action="{{ route('auth.verify-otp-admin') }}" method="POST"
                                        class="user">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ request('v') }}">
                                        {{-- v là mã hóa email bên controller --}}
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control form-control-user text-center @error('otp') is-invalid @enderror"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Nhập OTP..." name="otp" maxlength="4">
                                        </div>
                                        <p class="Err text-danger otp-error mt-3">
                                            @error('otp')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                        <p class="Err text-danger email-error mt-3">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                        <hr>
                                        <button type="submit" class="btn btn-primary btn-user btn-block"
                                            onsubmit="ajaxAuth()">Xác nhận</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <form action="{{ route('auth.gui-lai-otp-admin') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="email" value="{{ request('v') }}">
                                            <span class="mr-2">Bạn chưa nhận được mã OTP </span>
                                            <button type="submit" class="btn btn-primary smail">Gửi lại</button>
                                        </form>
                                    </div>
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
