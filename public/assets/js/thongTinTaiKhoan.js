document.addEventListener('DOMContentLoaded',function(){
    document.documentElement.scrollTop = 0;
    document.body.scrollTop = 0;
    tabDonMua();
    activeDonHang();
    activeTabDonMua("activeTabDaHuy", "tap6");
    activeTabDonMua("activeTabHoanThanh", "tap5");
    chiTietDonMua();
    huyDonHang();
    reviews();
});

//active don hang
function activeDonHang(){
    const activeTab = sessionStorage.getItem("activeTab");

    if (activeTab === "order") {
        const dashboardTab = document.querySelector('#dashboard-tab');
        const dashboardContent = document.querySelector('#dashboard');
        const donHangTab = document.querySelector('#order-tab');
        const donHangContent = document.querySelector('#order');
        //xoa class active neu co
        dashboardTab.classList.remove('active');
        donHangTab.setAttribute('aria-selected', 'false');
        donHangTab.setAttribute('tabindex', '-1');
        dashboardContent.classList.remove('active','show');

        //them active
        donHangTab.classList.add('active');
        donHangTab.setAttribute('aria-selected', 'true');
        if (donHangTab.hasAttribute('tabindex') && donHangTab.getAttribute('tabindex') === "-1") {
            donHangTab.removeAttribute('tabindex');
        }

        donHangContent.classList.add('active','show');

        // Xóa trạng thái sau khi sử dụng
        sessionStorage.removeItem("activeTab");
    }
}
//don mua

function tabDonMua() {
    document.querySelectorAll('#order .an').forEach((el) => {
        if (el.getAttribute('id') !== "tap1") {
            el.style.display = "none";
        }
    });

    document.querySelectorAll('#order .nav-tab li').forEach((tabItem) => {
        tabItem.addEventListener('click', function () {
            const tab = tabItem.querySelector('a').getAttribute('data-tap');

            document.querySelectorAll('#order .nav-tab li').forEach((el) => {
                el.classList.remove('active');
            });

            tabItem.classList.add('active');

            document.querySelectorAll('#order .an').forEach((el) => {
                el.style.display = el.getAttribute('id') === tab ? "" : "none";
            });
        });
    });
}


//end don mua
function activeTabDonMua(tabKey, tabId) {
    const activeTab = sessionStorage.getItem(tabKey);
    if (activeTab === tabId) {
        const order = document.getElementById('order');

        // Xóa class active của tất cả các tab
        order.querySelectorAll('.nav-tab li').forEach(el => el.classList.remove('active'));

        // Thêm class active vào tab hiện tại
        const targetTab = order.querySelector(`.nav-tab a[data-tap="${tabId}"]`);
        if (targetTab) {
            targetTab.closest('li').classList.add('active');
        }

        // Ẩn tất cả các phần tử có class 'an'
        order.querySelectorAll('.an').forEach(el => el.style.display = "none");

        // Hiển thị tab tương ứng
        order.querySelector(`div#${tabId}`).style.display = "";

        // Xóa sessionStorage sau khi xử lý
        sessionStorage.removeItem(tabKey);
    }
}



