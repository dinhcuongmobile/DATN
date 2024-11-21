@extends('client.layout.main')
@section('container')
<section class="section-b-space pt-0">
    <div class="heading-banner">
        <div class="custom-container container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4>Tin Tức</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-b-space pt-0">
    <div class="custom-container container blog-page">
        <div class="row gy-4">
            <div class="col-xl-9 col-lg-8 ratio50_2">
                <div class="row gy-4 sticky">
                    @foreach ($tin_tucs as $item)
                    <div class="col-xl-4 col-sm-6">
                        <div class="blog-main-box">
                            <div>
                                <div class="blog-img"> 
                                    <a href="{{route("tin-tuc.chi-tiet-tin-tuc", $item->id)}}">
                                        <img class="bg-img" src="{{Storage::url($item->hinh_anh)}}" alt="Post">
                                    </a>
                                </div>
                            </div>
                            <div class="blog-content">  
                                <span class="blog-date">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y')}}</span>
                                <a href="{{ route('tin-tuc.chi-tiet-tin-tuc', $item->id) }}">
                                    <h4>{{$item->tieu_de}}</h4>
                                </a>
                                <p>{!! Str::limit(strip_tags($item->noi_dung), 150, '...') !!}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="pagination-wrap mt-0">
                        <ul class="pagination">
                            {{-- Nút "Trước" --}}
                            <li class="{{ $tin_tucs->onFirstPage()}}">
                                <a class="prev" href="{{ $tin_tucs->previousPageUrl() ?? '#' }}">
                                    <i class="iconsax" data-icon="chevron-left"></i>
                                </a>
                            </li>
                    
                            {{-- Hiển thị số trang --}}
                            @for ($i = 1; $i <= $tin_tucs->lastPage(); $i++)
                                @if ($i == $tin_tucs->currentPage())
                                    <li><a class="active" href="#">{{ $i }}</a></li>
                                @else
                                    <li><a href="{{ $tin_tucs->url($i) }}">{{ $i }}</a></li>
                                @endif
                            @endfor
                    
                            {{-- Nút "Tiếp" --}}
                            <li class="{{ $tin_tucs->hasMorePages() }}">
                                <a class="next" href="{{ $tin_tucs->nextPageUrl() ?? '#' }}">
                                    <i class="iconsax" data-icon="chevron-right"></i>
                                </a>
                            </li>
                        </ul>
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
                                    <h5> Danh Mục</h5>
                                </div>
                                @foreach ($danh_muc_tin_tucs as $item)
                                <ul class="categories">
                                    <li>
                                        <p>{{$item->ten_danh_muc}}<span>({{ $count_danh_muc_tin_tuc[$item->id] ?? 0 }})</span></p>
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
