document.addEventListener('DOMContentLoaded',function(){
    activeDonHang();
});

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
