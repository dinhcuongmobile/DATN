@extends('auth.admin.layouts.main')

@section('content')
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image">
                        <img src="{{asset('assets/images/blog/layout-2.jpg')}}" alt="Err" width="380" height="420">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Đặt Lại Mật Khẩu</h1>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success" id="error-alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger" id="error-alert">
                                    @foreach (session('error') as $key => $message)
                                        {{ $message }}
                                    @endforeach
                                </div>
                            @endif
                            <form id="loginForm" action="{{ route('auth.dat-lai-mat-khau-admin') }}" method="POST"
                                class="user">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input class="form-control" type="hidden" value="{{ request('v') }}"
                                                name="email">
                                            {{-- v là mã hóa email bên controller --}}
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            id="exampleInputPassword" placeholder="Nhập mật khẩu mới..." name="password">
                                        <p class="Err text-danger password-error">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="col-sm-12 mt-3 mb-sm-0">
                                        <input type="password"
                                            class="form-control form-control-user @error('confirm_password') is-invalid @enderror"
                                            id="exampleRepeatPassword" placeholder="Nhập lại mật khẩu mới..."
                                            name="confirm_password">
                                        <p class="Err text-danger confirm_password-error">
                                            @error('confirm_password')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                    <p class="Err text-danger email-error">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block" onsubmit="ajaxAuth()">Xác
                                    Nhận</button>
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
@endsection
