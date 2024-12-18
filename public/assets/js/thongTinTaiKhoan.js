document.addEventListener('DOMContentLoaded',function(){
    document.documentElement.scrollTop = 0;
    document.body.scrollTop = 0;
    tabThongBao();
    tabDonMua();
    activeDonHang();
    chiTietDonMua();
    fetchDonHangStatus();
    setIntervalOrder();
});

function setIntervalOrder(){
    let orderInterval = null;

    const activeTabCheck = document.querySelectorAll("#v-pills-tab .nav-link");
    activeTabCheck.forEach((el)=>{

        if(el.getAttribute("aria-controls")==="order" && el.getAttribute("aria-selected")==="true"){
            orderInterval = setInterval(() => fetchDonHangStatus(), 3000);
        }

        el.addEventListener('click',function(){
            if(el.getAttribute("aria-controls")==="order"){
                console.log("da set inter");
                orderInterval = setInterval(() => fetchDonHangStatus(), 3000);
            }else{
                if (orderInterval) {
                    console.log("da bo set inter");
                    clearInterval(orderInterval);
                }
            }

        });
    });
}

//thong bao
function tabThongBao(){
    const notificationsTab = document.querySelector('#notifications-tab');
    if(notificationsTab){
        notificationsTab.addEventListener('click',function(){

            $.ajax({
                type: 'GET',
                url: '/tai-khoan/thong-bao/',
                success: function (response) {
                    if(response.success){
                        const notifications = document.querySelector('#notifications');
                        const notificationBody = notifications.querySelector('.notification-body');
                        notificationBody.innerHTML="";

                        response.thong_baos.data.forEach((item)=>{

                            let date = new Date(item.created_at);

                            let formattedDate = date.toLocaleString('en-US', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit',
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            }).replace(',', '');

                            let image = item.hinh_anh ? `/storage/${item.hinh_anh}` : '/assets/images/other-img/thongBao.jpg';

                            let itemHtml = `
                                        <li>
                                            <div class="user-img">
                                                <img src="${image}" alt="err"></div>
                                            <div class="user-contant">
                                                <h6>Namad Store - ${item.tieu_de}
                                                    <span>${formattedDate}</span>
                                                </h6>
                                                <p>${item.noi_dung}</p>
                                            </div>
                                        </li>
                                    `;
                            notificationBody.insertAdjacentHTML('beforeend', itemHtml);
                        })

                        if(response.thong_baos.data.length>0){
                            let paginateHtml = `
                                <div class="pagination-wrap">
                                    <ul class="pagination">
                                    </ul>
                                </div>
                            `;
                            notifications.insertAdjacentHTML('beforeend', paginateHtml);
                            updatePagination(response.thong_baos);
                            paginationEvent();
                        }

                    }
                },
                error: function (error) {
                    console.error('Lỗi: ', error);
                    alert('Có lỗi xảy ra');
                }
            });
        });
    }
}

