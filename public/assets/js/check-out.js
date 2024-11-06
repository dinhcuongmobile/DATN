document.querySelector('.cart-listing #chon-voucher').addEventListener('click',function(){
    $('#popup-voucher').modal('show');
});

document.querySelector('#popup-voucher .card-footer .btnQuayLai').addEventListener('click',function(){
    $('#popup-voucher').modal('hide');
});

document.querySelectorAll(".address-option #address-billing-0").forEach(function(el){
    el.addEventListener('click',function(){
        let maQuanHuyen = el.getAttribute('data-maQuanHuyen');

        $.ajax({
            type: 'GET',
            url: '/gio-hang/tinh-phi-ship-dia-chi',
            data: {
                ma_quan_huyen: maQuanHuyen,
            },
            success: function(response) {
                document.querySelector('#tienPhiShip').textContent = `${response.phi_ships.phi_ship.toLocaleString('vi-VN')}đ`;

            },
            error: function(error) {
                console.log(error);
                alert("Có lỗi xảy ra khi gửi yêu cầu.");
            }
        });


    });
})
