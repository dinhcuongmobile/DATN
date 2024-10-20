
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
