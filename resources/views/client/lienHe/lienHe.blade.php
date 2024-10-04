@extends('client.layout.main')
@section('container')
<section class="section-b-space pt-0">
    <div class="heading-banner">
        <div class="custom-container container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Lien he</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-b-space pt-0">
    <div class="custom-container container">
        <div class="contact-main">
            <div class="row gy-3">
                <div class="col-12">
                    <div class="title-1 address-content">
                        <p class="pb-0">Hay lien he toi<span></span></p>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="address-items">
                        <div class="icon-box"> <i class="iconsax" data-icon="location"></i></div>
                        <div class="contact-box">
                            <h6>Contact Number</h6>
                            <p>+91 123 - 456 - 7890</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="address-items">
                        <div class="icon-box"> <i class="iconsax" data-icon="phone-calling"></i></div>
                        <div class="contact-box">
                            <h6>So dien thoai</h6>
                            <p>+91 123 - 456 - 7890</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="address-items">
                        <div class="icon-box"> <i class="iconsax" data-icon="mail"></i></div>
                        <div class="contact-box">
                            <h6>Dia chi Email</h6>
                            <p>katie098@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="address-items">
                        <div class="icon-box"> <i class="iconsax" data-icon="map-1"></i></div>
                        <div class="contact-box">
                            <h6>Bournemouth Office</h6>
                            <p>Visitación de la Encina 22</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-b-space pt-0">
    <div class="custom-container container">
        <div class="contact-main">
            <div class="row align-items-center gy-4">
                <div class="col-lg-6 order-lg-1 order-2">
                    <div class="contact-box">
                        <h4>Lien he voi chung toi </h4>
                        <p>Neu ban so san pham tuyet voi hoac muon lam cong tac vien, hay lien he voi chung toi. </p>
                        <div class="contact-form">
                            <div class="row gy-4">
                                <div class="col-12"> 
                                    <label class="form-label" for="inputEmail4">Ho va ten</label>
                                    <input class="form-control" id="inputEmail4" type="text" name="text"
                                        placeholder="Nhap ho va ten">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="inputEmail5">Email</label>
                                    <input class="form-control" id="inputEmail5" type="email"
                                        name="email" placeholder="Nhap dia chi Email">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="inputEmail6">So dien thoai</label>
                                    <input class="form-control" id="inputEmail6" type="number"
                                        name="number" placeholder="Nhap so dien thoai">
                                </div>
                                <div class="col-12"> <label class="form-label"
                                        for="inputEmail7">Tieu de</label><input class="form-control"
                                        id="inputEmail7" type="text" name="text" placeholder="Nhap tieu de">
                                </div>
                                <div class="col-12"> 
                                    <label class="form-label">Noi dung</label>
                                    <textarea
                                        class="form-control" id="message" rows="6"
                                        placeholder="Nhap noi dung"></textarea>
                                </div>
                                <div class="col-12"> <button class="btn btn_black rounded sm" type="submit"> Gui </button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 order-lg-2 order-1 offset-xl-1">
                    <div class="contact-img"> <img class="img-fluid"
                            src="https://themes.pixelstrap.net/katie/assets/images/contact/1.svg" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection