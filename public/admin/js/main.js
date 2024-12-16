document.addEventListener('DOMContentLoaded',()=>{
    eyePassword();
    allThongBao();
    fetchNotifications();
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

//ck editor
document.addEventListener('DOMContentLoaded',() => {
    ckEditor();
});
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

document.addEventListener('DOMContentLoaded',()=>{
    formatCurrency();
});

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
    fetch("/admin/thong-bao")
        .then(response => response.json())
        .then(data => {
            const notificationCounter = document.querySelector('#notificationCounter');
            const notificationContent = document.querySelector('#notificationContent');
            // Cập nhật badge counter
            notificationCounter.textContent = data.count > 0 ? `${data.count}+` : "0";

            // Xóa nội dung cũ
            notificationContent.innerHTML = "";

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
                        <a class="dropdown-item d-flex align-items-center">
                            <div class="mr-3">
                                <img src="${image}" alt="err">
                            </div>
                            <div>
                                <div class="small text-gray-500">${formattedDate}</div>
                                <span class="font-weight-bold">${item.noi_dung}</span>
                            </div>
                        </a>
                    `;

                    notificationContent.insertAdjacentHTML('beforeend', html);
                });
            }
        })
        .catch(error => console.error("Error fetching notifications:", error));
}
setInterval(fetchNotifications, 5000);

function allThongBao(){

}




