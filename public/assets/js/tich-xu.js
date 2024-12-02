document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('.top_header #tich-xu')?.addEventListener('click',function(){
        $('#daily-coin').modal('show');
        const idUser = document.querySelector('#daily-coin').getAttribute('data-id');
        const soNgayKey = `soNgay_${idUser}`;
        const ngayCuoiKey = `ngayCuoi_${idUser}`;

        const dailyCoinButton = document.getElementById("dailyCoinButton");

        // Lấy trạng thái từ localStorage và cập nhật giao diện
        const soNgay = JSON.parse(localStorage.getItem(soNgayKey)) || 0;
        const ngayCuoi = localStorage.getItem(ngayCuoiKey) || '';

        // Kiểm tra xem có phải là ngày mới không
        const homNay = new Date().toLocaleDateString('en-CA').split('T')[0]; // Lấy ngày hiện tại
        const homQua = new Date(new Date() - 86400000).toISOString().split('T')[0]; // Lấy ngày hôm qua

        if (ngayCuoi !== homNay) {
            // Nếu không phải là ngày hôm nay
            if (soNgay === 7) {
                // Nếu chuỗi ngày đã nhận là 7, reset lại
                localStorage.setItem(soNgayKey, 0);
            } else {
                if (ngayCuoi !== homQua) {
                    localStorage.setItem(soNgayKey, 0);
                } else {
                    // Cập nhật ngày nhận mới
                    localStorage.setItem(ngayCuoiKey, homNay);
                }

                localStorage.setItem(ngayCuoiKey, homNay);
            }

            updateDayBoxes(soNgay); // Cập nhật giao diện
        }

        fetch('/coin/tong-xu')
            .then(response => response.json())
            .then(data => {
                // Cập nhật số xu trên giao diện
                document.getElementById('userCoin').innerHTML = `
                    <img src="/assets/images/coin.png" alt="lỗi" style="width: 40px; height: 40px;"> ${data.tong_xu}`;
            })

        updateDayBoxes(soNgay);


        // Xử lý xác nhận
        dailyCoinButton.addEventListener("click", function() {
            fetch('/coin/nhan-xu', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('#daily-coin input[name="_token"]').value,
                    'Content-Type': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('coinMessage').innerText = data.message;

                if (data.so_ngay) {
                    // Cập nhật giao diện theo số ngày đã nhận
                    localStorage.setItem(soNgayKey, data.so_ngay); // Lưu số ngày đã nhận vào localStorage
                    updateDayBoxes(data.so_ngay);

                    // Cập nhật hiển thị tổng xu
                    fetch('/coin/tong-xu')
                        .then(response => response.json())
                        .then(dataCoin => {
                            // Cập nhật số xu trên giao diện
                            document.getElementById('userCoin').innerHTML = `
                                <img src="/assets/images/coin.png" alt="lỗi" style="width: 40px; height: 40px;"> ${dataCoin.tong_xu}`;
                            let divTongCoin = document.querySelector('.divTongCoin');
                            if(divTongCoin)  divTongCoin.style.display="flex";
                            if(window.location.pathname === '/tai-khoan/thong-tin-tai-khoan'){
                                document.querySelector('#dashboard .tongCoin').innerText = dataCoin.tong_xu;
                            }
                            if(window.location.pathname === '/gio-hang/chi-tiet-thanh-toan'){
                                let tongThanhToan = parseInt(document.querySelector('.tongThanhToan').textContent.replace(/[^\d]/g, ""));
                                document.querySelector('.right-sidebar-checkout .tongCoin').innerText = dataCoin.tong_xu;
                                const namadXuActive = document.querySelector('.divTongCoin div.active');
                                let namadXu=0;
                                if(namadXuActive){
                                    namadXu = parseInt(document.querySelector('.divTongCoin .tongCoin').textContent);
                                    tongThanhToan = tongThanhToan + namadXu - 100;
                                }


                                document.querySelector('.tongThanhToan').textContent = `${(tongThanhToan - namadXu).toLocaleString('vi-VN')}đ`;
                            }
                        })
                }
            })
        });
        function updateDayBoxes(soNgay) {
            for (let i = 1; i <= 7; i++) {
                const dayBox = document.getElementById(`day-${i}`);
                if (i <= soNgay) {
                    dayBox.classList.add('received');
                    dayBox.querySelector('.check-icon').style.display = 'block'; // Hiện biểu tượng tích
                } else {
                    dayBox.classList.remove('received');
                    dayBox.querySelector('.check-icon').style.display = 'none'; // Ẩn biểu tượng tích
                }
            }

            // Xóa lớp 'today' khỏi tất cả các ô ngày trước khi thêm vào ngày hiện tại
            for (let i = 1; i <= 7; i++) {
                const dayBox = document.getElementById(`day-${i}`);
                dayBox.classList.remove('today');
            }

            // Gán lớp 'today' cho ô ngày hiện tại trong chuỗi điểm danh
            const todayBox = document.getElementById(`day-${soNgay}`);
            if (todayBox) {
                todayBox.classList.add('today');
            }
        }
    });

});
