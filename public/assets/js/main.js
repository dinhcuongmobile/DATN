document.addEventListener('DOMContentLoaded',()=>{
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
    //gio hang
    let checkSessionGioHang  = false;
    if (window.location.pathname === '/gio-hang/chi-tiet-thanh-toan') {
        checkSessionGioHang =true;
    }else{
        checkSessionGioHang =false;
    }

    if (!checkSessionGioHang ) {
        fetch('/gio-hang/xoa-session-gio-hang', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
    }

    // dat hang chuyen khoan
    let checkSessionDatHangCK  = false;
    if (window.location.pathname === '/gio-hang/create-payment/' || window.location.pathname === '/gio-hang/hoan-tat-chuyen-khoan-don-hang/') {
        checkSessionDatHangCK =true;
    }else{
        checkSessionDatHangCK =false;
    }

    if (!checkSessionDatHangCK ) {
        fetch('/gio-hang/xoa-session-dat-hang-chuyen-khoan', {
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
        document.querySelector('#errSelect-quick-view').style.display = 'none';
        document.querySelector('#mauSac-quick-view').value="";
        document.querySelector('#size-quick-view').value="";
        selectedSizeQuickView = null;
        selectedColorQuickView = null;
        $('#quick-view').modal('show');
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
            if (inputEl.value <= parseInt(inputEl.getAttribute('data-max'))) {
                inputEl.value = Number(inputEl.value) + 1;
                ipHidden.value = inputEl.value;
                subButton.disabled = false;
            }
            if (inputEl.value > parseInt(inputEl.getAttribute('data-max'))) {
                addButton.disabled = true;
                ipHidden.value = inputEl.getAttribute('data-max');
                inputEl.value = inputEl.getAttribute('data-max');
                let errSL = document.querySelector('#errSL-quick-view');
                errSL.style.display='block';
                setTimeout(() => {
                    errSL.style.display = 'none';
                }, 5000);
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
        if(maxSL==0) inputEl.value = 1;
        else inputEl.value = Math.min(inputEl.value, maxSL);
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
                var maxSL = parseInt(response.quantity) - parseInt(response.gio_hang);
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
            document.querySelector('#soLuong-quick-view').value = 1;
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
            document.querySelector('#soLuong-quick-view').value = 1;
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
                let dataMax = document.querySelector('#quick-view .quantity input[type="number"]').getAttribute('data-max');
                let token= document.querySelector("#quick-view .tokenThemGioHang").value;
                let sanPhamID = btnThemGioHang.getAttribute('data-id');
                let soLuong = document.querySelector('#soLuong-quick-view').value;
                let giaKhuyenMai = document.querySelector('#quick-view .giaKhuyenMai').getAttribute('data-giaKM');
                let kichCo = ipSize.value;
                let maMau = ipMauSac.value;
                if(Number(dataMax)>0 && Number(dataMax)>=Number(soLuong)){
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

                                document.querySelector('.countGioHangMenu span').textContent= response.count_gio_hang;
                                
                                let dataMaxNew = parseInt(dataMax)-soLuong;
                                document.querySelector('#quick-view .quantity input[type="number"]').setAttribute('data-max',dataMaxNew);

                                let sanPham = response.san_pham;
                                let row = document.querySelector('#addtocart .row');
                                row.innerHTML=`
                                    <div class="col-12 px-0">
                                        <div class="modal-bg addtocart"><button class="btn-close" type="button"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                            <div class="d-flex">
                                                <a class="imgAddtocartSuccess">
                                                   <img class="style-border img-fluid blur-up lazyload pro-img" src="/storage/${sanPham.hinh_anh}" alt="">
                                                </a>
                                                <div class="add-card-content align-self-center text-center">
                                                    <a>
                                                        <h6>
                                                            <i class="fa-solid fa-check"> </i>Sản phẩm
                                                            <span id="nameProductSuccess">${sanPham.ten_san_pham}</span>
                                                            <span> đã được thêm vào Giỏ hàng của bạn thành công</span>
                                                        </h6>
                                                    </a>
                                                    <div class="buttons">
                                                        <a class="view-cart btn btn-solid" href="/gio-hang/">Giỏ hàng của bạn</a>
                                                        <a class="continue btn btn-solid" href="/san-pham/">Tiếp tục mua hàng</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="product-upsell">
                                            <h5>Sản phẩm được khách hàng yêu thích</h5>
                                        </div>
                                    </div>`;

                                    response.spYeuThich.forEach((item, index)=>{
                                        let text = item.san_pham.ten_san_pham;
                                        let truncatedText = text.length > 27 ? text.slice(0, 27) + "..." : text;

                                        let giaKM = item.san_pham.gia_san_pham - (item.san_pham.gia_san_pham * item.san_pham.khuyen_mai / 100);
                                        let html = `
                                                <div class="col-lg-4 col-md-6 col-12">
                                                    <div class="card-img" style="padding-top: 10px;">
                                                        <img class="style-border" src="/storage/${item.san_pham.hinh_anh}" alt="${item.san_pham.ten_san_pham}">
                                                        <a href="/san-pham/chi-tiet-san-pham/${item.san_pham_id}">
                                                            <h6>${truncatedText}</h6>
                                                            <p>${giaKM.toLocaleString('vi-VN')}đ</p>
                                                        </a>
                                                    </div>
                                                </div>`;

                                        row.insertAdjacentHTML('beforeend', html);
                                    });
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
                        errSL.style.display = 'none';
                    }, 5000);
                }
            } else {
                let errSelect = document.querySelector('#errSelect-quick-view');
                errSelect.style.display='block';
                setTimeout(() => {
                    errSelect.style.display = 'none';
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
function openGift() {
    const giftBox = document.querySelector(".gift-box");
    const popup = document.querySelector(".popup-mo-qua");
    const fireworks = document.querySelector(".fireworks");

    popup.querySelector('h4').textContent = "Suýt nữa thì nhận được quà rồi <3 !";
    popup.querySelector('.coin-amount').textContent = '';
    // Hiển thị popup sau 1 giây
    setTimeout(() => {
        popup.style.display = "block";
    }, 1000);

    // Hiển thị pháo hoa
    fireworks.classList.remove("hidden");

    // Thêm class "opened" để kích hoạt hiệu ứng
    if(!document.querySelector('.best-seller-box .opened')){
        giftBox.classList.add("opened");
    }
}
document.addEventListener('click', function(event) {
    const popup = event.target.closest(".popup-mo-qua");

    // Nếu không click vào popup hoặc nút "Thay đổi" thì ẩn tất cả popup
    if (!popup) {
        const popupMoQua = document.querySelector(".popup-mo-qua");
        if(popupMoQua){
            popupMoQua.style.display = 'none';
        }

    }
});

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
$(document).ready(function() {
    // Hàm định dạng giá tiền theo VND
    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
    }

    // Khi người dùng gõ trong ô tìm kiếm
    $('input[name="search_text"]').on('keyup', function() {
        let searchText = $(this).val();

        // Kiểm tra nếu có nội dung tìm kiếm
        if (searchText.length >= 1) { // Thực hiện khi người dùng gõ ít nhất 1 ký tự
            $.ajax({
                url: '/home/search/',
                method: 'GET',
                data: { search_text: searchText },
                success: function(response) {
                    // Xử lý kết quả trả về (JSON)
                    let results = response.results;

                    let html = '';
                    if (results.length === 0) {
                        // Nếu không có kết quả, hiển thị thông báo
                        html = '<p class="text-center text-danger">Không có sản phẩm bạn muốn tìm.</p>';
                    } else {

                        // HTML kết quả tìm kiếm
                        results.forEach(function(san_pham) {
                            let danhGias = san_pham.danh_gias || []; // Lấy danh sách đánh giá
                            let totalRating = 0; // Tổng số sao
                            let totalReviews = danhGias.length; // Số lượng đánh giá

                            // Tính tổng số sao từ danh_gias
                            danhGias.forEach(function(danhGia) {
                                totalRating += danhGia.so_sao;
                            });

                            // Tính trung bình số sao (nếu có đánh giá)
                            let avgRating = totalReviews > 0 ? (totalRating / totalReviews) : 0;

                            // Làm tròn và chuẩn bị dữ liệu cho giao diện
                            let fullStars = Math.floor(avgRating); // Sao đầy
                            let halfStar = (avgRating - fullStars) >= 0.5 ? 1 : 0; // Sao nửa
                            let emptyStars = 5 - (fullStars + halfStar); // Sao rỗng

                            // Tạo HTML cho rating
                            let ratingHtml = '<ul class="rating">';
                            for (let i = 0; i < fullStars; i++) {
                                ratingHtml += '<li><i class="fa-solid fa-star"></i></li>';
                            }
                            if (halfStar) {
                                ratingHtml += '<li><i class="fa-solid fa-star-half-stroke"></i></li>';
                            }
                            for (let i = 0; i < emptyStars; i++) {
                                ratingHtml += '<li><i class="fa-regular fa-star"></i></li>';
                            }
                            ratingHtml += `<li>(${avgRating.toFixed(1)})</li></ul>`;

                            // Tính giá khuyến mại nếu có giảm giá
                            if (san_pham.khuyen_mai > 0) {
                                let gia_khuyen_mai = san_pham.gia_san_pham -
                                    (san_pham.gia_san_pham * san_pham.khuyen_mai / 100);

                                html += `
                                    <div class="col-xl-2 col-sm-4 col-6">
                                        <div class="product-box-6">
                                            <div class="img-wrapper">
                                                <div class="product-image">
                                                    <a href="/san-pham/chi-tiet-san-pham/${san_pham.id}">
                                                        <img class="bg-img" src="/storage/${san_pham.hinh_anh}" alt="product">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-detail">
                                                <div>
                                                    <a href="/san-pham/chi-tiet-san-pham/${san_pham.id}">
                                                        <h6>${san_pham.ten_san_pham}</h6>
                                                    </a>
                                                    <p class="original-price">${formatCurrency(san_pham.gia_san_pham)}</p>
                                                    <p class="discounted-price">${formatCurrency(gia_khuyen_mai)}</p>
                                                    ${ratingHtml}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            } else {
                                // Không có khuyến mại, chỉ hiển thị giá gốc
                                html += `
                                    <div class="col-xl-2 col-sm-4 col-6">
                                        <div class="product-box-6">
                                            <div class="img-wrapper">
                                                <div class="product-image">
                                                    <a href="/san-pham/chi-tiet-san-pham/${san_pham.id}">
                                                        <img class="bg-img" src="/storage/${san_pham.hinh_anh}" alt="product">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-detail">
                                                <div>
                                                    <a href="/san-pham/chi-tiet-san-pham/${san_pham.id}">
                                                        <h6>${san_pham.ten_san_pham}</h6>
                                                    </a>
                                                    <p class="price">${formatCurrency(san_pham.gia_san_pham)}</p>
                                                    ${ratingHtml}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            }
                        });
                    }
                    // Cập nhật kết quả tìm kiếm
                    $('.preemptive-search').html(html);
                },
                error: function() {
                    // Thông báo lỗi khi không thể thực hiện tìm kiếm
                    $('.preemptive-search').html('<p class="text-center text-danger">Có lỗi xảy ra khi tìm kiếm. Vui lòng thử lại.</p>');
                }
            });
        } else {
            // Nếu ô tìm kiếm rỗng, ẩn kết quả tìm kiếm
            $('.preemptive-search').html('');
        }
    });
});

function hoanThanhTTOnline(){
    sessionStorage.setItem("activeTab", "order");
    window.location.href="/tai-khoan/thong-tin-tai-khoan";
}
// Form gửi liên hệ
function guiLienHe() {
    var hoVaTen = $("#ho_va_ten").val();
    var email = $("#email").val();
    var soDienThoai = $("#so_dien_thoai").val();
    var tieuDe = $("#tieu_de").val();
    var noiDung = $("#noi_dung").val();

    var check = true;

    if (hoVaTen == "") {
        $("#ho_va_ten_err").text("Họ và tên không được bỏ trống");

        check = false;
    } else {
        $("#ho_va_ten_err").text("");
    }

    if (email == "") {
        $("#email_err").text("Email không được bỏ trống");

        check = false;
    } else {
        var regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

        if (!regex.test(email)) {
            $("#email_err").text("Email không hợp lệ");

            check = false;
        } else {
            $("#email_err").text("");
        }
    }

    if (soDienThoai == "") {
        $("#so_dien_thoai_err").text("Số điện thoại không được bỏ trống");

        check = false;
    } else {
        var regex = /^(?:\+84|0)(?:3[2-9]|5[2-9]|7[0-9]|8[1-9]|9[0-9])\d{7}$/;

        if (!regex.test(soDienThoai)) {
            $("#so_dien_thoai_err").text("Số điện thoại không hợp lệ");

            check = false;
        } else {
            $("#so_dien_thoai_err").text("");
        }
    }

    if (tieuDe == "") {
        $("#tieu_de_err").text("Tiêu đề không được bỏ trống");

        check = false;
    } else {
        $("#tieu_de_err").text("");
    }

    if (noiDung == "") {
        $("#noi_dung_err").text("Nội dung không được bỏ trống");

        check = false;
    } else {
        $("#noi_dung_err").text("");
    }

    if (check) {
        var token = $("#token").val();

        $.ajax({
            type: "post",
            url: "/lien-he/gui-lien-he",
            data: {
                _token: token,
                ho_va_ten: hoVaTen,
                email: email,
                so_dien_thoai: soDienThoai,
                tieu_de: tieuDe,
                noi_dung: noiDung
            },
            success: function(res) {
                $("#thong_bao").fadeIn();
                setTimeout(function() {
                    $("#thong_bao").fadeOut();
                }, 5000);
                $("#ho_va_ten").val("");
                $("#email").val("");
                $("#so_dien_thoai").val("");
                $("#tieu_de").val("");
                $("#noi_dung").val("");
            },
            error: function(error) {
                alert("Có lỗi khi gửi liên hệ. Vui lòng thử lại sau");
            }
        })
    }
}




