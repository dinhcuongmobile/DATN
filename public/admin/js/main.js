

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


//location
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
            }
        });
    }
});

$('#quan_huyen').on('change', function () {
    var maqh = $(this).val();
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
