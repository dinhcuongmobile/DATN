
//chon tất cả
const buttonSelectAll = document.querySelector('#selectAll');
const ipSelectAll = document.querySelector('.cart-table .table-title input[type="checkbox"]');
const ipSelect = document.querySelectorAll('.cart-table #cart-table input[type="checkbox"]');
const clearAllButton = document.getElementById('clearAllButton');
const deleteButton = document.querySelectorAll('.deleteButton');
var countSanPham = document.querySelector('.cart-items .cart-body h6 span');

// xoa san pham gio hang
document.addEventListener('DOMContentLoaded', () => {
    kiemTraGioHang();
});
function kiemTraGioHang() {
    if (document.querySelectorAll('#cart-table tbody tr').length > 0) {
        document.querySelector('.cart-table .table-title p').style.display = 'block';
        document.querySelector('.col-12 .cart-countdown').style.display = 'flex';
        document.querySelector('.gioHangFull').setAttribute('class','col-xxl-9 col-xl-8 gioHangFull');
        document.querySelector('.gioHangTiepTuc').style.display= 'block';
    }
}
// Hàm chọn hoặc bỏ chọn tất cả checkbox
function toggleSelectAll(shouldSelect) {
    ipSelectAll.checked = shouldSelect;
    ipSelect.forEach(function (checkbox) {
        checkbox.checked = shouldSelect;
    });
}

// Sự kiện cho nút "Chọn tất cả"
buttonSelectAll.addEventListener('click', () => {
    toggleSelectAll(!ipSelectAll.checked);
});

// Sự kiện cho checkbox tổng (ipSelectAll)
ipSelectAll.addEventListener('click', () => {
    toggleSelectAll(ipSelectAll.checked);
});

// Kiểm tra trạng thái của tất cả các checkbox và cập nhật checkbox tổng
ipSelect.forEach(function (checkbox) {
    checkbox.addEventListener('change', () => {
        // Kiểm tra nếu tất cả checkbox sản phẩm đều đã chọn
        const allChecked = Array.from(ipSelect).every(checkbox => checkbox.checked);
        ipSelectAll.checked = allChecked; // Cập nhật trạng thái checkbox tổng
    });
});

// xóa tất cả các item trong giỏ hàng
clearAllButton.addEventListener('click', function () {
    // Kiểm tra xem có checkbox nào được chọn hay không
    const checkedCheckboxes = Array.from(ipSelect).filter(checkbox => checkbox.checked);

    if (checkedCheckboxes.length === 0) {
        document.querySelector('#thongbaothemgiohang').style.display='block';
        document.querySelector('#thongbaothemgiohang #cart-message').textContent= "Không có sản phẩm nào được chọn !";
        setTimeout(() => {
            document.querySelector('#thongbaothemgiohang').style.display = 'none';
        }, 1200);
        return; // Dừng hành động nếu không có checkbox nào được chọn
    }

    $('#thongBao').modal('show');

    document.querySelector('#thongBao .btnDongY').addEventListener('click',function(){
        $.ajax({
            url: '/gio-hang/xoa-tat-ca',
            method: 'get',
            data: {
                gio_hang_id: checkedCheckboxes.map(checkbox => checkbox.getAttribute('data-id')) // Lấy id của các sản phẩm đã chọn
            },
            success: function (response) {
                if (response.success) {
                    // Xóa tất cả các dòng trong bảng giỏ hàng trên giao diện
                    checkedCheckboxes.forEach(checkbox => {
                        const row = checkbox.closest('tr'); // Tìm dòng cha của checkbox
                        if (row) {
                            row.remove(); // Xóa dòng đó
                        }
                    });

                    // Bỏ chọn tất cả checkbox
                    toggleSelectAll(false);
                    let countTr = document.querySelectorAll('#cart-table tbody tr').length;
                    // còn lại
                    document.querySelector('#selectAll span').innerHTML = countTr;
                    // Kiểm tra số dòng còn lại
                    if (countTr === 0) {
                        document.querySelector('.cart-table .table-title p').style.display = 'none';
                        document.querySelector('.cart-countdown').style.display = 'none';
                        document.querySelector('.cart-table #data-show').style.display = 'block';
                        document.querySelector('.gioHangFull').setAttribute('class','col-xxl-12 col-xl-12 gioHangFull');
                        document.querySelector('.gioHangTiepTuc').style.display= 'none';
                    }
                    countSanPham.textContent = countTr;

                    // tinh lai tong tien
                    let tongTien = 0;
                    let tietKiem = 0;
                    response.gio_hang.forEach(function (item) {
                        let giaKM = item.san_pham.gia_san_pham - (item.san_pham.gia_san_pham * item.san_pham.khuyen_mai / 100);
                        tongTien += giaKM * item.so_luong;
                        tietKiem += ((item.san_pham.gia_san_pham * item.so_luong) - (giaKM * item.so_luong));

                    });
                    document.querySelector('#tongTienGioHang').textContent = `${tongTien.toLocaleString('vi-VN')}đ`;
                    document.querySelector('#tietKiemGioHang').textContent = `${tietKiem.toLocaleString('vi-VN')}đ`;

                } else {
                    alert("Xóa thất bại. Vui lòng thử lại.");
                }
            },
            error: function () {
                alert("Có lỗi xảy ra. Vui lòng thử lại.");
            }
        });

        $('#thongBao').modal('hide');
    });
});

