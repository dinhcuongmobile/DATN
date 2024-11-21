
document.addEventListener('DOMContentLoaded',()=>{
    soLuongMua();
    selectSize();
    selectColor();
    themGioHang();
    muaNgay();
});
let selectedSize = null;
let selectedColor = null;
var ipSize = document.getElementById('size');
var ipMauSac = document.getElementById('mauSac');
const plusMinus = document.querySelectorAll('.quantity');
function soLuongMua() {
    // Đặt sự kiện `click` cho nút Plus và Minus
    plusMinus.forEach((element) => {
        const addButton = element.querySelector('.plus');
        const subButton = element.querySelector('.minus');
        const inputEl = element.querySelector("input[type='number']");
        const ipHidden = element.querySelector('#soLuong');

        // Nút tăng số lượng
        addButton.addEventListener('click', function () {
            if (inputEl.value < parseInt(inputEl.getAttribute('data-max'))) {
                inputEl.value = Number(inputEl.value) + 1;
                ipHidden.value = inputEl.value;
                subButton.disabled = false;
            }
            if (inputEl.value == parseInt(inputEl.getAttribute('data-max'))) {
                addButton.disabled = true;
            }
        });

        // Nút giảm số lượng
        subButton.addEventListener('click', function () {
            if (inputEl.value > 1) {
                inputEl.value = Number(inputEl.value) - 1;
                ipHidden.value = inputEl.value;
                addButton.disabled = false;
            }
            if (inputEl.value == 1) {
                subButton.disabled = true;
            }
        });
    });
}

function maxInputQuantity(soLuongTon){
    plusMinus.forEach((element) => {
        const addButton = element.querySelector('.plus');
        const subButton = element.querySelector('.minus');
        const inputEl = element.querySelector("input[type='number']");

        inputEl.setAttribute('data-max', soLuongTon);
        inputEl.value = Math.min(inputEl.value, soLuongTon);
        addButton.disabled = inputEl.value >= soLuongTon;
        subButton.disabled = inputEl.value <= 1;
    });
}

// Hàm cập nhật tồn kho qua AJAX
function updateQuantity() {
    if (selectedSize && selectedColor) {
        document.querySelector('#errSelect').style.display = 'none';
        let san_pham_id = document.getElementById('soLuongTon').getAttribute('data-id');

        $.ajax({
            url: '/san-pham/so-luong-ton-kho',
            method: 'GET',
            data: {
                kich_co: selectedSize,
                mau_sac: selectedColor,
                san_pham_id: san_pham_id
            },
            success: function (response) {
                var soLuongTon = response.quantity;
                if (soLuongTon > 0) {
                    document.getElementById('soLuongTon').textContent = soLuongTon;
                    document.getElementById('soLuongTon').style.color="rgba(118, 118, 118, 1)";
                    document.querySelector('.btn-mua-hang').innerHTML=`
                            <a id="themGioHang" class="btn btn_black sm" href="javascript:void(0);"
                            data-id="${san_pham_id}">Thêm giỏ hàng</a>
                            <a class="btn btn_outline sm" id="muaNgay" href="javascript:void(0)">Mua ngay</a>
                        `;
                    document.querySelector(".quantity input[type='number']").value=1;
                } else {
                    document.getElementById('soLuongTon').textContent = 'Tạm thời hết hàng';
                    document.getElementById('soLuongTon').style.color="red";
                    document.querySelector('.btn-mua-hang').innerHTML=`<button class="btn btn_black sm">Hết hàng</button>`;
                }
                // Cập nhật giá trị tối đa cho input
                maxInputQuantity(soLuongTon);
                themGioHang();
                muaNgay();
            },
            error: function () {
                alert('Có lỗi xảy ra khi lấy số lượng tồn kho!');
            }
        });
    }else{
        document.querySelector('.plus').disabled=true;
        document.querySelector('.minus').disabled=true;
        document.querySelector("input[type='number']").value=1;
        const soLuongTonCu=document.getElementById('soLuongTon').getAttribute('data-quantityOld');
        document.getElementById('soLuongTon').textContent = soLuongTonCu;

    }
}

