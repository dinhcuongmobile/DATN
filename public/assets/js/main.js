// Khai báo biến để lưu kích cỡ và màu sắc đã chọn
let selectedSize = null;
let selectedColor = null;
const soLuongTon = document.getElementById('soLuongTon');

// Hàm để cập nhật số lượng tồn kho bằng AJAX
function updateQuantity() {
    if (selectedSize && selectedColor) {
        let san_pham_id= soLuongTon.getAttribute('data-id');
        // Gửi yêu cầu AJAX đến máy chủ để lấy số lượng tồn kho
        $.ajax({
            url: '/san-pham/so-luong-ton-kho',  // Đường dẫn đến route xử lý trên server
            method: 'GET',
            data: {
                kich_co: selectedSize,
                mau_sac: selectedColor,
                san_pham_id: san_pham_id // ID sản phẩm hiện tại
            },
            success: function(response) {
                // Cập nhật số lượng tồn kho khi server trả về dữ liệu
                document.getElementById('soLuongTon').textContent = response.quantity;
            },
            error: function() {
                // Xử lý lỗi nếu có
                alert('Có lỗi xảy ra khi lấy số lượng tồn kho!');
            }
        });
    }
}


// Bắt sự kiện click cho các kích cỡ
document.querySelectorAll('#selectSize li').forEach(function(sizeElement) {
    sizeElement.addEventListener('click', function() {
        // Cập nhật kích cỡ đã chọn
        selectedSize = this.getAttribute('data-size');

        // Xóa class active khỏi các phần tử khác
        document.querySelectorAll('#selectSize li').forEach(function(el) {
            el.classList.remove('active');
        });

        // Thêm class active vào phần tử được nhấn
        this.classList.add('active');

        // Gọi hàm cập nhật số lượng tồn kho
        updateQuantity();
    });
});

// Bắt sự kiện click cho các màu sắc
document.querySelectorAll('#selectMauSac li').forEach(function(colorElement) {
    colorElement.addEventListener('click', function() {
        // Cập nhật màu sắc đã chọn
        selectedColor = this.getAttribute('data-color');

        // Xóa class active khỏi các phần tử khác
        document.querySelectorAll('#selectMauSac li').forEach(function(el) {
            el.classList.remove('activ');
        });

        // Thêm class active vào phần tử được nhấn
        this.classList.add('activ');

        // Gọi hàm cập nhật số lượng tồn kho
        updateQuantity();
    });
});
