//chon tất cả
const buttonSelectAll = document.querySelector('#selectAll');
const ipSelectAll = document.querySelector('.cart-table .table-title input[type="checkbox"]');
const ipSelect = document.querySelectorAll('.cart-table #cart-table input[type="checkbox"]');
const clearAllButton = document.getElementById('clearAllButton');
// Hàm chọn hoặc bỏ chọn tất cả checkbox
function toggleSelectAll(shouldSelect) {
    ipSelectAll.checked = shouldSelect;
    ipSelect.forEach(function(checkbox){
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
clearAllButton.addEventListener('click', function() {
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
            success: function(response) {
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

                    // Kiểm tra số dòng còn lại
                    if (document.querySelectorAll('#cart-table tbody tr').length === 0) {
                        document.querySelector('.cart-table #data-show').style.display='block';
                    }
                } else {
                    alert("Xóa thất bại. Vui lòng thử lại.");
                }
            },
            error: function() {
                alert("Có lỗi xảy ra. Vui lòng thử lại.");
            }
        });
    }
});


