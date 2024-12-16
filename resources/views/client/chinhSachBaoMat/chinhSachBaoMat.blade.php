@extends('client.layout.main')
@section('container')
    <section class="section-b-space pt-0">
        <div class="heading-banner">
            <div class="custom-container container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4>Chính sách bảo mật thông tin khách hàng</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-b-space pt-0">
        <div class="custom-container container faq-section">
            <div class="row gy-4">
                <div class="col-xl-10 mx-auto">
                    <div class="custom-accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne"><span>1. Mục đích và phạm vi thu thập thông
                                            tin</span></button></h2>
                                <div class="accordion-collapse collapse show" id="collapseOne">
                                    <div class="accordion-body">
                                        <p>- NAMAD không bán, chia sẻ hay trao đổi thông tin cá nhân của khách hàng thu thập
                                            trên trang web cho một bên thứ ba nào khác.</p>
                                        <p>- Thông tin cá nhân thu thập được sẽ chỉ được sử dụng trong nội bộ website. Khi
                                            bạn liên hệ đăng ký dịch vụ, thông tin cá nhân mà NAMAD thu thập bao gồm:
                                            Họ và tên, Địa chỉ, Số điện thoại và Email.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header"><button class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"><span>2. Phạm vi sử dụng
                                            thông tin</span></button></h2>
                                <div class="accordion-collapse collapse" id="collapseTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            Thông tin cá nhân thu thập được sẽ chỉ được NAMAD sử dụng trong nội bộ website
                                            và cho một hoặc tất cả các mục đích sau đây:
                                        </p>
                                        <p>- Hỗ trợ khách hàng</p>
                                        <p>- Cung cấp thông tin liên quan đến dịch vụ</p>
                                        <p>- Xử lý đơn đặt hàng và cung cấp dịch vụ và thông tin qua trang web của chúng tôi
                                            theo yêu cầu của bạn</p>
                                        <p>
                                            Chúng tôi có thể sẽ gửi thông tin sản phẩm, dịch vụ mới, thông tin về các sự
                                            kiện sắp tới hoặc thông tin tuyển dụng nếu quý khách đăng kí nhận email thông
                                            báo.
                                        </p>
                                        <p>
                                            Trong trường hợp có yêu cầu của pháp luật, NAMAD có trách nhiệm hợp tác cung
                                            cấp thông tin cá nhân khách hàng khi có yêu cầu từ cơ quan tư pháp bao gồm: Viện
                                            kiểm soát, tòa án, cơ quan công an điều tra liên quan đến hành vi vi phạm pháp
                                            luật nào đó của khách hàng. Ngoài ra không ai có quyền xâm phạm vào thông tin cá
                                            nhân của khách hàng.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree">
                                        <span>3. Thời gian lưu trữ thông tin</span>
                                    </button>
                                </h2>
                                <div class="accordion-collapse collapse" id="collapseThree"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            Đối với thông tin cá nhân, NAMAD chỉ xóa đi dữ liệu này nếu khách hàng có yêu
                                            cầu, khách hàng yêu cầu gửi mail về namadstore2024@gmail.com
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour">
                                        <span>4. Phương tiện và công cụ để người dùng tiếp cận và chỉnh sửa dữ liệu cá nhân
                                            của mình</span>
                                    </button>
                                </h2>
                                <div class="accordion-collapse collapse" id="collapseFour"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>NAMAD sẽ thu thập thông tin khách hàng qua trang web, thông tin cá nhân khách
                                            hàng được thực hiện để đặt mua sản phẩm, dịch vụ gửi về
                                            hộp mail của chúng tôi: namadstore2024@gmail.com hoặc số điện thoại liên hệ đặt
                                            mua sản
                                            phẩm gọi về Hotline +84 35 786 4779.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFive">
                                        <span>5. Cơ chế tiếp nhận và giải quyết khiếu nại của người tiêu dùng liên quan đến
                                            việc thông tin cá nhân bị sử dụng sai mục đích hoặc phạm vi đã thông báo</span>
                                    </button>
                                </h2>
                                <div class="accordion-collapse collapse" id="collapseFive"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Tại NAMAD, việc bảo vệ thông tin cá nhân của bạn là rất quan trọng, bạn được đảm
                                            bảo rằng thông tin cung cấp cho chúng tôi sẽ được bảo mật, NAMAD cam kết không
                                            chia sẻ, bán hoặc cho thuê thông tin cá nhân của bạn cho bất kỳ người nào khác.
                                        </p>
                                        <p>
                                            NAMAD cam kết chỉ sử dụng các thông tin của bạn vào các trường hợp sau:
                                        </p>
                                        <p>
                                            • Nâng cao chất lượng dịch vụ dành cho khách hàng
                                            <br>
                                            • Giải quyết các tranh chấp, khiếu nại Khi cơ quan pháp luật có yêu cầu
                                        </p>
                                        <p>
                                            NAMAD hiểu rằng quyền lợi của bạn trong việc bảo vệ thông tin cá nhân cũng
                                            chính là trách nhiệm của chúng tôi nên trong bất kỳ trường hợp có thắc mắc, góp
                                            ý nào liên quan đến chính sách bảo mật của NAMAD, và liên quan đến việc thông
                                            tin cá nhân bị sử dụng sai mục đích hoặc phạm vi đã thông báo vui lòng liên hệ
                                            qua số Hotline +84 35 786 4779 hoặc email: namadstore2024@gmail.com.
                                        </p>
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
