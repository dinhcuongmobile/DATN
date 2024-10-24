@extends('client.layout.main')
@section('container')
<section class="section-b-space pt-0">
    <div class="heading-banner">
        <div class="custom-container container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Giỏ hàng</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-b-space pt-0">
    <div class="custom-container container">
        <div class="row g-4">
            <div class="col-12">
                <div class="cart-countdown"><img src="../assets/images/gif/fire-2.gif" alt="">
                    <h6>Xin hãy nhanh chân! Có người đã đặt hàng một trong những mặt hàng bạn có trong giỏ hàng.</h6>
                </div>
            </div>
            <div class="col-xxl-9 col-xl-8">
                <div class="cart-table">
                    <div class="table-title">
                        <h5>Giỏ hàng<span id="cartTitle">(3)</span></h5><button id="clearAllButton">Xóa tất cả</button>
                    </div>
                    <div class="table-responsive theme-scrollbar">
                        <table class="table" id="cart-table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm </th>
                                    <th>Giá </th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="cart-box"> <a href="product.html"> <img
                                                    src="../assets/images/cart/category/1.jpg" alt=""></a>
                                            <div> <a href="product.html">
                                                    <h5>Concrete Jungle Pack</h5>
                                                </a>
                                                <p>Phân loại hàng: <span>Small</span></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$20.00</td>
                                    <td>
                                        <div class="quantity"><button class="minus" type="button"><i
                                                    class="fa-solid fa-minus"></i></button><input type="number"
                                                value="1" min="1" max="20"><button class="plus" type="button"><i
                                                    class="fa-solid fa-plus"></i></button></div>
                                    </td>
                                    <td>$195.00</td>
                                    <td><a class="deleteButton" href="javascript:void(0)"><i class="iconsax"
                                                data-icon="trash"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="no-data" id="data-show"><img src="../assets/images/cart/1.gif" alt="">
                        <h4>Bạn không có sản phẩm nào trong giỏ hàng!</h4>
                        <p>Hôm nay là ngày tuyệt vời để mua những thứ bạn đã giữ! hoặc <span>Tiếp tục mua</span></p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4">
                <div class="cart-items">
                    <div class="cart-body">
                        <h6>Chi tiết đơn hàng (3 sản phẩm) </h6>
                        <ul>
                            <li>
                                <p>Tổng số tiền </p><span>$220.00 </span>
                            </li>
                            <li>
                                <p>Tiết kiệm được </p><span class="theme-color">-$20.00 </span>
                            </li>
                            <li>
                                <p>Phiếu giảm giá </p><span class="Coupon">Apply Coupon </span>
                            </li>
                            <li>
                                <p>Vận chuyển </p><span>$50.00 </span>
                            </li>
                        </ul>
                    </div>
                    <div class="cart-bottom">
                        <p><i class="iconsax me-1" data-icon="tag-2"></i>Khuyến mãi đặc biệt (-$1.49) </p>
                        <h6>Tổng thanh toán <span>$158.41 </span></h6><span>Thuế và phí vận chuyển được tính khi thanh toán</span>
                    </div>
                    <div class="coupon-box">
                        <h6>Phiếu giảm giá</h6>
                        <ul>
                            <li> <span> <input type="text" placeholder="Áp dụng phiếu giảm giá"><i class="iconsax me-1"
                                        data-icon="tag-2"> </i></span><button class="btn">Apply </button></li>
                        </ul>
                    </div><a class="btn btn_black w-100 rounded sm" href="check-out.html">Tiếp tục</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
