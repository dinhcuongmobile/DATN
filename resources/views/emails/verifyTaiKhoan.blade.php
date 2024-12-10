<h1>Chào {{ $user->ho_va_ten }},</h1>
<p>Cảm ơn bạn đã đăng ký tài khoản trên trang web của chúng tôi.</p>
<p>Vui lòng nhấp vào liên kết dưới đây để xác nhận địa chỉ email của bạn:</p>
<a href="{{ route('tai-khoan.verify-email', $user->email_verification_token) }}">Xác nhận email</a>
<p>Trân trọng,<br>Namad Store</p>
