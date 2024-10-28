
let selectedSize= null;
let selectedColor=null;
var ipSize= document.getElementById('size');
var ipMauSac= document.getElementById('mauSac');
const plusMinus = document.querySelectorAll('.quantity');

// Đặt sự kiện `click` chỉ một lần cho tất cả nút `plus` và `minus`
plusMinus.forEach((element) => {
    const addButton = element.querySelector('.plus');
    const subButton = element.querySelector('.minus');
    const inputEl = element.querySelector("input[type='number']");
    const ipHidden= element.querySelector('#soLuong');

    // Sự kiện cho nút tăng số lượng
    addButton.addEventListener('click', function () {
        if (inputEl.value < parseInt(inputEl.getAttribute('data-max'))) {
            inputEl.value = Number(inputEl.value) + 1;
            ipHidden.value= inputEl.value;
        }
    });

    // Sự kiện cho nút giảm số lượng
    subButton.addEventListener('click', function () {
        if (inputEl.value > 1) {
            inputEl.value = Number(inputEl.value) - 1;
            ipHidden.value= inputEl.value;
        }
    });
});

// Hàm để cập nhật số lượng tồn kho bằng AJAX
function updateQuantity() {
    if (selectedSize && selectedColor) {
        let san_pham_id = document.getElementById('soLuongTon').getAttribute('data-id');

        // Gửi yêu cầu AJAX đến máy chủ để lấy số lượng tồn kho
        $.ajax({
            url: '/san-pham/so-luong-ton-kho',
            method: 'GET',
            data: {
                kich_co: selectedSize,
                mau_sac: selectedColor,
                san_pham_id: san_pham_id // ID sản phẩm hiện tại
            },
            success: function(response) {
                var soLuongTon = response.quantity;
                if(soLuongTon>0){
                    document.getElementById('soLuongTon').textContent = soLuongTon;
                }else{
                    document.getElementById('soLuongTon').textContent = 'Tạm thời hết hàng';
                }
                // Cập nhật giá trị tối đa và trạng thái của các nút
                plusMinus.forEach((element) => {
                    const addButton = element.querySelector('.plus');
                    const subButton = element.querySelector('.minus');
                    const inputEl = element.querySelector("input[type='number']");

                    // Đặt giá trị tối đa mới cho input
                    inputEl.setAttribute('data-max', soLuongTon);

                    // Bật hoặc tắt nút theo điều kiện
                    addButton.disabled = false;
                    subButton.disabled = false;
                });
            },
            error: function() {
                alert('Có lỗi xảy ra khi lấy số lượng tồn kho!');
            }
        });
    }
}

// Bắt sự kiện click cho các kích cỡ
document.querySelectorAll('#selectSize li').forEach(function(sizeElement) {
    sizeElement.addEventListener('click', function() {
        selectedSize = this.getAttribute('data-size');
        ipSize.value = selectedSize;

        document.querySelectorAll('#selectSize li').forEach(function(el) {
            el.classList.remove('active');
        });

        this.classList.add('active');
        updateQuantity();
        selectBienThe();
    });
});

// Bắt sự kiện click cho các màu sắc
document.querySelectorAll('#selectMauSac li').forEach(function(colorElement) {
    colorElement.addEventListener('click', function() {
        selectedColor = this.getAttribute('data-color');
        ipMauSac.value = selectedColor;

        document.querySelectorAll('#selectMauSac li').forEach(function(el) {
            el.classList.remove('activ');
        });

        this.classList.add('activ');
        updateQuantity();
        selectBienThe();
    });
});

function selectBienThe(){
    if(selectedSize && selectedColor){
        document.querySelector('#errSelect').style.display='none';
        document.querySelector('#themGioHang').setAttribute('data-bs-target', '#addtocart');
        document.querySelector('#themGioHang').setAttribute('data-bs-toggle', 'modal');
    }
}
// them gio hang
document.addEventListener('DOMContentLoaded', () => {
    let btnThemGioHang= document.querySelector('#themGioHang');
    if(btnThemGioHang){
        btnThemGioHang.addEventListener('click',function(){
            if (selectedSize && selectedColor) {
                let sanPhamID = btnThemGioHang.getAttribute('data-id');
                let soLuong = document.getElementById('soLuong').value;
                let giaKhuyenMai= document.getElementById('giaKhuyenMai').getAttribute('data-giaKM');
                let kichCo = ipSize.value;
                let maMau = ipMauSac.value;

                $.ajax({
                    type: 'get',
                    url: '/gio-hang/them-gio-hang/',
                    data: {
                        san_pham_id: sanPhamID,
                        gia_khuyen_mai: Number(giaKhuyenMai),
                        so_luong: Number(soLuong),
                        kich_co: kichCo,
                        ma_mau: maMau
                    },
                    success: function(response) {
                        if (response.loginFalse==false) {
                            window.location.href = '/tai-khoan/dang-nhap';
                        }
                    },
                    error: function(error) {
                        console.error('Lỗi: ', error);
                        alert('Có lỗi xảy ra');
                    }
                });
            }else{
                document.querySelector('#errSelect').style.display = 'block';
            }
        });
    }

});