//chi-tiet-don-mua click
function chiTietDonMua(){
    const productRow = document.querySelectorAll('.order .product-row');
    if (productRow) {
        productRow.forEach((el)=>{
            el.addEventListener('click',function(){
                const donHangContent = document.querySelector('#order');
                const chiTietDonHangContent = document.querySelector('#order-details');
                const donHangId= el.closest('.card').getAttribute('data-donHangId');

                $.ajax({
                    type: 'GET',
                    url: '/don-hang/chi-tiet-don-hang/',
                    data: {
                        donHangId: donHangId
                    },
                    success: function (response) {
                        if(response.success){
                            document.documentElement.scrollTop = 0;
                            document.body.scrollTop = 0;

                            let donHang = response.don_hang;
                            let diaChi = response.dia_chi;
                            let chiTietDonHang = response.chi_tiet_don_hangs;
                            let tongTienHang = 0 ;
                            let phiShip = response.phi_ships ? response.phi_ships.phi_ship : 0;

                            document.querySelector('#order-details .maDH .maDonHang').textContent = donHang.ma_don_hang;
                            document.querySelector('#order-details .van-chuyen .ten-nhan-hang').textContent = diaChi.ho_va_ten_nhan;
                            document.querySelector('#order-details .van-chuyen .sdt-nhan').textContent = `(+84) ${diaChi.so_dien_thoai_nhan.slice(1)}`;
                            document.querySelector('#order-details .van-chuyen .dia-chi-nhan').textContent = `
                                ${diaChi.dia_chi_chi_tiet?diaChi.dia_chi_chi_tiet + ", " : ""}
                                ${diaChi.phuong_xa.ten_phuong_xa},
                                ${diaChi.quan_huyen.ten_quan_huyen},
                                ${diaChi.tinh_thanh_pho.ten_tinh_thanh_pho}.
                            `;
                            document.querySelector('#order-details .list-san-pham').innerHTML="";
                            chiTietDonHang.forEach((item)=>{
                                $('#order-details .list-san-pham').prepend(
                                    `<a class="product-list-a" href="">
                                        <div class="product-list">
                                            <img src="/storage/${item.bien_the.hinh_anh}" alt="err">
                                            <div class="product-details">
                                                <p class="tenSanPham">${item.san_pham.ten_san_pham}</p>
                                                <p class="phanLoaiHang">Phân loại hàng:
                                                    <span>${item.bien_the.kich_co}, ${item.bien_the.ten_mau}</span>.
                                                </p>
                                                <p>x${item.so_luong}</p>
                                            </div>
                                        </div>
                                        <div class="giaTienLS">
                                            <span>${item.don_gia.toLocaleString('vi-VN')}đ</span>
                                            <span><del>${item.san_pham.gia_san_pham.toLocaleString('vi-VN')}đ</del></span>
                                        </div>
                                    </a>`
                                );
                                tongTienHang += item.thanh_tien;
                            });

                            const elgiamGiaVanChuyen = document.querySelector('#order-details .table .giamGiaVanChuyen');
                            const elgiamGiaDonHang = document.querySelector('#order-details .table .giamGiaDonHang');
                            const elnamadXu = document.querySelector('#order-details .table .namadXu');

                            donHang.giam_gia_van_chuyen>0 ? elgiamGiaVanChuyen.style.display="" : elgiamGiaVanChuyen.style.display="none";
                            donHang.giam_gia_don_hang>0 ? elgiamGiaDonHang.style.display="" : elgiamGiaDonHang.style.display="none";
                            donHang.namad_xu>0 ? elnamadXu.style.display="" : elnamadXu.style.display="none";

                            document.querySelector('#order-details .table .tongTienHang td').textContent=`${tongTienHang.toLocaleString('vi-VN')}đ`;

                            document.querySelector('#order-details .table .phiVanChuyen td').textContent=`${phiShip.toLocaleString('vi-VN')}đ`;

                            elgiamGiaVanChuyen.querySelector('td').textContent=`-${donHang.giam_gia_van_chuyen.toLocaleString('vi-VN')}đ`;

                            elgiamGiaDonHang.querySelector('td').textContent=`-${donHang.giam_gia_don_hang.toLocaleString('vi-VN')}đ`;

                            elnamadXu.querySelector('td').textContent=`-${donHang.namad_xu.toLocaleString('vi-VN')}đ`;

                            document.querySelector('#order-details .table .thanhTien td').textContent=`${donHang.tong_thanh_toan.toLocaleString('vi-VN')}đ`;

                            document.querySelector('#order-details .table .phuongThucThanhToan td').textContent=
                                `${donHang.phuong_thuc_thanh_toan==0 ? 'Thanh toán khi nhận hàng' : 'Chuyển khoản'}`;

                            const timeline = document.querySelector('#order-details .timeline');
                            const deliveryStatus = document.querySelector('#order-details .delivery-status .trang-thai');
                            timeline.querySelectorAll('i').forEach((el)=>{
                                el.classList.remove('change','next-change');
                            });
                            deliveryStatus.querySelectorAll('p').forEach((el)=>{
                                el.classList.remove('active');
                            });
                            switch (donHang.trang_thai) {
                                case 0:
                                    //thong bao
                                    document.querySelector('#order-details .maDH .thongBaoDonHang').innerHTML =
                                    "<span class='text-warning'>Chờ xác nhận</span>";

                                    //trang thai theo doi
                                    timeline.querySelector('.zezo i').classList.add('change');
                                    timeline.querySelector('.one i').classList.add('next-change');
                                    deliveryStatus.innerHTML=`<p class="active"><i class="fa-solid fa-circle"></i><span>Đặt hàng thành công</span></p>`;

                                    break;
                                case 1:
                                    document.querySelector('#order-details .maDH .thongBaoDonHang').innerHTML =
                                    "<span class='text-success'>Đang chuẩn bị hàng</span>";

                                    //trang thai theo doi
                                    timeline.querySelector('.zezo i').classList.add('change');
                                    timeline.querySelector('.one i').classList.add('change');
                                    timeline.querySelector('.two i').classList.add('next-change');
                                    deliveryStatus.innerHTML=`
                                        <p class="active"><i class="fa-solid fa-circle"></i><span>Đơn hàng đang được chuẩn bị</span></p>
                                        <p><i class="fa-solid fa-circle"></i><span>Đặt hàng thành công</span></p>
                                    `;
                                break;
                                case 2:
                                    document.querySelector('#order-details .maDH .thongBaoDonHang').innerHTML =
                                    "<span class='text-success'>Đang giao</span>";

                                    //trang thai theo doi
                                    timeline.querySelector('.zezo i').classList.add('change');
                                    timeline.querySelector('.one i').classList.add('change');
                                    timeline.querySelector('.two i').classList.add('change');
                                    timeline.querySelector('.three i').classList.add('next-change');
                                    deliveryStatus.innerHTML=`
                                        <p class="active"><i class="fa-solid fa-circle"></i><span>Đơn hàng đang được vận chuyển</span></p>
                                        <p><i class="fa-solid fa-circle"></i><span>Đơn hàng đang được chuẩn bị</span></p>
                                        <p><i class="fa-solid fa-circle"></i><span>Đặt hàng thành công</span></p>
                                    `;
                                break;
                                case 3:
                                    document.querySelector('#order-details .maDH .thongBaoDonHang').innerHTML =
                                    "<span class='text-success'>Đã giao</span>";

                                    //trang thai theo doi
                                    timeline.querySelector('.zezo i').classList.add('change');
                                    timeline.querySelector('.one i').classList.add('change');
                                    timeline.querySelector('.two i').classList.add('change');
                                    timeline.querySelector('.three i').classList.add('change');
                                    timeline.querySelector('.four i').classList.add('change');
                                    timeline.querySelector('.five i').classList.add('next-change');
                                    deliveryStatus.innerHTML=`
                                        <p class="active"><i class="fa-solid fa-circle"></i><span>Đơn hàng đã được giao thành công tới ${diaChi.ho_va_ten_nhan}</span></p>
                                        <p><i class="fa-solid fa-circle"></i><span>Đơn hàng đang được vận chuyển</span></p>
                                        <p><i class="fa-solid fa-circle"></i><span>Đơn hàng đang được chuẩn bị</span></p>
                                        <p><i class="fa-solid fa-circle"></i><span>Đặt hàng thành công</span></p>
                                    `;
                                break;
                                case 4:
                                    document.querySelector('#order-details .maDH .thongBaoDonHang').innerHTML =
                                    "<span class='text-danger'>Đã hủy</span>";
                                break;
                            }

                            //show
                            donHangContent.classList.remove('active','show');
                            chiTietDonHangContent.classList.add('active','show');
                        }
                    },
                    error: function (error) {
                        console.error('Lỗi: ', error);
                        alert('Có lỗi xảy ra');
                    }
                });

            });
        });

        const quayLai = document.querySelector('#order-details .header .back');
        quayLai?.addEventListener('click',function(){
            const donHangContent = document.querySelector('#order');
            const chiTietDonHangContent = document.querySelector('#order-details');

            chiTietDonHangContent.classList.remove('active','show');
            donHangContent.classList.add('active','show');
        });
    }
}

