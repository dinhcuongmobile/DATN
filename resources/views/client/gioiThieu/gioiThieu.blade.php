@extends('client.layout.main')
@section('container')
<section class="section-b-space pt-0">
    <div class="heading-banner">
        <div class="custom-container container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Về chúng tôi</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-b-space pt-0">
    <div class="custom-container container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-6 order-1 order-lg-1 ratio_55">
                <div class="about-img"> <img class="bg-img img-fluid" src="../assets/images/layout-4/gt-1.png" alt="">
                    <div class="about-tag"> <a href="{{ route('san-pham.san-pham') }}">
                            <h5>Giới thiệu</h5><i class="fa-solid fa-arrow-right"></i>
                        </a></div>
                </div>
            </div>
            <div class="col-lg-6 order-2 order-lg-2">
                <div class="about-content">
                    <div class="sidebar-title">
                        <div class="loader-line"></div>
                        <h3>Đôi nét về Namad Store</h3>
                    </div>
                    <p>Namad Store là một website thương mại điện tử chuyên cung cấp các sản phẩm thời trang dành riêng cho nam giới, đặc biệt là các dòng áo phong cách hiện đại và thời thượng. Với mục tiêu mang đến cho khách hàng những sản phẩm chất lượng cao và trải nghiệm mua sắm tiện lợi, Namad Store không chỉ chú trọng vào sự đa dạng của các sản phẩm, mà còn tập trung vào việc xây dựng một nền tảng trực tuyến thân thiện và dễ sử dụng.</p>
                        <ul>
                        <li><i class="iconsax" data-icon="cloud"></i>
                            <div>
                                <h6>Chất liệu</h6>
                                <p>Mỗi sản phẩm đều được mô tả chi tiết, từ chất liệu, kiểu dáng cho đến kích thước, giúp khách hàng có thể dễ dàng tìm thấy sản phẩm phù hợp với phong cách và nhu cầu của mình.</p>
                            </div>
                        </li>
                        <li><i class="iconsax" data-icon="clock"></i>
                            <div>
                                <h6>Thiết kế theo trend</h6>
                                <p>Giúp mọi người bắt kịp xu hướng</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 order-4 order-lg-3">
                <div class="about-content about-content-1">
                    <div class="sidebar-title">
                        <div class="loader-line"></div>
                        <h3>Thành Thạo Thời Trang Nam</h3>
                    </div>
                    <p>Namad Store không chỉ là nơi để mua sắm thời trang nam giới mà còn là nền tảng giao lưu và chia sẻ xu hướng phong cách. Chúng tôi luôn cập nhật những bộ sưu tập mới và hợp thời để giúp khách hàng thể hiện cá tính và phong cách riêng của mình. Với phương châm "Chất lượng - Phong cách - Tiện lợi", Namad Store cam kết mang đến cho khách hàng những sản phẩm tốt nhất cùng với dịch vụ chăm sóc khách hàng chuyên nghiệp và tận tâm.</p>
                        
                    <ul>
                        <li><i class="iconsax" data-icon="cloud"></i>
                            <div>
                                <h6>Vải Mềm Mại</h6>
                                <p>Nhận vận chuyển miễn phí trên mỗi đơn hàng. Không thích sản phẩm? Trả lại mà không cần lo lắng.</p>
                            </div>
                        </li>
                        <li><i class="iconsax" data-icon="clock"></i>
                            <div>
                                <h6>Thoải Mái Cả Ngày</h6>
                                <p>Chúng tôi tin rằng việc mặc quần áo nên là phần dễ dàng nhất trong ngày của bạn.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 order-3 order-lg-4 ratio_55">
                <div class="about-img about-img-1"> <img class="bg-img img-fluid" src="../assets/images/layout-4/gt-2.png"
                        alt="">
                    <div class="about-tag"> <a href="{{ route('san-pham.san-pham') }}">
                            <h5>Chất lượng</h5><i class="fa-solid fa-arrow-right"></i>
                        </a></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-b-space layout-light">
    <div class="custom-container container">
        <div class="row gy-4">
            <div class="col-12">
                <div class="title-1">
                    <p>Sự Xuất Sắc Của Chúng Tôi<span></span></p>
                    <h3>"Sự hài lòng của bạn là chất lượng của chúng tôi!</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="about-icon"> <i class="iconsax" data-icon="blur"></i>
                    <h5>Chất Liệu </h5>
                    <p>Sản phẩm của chúng tôi được thiết kế chính xác để mang lại sự thoải mái và bền bỉ, sử dụng các loại vải chất lượng trong quy trình sản xuất chuyên nghiệp.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="about-icon"> <i class="iconsax" data-icon="diamonds"></i>
                    <h5>Phong Cách Đơn Giản</h5>
                    <p>Sự tinh tế đơn giản.Sản phẩm của chúng tôi thể hiện phong cách tự nhiên, truyền tải thông điệp tinh tế, thể hiện tinh hoa của thiết kế tối giản.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="about-icon"> <i class="iconsax" data-icon="media-sliders-3"></i>
                    <h5>Kích Thước Đa Dạng</h5>
                    <p>Với sự đa dạng về kích thước và hình dáng, đồ thể thao của chúng tôi khuyến khích sự đa dạng và tôn vinh vẻ đẹp của cá nhân, phục vụ mọi vóc dáng.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