deleteButton.forEach(function (btnDel) {
    btnDel.addEventListener('click', function () {
        $.ajax({
            url: '/gio-hang/xoa-san-pham-gio-hang',
            method: 'get',
            data: {
                gio_hang_id: btnDel.getAttribute('data-id')
            },
            success: function (response) {
                if (response.success) {
                    const row = btnDel.closest('tr');
                    if (row) {
                        row.remove();
                    }
                    let countTr = document.querySelectorAll('#cart-table tbody tr').length;
                    // còn lại
                    document.querySelector('#selectAll span').innerHTML = countTr;
                    // Kiểm tra số dòng còn lại
                    if (countTr === 0) {
                        document.querySelector('.cart-table .table-title p').style.display = 'none';
                        document.querySelector('.cart-countdown').style.display = 'none';
                        document.querySelector('.cart-table #data-show').style.display = 'block';
                        document.querySelector('.gioHangFull').setAttribute('class','col-xxl-12 col-xl-12 gioHangFull');
                        document.querySelector('.gioHangTiepTuc').style.display= 'none';
                    }
                    countSanPham.textContent = countTr;
                    // tinh lai tong tien
                    let tongTien = 0;
                    let tietKiem = 0;
                    response.gio_hang.forEach(function (item) {
                        let giaKM = item.san_pham.gia_san_pham - (item.san_pham.gia_san_pham * item.san_pham.khuyen_mai / 100);
                        tongTien += giaKM * item.so_luong;
                        tietKiem += ((item.san_pham.gia_san_pham * item.so_luong) - (giaKM * item.so_luong));

                    });
                    document.querySelector('#tongTienGioHang').textContent = `${tongTien.toLocaleString('vi-VN')}đ`;
                    document.querySelector('#tietKiemGioHang').textContent = `${tietKiem.toLocaleString('vi-VN')}đ`;

                } else {
                    alert("Xóa thất bại. Vui lòng thử lại.");
                }
            },
            error: function () {
                alert("Có lỗi xảy ra. Vui lòng thử lại.");
            }
        });

    });
});

//end xoa san pham gio hang

