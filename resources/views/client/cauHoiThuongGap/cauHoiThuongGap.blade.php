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
                        <h3>Câu Hỏi Thường Gặp ?</h3>                     
                    </div>
                </div>
                <div class="col-xl-10 mx-auto">
                    <div class="custom-accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne"><span>1.Làm thế nào để đặt hàng trên website?</span></button></h2>
                                <div class="accordion-collapse collapse show" id="collapseOne">
                                    <div class="accordion-body">
                                        <p>Bạn chỉ cần chọn sản phẩm yêu thích, chọn size/màu sắc, thêm vào giỏ hàng và làm theo hướng dẫn thanh toán.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"><span>2.Website có hỗ trợ giao hàng toàn quốc không?</span></button></h2> <div class="accordion-collapse collapse" id="collapseTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Có, chúng tôi hỗ trợ giao hàng trên toàn quốc qua các đơn vị vận chuyển uy tín.  
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"><span>3. Thời gian giao hàng là bao lâu?</span></button></h2>
                                <div class="accordion-collapse collapse" id="collapseThree"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Thông thường, thời gian giao hàng từ 3-5 ngày làm việc, tùy thuộc vào địa chỉ nhận hàng.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"><span>4. Phí vận chuyển được tính như thế nào?</span></button></h2>
                                <div class="accordion-collapse collapse" id="collapseFour"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Phí vận chuyển sẽ hiển thị rõ khi bạn đặt hàng và tùy thuộc vào khu vực giao hàng.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSix"><span>6.Tôi cần làm gì nếu nhận được sản phẩm bị lỗi hoặc sai kích thước?</span></button></h2>
                                <div class="accordion-collapse collapse" id="collapseSix"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Vui lòng liên hệ với chúng tôi qua hotline hoặc email hỗ trợ, cung cấp hình ảnh sản phẩm để được hỗ trợ đổi/trả. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSeven"><span>7. Website có những phương thức thanh toán nào?</span></button></h2>
                                <div class="accordion-collapse collapse" id="collapseSeven" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Chúng tôi hỗ trợ thanh toán qua thẻ ngân hàng, ví điện tử (Momo, ZaloPay), hoặc thanh toán khi nhận hàng (COD).</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseEight"><span>8.Làm thế nào để biết áo có phù hợp với tôi không?
                                        </span></button></h2>
                                <div class="accordion-collapse collapse" id="collapseEight"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Bạn có thể tham khảo bảng size được cung cấp trên trang sản phẩm để chọn kích cỡ phù hợp.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseNine"><span>9. Tôi có thể theo dõi đơn hàng của mình không?</span></button></h2>
                                <div class="accordion-collapse collapse" id="collapseNine"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Có, sau khi đặt hàng, bạn sẽ nhận được mã vận đơn để theo dõi tình trạng giao hàng trên website của đơn vị vận chuyển.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTen"><span>10. Tôi cần liên hệ hỗ trợ như thế nào?</span></button>
                                </h2>
                                <div class="accordion-collapse collapse" id="collapseTen"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Bạn có thể liên hệ qua hotline, email, hoặc fanpage của chúng tôi. Thông tin liên hệ được hiển thị ở phần cuối trang web.</p>
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