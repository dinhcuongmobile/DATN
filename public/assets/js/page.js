// Xắp xếp sản phẩm và phân trang
$(document).ready(function() {
    // Xử lý sự kiện khi nhấp vào phân trang
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault(); // Ngăn chặn hành động mặc định

        var url = $(this).data('url'); // Lấy URL từ data-url
        if (!url || $(this).parent().hasClass('disabled')) return;
        // Nếu không có URL hoặc là nút disabled, thoát khỏi hàm

        var formData = $('#formFilter').serialize(); // Lấy dữ liệu từ form

        var currentUrlParams = new URLSearchParams(window.location.search);

        // Thêm các tham số từ form vào currentUrlParams
        if (formData) {
            formData.split('&').forEach(function(param) {
                const [key, value] = param.split('=');
                currentUrlParams.set(decodeURIComponent(key), decodeURIComponent(value));
            });
        }

        // Cập nhật URL với tham số phân trang
        var pageParam = new URLSearchParams(url.split('?')[1]).get('page');
        if (pageParam) {
            currentUrlParams.set('page', pageParam);
        }

        // Tạo URL mới với các tham số đã cập nhật
        url = url.split('?')[0] + '?' + currentUrlParams.toString();

        // Gửi AJAX request với URL mới
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#productList').html(response.html); // Cập nhật danh sách sản phẩm

                // Cập nhật URL
                window.history.pushState(null, '', url);

                // Cập nhật trạng thái cho các nút số trang
                $('.pagination li').removeClass(
                    'active'); // Xóa lớp active khỏi tất cả các nút số trang
                var currentPage = new URL(url).searchParams.get('page') || 1;
                // Lấy số trang hiện tại từ URL
                $('.pagination a[data-url*="page=' + currentPage + '"]').closest('li')
                    .addClass('active');
                // Thêm lớp active vào nút hiện tại

                // Cập nhật các nút Next và Previous
                $('.prev').data('url', response.prevUrl);
                // Cập nhật URL cho nút Previous
                $('.next').data('url', response.nextUrl);
                // Cập nhật URL cho nút Next

                // Cập nhật href cho các nút
                $('.prev a').attr('href', response.prevUrl);
                $('.next a').attr('href', response.nextUrl);

                // Cập nhật các nút số trang
                $('.pagination .page-link').each(function() {
                    var pageUrl = $(this).data('url');
                    $(this).attr('href', pageUrl);
                });
            },
            error: function(xhr) {
                console.log('Có lỗi xảy ra:', xhr.responseText);
            }
        });
    });
});


window.addEventListener('popstate', function() {
    // Gửi lại yêu cầu AJAX với URL hiện tại
    $.ajax({
        url: window.location.href,
        type: 'GET',
        success: function(response) {
            $('#productList').html(response.html); // Cập nhật lại danh sách sản phẩm
            // Đảm bảo rằng dropdown giữ giá trị đã chọn
            var selectedValue = new URLSearchParams(window.location.search).get('orderby');
            $('#orderby').val(selectedValue); // Cập nhật giá trị cho dropdown

            // Cập nhật trạng thái cho các nút số trang
            var currentPage = new URL(window.location.href).searchParams.get('page') ||
                1; // Lấy số trang hiện tại
            $('.pagination li').removeClass(
                'active'); // Xóa lớp active khỏi tất cả các nút số trang
            $('.pagination a[data-url*="page=' + currentPage + '"]').closest('li').addClass(
                'active'); // Thêm lớp active vào nút hiện tại
        },
        error: function(xhr) {
            console.log('Có lỗi xảy ra:', xhr.responseText);
        }
    });
});