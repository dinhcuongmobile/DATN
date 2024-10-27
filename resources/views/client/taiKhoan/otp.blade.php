@extends('client.layout.main')
@section('container')
    <section class="section-b-space pt-0">
        <div class="heading-banner">
            <div class="custom-container container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4>Quên mật khẩu</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-b-space pt-0 login-bg-img">
        <div class="custom-container container login-page">
            <div class="row align-items-center">
                <div class="col-xxl-7 col-6 d-none d-lg-block">
                    <div class="login-img">
                        <img class="img-fluid" src="https://themes.pixelstrap.net/katie/assets/images/login/1.svg"
                            alt="">
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6 mx-auto">
                    <div class="log-in-box">
                        @if (session('error'))
                            <div class="alert alert-danger" id="error-alert">
                                <ul>
                                    @foreach (session('error') as $key => $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success" id="error-alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="log-in-title">
                            <h4>Vui lòng nhập OTP để xác minh tài khoản của bạn</h4>
                        </div>
                        <div class="login-box">
                            <form id="loginForm" action="{{ route('tai-khoan.verify-otp') }}" method="post"
                                class="row g-3">
                                @csrf
                                <div class="col-12">
                                    <input type="hidden" name="email" value="{{ request('v') }}">
                                    {{-- v là email đã được mã hóa bên controller --}}
                                    <div id="otp-container" class="otp-input">
                                        <input class="form-control text-center" id="otp1" type="number" maxlength="1"
                                            oninput="moveToNext(this, 'otp2')" onkeydown="moveToPrev(event, this, 'otp1')"
                                            placeholder="0" />
                                        <input class="form-control text-center" id="otp2" type="number" maxlength="1"
                                            oninput="moveToNext(this, 'otp3')" onkeydown="moveToPrev(event, this, 'otp1')"
                                            placeholder="0" />
                                        <input class="form-control text-center" id="otp3" type="number" maxlength="1"
                                            oninput="moveToNext(this, 'otp4')" onkeydown="moveToPrev(event, this, 'otp2')"
                                            placeholder="0" />
                                        <input class="form-control text-center" id="otp4" type="number" maxlength="1"
                                            oninput="lastInput(this)" onkeydown="moveToPrev(event, this, 'otp3')"
                                            placeholder="0" />
                                    </div>
                                    <input type="hidden" id="hidden-otp" name="otp" />
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
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn login btn_black sm" onsubmit="ajaxAuth()">Xác
                                        nhận</button>
                                </div>
                            </form>
                            <div class="other-log-in"></div>
                            <form action="{{ route('tai-khoan.gui-lai-otp') }}" method="post" class="sign-up-box">
                                @csrf
                                <div>
                                    <div class="forgot-box d-block">
                                        <input type="hidden" name="email" value="{{ request('v') }}">
                                        {{-- v là email đã được mã hóa bên controller --}}
                                        <p>Bạn chưa nhận được code ?</p>
                                        <button type="submit" class="btn btn-orange sm text-decoration-underline">Gửi
                                            lại</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="other-log-in"></div>
                        <div class="sign-up-box">
                            <a class="text-decoration-underline" href="{{ route('tai-khoan.dang-nhap') }}">Đăng nhập</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- @section('js')
    <script>
        function moveToNext(current, nextFieldId) {
            current.value = current.value.replace(/[^0-9]/g, ''); // Chỉ cho phép số

            if (current.value.length > 1) {
                current.value = current.value.charAt(0); // Giữ lại ký tự đầu tiên nếu nhập nhiều hơn
            }

            if (current.value.length === 1) {
                document.getElementById(nextFieldId).focus();
            }
            combineOtp();
        }

        function moveToPrev(event, current, prevFieldId) {
            if (event.key === "Backspace" && current.value.length === 0) {
                document.getElementById(prevFieldId).focus();
            }
            combineOtp();
        }

        function lastInput(current) {
            current.value = current.value.replace(/[^0-9]/g, ''); // Chỉ cho phép số

            if (current.value.length > 1) {
                current.value = current.value.charAt(0); // Giữ lại ký tự đầu tiên nếu nhập nhiều hơn
            }
            combineOtp();
        }

        function combineOtp() {
            let otp = '';
            for (let i = 1; i <= 4; i++) {
                otp += document.getElementById('otp' + i).value;
            }
            document.getElementById('hidden-otp').value = otp;
        }

        document.getElementById('otp-container').addEventListener('paste', function(event) {
            const pasteData = event.clipboardData.getData('text');
            if (pasteData.length === 4 && /^\d{4}$/.test(pasteData)) {
                for (let i = 0; i < 4; i++) {
                    document.getElementById('otp' + (i + 1)).value = pasteData[i];
                }
                combineOtp();
                document.getElementById('otp4').focus();
            }
            event.preventDefault();
        });
    </script>
@endsection --}}
