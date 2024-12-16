document.addEventListener('DOMContentLoaded',()=>{
    ajaxThemDiaChiCheckOut();
    chonMaKhuyenMai();
    datHang();
});

document.querySelector('.cart-listing #chon-voucher').addEventListener('click',function(){
    $('#popup-voucher').modal('show');
});

document.querySelector('.right-sidebar-checkout .toggle-button')?.addEventListener('click', function() {
    this.classList.toggle('active');

    const soCoin = parseFloat(document.querySelector('.summary-total .tongCoin').textContent) || 0;
    let tongThanhToan = parseFloat(document.querySelector('.tongThanhToan').textContent.replace(/[đ,.]/g, '')) || 0;

    if (this.classList.contains('active')) {
        tongThanhToan = Math.max(0, tongThanhToan - soCoin);
    } else {
        tongThanhToan += soCoin;
    }

    document.querySelector('.tongThanhToan').textContent = `${tongThanhToan.toLocaleString('vi-VN')}đ`;
});


document.querySelector('#popup-voucher .card-footer .btnQuayLai').addEventListener('click',function(){
    $('#popup-voucher').modal('hide');
});

document.querySelectorAll(".address-option #address-billing-0").forEach(function(el) {
    el.addEventListener('click', function() {
        let maQuanHuyen = el.getAttribute('data-maQuanHuyen');

        $.ajax({
            type: 'GET',
            url: '/gio-hang/tinh-phi-ship-dia-chi',
            data: {
                ma_quan_huyen: maQuanHuyen,
            },
            success: function(response) {

                // Reset các giá trị liên quan đến phí vận chuyển và giảm giá vận chuyển
                document.querySelector('#tienPhiShip').textContent = "0đ";
                document.querySelector('.tongPhiVanChuyen').textContent = "0đ";
                document.querySelector('.giamTienVanChuyen').textContent = "0đ";
                document.querySelector('.tongThanhToan').textContent = "0đ";
                const namadXuActive = document.querySelector('.divTongCoin div.active');
                let namadXu=0;
                if(namadXuActive){
                    namadXu = parseInt(document.querySelector('.divTongCoin .tongCoin').textContent);
                }

                const tongTienHang = parseFloat(document.querySelector('.tongTienHang').textContent.replace(/[đ,.]/g, '')) || 0;
                document.querySelectorAll('#popup-voucher input[type="radio"][name="ma_giam_gia_van_chuyen"]').forEach((input) => {
                    input.checked = false;
                });

                if (response.phi_ships) {

                    // Cập nhật phí vận chuyển mới
                    document.querySelector('#tienPhiShip').textContent = `${response.phi_ships.phi_ship.toLocaleString('vi-VN')}đ`;
                    const phiShipGoc = parseFloat(document.querySelector('#tienPhiShip').textContent.replace(/[đ,.]/g, '')) || 0;
                    const giamTienVanChuyen = parseFloat(document.querySelector('.giamTienVanChuyen').textContent.replace(/[đ,.-]/g, '')) || 0;

                    // Áp dụng giảm giá vận chuyển với điều kiện không vượt quá phí ship gốc
                    const tongPhiVanChuyen = Math.max(0, phiShipGoc - giamTienVanChuyen);
                    document.querySelector('.tongPhiVanChuyen').textContent = `${tongPhiVanChuyen.toLocaleString('vi-VN')}đ`;

                    // Cập nhật tổng tiền thanh toán
                    document.querySelector('.tongThanhToan').textContent = `${(tongTienHang + tongPhiVanChuyen - namadXu).toLocaleString('vi-VN')}đ`;

                } else {
                    const giamTienDonHang = parseFloat(document.querySelector('.giamTienDonHang').textContent.replace(/[đ,.]/g, '')) || 0;
                    document.querySelector('.tongThanhToan').textContent = `${(tongTienHang + giamTienDonHang - namadXu).toLocaleString('vi-VN')}đ`;
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
                    const namadXuActive = document.querySelector('.divTongCoin div.active');
                    let namadXu=0;
                    if(namadXuActive){
                        namadXu = parseInt(document.querySelector('.divTongCoin .tongCoin').textContent);
                    }
                    // Cập nhật giảm giá vận chuyển
                    let tienGiamGiaVanChuyen = 0;
                    if (response.giamGiaVanChuyen) {
                        const giamTienVanChuyen = response.giamGiaVanChuyen.so_tien_giam;
                        tienGiamGiaVanChuyen = Math.min(phiShipGoc, giamTienVanChuyen); // Tránh giảm quá phí ship gốc
                        document.querySelector('.giamTienVanChuyen').textContent = `-${tienGiamGiaVanChuyen.toLocaleString('vi-VN')}đ`;
                        document.querySelector('.tongPhiVanChuyen').textContent = `${(phiShipGoc - tienGiamGiaVanChuyen).toLocaleString('vi-VN')}đ`;
                    }

                    // Cập nhật giảm giá đơn hàng
                    let tienGiamGiaDonHang = 0;
                    if (response.giamGiaDonHang) {
                        const giamTienDonHang = response.giamGiaDonHang.so_tien_giam;
                        tienGiamGiaDonHang = giamTienDonHang;
                        document.querySelector('.giamTienDonHang').textContent = `-${tienGiamGiaDonHang.toLocaleString('vi-VN')}đ`;
                        document.querySelector('.tongTienHang').textContent = `${(thanhTienGoc - tienGiamGiaDonHang).toLocaleString('vi-VN')}đ`;
                    }

                    // Cập nhật tổng tiền thanh toán
                    const tongTienHang = parseFloat(document.querySelector('.tongTienHang').textContent.replace(/[đ,.]/g, '')) || 0;
                    const tongPhiVanChuyen = parseFloat(document.querySelector('.tongPhiVanChuyen').textContent.replace(/[đ,.]/g, '')) || 0;
                    document.querySelector('.tongThanhToan').textContent = `${(tongTienHang + tongPhiVanChuyen - namadXu).toLocaleString('vi-VN')}đ`;

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

function datHang(){
    document.querySelector('.right-sidebar-checkout .order-button').addEventListener('click',function(){
        let diaChiId = document.querySelector('.dia-chi-item input[name="selectDiaChi"]:checked');
        if(!diaChiId){
            $('#add-address-checkout').modal('show');
            return;
        }

        let phuongThucThanhToan = parseInt(document.querySelector('.payment-options input[name="phuong_thuc_thanh_toan"]:checked').value);
        let tongThanhToan = parseFloat(document.querySelector('.tongThanhToan').textContent.replace(/[đ,.]/g, '')) || 0;
        let giamTienVanChuyen = parseFloat(document.querySelector('.giamTienVanChuyen').textContent.replace(/[đ,.-]/g, '')) || 0;
        let giamTienDonHang = parseFloat(document.querySelector('.giamTienDonHang').textContent.replace(/[đ,.-]/g, '')) || 0;
        let phiShip = parseFloat(document.querySelector('#tienPhiShip').textContent.replace(/[đ,.]/g, '')) || 0;
        let ghiChu = document.querySelector('.ghi-chu input').value || "";
        let soCoin = document.querySelector('.summary-total .divTongCoin .active') ? parseInt(document.querySelector('.summary-total .tongCoin').textContent) || 0 : 0;

        if(phuongThucThanhToan==0){
            $.ajax({
                type: 'POST',
                url: '/gio-hang/dat-hang-cod',
                data: {
                    _token: document.querySelector('.tokenDatHang').value,
                    dia_chi_id: diaChiId.getAttribute('data-id'),
                    tong_thanh_toan: tongThanhToan,
                    ghi_chu: ghiChu,
                    giamTienVanChuyen: giamTienVanChuyen,
                    giamTienDonHang: giamTienDonHang,
                    phiShip: phiShip,
                    soCoin: soCoin
                },
                success: function(response) {
                    if(response.success){
                        sessionStorage.setItem("activeTab", "order");
                        window.location.href="/tai-khoan/thong-tin-tai-khoan";
                    }else{
                        if(response.message){
                            document.querySelector('#thongbaothemgiohang').style.display='block';
                            document.querySelector('#thongbaothemgiohang #cart-message').textContent= `${response.message}`;
                            setTimeout(() => {
                                document.querySelector('#thongbaothemgiohang').style.display = 'none';
                            }, 1400);
                        }
                        setTimeout(() => {
                            window.location.href="/gio-hang/";
                        }, 1800);
                    }

                },
                error: function(error) {
                    console.log(error);
                    alert("Có lỗi xảy ra khi gửi yêu cầu.");
                }
            });
        }else{
            $.ajax({ 
                type: 'GET',
                url: '/gio-hang/dat-hang-chuyen-khoan',
                data: {
                    dia_chi_id: diaChiId.getAttribute('data-id'),
                    tong_thanh_toan: tongThanhToan,
                    ghi_chu: ghiChu,
                    giamTienVanChuyen: giamTienVanChuyen,
                    giamTienDonHang: giamTienDonHang,
                    phiShip: phiShip,
                    soCoin: soCoin
                },
                success: function(response) {
                    if(response.success){
                        window.location.href='/gio-hang/create-payment/';
                    }

                },
                error: function(error) {
                    console.log(error);
                    alert("Có lỗi xảy ra khi gửi yêu cầu.");
                }
            });
        }

    });
}

//ma khuyen mai
let elHours = document.getElementById('hours');
let elMinutes = document.getElementById('minutes');
let elSeconds = document.getElementById('seconds');
if(elHours && elMinutes && elSeconds){
    let hours = parseInt(elHours.textContent);
    let minutes = parseInt(elMinutes.textContent);
    let seconds = parseInt(elSeconds.textContent);

    function updateCountdown() {
        if (seconds > 0) {
            seconds--;
        } else {
            seconds = 59;
            if (minutes > 0) {
                minutes--;
            } else {
                minutes = 59;
                if (hours > 0) {
                    hours--;
                } else {
                    // Khi thời gian kết thúc
                    clearInterval(countdownInterval);
                    document.querySelector('.tdHSD').textContent = 'Đã hết hạn';
                    return;
                }
            }
        }

        // Cập nhật hiển thị
        document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
    }

    // Cập nhật mỗi giây
    let countdownInterval = setInterval(updateCountdown, 1000);
}




