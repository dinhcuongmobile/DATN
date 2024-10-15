@extends('auth.admin.layouts.main')

@section('content')
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Đặt lại mật khẩu</h1>
                            </div>
                            @if (session('error'))
                                <div class="alert alert-danger" id="error-alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @error('email')
                                <div class="alert alert-danger" id="error-alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <form action="{{ route('auth.dat-lai-mat-khau-admin') }}" method="POST" class="user">
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
                                        @error('password')
                                            <p class="Err text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 mt-3 mb-sm-0">
                                        <input type="password"
                                            class="form-control form-control-user @error('confirm_password') is-invalid @enderror"
                                            id="exampleRepeatPassword" placeholder="Nhập lại mật khẩu mới..."
                                            name="confirm_password">
                                        @error('confirm_password')
                                            <p class="Err text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
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
@endsection
