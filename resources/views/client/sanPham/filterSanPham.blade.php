@foreach ($san_phams as $item)
    <div>
        <div class="product-box-3">
            <div class="img-wrapper">
                <div class="label-block">
                    <a class="label-2 wishlist-icon" href="#" tabindex="0">
                        <i class="iconsax" data-icon="heart" aria-hidden="true" data-bs-toggle="tooltip" title="Wishlist">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 21.6516C11.69 21.6516 11.39 21.6116 11.14 21.5216C7.32 20.2116 1.25
                                15.5616 1.25 8.69156C1.25 5.19156 4.08 2.35156 7.56 2.35156C9.25 2.35156 10.83 3.01156
                                12 4.19156C13.17 3.01156 14.75 2.35156 16.44 2.35156C19.92 2.35156 22.75 5.20156 22.75 8.69156C22.75
                                15.5716 16.68 20.2116 12.86 21.5216C12.61 21.6116 12.31 21.6516 12 21.6516ZM7.56 3.85156C4.91 3.85156 2.75
                                6.02156 2.75 8.69156C2.75 15.5216 9.32 19.3216 11.63 20.1116C11.81 20.1716 12.2 20.1716 12.38 20.1116C14.68
                                19.3216 21.26 15.5316 21.26 8.69156C21.26 6.02156 19.1 3.85156 16.45 3.85156C14.93 3.85156 13.52 4.56156
                                12.61 5.79156C12.33 6.17156 11.69 6.17156 11.41 5.79156C10.48 4.55156 9.08 3.85156 7.56 3.85156Z"
                                    fill="#292D32">
                                </path>
                            </svg>
                        </i>
                    </a>
                </div>
                <div class="product-image style-border">
                    <a class="pro-first bg-size" href="{{ route('san-pham.chi-tiet-san-pham', $item->id) }}"
                        style="
                        background-image: url({{ Storage::url($item->hinh_anh) }});
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
                <div class="cart-info-icon">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" tabindex="0">
                        <i class="iconsax" data-icon="eye" aria-hidden="true" data-bs-toggle="tooltip"
                            title="Quick view">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.58 12C15.58 13.98 13.98 15.58 12 15.58C10.02 15.58 8.42004 13.98 8.42004
                                12C8.42004 10.02 10.02 8.42004 12 8.42004C13.98 8.42004
                                15.58 10.02 15.58 12Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                </path>
                                <path d="M12 20.27C15.53 20.27 18.82 18.19 21.11 14.59C22.01 13.18 22.01 10.81
                                21.11 9.39997C18.82 5.79997 15.53 3.71997 12 3.71997C8.46997 3.71997 5.17997
                                5.79997 2.88997 9.39997C1.98997 10.81 1.98997 13.18 2.88997 14.59C5.17997 18.19
                                8.46997 20.27 12 20.27Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                </path>
                            </svg>
                        </i>
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
@endforeach
