// Lọc sản phẩm theo giá
const onInput = (parent, e) => {
    const slides = parent.querySelectorAll("input");
    const min = parseFloat(slides[0].min);
    const max = parseFloat(slides[1].max);

    let slide1 = parseFloat(slides[0].value);
    let slide2 = parseFloat(slides[1].value);

    const percentageMin = (slide1 / (max - min)) * 100;
    const percentageMax = (slide2 / (max - min)) * 100;

    parent.style.setProperty("--range-slider-value-low", percentageMin);
    parent.style.setProperty("--range-slider-value-high", percentageMax);

    if (slide1 > slide2) {
        const tmp = slide2;
        slide2 = slide1;
        slide1 = tmp;

        if (e?.currentTarget === slides[0]) {
            slides[0].insertAdjacentElement("beforebegin", slides[1]);
        } else {
            slides[1].insertAdjacentElement("afterend", slides[0]);
        }
    }

    // Cập nhật giá trị hiển thị
    const displayElement = parent.querySelector(".range-slider-display");
    if (displayElement) {
        const formattedSlide1 = slide1.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        const formattedSlide2 = slide2.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        
        displayElement.setAttribute("data-low", formattedSlide1);
        displayElement.setAttribute("data-high", formattedSlide2);
    }

    // Cập nhật lại giá trị minPrice và maxPrice
    minPrice = slide1;
    maxPrice = slide2;
};

addEventListener("DOMContentLoaded", (event) => {
    document.querySelectorAll(".range-slider").forEach((range) => {
        range.querySelectorAll("input").forEach((input) => {
            if (input.type === "range") {
                input.oninput = (e) => onInput(range, e);
                onInput(range); // Gọi hàm để hiển thị giá trị ban đầu
            }
        });
    });

    // Lấy giá trị từ server nếu có
    const minPriceInput = document.getElementById('minPrice');
    const maxPriceInput = document.getElementById('maxPrice');
    
    if (minPriceInput && maxPriceInput) {
        minPriceInput.value = minPriceInput.getAttribute('value');
        maxPriceInput.value = maxPriceInput.getAttribute('value');
        
        minPrice = parseFloat(minPriceInput.value);
        maxPrice = parseFloat(maxPriceInput.value);
        
        onInput(minPriceInput.parentElement); // Cập nhật hiển thị giá trị
    }
});


document.getElementById("enterLoc").addEventListener("click", function (e) {
  e.preventDefault(); // Ngăn chặn form gửi đi

  // Cập nhật URL với minPrice và maxPrice
  const url = new URL(window.location.href);
  url.searchParams.set('minPrice', minPrice);
  url.searchParams.set('maxPrice', maxPrice);
  
  // Lấy số trang hiện tại hoặc mặc định là 1
  const currentPage = url.searchParams.get('page') || 1;

  // Gửi AJAX request với giá trị minPrice, maxPrice và page
  fetch(`/san-pham?minPrice=${minPrice}&maxPrice=${maxPrice}&page=${currentPage}`, {
      method: 'GET',
      headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
      }
  })
  .then(response => response.json())
  .then(data => {
      // Xử lý dữ liệu trả về, ví dụ: hiển thị danh sách sản phẩm
      const productList = document.querySelector("#productList");
      loadFilteredPage(url);
      productList.innerHTML = data.html; // HTML của danh sách sản phẩm trên trang
      window.history.pushState({}, '', url); // Cập nhật URL mà không tải lại trang
  })
  .catch(error => console.error('Error:', error));
});
// ----------------------------------------------------------------------