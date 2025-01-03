<ul class="pagination">
    {{-- Nút "Trước" --}}
    <li class="{{ $danh_gias->onFirstPage() ? 'disabled' : '' }}">
        <a class="prev" href="javascript:void(0);" data-page="{{ $danh_gias->currentPage() - 1 }}">
            <i class="iconsax" data-icon="chevron-left"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.0013 20.6695C14.8113 20.6695 14.6213 20.5995 14.4713 20.4495L7.95125 13.9295C6.89125 12.8695 6.89125 11.1295 7.95125 10.0695L14.4713 3.54953C14.7613 3.25953 15.2413 3.25953 15.5312 3.54953C15.8212 3.83953 15.8212 4.31953 15.5312 4.60953L9.01125 11.1295C8.53125 11.6095 8.53125 12.3895 9.01125 12.8695L15.5312 19.3895C15.8212 19.6795 15.8212 20.1595 15.5312 20.4495C15.3813 20.5895 15.1912 20.6695 15.0013 20.6695Z" fill="#292D32"></path>
                </svg>
            </i>
        </a>
    </li>

    {{-- Hiển thị số trang --}}
    @for ($i = 1; $i <= $danh_gias->lastPage(); $i++)
        <li>
            <a class="{{ $i == $danh_gias->currentPage() ? 'active' : '' }}"
            href="javascript:void(0);" data-page="{{ $i }}">{{ $i }}</a>
        </li>
    @endfor

    {{-- Nút "Tiếp" --}}
    <li class="{{ $danh_gias->hasMorePages() ? '' : 'disabled' }}">
        <a class="next" href="javascript:void(0);" data-page="{{ $danh_gias->currentPage() + 1 }}">
            <i class="iconsax" data-icon="chevron-right"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.91156 20.6695C8.72156 20.6695 8.53156 20.5995 8.38156 20.4495C8.09156 20.1595 8.09156 19.6795 8.38156 19.3895L14.9016 12.8695C15.3816 12.3895 15.3816 11.6095 14.9016 11.1295L8.38156 4.60953C8.09156 4.31953 8.09156 3.83953 8.38156 3.54953C8.67156 3.25953 9.15156 3.25953 9.44156 3.54953L15.9616 10.0695C16.4716 10.5795 16.7616 11.2695 16.7616 11.9995C16.7616 12.7295 16.4816 13.4195 15.9616 13.9295L9.44156 20.4495C9.29156 20.5895 9.10156 20.6695 8.91156 20.6695Z" fill="#292D32"></path>
                </svg>
            </i>
        </a>
    </li>
</ul>