//cap nhat so luong gio hang
const plusMinus = document.querySelectorAll('.quantity');
plusMinus.forEach((element) => {
    const addButton = element.querySelector('.plus');
    const subButton = element.querySelector('.minus');
    const inputEl = element.querySelector("input[type='number']");
    const ipHidden = element.querySelector('.soLuong');

    // Nút tăng số lượng
    addButton.addEventListener('click', function () {
        if (inputEl.value < parseInt(inputEl.getAttribute('data-max'))) {
            inputEl.value = Number(inputEl.value) + 1;
            ipHidden.value = inputEl.value;
            subButton.disabled = false;

            const thanhTien = Number(ipHidden.getAttribute('data-giaKM')) * Number(ipHidden.value);
            ipHidden.setAttribute('data-thanhTien', thanhTien);

            $.ajax({
                url: '/gio-hang/so-luong-mua',
                method: 'get',
                data: {
                    gio_hang_id: ipHidden.getAttribute('data-id'),
                    so_luong: ipHidden.value,
                    thanh_tien: thanhTien
                },
                success: function (response) {

                    const tr = addButton.closest('tr');
                    tr.querySelector('.tdThanhTien').textContent = `${thanhTien.toLocaleString('vi-VN')}đ`;
                    // tinh lai tong tien
                    let tongTien = 0;
                    let tietKiem = 0;
                    response.gio_hangs.forEach(function (item) {
                        let giaKM = item.san_pham.gia_san_pham - (item.san_pham.gia_san_pham * item.san_pham.khuyen_mai / 100);
                        tongTien += giaKM * item.so_luong;
                        tietKiem += ((item.san_pham.gia_san_pham * item.so_luong) - (giaKM * item.so_luong));
                    });
                    document.querySelector('#tongTienGioHang').textContent = `${tongTien.toLocaleString('vi-VN')}đ`;
                    document.querySelector('#tietKiemGioHang').textContent = `${tietKiem.toLocaleString('vi-VN')}đ`;

                },
                error: function () {
                    alert("Có lỗi xảy ra. Vui lòng thử lại.");
                }
            });
        }
        if (inputEl.value == parseInt(inputEl.getAttribute('data-max'))) {
            document.querySelector('#thongbaothemgiohang').style.display='block';
            document.querySelector('#thongbaothemgiohang #cart-message').textContent= "Số lượng trong kho không đủ !";
            setTimeout(() => {
                document.querySelector('#thongbaothemgiohang').style.display = 'none';
            }, 1200);
            addButton.disabled = true;
        }
    });

    // Nút giảm số lượng
    subButton.addEventListener('click', function () {
        if (inputEl.value > 1) {
            inputEl.value = Number(inputEl.value) - 1;
            ipHidden.value = inputEl.value;
            addButton.disabled = false;

            const thanhTien = Number(ipHidden.getAttribute('data-giaKM')) * Number(ipHidden.value);
            ipHidden.setAttribute('data-thanhTien', thanhTien);

            $.ajax({
                url: '/gio-hang/so-luong-mua',
                method: 'get',
                data: {
                    gio_hang_id: ipHidden.getAttribute('data-id'),
                    so_luong: ipHidden.value,
                    thanh_tien: thanhTien
                },
                success: function (response) {
                    const tr = addButton.closest('tr');
                    tr.querySelector('.tdThanhTien').textContent = `${thanhTien.toLocaleString('vi-VN')}đ`;

                    // tinh lai tong tien
                    let tongTien = 0;
                    let tietKiem = 0;
                    response.gio_hangs.forEach(function (item) {
                        let giaKM = item.san_pham.gia_san_pham - (item.san_pham.gia_san_pham * item.san_pham.khuyen_mai / 100);
                        tongTien += giaKM * item.so_luong;
                        tietKiem += ((item.san_pham.gia_san_pham * item.so_luong) - (giaKM * item.so_luong));
                    });
                    document.querySelector('#tongTienGioHang').textContent = `${tongTien.toLocaleString('vi-VN')}đ`;
                    document.querySelector('#tietKiemGioHang').textContent = `${tietKiem.toLocaleString('vi-VN')}đ`;

                },
                error: function () {
                    alert("Có lỗi xảy ra. Vui lòng thử lại.");
                }
            });
        }
        if (inputEl.value == 1) {
            subButton.disabled = true;
        }
    });
});
//end cap nhat so luong gio hang

