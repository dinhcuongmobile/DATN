@extends('auth.admin.layouts.main')
@section('css')
    <style>
        .otp-input {
    width: 60px;        /* Tăng kích thước ô nhập */
    height: 60px;       /* Tăng chiều cao ô nhập */
    font-size: 24px;    /* Tăng kích thước chữ */
    margin: 0 10px;     /* Giãn cách giữa các ô */
    text-align: center; /* Canh giữa ký tự */
    border-radius: 8px; /* Bo góc cho đẹp */
    border: 1px solid #ccc; /* Đường viền ô nhập */
}

.otp-input::placeholder {
    font-size: 24px;
}

.form-group {
    display: flex;
    justify-content: space-around;
}

    </style>
@endsection
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
                                <img src="{{asset('assets/images/user/9.jpg')}}" alt="Err" width="450" height="480">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Xác nhận OTP</h1>
                                        <p class="mb-4">Hãy kiểm tra Email của bạn. Chúng tôi đã gửi mã OTP, bạn hãy
                                            nhập mã vào ô bên dưới!
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
                                        <div class="form-group d-flex justify-content-between">
                                            <input type="password" class="otp-input form-control text-center @error('otp') is-invalid @enderror" maxlength="1" id="otp1" name="otp[]" autofocus placeholder="0">
                                            <input type="password" class="otp-input form-control text-center @error('otp') is-invalid @enderror" maxlength="1" id="otp2" name="otp[]" placeholder="0">
                                            <input type="password" class="otp-input form-control text-center @error('otp') is-invalid @enderror" maxlength="1" id="otp3" name="otp[]" placeholder="0">
                                            <input type="password" class="otp-input form-control text-center @error('otp') is-invalid @enderror" maxlength="1" id="otp4" name="otp[]" placeholder="0">
                                        </div>
                                    
                                        {{-- <div class="form-group">
                                            <input type="text"
                                                class="form-control form-control-user text-center @error('otp') is-invalid @enderror"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Nhập OTP..." name="otp" maxlength="4">
                                        </div> --}}
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
                                            onsubmit="ajaxAuth()">Xác Nhận</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <form action="{{ route('auth.gui-lai-otp-admin') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="email" value="{{ request('v') }}">
                                            <span class="mr-2">Bạn chưa nhận được mã OTP </span>
                                            <button type="submit" class="btn btn-primary smail">Gửi Lại</button>
                                        </form>
                                    </div>
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
