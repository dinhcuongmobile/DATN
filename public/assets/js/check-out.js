document.addEventListener('DOMContentLoaded',()=>{
    ajaxThemDiaChiCheckOut();
    chonMaKhuyenMai();
});

document.querySelector('.cart-listing #chon-voucher').addEventListener('click',function(){
    $('#popup-voucher').modal('show');
});

document.querySelector('.right-sidebar-checkout .toggle-button').addEventListener('click', function() {
    this.classList.toggle('active');

    const soCoin = parseFloat(document.querySelector('.summary-total .tongCoin').textContent) || 0;
    let tongThanhToan = parseFloat(document.querySelector('.tongThanhToan').textContent.replace(/[đ,.]/g, '')) || 0;

    if (this.classList.contains('active')) {
        tongThanhToan -= soCoin;
    } else {
        tongThanhToan += soCoin;
    }

    document.querySelector('.tongThanhToan').textContent = `${tongThanhToan.toLocaleString('vi-VN')}đ`;
});


document.querySelector('#popup-voucher .card-footer .btnQuayLai').addEventListener('click',function(){
    $('#popup-voucher').modal('hide');
});

document.querySelectorAll(".address-option #address-billing-0").forEach(function(el){
    el.addEventListener('click',function(){
        let maQuanHuyen = el.getAttribute('data-maQuanHuyen');

        $.ajax({
            type: 'GET',
            url: '/gio-hang/tinh-phi-ship-dia-chi',
            data: {
                ma_quan_huyen: maQuanHuyen,
            },
            success: function(response) {
                if(response.phi_ships){

                    document.querySelector('#tienPhiShip').textContent = "0đ";
                    document.querySelector('.tongPhiVanChuyen').textContent = "0đ";
                    document.querySelector('.tongThanhToan').textContent = "0đ";
                    document.querySelector('.giamTienVanChuyen').textContent = "0đ";
                    document.querySelector('#popup-voucher input[name="ma_giam_gia_van_chuyen"]:checked').checked=false;

                    // Cập nhật lại phí vận chuyển mới
                    document.querySelector('#tienPhiShip').textContent = `${response.phi_ships.phi_ship.toLocaleString('vi-VN')}đ`;
                    const phiShipGoc = parseFloat(document.querySelector('#tienPhiShip').textContent.replace(/[đ,.]/g, '')) || 0;
                    const giamTienVanChuyen = parseFloat(document.querySelector('.giamTienVanChuyen').textContent.replace(/[đ,.-]/g, '')) || 0;

                    document.querySelector('.tongPhiVanChuyen').textContent = `${(phiShipGoc - giamTienVanChuyen).toLocaleString('vi-VN')}đ`;

                    const tongPhiVanChuyen = parseFloat(document.querySelector('.tongPhiVanChuyen').textContent.replace(/[đ,.]/g, '')) || 0;
                    const tongTienHang = parseFloat(document.querySelector('.tongTienHang').textContent.replace(/[đ,.]/g, '')) || 0;
                    document.querySelector('.tongThanhToan').textContent = `${(tongTienHang + tongPhiVanChuyen).toLocaleString('vi-VN')}đ`;
                }else{
                    document.querySelector('#tienPhiShip').textContent = "0đ";
                }
            },
            error: function(error) {
                console.log(error);
                alert("Có lỗi xảy ra khi gửi yêu cầu.");
            }
        });
    });
});


