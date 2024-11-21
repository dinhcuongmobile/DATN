@extends('client.layout.main')
@section('container')
<section class="section-b-space pt-0">
    <div class="heading-banner">
        <div class="custom-container container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Chi Tiết Tin Tức</h4>
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
                                    href="{{route('tin-tuc.chi-tiet-tin-tuc', $tin_tuc->id)}}">
                                    <h4>{{$tin_tuc->tieu_de}}</h4>
                                </a>
                                <p>
                                    {!!$tin_tuc->noi_dung !!}
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
                            <div class="sidebar-box">
                                <div class="sidebar-title">
                                    <div class="loader-line"></div>
                                    <h5> Danh Mục</h5>
                                </div>
                                @foreach ($danh_muc_tin_tucs as $item)
                                <ul class="categories">
                                    <li>
                                        <p>{{$item->ten_danh_muc}}<span></span></p>
                                    </li>
                                </ul>
                                @endforeach
                            </div>                         
                            
                        </div>
                        <div class="col-12">
                            <div class="sidebar-box">
                                <div class="sidebar-title">
                                    <div class="loader-line"></div>
                                    <h5> Bài Viết Gần Đây</h5>
                                </div>
                                @foreach ($tin_tuc_gan_day as $item)
                                <ul class="top-post">
                                    <li> 
                                        <a href="{{ route('tin-tuc.chi-tiet-tin-tuc', $item->id) }}">
                                             <img class="img-fluid" src="{{Storage::url($item->hinh_anh)}}" alt="Post">
                                        </a>
                                        <div> 
                                            <a href="{{ route('tin-tuc.chi-tiet-tin-tuc', $item->id) }}">
                                                <h6>{{$item->tieu_de}}</h6>
                                            </a>
                                            <p>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y')}}</p>
                                        </div>
                                    </li>
                                </ul>
                                @endforeach
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection