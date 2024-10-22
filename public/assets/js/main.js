
const selectMauSac=document.querySelectorAll('#selectMauSac li');
// Lặp qua từng phần tử để lắng nghe sự kiện click
selectMauSac.forEach(function(item) {
    item.addEventListener('click', function() {
        // Xóa class 'active' khỏi tất cả các phần tử khác
        selectMauSac.forEach(function(el) {
            el.classList.remove('activ');
        });
        // Thêm class 'active' cho phần tử được nhấn
        this.classList.add('activ');

    });
});

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
