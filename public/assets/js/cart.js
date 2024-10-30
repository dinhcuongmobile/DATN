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

// xóa tất cả các item trong giỏ hàng
clearAllButton.addEventListener('click', function () {
    // Kiểm tra xem có checkbox nào được chọn hay không
    const checkedCheckboxes = Array.from(ipSelect).filter(checkbox => checkbox.checked);

    if (checkedCheckboxes.length === 0) {
        alert("Không có sản phẩm nào được chọn để xóa.");
        return; // Dừng hành động nếu không có checkbox nào được chọn
    }

    if (confirm("Bạn có chắc muốn xóa tất cả những sản phẩm đã được chọn?")) {
        // Gửi yêu cầu AJAX đến server
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
    }
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
            document.querySelector('.message-container').style.display='block';
            document.querySelector('.message-container').textContent= "Số lượng trong kho không đủ !";
            setTimeout(() => {
                document.querySelector('.message-container').style.display = 'none';
            }, 1000);
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