// them địa chỉ mới
function ajaxThemDiaChiCheckOut(){
    $(document).ready(function() {
        $('#add-address-checkout #themDiaChiMoiCheckOut').on('submit', function(e) {
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
                        $('#add-address-checkout').modal('hide');
                        window.location.href = response.redirect_url;
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

function chonMaKhuyenMai() {
    const btnChonVoucher = document.querySelector('#popup-voucher .btnXacNhan');
    if (!btnChonVoucher) return;

    const idMaVanChuyen = document.querySelectorAll('#popup-voucher input[name="ma_giam_gia_van_chuyen"]');
    const idMaDonHang = document.querySelectorAll('#popup-voucher input[name="ma_giam_gia_don_hang"]');

    // Bật nút Xác Nhận khi chọn mã vận chuyển hoặc mã đơn hàng
    [...idMaVanChuyen, ...idMaDonHang].forEach((input) => {
        input.addEventListener('change', () => {
            btnChonVoucher.disabled = false;
        });
    });

    // Xử lý khi nhấn nút Xác Nhận
    btnChonVoucher.addEventListener('click', function () {
        const selectedMaVanChuyen = document.querySelector('#popup-voucher input[name="ma_giam_gia_van_chuyen"]:checked');
        const selectedMaDonHang = document.querySelector('#popup-voucher input[name="ma_giam_gia_don_hang"]:checked');

        const maVanChuyenId = selectedMaVanChuyen ? selectedMaVanChuyen.value : null;
        const maDonHangId = selectedMaDonHang ? selectedMaDonHang.value : null;

        $.ajax({
            url: '/gio-hang/chon-ma-giam-gia',
            method: 'get',
            data: {
                maVanChuyenId: maVanChuyenId,
                maDonHangId: maDonHangId
            },
            success: function (response) {
                if (response.success) {
                    const phiShipGoc = parseFloat(document.querySelector('#tienPhiShip').textContent.replace(/[đ,.]/g, '')) || 0;
                    const thanhTienGoc = parseFloat(document.querySelector('.summary-total .thanhTien').textContent.replace(/[đ,.]/g, '')) || 0;

                    // Cập nhật giảm giá vận chuyển
                    if (response.giamGiaVanChuyen) {
                        const giamTienVanChuyen = response.giamGiaVanChuyen.so_tien_giam;
                        document.querySelector('.giamTienVanChuyen').textContent = `-${giamTienVanChuyen.toLocaleString('vi-VN')}đ`;
                        document.querySelector('.tongPhiVanChuyen').textContent = `${(phiShipGoc - giamTienVanChuyen).toLocaleString('vi-VN')}đ`;
                        // Kiểm tra nếu giảm giá vận chuyển lớn hơn phí ship gốc
                        const tienGiamGiaVanChuyen = phiShipGoc > giamTienVanChuyen ? giamTienVanChuyen : phiShipGoc;

                        // Cập nhật giảm giá vận chuyển
                        if (tienGiamGiaVanChuyen > 0) {
                            document.querySelector('.giamTienVanChuyen').textContent = `-${tienGiamGiaVanChuyen.toLocaleString('vi-VN')}đ`;
                            // Cập nhật tổng phí vận chuyển sau khi giảm giá
                            document.querySelector('.tongPhiVanChuyen').textContent = `${(phiShipGoc - tienGiamGiaVanChuyen).toLocaleString('vi-VN')}đ`;
                        }
                    }

                    // Cập nhật giảm giá đơn hàng
                    if (response.giamGiaDonHang) {
                        const giamTienDonHang = response.giamGiaDonHang.so_tien_giam;
                        document.querySelector('.giamTienDonHang').textContent = `-${giamTienDonHang.toLocaleString('vi-VN')}đ`;
                        document.querySelector('.tongTienHang').textContent = `${(thanhTienGoc - giamTienDonHang).toLocaleString('vi-VN')}đ`;
                    }

                    // Cập nhật tổng tiền thanh toán
                    const tongTienHang = parseFloat(document.querySelector('.tongTienHang').textContent.replace(/[đ,.]/g, '')) || 0;
                    const tongPhiVanChuyen = parseFloat(document.querySelector('.tongPhiVanChuyen').textContent.replace(/[đ,.]/g, '')) || 0;
                    document.querySelector('.tongThanhToan').textContent = `${(tongTienHang + tongPhiVanChuyen).toLocaleString('vi-VN')}đ`;

                    // Đóng popup
                    $('#popup-voucher').modal('hide');
                }
            },
            error: function () {
                alert("Có lỗi xảy ra. Vui lòng thử lại.");
            }
        });
    });
}