//thay doi bien the gio hang
document.querySelectorAll('.thayDoi').forEach(btn => {
    btn.addEventListener('click', function(event) {
        // Lấy popup tương ứng với sản phẩm hiện tại
        const parentRow = btn.closest('tr');
        const popup = parentRow.querySelector('.thayDoiBienThe');

        // Kiểm tra nếu popup đang hiển thị thì ẩn nó đi, nếu không thì hiển thị
        const isPopupVisible = popup.style.display === 'block';

        // Ẩn tất cả popup khác trước khi hiển thị popup của sản phẩm được nhấn
        document.querySelectorAll('.thayDoiBienThe').forEach(p => p.style.display = 'none');

        // Cập nhật vị trí của popup ngay bên dưới nút "Thay đổi"
        if (!isPopupVisible) {
            const rect = event.target.getBoundingClientRect();
            popup.style.top = `${rect.bottom + window.scrollY}px`;
            popup.style.left = `${rect.left + window.scrollX}px`;

            // Hiển thị popup của sản phẩm hiện tại
            popup.style.display = 'block';
        }
    });
});

// Đóng popup khi click bên ngoài
document.addEventListener('click', function(event) {
    const isClickInsidePopup = event.target.closest('.thayDoiBienThe');
    const isClickOnButton = event.target.classList.contains('thayDoi');

    // Nếu không click vào popup hoặc nút "Thay đổi" thì ẩn tất cả popup
    if (!isClickInsidePopup && !isClickOnButton) {
        document.querySelectorAll('.thayDoiBienThe').forEach(p => p.style.display = 'none');
    }
});

let selectedSize = null;
let selectedColor = null;

// Xử lý kiểm tra các size và màu đã được chọn sẵn (nếu có)
document.querySelectorAll('.sizeBox .thayDoiSize li.active').forEach(el => {
    selectedSize = el.getAttribute('data-size');
});

document.querySelectorAll('.colorBox .thayDoiMauSac li.active').forEach(el => {
    selectedColor = el.getAttribute('data-color');
});

// Xử lý chọn size
document.querySelectorAll('.sizeBox .thayDoiSize li').forEach(function (sizeElement) {
    sizeElement.addEventListener('click', function () {
        let gioHangId = this.closest('tr').querySelector('input[type="checkbox"]').getAttribute('data-id');

        // Nếu size đã được chọn thì disable màu sắc
        if (!this.classList.contains('active')) {
            // Gửi yêu cầu AJAX để lấy các màu sắc không khả dụng cho kích cỡ này
            $.ajax({
                url: '/gio-hang/check-bien-the-size',
                method: 'get',
                data: {
                    gio_hang_id: gioHangId,
                    kich_co: this.getAttribute('data-size') // Gửi kích cỡ đang chọn
                },
                success: function (response) {
                    // Disable các màu sắc không khả dụng
                    document.querySelectorAll('.colorBox .thayDoiMauSac li').forEach(function (colorElement) {
                        if (response.disabledColors.includes(colorElement.getAttribute('data-color'))) {
                            colorElement.classList.add('disable');
                            colorElement.classList.remove('active');
                        } else {
                            colorElement.classList.remove('disable');
                        }
                    });
                },
                error: function () {
                    alert("Có lỗi xảy ra. Vui lòng thử lại.");
                }
            });
        }

        // Cập nhật trạng thái lựa chọn size
        this.closest('.sizeBox').querySelectorAll('li').forEach(el => el.classList.remove('active'));
        this.classList.add('active');
    });
});

