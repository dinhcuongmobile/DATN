
document.addEventListener('DOMContentLoaded',()=>{
    soLuongMua();
    selectSize();
    selectColor();
    themGioHang();
    muaNgay();
    btnDanhGiaSoSao();
    paginationEvent();
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
            if (inputEl.value <= parseInt(inputEl.getAttribute('data-max'))) {
                inputEl.value = Number(inputEl.value) + 1;
                ipHidden.value = inputEl.value;
                subButton.disabled = false;
            }
            if (inputEl.value > parseInt(inputEl.getAttribute('data-max'))) {
                addButton.disabled = true;
                ipHidden.value = inputEl.getAttribute('data-max');
                inputEl.value = inputEl.getAttribute('data-max');
                let errSL = document.querySelector('#errSL');
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
    plusMinus.forEach((element) => {
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
                var maxSL = parseInt(response.quantity) - parseInt(response.gio_hang);

                if (soLuongTon > 0) {
                    document.getElementById('soLuongTon').textContent = soLuongTon;
                    document.getElementById('soLuongTon').style.color="rgba(118, 118, 118, 1)";
                    document.querySelector('.btn-mua-hang').innerHTML=`
                            <a id="themGioHang" class="btn btn_black sm" href="javascript:void(0);"
                            data-id="${san_pham_id}">Thêm giỏ hàng</a>
                            <a class="btn btn_outline sm" id="muaNgay" href="javascript:void(0)">Mua ngay</a>
                        `;
                } else {
                    document.getElementById('soLuongTon').textContent = 'Tạm thời hết hàng';
                    document.getElementById('soLuongTon').style.color="red";
                    document.querySelector('.btn-mua-hang').innerHTML=`<button class="btn btn_black sm">Hết hàng</button>`;
                }
                // Cập nhật giá trị tối đa cho input
                maxInputQuantity(maxSL);
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
            document.querySelector('#soLuong').value=1;
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
            document.querySelector('#soLuong').value=1;
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
                let dataMax = document.querySelector('.quantity input[type="number"]').getAttribute('data-max');
                let token= document.querySelector(".tokenThemGioHang").value;
                let sanPhamID = btnThemGioHang.getAttribute('data-id');
                let soLuong = document.getElementById('soLuong').value;
                let giaKhuyenMai = document.getElementById('giaKhuyenMai').getAttribute('data-giaKM');
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
                                document.querySelector('.countGioHangMenu span').textContent= response.count_gio_hang;
                                
                                let dataMaxNew = parseInt(dataMax)-soLuong;
                                document.querySelector('.quantity input[type="number"]').setAttribute('data-max',dataMaxNew);
                                document.querySelector('.quantity input[type="number"]').value = dataMaxNew > 0 ? 1 : 0;
                                document.querySelector('.quantity #soLuong').value = dataMaxNew > 0 ? 1 : 0;

                                $('#addtocart').modal('show');
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
                    let errSL = document.querySelector('#errSL');
                    errSL.style.display='block';
                    setTimeout(() => {
                        errSL.style.display = 'none';
                    }, 5000);
                }
            } else {
                let errSelect = document.querySelector('#errSelect');
                errSelect.style.display='block';
                setTimeout(() => {
                    errSelect.style.display = 'none';
                }, 5000);
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

function btnDanhGiaSoSao(){
    const btnSelect = document.querySelectorAll('#Reviews-tab-pane .box-button button');
    if(btnSelect){
        btnSelect.forEach((el)=>{
            el.addEventListener('click',function(){

                //xoa class active cua cac button
                btnSelect.forEach((item)=>{
                    item.classList.remove("active");
                })
                // them active cho button hien tai
                el.classList.add('active');

                //lay dieu kien
                let dataFilter = el.getAttribute('data-filter');
                let sanPhamID = document.querySelector('#Reviews-tab-pane').getAttribute('data-spid');
                $.ajax({
                    url: '/san-pham/loc-danh-gia',
                    method: 'GET',
                    data: {
                        san_pham_id: sanPhamID,
                        dataFilter: dataFilter
                    },
                    success: function (response) {
                        if (response.success) {

                            const ReviewsTabPane = document.querySelector('#Reviews-tab-pane');
                            const row = ReviewsTabPane.querySelector('.row');
                            const reviewContent = row.querySelector('.review-content');
                            const paginationWrap = ReviewsTabPane.querySelector('.pagination-wrap');
                            reviewContent.innerHTML="";

                            if(response.danh_gias.data.length > 0){
                                response.danh_gias.data.forEach((item)=>{

                                    let ratingStars = '';
                                    for (let i = 1; i <= 5; i++) {
                                        if (i <= item.so_sao) {
                                            ratingStars += '<li><i class="fa-solid fa-star"></i></li>';
                                        } else {
                                            ratingStars += '<li><i class="fa-regular fa-star"></i></li>';
                                        }
                                    }

                                    let traLoiDanhGia = "";
                                    item.tra_loi_danh_gia.forEach((TL)=>{
                                        traLoiDanhGia +=
                                                `<div class="phan-hoi mt-3">
                                                    <p>Phản hồi từ shop</p>
                                                    <div class="noi-dung-phan-hoi mt-2">
                                                        <span>${TL.noi_dung}</span>
                                                    </div>
                                                </div>`;
                                    });

                                    //ngay binh luan format
                                    let date = new Date(item.created_at);
                                    date.setHours(date.getHours() + 7);
                                    let formattedDate = date.toISOString().replace('T', ' ').slice(0, 19);

                                    // format email neu khong co ho ten
                                    let email = item.user.email;
                                    let [localPart, domain] = email.split("@");
                                    let maskedLocal = localPart.slice(0, 4) + "******" + localPart.slice(-2);
                                    let maskedEmail = maskedLocal + "@" + domain;

                                    // Tạo HTML cho từng đánh giá
                                    let reviewHTML = `
                                        <div class="review-item">
                                            <div class="avt-user">
                                                <img src="/assets/images/user/12.jpg" alt="">
                                            </div>
                                            <div class="thong-tin">
                                                <span class="user-name">${item.user.ho_va_ten || maskedEmail}</span>
                                                <ul class="rating mt-1">${ratingStars}</ul>
                                                <div class="date">${formattedDate}</div>
                                                <div class="noi-dung">
                                                    <p class="noi-dung-text">${item.noi_dung ?? ''}</p>
                                                    <div class="noi-dung-img">
                                                        ${item.anh_danh_gias.map(anh => `<img src="/storage/${anh.hinh_anh}" alt="Hình ảnh đánh giá">`).join('')}
                                                    </div>
                                                </div>
                                                ${item.tra_loi_danh_gia.length>0 ? traLoiDanhGia: ''}
                                            </div>
                                        </div>
                                    `;
                                    reviewContent.insertAdjacentHTML('beforeend', reviewHTML);
                                });

                                paginationWrap.style.display ="";
                                updatePagination(response.danh_gias);
                                paginationEvent();
                            } else {
                                reviewContent.innerHTML = "";
                                paginationWrap.style.display = "none";
                            }


                        }
                    },
                    error: function () {
                        alert('Có lỗi xảy ra!');
                    }
                });


            });
        });
    }
}

function updatePagination(paginationData) {
    const paginationWrap = document.querySelector('#Reviews-tab-pane .pagination-wrap');
    const pagination = paginationWrap.querySelector('.pagination');
    pagination.innerHTML = '';  // Xóa các phần tử phân trang hiện tại

    // Nút "Trước"
    const prevButton = document.createElement('li');
    prevButton.classList.add(paginationData.current_page === 1 ? 'disabled' : '');
    prevButton.innerHTML = `<a class="prev" href="javascript:void(0);" data-page="${paginationData.current_page - 1}">
                                <i class="iconsax" data-icon="chevron-left"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.0013 20.6695C14.8113 20.6695 14.6213 20.5995 14.4713 20.4495L7.95125 13.9295C6.89125 12.8695 6.89125 11.1295 7.95125 10.0695L14.4713 3.54953C14.7613 3.25953 15.2413 3.25953 15.5312 3.54953C15.8212 3.83953 15.8212 4.31953 15.5312 4.60953L9.01125 11.1295C8.53125 11.6095 8.53125 12.3895 9.01125 12.8695L15.5312 19.3895C15.8212 19.6795 15.8212 20.1595 15.5312 20.4495C15.3813 20.5895 15.1912 20.6695 15.0013 20.6695Z" fill="#292D32"></path>
                                    </svg>
                                </i>
                            </a>`;
    pagination.appendChild(prevButton);

    // Số trang
    for (let i = 1; i <= paginationData.last_page; i++) {
        const pageButton = document.createElement('li');
        pageButton.innerHTML = `<a class="${i === paginationData.current_page ? 'active' : ''}" href="javascript:void(0);" data-page="${i}">${i}</a>`;
        pagination.appendChild(pageButton);
    }

    // Nút "Tiếp"
    const nextButton = document.createElement('li');
    let disabled = paginationData.current_page === paginationData.last_page ? 'disabled' : '';
    nextButton.setAttribute('class',disabled);
    nextButton.innerHTML = `<a class="next" href="javascript:void(0);" data-page="${paginationData.current_page + 1}">
                                <i class="iconsax" data-icon="chevron-right"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.91156 20.6695C8.72156 20.6695 8.53156 20.5995 8.38156 20.4495C8.09156 20.1595 8.09156 19.6795 8.38156 19.3895L14.9016 12.8695C15.3816 12.3895 15.3816 11.6095 14.9016 11.1295L8.38156 4.60953C8.09156 4.31953 8.09156 3.83953 8.38156 3.54953C8.67156 3.25953 9.15156 3.25953 9.44156 3.54953L15.9616 10.0695C16.4716 10.5795 16.7616 11.2695 16.7616 11.9995C16.7616 12.7295 16.4816 13.4195 15.9616 13.9295L9.44156 20.4495C9.29156 20.5895 9.10156 20.6695 8.91156 20.6695Z" fill="#292D32"></path>
                                    </svg>
                                </i>
                            </a>`;
    pagination.appendChild(nextButton);
}

function loadDanhGiaPage(page) {
    let sanPhamID = document.querySelector('#Reviews-tab-pane').getAttribute('data-spid');

    $.ajax({
        url: `/san-pham/loc-danh-gia?page=${page}`,
        method: 'GET',
        data: {
            san_pham_id: sanPhamID,
            dataFilter: document.querySelector('#Reviews-tab-pane .box-button button.active').getAttribute('data-filter') || 'all'
        },
        success: function (response) {
            if (response.success) {
                const ReviewsTabPane = document.querySelector('#Reviews-tab-pane');
                const row = ReviewsTabPane.querySelector('.row');
                const reviewContent = row.querySelector('.review-content');
                const paginationWrap = ReviewsTabPane.querySelector('.pagination-wrap');

                // Xóa nội dung cũ và cập nhật nội dung mới
                reviewContent.innerHTML = "";
                response.danh_gias.data.forEach((item)=>{

                    let ratingStars = '';
                    for (let i = 1; i <= 5; i++) {
                        if (i <= item.so_sao) {
                            ratingStars += '<li><i class="fa-solid fa-star"></i></li>';
                        } else {
                            ratingStars += '<li><i class="fa-regular fa-star"></i></li>';
                        }
                    }

                    let traLoiDanhGia = "";
                    item.tra_loi_danh_gia.forEach((TL)=>{
                        traLoiDanhGia +=
                                `<div class="phan-hoi mt-3">
                                    <p>Phản hồi từ shop</p>
                                    <div class="noi-dung-phan-hoi mt-2">
                                        <span>${TL.noi_dung}</span>
                                    </div>
                                </div>`;
                    });

                    //ngay binh luan format
                    let date = new Date(item.created_at);
                    date.setHours(date.getHours() + 7);
                    let formattedDate = date.toISOString().replace('T', ' ').slice(0, 19);

                    // format email neu khong co ho ten
                    let email = item.user.email;
                    let [localPart, domain] = email.split("@");
                    let maskedLocal = localPart.slice(0, 4) + "******" + localPart.slice(-2);
                    let maskedEmail = maskedLocal + "@" + domain;

                    // Tạo HTML cho từng đánh giá
                    let reviewHTML = `
                        <div class="review-item">
                            <div class="avt-user">
                                <img src="/assets/images/user/12.jpg" alt="">
                            </div>
                            <div class="thong-tin">
                                <span class="user-name">${item.user.ho_va_ten || maskedEmail}</span>
                                <ul class="rating mt-1">${ratingStars}</ul>
                                <div class="date">${formattedDate}</div>
                                <div class="noi-dung">
                                    <p class="noi-dung-text">${item.noi_dung ?? ''}</p>
                                    <div class="noi-dung-img">
                                        ${item.anh_danh_gias.map(anh => `<img src="/storage/${anh.hinh_anh}" alt="Hình ảnh đánh giá">`).join('')}
                                    </div>
                                </div>
                                ${item.tra_loi_danh_gia.length>0 ? traLoiDanhGia: ''}
                            </div>
                        </div>
                    `;
                    reviewContent.insertAdjacentHTML('beforeend', reviewHTML);
                });

                // Cập nhật phân trang mới
                paginationWrap.innerHTML = response.pagination;
                paginationEvent();
            }
        },
        error: function () {
            alert('Có lỗi xảy ra!');
        }
    });
}

function paginationEvent(){
    const a = document.querySelectorAll('#Reviews-tab-pane .pagination-wrap a');
    if(a){
        a.forEach((el)=>{
            el.addEventListener('click', function (event) {
                event.preventDefault();
                let page = el.getAttribute('data-page');
                if (page) {
                    loadDanhGiaPage(page);
                }
            });
        })
    }
}


