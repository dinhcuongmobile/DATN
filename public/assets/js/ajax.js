// Ajax đăng nhập, đăng kí, quên mật khẩu
document.addEventListener('DOMContentLoaded', () => {
    ajaxAuth();
    ajaxResetPassword();
    ajaxThemDiaChi();
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
                    }else{
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
                    }else{
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
                        let checked = "";
                        let diaChiChiTiet = "";
                        if(response.dia_chi.trang_thai==1) checked = "checked";
                        if(response.dia_chi.dia_chi_chi_tiet) diaChiChiTiet = response.dia_chi.dia_chi_chi_tiet + ", " ;
                        $('#address .dia-chi-item').append(
                            `<div class="col-xxl-4 col-md-6">
                                <div class="address-option">
                                    <label for="address-billing-0">
                                        <span class="delivery-address-box">
                                            <span class="form-check">
                                                <input class="custom-radio" id="address-billing-0"
                                                    type="radio" name="radio" ${checked}>
                                            </span>
                                            <span class="address-detail">
                                                <span class="address">
                                                    <span class="address-title">${response.dia_chi.ho_va_ten_nhan}</span>
                                                </span>
                                                <span class="address">
                                                    <span class="address-home">
                                                        <span class="address-tag">Địa chỉ :</span>
                                                        ${diaChiChiTiet}
                                                        ${response.dia_chi.phuong_xa.ten_phuong_xa},
                                                        ${response.dia_chi.quan_huyen.ten_quan_huyen},
                                                        ${response.dia_chi.tinh_thanh_pho.ten_tinh_thanh_pho}
                                                    </span>
                                                </span>
                                                <span class="address">
                                                    <span class="address-home">
                                                        <span class="address-tag">Số điện thoại :</span>${response.dia_chi.so_dien_thoai_nhan}</span>
                                                </span>
                                            </span>
                                        </span>
                                        <span class="buttons">
                                            <a class="btn btn_black sm" href="#"
                                                data-bs-toggle="modal" data-bs-target="#edit-box"
                                                title="Quick View" tabindex="0">Sửa
                                            </a>
                                            <a class="btn btn_outline sm" href="#"
                                                data-bs-toggle="modal" data-bs-target="#bank-card-modal"
                                                title="Quick View" tabindex="0">Xóa
                                            </a>
                                        </span>
                                    </label>
                                </div>
                            </div>`
                        );
                        $('#add-address').modal('hide');
                    }else{
                        window.location.href = response
                        .redirect_url; // Điều hướng đến trang khác nếu cần
                    }
                },
                error: function(xhr) {
                    // Nếu có lỗi xác thực, lấy lỗi từ phản hồi JSON
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        for (let key in errors) {
                            $('.' + key + '-error-dia-chi').text(errors[key][0]);
                        }
                    }
                }
            });
        });
    });
}