// Xử lý chọn màu sắc
document.querySelectorAll('.colorBox .thayDoiMauSac li').forEach(function (colorElement) {
    colorElement.addEventListener('click', function () {
        let gioHangId = this.closest('tr').querySelector('input[type="checkbox"]').getAttribute('data-id');

        // Nếu màu sắc đã được chọn thì disable kích cỡ
        if (!this.classList.contains('active')) {
            // Gửi yêu cầu AJAX để lấy các kích cỡ không khả dụng cho màu sắc này
            $.ajax({
                url: '/gio-hang/check-bien-the-color',
                method: 'get',
                data: {
                    gio_hang_id: gioHangId,
                    ma_mau: this.getAttribute('data-color') // Gửi màu sắc đang chọn
                },
                success: function (response) {
                    // Disable các kích cỡ không khả dụng
                    document.querySelectorAll('.sizeBox .thayDoiSize li').forEach(function (sizeElement) {
                        if (response.disabledSizes.includes(sizeElement.getAttribute('data-size'))) {
                            sizeElement.classList.add('disable');
                            sizeElement.classList.remove('active');
                        } else {
                            sizeElement.classList.remove('disable');
                        }
                    });
                },
                error: function () {
                    alert("Có lỗi xảy ra. Vui lòng thử lại.");
                }
            });
        }

        // Cập nhật trạng thái lựa chọn màu sắc
        this.closest('.colorBox').querySelectorAll('li').forEach(el => el.classList.remove('active'));
        this.classList.add('active');
    });
});


// Xử lý nút xác nhận
document.querySelectorAll('.thayDoiBienThe .btnThayDoi .btn-danger').forEach(function(btn) {
    btn.addEventListener('click', function() {
        if (selectedSize && selectedColor) {
            let tr=btn.closest('tr');
            let gioHangId = tr.querySelector('input[type="checkbox"]').getAttribute('data-id');
            let maMau = tr.querySelector('.colorBox li.active').getAttribute('data-color');
            let kichCo = tr.querySelector('.sizeBox li.active').getAttribute('data-size');

            $.ajax({
                url: '/gio-hang/thay-doi-bien-the',
                method: 'get',
                data: {
                    gio_hang_id: gioHangId,
                    kich_co: kichCo,
                    ma_mau: maMau
                },
                success: function (response) {
                    if(response.success){
                        tr.querySelector('.phanLoaiHang').textContent= `${response.bien_the.kich_co}, ${response.bien_the.ten_mau}`;
                        tr.querySelector('.quantity input[type="number"]').setAttribute('data-max',response.bien_the.so_luong);
                        const popup = tr.querySelector('.thayDoiBienThe');
                        popup.style.display = 'none';
                        tr.querySelector('.quantity input[type="number"]').value = 1;
                        tr.querySelector('.quantity .plus').disabled=false;
                    }else{
                        if(response.message){
                            document.querySelector('#thongbaothemgiohang').style.display='block';
                            document.querySelector('#thongbaothemgiohang #cart-message').textContent= `${response.message}`;
                            setTimeout(() => {
                                document.querySelector('#thongbaothemgiohang').style.display = 'none';
                            }, 1700);
                        }
                        setTimeout(() => {
                            const popup = tr.querySelector('.thayDoiBienThe');
                            popup.style.display = 'none';
                        }, 2000);
                    }
                },
                error: function () {
                    alert("Có lỗi xảy ra. Vui lòng thử lại.");
                }
            });
        }
    });
});

document.querySelectorAll('.thayDoiBienThe .btnThayDoi .btn-light').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const parentRow = this.closest('tr');
        const popup = parentRow.querySelector('.thayDoiBienThe');
        popup.style.display = 'none';
    });
});

// tiep tuc dat hang

$('#tiepTucDatHangBtn').on('click', function() {
    let selectedItems = [];
    $('#cart-table input[name="select[]"]:checked').each(function() {
        selectedItems.push($(this).val());  // id
    });

    $.ajax({
        type: 'POST',
        url: '/gio-hang/tiep-tuc-dat-hang',
        data: {
            _token: $('.gioHangTiepTuc .tokenTiepTuc').val(),
            select: selectedItems,
        },
        success: function(response) {
            if (response.success) {
                window.location.href = response.redirect;
            } else {
                document.querySelector('#thongbaothemgiohang').style.display='block';
                document.querySelector('#thongbaothemgiohang #cart-message').textContent= "Không có sản phẩm nào được chọn !";
                setTimeout(() => {
                    document.querySelector('#thongbaothemgiohang').style.display = 'none';
                }, 1200);
            }
        },
        error: function(error) {
            console.log(error);
            alert("Có lỗi xảy ra khi gửi yêu cầu.");
        }
    });

});