// Xử lý chọn kích cỡ
function selectSize(){
    document.querySelectorAll('#selectSize li').forEach(function (sizeElement) {
        sizeElement.addEventListener('click', function () {
            if (this.classList.contains('active')) {
                this.classList.remove('active');
                selectedSize = null;
                ipSize.value = "";
            } else {
                selectedSize = this.getAttribute('data-size');
                ipSize.value = selectedSize;

                document.querySelectorAll('#selectSize li').forEach(el => el.classList.remove('active'));
                this.classList.add('active');
            }
            updateQuantity();
        });
    });
}

// Xử lý chọn màu sắc
function selectColor(){
    document.querySelectorAll('#selectMauSac li').forEach(function (colorElement) {
        colorElement.addEventListener('click', function () {
            if (this.classList.contains('activ')) {
                this.classList.remove('activ');
                selectedColor = null;
                ipMauSac.value = "";
            } else {
                selectedColor = this.getAttribute('data-color');
                ipMauSac.value = selectedColor;

                document.querySelectorAll('#selectMauSac li').forEach(el => el.classList.remove('activ'));
                this.classList.add('activ');
            }
            updateQuantity();
        });
    });
}

// Thêm vào giỏ hàng
function themGioHang(){
    let btnThemGioHang = document.querySelector('#themGioHang');

    if (btnThemGioHang) {
        btnThemGioHang.addEventListener('click', function () {
            if (selectedSize && selectedColor) {
                let token= document.querySelector(".tokenThemGioHang").value;
                let sanPhamID = btnThemGioHang.getAttribute('data-id');
                let soLuong = document.getElementById('soLuong').value;
                let giaKhuyenMai = document.getElementById('giaKhuyenMai').getAttribute('data-giaKM');
                let kichCo = ipSize.value;
                let maMau = ipMauSac.value;

                $.ajax({
                    type: 'POST',
                    url: '/gio-hang/them-gio-hang/',
                    data: {
                        _token: token,
                        san_pham_id: sanPhamID,
                        gia_khuyen_mai: Number(giaKhuyenMai),
                        so_luong: Number(soLuong),
                        kich_co: kichCo,
                        ma_mau: maMau
                    },
                    success: function (response) {
                        if (response.login == false) {
                            window.location.href = '/tai-khoan/dang-nhap';
                        } else {
                            $('#addtocart').modal('show');
                            var tenSanPham = document.querySelector('#tenSanPhamChiTiet');
                            document.querySelector('#addtocart #nameProductSuccess').innerHTML = tenSanPham.innerHTML;
                            document.querySelector('#addtocart .imgAddtocartSuccess').innerHTML = `<img class="img-fluid blur-up lazyload pro-img" src="/storage/${response.san_pham.hinh_anh}" alt="">`;
                            document.querySelector('.countGioHangMenu span').textContent= response.count_gio_hang;
                        }
                    },
                    error: function (error) {
                        console.error('Lỗi: ', error);
                        alert('Có lỗi xảy ra');
                    }
                });
            } else {
                document.querySelector('#errSelect').style.display = 'block';
            }
        });
    }
}

function muaNgay(){
    let btnMuaNgay = document.querySelector('#muaNgay');
    let btnThemGioHang = document.querySelector('#themGioHang');
    if(btnMuaNgay){
        btnMuaNgay.addEventListener('click',function(){
            if(selectedSize && selectedColor){
                let token= document.querySelector(".tokenThemGioHang").value;
                let sanPhamID = btnThemGioHang.getAttribute('data-id');
                let soLuong = document.getElementById('soLuong').value;
                let kichCo = ipSize.value;
                let maMau = ipMauSac.value;

                $.ajax({
                    url: '/gio-hang/mua-ngay',
                    method: 'POST',
                    data: {
                        _token: token,
                        san_pham_id: sanPhamID,
                        so_luong: Number(soLuong),
                        kich_co: kichCo,
                        ma_mau: maMau
                    },
                    success: function (response) {
                        if (response.login == false) {
                            window.location.href = '/tai-khoan/dang-nhap';
                        } else {
                            window.location.href = '/gio-hang/chi-tiet-thanh-toan';
                        }
                    },
                    error: function () {
                        alert('Có lỗi xảy ra!');
                    }
                });
            }else{
                document.querySelector('#errSelect').style.display = 'block';
            }
        });
    }
}

