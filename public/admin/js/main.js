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
                $('#style_quan_huyen').css('display', 'block');
                $('#quan_huyen').empty();
                $('#style_phuong_xa').css('display', 'block');
                $('#phuong_xa').empty();
                $('#style_dia_chi_chi_tiet').css('display', 'block');
                data.forEach(function (quanHuyen) {
                    $('#quan_huyen').append('<option value="' + quanHuyen.ma_quan_huyen + '">' + quanHuyen.ten_quan_huyen + '</option>');
                });
            }
        });
    }else{
        $('#style_quan_huyen').css('display', 'none');
        $('#quan_huyen').empty();
        $('#style_phuong_xa').css('display', 'none');
        $('#phuong_xa').empty();
        $('#style_dia_chi_chi_tiet').css('display', 'none');
    }
});

$('#quan_huyen').on('change', function () {
    var maqh = $(this).val();
    $.ajax({
        url: '/dia-chi/phuong-xa/' + maqh,
        type: 'GET',
        success: function (data) {
            data.forEach(function (phuongXa) {
                $('#phuong_xa').append('<option value="' + phuongXa.ma_phuong_xa + '">' + phuongXa.ten_phuong_xa + '</option>');
            });
        }
    });
});


