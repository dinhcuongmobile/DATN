@foreach ($san_phams as $item)
    @if ($item->bienThes->count()>0)
    <div>
        <div class="product-box-3">
            <div class="img-wrapper">
                <div class="product-image style-border">
                    <a class="pro-first bg-size" href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}"
                        style="
                        background-image: url({{ Storage::url($item->hinh_anh)}});
                        background-size:cover;
                        background-position: center;
                        background-repeat: no-repeat;
                        display: block;
                        ">
                        <img class="bg-img" src="{{ Storage::url($item->hinh_anh) }}" alt="Sản phẩm"
                            style="display: none;">
                    </a>
                    <a class="pro-sec bg-size" href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}"
                        style="
                        background-image: url({{ Storage::url($item->bienThes->first()->hinh_anh) }});
                        background-size:cover;
                        background-position: center;
                        background-repeat: no-repeat;
                        display: block;
                        ">
                        <img class="bg-img" src="{{ Storage::url($item->bienThes->first()->hinh_anh) }}" alt="Sản phẩm"
                            style="display: none;">
                    </a>
                </div>
            </div>
            <div class="product-detail">
                <ul class="rating">
                    <li>
                        @php
                            $avg_rating = $item->danhGias->avg('so_sao');
                        @endphp

                        @php
                            // Tính số sao đầy, sao nửa và sao rỗng
                            $full_stars = floor($avg_rating); // Số sao đầy
                            $half_star = $avg_rating - $full_stars >= 0.5 ? 1 : 0; // Sao nửa
                            $empty_stars = 5 - ($full_stars + $half_star); // Sao rỗng
                        @endphp

                        {{-- Hiển thị sao đầy --}}
                        @for ($i = 0; $i < $full_stars; $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor

                        {{-- Hiển thị sao nửa nếu có --}}
                        @if ($half_star)
                            <i class="fa-solid fa-star-half-stroke"></i>
                        @endif

                        {{-- Hiển thị sao rỗng --}}
                        @for ($i = 0; $i < $empty_stars; $i++)
                            <i class="fa-regular fa-star"></i>
                        @endfor
                    </li>

                    {{-- Hiển thị số điểm đánh giá --}}
                    @php
                        if ($avg_rating > 0) {
                            $danh_gia = number_format($avg_rating, 1);
                        } else {
                            $danh_gia = 'Chưa có đánh giá';
                        }
                    @endphp
                    <li>({{ $danh_gia }})</li>
                </ul><a href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}">
                    <h6>{{ $item->ten_san_pham }}</h6>
                </a>
                @php
                    $gia_khuyen_mai = $item->gia_san_pham - ($item->gia_san_pham * $item->khuyen_mai) / 100;
                @endphp
                <p>
                    {{ number_format($gia_khuyen_mai, 0, ',', '.') }}đ
                    @if ($item->khuyen_mai > 0)
                        <del>{{ number_format($item->gia_san_pham, 0, ',', '.') }}đ</del>
                    @endif
                </p>
            </div>
        </div>
    </div>
    @endif
@endforeach