//huy don hang
function huyDonHang(){
    let btnHuyDonHang = document.querySelectorAll('.btnDonMua .huyDonHang');

    if(btnHuyDonHang){
        btnHuyDonHang.forEach((el)=>{
            el.addEventListener('click',function(){
                let donHangId = el.closest('.card').getAttribute('data-donHangId');

                $.ajax({
                    type: 'POST',
                    url: '/don-hang/huy-don-hang/',
                    data: {
                        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        don_hang_id: donHangId
                    },
                    success: function (response) {
                        if(response.success){
                            sessionStorage.setItem("activeTab", "order");
                            sessionStorage.setItem("activeTabDaHuy", "tap6");
                            window.location.href="/tai-khoan/thong-tin-tai-khoan";
                        }
                    },
                    error: function (error) {
                        console.error('Lỗi: ', error);
                        alert('Có lỗi xảy ra');
                    }
                });

            });
        });
    }
}

//danh gia de hoan thanh don mua
function previewImages() {
    let elChonAnh = document.querySelectorAll('.img input[type="file"]');
    if (elChonAnh) {
        elChonAnh.forEach((el) => {
            el.addEventListener('change', function () {
                const previewContainer = el.closest('.img').querySelector('.image-preview');
                previewContainer.innerHTML = ""; // Xóa các hình ảnh cũ

                const maxFiles = 6; // Giới hạn số lượng ảnh
                const err = el.closest('.img').querySelector('.soLuongAnhErr');

                if (this.files.length > maxFiles) {
                    err.textContent = `Chỉ thêm được tối đa ${maxFiles} ảnh.`;
                    err.style.display = "block";
                    setTimeout(() => {
                        err.style.display = 'none';
                    }, 5000);
                    return;
                }

                if (this.files && this.files.length > 0) {
                    const countSpan = el.closest('.img').querySelector('.soLuongAnh span:first-child');
                    countSpan.textContent = this.files.length;

                    Array.from(this.files).forEach((file) => {
                        const objectURL = URL.createObjectURL(file); // Tạo URL tạm thời từ file
                        const img = document.createElement('img');
                        img.src = objectURL;

                        previewContainer.appendChild(img);

                        img.onload = () => URL.revokeObjectURL(objectURL);
                    });
                }
            });
        });
    }
}

function starRating() {
    let allStarContainers = document.querySelectorAll('#reviews .star-rating');
    if (allStarContainers) {
        allStarContainers.forEach((container) => {
            let stars = container.querySelectorAll('i');
            stars.forEach((star, index) => {
                star.addEventListener('click', function () {

                    stars.forEach((s, i) => {
                        if (i <= index) {
                            s.classList.remove('fa-regular', 'fa-star');
                            s.classList.add('fas', 'fa-star'); // Tô đầy
                        } else {
                            s.classList.remove('fas', 'fa-star');
                            s.classList.add('fa-regular', 'fa-star'); // Trống
                        }
                    });

                    let rating = index + 1;
                    container.setAttribute('data-rating', rating);
                });
            });
        });
    }
}

function ratingBtns(){
    const ratingBtns = document.querySelectorAll('#reviews .rating-btns');
    if(ratingBtns){
        ratingBtns.forEach((el)=>{
            let button = el.querySelectorAll('button');

            button.forEach((btn)=>{
                btn.closest('.row').querySelector('.noi-dung textarea').value = "";
                btn.addEventListener('click',function(){
                    btn.closest('.row').querySelector('.noi-dung textarea').value=btn.textContent;
                });
            });
        });
    }
}

function reviews(){
    let btnDanhGia = document.querySelectorAll('.btnDonMua .btnDanhGia');
    if(btnDanhGia){
        btnDanhGia.forEach((el)=>{
            el.addEventListener('click',function(){
                let donHangId = el.closest('.card').getAttribute('data-donHangId');

                $.ajax({
                    type: 'GET',
                    url: '/don-hang/show-modal-danh-gia/',
                    data: {
                        don_hang_id: donHangId
                    },
                    success: function (response) {
                        if(response.success){
                            let donHang = response.don_hang;
                            let chiTietDonHang = response.chi_tiet_don_hangs;

                            document.querySelector('#reviews .main').innerHTML="";
                            if(chiTietDonHang.length>0){
                                $('#reviews').modal('show');
                                chiTietDonHang.forEach((item, index)=>{
                                    $('#reviews .main').prepend(
                                        `<div class="row g-3 mt-1" data-idSp="${item.san_pham_id}" data-idDH="${item.don_hang_id}">
                                            <div class="boder"></div>
                                            <div class="popup-content"></div>
                                            <div class="row-item">
                                                <div class="product">
                                                    <div class="product-list">
                                                        <img src="/storage/${item.san_pham.hinh_anh}" alt="err">
                                                        <div class="product-details" style="padding-top:10px;">
                                                            <p class="tenSanPham">${item.san_pham.ten_san_pham}</p>
                                                        </div>
                                                    </div>
                                                    <div class="star-rating mt-2" data-rating="0">
                                                        <i class="fa-regular fa-star"></i>
                                                        <i class="fa-regular fa-star"></i>
                                                        <i class="fa-regular fa-star"></i>
                                                        <i class="fa-regular fa-star"></i>
                                                        <i class="fa-regular fa-star"></i>
                                                    </div>
                                                    <p class="starRatingErr text-danger"></p>
                                                </div>

                                                <div class="rating-btns">
                                                    <button>Chất lượng sản phẩm tuyệt vời</button>
                                                    <button>Đóng gói sản phẩm đẹp và chắc chắn</button>
                                                    <button>Shop phục vụ rất tốt</button>
                                                    <button>Rất đáng tiền</button>
                                                    <button>Thời gian giao hàng nhanh</button>
                                                </div>
                                                <div class="noi-dung mt-3">
                                                    <textarea class="form-control mb-3" rows="4" placeholder="Hãy chia sẻ những điều bạn thích về sản phẩm này nhé..."></textarea>
                                                    <div class="img mt-2">
                                                        <p>Tải ảnh lên:</p>
                                                        <div class="image-upload">
                                                            <input type="file" id="fileUpload${index}" accept="image/*" multiple>
                                                            <label for="fileUpload${index}"><i class="fa-solid fa-plus"></i></label>
                                                        </div>
                                                        <p class="soLuongAnh"><span>0</span>/<span>6</span></p>
                                                        <p class="soLuongAnhErr text-danger"></p>
                                                        <div class="image-preview mt-3"></div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-info mb-3 mt-3 guiDanhGia">Gửi Đánh Giá</button>
                                            </div>
                                        </div>`
                                    );
                                });
                            }

                            previewImages();
                            starRating();
                            guiDanhGia();
                            ratingBtns();
                        }
                    },
                    error: function (error) {
                        console.error('Lỗi: ', error);
                        alert('Có lỗi xảy ra');
                    }
                });

            });
        });
    }
}

