@extends('client.layout.main')
@section('container')
<section class="section-b-space pt-0">
    <div class="heading-banner">
        <div class="custom-container container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Chi tiết tin tức</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-b-space pt-0">
    <div class="custom-container container blog-page">
        <div class="row gy-4">
            <div class="col-xl-9 col-lg-8 col-12 ratio50_2">
                <div class="row">
                    <div class="col-12">
                        <div class="blog-main-box blog-details">
                            <div>
                                <div class="blog-img">
                                    <img class="img-fluid bg-img" src="{{Storage::url($tin_tuc->hinh_anh)}}" alt="err">
                                </div>
                            </div>
                            <div class="blog-content"><span class="blog-date">{{ \Carbon\Carbon::parse($tin_tuc->ngay_dang)->format('F j, Y') }} Stylish </span><a
                                    href="{{route('tin-tuc.chi-tiet-tin-tuc',$tin_tuc->id)}}">
                                    <h5>{{$tin_tuc->tieu_de}}</h5>
                                </a>
                                <div>
                                    {!! $tin_tuc->noi_dung !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 order-lg-first">
                <div class="blog-sidebar">
                    <div class="row gy-4">
                        <div class="col-12">
                            <div class="sidebar-box">
                                <div class="sidebar-title">
                                    <div class="loader-line"></div>
                                    <h5>Danh mục tin tức</h5>
                                </div>
                                <ul class="categories">
                                    @foreach ($danh_muc_tin_tucs as $item)
                                    <li>
                                        <p>{{$item->ten_danh_muc}}<span>{{ $count_tin_tuc_danh_muc[$item->id] ?? 0 }}</span></p>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="sidebar-box">
                                <div class="sidebar-title">
                                    <div class="loader-line"></div>
                                    <h5> Bài viết hàng đầu</h5>
                                </div>
                                <ul class="top-post">
                                    @foreach ($bai_viet_hang_dau as $item)
                                    <li>
                                        <img class="img-fluid style-border" src="{{Storage::url($item->hinh_anh)}}" alt="err">
                                        <div>
                                            <a href="{{route('tin-tuc.chi-tiet-tin-tuc',$item->id)}}">
                                                <h6>{!! Str::limit(strip_tags($item->noi_dung), 30, '...') !!}</h6>
                                            </a>
                                            <p>{{ \Carbon\Carbon::parse($item->ngay_dang)->format('F j, Y') }}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="sidebar-box">
                                <div class="sidebar-title">
                                    <div class="loader-line"></div>
                                    <h5>Follow Us</h5>
                                </div>
                                <ul class="social-icon">
                                    <li>
                                        <a href="https://www.instagram.com/namad.store.official/" target="_blank">
                                            <div class="icon">
                                                <i class="fa-brands fa-instagram"> </i>
                                            </div>
                                            <h6>Instagram</h6>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