function updatePagination(paginationData) {
    const paginationWrap = document.querySelector('#notifications .pagination-wrap');
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

    $.ajax({
        url: `/tai-khoan/thong-bao?page=${page}`,
        method: 'GET',
        success: function (response) {
            if (response.success) {
                const notifications = document.querySelector('#notifications');
                const notificationBody = notifications.querySelector('.notification-body');
                const paginationWrap = notifications.querySelector('.pagination-wrap');

                notificationBody.innerHTML="";

                response.thong_baos.data.forEach((item)=>{

                    let date = new Date(item.created_at);

                    let formattedDate = date.toLocaleString('en-US', {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true
                    }).replace(',', '');

                    let image = item.hinh_anh ? `/storage/${item.hinh_anh}` : '/assets/images/other-img/thongBao.jpg';

                    let itemHtml = `
                                <li>
                                    <div class="user-img">
                                        <img src="${image}" alt="err"></div>
                                    <div class="user-contant">
                                        <h6>Namad Store - ${item.tieu_de}
                                            <span>${formattedDate}</span>
                                        </h6>
                                        <p>${item.noi_dung}</p>
                                    </div>
                                </li>
                            `;
                    notificationBody.insertAdjacentHTML('beforeend', itemHtml);
                })

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
    const a = document.querySelectorAll('#notifications .pagination-wrap a');
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

                            document.querySelector("#order-details").setAttribute('data-iddonhang',donHang.id);
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
                                    `<a class="product-list-a" href="/san-pham/chi-tiet-san-pham/${item.san_pham_id}">
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
                            const actionButtons = document.querySelector('#order-details .action-button');

                            actionButtons.innerHTML="";
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
                                    actionButtons.innerHTML=
                                    `<button class="btn btn-outline-danger huyDonHangChiTiet">Hủy đơn hàng</button>
                                    <a href="/lien-he/" class="btn btn-outline-secondary">Liên Hệ Shop</a>`;

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
                                    actionButtons.innerHTML=`<a href="/lien-he/" class="btn btn-outline-secondary">Liên Hệ Shop</a>`;
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
                                    actionButtons.innerHTML=
                                    `<button class="btn btn-success daNhanHangChiTiet">Đã nhận hàng</button>
                                    <button class="btn btn-primary muaLaiChiTiet">Mua lại</button>
                                    <a href="/lien-he/" class="btn btn-outline-secondary">Liên Hệ Shop</a>`;
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

                                    let btnDanhGiaChiTiet = "";
                                    if (response.chuaDanhGia.length > 0) {
                                        btnDanhGiaChiTiet = `<button class="btn btn-warning danhGiaChiTiet">Đánh giá</button>`;
                                    }
                                    actionButtons.innerHTML=
                                    `${btnDanhGiaChiTiet}
                                      <button class="btn btn-primary muaLaiChiTiet">Mua lại</button>
                                    <a href="/lien-he/" class="btn btn-outline-secondary">Liên Hệ Shop</a>`;
                                break;
                                case 4:
                                    document.querySelector('#order-details .maDH .thongBaoDonHang').innerHTML =
                                    "<span class='text-danger'>Đã hủy</span>";
                                    timeline.style.display="none";
                                    deliveryStatus.innerHTML=`
                                        <p class="active">
                                            <i class="fa-solid fa-circle"></i>
                                            <span>Đơn hàng đã được hủy vào lúc: ${donHang.ngay_cap_nhat}</span>
                                        </p>
                                    `;
                                break;
                            }

                            //show
                            donHangContent.classList.remove('active','show');
                            chiTietDonHangContent.classList.add('active','show');

                            huyDonHangChiTiet(donHang.id);
                            daNhanHangChiTiet(donHang.id);
                            muaLaiChiTiet(donHang.id);
                            danhGiaChiTiet(donHang.id);
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
                            fetchDonHangStatus();
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

function huyDonHangChiTiet(id){
    let huyDonHangChiTiet = document.querySelector('#order-details .action-button .huyDonHangChiTiet');

    if(huyDonHangChiTiet){
        huyDonHangChiTiet.addEventListener('click',function(){

            $.ajax({
                type: 'POST',
                url: '/don-hang/huy-don-hang/',
                data: {
                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    don_hang_id: id
                },
                success: function (response) {
                    if(response.success){
                        fetchDonHangStatus();
                    }
                },
                error: function (error) {
                    console.error('Lỗi: ', error);
                    alert('Có lỗi xảy ra');
                }
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

function danhGiaChiTiet(id){
    let danhGiaChiTiet = document.querySelector('#order-details .action-button .danhGiaChiTiet');

    if(danhGiaChiTiet){
        danhGiaChiTiet.addEventListener('click',function(){

            $.ajax({
                type: 'GET',
                url: '/don-hang/show-modal-danh-gia/',
                data: {
                    don_hang_id: id
                },
                success: function (response) {
                    if(response.success){
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
                                        fetchDonHangStatus();
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

function daNhanHang(){
    const btnDaNhan = document.querySelectorAll('.btnDonMua .daNhanHang');
    if(btnDaNhan){
        btnDaNhan.forEach((el)=>{
            el.addEventListener('click',function(){
                let donHangId = el.closest('.card').getAttribute('data-donHangId');

                $.ajax({
                    type: 'POST',
                    url: '/don-hang/da-nhan-hang/',
                    data: {
                        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        don_hang_id: donHangId
                    },
                    success: function (response) {
                        if(response.success){
                            fetchDonHangStatus();
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

function daNhanHangChiTiet(id){
    let daNhanHangChiTiet = document.querySelector('#order-details .action-button .daNhanHangChiTiet');

    if(daNhanHangChiTiet){
        daNhanHangChiTiet.addEventListener('click',function(){

            $.ajax({
                type: 'POST',
                url: '/don-hang/da-nhan-hang/',
                data: {
                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    don_hang_id: id
                },
                success: function (response) {
                    if(response.success){
                        fetchDonHangStatus();
                    }
                },
                error: function (error) {
                    console.error('Lỗi: ', error);
                    alert('Có lỗi xảy ra');
                }
            });

        });
    }
}

function muaLai(){
    const btnMuaLai = document.querySelectorAll('.btnDonMua .muaLai');
    if(btnMuaLai){
        btnMuaLai.forEach((el)=>{
            el.addEventListener('click',function(){
                let donHangId = el.closest('.card').getAttribute('data-donHangId');

                $.ajax({
                    type: 'POST',
                    url: '/don-hang/mua-lai/',
                    data: {
                        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        don_hang_id: donHangId
                    },
                    success: function (response) {
                        if(response.success){
                            window.location.href="/gio-hang/";
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

function muaLaiChiTiet(id){
    let muaLaiChiTiet = document.querySelector('#order-details .action-button .muaLaiChiTiet');

    if(muaLaiChiTiet){
        muaLaiChiTiet.addEventListener('click',function(){

            $.ajax({
                type: 'POST',
                url: '/don-hang/mua-lai/',
                data: {
                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    don_hang_id: id
                },
                success: function (response) {
                    if(response.success){
                        window.location.href="/gio-hang/";
                    }
                },
                error: function (error) {
                    console.error('Lỗi: ', error);
                    alert('Có lỗi xảy ra');
                }
            });

        });
    }
}

function fetchDonHangStatus() {

    fetch("/don-hang/check-trang-thai-don-hang")
        .then(response => response.json())
        .then(data => {

            //tap1
            let tap1 = document.querySelector("div#tap1");
            let tap2 = document.querySelector("div#tap2");
            let tap3 = document.querySelector("div#tap3");
            let tap4 = document.querySelector("div#tap4");
            let tap5 = document.querySelector("div#tap5");
            let tap6 = document.querySelector("div#tap6");

            tap1.innerHTML="";
            tap2.innerHTML="";
            tap3.innerHTML="";
            tap4.innerHTML="";
            tap5.innerHTML="";
            tap6.innerHTML="";

            data.donHang.trang_thai_all.forEach(item => {
                tap1.insertAdjacentHTML('beforeend', renderDonHang(item));
                renderChiTietDonHang(item);
            });

            data.donHang.trang_thai_0.forEach(item => {
                tap2.insertAdjacentHTML('beforeend', renderDonHang(item));
                renderChiTietDonHang(item);
            });
            data.donHang.trang_thai_1.forEach(item => {
                tap3.insertAdjacentHTML('beforeend', renderDonHang(item));
                renderChiTietDonHang(item);
            });
            data.donHang.trang_thai_2.forEach(item => {
                tap4.insertAdjacentHTML('beforeend', renderDonHang(item));
                renderChiTietDonHang(item);
            });
            data.donHang.trang_thai_3.forEach(item => {
                tap5.insertAdjacentHTML('beforeend', renderDonHang(item));
                renderChiTietDonHang(item);
            });
            data.donHang.trang_thai_4.forEach(item => {
                tap6.insertAdjacentHTML('beforeend', renderDonHang(item));
                renderChiTietDonHang(item);
            });

            muaLai();
            daNhanHang();
            reviews();
            huyDonHang();
            chiTietDonMua();


        })
        .catch(error => console.error('Error:', error));
}

function renderChiTietDonHang(item){
    let orderDetails = document.querySelector("#order-details");
    let dataIdDonHang = orderDetails.getAttribute('data-iddonhang');
    if(dataIdDonHang && dataIdDonHang == item.id){
        const timeline = orderDetails.querySelector('.timeline');
        const deliveryStatus = orderDetails.querySelector('.delivery-status .trang-thai');
        const actionButtons = orderDetails.querySelector('.action-button');

        actionButtons.innerHTML="";
        timeline.querySelectorAll('i').forEach((el)=>{
            el.classList.remove('change','next-change');
        });
        deliveryStatus.querySelectorAll('p').forEach((el)=>{
            el.classList.remove('active');
        });

        switch (item.trang_thai) {
            case 0:
                //thong bao
                document.querySelector('#order-details .maDH .thongBaoDonHang').innerHTML =
                "<span class='text-warning'>Chờ xác nhận</span>";

                //trang thai theo doi
                timeline.querySelector('.zezo i').classList.add('change');
                timeline.querySelector('.one i').classList.add('next-change');
                deliveryStatus.innerHTML=`<p class="active"><i class="fa-solid fa-circle"></i><span>Đặt hàng thành công</span></p>`;
                actionButtons.innerHTML=
                `<button class="btn btn-outline-danger huyDonHangChiTiet">Hủy đơn hàng</button>
                <a href="/lien-he/" class="btn btn-outline-secondary">Liên Hệ Shop</a>`;

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
                actionButtons.innerHTML=`<a href="/lien-he/" class="btn btn-outline-secondary">Liên Hệ Shop</a>`;
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
                actionButtons.innerHTML=
                `<button class="btn btn-success daNhanHangChiTiet">Đã nhận hàng</button>
                <button class="btn btn-primary muaLaiChiTiet">Mua lại</button>
                <a href="/lien-he/" class="btn btn-outline-secondary">Liên Hệ Shop</a>`;
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
                    <p class="active"><i class="fa-solid fa-circle"></i><span>Đơn hàng đã được giao thành công tới ${item.dia_chi.ho_va_ten_nhan}</span></p>
                    <p><i class="fa-solid fa-circle"></i><span>Đơn hàng đang được vận chuyển</span></p>
                    <p><i class="fa-solid fa-circle"></i><span>Đơn hàng đang được chuẩn bị</span></p>
                    <p><i class="fa-solid fa-circle"></i><span>Đặt hàng thành công</span></p>
                `;

                let btnDanhGiaChiTiet = '';
                if (item.trang_thai === 3 && item.so_luong_da_danh_gia < item.chi_tiet_don_hangs.length) {
                    btnDanhGiaChiTiet = `<button class="btn btn-warning danhGiaChiTiet">Đánh giá</button>`;
                }
                actionButtons.innerHTML=
                `${btnDanhGiaChiTiet}
                    <button class="btn btn-primary muaLaiChiTiet">Mua lại</button>
                <a href="/lien-he/" class="btn btn-outline-secondary">Liên Hệ Shop</a>`;
            break;
            case 4:
                document.querySelector('#order-details .maDH .thongBaoDonHang').innerHTML =
                "<span class='text-danger'>Đã hủy</span>";
                timeline.style.display="none";
                deliveryStatus.innerHTML=`
                    <p class="active">
                        <i class="fa-solid fa-circle"></i>
                        <span>Đơn hàng đã được hủy vào lúc: ${item.ngay_cap_nhat}</span>
                    </p>
                `;
            break;
        }

        huyDonHangChiTiet(item.id);
        daNhanHangChiTiet(item.id);
        danhGiaChiTiet(item.id);
        muaLaiChiTiet(item.id);
    }
}
function renderDonHang(item){
    let danhGiaButton = '';

    if (item.trang_thai === 3 && item.so_luong_da_danh_gia < item.chi_tiet_don_hangs.length) {
        danhGiaButton = `<button class="btn btn-warning btnDanhGia">Đánh giá</button>`;
    }

    return `<div class="card shadow-0 border mb-4" style="border-radius: 10px;" data-donHangId="${item.id}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-table-container tableDonMua">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                ${item.user.vai_tro_id == 3
                                                    ? `<span class="chatLS" onclick="toggleChat(${item.user.id})">💬 Chat</span>`
                                                    : ""}
                                                <a href="/san-pham/" class="shopLS">
                                                    <i class="fas fa-box"></i> Xem cửa hàng
                                                </a>
                                            </td>
                                            <td colspan="2" class="thongBaoLS"
                                                style="text-align: right">
                                                <span class="thongBao">
                                                    ${getTrangThaiHTML(item.trang_thai)}
                                                </span> |
                                                ${getThanhToanHTML(item.thanh_toan)}
                                            </td>
                                        </tr>
                                        ${renderChiTietSanPham(item.chi_tiet_don_hangs)}
                                    </tbody>
                                </table>
                                <p class="thanhTien">Thành tiền:
                                    <span>${(item.tong_thanh_toan).toLocaleString('vi-VN')}đ</span>
                                </p>
                                <div class="btnDonMua">
                                    ${danhGiaButton}
                                    ${getBtnHTML(item.trang_thai)}
                                    <a href="/lien-he/"
                                        class="btn btn-outline-secondary">Liên hệ Shop</a>
                                </div>
                            </div><!-- End .cart-table-container -->
                        </div><!-- End .col-lg-8 -->
                    </div>
                </div>
            </div>`;
}
function getTrangThaiHTML(trangThai) {
    switch (trangThai) {
        case 0: return '<span class="text-warning">Chờ xác nhận</span>';
        case 1: return '<span>Đang chuẩn bị hàng</span>';
        case 2: return '<i class="fas fa-truck icon"></i> <span>Đang giao</span>';
        case 3: return '<span>Đã giao</span>';
        case 4: return '<span class="text-danger">Đã hủy</span>';
        default: return '';
    }
}
function getThanhToanHTML(thanhToan) {
    return thanhToan == 0
        ? '<span class="choThanhToan" style="color:red">Chưa thanh toán</span>'
        : '<span class="choThanhToan" style="color:#26aa99">Đã thanh toán</span>';
}
function getBtnHTML(trangThai){
    switch (trangThai) {
        case 0: return '<button style="margin-right:15px;" class="btn btn-outline-danger huyDonHang">Hủy đơn hàng</button>';
        case 2: return '<button class="btn btn-success daNhanHang">Đã nhận hàng</button> <button class="btn btn-primary muaLai">Mua lại</button>';
        case 3: return '<button class="btn btn-primary muaLai">Mua lại</button>';
        case 4: return '<button class="btn btn-primary muaLai">Mua lại</button>';
        default: return '';
    }
}
function renderChiTietSanPham(chiTietDonHang) {
    let html = '';
    chiTietDonHang.forEach(item => {

        html += `
            <tr class="product-row" title="Xem chi tiết">
                <td class="img">
                    <img src="/storage/${item.bien_the.hinh_anh}" alt="${item.san_pham.ten_san_pham}">
                </td>
                <td class="col-9 tenSanPham">
                    <a>${item.san_pham.ten_san_pham}</a>
                    <p>Phân loại hàng:
                        <span
                            class="phanLoaiHang">${item.bien_the.kich_co},
                            ${item.bien_the.ten_mau}</span>.
                    </p>
                    <p style="color: #000">
                        x${item.so_luong}</p>
                </td>
                <td class="col-3 giaTienLS"
                    style="text-align: right">
                    <span>${(item.thanh_tien).toLocaleString('vi-VN')}đ</span>
                    <span><del>${(item.san_pham.gia_san_pham*item.so_luong).toLocaleString('vi-VN')}đ</del></span>
                </td>
            </tr>`;
    });
    return html;
}
