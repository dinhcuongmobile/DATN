

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

const colorButtons = document.querySelectorAll('.mau_sac_btn');
const hiddenColorInput = document.getElementById('mau_sac_hidden');

colorButtons.forEach(button => {
    button.addEventListener('click', () => {
        hiddenColorInput.value = button.value; 
        colorButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
    });
});



