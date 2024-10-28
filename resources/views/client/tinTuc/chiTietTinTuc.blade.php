@extends('client.layout.main')
@section('container')
<section class="section-b-space pt-0">
    <div class="heading-banner">
        <div class="custom-container container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Blog Details</h4>
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
                                    <img class="img-fluid bg-img"src="{{Storage::url($tin_tuc->hinh_anh)}}" alt="">
                                </div>
                            </div>
                            <div class="blog-content"><span class="blog-date">{{ \Carbon\Carbon::parse($tin_tuc->created_at)->format('d-m-Y')}} </span><a
                                    href="blog-details.html">
                                    <h4>{{$tin_tuc->tieu_de}}</h4>
                                </a>
                                <p>
                                    {{$tin_tuc->noi_dung}}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 order-lg-first col-12">
                <div class="blog-sidebar sticky">
                    <div class="row gy-4">
                        <div class="col-12">
                            <div class="blog-search"> <input type="search" placeholder="Search Here..."><i
                                    class="iconsax" data-icon="search-normal-2"></i></div>
                        </div>
                        <div class="col-12">
                            @foreach ($danh_mucs as $item)
                            <div class="sidebar-box">
                                <div class="sidebar-title">
                                    <div class="loader-line"></div>
                                    <h5> Danh Mục</h5>
                                </div>
                                <ul class="categories">
                                    <li>
                                        <p>{{$item->ten_danh_muc}}<span>({{ $count_danh_muc_tin_tuc[$item->id] ?? 0 }})</span></p>
                                    </li>
                                </ul>
                            </div>                         
                            @endforeach
                        </div>
                        <div class="col-12">
                            <div class="sidebar-box">
                                <div class="sidebar-title">
                                    <div class="loader-line"></div>
                                    <h5> Top Post</h5>
                                </div>
                                <ul class="top-post">
                                    <li> <img class="img-fluid" src="../assets/images/other-img/blog-1.jpg" alt="">
                                        <div> <a href="blog-details.html">
                                                <h6>Study 2020: Fake Engagement is Only Half the Problem</h6>
                                            </a>
                                            <p>September 28, 2021</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 d-none d-lg-block">
                            <div class="blog-offer-box"> <img class="img-fluid"
                                    src="../assets/images/other-img/blog-offer.jpg" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection