document.addEventListener('DOMContentLoaded',function(){
    tabDonMua();
    activeDonHang();
    activeTapDonMua();
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
            const tab = tabItem.querySelector('a').getAttribute('href').replace('#', '');

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
function activeTapDonMua() {
    const activeTabDaHuy = sessionStorage.getItem("activeTabDaHuy");

    if (activeTabDaHuy === "tap6") {
        const order = document.getElementById('order');

        order.querySelectorAll('.nav-tab li').forEach((el) => {
            el.classList.remove('active');
        });

        const targetTab = order.querySelector(`.nav-tab a[href="#tap6"]`);
        if (targetTab) {
            targetTab.closest('li').classList.add('active');
        }

        order.querySelectorAll('.an').forEach((el) => {
            el.style.display = "none";
        });

        order.querySelector('div#tap6').style.display = "";

        sessionStorage.removeItem("activeTabDaHuy");
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
                            window.scrollTo({ top: 0, behavior: 'smooth' });

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
                                case 5:
                                    document.querySelector('#order-details .maDH .thongBaoDonHang').innerHTML =
                                    "<span class='text-warning'>Đang chờ xử lý trả hàng</span>";
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
    let btnDaNhanHang = document.querySelectorAll('.btnDonMua .daNhanHang');
    if(btnDaNhanHang){
        btnDaNhanHang.forEach((el)=>{
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
                                        `<div class="row g-3 mt-1" data-idSp=${item.san_pham_id} style="display: block;">
                                            <div class="boder"></div>
                                            <div class="product">
                                                <div class="product-list">
                                                    <img src="/storage/${item.bien_the.hinh_anh}" alt="err">
                                                    <div class="product-details">
                                                        <p class="tenSanPham">${item.san_pham.ten_san_pham}</p>
                                                        <p class="phanLoaiHang">Phân loại hàng:
                                                            <span>${item.bien_the.kich_co}, ${item.bien_the.ten_mau}</span>.
                                                        </p>
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
                                            <div class="noi-dung">
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
                                            <button class="btn btn-info mb-3 guiDanhGia">Gửi Đánh Giá</button>
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
    let btnGuiDanhGia = document.querySelectorAll('#reviews .guiDanhGia');
    if(btnGuiDanhGia){
        btnGuiDanhGia.forEach((el, index)=>{
            el.addEventListener('click',function(){
                const sanPhamId = el.closest('.row').getAttribute('data-idSp');
                const soSao = el.closest('.row').querySelector('.star-rating').getAttribute('data-rating');
                const noiDung = el.closest('.row').querySelector('.noi-dung textarea').value;

                const inputFiles = el.closest('.row').querySelector('.img input[type="file"]').files;
                const formData = new FormData();

                Array.from(inputFiles).forEach(file => {
                    formData.append('images[]', file); // Thêm file vào formData
                });

                if (noiDung.length >= 50 && inputFiles.length > 0) {
                    namadXu = 200;
                }
                if (soSao > 0) {
                    const formData = new FormData();
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                    formData.append('san_pham_id', sanPhamId);
                    formData.append('noiDung', noiDung);
                    formData.append('soSao', soSao);
                    formData.append('namadXu', namadXu);

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

                                const thanhYouPopup = el.closest('.row');
                                thanhYouPopup.style.transition = 'opacity 0.5s ease-out';
                                setTimeout(() => {
                                    thanhYouPopup.style.display = 'none';
                                }, 400);

                                $('#reviews .main').prepend(`
                                    <div class="row g-3 mt-1">
                                        <div class="boder"></div>
                                        <div class="popup-content">
                                            <i class="fas fa-check-circle"></i>
                                            <h2>Cảm ơn bạn!</h2>
                                            <p>Đánh giá của bạn đã được ghi nhận.</p>
                                        </div>
                                    </div>
                                `);

                                setTimeout(() => {
                                    let soSanPham = document.querySelectorAll('#reviews .main .row');
                                    let hideModal = true;

                                    soSanPham.forEach((el) => {
                                        if (el.style.display === "block") {
                                            hideModal = false;
                                        }
                                    });

                                    if (hideModal) {
                                        $('#reviews').modal('hide');
                                    }
                                }, 1200);


                            }
                        },
                        error: function (error) {
                            console.error('Lỗi: ', error);
                            alert('Có lỗi xảy ra');
                        }
                    });
                }
                else{
                    const errRating = el.closest('.main').querySelector('.product .starRatingErr');
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
