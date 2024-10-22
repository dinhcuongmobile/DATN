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

// Tỉnh thành phố, quận huyện
$('#tinh_thanh_pho').on('change', function () {
    var matp = $(this).val();
    if(matp!==""){
        $.ajax({
            url: '/dia-chi/quan-huyen/' + matp,
            type: 'GET',
            success: function (data) {
                $('#quan_huyen').html('<option value="">--Chọn quận huyện--</option>');
                data.forEach(function (quanHuyen) {
                    $('#quan_huyen').append('<option value="' + quanHuyen.ma_quan_huyen + '">' + quanHuyen.ten_quan_huyen + '</option>');
                });
                $('#phuong_xa').html('<option value="">--Chọn phường xã--</option>');
            }
        });
    } else {
        // Nếu bỏ chọn tỉnh, reset quận huyện và phường xã
        $('#quan_huyen').html('<option value="">--Chọn quận huyện--</option>');
        $('#phuong_xa').html('<option value="">--Chọn phường xã--</option>');
    }
});

$('#quan_huyen').on('change', function () {
    var maqh = $(this).val();
    if (maqh!=="") {
        $.ajax({
            url: '/dia-chi/phuong-xa/' + maqh,
            type: 'GET',
            success: function (data) {
                $('#phuong_xa').html('<option value="">--Chọn phường xã--</option>');
                data.forEach(function (phuongXa) {
                    $('#phuong_xa').append('<option value="' + phuongXa.ma_phuong_xa + '">' + phuongXa.ten_phuong_xa + '</option>');
                });
            }
        });
    } else {
        // Nếu bỏ chọn quận huyện, reset phường xã
        $('#phuong_xa').html('<option value="">--Chọn phường xã--</option>');
    }
});

//sorf by


// thong bao loi error
document.addEventListener('DOMContentLoaded', (event) => {
    const errorAlert = document.getElementById('error-alert');
    if (errorAlert) {
        setTimeout(() => {
            errorAlert.style.transition = 'opacity 0.5s ease-out';
            errorAlert.style.opacity = '0';
            setTimeout(() => {
                errorAlert.style.display = 'none';
            }, 500); // Thời gian cho quá trình mờ dần
        }, 10000); // 10 giây
    }
});
// end thong bao loi error

