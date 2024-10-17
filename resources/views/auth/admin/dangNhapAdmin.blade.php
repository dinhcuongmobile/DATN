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
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Namad Store</h1>
                                    </div>
                                    @if (session('success'))
                                        <div class="alert alert-success" id="success-alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger" id="error-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <form id="loginForm" action="{{ route('auth.dang-nhap-admin') }}" method="POST"
                                        class="user">
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
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Ghi nhớ</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block"
                                            onsubmit="ajaxAuth()">Đăng nhập</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('auth.quen-mat-khau-admin') }}">Quên mật khẩu</a>
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
