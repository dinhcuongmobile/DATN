@extends('client.layout.main')
@section('container')
<section class="section-b-space pt-0">
        <div class="heading-banner">
            <div class="custom-container container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4>Faq</h4>
                    </div> <div class="col-sm-6">
                        <ul class="breadcrumb float-end">
                            <li class="breadcrumb-item"> <a href="index.html">Trang Chủ </a></li>
                            /
                            <li class=""> <a href="#">Faq</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-b-space pt-0">
        <div class="custom-container container faq-section">
            <div class="row gy-4">
                <div class="col-xl-10 mx-auto">
                    <div class="faq-title-2 sticky">
                        <h3>Chúng tôi có thể giúp gì cho bạn?</h3>                     
                    </div>
                </div>
                <div class="col-xl-10 mx-auto">
                    <div class="custom-accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne"><span>1. Website thu thập những thông tin cá nhân nào từ khách hàng ?</span></button></h2>
                                <div class="accordion-collapse collapse show" id="collapseOne">
                                    <div class="accordion-body">
                                        <p>Chúng tôi thu thập thông tin như tên, địa chỉ email, số điện thoại, địa chỉ giao hàng và thông tin thanh toán để xử lý đơn hàng và lưu thông tin đăng nhập trong 30 ngày .</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"><span>2.Thông tin cá nhân của tôi được sử dụng vào mục đích gì?</span></button></h2> <div class="accordion-collapse collapse" id="collapseTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Thông tin của bạn được sử dụng để xử lý đơn hàng, giao hàng, liên lạc khi cần thiết và cung cấp các chương trình ưu đãi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"><span>3. Website có chia sẻ thông tin của tôi với bên thứ ba không?</span></button></h2>
                                <div class="accordion-collapse collapse" id="collapseThree"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Chúng tôi cam kết không bán hoặc chia sẻ thông tin của bạn với bên thứ ba, ngoại trừ các đối tác vận chuyển hoặc xử lý thanh toán cần thiết để hoàn tất đơn hàng.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"><span>4. Thông tin của tôi được lưu trữ trong bao lâu?</span></button></h2>
                                <div class="accordion-collapse collapse" id="collapseFour"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Thông tin của bạn sẽ được lưu trữ trong suốt thời gian cần thiết để cung cấp dịch vụ hoặc tuân thủ các yêu cầu pháp luật.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"><span>5.Website có sử dụng cookie không?</span></button></h2>
                                <div class="accordion-collapse collapse" id="collapseFive"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Có, chúng tôi sử dụng cookie để cải thiện trải nghiệm người dùng, ghi nhớ tùy chọn của bạn và phân tích hiệu suất website.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSix"><span>6.Tôi có thể từ chối cookie không?</span></button></h2>
                                <div class="accordion-collapse collapse" id="collapseSix"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Bạn có thể tùy chỉnh cài đặt trình duyệt để từ chối cookie, tuy nhiên một số tính năng trên website có thể không hoạt động chính xác. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSeven"><span>7. Làm thế nào để tôi xem hoặc chỉnh sửa thông tin cá nhân của mình?</span></button></h2>
                                <div class="accordion-collapse collapse" id="collapseSeven" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Bạn có thể đăng nhập vào tài khoản để xem và chỉnh sửa thông tin hoặc liên hệ trực tiếp với chúng tôi qua email hỗ trợ.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseEight"><span>8. Thông tin cá nhân của tôi được bảo mật như thế nào?</span></button></h2>
                                <div class="accordion-collapse collapse" id="collapseEight"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Chúng tôi sử dụng các biện pháp mã hóa và bảo mật để bảo vệ thông tin cá nhân khỏi truy cập trái phép.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseNine"><span>Tôi phải làm gì nếu nghi ngờ thông tin của mình bị lộ?</span></button></h2>
                                <div class="accordion-collapse collapse" id="collapseNine"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Hãy liên hệ ngay với chúng tôi qua email hoặc số điện thoại hỗ trợ để được giải quyết kịp thời.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTen"><span>10. Chính sách bảo mật có thay đổi không và tôi được thông báo như thế nào?</span></button>
                                </h2>
                                <div class="accordion-collapse collapse" id="collapseTen"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Chính sách có thể thay đổi theo thời gian. Mọi thay đổi sẽ được cập nhật trên website và thông báo đến bạn qua email nếu cần thiết.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection