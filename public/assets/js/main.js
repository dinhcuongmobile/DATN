document.addEventListener('DOMContentLoaded',()=>{
    window.scrollTo({ top: 0, behavior: 'smooth' });
    thongBaoLoi();
    checkSession();
    togglePassword();
    donMuaMenu();
    yeuThich();
    yeuThichChiTiet();
    xoaYeuThich();
});
function togglePassword(){
    const togglePassword = document.querySelectorAll('.toggle-password');
    if(togglePassword){
        togglePassword.forEach((el)=>{
            el.addEventListener('click',function(){
                const passwordInput = el.closest('.password').querySelector('.inputPassword');
                const passwordIcon = el.querySelector('i');
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    passwordIcon.classList.remove('fa-eye-slash');
                    passwordIcon.classList.add('fa-eye');
                } else {
                    passwordInput.type = "password";
                    passwordIcon.classList.remove('fa-eye');
                    passwordIcon.classList.add('fa-eye-slash');
                }
            });
        });
    }
}
// Lưu trạng thái khi vào trang chi tiết thanh toán
function checkSession(){
    let checkUrl = false;
    if (window.location.pathname === '/gio-hang/chi-tiet-thanh-toan') {
        checkUrl=true;
    }else{
        checkUrl=false;
    }

    if (!checkUrl) {
        fetch('/gio-hang/xoa-session-gio-hang', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
    }
}

// don-mua-menu-click
function donMuaMenu(){
    const donMuaMenu = document.querySelector('.donMuaMenu');
    if (donMuaMenu) {
        donMuaMenu.addEventListener('click',function(){
            if (window.location.pathname !== '/tai-khoan/thong-tin-tai-khoan') {
                sessionStorage.setItem("activeTab", "order");
                window.location.href="/tai-khoan/thong-tin-tai-khoan";
            }else{
                let checkNavLink = document.querySelectorAll('.nav-link');
                let checkTabPane = document.querySelectorAll('.tab-pane');
                checkNavLink.forEach((el)=>{
                    el.classList.remove('active');
                    el.setAttribute('aria-selected', 'false');
                    el.setAttribute('tabindex', '-1');
                });

                checkTabPane.forEach((el)=>{
                    el.classList.remove('active','show');
                });

                const donHangTab = document.querySelector('#order-tab');
                const donHangContent = document.querySelector('#order');

                donHangTab.classList.add('active');
                donHangTab.setAttribute('aria-selected', 'true');
                if (donHangTab.hasAttribute('tabindex') && donHangTab.getAttribute('tabindex') === "-1") {
                    donHangTab.removeAttribute('tabindex');
                }

                donHangContent.classList.add('active','show');
            }
        })
    }
}


// Tỉnh thành phố, quận huyện
$('select[name="tinh_thanh_pho"]').on('change', function () {
    var matp = $(this).val();
    if (matp !== "") {
        $.ajax({
            url: '/dia-chi/quan-huyen/' + matp,
            type: 'GET',
            success: function (data) {
                $('select[name="quan_huyen"]').html('<option value="">--Chọn quận huyện--</option>');
                data.forEach(function (quanHuyen) {
                    $('select[name="quan_huyen"]').append('<option value="' + quanHuyen.ma_quan_huyen + '">' + quanHuyen.ten_quan_huyen + '</option>');
                });
                $('select[name="phuong_xa"]').html('<option value="">--Chọn phường xã--</option>');
            }
        });
    } else {
        // Nếu bỏ chọn tỉnh, reset quận huyện và phường xã
        $('select[name="quan_huyen"]').html('<option value="">--Chọn quận huyện--</option>');
        $('select[name="phuong_xa"]').html('<option value="">--Chọn phường xã--</option>');
    }
});

$('select[name="quan_huyen"]').on('change', function () {
    var maqh = $(this).val();
    if (maqh !== "") {
        $.ajax({
            url: '/dia-chi/phuong-xa/' + maqh,
            type: 'GET',
            success: function (data) {
                $('select[name="phuong_xa"]').html('<option value="">--Chọn phường xã--</option>');
                data.forEach(function (phuongXa) {
                    $('select[name="phuong_xa"]').append('<option value="' + phuongXa.ma_phuong_xa + '">' + phuongXa.ten_phuong_xa + '</option>');
                });
            }
        });
    } else {
        // Nếu bỏ chọn quận huyện, reset phường xã
        $('select[name="phuong_xa"]').html('<option value="">--Chọn phường xã--</option>');
    }
});


// thong bao loi error
function thongBaoLoi(){
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
}
// end thong bao loi error


//quick-view
let selectedSizeQuickView = null;
let selectedColorQuickView = null;
var ipSize = document.getElementById('size-quick-view');
var ipMauSac = document.getElementById('mauSac-quick-view');
const soLuong = document.querySelectorAll('#quick-view .quantity');
document.querySelectorAll('.quickViewClick').forEach((el) => {
    el.addEventListener('click', function () {
        document.querySelector('#quick-view .product-right h3').textContent="";
        document.querySelector('#quick-view .product-right h5').innerHTML="";
        document.querySelector('#quick-view .img-quick-view').innerHTML="";
        document.querySelector('#quick-view .product-buttons').innerHTM="";
        document.querySelector('#selectSize-quick-view').innerHTML="";
        document.querySelector('#selectMauSac-quick-view').innerHTML="";
        $('#quick-view').modal('show');
        document.querySelector('#errSelect-quick-view').style.display = 'none';
        let sanPhamID = el.getAttribute('data-id');
        document.querySelector('#quick-view').setAttribute('data-id',sanPhamID);

        $.ajax({
            type: 'GET',
            url: '/home/quick-view/',
            data: { san_pham_id: sanPhamID },
            success: function (response) {
                let sanPham = response.san_pham;
                let kichCos = response.kich_cos;
                let bienThes = sanPham.bien_thes;
                // Cập nhật tên sản phẩm
                document.querySelector('#quick-view .product-right h3').textContent = sanPham.ten_san_pham;

                // Cập nhật giá sản phẩm
                const giaBan = sanPham.gia_san_pham - (sanPham.gia_san_pham * sanPham.khuyen_mai / 100);
                document.querySelector('#quick-view .product-right h5').innerHTML = `<span class="giaKhuyenMai" data-giaKM="${giaBan}">${giaBan.toLocaleString('vi-VN')}đ</span> <del>${sanPham.gia_san_pham.toLocaleString('vi-VN')}đ</del>`;

                // Cập nhật ảnh
                document.querySelector('#quick-view .img-quick-view').innerHTML = `<img src="/storage/${sanPham.hinh_anh}" alt="err" width="100%">`;

                // Cập nhật link "button"
                document.querySelector('#quick-view .product-buttons').innerHTML = `
                    <a class="btn btn-solid" id="themGioHang-quick-view" data-id="${sanPhamID}" href="javascript:void(0);">Thêm vào giỏ hàng</a>
                    <a class="btn btn-solid chiTiet" href="/san-pham/chi-tiet-san-pham/${sanPhamID}">Xem chi tiết</a>
                `;

                // Cập nhật kích cỡ
                let kichCoBox = document.querySelector('#selectSize-quick-view');

                let kichCoTonTai = kichCos.filter((item) =>
                    bienThes.some((bienThe) => bienThe.kich_co === item.kich_co)
                );
                kichCoTonTai.forEach((item) => {
                    kichCoBox.innerHTML += `<li data-size="${item.kich_co}"><a href="javascript:void(0);">${item.kich_co}</a></li>`;
                });

                // Cập nhật màu sắc
                let mauSacBox = document.querySelector('#selectMauSac-quick-view');

                let mauSacTonTai = bienThes.reduce((unique, item) => {
                    if (!unique.some((u) => u.ma_mau === item.ma_mau)) unique.push(item);
                    return unique;
                }, []);
                mauSacTonTai.forEach((item) => {
                    mauSacBox.innerHTML += `<li data-color="${item.ma_mau}" style="background-color: ${item.ma_mau}; border: 1px solid #0000003b;" title="${item.ten_mau}"></li>`;
                });
                selectSize();
                selectColor();
                updateQuantity();
                soLuongMua();
                themGioHang();
            },
            error: function (error) {
                console.error('Lỗi: ', error);
                alert('Có lỗi xảy ra');
            }
        });
    });
});

function soLuongMua() {
    // Đặt sự kiện `click` cho nút Plus và Minus
    soLuong.forEach((element) => {
        const addButton = element.querySelector('.plus');
        const subButton = element.querySelector('.minus');
        const inputEl = element.querySelector("input[type='number']");
        const ipHidden = element.querySelector('#soLuong-quick-view');

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

function maxInputQuantity(maxSL){
    soLuong.forEach((element) => {
        const addButton = element.querySelector('.plus');
        const subButton = element.querySelector('.minus');
        const inputEl = element.querySelector("input[type='number']");

        inputEl.setAttribute('data-max', maxSL);
        inputEl.value = Math.min(inputEl.value, maxSL);
        addButton.disabled = inputEl.value >= maxSL;
        subButton.disabled = inputEl.value <= 1;
    });
}
// Hàm cập nhật tồn kho qua AJAX
function updateQuantity() {
    if (selectedSizeQuickView && selectedColorQuickView) {
        document.querySelector('#errSelect-quick-view').style.display = 'none';
        let san_pham_id = document.querySelector('#quick-view').getAttribute('data-id');

        $.ajax({
            url: '/san-pham/so-luong-ton-kho',
            method: 'GET',
            data: {
                kich_co: selectedSizeQuickView,
                mau_sac: selectedColorQuickView,
                san_pham_id: san_pham_id
            },
            success: function (response) {
                var soLuongTon = response.quantity;
                var maxSL = parseInt(response.quantity) - parseInt(response.gio_hang?response.gio_hang.so_luong:0);
                if (soLuongTon > 0) {
                    document.querySelector('#quick-view .product-buttons').innerHTML = `
                        <a class="btn btn-solid" id="themGioHang-quick-view" data-id="${san_pham_id}" href="javascript:void(0);">Thêm vào giỏ hàng</a>
                        <a class="btn btn-solid chiTiet" href="/san-pham/chi-tiet-san-pham/${san_pham_id}">Xem chi tiết</a>
                    `;
                    document.querySelector("#quick-view .quantity input[type='number']").value=1;
                } else {
                    document.querySelector('#quick-view .product-buttons').innerHTML=`<button class="btn btn_black sm">Hết hàng</button>`;
                }
                // Cập nhật giá trị tối đa cho input
                maxInputQuantity(maxSL);
                themGioHang();
            },
            error: function () {
                alert('Có lỗi xảy ra khi lấy số lượng tồn kho!');
            }
        });
    }else{
        document.querySelector('#quick-view .plus').disabled=true;
        document.querySelector('#quick-view .minus').disabled=true;
        document.querySelector("#quick-view input[type='number']").value=1;

    }
}

// Xử lý chọn kích cỡ
function selectSize(){
    document.querySelectorAll('#selectSize-quick-view li').forEach(function (sizeElement) {
        sizeElement.addEventListener('click', function () {
            if (this.classList.contains('active')) {
                this.classList.remove('active');
                selectedSizeQuickView = null;
                ipSize.value = "";
            } else {
                selectedSizeQuickView = this.getAttribute('data-size');
                ipSize.value = selectedSizeQuickView;

                document.querySelectorAll('#selectSize-quick-view li').forEach(el => el.classList.remove('active'));
                this.classList.add('active');
            }
            updateQuantity();
        });
    });
}

// Xử lý chọn màu sắc
function selectColor(){
    document.querySelectorAll('#selectMauSac-quick-view li').forEach(function (colorElement) {
        colorElement.addEventListener('click', function () {
            if (this.classList.contains('activ')) {
                this.classList.remove('activ');
                selectedColorQuickView = null;
                ipMauSac.value = "";
            } else {
                selectedColorQuickView = this.getAttribute('data-color');
                ipMauSac.value = selectedColorQuickView;

                document.querySelectorAll('#selectMauSac-quick-view li').forEach(el => el.classList.remove('activ'));
                this.classList.add('activ');
            }
            updateQuantity();
        });
    });
}

// Thêm vào giỏ hàng
function themGioHang(){
    let btnThemGioHang = document.querySelector('#themGioHang-quick-view');

    if (btnThemGioHang) {
        btnThemGioHang.addEventListener('click', function () {
            if (selectedSizeQuickView && selectedColorQuickView) {
                let dataMax = document.querySelector('.quantity input[type="number"]');
                if(dataMax.getAttribute('data-max')>0){
                    let token= document.querySelector("#quick-view .tokenThemGioHang").value;
                    let sanPhamID = btnThemGioHang.getAttribute('data-id');
                    let soLuong = document.querySelector('#soLuong-quick-view').value;
                    let giaKhuyenMai = document.querySelector('#quick-view .giaKhuyenMai').getAttribute('data-giaKM');
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
                                $('#quick-view').modal('hide');
                                $('#addtocart').modal('show');
                                let tenSanPham = document.querySelector('#quick-view .product-right h3');
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
                }else{
                    let errSL = document.querySelector('#errSL-quick-view');
                    errSL.style.display='block';
                    setTimeout(() => {
                        errSL.style.transition = 'opacity 0.5s ease-out';
                        errSL.style.opacity = '0';
                        setTimeout(() => {
                            errSL.style.display = 'none';
                        }, 500); // Thời gian cho quá trình mờ dần
                    }, 5000);
                }
            } else {
                let errSelect = document.querySelector('#errSelect-quick-view');
                errSelect.style.display='block';
                setTimeout(() => {
                    errSelect.style.transition = 'opacity 0.5s ease-out';
                    errSelect.style.opacity = '0';
                    setTimeout(() => {
                        errSelect.style.display = 'none';
                    }, 500); // Thời gian cho quá trình mờ dần
                }, 5000);
            }
        });
    }
}

//yeu thich
function yeuThich(){
    const wishlistIcon = document.querySelectorAll('.wishlist-icon');
    if(wishlistIcon){
        wishlistIcon.forEach((el)=>{
            el.addEventListener('click',function(){
                let sanPhamId= el.getAttribute('data-wishlistIdSanPham');
                $.ajax({
                    url: '/yeu-thich/them-yeu-thich',
                    type: 'POST',
                    data: {
                        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        sanPhamId: sanPhamId,
                    },
                    success: function(response) {
                        if(response.success){
                            if(response.exist){
                                const a = document.querySelectorAll(`a[data-wishlistIdSanPham="${sanPhamId}"]`);
                                a.forEach((el)=>{
                                    el.style.backgroundColor = "rgba(255,255,255,1)";
                                });

                                const i = document.querySelectorAll(`a[data-wishlistIdSanPham="${sanPhamId}"] i`);
                                i.forEach((el)=>{
                                    el.setAttribute('style','--Iconsax-Color: rgba(38,40,52,1)');
                                });


                            }else{
                                const a = document.querySelectorAll(`a[data-wishlistIdSanPham="${sanPhamId}"]`);
                                a.forEach((el)=>{
                                    el.style.backgroundColor = "#e67e22";
                                });

                                const i = document.querySelectorAll(`a[data-wishlistIdSanPham="${sanPhamId}"] i`);
                                i.forEach((el)=>{
                                    el.setAttribute('style','--Iconsax-Color: #fff');
                                });
                            }

                            document.querySelector('.soLuongYeuThich').textContent = response.count_yeu_thich;

                            Toastify({
                                text: `${response.message}`,
                                duration: 2500,
                                close: true,
                            }).showToast();

                        }else{
                            console.log(response.error);

                            window.location.href="/tai-khoan/dang-nhap";
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Có lỗi xảy ra: ", error);
                    }
                });
            });
        });
    }
}

function yeuThichChiTiet(){
    const wishlistChiTiet = document.querySelector('.wishlist-chi-tiet');
    if(wishlistChiTiet){
        wishlistChiTiet.addEventListener('click',function(){
            let sanPhamId= wishlistChiTiet.getAttribute('data-wishlistIdSanPham');

            $.ajax({
                url: '/yeu-thich/them-yeu-thich',
                type: 'POST',
                data: {
                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    sanPhamId: sanPhamId,
                },
                success: function(response) {
                    if(response.success){
                        if(response.exist){
                            wishlistChiTiet.innerHTML="<a> <i class='fa-regular fa-heart me-2'></i>Thêm vào yêu thích</a>";

                        }else{
                            wishlistChiTiet.innerHTML="<a class='text-danger'> <i class='fa-regular fa-heart me-2 text-danger'></i>Xóa khỏi yêu thích</a>";
                        }
                        Toastify({
                            text: `${response.message}`,
                            duration: 2500,
                            close: true,
                        }).showToast();
                        document.querySelector('.soLuongYeuThich').textContent = response.count_yeu_thich;
                    }else{
                        console.log(response.error);

                        window.location.href="/tai-khoan/dang-nhap";
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Có lỗi xảy ra: ", error);
                }
            });
        });
    }
}
function xoaYeuThich(){
    const xoaYeuThich =document.querySelectorAll('.wishlist-box .deleteYeuThich');
    if(xoaYeuThich){
        xoaYeuThich.forEach((el)=>{
            el.addEventListener('click',function(){
                let yeuThichId = el.getAttribute('data-id');

                $.ajax({
                    url: '/yeu-thich/xoa-yeu-thich',
                    type: 'POST',
                    data: {
                        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        yeuThichId: yeuThichId,
                    },
                    success: function(response) {
                        if(response.success){
                            el.closest('.col').remove();
                            if (response.count_yeu_thich === 0) {
                                document.querySelector('.wishlist-box #data-show').style.display= 'block';
                            }
                            Toastify({
                                text: `${response.message}`,
                                duration: 2500,
                                close: true,
                            }).showToast();
                            document.querySelector('.soLuongYeuThich').textContent = response.count_yeu_thich;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Có lỗi xảy ra: ", error);
                    }
                });
            });
        });
    }
}
//time
// function flashSaleTime(){
//     // Lấy ngày bắt đầu (hiện tại)
//     const startDate = new Date();

//     // Thêm 10 ngày vào ngày bắt đầu
//     const endDate = new Date(startDate.getTime() + 10 * 24 * 60 * 60 * 1000);

//     // Hàm đếm ngược
//     function countdown() {
//         const now = new Date(); // Thời gian hiện tại
//         const timeRemaining = endDate - now; // Thời gian còn lại (ms)

//         if (timeRemaining > 0) {
//             // Tính số ngày, giờ, phút, giây
//             const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
//             const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//             const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
//             const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

//             // Cập nhật giao diện
//             document.getElementById("days").textContent = days;
//             document.getElementById("hours").textContent = String(hours).padStart(2, "0");
//             document.getElementById("minutes").textContent = String(minutes).padStart(2, "0");
//             document.getElementById("seconds").textContent = String(seconds).padStart(2, "0");
//         } else {
//             // Khi hết thời gian
//             clearInterval(timer);
//             document.getElementById("countdown").innerHTML = "Thời gian đã kết thúc!";
//         }
//     }

//     // Gọi hàm đếm ngược mỗi giây
//     const timer = setInterval(countdown, 1000);

//     // Gọi ngay khi bắt đầu (để hiển thị đúng thời gian ban đầu)
//     countdown();

// }