function guiDanhGia(){
    let namadXu = 0;
    let unreviewedItems = Array.from(document.querySelectorAll('#reviews .main .row .row-item')).map(rowItem => ({
        id: rowItem.closest('.row').getAttribute('data-idSp'),
        content: rowItem.querySelector('.noi-dung textarea').value,
        files: rowItem.querySelector('.img input[type="file"]').files
    }));
    let btnGuiDanhGia = document.querySelectorAll('#reviews .guiDanhGia');
    if(btnGuiDanhGia){
        btnGuiDanhGia.forEach((el, index)=>{
            el.addEventListener('click',function(){
                const sanPhamId = el.closest('.row').getAttribute('data-idSp');
                const donHangId = el.closest('.row').getAttribute('data-idDH');
                const soSao = el.closest('.row-item').querySelector('.star-rating').getAttribute('data-rating');
                const noiDung = el.closest('.row-item').querySelector('.noi-dung textarea').value;

                const inputFiles = el.closest('.row-item').querySelector('.img input[type="file"]').files;
                const formData = new FormData();
                Array.from(inputFiles).forEach(file => {
                    formData.append('images[]', file); // Thêm file vào formData
                });
                if (soSao > 0) {
                    const formData = new FormData();
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                    formData.append('don_hang_id', donHangId);
                    formData.append('san_pham_id', sanPhamId);
                    formData.append('noiDung', noiDung);
                    formData.append('soSao', soSao);

                    Array.from(inputFiles).forEach(file => {
                        formData.append('images[]', file); // Thêm file vào formData
                    });

                    $.ajax({
                        type: 'POST',
                        url: '/don-hang/danh-gia/',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.success) {
                                const row = el.closest('.row');
                                const rowItem = row.querySelector('.row-item');
                                const popupContent = row.querySelector('.popup-content');

                                rowItem.style.transition = 'opacity 0.5s ease-out';
                                rowItem.style.opacity = 0;

                                setTimeout(() => {
                                    rowItem.remove();
                                    if (popupContent) {
                                        popupContent.style.display = "block";
                                        popupContent.innerHTML = `
                                            <i class="fas fa-check-circle"></i>
                                            <h2>Cảm ơn bạn!</h2>
                                            <p>Đánh giá của bạn đã được ghi nhận.</p>`;
                                    }
                                }, 500);

                                setTimeout(() => {
                                    //cap nhat lai mang
                                    unreviewedItems.forEach(item => {
                                        if (item.id === sanPhamId) {
                                            item.content = noiDung;
                                            item.files = inputFiles;
                                        }
                                    });

                                    // Kiểm tra xem tất cả đã đánh giá đủ điều kiện chưa
                                    const allReviewed = unreviewedItems.every(item => item.content.length >= 50 && item.files.length > 0);

                                    if (allReviewed) {
                                        namadXu=200;
                                        // Tạo dữ liệu để gửi qua AJAX
                                        const dataXu = new FormData();
                                        dataXu.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                                        dataXu.append('namad_xu', namadXu);

                                        $.ajax({
                                            type: 'POST',
                                            url: '/don-hang/cong-namad-xu-danh-gia',
                                            data: dataXu,
                                            processData: false,
                                            contentType: false,
                                            success: function (response) {
                                            },
                                            error: function (error) {
                                                console.error('Lỗi: ', error);
                                                alert('Không thể cộng Namad Xu. Vui lòng thử lại sau.');
                                            }
                                        });
                                    }

                                    const hiddenModal = document.querySelectorAll('#reviews .main .row .row-item');
                                    if (hiddenModal.length===0) {
                                        $('#reviews').modal('hide');

                                        $.ajax({
                                            type: 'POST',
                                            url: '/don-hang/cap-nhat-trang-thai-da-giao',
                                            data: {
                                                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                don_hang_id: donHangId
                                            },
                                            success: function (response) {
                                                if(response){
                                                    sessionStorage.setItem("activeTab", "order");
                                                    sessionStorage.setItem("activeTabHoanThanh", "tap5");
                                                    window.location.href="/tai-khoan/thong-tin-tai-khoan";
                                                }
                                            },
                                            error: function (error) {
                                                console.error('Lỗi: ', error);
                                                alert('Vui lòng thử lại sau.');
                                            }
                                        });
                                    }
                                }, 1300);
                            }
                        },
                        error: function (error) {
                            console.error('Lỗi: ', error);
                            alert('Có lỗi xảy ra');
                        }
                    });
                }
                else{
                    const errRating = el.closest('.row').querySelector('.product .starRatingErr');
                    errRating.textContent="Vui lòng chọn số sao. Để tiếp tục đánh giá !";
                    errRating.style.display="block";
                    setTimeout(() => {
                        errRating.style.transition = 'opacity 0.5s ease-out';
                        setTimeout(() => {
                            errRating.style.display = 'none';
                        }, 500); // Thời gian cho quá trình mờ dần
                    }, 5000);
                }

            });
        });


    }
}
