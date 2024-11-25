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
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img src="{{asset('assets/images/Bìa Sơ Mi Bò Xanh.webp')}}" alt="Err" width="450" height="470">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="{{asset('assets/images/logo/logo_namad.png')}}" alt="Err" width="280" height="70">
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
                                    <form id="loginForm" action="{{ route('auth.dang-nhap-admin') }}" method="POST"
                                        class="user mt-3">
                                        @csrf
                                        <div class="form-group">
                                            <input
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Nhập email..." name="email" value="{{ old('email') }}">
                                        </div>
                                        <p class="Err text-danger email-error">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                id="exampleInputPassword" placeholder="Mật khẩu" name="password">
                                        </div>
                                        <p class="Err text-danger password-error">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                        <button type="submit" class="btn btn-primary btn-user btn-block"
                                            onsubmit="ajaxAuth()">Đăng Nhập</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('auth.quen-mat-khau-admin') }}">Quên Mật Khẩu?</a>
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
