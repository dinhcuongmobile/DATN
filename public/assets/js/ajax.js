// Ajax đăng nhập, đăng kí, quên mật khẩu

function ajaxAuth(){
    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            e.preventDefault(); // Ngăn chặn submit mặc định của form

            const method = this.method;

            // Xóa các thông báo lỗi cũ trước khi gửi
            $('.email-error').text('');
            $('.password-error').text('');
            $('.ho_va_ten-error').text('');
            $('.confirm_password-error').text('');
            $('.otp-error').text('');

            $.ajax({
                url: $(this).attr('action'), // URL từ thuộc tính action của form
                method: method,
                data: $(this).serialize(), // Gửi dữ liệu form
                success: function(response) {
                    // Kiểm tra nếu đăng nhập thành công
                    if (response.success) {
                        window.location.href = response
                        .redirect_url; // Điều hướng đến trang khác nếu cần
                    }
                },
                error: function(xhr) {
                    // Nếu có lỗi xác thực, lấy lỗi từ phản hồi JSON
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.email) {
                            $('.email-error').text(errors.email[0]);
                        }
                        if (errors.password) {
                            $('.password-error').text(errors.password[0]);
                        }
                        if (errors.ho_va_ten) {
                            $('.ho_va_ten-error').text(errors.ho_va_ten[0]);
                        }
                        if (errors.confirm_password) {
                            $('.confirm_password-error').text(errors.confirm_password[0]);
                        }
                        if (errors.otp) {
                            $('.otp-error').text(errors.otp[0]);
                        }
                    }
                }
            });
        });
    });
}
ajaxAuth();

// -----------------------------------------------------------------------------
