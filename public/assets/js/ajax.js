// Ajax đăng nhập, đăng kí, quên mật khẩu
document.addEventListener('DOMContentLoaded', () => {
    ajaxAuth();
    ajaxResetPassword();
});
function ajaxAuth(){
    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            e.preventDefault(); // Ngăn chặn submit mặc định của form

            const method = this.method;

            // Xóa các thông báo lỗi cũ trước khi gửi
            $('.Err').text('');

            $.ajax({
                url: $(this).attr('action'), // URL từ thuộc tính action của form
                method: method,
                data: $(this).serialize(), // Gửi dữ liệu form
                success: function(response) {
                    // Kiểm tra nếu gửi form thành công
                    if (response.success) {
                        window.location.href = response
                        .redirect_url; // Điều hướng đến trang khác nếu cần
                    }
                },
                error: function(xhr) {
                    // Nếu có lỗi xác thực, lấy lỗi từ phản hồi JSON
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        for (let key in errors) {
                            $('.' + key + '-error').text(errors[key][0]);
                        }
                    }
                }
            });
        });
    });
}

// -----------------------------------------------------------------------------

function ajaxResetPassword(){
    $(document).ready(function() {
        $('#resetPasswordForm').on('submit', function(e) {
            e.preventDefault(); // Ngăn chặn submit mặc định của form

            const method = this.method;

            // Xóa các thông báo lỗi cũ trước khi gửi
            $('.Err').text('');

            $.ajax({
                url: $(this).attr('action'), // URL từ thuộc tính action của form
                method: method,
                data: $(this).serialize(), // Gửi dữ liệu form
                success: function(response) {
                    // Kiểm tra nếu gửi form thành công
                    if (response.success) {
                        window.location.href = response
                        .redirect_url; // Điều hướng đến trang khác nếu cần
                    }
                },
                error: function(xhr) {
                    // Nếu có lỗi xác thực, lấy lỗi từ phản hồi JSON
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        for (let key in errors) {
                            $('.' + key + '-error').text(errors[key][0]);
                        }
                    }
                }
            });
        });
    });
}

// them địa chỉ mới
function ajaxThemDiaChi(){
    $(document).ready(function() {
        $('#themDiaChiMoi').on('submit', function(e) {
            e.preventDefault(); // Ngăn chặn submit mặc định của form

            const method = this.method;

            // Xóa các thông báo lỗi cũ trước khi gửi
            $('.Err').text('');

            $.ajax({
                url: $(this).attr('action'), // URL từ thuộc tính action của form
                method: method,
                data: $(this).serialize(), // Gửi dữ liệu form
                success: function(response) {
                    // Kiểm tra nếu gửi form thành công
                    if (response.success) {
                        window.location.href = response
                        .redirect_url; // Điều hướng đến trang khác nếu cần
                    }
                },
                error: function(xhr) {
                    // Nếu có lỗi xác thực, lấy lỗi từ phản hồi JSON
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        for (let key in errors) {
                            $('.' + key + '-error').text(errors[key][0]);
                        }
                    }
                }
            });
        });
    });
}

