
// Tỉnh thành phố, quận huyện
$('select[name="tinh_thanh_pho"]').on('change', function () {
    var matp = $(this).val();
    if (matp !== "") {
        $.ajax({
            url: '/dia-chi/quan-huyen/' + matp,
            type: 'GET',
            success: function (data) {
                $('select[name="quan_huyen"]').html('<option value="">--Chọn quận huyện--</option>');
                data.forEach(function (quanHuyen) {
                    $('select[name="quan_huyen"]').append('<option value="' + quanHuyen.ma_quan_huyen + '">' + quanHuyen.ten_quan_huyen + '</option>');
                });
                $('select[name="phuong_xa"]').html('<option value="">--Chọn phường xã--</option>');
            }
        });
    } else {
        // Nếu bỏ chọn tỉnh, reset quận huyện và phường xã
        $('select[name="quan_huyen"]').html('<option value="">--Chọn quận huyện--</option>');
        $('select[name="phuong_xa"]').html('<option value="">--Chọn phường xã--</option>');
    }
});

$('select[name="quan_huyen"]').on('change', function () {
    var maqh = $(this).val();
    if (maqh !== "") {
        $.ajax({
            url: '/dia-chi/phuong-xa/' + maqh,
            type: 'GET',
            success: function (data) {
                $('select[name="phuong_xa"]').html('<option value="">--Chọn phường xã--</option>');
                data.forEach(function (phuongXa) {
                    $('select[name="phuong_xa"]').append('<option value="' + phuongXa.ma_phuong_xa + '">' + phuongXa.ten_phuong_xa + '</option>');
                });
            }
        });
    } else {
        // Nếu bỏ chọn quận huyện, reset phường xã
        $('select[name="phuong_xa"]').html('<option value="">--Chọn phường xã--</option>');
    }
});


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

// document.querySelectorAll('.quickViewClick').forEach((el) => {
//     el.addEventListener('click', function () {
//         $('#quick-view').modal('show');
//         let sanPhamID = el.getAttribute('data-id');

//         $.ajax({
//             type: 'GET',
//             url: '/home/quick-view/',
//             data: {
//                 san_pham_id: sanPhamID
//             },
//             success: function (response) {
//                 console.log(response.hinhAnh[0].hinh_anh);

//                 let sanPham = response.san_pham;
//                 // Cập nhật tên sản phẩm
//                 document.querySelector('.product-right h3').textContent = sanPham.ten_san_pham;

//                 // Cập nhật giá sản phẩm
//                 const giaBan = sanPham.gia_san_pham - (sanPham.gia_san_pham * sanPham.khuyen_mai/100);
//                 document.querySelector('.product-right h5').innerHTML = `${giaBan.toLocaleString('vi-VN')}đ <del>${sanPham.gia_san_pham.toLocaleString('vi-VN')}đ</del>`;

//                 // Cập nhật các slide ảnh
//                 const slide1Wrapper = document.querySelector('#quick-view .ratio_square-2');
//                 const slide2Wrapper = document.querySelector('#quick-view .ratio3_4');
//                 if(response.hinhAnh[0]){
//                     slide1Wrapper.querySelector('.anhLon1 img').src= `/storage/${response.hinhAnh[0].hinh_anh}`;
//                     slide2Wrapper.querySelector('.anhNho1 img').src= `/storage/${response.hinhAnh[0].hinh_anh}`;
//                 }

//                 if(response.hinhAnh[4]){
//                     slide1Wrapper.querySelector('.anhLon2 img').src= `/storage/${response.hinhAnh[4].hinh_anh}`;
//                     slide2Wrapper.querySelector('.anhNho2 img').src= `/storage/${response.hinhAnh[4].hinh_anh}`;
//                 }

//                 if(response.hinhAnh[8]){
//                     slide1Wrapper.querySelector('.anhLon3 img').src= `/storage/${response.hinhAnh[8].hinh_anh}`;
//                     slide2Wrapper.querySelector('.anhNho3 img').src= `/storage/${response.hinhAnh[8].hinh_anh}`;
//                 }

//                 if(response.hinhAnh[12]){
//                     slide1Wrapper.querySelector('.anhLon4 img').src= `/storage/${response.hinhAnh[12].hinh_anh}`;
//                     slide2Wrapper.querySelector('.anhNho4 img').src= `/storage/${response.hinhAnh[12].hinh_anh}`;
//                 }

//             },
//             error: function (error) {
//                 console.error('Lỗi: ', error);
//                 alert('Có lỗi xảy ra');
//             }
//         });
//     });
// });




