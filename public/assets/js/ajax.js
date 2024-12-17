// Ajax đăng nhập, đăng kí, quên mật khẩu
document.addEventListener('DOMContentLoaded', () => {
    suaThongTin();
    ajaxAuth();
    ajaxResetPassword();
    ajaxThemDiaChi();
    xoaDiaChi();
    suaDiaChi();
    thietLapDiaChiMacDinh();
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
                        var btnXoa = "";
                        let disabledd = "";
                        if(response.dia_chi.trang_thai==1) checked = "checked";

                        if(response.dia_chi.dia_chi_chi_tiet) diaChiChiTiet = response.dia_chi.dia_chi_chi_tiet + ", " ;
                        let diaChi = `${diaChiChiTiet}${response.dia_chi.phuong_xa.ten_phuong_xa}, ${response.dia_chi.quan_huyen.ten_quan_huyen}, ${response.dia_chi.tinh_thanh_pho.ten_tinh_thanh_pho}.`;
                        let text = diaChi;
                        let truncatedText = text.length > 50 ? text.slice(0, 50) + "..." : text;


                        if(response.dia_chi.trang_thai==2){
                            btnXoa = '<a class="btn btn_outline sm btnDelete" data-id="'+response.dia_chi.id+'" href="javascript:void(0)" title="delete">Xóa</a>';
                        }
                        if(response.dia_chi.trang_thai==1) disabledd = "disabled";
                        $('#address .dia-chi-item').append(
                            `<div class="col-xxl-4 col-md-6">
                                <div class="address-option">
                                    <label for="address-billing-0">
                                        <span class="delivery-address-box">
                                            <span class="address-detail" style="width: 100%">
                                                <span class="address">
                                                    <span class="address-title">${response.dia_chi.ho_va_ten_nhan}</span>
                                                </span>
                                                <span class="address">
                                                    <span class="address-home">
                                                        <span class="address-tag">Địa chỉ :</span>
                                                        <p class="dia-chi" style="display: inline">
                                                            ${truncatedText}
                                                        </p>
                                                    </span>
                                                </span>
                                                <span class="address">
                                                    <span class="address-home">
                                                        <span class="address-tag">Số điện thoại :</span>
                                                        <p class="so-dien-thoai" style="display: inline">${response.dia_chi.so_dien_thoai_nhan}</p>
                                                    </span>
                                                </span>
                                            </span>
                                        </span>
                                        <span class="buttons">
                                            <button class="btn btn_outline sm thietLapDiaChiMacDinh"
                                                    data-id="${response.dia_chi.id}" ${disabledd}>Thiết lập mặc định</button>
                                        </span>
                                        <span class="buttons actionsDiaChi">
                                            <a class="btn btn_black sm suaDiaChi" data-id="${response.dia_chi.id}" href="javascript:void(0)"
                                                title="edit" tabindex="0">Sửa
                                            </a>
                                            ${btnXoa}
                                        </span>
                                    </label>
                                </div>
                            </div>`
                        );

                        // Gọi lại hàm xoaDiaChi để gán sự kiện cho nút "Xóa"
                        xoaDiaChi();
                        suaDiaChi();
                        thietLapDiaChiMacDinh();

                        $('#add-address').modal('hide');
                        document.querySelectorAll('#add-address input').forEach((el) => {
                            if(el.name !== "_token"){
                                el.value = "";
                            }
                        });
                        document.querySelector('#add-address textarea').value = "";
                        document.querySelectorAll('#add-address select').forEach((el) => {
                            if (el.name !== "tinh_thanh_pho") {
                                Array.from(el.options).forEach(option => {
                                    if (option.value !== "") {
                                        option.remove();
                                    }
                                });
                            } else {
                                Array.from(el.options).forEach(option => {
                                    if (option.value === "") {
                                        option.selected = true;
                                    }
                                });
                            }
                        });

                    } else {
                        window.location.href = response.redirect_url; // Điều hướng đến trang khác nếu cần
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


//xoa dia chi thong tin tai khoan
function xoaDiaChi(){
    const btnDelete = document.querySelectorAll('#address .dia-chi-item .btnDelete');
    if(btnDelete){
        btnDelete.forEach((el) => {
            el.addEventListener('click',function(){
                let diaChiID = el.getAttribute('data-id');
                $.ajax({
                    url: '/tai-khoan/xoa-dia-chi',
                    method: 'get',
                    data: {
                        dia_chi_id: diaChiID,
                    },
                    success: function (response) {

                        if(response.success){
                            const row = el.closest('div.col-xxl-4');
                            if (row) {
                                row.remove();
                            }
                        }

                    },
                    error: function () {
                        alert("Có lỗi xảy ra. Vui lòng thử lại.");
                    }
                });

            })
        });
    }
}

function suaThongTin(){
    let thayDoiHoTen = document.querySelector(".profile-information .thayDoiHoTen");
    let thayDoiSDT = document.querySelector(".profile-information .thayDoiSDT");

    if(thayDoiHoTen && thayDoiSDT){
        const formHoVaTen = document.querySelector(".profile-information .form-hoVaTen");
        const formSDT = document.querySelector(".profile-information .form-SDT");
        thayDoiHoTen.addEventListener('click',function(){

            formSDT.style.display="none";

            if(formHoVaTen.style.display=="none"){

                formHoVaTen.style.display="flex";
                var hoVaTenErr = document.querySelector(".profile-information .form-hoVaTen p");
                hoVaTenErr.textContent="";

                document.querySelector(".profile-information .form-hoVaTen .btn-danger").addEventListener('click',function(){
                    let taiKhoanId = document.querySelector(".profile-information .form-hoVaTen .btn-danger").getAttribute('data-id');
                    const hoVaTen = document.querySelector(".profile-information .form-hoVaTen .form-control").value;
                    let token = document.querySelector(".profile-information .tokenThongTin").value;
                    if(hoVaTen==""){
                        hoVaTenErr.textContent="Vui lòng không bỏ trống !";
                    }else{
                        $.ajax({
                            url: '/tai-khoan/sua-thong-tin',
                            method: 'PUT',
                            data: {
                                _token: token,
                                user_id: taiKhoanId,
                                ho_va_ten: hoVaTen
                            },
                            success: function (response) {
                                if(response.success){
                                    thayDoiHoTen.closest('li').querySelector('p').textContent = response.user.ho_va_ten;
                                    thayDoiHoTen.closest('.my-dashboard-tab').querySelector(".dashboard-user-name h6 b").textContent= response.user.ho_va_ten;
                                    document.querySelector('.dashboard-left-sidebar .profile-name h4').textContent= response.user.ho_va_ten;
                                    formHoVaTen.style.display="none";
                                }

                            },
                            error: function () {
                                alert("Có lỗi xảy ra. Vui lòng thử lại.");
                            }
                        });
                    }
                });

            }else{
                formHoVaTen.style.display="none";
            }
        });

        thayDoiSDT.addEventListener('click',function(){
            formHoVaTen.style.display="none";
            if(formSDT.style.display=="none"){
                formSDT.style.display="flex";

                var SDTErr = document.querySelector(".profile-information .form-SDT p");
                SDTErr.textContent="";

                document.querySelector(".profile-information .form-SDT .btn-danger").addEventListener('click',function(){
                    let taiKhoanId = document.querySelector(".profile-information .form-SDT .btn-danger").getAttribute('data-id');
                    const SDT = document.querySelector(".profile-information .form-SDT .form-control").value;
                    let token = document.querySelector(".profile-information .tokenThongTin").value;
                    if(SDT=="" || !(/^(0[3|5|7|8|9])+([0-9]{8})$/.test(SDT))){
                        SDTErr.textContent="Số điện thoại không hợp lệ !";
                    }else{
                        $.ajax({
                            url: '/tai-khoan/sua-thong-tin',
                            method: 'PUT',
                            data: {
                                _token: token,
                                user_id: taiKhoanId,
                                so_dien_thoai: SDT
                            },
                            success: function (response) {
                                if(response.success){
                                    thayDoiSDT.closest('li').querySelector('p').textContent = response.user.so_dien_thoai;
                                    formSDT.style.display="none";
                                }

                            },
                            error: function () {
                                alert("Có lỗi xảy ra. Vui lòng thử lại.");
                            }
                        });
                    }
                });
            }else{
                formSDT.style.display="none";
            }
        });
    }
}

function suaDiaChi() {
    const btnSua = document.querySelectorAll("#address .suaDiaChi");
    if (!btnSua) return;

    btnSua.forEach((el) => {
        el.addEventListener('click', function () {
            const diaChiId = el.getAttribute('data-id');

            // Lấy dữ liệu địa chỉ để hiển thị trong modal
            $.ajax({
                url: '/tai-khoan/lay-dia-chi-sua',
                method: 'GET',
                data: { dia_chi_id: diaChiId },
                success: function (response) {
                    if (response.success) {
                        $("#edit-box").modal('show');
                        document.querySelector('#edit-box .hoVaTen p').textContent = "";
                        document.querySelector('#edit-box .soDienThoai p').textContent = "";
                        document.querySelector('#edit-box .tinhThanhPho p').textContent = "";
                        document.querySelector('#edit-box .quanHuyen p').textContent = "";
                        document.querySelector('#edit-box .phuongXa p').textContent = "";
                        populateEditForm(response);

                        document.querySelector('#edit-box .btn-submit').onclick = function () {
                            if (validateEditForm()) {
                                submitEditForm(diaChiId, el);
                            }
                        };
                    }
                },
                error: function () {
                    alert("Có lỗi xảy ra. Vui lòng thử lại.");
                }
            });
        });
    });
}

// Điền dữ liệu vào modal sửa địa chỉ
function populateEditForm(response) {
    document.querySelector('#edit-box .hoVaTen input').value = response.dia_chi.ho_va_ten_nhan;
    document.querySelector('#edit-box .soDienThoai input').value = response.dia_chi.so_dien_thoai_nhan;

    const tinhThanhPho = document.querySelector('#edit-box .tinhThanhPho select');
    response.tinh_thanh_pho.forEach(function(item){
        const selected = response.dia_chi.ma_tinh_thanh_pho === item.ma_tinh_thanh_pho ? "selected" : "";
        tinhThanhPho.insertAdjacentHTML('beforeend', `<option ${selected} value="${item.ma_tinh_thanh_pho}">${item.ten_tinh_thanh_pho}</option>`);
    });

    const quanHuyen = document.querySelector('#edit-box .quanHuyen select');
    response.quan_huyen.forEach(function(item){
        const selected = response.dia_chi.ma_quan_huyen === item.ma_quan_huyen ? "selected" : "";
        quanHuyen.insertAdjacentHTML('beforeend', `<option ${selected} value="${item.ma_quan_huyen}">${item.ten_quan_huyen}</option>`);
    });

    const phuongXa = document.querySelector('#edit-box .phuongXa select');
    response.phuong_xa.forEach(function(item){
        const selected = response.dia_chi.ma_phuong_xa === item.ma_phuong_xa ? "selected" : "";
        phuongXa.insertAdjacentHTML('beforeend', `<option ${selected} value="${item.ma_phuong_xa}">${item.ten_phuong_xa}</option>`);
    });

    document.querySelector('#edit-box .diaChiChiTiet textarea').value = response.dia_chi.dia_chi_chi_tiet || "";
}

// Xác thực các trường trong form trước khi gửi yêu cầu
function validateEditForm() {
    const hoVaTen = document.querySelector('#edit-box .hoVaTen input');
    const hoVaTenErr = document.querySelector('#edit-box .hoVaTen p');
    const soDienThoai = document.querySelector('#edit-box .soDienThoai input');
    const soDienThoaiErr = document.querySelector('#edit-box .soDienThoai p');
    const tinhThanhPho = document.querySelector('#edit-box .tinhThanhPho select');
    const tinhThanhPhoErr = document.querySelector('#edit-box .tinhThanhPho p');
    const quanHuyen = document.querySelector('#edit-box .quanHuyen select');
    const quanHuyenErr = document.querySelector('#edit-box .quanHuyen p');
    const phuongXa = document.querySelector('#edit-box .phuongXa select');
    const phuongXaErr = document.querySelector('#edit-box .phuongXa p');

    let isValid = true;

    if (hoVaTen.value.trim() === "") {
        hoVaTenErr.textContent = "Vui lòng không bỏ trống!";
        isValid = false;
    } else {
        hoVaTenErr.textContent = "";
    }

    const phonePattern = /^(0[3|5|7|8|9])+([0-9]{8})$/;
    if (!phonePattern.test(soDienThoai.value)) {
        soDienThoaiErr.textContent = "Số điện thoại không hợp lệ!";
        isValid = false;
    } else {
        soDienThoaiErr.textContent = "";
    }

    if (tinhThanhPho.value === "") {
        tinhThanhPhoErr.textContent = "Vui lòng chọn Tỉnh Thành Phố!";
        isValid = false;
    } else {
        tinhThanhPhoErr.textContent = "";
    }

    if (tinhThanhPho.value !== "" && quanHuyen.value === "") {
        quanHuyenErr.textContent = "Vui lòng chọn Quận/Huyện!";
        isValid = false;
    } else {
        quanHuyenErr.textContent = "";
    }

    if (tinhThanhPho.value !== "" && quanHuyen.value !== "" && phuongXa.value === "") {
        phuongXaErr.textContent = "Vui lòng chọn Phường/Xã!";
        isValid = false;
    } else {
        phuongXaErr.textContent = "";
    }

    return isValid;
}

// Gửi yêu cầu cập nhật địa chỉ
function submitEditForm(diaChiId, el) {
    $.ajax({
        url: '/tai-khoan/sua-dia-chi',
        method: 'PUT',
        data: {
            _token: document.querySelector('#edit-box .tokenSuaDiaChi').value,
            dia_chi_id: diaChiId,
            ho_va_ten_nhan: document.querySelector('#edit-box .hoVaTen input').value,
            so_dien_thoai_nhan: document.querySelector('#edit-box .soDienThoai input').value,
            ma_tinh_thanh_pho: document.querySelector('#edit-box .tinhThanhPho select').value,
            ma_quan_huyen: document.querySelector('#edit-box .quanHuyen select').value,
            ma_phuong_xa: document.querySelector('#edit-box .phuongXa select').value,
            dia_chi_chi_tiet: document.querySelector('#edit-box .diaChiChiTiet textarea').value
        },
        success: function (response) {
            if (response.success) {
                $("#edit-box").modal('hide');
                updateAddressDisplay(response, el.closest('div.address-option'));
            }
        },
        error: function () {
            alert("Có lỗi xảy ra. Vui lòng thử lại.");
        }
    });
}

// Cập nhật thông tin địa chỉ trong danh sách địa chỉ sau khi sửa thành công
function updateAddressDisplay(response, divCha) {
    divCha.querySelector('span.address-title').textContent = response.dia_chi.ho_va_ten_nhan;
    divCha.querySelector('.address-home .so-dien-thoai').textContent = response.dia_chi.so_dien_thoai_nhan;

    const diaChiChiTiet = response.dia_chi.dia_chi_chi_tiet ? response.dia_chi.dia_chi_chi_tiet + ", " : "";

    let diaChi = `${diaChiChiTiet}${response.dia_chi.phuong_xa.ten_phuong_xa}, ${response.dia_chi.quan_huyen.ten_quan_huyen}, ${response.dia_chi.tinh_thanh_pho.ten_tinh_thanh_pho}.`;
    let text = diaChi;
    let truncatedText = text.length > 50 ? text.slice(0, 50) + "..." : text;

    divCha.querySelector('.address-home .dia-chi').textContent = truncatedText;
}

function thietLapDiaChiMacDinh() {
    let btn = document.querySelectorAll('#address .thietLapDiaChiMacDinh');
    if (btn) {
        btn.forEach((el) => {
            el.addEventListener('click', function () {
                let diaChiID = el.getAttribute('data-id');
                $.ajax({
                    url: '/tai-khoan/thiet-lap-dia-chi-mac-dinh',
                    method: 'PUT',
                    data: {
                        _token: document.querySelector('#address .tokenThietLap').value,
                        dia_chi_id: diaChiID,
                    },
                    success: function (response) {
                        if (response.success) {

                            // Cập nhật trạng thái nút cho tất cả các nút thiết lập địa chỉ mặc định
                            btn.forEach((button) => {
                                button.disabled = false;
                                const actionsDiaChi = button.closest('.address-option').querySelector('.actionsDiaChi');
                                actionsDiaChi.innerHTML = `
                                    <a class="btn btn_black sm suaDiaChi" data-id="${button.getAttribute('data-id')}" href="javascript:void(0)"
                                        title="edit" tabindex="0">Sửa
                                    </a>
                                    <a class="btn btn_outline sm btnDelete" data-id="${button.getAttribute('data-id')}"
                                            href="javascript:void(0)" title="delete">Xóa
                                    </a>
                                `;
                            });

                            // Thiết lập lại trạng thái nút hiện tại
                            el.disabled = true;
                            const actionsDiaChi = el.closest('.address-option').querySelector('.actionsDiaChi');
                            actionsDiaChi.innerHTML = `
                                <a class="btn btn_black sm suaDiaChi" data-id="${el.getAttribute('data-id')}" href="javascript:void(0)"
                                    title="edit" tabindex="0">Sửa
                                </a>
                            `;

                            // Gọi lại sự kiện cho các nút mới
                            suaDiaChi();
                            xoaDiaChi();
                        }
                    },
                    error: function () {
                        alert("Có lỗi xảy ra. Vui lòng thử lại.");
                    }
                });
            });
        });
    }
}





