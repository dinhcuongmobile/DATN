<div class="container">
    <h2>Namad Store xin chào</h2>
    <p>Chúng tôi đã nhận được yêu cầu đổi mật khẩu cho tài khoản của bạn. Dưới đây là mã OTP của bạn:</p>
    <div class="otp">
        {{ $otp }}
    </div>
    <p>Không chia sẻ mã OTP cho bất kỳ ai.</p>
    <p>Mã OTP này có hiệu lực trong 5 phút. Nếu bạn không yêu cầu đổi mật khẩu, vui lòng bỏ qua email này.</p>
    <p>Trân trọng,<br>{{ config('app.name') }}</p>
    <div class="footer">
        &copy; {{ date('Y') }} {{ config('app.name') }}. Namad Store.
    </div>
</div>