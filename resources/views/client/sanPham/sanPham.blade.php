@extends('client.layout.main')
@section('container')
<section class="section-b-space pt-0">
    <div class="heading-banner">
        <div class="custom-container container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Bộ Sưu Tập</h4>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- slider danh muc --}}
<section class="section-b-space pt-0">
    <div class="custom-container container collection-images">
        <div class="swiper collection-images-slide">
            <div class="swiper-wrapper ratio_square-2">
                <div class="swiper-slide">
                    <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/1.png"
                            alt=""></div>
                </div>
                <div class="swiper-slide">
                    <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/3.png"
                            alt=""></div>
                </div>
                <div class="swiper-slide">
                    <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/6.png"
                            alt=""></div>
                </div>
                <div class="swiper-slide">
                    <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/8.png"
                            alt=""></div>
                </div>
                <div class="swiper-slide">
                    <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/10.png"
                            alt=""></div>
                </div>
                <div class="swiper-slide">
                    <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/1.png"
                            alt=""></div>
                </div>
                <div class="swiper-slide">
                    <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/3.png"
                            alt=""></div>
                </div>
                <div class="swiper-slide">
                    <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/6.png"
                            alt=""></div>
                </div>
                <div class="swiper-slide">
                    <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/8.png"
                            alt=""></div>
                </div>
                <div class="swiper-slide">
                    <div class="fashion-box"><img class="img-fluid" src="../assets/images/collection/slider/10.png"
                            alt=""></div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section-b-space pt-0">
    <div class="custom-container container">
        <div class="row">
            <div class="col-3">
                <div class="custom-accordion theme-scrollbar left-box">
                    <div class="left-accordion">
                        <h5>Thoát </h5><i class="back-button fa-solid fa-xmark"></i>
                    </div>
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="search-box"><input type="search" name="text" placeholder="Tìm kiếm..."><i
                                class="iconsax" data-icon="search-normal-2"></i></div>
                        <div class="accordion-item">
                            <h2 class="accordion-header tags-header"><button class="accordion-button"><span>Từ khóa</span><span>Xem tất cả</span></button></h2>
                            <div class="accordion-collapse collapse show" id="panelsStayOpen-collapse">
                                <div class="accordion-body">
                                    <ul class="tags">
                                        <li> <a href="#">T-Shirt <i class="iconsax" data-icon="add"></i></a></li>
                                        <li> <a href="#">Handbags<i class="iconsax" data-icon="add"></i></a></li>
                                        <li> <a href="#">Trends<i class="iconsax" data-icon="add"></i></a></li>
                                        <li> <a href="#">Minimog<i class="iconsax" data-icon="add"></i></a></li>
                                        <li> <a href="#">Denim<i class="iconsax" data-icon="add"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header"><button class="accordion-button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseEight"><span>Bộ Sưu Tập</span></button>
                            </h2>
                            <div class="accordion-collapse collapse show" id="panelsStayOpen-collapseEight">
                                <div class="accordion-body">
                                    <ul class="collection-list">
                                        <li> <input class="custom-checkbox" id="category10" type="checkbox"
                                                name="text"><label for="category10">Tất cả sản phẩm</label></li>
                                        <li> <input class="custom-checkbox" id="category11" type="checkbox"
                                                name="text"><label for="category11">Sản phẩm bán chạy nhất</label></li>
                                        <li> <input class="custom-checkbox" id="category12" type="checkbox"
                                                name="text"><label for="category12">Hàng mới về</label></li>
                                        <li> <input class="custom-checkbox" id="category13" type="checkbox"
                                                name="text"><label for="category13">Sản phẩm đang sale </label></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header"><button class="accordion-button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseFour"><span>Filter</span></button></h2>
                            <div class="accordion-collapse collapse show mb-3" id="panelsStayOpen-collapseFour">
                                <div class="accordion-body">
                                    <div class="range-slider">
                                        <input class="range-slider-input" type="range" min="0"
                                            max="120000" step="1" value="20000"><input class="range-slider-input"
                                            type="range" min="0" max="120000" step="1" value="100000">
                                        <div class="range-slider-display"></div>
                                    </div>
                                </div>
                                <button id="enterLoc" class="btn">Lọc</button>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header"><button class="accordion-button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo"><span>Danh mục</span></button>
                            </h2>
                            <div class="accordion-collapse collapse show" id="panelsStayOpen-collapseTwo">
                                <div class="accordion-body">
                                    <ul class="catagories-side theme-scrollbar styleSPDanhMuc">
                                        <li> <a href="#">Thời trang (30)</a></li>
                                        <li> <a href="#">Thời trang (30)</a></li>
                                        <li> <a href="#">Thời trang (30)</a></li>
                                        <li> <a href="#">Thời trang (30)</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header tags-header"><button class="accordion-button"><span>vận chuyển
                                        & Giao hàng</span><span></span></button></h2>
                            <div class="accordion-collapse collapse show" id="panelsStayOpen-collapseSeven">
                                <div class="accordion-body">
                                    <ul class="widget-card">
                                        <li><i class="iconsax" data-icon="truck-fast"></i>
                                            <div>
                                                <h6>Miễn phí vận chuyển</h6>
                                            </div>
                                        </li>
                                        <li><i class="iconsax" data-icon="headphones"></i>
                                            <div>
                                                <h6>Hỗ trợ 24/7</h6>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="sticky">
                    <div class="top-filter-menu">
                        <div> <a class="filter-button btn">
                                <h6> <i class="iconsax" data-icon="filter"></i>Danh sách bộ lọc </h6>
                            </a>
                            <div class="category-dropdown"><label for="cars">Sắp xếp theo :</label><select
                                    class="form-select" id="cars" name="carlist">
                                    <option value="">Bán chạy nhất</option>
                                    <option value="">Theo thứ tự, A-Z</option>
                                    <option value="">Giá cao - thấp</option>
                                    <option value="">Giảm giá % từ cao - thấp</option>
                                </select></div>
                        </div>
                    </div>
                    <div class="product-tab-content ratio1_3">
                        <div class="row-cols-lg-4 row-cols-md-3 row-cols-2 grid-section view-option row g-3 g-xl-4">
                            <div>
                                <div class="product-box-3">
                                    <div class="img-wrapper">
                                        <div class="label-block"><span class="lable-1">Mới</span>
                                            <a class="label-2 wishlist-icon" href="javascript:void(0)" tabindex="0">
                                                <i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" data-bs-title="Add to Wishlist"></i>
                                            </a>
                                        </div>
                                        <div class="product-image"><a class="pro-first" href="product.html"> <img
                                                    class="bg-img" src="../assets/images/product/product-3/2.jpg"
                                                    alt="product"></a><a class="pro-sec" href="product.html"> <img
                                                    class="bg-img" src="../assets/images/product/product-3/19.jpg"
                                                    alt="product"></a></div>
                                        <div class="cart-info-icon"> <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#addtocart" tabindex="0"><i class="iconsax"
                                                    data-icon="basket-2" aria-hidden="true" data-bs-toggle="tooltip"
                                                    data-bs-title="Add to card"> </i></a><a href="compare.html"
                                                tabindex="0"><i class="iconsax" data-icon="arrow-up-down"
                                                    aria-hidden="true" data-bs-toggle="tooltip"
                                                    data-bs-title="Compare"></i></a><a href="#"
                                                data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0"><i
                                                    class="iconsax" data-icon="eye" aria-hidden="true"
                                                    data-bs-toggle="tooltip" data-bs-title="Quick View"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-detail">
                                        <ul class="rating">
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-regular fa-star"></i></li>
                                            <li>4.3</li>
                                        </ul><a href="product.html">
                                            <h6>Wide Linen-Blend Trousers</h6>
                                        </a>
                                        <p class="list-per">I was the first person to have a punk rock hairstyle. It
                                            is not easy to dress well. I have my permanent muses and my muses of the
                                            moment. We live in an era of globalization and the era of the woman.
                                            Never in the history of the world have women been more in control of
                                            their destiny. You have a more interesting life if you wear impressive
                                            clothes.</p>
                                        <p>$100.00 <del>$18.00 </del></p>
                                        <div class="listing-button"> <a class="btn" href="cart.html">Quick Shop </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pagination-wrap">
                        <ul class="pagination">
                            <li> <a class="prev" href="#"><i class="iconsax" data-icon="chevron-left"></i></a></li>
                            <li> <a href="#">1</a></li>
                            <li> <a class="active" href="#">2</a></li>
                            <li> <a href="#">3 </a></li>
                            <li> <a class="next" href="#"> <i class="iconsax" data-icon="chevron-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
