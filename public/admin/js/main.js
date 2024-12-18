document.addEventListener('DOMContentLoaded',()=>{
    formatCurrency();
    eyePassword();
    fetchNotifications();
    ckEditor();
    checkDonHangInterval();
    fetchDonHangStatus();
});

function eyePassword(){
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
//checkbox select
var checkboxs=document.querySelectorAll('input[type="checkbox"]');
function chontatca(){
    checkboxs.forEach(function(checkbox){
        checkbox.checked=true;
    })
}
function bochontatca(){
    checkboxs.forEach(function(checkbox){
        checkbox.checked=false;
    })
}


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

//bien the san pham
document.querySelectorAll('.kich_co_btn').forEach(button => {
    button.addEventListener('click', function() {
        document.querySelectorAll('.kich_co_btn').forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('kich_co_hidden').value = this.value;
    });
});

document.querySelectorAll('.mau_sac_btn').forEach(button => {
    button.addEventListener('click', function() {
        document.querySelectorAll('.mau_sac_btn').forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('ma_mau_hidden').value = this.dataset.color;
        document.getElementById('ten_mau_hidden').value = this.value;
    });
});

// check ma mau them mau sac
const maMauInput = document.getElementById('maMauInput');
const colorDiv = document.getElementById('colorDiv');
const hienThiMauSac= document.querySelector('.hienThiMauSac');
if(maMauInput && colorDiv){
    maMauInput.addEventListener('input', function() {
        const colorValue = maMauInput.value;
        // Kiểm tra xem mã màu có hợp lệ (mã hex với định dạng #FFFFFF) hay không
        const isValidHex = /^#[0-9A-Fa-f]{6}$/i.test(colorValue);
        if (isValidHex) {
            colorDiv.style.backgroundColor = colorValue;
            hienThiMauSac.style.display= 'block';
        } else {
            colorDiv.style.backgroundColor = ''; // Đặt lại nếu không hợp lệ
            hienThiMauSac.style.display= 'none';
        }
    });
}

function ckEditor(){
    var moTa= document.querySelector('#mo_ta');
    var noiDung= document.querySelector('#noi_dung');
    if(moTa){
        ClassicEditor.create(moTa).catch(error => {
            console.error(error);
        });
    }
    if(noiDung){
        ClassicEditor.create(noiDung).catch(error => {
            console.error(error);
        });
    }

}

let taoMaTuDong = document.querySelector('.taoMaTuDong');
if(taoMaTuDong){
    taoMaTuDong.addEventListener('click',function(){
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let code = '';
        for (let i = 0; i < 10; i++) {
            code += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        document.getElementById('maGiamGia').value = code;
    })
}

function formatCurrency() {
    const displayInput = document.getElementById('tienJSDisplay');
    const hiddenInput = document.getElementById('tienJSHidden');
    if (displayInput && hiddenInput) {
        // Xóa các dấu chấm hiện tại và chuyển thành số
        const rawValue = displayInput.value.replace(/\./g, '');

        // Cập nhật giá trị không có dấu chấm cho input ẩn
        hiddenInput.value = rawValue;

        // Định dạng lại giá trị hiển thị với dấu chấm
        displayInput.value = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

}

//ma khuyen mai
let elHours = document.getElementById('hours');
let elMinutes = document.getElementById('minutes');
let elSeconds = document.getElementById('seconds');
if(elHours && elMinutes && elSeconds){
    let hours = parseInt(elHours.textContent);
    let minutes = parseInt(elMinutes.textContent);
    let seconds = parseInt(elSeconds.textContent);

    function updateCountdown() {
        if (seconds > 0) {
            seconds--;
        } else {
            seconds = 59;
            if (minutes > 0) {
                minutes--;
            } else {
                minutes = 59;
                if (hours > 0) {
                    hours--;
                } else {
                    // Khi thời gian kết thúc
                    clearInterval(countdownInterval);
                    document.querySelector('.tdHSD').textContent = 'Đã hết hạn';
                    return;
                }
            }
        }

        // Cập nhật hiển thị
        document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
    }

    // Cập nhật mỗi giây
    let countdownInterval = setInterval(updateCountdown, 1000);
}

function fetchNotifications() {
    fetch("/admin/thong-bao-popup")
        .then(response => response.json())
        .then(data => {
            const notificationCounter = document.querySelector('#notificationCounter');
            const modalNotificationContent = document.querySelector('#modalNotificationContent');
            const notificationContent = document.querySelector('#notificationContent');
            // Cập nhật badge counter
            notificationCounter.textContent = data.count > 0 ? `${data.count}+` : "0";

            // Xóa nội dung cũ
            notificationContent.innerHTML = "";
            modalNotificationContent.innerHTML="";

            if (data.thongBao.length > 0) {
                data.thongBao.forEach(item => {
                    let image = item.hinh_anh ? `/storage/${item.hinh_anh}` : '/assets/images/other-img/thongBao.jpg';

                    let date = new Date(item.created_at);

                    let formattedDate = date.toLocaleString('en-US', {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true
                    }).replace(',', '');

                    let html = `
                        <a class="dropdown-item d-flex align-items-center" title="Xem chi tiết">
                            <div class="mr-3">
                                <img src="${image}" alt="err">
                            </div>
                            <div>
                                <div class="small text-gray-500">${formattedDate}</div>
                                <span class="font-weight-bold">${item.tieu_de}</span>
                                <p>${item.noi_dung}</p>
                            </div>
                        </a>
                    `;

                    notificationContent.insertAdjacentHTML('beforeend', html);
                });
            }

            if(data.allThongBao.length > 0){
                data.allThongBao.forEach(item => {
                    let image = item.hinh_anh ? `/storage/${item.hinh_anh}` : '/assets/images/other-img/thongBao.jpg';

                    let date = new Date(item.created_at);

                    let formattedDate = date.toLocaleString('en-US', {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true
                    }).replace(',', '');

                    let html = `
                        <a class="dropdown-item d-flex align-items-center" title="Xem chi tiết">
                            <div class="mr-3">
                                <img src="${image}" alt="err">
                            </div>
                            <div>
                                <div class="small text-gray-500">${formattedDate}</div>
                                <span class="font-weight-bold">${item.tieu_de}</span>
                                <p>${item.noi_dung}</p>
                            </div>
                        </a>
                    `;

                    modalNotificationContent.insertAdjacentHTML('beforeend', html);
                });
            }
        })
        .catch(error => console.error("Error fetching notifications:", error));
}
setInterval(fetchNotifications, 15000);

//don hang

function checkDonHangInterval(){
    let donHangInterval = null;
    if (window.location.pathname === '/admin/don-hang/danh-sach-don-hang' ||
        window.location.pathname === '/admin/don-hang/danh-sach-kiem-duyet' ||
        window.location.pathname === '/admin/don-hang/danh-sach-cho-lay-hang' ||
        window.location.pathname === '/admin/don-hang/danh-sach-dang-giao' ||
        window.location.pathname === '/admin/don-hang/danh-sach-da-giao' ||
        window.location.pathname === '/admin/don-hang/danh-sach-da-huy') {

        donHangInterval = setInterval(() => fetchDonHangStatus(), 5000);
    }else{
        if(donHangInterval){
            clearInterval(donHangInterval);
        }
    }
}

function fetchDonHangStatus() {
    fetch("/admin/don-hang/check-trang-thai-don-hang")
        .then(response => response.json())
        .then(data => {

            let DSDonHangContent = document.querySelector(".DSDonHangContent");
            let DSDangGiaoContent = document.querySelector(".DSDangGiaoContent");
            let DSDaHuyContent = document.querySelector(".DSDaHuyContent");
            let DSDaGiaoContent = document.querySelector(".DSDaGiaoContent");
            let DSChoLayHangContent = document.querySelector(".DSChoLayHangContent");
            let DSKiemDuyetContent = document.querySelector(".DSKiemDuyetContent");

            if(DSDonHangContent){
                DSDonHangContent.innerHTML="";
                data.donHang.trang_thai_all.forEach(item=>{
                    DSDonHangContent.insertAdjacentHTML('beforeend', renderDonHang(item));
                });
            }

            if(DSKiemDuyetContent){
                DSKiemDuyetContent.innerHTML="";
                data.donHang.trang_thai_0.forEach(item=>{
                    DSKiemDuyetContent.insertAdjacentHTML('beforeend', renderDonHang(item));
                });
            }

            if(DSChoLayHangContent){
                DSChoLayHangContent.innerHTML="";
                data.donHang.trang_thai_1.forEach(item=>{
                    DSChoLayHangContent.insertAdjacentHTML('beforeend', renderDonHang(item));
                });
            }

            if(DSDangGiaoContent){
                DSDangGiaoContent.innerHTML="";
                data.donHang.trang_thai_2.forEach(item=>{
                    DSDangGiaoContent.insertAdjacentHTML('beforeend', renderDonHang(item));
                });
            }

            if(DSDaGiaoContent){
                DSDaGiaoContent.innerHTML="";
                data.donHang.trang_thai_3.forEach(item=>{
                    DSDaGiaoContent.insertAdjacentHTML('beforeend', renderDonHang(item));
                });
            }

            if(DSDaHuyContent){
                DSDaHuyContent.innerHTML="";
                data.donHang.trang_thai_4.forEach(item=>{
                    DSDaHuyContent.insertAdjacentHTML('beforeend', renderDonHang(item));
                });
            }

        })
        .catch(error => console.error('Error:', error));
}


function renderDonHang(item){
    let trangThaiText = "";
    let btnTrangThai = "";
    let btnInHoaDon = "";

    if(item.trang_thai==0) {
        let btnInHoaDon = "";
        trangThaiText="Chờ Xác Nhận";
        btnTrangThai=`<a href="/admin/don-hang/duyet-don-hang/${item.id}" class="btn btn-primary btn-sm">
                            Duyệt
                    </a>
                    <a href="/admin/don-hang/huy-don-hang/${item.id}" class="btn btn-danger btn-sm"
                            onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                        Hủy
                    </a><hr>`;
    }
    else if(item.trang_thai==1) {
        btnInHoaDon = `<a href="/admin/don-hang/in-hoa-don/${item.id}" class="btn btn-success btn-sm float-right" target="_blank">
                        Xuất Hóa Đơn
                      </a>`;
        trangThaiText="Chờ Giao Hàng";
        btnTrangThai = `<a href="/admin/don-hang/yeu-cau-lay-hang/${item.id}" class="btn btn-primary btn-sm">
                            Yêu cầu đến lấy hàng
                        </a><hr>`;
    }
    else if(item.trang_thai==2) {
        let btnInHoaDon = "";
        trangThaiText="Đang Giao";
        btnTrangThai="";
    }
    else if(item.trang_thai==3) {
        let btnInHoaDon = "";
        trangThaiText="Đã Giao";
        btnTrangThai="";
    }
    else if(item.trang_thai==4) {
        let btnInHoaDon = "";
        trangThaiText="Đã Hủy";
        btnTrangThai="";
    }

    return `<div class="card shadow mb-4 DSDonHang">
                <div class="card-header py-3">
                    <!-- Tên khách hàng và mã đơn hàng -->
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <strong>Tên khách hàng: ${item.user.ho_va_ten?item.user.ho_va_ten : item.dia_chi.ho_va_ten_nhan}</strong>
                        </div>
                        <div>
                            <strong>Mã đơn hàng: ${item.ma_don_hang}</strong>
                        </div>
                    </div>
                    ${btnInHoaDon}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Tổng cộng</th>
                                    <th>Trạng thái</th>
                                    <th>Thanh Toán</th>
                                    <th>Đơn vị vận chuyển</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-4">
                                        ${renderChiDonHang(item.chi_tiet_don_hangs)}
                                    </td>
                                    <td>${(item.tong_thanh_toan).toLocaleString('vi-VN')}đ</td>
                                    <td>
                                        <p class="trangThai">
                                            <span style="color:#2ecc71; background-color: #f0f0f0; padding: 5px; border-radius: 9px;">
                                                ${trangThaiText}
                                            </span>
                                        </p>
                                    </td>
                                    <td class="col-2">
                                    ${item.phuong_thuc_thanh_toan == 1
                                        ? `<a href="/admin/don-hang/danh-sach-da-chuyen-khoan/${item.ma_don_hang}" style="color: #007bff;">
                                                Chuyển khoản
                                            </a>`
                                        : "Thanh toán khi nhận hàng"}
                                    </td>
                                    <td class="col-1">
                                        <img src="/assets/images/logos/logo_ghtk.png" width="85px" alt="">
                                    </td>
                                    <td class="btnDonHang">
                                        ${btnTrangThai}
                                        <a href="/admin/don-hang/chi-tiet-don-hang/${item.id}" class="btn btn-secondary btn-sm">
                                            Xem Chi Tiết
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>`;
}

function renderChiDonHang(chiTietDonHang) {
    let html = '';
    chiTietDonHang.forEach(item => {

        html += `
            <img src="/storage/${item.bien_the.hinh_anh}" alt="product" width="15%">
                ${item.san_pham.ten_san_pham}
            <span class="badge badge-secondary">x${item.so_luong}</span>
            <br>
            <small>Loại: ${item.bien_the.kich_co},
                ${item.bien_the.ten_mau}</small>
            <br>`;
    });
    return html;
}






